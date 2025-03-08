<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Discount;

class AdminDiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discount.view', compact('discounts'));
    }

    public function create()
    {
        return view('admin.discount.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_discount' => 'required',
            'rate_discount' => 'required|numeric|min:0|max:100',
        ]);

        // Cek apakah diskon dengan kode yang sama sudah ada
        $existingDiscount = Discount::where('code_discount', $request->code_discount)->first();

        if ($existingDiscount) {
            return redirect()->route('admin.discount')->with('error', 'Maaf, diskon dengan kode ini sudah ada.');
        }

        Discount::create([
            'code_discount' => $request->code_discount,
            'rate_discount' => $request->rate_discount,
        ]);

        return redirect()->route('admin.discount')->with('success', 'Diskon berhasil ditambahkan.');
    }


    public function edit(Request $requests, $id)
    {
        $discount = Discount::where('id', $id)->first();
        return view('admin.discount.update', compact('discount'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'code_discount' => 'required',
            'rate_discount' => 'required|numeric|min:0|max:100',
        ]);

        $discount = Discount::findOrFail($id);

        // Cek apakah kode diskon sudah ada dan bukan milik diskon yang sedang diupdate
        $existingDiscount = Discount::where('code_discount', $request->code_discount)
            ->where('id', '!=', $id)
            ->first();

        if ($existingDiscount) {
            return redirect()->route('admin.discount')->with('error', 'Maaf, kode diskon sudah digunakan.');
        }

        $discount->update([
            'code_discount' => $request->code_discount,
            'rate_discount' => $request->rate_discount,
        ]);

        return redirect()->route('admin.discount')->with('success', 'Diskon berhasil diubah.');
    }



    public function delete(Request $requests, $id)
    {
        $discount = Discount::where('id', $id)->first();

        $discount->delete();
        // Alert::success('Success', 'Diskon Berhasil Di Delete');
        return redirect()->route('admin.discount')->with('success', 'Diskon berhasil dihapus');
    }
}
