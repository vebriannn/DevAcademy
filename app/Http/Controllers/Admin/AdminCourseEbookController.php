<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Course;
use App\Models\Tools;


class AdminCourseEbookController extends Controller
{
    public function index(Request $requests) {
        $courses = Course::with('ebooks')->get();
        return view('admin.paketkelas.view', compact('courses'));
    }

    public function create() {

    }

    public function store() {

    }
}
