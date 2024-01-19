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

        $attendances = DB::table('rests')
        ->rightJoin('works', 'rests.work_id', '=', 'works.id')
        ->join('users', 'works.user_id', '=', 'users.id')
        ->where('user_id', $id)
        ->paginate(5);

    return view('auth/users_data', compact('attendances', 'id'));
    }
}

