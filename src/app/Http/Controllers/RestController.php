<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rest;
use App\Models\Work;
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

        return view('auth.index')->withInput($request->all())->with('message', '休憩を開始しました');

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

        if ($oldRestDate == $today) {
            $rest_end = $oldRest->update([
            'work_id' => $oldRest->work_id,
            'date' => $oldRest->date,
            'rest_start' => $oldRest->rest_start,
            'rest_end' => $restOutTime->format('H:i:s'),
            ]);

            session(['startRest' => false]);
            session()->forget('startRest');

            return back()->withInput($request->all())->with('message', '休憩を終了しました');

        } elseif ($oldRestDate == $yesterday) {
            $special_rest_end_update = $oldRest->update([
            'work_id' => $oldRest->work_id,
            'date' => $oldRest->date,
            'rest_start' => $oldRest->rest_start,
            'rest_end' => '24:00:00',
            ]);

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

        $rests = Rest::whereDate('date', $selectDay)->Paginate(5);

        return view('/auth.attendance', compact('rests', 'selectDay', 'previous', 'next'));
    }
}
