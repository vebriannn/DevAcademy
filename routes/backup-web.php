<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminLessonController;
use App\Http\Controllers\Admin\AdminToolsController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Member\AdminSettingController;
use App\Http\Controllers\Admin\AdminEbookController;
use App\Http\Controllers\Admin\AdminCourseEbookController;
use App\Http\Controllers\Admin\AdminForumController;
use App\Http\Controllers\Admin\AdminMentorController;
use App\Http\Controllers\Admin\AdminPortofolioController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminSuperadminController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminSubmissionController;

use App\Http\Controllers\Member\Auth\MemberRegisterController;
use App\Http\Controllers\Member\Auth\MemberLoginController;
use App\Http\Controllers\Member\LandingpageController;
use App\Http\Controllers\Member\MemberCourseController;
use App\Http\Controllers\Member\MemberPaymentController;
use App\Http\Controllers\Member\MemberTransactionController;
use App\Http\Controllers\Member\MemberReviewController;
use App\Http\Controllers\Member\MemberSettingController;
use App\Http\Controllers\Member\Dashboard\MemberMyCourseController;
use App\Http\Controllers\Member\Dashboard\MemberPortofolioController;
use App\Http\Controllers\Member\MemberEbookController;
use App\Http\Controllers\Member\MemberCommentController;
use App\Http\Controllers\Member\MemberWebhookTransactionsController;

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

Route::middleware('maintenance.middleware')->group(function () {
    Route::get('/', [LandingpageController::class, 'index'])->name('home');

    // login member
    Route::get('login', [MemberLoginController::class, 'index'])->name('member.login');
    Route::post('login/auth', [MemberLoginController::class, 'login'])->name('member.login.auth');
    Route::get('logout', [MemberLoginController::class, 'logout'])->name('member.logout');
    Route::get('register', [MemberRegisterController::class, 'index'])->name('member.register');
    Route::post('register/store', [MemberRegisterController::class, 'store'])->name('member.register.auth');

    Route::prefix('admin')->group(function () {
        // login admin
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('login/auth', [AdminLoginController::class, 'login'])->name('admin.login.auth');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::get('/testo', [LandingpageController::class, 'tes'])->name('tes');
        Route::get('/', [LandingpageController::class, 'index'])->name('home');

        // login member
        Route::get('/login', [MemberLoginController::class, 'index'])->name('member.login');
        Route::post('/login/auth', [MemberLoginController::class, 'login'])->name('member.login.auth');
        Route::get('/logout', [MemberLoginController::class, 'logout'])->name('member.logout');
        Route::get('/register', [MemberRegisterController::class, 'index'])->name('member.register');
        Route::post('/register/store', [MemberRegisterController::class, 'store'])->name('member.register.store');
        Route::get('/register/profile', [MemberRegisterController::class, 'profileForm'])->name('member.register.profile');
        Route::post('/register/profile/store', [MemberRegisterController::class, 'storeProfile'])->name('member.register.profile.store');

        // Routes for lessons
        Route::get('{slug}/chapter/{id_chapter}/lesson', [AdminLessonController::class, 'index'])->name('admin.lesson');
        Route::get('{slug}/chapter/{id_chapter}/lesson/create', [AdminLessonController::class, 'create'])->name('admin.lesson.create');
        Route::post('chapter/{id_chapter}/lesson/create/store', [AdminLessonController::class, 'store'])->name('admin.lesson.create.store');
        Route::get('{slug}/chapter/{id_chapter}/lesson/edit/{id_lesson}', [AdminLessonController::class, 'edit'])->name('admin.lesson.edit');
        Route::put('chapter/lesson/edit/update/{id_lesson}', [AdminLessonController::class, 'update'])->name('admin.lesson.edit.update');
        Route::get('chapter/lesson/delete/{id_lesson}', [AdminLessonController::class, 'delete'])->name('admin.lesson.delete');

        Route::prefix('transaction')->group(function () {
            Route::get('/', [AdminTransactionController::class, 'index'])->name('admin.transaction');
            Route::post('transactions/{id}/accept', [AdminTransactionController::class, 'accept'])->name('admin.transactions.accept');
            Route::delete('transactions/{id}/cancel', [AdminTransactionController::class, 'cancel'])->name('admin.transactions.cancel');
        });
    });

    // routes for Ebook
    Route::prefix('ebook')->group(function () {
        Route::get('/', [AdminEbookController::class, 'index'])->name('admin.ebook');
        Route::get('/create', [AdminEbookController::class, 'create'])->name('admin.ebook.create');
        Route::post('/store', [AdminEbookController::class, 'store'])->name('admin.ebook.create.store');
        Route::get('/edit/{ebook}', [AdminEbookController::class, 'edit'])->name('admin.ebook.edit');
        Route::put('/update/{ebook}', [AdminEbookController::class, 'update'])->name('admin.ebook.edit.update');
        Route::get('/delete/{ebook}', [AdminEbookController::class, 'destroy'])->name('admin.ebook.delete');
    });

    // Routes for categories
    Route::prefix('category')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/create/store', [AdminCategoryController::class, 'store'])->name('admin.category.create.store');
        Route::get('/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/edit/update/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.edit.update');
        Route::get('/delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
    });

    // portofolio
    Route::prefix('portofolio')->group(function () {
        Route::get('/', [AdminPortofolioController::class, 'index'])->name('admin.portofolio');
        Route::put('/edit/update/{id}', [AdminPortofolioController::class, 'update'])->name('admin.portofolio.edit.update');
    });

    Route::prefix('paket-kelas')->group(function () {
        Route::get('/', [AdminCourseEbookController::class, 'index'])->name('admin.paket.kelas');
    });
});

