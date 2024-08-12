<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminLessonController;
use App\Http\Controllers\Admin\AdminToolsController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminMentorController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminSuperadminController;
use App\Http\Controllers\Admin\SubmissionController;

use App\Http\Controllers\Member\Auth\RegisterController;
use App\Http\Controllers\Member\LandingpageController;
use App\Http\Controllers\Member\Auth\LoginController;
use App\Http\Controllers\Member\MemberCourseController;
use App\Http\Controllers\Member\MemberPaymentController;
use App\Http\Controllers\Member\MemberTransactionController;
use App\Http\Controllers\Member\MemberReviewController;
use App\Http\Controllers\Member\MemberSettingController;

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

Route::get('/', [LandingpageController::class, 'index'])->name('home');

// login member
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/auth', [LoginController::class, 'login'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register/store', [RegisterController::class, 'register'])->name('register.auth');

// login admin 
Route::get('admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
Route::post('admin/login/auth', [AdminLoginController::class, 'login'])->name('admin.login.auth');
Route::get('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->group(function() {

    // Routes for tools
    Route::prefix('tools')->group(function() {
        Route::get('/', [AdminToolsController::class, 'index'])->name('admin.tools');
        Route::get('/create', [AdminToolsController::class, 'create'])->name('admin.tools.create');
        Route::post('/create/store', [AdminToolsController::class, 'store'])->name('admin.tools.create.store');
        Route::put('/edit/update/{id}', [AdminToolsController::class, 'update'])->name('admin.tools.edit.update');
        Route::get('/delete/{id}', [AdminToolsController::class, 'delete'])->name('admin.tools.delete');
    });
    
    // Routes for courses
    Route::prefix('course')->middleware('mentor')->group(function() {
        Route::get('/', [AdminCourseController::class, 'index'])->name('admin.course');
        Route::get('/create', [AdminCourseController::class, 'create'])->name('admin.course.create');
        Route::post('/create/store', [AdminCourseController::class, 'store'])->name('admin.course.create.store');
        Route::get('/edit/{id}', [AdminCourseController::class, 'edit'])->name('admin.course.edit');
        Route::put('/edit/update/{id}', [AdminCourseController::class, 'update'])->name('admin.course.edit.update');
        Route::get('/delete/{id}', [AdminCourseController::class, 'delete'])->name('admin.course.delete');

        // Routes for chapters
        Route::get('{slug}/chapter', [AdminChapterController::class, 'index'])->name('admin.chapter');
        Route::get('{slug}/chapter/create/{id_course}', [AdminChapterController::class, 'create'])->name('admin.chapter.create');
        Route::post('chapter/create/store/{id_course}', [AdminChapterController::class, 'store'])->name('admin.chapter.create.store');
        Route::get('{slug}/chapter/edit/{id_chapter}', [AdminChapterController::class, 'edit'])->name('admin.chapter.edit');
        Route::put('chapter/edit/update/{id_chapter}', [AdminChapterController::class, 'update'])->name('admin.chapter.edit.update');
        Route::get('chapter/delete/{id_chapter}', [AdminChapterController::class, 'delete'])->name('admin.chapter.delete');
        
        // Routes for lessons
        Route::get('{slug}/chapter/{id_chapter}/lesson', [AdminLessonController::class, 'index'])->name('admin.lesson');
        Route::get('{slug}/chapter/{id_chapter}/lesson/create', [AdminLessonController::class, 'create'])->name('admin.lesson.create');
        Route::post('chapter/{id_chapter}/lesson/create/store', [AdminLessonController::class, 'store'])->name('admin.lesson.create.store');
        Route::get('{slug}/chapter/{id_chapter}/lesson/edit/{id_lesson}', [AdminLessonController::class, 'edit'])->name('admin.lesson.edit');
        Route::put('chapter/lesson/edit/update/{id_lesson}', [AdminLessonController::class, 'update'])->name('admin.lesson.edit.update');
        Route::get('chapter/lesson/delete/{id_lesson}', [AdminLessonController::class, 'delete'])->name('admin.lesson.delete');
        });


    // Routes for users
    Route::prefix('user')->middleware('superadmin')->group(function() {
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.user');
        Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.create');
        Route::post('/create/store', [AdminUserController::class, 'store'])->name('admin.user.create.store');
        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/edit/update/{id}', [AdminUserController::class, 'update'])->name('admin.user.edit.update');
        Route::get('/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.user.delete');
        
        Route::prefix('member')->middleware('superadmin')->group(function() {
            Route::get('/', [AdminStudentController::class, 'index'])->name('admin.member');
            Route::get('/create', [AdminStudentController::class, 'create'])->name('admin.member.create');
            Route::post('/create/store', [AdminStudentController::class, 'store'])->name('admin.member.store');
            Route::get('/edit/{id}', [AdminStudentController::class, 'edit'])->name('admin.member.edit');
            Route::put('/edit/update/{id}', [AdminStudentController::class, 'update'])->name('admin.member.update');
            Route::get('/delete/{id}', [AdminStudentController::class, 'destroy'])->name('admin.member.destroy');
        });
        
        Route::prefix('mentor')->middleware('superadmin')->group(function() {
            Route::get('/', [AdminMentorController::class, 'index'])->name('admin.mentor');
            Route::get('/create', [AdminMentorController::class, 'create'])->name('admin.mentor.create');
            Route::post('/create/store', [AdminMentorController::class, 'store'])->name('admin.mentor.store');
            Route::get('/edit/{id}', [AdminMentorController::class, 'edit'])->name('admin.mentor.edit');
            Route::put('/edit/update/{id}', [AdminMentorController::class, 'update'])->name('admin.mentor.update');
            Route::get('/delete/{id}', [AdminMentorController::class, 'destroy'])->name('admin.mentor.destroy');
        });
        Route::prefix('superadmin')->middleware('superadmin')->group(function() {
            Route::get('/', [AdminSuperadminController::class, 'index'])->name('admin.superadmin');
            Route::get('/create', [AdminSuperadminController::class, 'create'])->name('admin.superadmin.create');
            Route::post('/create/store', [AdminSuperadminController::class, 'store'])->name('admin.superadmin.store');
            Route::get('/edit/{id}', [AdminSuperadminController::class, 'edit'])->name('admin.superadmin.edit');
            Route::put('/edit/update/{id}', [AdminSuperadminController::class, 'update'])->name('admin.superadmin.update');
            Route::get('/delete/{id}', [AdminSuperadminController::class, 'destroy'])->name('admin.superadmin.destroy');
        });
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




Route::prefix('member')->middleware('student')->group(function() {
    
    Route::get('/course', [MemberCourseController::class, 'index'])->name('member.course');
    Route::get('/course/join/{slug}', [MemberCourseController::class, 'join'])->name('member.course.join');
    Route::get('/course/{slug}/play/episode/{episode}', [MemberCourseController::class, 'play'])->name('member.course.play');

    Route::prefix('reviews')->group(function() {
        Route::get('/', [MemberReviewController::class, 'index'])->name('member.reviews');
        Route::post('/store', [MemberReviewController::class, 'store'])->name('member.reviews.store');
        Route::get('/{id}', [MemberReviewController::class, 'show'])->name('member.reviews.show');
        Route::put('/{id}', [MemberReviewController::class, 'update'])->name('member.reviews.update');
        Route::delete('/{id}', [MemberReviewController::class, 'destroy'])->name('member.reviews.destroy');
    });
    // Dashboard
    Route::prefix('dashboard')->group(function() {
        // setting
        Route::prefix('setting')->group(function() {
            Route::get('/', [MemberSettingController::class, 'index'])->name('member.dashboard.setting');
            Route::get('/edit/profile/', [MemberSettingController::class, 'editProfile'])->name('member.dashboard.edit-profile');
            Route::post('/update/profile', [MemberSettingController::class, 'updateProfile'])->name('member.dashboard.update-profile');
            Route::get('/edit/password/', [MemberSettingController::class, 'editPassword'])->name('member.dashboard.edit-password');
            Route::post('/update/password', [MemberSettingController::class, 'updatePassword'])->name('member.dashboard.update-password');
        });
        Route::prefix('transaction')->group(function() {
            Route::get('/', [MemberTransactionController::class, 'index'])->name('member.dashboard.transaction');
            Route::delete('/cancel/{id}', [MemberTransactionController::class, 'cancel'])->name('member.transaction.cancel');
        });
    });

    Route::get('course/payment', [MemberPaymentController::class, 'index']);
});