<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\DiskonKelas;

class AdminDiskonController extends Controller
{
    public function index()
    {
        $diskonKelas = DiskonKelas::all();
        return view('admin.diskon-kelas.view', compact('diskonKelas'));
    }

    public function create()
    {
        return view('admin.diskon-kelas.create');
    }

    public function store(Request $requests)
    {
        $requests->validate([
            'kode_diskon' => 'required',
            'rate_diskon' => 'required|numeric|min:0|max:100',
        ]);

        $diskon = DiskonKelas::where('kode_diskon', $requests->kode_diskon)->first();
        if (!$diskon) {
            DiskonKelas::create([
                'kode_diskon' => $requests->kode_diskon,
                'rate_diskon' => $requests->rate_diskon
            ]);
        } else {
            Alert::error('Error', 'Maaf Diskon Sudah Pernah Buat!');
            return redirect()->back();
        }

        Alert::success('Success', 'Diskon Berhasil Di Buat');
        return redirect()->route('admin.diskon-kelas');
    }

    public function edit(Request $requests)
    {
        $id = $requests->query('id');
        $diskon = DiskonKelas::where('id', $id)->first();
        return view('admin.diskon-kelas.update', compact('diskon'));
    }


    public function update(Request $requests, $id)
    {
        $requests->validate([
            'kode_diskon' => 'required',
            'rate_diskon' => 'required|numeric|min:0|max:100',
        ]);


        $diskon = DiskonKelas::where('id', $id)->first();

        $diskon->update([
            'kode_diskon' => $requests->kode_diskon,
            'rate_diskon' => $requests->rate_diskon
        ]);

        Alert::success('Success', 'Diskon Berhasil Di Update');
        return redirect()->route('admin.diskon-kelas');
    }



    public function delete(Request $requests)
    {
        $id = $requests->query('id');

        $diskon = DiskonKelas::where('id', $id)->first();

        $diskon->delete();
        Alert::success('Success', 'Diskon Berhasil Di Delete');
        return redirect()->route('admin.diskon-kelas');
    }
}
