<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\UsersDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 打刻ページの表示
Route::middleware('auth')->group(function () {
    Route::get('/', [WorkController::class, 'index']);
});

    // 勤務開始の処理
    Route::post('/work/start', [WorkController::class, 'startWork'])->name('work.start');
    // 勤務終了の処理
    Route::post('/work/end', [WorkController::class, 'endWork'])->name('work.end');
    // 休憩開始の処理
    Route::post('/rest/start', [RestController::class, 'startRest'])->name('rest.start');
    // 休憩終了の処理
    Route::post('/rest/end', [RestController::class, 'endRest'])->name('rest.end');

// 日付別勤怠ページの表示
Route::middleware('auth')->group(function () {
    Route::get('/attendance', [RestController::class, 'dateAttendance'])->name('show.data');
});

// ユーザー一覧表示
Route::middleware('auth')->group(function () {
    Route::get('/users', [UsersDataController::class, 'usersList'])->name('users.list');
});

Route::get('/users/data/{id}', [UsersDataController::class, 'usersData'])->name('users.data');
