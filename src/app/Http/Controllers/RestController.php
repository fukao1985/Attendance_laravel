<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Rest;
use App\Models\Work;
use App\Http\Controllers\WorkController;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class RestController extends Controller
{
    // 休憩開始をクリック
    public function startRest(Request $request, Rest $rest) {
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

        session(['startRest' => true]);
        if ($request->session()->has('startRest')) {
            $request->session()->put('startRest', 'true');
        }
        // $startRest = session('startRest');

        return view('auth.index')->with('message', '休憩を開始しました');

    }

    // 休憩終了をクリック
    public function endRest(Request $request, Rest $rest) {
        $today = Carbon::today()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $restOutTime = Carbon::now();
        $id = Auth::id();
        $oldRestId = User::find($id)->rests->max('id');
        $oldRest = Rest::find($oldRestId);
        $oldRestDate = $oldRest->date;
        $oldAttendance = Work::where('user_id', auth()->id())->latest()->first();
        $oldAttendanceDate = $oldAttendance->date;
        $workOutTime = Carbon::now();

        if ($oldRestDate == $today) {
            $rest_end = $oldRest->update([
            'work_id' => $oldRest->work_id,
            'date' => $oldRest->date,
            'rest_start' => $oldRest->rest_start,
            'rest_end' => $restOutTime->format('H:i:s'),
            ]);

            session(['startRest' => false]);
            session()->forget('startRest');
            // session()->forget('startRest');

            return view('auth.index')->with('message', '休憩を終了しました');

        } elseif ($oldRestDate == $yesterday) {
            $special_rest_end_update = $oldRest->update([
            'work_id' => $oldRest->work_id,
            'date' => $oldRest->date,
            'rest_start' => $oldRest->rest_start,
            'rest_end' => '24:00:00',
            ]);

            $special_work_end_update = $oldAttendance->update([
            'user_id' => $oldAttendance->user_id,
            'date' => $oldAttendanceDate,
            'work_start' => $oldAttendance->work_start,
            'work_end' => '24:00:00',
            ]);

            // $special_work_end_create = new Work;

            $special_work_start_create = Work::create([
            'user_id' => $id,
            'date' => $restOutTime->format('Y-m-d'),
            'work_start' => '00:00:00',
            'work_end' => '',
            ]);

            $updatedWorkId = Work::where('user_id', $id)->whereDate('date', $today)->max('id');

            $special_rest_end_create = Rest::create([
            'work_id' => $updatedWorkId,
            'date' => $restOutTime->format('Y-m-d'),
            'rest_start' => '00:00:00',
            'rest_end' => $restOutTime->format('H:i:s'),
            ]);

            session(['startRest' => false]);
            session()->forget('startRest');
            // session()->forget('startRest');

            return view('auth.index')->withInput($request->all())->with('message', '休憩を終了しました');
        }
    }

    // 日付別勤怠ページを表示する
    public function dateAttendance(Request $request, Work $work) {
        if (is_null($request->date)) {
            $selectDay = Carbon::today();
            $previous = Carbon::yesterday();
            $next = Carbon::tomorrow();

        } else {
            $selectDay = new Carbon($request->date);
            $previous = (new Carbon($request->date))->subDay();
            $next = (new Carbon($request->date))->addDay();
        }

        // $restsExist = Rest::whereDate('date', $selectDay)->get();

        // if ($restsExist) {
        //     $attendances = Work::join('users', 'works.user_id', '=', 'users.id')->join('rests', 'rests.work_id', '=', 'works.id')
        //     ->whereDate('works.date', $selectDay)
        //     ->paginate(5);

        // } else {
        //     $attendances = Work::with('user')
        //     ->whereDate('date', $selectDay)
        //     ->where('user_id', $id)
        //     ->paginate(5);

        // }

        $attendances = DB::table('rests')
        ->rightJoin('works', 'rests.work_id', '=', 'works.id')
        ->join('users', 'works.user_id', '=', 'users.id')
        ->whereDate('works.date', $selectDay)
        ->paginate(5);


        // $attendances = Work::with(['user', 'rests'])
            // ->whereDate('date', $selectDay)
            // ->where('user_id', $id)
            // ->paginate(5);
        // $attendances = Work::join('users', 'works.user_id', '=', 'users.id')->join('rests', 'rests.work_id', '=', 'works.id')->whereDate('works.date', $selectDay)->paginate(5);

    return view('/auth.attendance', compact('attendances', 'selectDay', 'previous', 'next'));
    }
}
