<?php

namespace App\Http\Controllers\Admin\Sdm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class AdminSuperadminController extends Controller
{
    public function index(Request $request)
    {
        $superadmins = User::where('role', 'superadmin')->get();
        return view('admin.sdm.superadmin.view', compact('superadmins'));
    }
}
