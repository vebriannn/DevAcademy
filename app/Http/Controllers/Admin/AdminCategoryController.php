<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        return view('admin.category.view', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $check = Category::where('name', strtolower($request->name))->first();

        if(!$check) {
            $category = Category::create([
                'name' => $request->name,
            ]);

            Alert::success('Success', 'Kategori Berhasil Di Buat');
        } else {
            Alert::error('Error', 'Maaf Kategori Sudah Pernah Dibuat!');
            return redirect()->route('admin.category.create');
        }

        return redirect()->route('admin.category');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.update', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id)->first();

        if($category->name == $request->name) {
            $category->update([
                'name' => $request->name,
            ]);

            Alert::success('Berhasil', 'Kategori Berhasil Di Ubah');
        }
        else {
            $check = Category::where('name', $request->name)->first();
            if(!$check) {
                $category->update([
                    'name' => $request->name,
                ]);

                Alert::success('Berhasil', 'Kategori Berhasil Di Ubah');
            }
            else {
                Alert::error('Gagal', 'Maaf Kategori Sudah Pernah Dibuat!');
                return redirect()->route('admin.category.edit', $id);
            }
        }

        return redirect()->route('admin.category');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        Alert::success('Berhasil', 'Berhasil Berhasil Di Hapus');
        return redirect()->route('admin.category');
    }
}
