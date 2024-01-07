<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class RestController extends Controller
{
    // 出勤していないと休憩できない
    // 出勤していれば何回でも休憩できる
    // 休憩を開始しないと休憩終了はクリックできない
    // 0時になった地点で休憩中の場合→休憩終了・勤務終了して、翌日の勤務を開始し、休憩を開始する


    // 休憩開始をクリック
    public function startRest(Request $request, Work $work) {
        $today = Carbon::today();
        $work_id = Work::where('user_id', auth()->id())->whereDate('date', $today)->max('id');
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
    // $oldTimeIn = Work::where('user_id', auth()->id())->whereDate('date', $today)->latest()->first();
        // Workモデルからデータを取得
        // $today_works = Work::where('user_id', auth()->id())->whereDate('date', $today)->get();
        // 今日のデータを抜き出す
        // 抜き出したものからwork_idを抜き出す
    // その日出勤していたら→日付と休憩開始の時間を保存
    // その日出勤していなければ→エラーを出す
    // 休憩終了前に次の日になったら自動で次の日付で休憩にする



    // 休憩終了をクリック
    public function endRest(Request $request, Rest $rest) {

        
        // $restの中から$work_idを抜きだす

        // 抜き出した＄work_idをログイン中の人のものだけに絞る
        // 絞った中で最新のものを使用する
        $today = Carbon::today()->format('Y-m-d');
        // ログインユーザーの最新のwork_idを取得
        $work_id = Work::where('user_id', auth()->id())->whereDate('date', $today)->max('id');
        // ログインユーザーの最新のwork_idの中で1番最近のrestレコードを取得
        $oldBreakIn = Rest::where('work_id', $work_id)->latest()->first();
        $restOutTime = Carbon::now();
        $attendance = new Rest;
        $rest_end = $oldBreakIn->update([
            'work_id' => $oldBreakIn->work_id,
            'date' => $oldBreakIn->date,
            'rest_start' => $oldBreakIn->rest_start,
            'rest_end' => $restOutTime->format('H:i:s'),
        ]);

        return back()->withInput($request->all())->with('message', '休憩を終了しました');

    }
    // 休憩開始を押した状態になっていれば→休憩終了の時間を保存
    // 休憩開始を押した状態でなければ→エラーを出す

    // 日付別勤怠ページの日付部分を表示するためのメソッド
    // public function showDate(Request $request, Work $work) {
        
    //     // ＊＊これが選択できる全ての日付ということになる＊＊
    //     $workDays = Work::select('date')->get();
    //     // 日付一覧へのアクセスであれば、todayを表示
    //     $selectedDate = Carbon::today($workDays->date);
    //     $previousDate = $selectedDate->copy()->subDay();
    //     $nextDate = $selectedDate->copy()->addDay();
    //     // PreにはsubDay,NextにはaddDayを設定する
    //     // そこから進んだ場合はその中でセレクトされた日付を表示する
    //     $selectedDate = Carbon::parse($workDays->date);
    //     $previousDate = $selectedDate->copy()->subDay();
    //     $nextDate = $selectedDate->copy()->addDay();
    //     // PreにはsubDay,NextにはaddDayを設定する
        
    //     dd($workDays);

        

    //     return view('/auth.attendance')->with([
    //         'workDays' => $workDays,
    //         'selectedDate' => $selectedDate,
    //         'previousDate' => $previousDate,
    //         'nextDate' => $nextDate,
    //     ]);
    // }
    

    // 日付別勤怠ページに勤怠データを表示する
    public function dateAttendance(Request $request, Work $work) {
        $works = Work::Paginate(5);

        if (is_null($request->date)) {
            $selectDay = Carbon::today();
            $previous = Carbon::yesterday();
            $next = Carbon::tomorrow();
        } else {
            $selectDay = new Carbon($request->date);
            $previous = (new Carbon($request->date))->subDay();
            $next = (new Carbon($request->date))->addDay();
        }

        // foreach ($works as $work) {

        // }

        // // $selectDayをキーにして下記を取得
        // // 名前
        // $user_name = 
        // // 勤務開始

        // 勤務終了

        // 休憩時間

        // 合計勤務時間

        // workテーブルからworkの情報を全て取得する
        // $workAllData = Work::all()->get();



        // ***日付表示部分ではworksテーブルの中のdateのデータのみを使用
        // $workDays = Work::select('date')->get();
        // foreach ($workDays as $workDay) {
        //     $selectDay = $workDay;
        //     $previousDay = $selectDay->subDay();
        //     $nextDay = $selectDay->addDay();
        // }
        // $latestWork = Work::select('date')->orderBy('date', 'desc')->first();
        // // $selectDay = $works->latest('date')->first();
        // // // selectDayはクリックされるごとに増やす減らすを行う必要がある
        // $selectDay = $latestWork->date;
        // $previous=Work::whereDate('date', '<', $selectDays)->orderBy('date', 'desc')->first();
        // $next=Work::whereDate('date', '>', $selectDays)->orderBy('date')->first();


        // ***内容表示するテーブルではworksテーブルの内容を使用
        // ユーザー名はwork_idを使用しuserテーブルから取得
        // 勤務開始、勤務終了は$workAllDataから取り出す
        // 休憩時間は日毎の休憩時間合計をrestsテーブルからデータを取得して計算
        // 勤務合計時間は勤務終了ー勤務開始ー休憩時間で計算


        // $previous = $selectDay->copy()->subDay();
        // $next = $selectDay->copy()->addDay();
        // $selectedDate = Carbon::today();
        // $previousDate = $selectedDate->copy()->subDay();
        // $nextDate = $selectedDate->copy()->addDay();
        // 日付のボタン
        // $dates = Work::select('date')->simplePaginate(1)
        // ページネーション
        // $attendances = Work::paginate(5);

        return view('/auth.attendance', compact('works', 'selectDay', 'previous', 'next'));
        // $today = Carbon::today();
        // $yesterday = Carbon::yesterday();
        // $tomorrow = Carbon::tomorrow();
        //     if (is_null($work->date)) {
        //         $today = Carbon::today();
        //         $yesterday = Carbon::yesterday();
        //         $tomorrow = Carbon::tomorrow();
        //     } else {
        //         $today = new Carbon($request->date);
        //         $yesterday = (new Carbon($request->date))->subDay();
        //         $tomorrow = (new Carbon($request->date))->addDay();
        //     }
        // return view('auth.attendance')->with([
        //     'dates' =>$dates,
        //     'today' => $today,
        //     'yesterday' => $yesterday,
        //     'tomorrow' => $tomorrow,
        //     'attendances' => $attendances,
        // ]);
    }
    // 日付ごとに表示される
    // 各ページ5件ずつ
}