// middeware superadmin
Route::middleware('superadmin')->group(function () {
    // routes atur  student
    Route::prefix('member')->group(function () {
        Route::get('/', [AdminStudentController::class, 'index'])->name('admin.member');
        Route::get('/create', [AdminStudentController::class, 'create'])->name('admin.member.create');
        Route::post('/create/store', [AdminStudentController::class, 'store'])->name('admin.member.store');
        Route::get('/edit/{id}', [AdminStudentController::class, 'edit'])->name('admin.member.edit');
        Route::put('/edit/update/{id}', [AdminStudentController::class, 'update'])->name('admin.member.update');
        Route::get('/delete/{id}', [AdminStudentController::class, 'destroy'])->name('admin.member.destroy');
    });

    // routes atur mentor
    Route::prefix('mentor')->group(function () {
        Route::get('/', [AdminMentorController::class, 'index'])->name('admin.mentor');
        Route::get('/create', [AdminMentorController::class, 'create'])->name('admin.mentor.create');
        Route::post('/create/store', [AdminMentorController::class, 'store'])->name('admin.mentor.store');
        Route::get('/edit/{id}', [AdminMentorController::class, 'edit'])->name('admin.mentor.edit');
        Route::put('/edit/update/{id}', [AdminMentorController::class, 'update'])->name('admin.mentor.update');
        Route::get('/delete/{id}', [AdminMentorController::class, 'destroy'])->name('admin.mentor.destroy');
    });

    // routes atur superadmin
    Route::prefix('superadmin')->group(function () {
        Route::get('/', [AdminSuperadminController::class, 'index'])->name('admin.superadmin');
        Route::get('/create', [AdminSuperadminController::class, 'create'])->name('admin.superadmin.create');
        Route::post('/create/store', [AdminSuperadminController::class, 'store'])->name('admin.superadmin.store');
        Route::get('/edit/{id}', [AdminSuperadminController::class, 'edit'])->name('admin.superadmin.edit');
        Route::put('/edit/update/{id}', [AdminSuperadminController::class, 'update'])->name('admin.superadmin.update');
        Route::get('/delete/{id}', [AdminSuperadminController::class, 'destroy'])->name('admin.superadmin.destroy');
    });

    // routes submission submissions
    Route::prefix('submission')->group(function () {
        Route::get('/', [AdminSubmissionController::class, 'index'])->name('admin.submissions');
        Route::put('/edit/update/{id}', [AdminSubmissionController::class, 'update'])->name('admin.submissions.edit.update');
        Route::get('/delete/{id}', [AdminSubmissionController::class, 'delete'])->name('admin.submissions.delete');
    });
});

