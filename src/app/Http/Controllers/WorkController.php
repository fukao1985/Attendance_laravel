<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Work;
use App\Models\User;
use App\Models\Rest;
use App\Http\Controllers\RestController;
use Carbon\Carbon;


class WorkController extends Controller
{
    // 打刻ページの表示
    public function index() {
        $id = Auth::id();
        $oldTimeIn = Work::where('user_id', auth()->id())->latest()->first();

        if (!$oldTimeIn) {
            return view('auth.index');

        } elseif ($oldTimeIn) {

            $today = Carbon::today();
            $oldTimeInDate = $oldTimeIn->date;
            $work_end = $oldTimeIn->work_end;

            // **休憩判定**
            $id = Auth::id();
            $oldRestId = User::find($id)->rests->max('id');
            $oldRest = Rest::find($oldRestId);
            $oldRestDate = $oldRest->date;
            $oldRestInTime = $oldRest->rest_start;

            // **勤務を開始したかどうかの判定**
            if (($oldTimeInDate == $today) && empty($work_end)) {
                $startWork = session(['startWork' => true]);
                session($startWork);

                if (($oldRestDate == $today) && isset($oldRestInTime) && empty($rest_end)) {
                    $startRest = session(['startRest' => true ]);
                    session($startRest);
                    return view('auth.index', compact('startWork', 'startRest'));

                    return view('auth.index', compact('startWork', 'startRest'));

                } else {
                    $startRest = session(['startRest' => false ]);
                    return view ('auth.index', compact('startWork', 'startRest'));

                    return view('auth.index', compact('startWork', 'startRest'));
                }

                return view('auth.index', compact('startWork', 'startRest'));

            } else {
                $startWork = session(['startWork' => false]);

                return view('auth.index', compact('startWork'));
            }
        }
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

        $startWork = session(['startWork' => true]);
        if ($request->session()->has('startWork')) {
            $request->session()->put('startWork', 'true');
        }

        return view('auth.index', compact('startWork'))->with('message', '勤務を開始しました');
    }

    // 勤務終了の処理
    public function endWork(Request $request, Work $work) {
        $id = Auth::id();
        $today = Carbon::today()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $oldAttendance = Work::where('user_id', auth()->id())->latest()->first();
        $oldAttendanceDate = $oldAttendance->date;
        $workOutTime = Carbon::now();

        if ($oldAttendanceDate == $today) {
            $work_end = $oldAttendance->update([
            'user_id' => $oldAttendance->user_id,
            'date' => $oldAttendanceDate,
            'work_start' => $oldAttendance->work_start,
            'work_end' => $workOutTime->format('H:i:s'),
            ]);

            session(['startWork' => false]);
            session()->forget('startWork');

            return view('auth.index')->with(
            [
                'message' => '勤務を終了しました',
                'status' => 'info'
            ]);

        } elseif ($oldAttendanceDate == $yesterday) {
            $special_work_end_update = $oldAttendance->update([
            'user_id' => $oldAttendance->user_id,
            'date' => $oldAttendanceDate,
            'work_start' => $oldAttendance->work_start,
            'work_end' => '24:00:00',
            ]);

            $special_work_end_create = Work::create([
            'user_id' => $id,
            'date' => $workOutTime->format('Y-m-d'),
            'work_start' => '00:00:00',
            'work_end' => $workOutTime->format('H:i:s'),
            ]);

            session(['startWork' => false]);
            session()->forget('startWork');

            return view('auth.index')->with(
            [
                'message' => '勤務を終了しました',
                'status' => 'info'
            ]);
        }
    }
}