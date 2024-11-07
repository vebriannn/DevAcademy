<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Category;

class AdminEbookController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'superadmin') {
            $ebooks = Ebook::all();
        } else {
            $ebooks = Ebook::where('mentor_id', $user->id)->get();
        }
        return view('admin.course-ebook.view', compact('ebooks'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.course-ebook.create', compact('category'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|integer',
            'description' => 'required|string',
            'level' => 'required',
            'file_ebook' => 'required|mimes:pdf|max:5120',
        ]);

        // Jika tipe ebook 'free', tetapkan harga menjadi 0
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }

        // Dapatkan nama asli file
        $getNameOriginal = $request->file_ebook->getClientOriginalName();
        // Buat nama baru untuk file
        $newNamePDF = Str::random(10) . '_' . $getNameOriginal;

        // Simpan file dengan nama baru
        $request->file_ebook->storeAs('public/file_pdf', $newNamePDF);

        // Simpan nama file ke validated data
        $validatedData['file_ebook'] = $newNamePDF;

        // Buat slug dari nama
        $validatedData['slug'] = Str::slug($validatedData['name']);
        // Dapatkan ID mentor dari pengguna yang login
        $validatedData['mentor_id'] = Auth::user()->id;

        // Buat entri ebook baru di database
        Ebook::create($validatedData);

        Alert::success('Success', 'eBook Berhasil Di Buat');
        return redirect()->route('admin.ebook');
    }

    public function edit(Request $requests)
    {
        // id course
        $id = $requests->query('id');
        $ebooks = Ebook::where('id', $id)->first();
        return view('admin.course-ebook.update', compact('ebooks'));
    }

    public function update(Request $request, Ebook $ebook)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|integer',
            'description' => 'required|string',
            'level' => 'required',
        ]);

        // Jika tipe ebook 'free', harga harus 0
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }

        // Menyimpan file asli jika tidak ada file baru
        $validatedData['file_ebook'] = $ebook->file_ebook;

        // Jika ada file baru yang diunggah
        if ($request->hasFile('file_ebook')) {
            $request->validate(['file_ebook' => 'required|mimes:pdf|max:5120']);
            // Dapatkan nama asli file
            $getNameOriginal = $request->file_ebook->getClientOriginalName();
            // Buat nama baru untuk file dengan string acak
            $newNamePDF = Str::random(10) . '_' . $getNameOriginal;

            // Simpan file dengan nama baru di folder public/file_pdf
            $request->file_ebook->storeAs('storage/file_pdf/', $newNamePDF);
            Storage::delete('storage/file_pdf/' . $ebook->file_ebook);

            // Update nama file di validatedData
            $validatedData['file_ebook'] = $newNamePDF;
        }

        // Buat slug dari nama eBook
        $validatedData['slug'] = Str::slug($validatedData['name']);

        // Update data eBook di database
        $ebook->update($validatedData);

        // Tampilkan pesan sukses
        Alert::success('Success', 'eBook Berhasil Di Update');

        // Redirect ke halaman ebook admin
        return redirect()->route('admin.ebook');
    }

    public function delete(Request $requests)
    {
        // id course
        $id = $requests->query('id');
        $ebook = Ebook::where('id', $id)->first();
        $ebook->delete();
        Storage::delete('public/file_pdf/' . $ebook->file_ebook);

        Alert::success('Success', 'eBook Berhasil Di Hapus');
        return redirect()->route('admin.ebook');
    }
}