Route::prefix('member')->group(function () {
    // list course
    Route::get('/course', [MemberCourseController::class, 'index'])->name('member.course');
    // check detail course
    Route::get('/course/join/{slug}', [MemberCourseController::class, 'join'])->name('member.course.join');

    // pengajuan member
    Route::post('/request/mentor/{id}', [MemberMyCourseController::class, 'reqMentor'])->name('member.pengajuan');

    Route::middleware('students')->group(function () {

        // course user
        Route::prefix('course')->group(function () {
            Route::get('{slug}/play/episode/{episode}', [MemberCourseController::class, 'play'])->name('member.course.play');
            Route::get('forum/{slug}', [MemberCommentController::class, 'index'])->name('member.forum');
            Route::get('forum/{slug}/search', [MemberCommentController::class, 'search'])->name('member.forum.search');
            Route::post('forum/{slug}/comment', [MemberCommentController::class, 'storeComment'])->name('member.forum.comment.store');
            Route::get('forum/replies/{comment_id}', [MemberCommentController::class, 'getReplies'])->name('member.forum.replies');
            Route::post('forum/reply/store', [MemberCommentController::class, 'storeReply'])->name('member.forum.reply.store');

            Route::get('payment', [MemberPaymentController::class, 'index'])->name('member.payment');
            Route::post('payment/store', [MemberPaymentController::class, 'store'])->name('member.transaction.store');
        });

        // review member
        Route::post('review/store', [MemberReviewController::class, 'store'])->name('member.review.store');

        // Dashboard
        Route::get('/', [MemberMyCourseController::class, 'index'])->name('member.dashboard');

        // route portofolio user
        Route::prefix('portofolio')->group(function () {
            Route::get('/', [MemberPortofolioController::class, 'index'])->name('member.portofolio');
            Route::get('/create', [MemberPortofolioController::class, 'create'])->name('member.portofolio.create');
            Route::post('/create/store', [MemberPortofolioController::class, 'store'])->name('member.portofolio.create.store');
            Route::get('/edit/{id}', [MemberPortofolioController::class, 'edit'])->name('member.portofolio.edit');
            Route::put('/edit/update/{id}', [MemberPortofolioController::class, 'update'])->name('member.portofolio.edit.update');
            Route::get('/delete/{id}', [MemberPortofolioController::class, 'delete'])->name('member.portofolio.delete');
        });

        Route::prefix('setting')->group(function () {
            Route::get('/', [MemberSettingController::class, 'index'])->name('member.setting');
            Route::get('/edit/profile/', [MemberSettingController::class, 'editProfile'])->name('member.edit-profile');
            Route::put('/update/profile', [MemberSettingController::class, 'updateProfile'])->name('member.update-profile');
            Route::get('/edit/password/', [MemberSettingController::class, 'editPassword'])->name('member.edit-password');
            Route::post('/update/password', [MemberSettingController::class, 'updatePassword'])->name('member.update-password');
        });

        // route transaction
        Route::prefix('transaction')->group(function () {
            Route::get('/', [MemberTransactionController::class, 'index'])->name('member.transaction');
            Route::delete('/cancel/{id}', [MemberTransactionController::class, 'cancel'])->name('member.transaction.cancel');

            Route::get('view/{transaction_code}', [MemberPaymentController::class, 'viewTransaction'])->name('member.transaction.view');
            Route::get('detail/{transaction_code}', [MemberPaymentController::class, 'detailTransaction'])->name('member.transaction.detail.view');
        });
    });

    Route::get('ebook', [MemberEbookController::class, 'index'])->name('member.ebook');
});

Route::view('/eror/pages', 'error.page404')->name('pages.error');

Route::get('/course', [MemberCourseController::class, 'index'])->name('member.course');
Route::get('/course/join/{slug}', [MemberCourseController::class, 'join'])->name('member.course.join');

