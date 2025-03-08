<?php

use Illuminate\Support\Facades\Route;

// member routes
use App\Http\Controllers\Member\Auth\MemberLoginController;
use App\Http\Controllers\Member\Auth\MemberRegisterController;
use App\Http\Controllers\Member\Auth\ResendEmailVerif as MemberResendEmailController;
use App\Http\Controllers\Member\Auth\forgotPassController as MemberForgotPassController;
use App\Http\Controllers\Member\Dashboard\MemberSettingController;
use App\Http\Controllers\Member\LandingpageController as MemberLandingPagesController;
use App\Http\Controllers\Member\Dashboard\MemberMyCourseController;
use App\Http\Controllers\Member\MemberPaymentController;
use App\Http\Controllers\Member\MemberTransactionController;
use App\Http\Controllers\Member\MemberReviewController;
use App\Http\Controllers\Member\MemberCourseController;

// admin routes
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminToolsController;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\AdminLessonController;
use App\Http\Controllers\Admin\AdminDiscountController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProfessionController;

// sdm pengguna
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminSuperadminController;
use App\Http\Controllers\Admin\AdminMentorController;

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


// route mainetanance
Route::get('/maintenance', function () {
    if (config('app.maintenance_mode') === true) {
        return view('error.maintenance'); // Menampilkan view 'pages/maintenance.blade.php'
    } else {
        return redirect()->route('home');
    }
})->name('pages.maintenance');


