<?php

use App\Http\Controllers\Backend\TrainerController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\EsewaController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\InventoryController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\MemberProgressController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SalesController;
use App\Http\Controllers\Backend\ScheduleController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [FrontendController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get("/dashboard",[HomeController::class,'index'])->middleware(['auth', 'verified'])->name("dashboard");

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
    Route::post('/member/post', [MemberController::class, 'store'])->name('member.store');

    Route::get('/announcement', [NotificationController::class, 'index'])->name('announcement.index');
    Route::get('/announcement/create', [NotificationController::class, 'create'])->name('announcement.create');
    Route::post('/announcement/post', [NotificationController::class, 'store'])->name('announcement.store');
    Route::get('/announcement/{id}/edit', [NotificationController::class, 'edit'])->name('announcement.edit');
    Route::put('/announcement/{id}/update', [NotificationController::class, 'update'])->name('announcement.update');
    Route::delete('/announcement/{id}/delete', [NotificationController::class, 'delete'])->name('announcement.destroy');
    Route::post('/announcement/publish',[NotificationController::class, 'publish'])->name('announcement.publish');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/post', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.destroy');
    Route::post('/product/publish',[ProductController::class, 'publish'])->name('product.publish');


    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.check-in');
    Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.check-out');
    Route::get('member/attendance-list', [AttendanceController::class, 'memberList'])->name('member.attendance.list');
    
    Route::get('trainer/attendance', [AttendanceController::class, 'trainerIndex'])->name('trainer.attendance.index');
    Route::post('trainer/attendance/check-in', [AttendanceController::class, 'trainerCheckIn'])->name('trainer.attendance.check-in');
    Route::post('trainer/attendance/check-out', [AttendanceController::class, 'trainerCheckOut'])->name('trainer.attendance.check-out');
    
    Route::get('/users', [MemberController::class, 'register'])->name('user.register');
    Route::get('/user/register', [MemberController::class, 'registerCreate'])->name('user.register.create');
    Route::post('/user/register/store', [MemberController::class, 'registerStore'])->name('user.register.store');
    Route::post('/member/store', [MemberController::class, 'memberStore'])->name('user.member.store');
    Route::get('/make-member/{id}', [MemberController::class, 'getUser'])->name('user.member.get');
    Route::get('/get-membership', [MemberController::class, 'getMembership'])->name('get.membership');
    Route::post('/purchase-membership', [MemberController::class, 'esewaMembership'])->name('purchase.membership');

    Route::get('/success',[MemberController::class,'esewaPaySuccess'])->name('esewa.success');
    Route::get('/failure',[MemberController::class,'esewaPayFailed'])->name('esewa.failure');

    Route::get('/trainer', [TrainerController::class, 'index'])->name('trainer.index');
    Route::get('/trainer/create', [TrainerController::class, 'create'])->name('trainer.create');
    Route::post('/trainer/post', [TrainerController::class, 'store'])->name('trainer.store');
    Route::get('/trainer/{id}/edit', [TrainerController::class, 'edit'])->name('trainer.edit');
    Route::put('/trainer/{id}/update', [TrainerController::class, 'update'])->name('trainer.update');
    Route::delete('/trainer/{id}/delete', [TrainerController::class, 'delete'])->name('trainer.destroy');
    Route::post('/trainer/stauts',[TrainerController::class, 'publish'])->name('trainer.status');

    Route::get('/member-attendance/report',[ReportController::class, 'index'])->name('member.report.index');
    Route::get('/trainer-attendance/report',[ReportController::class, 'trainerIndex'])->name('trainer.report.index');
    Route::post('/get-member-attendance/report',[ReportController::class, 'getMemberAttendance'])->name('member.report');
    Route::post('/get-trainer-attendance/report',[ReportController::class, 'getTrainerAttendance'])->name('trainer.report');

    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/schedule/post', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/schedule/{id}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::put('/schedule/{id}/update', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{id}/delete', [ScheduleController::class, 'delete'])->name('schedule.destroy');

    /* Product autocomplete */
    Route::get('/product/autocomplete', [PurchaseController::class, 'autocomplete'])->name('product.autocomplete');
    Route::get('/order/getProductDetail', [PurchaseController::class, 'getProduct'])->name('purchase.order');
    Route::get('/sales/getProductDetail', [SalesController::class, 'getProduct'])->name('sales.order');

    Route::resource("banners", BannerController::class);
    Route::resource("progress", MemberProgressController::class);
    Route::resource("purchase", PurchaseController::class);
    Route::resource("sales", SalesController::class);

});

require __DIR__.'/auth.php';