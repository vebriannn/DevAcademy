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

Route::prefix('admin')->group(function() {

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

    // Route::group(['middleware' => 'student'], function () {
    //     Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    // });
    
    // Route::group(['middleware' => 'mentor'], function () {
    //     Route::get('/mentor/dashboard', [MentorController::class, 'index'])->name('mentor.dashboard');
    // });
    
    // Route::group(['middleware' => 'superadmin'], function () {
    //     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // });
    
});

Route::get('/', function () {
    return view('index');
});
