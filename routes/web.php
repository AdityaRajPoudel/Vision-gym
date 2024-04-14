<?php

use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\InventoryController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\NotificationController;
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

    Route::get('/product', [InventoryController::class, 'index'])->name('product.index');
    Route::get('/product/create', [InventoryController::class, 'create'])->name('product.create');
    Route::post('/product/post', [InventoryController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [InventoryController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}/update', [InventoryController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}/delete', [InventoryController::class, 'delete'])->name('product.destroy');
    Route::post('/product/publish',[InventoryController::class, 'publish'])->name('product.publish');


    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::Post('/attendance/check-in', [AttendanceController::class, 'CheckIn'])->name('attendance.checkIn');
    Route::Post('/attendance/check-out', [AttendanceController::class, 'CheckOut'])->name('attendance.checkOut');

    Route::get('/users', [MemberController::class, 'register'])->name('user.register');
    Route::get('/user/register', [MemberController::class, 'registerCreate'])->name('user.register.create');
    Route::post('/user/register/store', [MemberController::class, 'registerStore'])->name('user.register.store');

    // Route::post('/product/post', [InventoryController::class, 'store'])->name('product.store');
    // Route::get('/product/{id}/edit', [InventoryController::class, 'edit'])->name('product.edit');
    // Route::put('/product/{id}/update', [InventoryController::class, 'update'])->name('product.update');
    // Route::delete('/product/{id}/delete', [InventoryController::class, 'delete'])->name('product.destroy');
    // Route::post('/product/publish',[InventoryController::class, 'publish'])->name('product.publish');


});

require __DIR__.'/auth.php';
