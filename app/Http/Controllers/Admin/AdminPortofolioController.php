<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Portofolio;
use App\Models\User;

class AdminPortofolioController extends Controller
{
    public function index() {
        $portofolio = Portofolio::select('tbl_portofolio.*', 'users.name as name_user')
        ->join('users', 'users.id', '=', 'tbl_portofolio.user_id')->get();

        return view('admin.portofolio.view', compact('portofolio'));
    }
    
    public function update(Request $requests, $id) {
        $requests->validate([
            'action' => 'required',
        ]);

        $porto = Portofolio::findOrFail($id)->first();
        
        if($requests->action == 'accepted') {
            $porto->update([
                'status' => 'accepted',
            ]);
        }
        else {
            $porto->update([
                'status' => 'deaccepted',
            ]);
        }

        return response()->json([
            'message' => 'Portofolio update successfully',
            'data' => $porto
        ], 200);
    } 
}