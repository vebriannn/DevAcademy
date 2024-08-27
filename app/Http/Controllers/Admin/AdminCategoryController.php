<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10);
        $categories = Category::paginate($perPage);
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
            
            return response()->json([
                'message' => 'Category created successfully',
                'data' => $category
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf Kategori Yang Anda Inputkan Sudah Ada!'
                ], 201);
        }
        
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
    
            return response()->json([
                'message' => 'Category updated successfully',
                'data' => $category
            ], 200);
        }
        else {
            $check = Category::where('name', $request->name)->first();
            if(!$check) {
                $category->update([
                    'name' => $request->name,
                ]);
        
                return response()->json([
                    'message' => 'Category updated successfully',
                    'data' => $category
                ], 200);
            }
            else {
                return response()->json([
                    'message' => 'Maaf Kategori Yang Anda Inputkan Sudah Ada!',
                    'data' => $category
                ], 200);
            }
        }
        

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category
        ], 200);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ], 200);
    }
}