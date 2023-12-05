<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisteredUserRequest;
use App\Models\User;

class RegisteredUserController extends Controller
{
    // ユーザー新規登録ページ表示
    public function create() {
        return view('register');
    }

    // ユーザー新規登録処理
    public function store(RegisteredUserRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);

    }
}
