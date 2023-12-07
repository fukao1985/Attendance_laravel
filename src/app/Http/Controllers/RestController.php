<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;

class RestController extends Controller
{
    // 日付別勤怠ページの表示
    public function dateAttendance() {
        return view('auth.attendance');
    }

    // 出勤していないと休憩できない
    // 出勤していれば何回でも休憩できる
    // 休憩を開始しないと休憩終了はクリックできない
    // 0時になった地点で休憩中の場合→休憩終了・勤務終了して、翌日の勤務を開始し、休憩を開始する
}
