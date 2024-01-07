<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Work;

class UsersDataController extends Controller
{
    // ＊＊ユーザー一覧ページ表示＊＊
    public function usersList() {
        $users = User::Paginate(5);
        return view('auth/users', compact('users'));
    }

    // ＊＊選択したユーザーのみの記録を表示＊＊
    // ユーザー名をクリックしたら選択されたユーザーのみのデータを取得する
    public function usersData(Work $work) {
        $works = Work::all();
        $user_id = $work->user_id;
        return view('auth/users_data', compact('works', 'user_id'));
    }
}
