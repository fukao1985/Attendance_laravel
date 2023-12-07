<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;

class WorkController extends Controller
{
    // 打刻ページの表示
    public function index() {
        return view('auth.index');
    }

    // 勤務を開始していないと勤務終了をクリックできない
    // 0時になった地点で勤務中の場合→勤務終了して、翌日の勤務を開始する
}
