<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\AdminLessonController;
use App\Http\Controllers\Admin\AdminToolsController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\SubmissionController;

use App\Http\Controllers\Member\Auth\RegisterController;
use App\Http\Controllers\Member\LandingpageController;
use App\Http\Controllers\Member\Auth\LoginController;
use App\Http\Controllers\Member\MemberCourseController as MemberMemberCourseController;
use App\Http\Controllers\Member\MemberTransactionController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\Member\MemberReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->middleware('role:superadmin')->group(function() {
    // Routes for tools
    Route::prefix('tools')->group(function() {
        Route::get('/', [AdminToolsController::class, 'index'])->name('admin.tools');
        Route::get('/create', [AdminToolsController::class, 'create'])->name('admin.tools.create');
        Route::post('/create/store', [AdminToolsController::class, 'store'])->name('admin.tools.create.store');
        Route::put('/edit/update/{id}', [AdminToolsController::class, 'update'])->name('admin.tools.edit.update');
        Route::get('/delete/{id}', [AdminToolsController::class, 'delete'])->name('admin.tools.delete');
    });
    // Routes for chapters
    Route::prefix('chapter')->group(function() {
        Route::get('/', [AdminChapterController::class, 'index'])->name('admin.chapter');
        Route::get('/create', [AdminChapterController::class, 'create'])->name('admin.chapter.create');
        Route::post('/create/store', [AdminChapterController::class, 'store'])->name('admin.chapter.create.store');
        Route::put('/edit/update/{id}', [AdminChapterController::class, 'update'])->name('admin.chapter.edit.update');
        Route::get('/delete/{id}', [AdminChapterController::class, 'delete'])->name('admin.chapter.delete');
    });
    // Routes for lessons
    Route::prefix('lesson')->group(function() {
        Route::get('/', [AdminLessonController::class, 'index'])->name('admin.lesson');
        Route::get('/create', [AdminLessonController::class, 'create'])->name('admin.lesson.create');
        Route::post('/create/store', [AdminLessonController::class, 'store'])->name('admin.lesson.create.store');
        Route::put('/edit/update/{id}', [AdminLessonController::class, 'update'])->name('admin.lesson.edit.update');
        Route::get('/delete/{id}', [AdminLessonController::class, 'delete'])->name('admin.lesson.delete');
    });
    // Routes for courses
    Route::prefix('course')->group(function() {
        Route::get('/', [AdminCourseController::class, 'index'])->name('admin.course');
        Route::post('/create/store', [AdminCourseController::class, 'store'])->name('admin.course.create.store');
        Route::put('/edit/update/{id}', [AdminCourseController::class, 'update'])->name('admin.course.edit.update');
        Route::get('/delete/{id}', [AdminCourseController::class, 'delete'])->name('admin.course.delete');
    });
    // Routes for users
    Route::prefix('user')->group(function() {
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.user');
        Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.create');
        Route::post('/create/store', [AdminUserController::class, 'store'])->name('admin.user.create.store');
        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/edit/update/{id}', [AdminUserController::class, 'update'])->name('admin.user.edit.update');
        Route::get('/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.user.delete');
    });
    // Routes for reviews
    Route::prefix('review')->group(function() {
        Route::get('/', [AdminReviewController::class, 'index'])->name('admin.review');
        Route::get('/create', [AdminReviewController::class, 'create'])->name('admin.review.create');
        Route::post('/create/store', [AdminReviewController::class, 'store'])->name('admin.review.create.store');
        Route::get('/edit/{id}', [AdminReviewController::class, 'edit'])->name('admin.review.edit');
        Route::put('/edit/update/{id}', [AdminReviewController::class, 'update'])->name('admin.review.edit.update');
        Route::get('/delete/{id}', [AdminReviewController::class, 'delete'])->name('admin.review.delete');
    });
    // Routes for categories
    Route::prefix('category')->group(function() {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/create/store', [AdminCategoryController::class, 'store'])->name('admin.category.create.store');
        Route::get('/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/edit/update/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.edit.update');
        Route::get('/delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
    });
    // Routes for submissions
    Route::prefix('submission')->group(function() {
        Route::get('/', [SubmissionController::class, 'index'])->name('admin.submissions');
        Route::get('/create', [SubmissionController::class, 'create'])->name('admin.submissions.create');
        Route::post('/create/store', [SubmissionController::class, 'store'])->name('admin.submissions.create.store');
        Route::get('/edit/{id}', [SubmissionController::class, 'edit'])->name('admin.submissions.edit');
        Route::put('/edit/update/{id}', [SubmissionController::class, 'update'])->name('admin.submissions.edit.update');
        Route::get('/delete/{id}', [SubmissionController::class, 'delete'])->name('admin.submissions.delete');
    });
});

Route::get('/', [LandingpageController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

 Route::get('/dashboard/setting', function(){
     return view('member.dashboard.setting');
 });

Route::get('/dashboard/mycourse', function(){
    return view('member.dashboard.myportofolio');
});

Route::get('/dashboard/classvideo', function(){
    return view('admin.data-mentor');
});

Route::get('/mentor', function(){
    return view('mentor.courses.courses-table');
});

Route::get('/admin/datamember', function(){
    return view('admin.member.data-member');
});

Route::get('/admin/datamentor', function(){
    return view('admin.mentor.data-mentor');
});

Route::get('/admin/datapengajuan', function(){
    return view('admin.pengajuanmentor.data-pengajuan-mentor');
});

Route::get('/admin/dataadmin', function(){
    return view('admin.datasuperadmin.data-superadmin');
});

Route::get('/admin/datacourse', function(){
    return view('admin.course.data-course');
});

Route::get('/admin/datalesson', function(){
    return view('admin.lesson.data-lesson');
});

Route::get('/admin/datachapter', function(){
    return view('admin.chapter.data-chapter');
});

Route::get('/admin/datacategory', function(){
    return view('admin.category.data-category');
});

Route::prefix('member')->middleware('role:students,mentor,superadmin')->group(function() {
    Route::get('/course', [MemberMemberCourseController::class, 'index'])->name('course');
    Route::get('/course/join', [MemberMemberCourseController::class, 'join']);
    Route::get('/course/play', [MemberMemberCourseController::class, 'play']);
    Route::get('/course/payment', [MemberTransactionController::class, 'index']);
    Route::get('/course/payment', [MemberTransactionController::class, 'index']);

    // Routes for reviews
    Route::prefix('reviews')->group(function() {
        Route::get('/', [MemberReviewController::class, 'index'])->name('member.reviews');
        Route::post('/store', [MemberReviewController::class, 'store'])->name('member.reviews.store');
        Route::get('/{id}', [MemberReviewController::class, 'show'])->name('member.reviews.show');
        Route::put('/{id}', [MemberReviewController::class, 'update'])->name('member.reviews.update');
        Route::delete('/{id}', [MemberReviewController::class, 'destroy'])->name('member.reviews.destroy');
    });
});

Route::get('/admin/dashboard', [SuperadminController::class, 'index'])->name('admin.dashboard')->middleware('auth', 'role:superadmin');
Route::get('/mentor/dashboard', [MentorController::class, 'index'])->name('mentor.dashboard')->middleware('auth', 'role:mentor');
Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard')->middleware('auth');
