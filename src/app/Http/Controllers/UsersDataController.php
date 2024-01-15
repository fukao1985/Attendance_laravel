<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;
use Illuminate\Pagination\Paginator;

class UsersDataController extends Controller
{
    // ユーザー一覧ページ表示
    public function usersList() {
        $users = User::Paginate(5);
        $works = Work::all();
        return view('auth/users', compact('users', 'works'));
    }

    // 選択したユーザーのみの記録を表示
    public function usersData($id) {
        $rests = User::find($id)->rests->toQuery()->paginate(5);
        return view('auth/users_data', compact('rests'));
    }
}