Route::prefix('member')->middleware('student')->group(function () {

    // pengajuan member
    Route::post('/request/mentor/{id}', [MemberMyCourseController::class, 'reqMentor'])->name('member.pengajuan');

    Route::get('/course/{slug}/play/episode/{episode}', [MemberCourseController::class, 'play'])->name('member.course.play');
    Route::get('/course/detail/{slug}', [MemberCourseController::class, 'detail'])->name('member.course.detail');
    Route::get('/course/forum/{slug}', [MemberCommentController::class, 'index'])->name('member.forum');
    Route::get('/course/forum/{slug}/search', [MemberCommentController::class, 'search'])->name('member.forum.search');
    Route::post('/course/forum/{slug}/comment', [MemberCommentController::class, 'storeComment'])->name('member.forum.comment.store');
    Route::get('//forum/replies/{comment_id}', [MemberCommentController::class, 'getReplies'])->name('member.forum.replies');
    Route::post('/forum/reply/store', [MemberCommentController::class, 'storeReply'])->name('member.forum.reply.store');



    Route::prefix('review')->group(function () {
        Route::get('/', [MemberReviewController::class, 'index'])->name('member.reviews');
        Route::post('/store', [MemberReviewController::class, 'store'])->name('member.review.store');
        Route::get('/{id}', [MemberReviewController::class, 'show'])->name('member.reviews.show');
        Route::put('/{id}', [MemberReviewController::class, 'update'])->name('member.reviews.update');
        Route::delete('/{id}', [MemberReviewController::class, 'destroy'])->name('member.reviews.destroy');
    });

    // Dashboard
    Route::get('/', [MemberMyCourseController::class, 'index'])->name('member.dashboard');

    Route::prefix('portofolio')->middleware('student')->group(function () {
        Route::get('/', [MemberPortofolioController::class, 'index'])->name('member.portofolio');
        Route::get('/create', [MemberPortofolioController::class, 'create'])->name('member.portofolio.create');
        Route::post('/create/store', [MemberPortofolioController::class, 'store'])->name('member.portofolio.create.store');
        Route::get('/edit/{id}', [MemberPortofolioController::class, 'edit'])->name('member.portofolio.edit');
        Route::put('/edit/update/{id}', [MemberPortofolioController::class, 'update'])->name('member.portofolio.edit.update');
        Route::get('/delete/{id}', [MemberPortofolioController::class, 'delete'])->name('member.portofolio.delete');
    });

    Route::prefix('setting')->group(function () {
        Route::get('/', [MemberSettingController::class, 'index'])->name('member.setting');
        Route::get('/edit/profile/', [MemberSettingController::class, 'editProfile'])->name('member.edit-profile');
        Route::put('/update/profile', [MemberSettingController::class, 'updateProfile'])->name('member.update-profile');
        Route::get('/edit/password/', [MemberSettingController::class, 'editPassword'])->name('member.edit-password');
        Route::get('/edit/email/', [MemberSettingController::class, 'editEmail'])->name('member.edit-email');
        Route::post('/member/update-email', [MemberSettingController::class, 'updateEmail'])->name('member.update-email');
        Route::post('/update/password', [MemberSettingController::class, 'updatePassword'])->name('member.update-password');
    });

    Route::prefix('transaction')->group(function () {
        Route::get('/', [MemberTransactionController::class, 'index'])->name('member.transaction');
        Route::delete('/cancel/{id}', [MemberTransactionController::class, 'cancel'])->name('member.transaction.cancel');
    });

    Route::get('/paymentsuccess', function () {
        return view('member.payment-succes'); // Nama view yang ingin ditampilkan
    });

    Route::get('/detailpayment', function () {
        return view('member.dashboard.transaction.detail-payment'); // Nama view yang ingin ditampilkan
    });

    Route::get('course/payment', [MemberPaymentController::class, 'index'])->name('member.payment');
    Route::post('course/payment/store', [MemberPaymentController::class, 'store'])->name('member.transaction.store');

    Route::get('/transaction/view/{id}', [MemberPaymentController::class, 'viewTransaction'])->name('member.transaction.view');
    // Route::get('/transaction/callback', [MemberPaymentController::class, 'callback'])->name('member.transaction.callback.view');
});


Route::view('/eror/pages', 'error.page404')->name('pages.error');
// Route::get('/test', [MemberPaymentController::class, 'test']);