// menampilkan halaman maintenance jika website sedang dalam pengembangan (jika ingin mengaktifkan tinggal costum boolean true di env maintenance_mode)
Route::middleware('maintenance.middleware')->group(function () {

    Route::get('/', [MemberLandingPagesController::class, 'index'])->name('home')->middleware('cache.headers:public;max_age=31536000;etag');
    Route::view('/eror/pages', 'error.page404')->name('pages.error');

    Route::prefix('member')->group(function () {

        // member course
        Route::prefix('course')->group(function () {
            Route::get('/', [MemberCourseController::class, 'index'])->name('member.course')->middleware('cache.headers:public;max_age=31536000;etag');
            Route::get('join/{slug}', [MemberCourseController::class, 'join'])->name('member.course.join')->middleware(['students', 'verified']);
            Route::get('{slug}/play/episode/{episode}', [MemberCourseController::class, 'play'])->name('member.course.play')->middleware(['students', 'verified']);
            Route::get('detail/{slug}', [MemberCourseController::class, 'detail'])->name('member.course.detail')->middleware(['students', 'verified']);
            Route::get('detail/sertifikat/{slug}', [MemberCourseController::class, 'generateSertifikat'])->name('member.sertifikat')->middleware(['students', 'verified']);
        });
        Route::prefix('review')->middleware(['students', 'verified'])->group(function () {
            Route::get('{slug}', [MemberReviewController::class, 'index'])->name('member.review');
            Route::post('store', [MemberReviewController::class, 'store'])->name('member.review.store');
            Route::get('ebook/{slug}', [MemberReviewController::class, 'ebookFormReview'])->name('member.review.ebook');
            Route::post('ebook/store', [MemberReviewController::class, 'storeReviewEbook'])->name('member.review.ebook.store');
        });

        Route::prefix('payment')->middleware(['students', 'verified'])->group(function () {
            Route::get('payment/', [MemberPaymentController::class, 'index'])->name('member.payment');
            Route::post('payment/store', [MemberPaymentController::class, 'store'])->name('member.transaction.store');
        });

        // dashboard mycourse
        Route::get('/', [MemberMyCourseController::class, 'index'])->name('member.dashboard')->middleware(['students', 'verified']);
        // dashboard setting member
        Route::prefix('setting')->middleware(['students', 'verified'])->group(function () {
            Route::view('/', 'member.dashboard.setting.view')->name('member.setting');

            Route::view('profile', 'member.dashboard.setting.edit-profile')->name('member.setting.profile');
            Route::put('profile/updated', [MemberSettingController::class, 'updateProfile'])->name('member.setting.profile.updated');

            Route::view('change-email', 'member.dashboard.setting.edit-email')->name('member.setting.change-email');
            Route::put('change-email/updated', [MemberSettingController::class, 'updateEmail'])->name('member.setting.change-email.updated');

            Route::view('reset-password', 'member.dashboard.setting.edit-password')->name('member.setting.reset-password');
            Route::put('reset-password/updated', [MemberSettingController::class, 'updatePassword'])->name('member.setting.reset-password.updated');
        });

        // My transaction
        Route::prefix('transaction')->group(function () {
            Route::get('/', [MemberTransactionController::class, 'index'])->name('member.transaction');
            Route::delete('/cancel/{id}', [MemberTransactionController::class, 'cancel'])->name('member.transaction.cancel');
            Route::get('/detail/{transaction_code}', [MemberTransactionController::class, 'show'])->name('member.transaction.view-transaction');
        });


        Route::view('login', 'member.auth.login')->name('member.login');
        Route::post('login/auth', [MemberLoginController::class, 'login'])->name('member.login.auth');

        Route::view('register', 'member.auth.register')->name('member.register');
        Route::post('register/store', [MemberRegisterController::class, 'store'])->name('member.register.store');

        // logout
        Route::get('user/logout', [MemberLoginController::class, 'logout'])->name('member.logout');

        // route halaman send verified
        Route::get('email/verify', [MemberResendEmailController::class, 'index'])->middleware('students')->name('verification.notice');

        // resend email verified
        Route::post('email/verification-notification', [MemberResendEmailController::class, 'resend'])->middleware(['students', 'throttle:custom-limit'])->name('verification.send');

        // handler email verified
        Route::get('email/verify/{id}/{hash}', [MemberResendEmailController::class, 'handler'])->middleware(['students', 'signed'])->name('verification.verify');

        // route halaman send reset oassword
        Route::get('forget-password', [MemberForgotPassController::class, 'index'])->name('member.forget-password');

        Route::post('forget-password/check', [MemberForgotPassController::class, 'checkEmail'])->middleware(['throttle:custom-limit-reset-pw'])->name('member.forget-password.check');

        // kirim link reset password
        Route::get('/reset-password/{token}', [MemberForgotPassController::class, 'sendResetLinkPassword'])->name('password.reset');
        Route::post('/reset-password/updated', [MemberForgotPassController::class, 'resetPassword'])->name('member.reset-password.updated');
    });
});

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('login/auth', [AdminLoginController::class, 'login'])->name('admin.login.auth');
    Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // kelolah pengguna nemolab
    Route::prefix('data-users')->middleware(['superadmin', 'verified'])->group(function () {
        Route::prefix('student')->group(function () {
            Route::get('/', [AdminStudentController::class, 'index'])->name('admin.student');
            Route::get('/create', [AdminStudentController::class, 'create'])->name('admin.student.create');
            Route::post('/create/store', [AdminStudentController::class, 'store'])->name('admin.student.store');
            Route::get('/edit/', [AdminStudentController::class, 'edit'])->name('admin.student.edit');
            Route::put('/edit/update/{id}', [AdminStudentController::class, 'update'])->name('admin.student.update');
            Route::get('/delete/', [AdminStudentController::class, 'delete'])->name('admin.student.delete');
        });

        Route::prefix('mentor')->group(function () {
            Route::get('/', [AdminMentorController::class, 'index'])->name('admin.mentor');
            Route::get('/create', [AdminMentorController::class, 'create'])->name('admin.mentor.create');
            Route::post('/create/store', [AdminMentorController::class, 'store'])->name('admin.mentor.store');
            Route::get('/edit/', [AdminMentorController::class, 'edit'])->name('admin.mentor.edit');
            Route::put('/edit/update/{id}', [AdminMentorController::class, 'update'])->name('admin.mentor.update');
            Route::get('/delete/', [AdminMentorController::class, 'delete'])->name('admin.mentor.delete');
        });

        Route::prefix('superadmin')->group(function () {
            Route::get('/', [AdminSuperadminController::class, 'index'])->name('admin.superadmin');
            Route::get('/create', [AdminSuperadminController::class, 'create'])->name('admin.superadmin.create');
            Route::post('/create/store', [AdminSuperadminController::class, 'store'])->name('admin.superadmin.store');
            Route::get('/edit/', [AdminSuperadminController::class, 'edit'])->name('admin.superadmin.edit');
            Route::put('/edit/update/{id}', [AdminSuperadminController::class, 'update'])->name('admin.superadmin.update');
            Route::get('/delete/', [AdminSuperadminController::class, 'destroy'])->name('admin.superadmin.destroy');
        });
    });

    // mentor course
    Route::prefix('course')->middleware(['mentor', 'verified'])->group(function () {
        Route::get('/', [AdminCourseController::class, 'index'])->name('admin.course');

        Route::get('/create', [AdminCourseController::class, 'create'])->name('admin.course.create');
        Route::post('/create/store', [AdminCourseController::class, 'store'])->name('admin.course.create.store');
        Route::get('/edit/', [AdminCourseController::class, 'edit'])->name('admin.course.edit');
        Route::put('/edit/update/{id}', [AdminCourseController::class, 'update'])->name('admin.course.edit.update');
        Route::get('/delete/', [AdminCourseController::class, 'delete'])->name('admin.course.delete');

        // chapters
        Route::get('{slug_course}/chapters', [AdminChapterController::class, 'index'])->name('admin.chapter');
        Route::get('{slug_course}/chapters/create', [AdminChapterController::class, 'create'])->name('admin.chapter.create');
        Route::post('{slug_course}/chapters/create/store', [AdminChapterController::class, 'store'])->name('admin.chapter.create.store');
        Route::get('{slug_course}/chapters/edit/', [AdminChapterController::class, 'edit'])->name('admin.chapter.edit');
        Route::put('{slug_course}/chapters/edit/update/{id_chapter}', [AdminChapterController::class, 'update'])->name('admin.chapter.edit.update');
        Route::get('chapters/delete/', [AdminChapterController::class, 'delete'])->name('admin.chapter.delete');

        // lesson
        Route::get('{slug_course}/chapter/{id_chapter}/lesson', [AdminLessonController::class, 'index'])->name('admin.lesson');
        Route::get('{slug_course}/chapter/{id_chapter}/lesson/create', [AdminLessonController::class, 'create'])->name('admin.lesson.create');
        Route::post('chapter/{id_chapter}/lesson/create/store', [AdminLessonController::class, 'store'])->name('admin.lesson.create.store');
        Route::get('{slug_course}/chapter/{id_chapter}/lesson/edit/', [AdminLessonController::class, 'edit'])->name('admin.lesson.edit');
        Route::put('chapter/lesson/edit/update/{id_lesson}', [AdminLessonController::class, 'update'])->name('admin.lesson.edit.update');
        Route::get('chapter/lesson/delete/', [AdminLessonController::class, 'delete'])->name('admin.lesson.delete');
    });


    Route::prefix('tools')->middleware(['mentor', 'verified'])->group(function () {
        Route::get('/', [AdminToolsController::class, 'index'])->name('admin.tools');
        Route::get('/create', [AdminToolsController::class, 'create'])->name('admin.tools.create');
        Route::post('/create/store', [AdminToolsController::class, 'store'])->name('admin.tools.create.store');
        Route::get('/edit/{id}', [AdminToolsController::class, 'edit'])->name('admin.tools.edit');
        Route::put('/edit/update/{id}', [AdminToolsController::class, 'update'])->name('admin.tools.edit.update');
        Route::get('/delete/{id}', [AdminToolsController::class, 'delete'])->name('admin.tools.delete');
    });
});

