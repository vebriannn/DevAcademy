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
        $perPage = $request->input('per_page', 10);
        if ($user->role === 'superadmin') {
            $ebooks = Ebook::paginate($perPage);
        } else {
            $ebooks = Ebook::where('mentor_id', $user->id)->paginate($perPage);
        }
        return view('admin.coursesebook.view', compact('ebooks'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.coursesebook.create', compact('category'));
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
            'source_ebook' => 'required|mimes:pdf|max:3000',
        ]);

        // Jika tipe ebook 'free', tetapkan harga menjadi 0
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }

        // Dapatkan nama asli file
        $getNameOriginal = $request->source_ebook->getClientOriginalName();
        // Buat nama baru untuk file
        $newNamePDF = Str::random(10) . '_' . $getNameOriginal;

        // Simpan file dengan nama baru
        $request->source_ebook->storeAs('public/file_pdf', $newNamePDF);

        // Simpan nama file ke validated data
        $validatedData['source_ebook'] = $newNamePDF;

        // Buat slug dari nama
        $validatedData['slug'] = Str::slug($validatedData['name']);
        // Dapatkan ID mentor dari pengguna yang login
        $validatedData['mentor_id'] = Auth::user()->id;

        // Buat entri ebook baru di database
        Ebook::create($validatedData);

        Alert::success('Success', 'eBook Berhasil Di Buat');
        return redirect()->route('admin.ebook');
    }

    public function edit(Ebook $ebook)
    {
        $category = Category::all();
        return view('admin.coursesebook.update', compact('ebook', 'category'));
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
        ]);

        // Jika tipe ebook 'free', harga harus 0
        if ($validatedData['type'] === 'free') {
            $validatedData['price'] = 0;
        }

        // Menyimpan file asli jika tidak ada file baru
        $validatedData['source_ebook'] = $ebook->source_ebook;

        // Jika ada file baru yang diunggah
        if ($request->hasFile('source_ebook')) {
            // Dapatkan nama asli file
            $getNameOriginal = $request->source_ebook->getClientOriginalName();
            // Buat nama baru untuk file dengan string acak
            $newNamePDF = Str::random(10) . '_' . $getNameOriginal;

            // Simpan file dengan nama baru di folder public/file_pdf
            $request->source_ebook->storeAs('storage/file_pdf/', $newNamePDF);
            Storage::delete('storage/file_pdf/' . $ebook->source_ebook);

            // Update nama file di validatedData
            $validatedData['source_ebook'] = $newNamePDF;
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

    public function destroy(Ebook $ebook)
    {
        $ebook->delete();
        Storage::delete('storage/file_pdf/' . $ebook->source_ebook);

        Alert::success('Success', 'eBook Berhasil Di Hapus');
        return redirect()->route('admin.ebook')->with('success', 'eBook deleted successfully.');
    }
}
