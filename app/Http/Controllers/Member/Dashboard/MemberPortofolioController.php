<?php

namespace App\Http\Controllers\Member\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Portofolio;
use App\Models\User;

class MemberPortofolioController extends Controller
{
    public function index() {
        $portofolio = Portofolio::where('user_id', Auth::user()->id)->get(); 
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

        return response()->json([
            'message' => 'Portofolio created successfully',
            'data' => $porto
        ], 200);
    } 

    public function edit($id) {
        $porto = Portofolio::findOrFail($id)->first();

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

        return response()->json([
            'message' => 'Portofolio update successfully',
            'data' => $porto
        ], 200);
    } 

    public function delete($id) {
        $porto = Portofolio::findOrFail($id)->first();
        $porto->delete();
        
        return response()->json([
            'message' => 'Portofolio deleted successfully',
        ], 200);
    }
}