// test non admin

Route::prefix('category')->group(function () {
    Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category');
    Route::get('/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/create/store', [AdminCategoryController::class, 'store'])->name('admin.category.create.store');
    Route::get('/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/edit/update/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.edit.update');
    Route::delete('/delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
});

Route::prefix('discount')->group(function () {
    Route::get('/', [AdminDiscountController::class, 'index'])->name('admin.discount');
    Route::get('/create', [AdminDiscountController::class, 'create'])->name('admin.discount.create');
    Route::post('/store', [AdminDiscountController::class, 'store'])->name('admin.discount.create.store');
    Route::get('/edit/{id}', [AdminDiscountController::class, 'edit'])->name('admin.discount.edit');
    Route::put('/update/{id}', [AdminDiscountController::class, 'update'])->name('admin.discount.edit.update');
    Route::delete('/delete/{id}', [AdminDiscountController::class, 'delete'])->name('admin.discount.delete');
});


Route::prefix('tools')->group(function () {
    Route::get('/', [AdminToolsController::class, 'index'])->name('admin.tools');
    Route::get('/create', [AdminToolsController::class, 'create'])->name('admin.tools.create');
    Route::post('/create/store', [AdminToolsController::class, 'store'])->name('admin.tools.create.store');
    Route::get('/edit/{id}', [AdminToolsController::class, 'edit'])->name('admin.tools.edit');
    Route::put('/edit/update/{id}', [AdminToolsController::class, 'update'])->name('admin.tools.edit.update');
    Route::delete('/delete/{id}', [AdminToolsController::class, 'delete'])->name('admin.tools.delete');
});

Route::prefix('profession')->group(function () {
    Route::get('/', [AdminProfessionController::class, 'index'])->name('admin.profession');
    Route::get('/create', [AdminProfessionController::class, 'create'])->name('admin.profession.create');
    Route::post('/create/store', [AdminProfessionController::class, 'store'])->name('admin.profession.create.store');
    Route::get('/edit/{id}', [AdminProfessionController::class, 'edit'])->name('admin.profession.edit');
    Route::put('/edit/update/{id}', [AdminProfessionController::class, 'update'])->name('admin.profession.edit.update');
    Route::delete('/delete/{id}', [AdminProfessionController::class, 'delete'])->name('admin.profession.delete');
});

Route::prefix('transaction')->group(function () {
    Route::get('/', [AdminTransactionController::class, 'index'])->name('admin.transaction');
    Route::put('/accept/{id}', [AdminTransactionController::class, 'accept'])->name('admin.transaction.accept');
    Route::put('/cancel/{id}', [AdminTransactionController::class, 'cancel'])->name('admin.transaction.cancel');
});
