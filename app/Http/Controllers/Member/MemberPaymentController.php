<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Log;


use App\Models\Transaction;
use App\Models\Course;
use App\Models\CourseEbook;
use App\Models\Ebook;
use App\Models\MyListCourse;
use App\Models\DiskonKelas;

class MemberPaymentController extends Controller
{
    public function index(Request $request)
    {
        $courseId = $request->query('course_id');
        $ebookId = $request->query('ebook_id');
        $bundleId = $request->query('bundle_id');

        $course = Course::find($courseId);
        $ebook = Ebook::find($ebookId);
        $bundle = CourseEbook::find($bundleId);
        $diskonKelas = DiskonKelas::all();
        return view('member.payment', [
            'course' => $course,
            'ebook' => $ebook,
            'bundle' => $bundle,
            'kelasDiskon' => $diskonKelas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'nullable|exists:tbl_courses,id',
            'ebook_id' => 'nullable|exists:tbl_ebooks,id',
            'bundle_id' => 'nullable|exists:tbl_course_ebooks,id',
            'price' => 'required|numeric',
            'termsCheck' => 'required|accepted',
        ]);
    
        $courseId = $request->input('course_id');
        $ebookId = $request->input('ebook_id');
        $bundleId = $request->input('bundle_id');
        $user = Auth::user();
        $transaction_code = 'NEMOLAB-' . strtoupper(Str::random(10));
    
        $name = '';
        $price = 0;
        $status = 'pending';

        $course = Course::find($courseId);
        $ebook = Ebook::find($ebookId);
        $bundle = CourseEbook::find($bundleId);
    
        if ($course) {
            $name = $course->name . ' (video)';
            $price = $course->price;
        }
        if ($ebook) {
            $name = $ebook->name . ' (eBook)';
            $price = $ebook->price;
        }
        if ($bundle) {
            $name = $bundle->course->name . ' (bundle)';
            $price = $bundle->price;
            $course_id = $bundle->course_id;
            $ebook_id = $bundle->ebook_id;
        }
    
        // Periksa jika kursus gratis
        if ($price == 0) {
            $status = 'success';
        }
    
        // Cek apakah transaksi sudah ada dan pending
        $checkTransaction = Transaction::where('course_id', $courseId)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();
    
        if (!isset($checkTransaction)) {
            if ($status == 'success') {
                Transaction::create([
                    'user_id' => $user->id,
                    'transaction_code' => $transaction_code,
                    'snap_token' => '',
                    'course_id' => $courseId,
                    'ebook_id' => $ebookId,
                    'bundle_id' => $bundleId,
                    'name' => $name,
                    'price' => $price,
                    'status' => $status,
                ]);
                // jika bundle maka otomatis mengisi ebook_id dan course_id sesuai dengan nilai dari tbl_course_ebooks
                if($bundle){
                    MyListCourse::create([
                        'user_id' => $user->id,
                        'course_id' => $course_id,
                        'ebook_id' => $ebook_id,
                    ]);
                }else{
                    MyListCourse::create([
                        'user_id' => $user->id,
                        'course_id' => $courseId,
                        'ebook_id' => $ebookId,
                    ]);
                }

    
                Alert::success('success', 'Kelas Berhasil Dibeli');
                return redirect()->route('member.course.join', $course->slug);
            } else {
                // Lakukan pemrosesan Midtrans jika belum sukses
                \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                \Midtrans\Config::$isProduction = env('MIDTRANS_PRODUCTION');
                \Midtrans\Config::$isSanitized = true;
                \Midtrans\Config::$is3ds = true;
    
                $params = [
                    'transaction_details' => [
                        'order_id' => $transaction_code,
                        'gross_amount' => intval($price),
                    ],
                    'customer_details' => [
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                ];
    
                $createdTransactionMidtrans = \Midtrans\Snap::createTransaction($params);
                $midtransRedirectUrl = $createdTransactionMidtrans->redirect_url;
    
                Transaction::create([
                    'user_id' => $user->id,
                    'transaction_code' => $transaction_code,
                    'snap_token' => $createdTransactionMidtrans->token,
                    'course_id' => $courseId,
                    'ebook_id' => $ebookId,
                    'name' => $name,
                    'price' => $price,
                    'status' => $status,
                ]);
    
                return redirect($midtransRedirectUrl);
            }
        } else {
            // Redirect ke transaksi pending sebelumnya jika ada
            $url = env('MIDTRANS_PRODUCTION') 
                ? "https://app.midtrans.com/snap/v4/redirection/{$checkTransaction->snap_token}" 
                : "https://app.sandbox.midtrans.com/snap/v4/redirection/{$checkTransaction->snap_token}";
    
            return redirect($url);
        }
    }
    
    

    public function checkout()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_PRODUCTION');
        $notif = new \Midtrans\Notification();

        $transactionStatus = $notif->transaction_status;
        $type = $notif->payment_type;
        $transaction_code = $notif->order_id;
        $fraudStatus = $notif->fraud_status;

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $status = 'success';
            }
        } elseif ($transactionStatus == 'settlement') {
            $status = 'success';
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $status = 'failed';
        } elseif ($transactionStatus == 'pending') {
            $status = 'pending';
        }

        $transaction = Transaction::where('transaction_code', $transaction_code)->first();
        $transaction->update(['status' => $status]);

        if ($status == 'success') {
            try {
                MyListCourse::create([
                    'user_id' => $transaction->user_id,
                    'course_id' => $transaction->course_id, // Pastikan ini valid
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to create MyListCourse: ' . $e->getMessage());
            }
        }
    }

    public function viewTransaction(Request $requests, $transaction_code)
    {
        $transaction = Transaction::where('transaction_code', $transaction_code)->first();

        $url = "https://app.sandbox.midtrans.com/snap/v4/redirection/$transaction->snap_token";
        if (env('MIDTRANS_PRODUCTION') === true) {
            $url = "https://app.midtrans.com/snap/v4/redirection/$transaction->snap_token";
        }

        return redirect()->to($url);
    }

    public function detailTransaction(Request $requests, $transaction_code)
    {
        $transaction = Transaction::where('transaction_code', $transaction_code)->first();
        if ($transaction) {
            if ($transaction->status == 'success' || $transaction->status == 'failed') {
                return view('member.dashboard.transaction.detail-payment', compact('transaction'));
            } else {
                Alert::error('Error', 'Maaf Anda Tidak Bisa Akses Detail Transaction, Status Anda Masih Pending!!!');
                return redirect()->route('member.transaction');
            }
        }

        return view('error.page404');
    }

    // public function callback() {
    //     $course = Course::where('id', $courseId)->first();
    //     return url('/course/join/' . $course->slug);
    // }

    // public function test()
    // {
    //     $client = new \GuzzleHttp\Client();

    //     try {
    //         $response = $client->request('GET', 'https://api.sandbox.midtrans.com/v2/NEMOLAB-RUAH0Z0ADU/status', [
    //             'headers' => [
    //                 'accept' => 'application/json',
    //                 'authorization' => 'Basic U0ItTWlkLXNlcnZlci1pNU9GbWpiR1ppSGc5cVBHVmg3MHdHcTI6',
    //             ],
    //         ]);

    //         $responseBody = $response->getBody()->getContents();
    //         $responseData = json_decode($responseBody, true); // Mengubah JSON menjadi array

    //         // Mengambil object transaction_status
    //         $transactionStatus = $responseData['transaction_status'];

    //         echo $transactionStatus;
    //     } catch (\GuzzleHttp\Exception\RequestException $e) {
    //         // Handle the exception, for example, log the error
    //         if ($e->hasResponse()) {
    //             $errorResponse = $e->getResponse()->getBody()->getContents();
    //             echo $errorResponse; // Show error response
    //         } else {
    //             echo $e->getMessage(); // Show the error message
    //         }
    //     }
    // }
}
