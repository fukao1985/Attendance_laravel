<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class UsersDataController extends Controller
{
    // ユーザー一覧ページ表示
    public function usersList() {
        $users = User::Paginate(5);
        $works = Work::all();
        return view('auth/users', compact('users', 'works'));
    }

    // ユーザー個別勤怠ページ表示
    public function usersData(Request $request) {
        $id = $request->id;

        // if (is_null($request->date)) {
        //     $selectDay = Carbon::today();
        //     $previous = Carbon::yesterday();
        //     $next = Carbon::tomorrow();

        // } else {
        //     $selectDay = new Carbon($request->date);
        //     $previous = (new Carbon($request->date))->subDay();
        //     $next = (new Carbon($request->date))->addDay();
        // }

        $attendances = DB::table('rests')
        ->rightJoin('works', 'rests.work_id', '=', 'works.id')
        ->join('users', 'works.user_id', '=', 'users.id')
        // ->whereDate('works.date', $selectDay)
        ->where('user_id', $id)
        ->paginate(5);

        // $restsExist = Rest::whereDate('date', $selectDay)->get();

        // if ($restsExist) {
        //     $attendances = Work::join('users', 'works.user_id', '=', 'users.id')->join('rests', 'rests.work_id', '=', 'works.id')
        //     ->whereDate('works.date', $selectDay)
        //     ->where('user_id', $id)
        //     ->paginate(5);

        // } else {
        //     $attendances = Work::with('user')
        //     ->whereDate('date', $selectDay)
        //     ->where('user_id', $id)
        //     ->paginate(5);
        //     // $attendances = Work::with(['user', 'rests'])
        //     // ->whereDate('date', $selectDay)
        //     // ->where('user_id', $id)
        //     // ->paginate(5);
        // }

    // return view('auth/users_data', compact('attendances', 'selectDay', 'previous', 'next', 'id'));
    return view('auth/users_data', compact('attendances', 'id'));
    }
}

