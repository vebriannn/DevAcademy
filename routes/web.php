<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\AdminLessonController;
use App\Http\Controllers\Admin\AdminToolsController;

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

    // routes tools
    Route::prefix('tools')->group(function() {
        Route::get('/', [AdminToolsController::class, 'index'])->name('admin.tools');
        Route::post('/create/store', [AdminToolsController::class, 'store'])->name('admin.tools.create.store');
        Route::put('/edit/update/{id}', [AdminToolsController::class, 'update'])->name('admin.tools.edit.update');
        Route::get('/delete/{id}', [AdminToolsController::class, 'delete'])->name('admin.tools.delete');
    });
    
    // routes chapter
    Route::prefix('chapter')->group(function() {
        Route::get('/', [AdminChapterController::class, 'index'])->name('admin.chapter');
        Route::post('/create/store', [AdminChapterController::class, 'store'])->name('admin.chapter.create.store');
        Route::put('/edit/update/{id}', [AdminChapterController::class, 'update'])->name('admin.chapter.edit.update');
        Route::get('/delete/{id}', [AdminChapterController::class, 'delete'])->name('admin.chapter.delete');
    });
    
    // routes lesson
    Route::prefix('lesson')->group(function() {
        Route::get('/', [AdminLessonController::class, 'index'])->name('admin.lesson');
        Route::post('/create/store', [AdminLessonControLler::class, 'store'])->name('admin.lesson.create.store');
        Route::put('/edit/update/{id}', [AdminLessonController::class, 'update'])->name('admin.lesson.edit.update');
        Route::get('/delete/{id}', [AdminLessonController::class, 'delete'])->name('admin.chapter.delete');
    });
});