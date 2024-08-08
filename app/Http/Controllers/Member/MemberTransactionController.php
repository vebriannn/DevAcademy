<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberTransactionController extends Controller
{
    public function index(){
        return view('member.payment');
    }
}
