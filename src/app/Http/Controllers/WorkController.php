<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Work;
use App\Models\User;
use Carbon\Carbon;


class WorkController extends Controller
{
    // 打刻ページの表示
    public function index() {
        return view('auth.index');
    }

    // 勤務開始打刻の処理
    public function startWork(Request $request) {
        $id = Auth::id();
        $workInTime = Carbon::now();
        $attendance = new Work;
        $work_start = Work::create([
            'user_id' => $id,
            'date' => $workInTime->format('Y-m-d'),
            'work_start' => $workInTime->format('H:i:s'),
            'work_end' => '',
        ]);

        

        $work_start = 'startWork';
        session(['startWork' => true]);

        return back()->withInput()->with([
            'message' => '勤務を開始しました',
            'status' => 'info'
        ]);
        // return back()->withInput($request->all())->with('message', '勤務を開始しました');
    }

    // 0時を跨ぐ際の処理
    // 23:59:59の時点で勤務中のユーザーを探す
    //勤務中のユーザーとはDBが下記の状態
    // work_end === 00:00:00
    // created_at === updated_at
    // 勤務中のユーザーがいれば、23:59:59で退勤処理 & 翌日の00:00:00で出勤処理をする



    // 勤務終了の処理
    public function endWork(Request $request, Work $work) {
        // 現在ログインしているユーザーを取得
        // dd($work);

        // $user = Auth::user();
        // $id = Auth::id();
        $today = Carbon::today()->format('Y-m-d');
        
        // // ログインしているユーザーが本日出勤した記録があるかの確認
        // ログインユーザーの最新レコードを取得
        $oldTimeIn = Work::where('user_id', auth()->id())->whereDate('date', $today)->latest()->first();
        // $oldTimeIn = $work->latest()->first();
        // 勤務終了を記録する
        // $id = Auth::id();
        $workOutTime = Carbon::now();
        $attendance = new Work;
        $work_end = $oldTimeIn->update([
            'user_id' => $oldTimeIn->user_id,
            'date' => $oldTimeIn->date,
            'work_start' => $oldTimeIn->work_start,
            'work_end' => $workOutTime->format('H:i:s'),
        ]);

        $work_start = 'startWork';
        session(['startWork' => false]);


        // session(['startWork' => false]);
        // $workStarted = $request->submit;
        // session(['flash.success' => false]);

        return back()->withInput()->with(
            [
                'message' => '勤務を終了しました',
                'status' => 'info'
        ]);
        // return back()->withInput($request->all())->with('message', '勤務を終了しました');
        
    }

}
    //     // ラジオボタンを押した処理を戻った際も表示させたい
    //     return back()->withInput()->with('message', '勤務を開始しました');
    // }

    // public function endWork(Request $request) {
    //     $workOutTime = Carbon::now();
    //     $attendance = new Work;
    //     Work::create([
    //         'work_end' => $workOutTime->format('H:i:s'),
    //     ]);

    //     return redirect()->with('message', '勤務を終了しました');
    // }





    // // // 勤務を開始していないと勤務終了をクリックできない
    // // // 0時になった地点で勤務中の場合→勤務終了して、翌日の勤務を開始する

    // // // 勤務開始をクリック
    // // // その日初めてなら→日付と勤務開始の時間を取得→保存
    // // public function startWork() {
    // //     // ユーザー情報を取得する
    // //     $user = Auth::user();
    // //     // そのユーザーのその日のWorkテーブルのデータを取得する
    // //     $today = Carbon::today();
    // //     $oldTimeIn = Work::whereDate('user_id', $today)->latest()->first();

    // //     if ($oldTimeIn) {

    // //     }


    // //     // // 勤務を開始できるのは1日1回のみ
    // //     // $oldWorkIn = Work::where('user_id', $user->id)->latest()->first();//1番最新の記録を取得する

    // //     // $oldDay = '';

    // //     // if($oldWorkStart) {
            
    // //     // }


    // //     }

    // //     $now = Carbon::now();
    // //     $date_format = $date->format('Y-m-d');
    // //     $time_format = $now->format('H:i:s');

        

        


    // //     return back()->with('message', '勤務を開始しました');
    // // }
    // // // その日2回目なら→エラーを出す
    // // // 勤務終了前に次の日になったら自動で次の日付でも出勤にする



    // // // 勤務終了をクリック
    // // public function endWork() {

    // //     return back()->with('massage', '勤務を終了しました');
    // // }
    // // // その日勤務開始を押したデータがあれば→勤務終了の時間を取得→保存
    // // // その日勤務開始を押したデータがなければ→エラーを出す
    // }
