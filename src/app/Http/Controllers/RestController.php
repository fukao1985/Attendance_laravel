<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Models\Work;
use Carbon\Carbon;

class RestController extends Controller
{
    
    // 出勤していないと休憩できない
    // 出勤していれば何回でも休憩できる
    // 休憩を開始しないと休憩終了はクリックできない
    // 0時になった地点で休憩中の場合→休憩終了・勤務終了して、翌日の勤務を開始し、休憩を開始する


    // 休憩開始をクリック
    public function startRest(Request $request) {
        $today = Carbon::today();
        $work_id = Work::where('user_id', auth()->id())->whereDate('id', $today)->get();
        $restInTime = Carbon::now();
        $attendance = new Rest;
        $rest_start = Rest::create([
            'work_id' => $work_id,
            'date' => $restInTime->format('Y-m-d'),
            'rest_start' => $restInTime->format('H:i:s'),
            'rest_end' => '',
        ]);

        return back()->withInput($request->all())->with('message', '休憩を開始しました');

    }
    // その日出勤していたら→日付と休憩開始の時間を保存
    // その日出勤していなければ→エラーを出す
    // 休憩終了前に次の日になったら自動で次の日付で休憩にする



    // 休憩終了をクリック
    public function endRest() {

    }
    // 休憩開始を押した状態になっていれば→休憩終了の時間を保存
    // 休憩開始を押した状態でなければ→エラーを出す


    // 日付別勤怠ページを表示する
    public function dateAttendance(Request $request) {
        return view('auth.attendance');
    }
    // 日付ごとに表示される
    // 各ページ5件ずつ
}
