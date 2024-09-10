<?php

namespace App\Http\Controllers\Member\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Portofolio;
use App\Models\User;

class MemberPortofolioController extends Controller
{
    public function index(Request $request) {
        $perPage = $request->get('entries', 10);
        $portofolio = Portofolio::where('user_id', Auth::user()->id)->paginate($perPage);
        return view('member.dashboard.portofolio.view', compact('portofolio'));
    }

    public function create() {
        return view('member.dashboard.portofolio.create');
    }

    public function store(Request $requests) {
        $requests->validate([
            'name' => 'required',
            'link' => 'required',
            'description' => 'required',
            'status' => 'check',
        ]);

        $data = $requests->except('_token');
        $data['user_id'] = Auth::user()->id;

        $porto = Portofolio::create($data);

        Alert::success('Success', 'Portofolio Berhasil Di Buat');
        return redirect()->route('member.portofolio');
    } 

    public function edit($id) {
        $porto = Portofolio::where('id', $id)->first();

        return view('member.dashboard.portofolio.edit', compact('porto'));
    }

    public function update(Request $requests, $id) {
        $requests->validate([
            'name' => 'required',
            'link' => 'required',
            'description' => 'required',
        ]);

        $data = $requests->except('_token');
        $porto = Portofolio::findOrFail($id)->first();
        $porto->update($data);

        Alert::success('Success', 'Portofolio Berhasil Di Update');
        return redirect()->route('member.portofolio');
    } 

    public function delete($id) {
        $porto = Portofolio::where('id', $id)->first();
        $porto->delete();
    
        Alert::success('Success', 'Portofolio Berhasil Di Hapus');
        return redirect()->route('member.portofolio');
    }
}