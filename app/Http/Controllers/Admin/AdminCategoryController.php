<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        // Cek apakah kategori sudah ada
        $check = Category::where('name', $request->name)->first();

        if ($check) {
            return redirect()->route('admin.category')->with('error', 'Maaf, Kategori sudah pernah dibuat');
        }

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category')->with('success', 'Kategori berhasil ditambahkan');
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

        $category = Category::findOrFail($id);

        // Cek apakah nama baru sudah digunakan oleh kategori lain
        $check = Category::where('name', $request->name)
            ->where('id', '!=', $id)
            ->first();

        if ($check) {
            return redirect()->route('admin.category', $id)->with('error', 'Maaf, Kategori sudah pernah dibuat!');
        }

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category')->with('success', 'Kategori berhasil diubah');
    }


    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Kategori berhasil dihapus');
    }
}
