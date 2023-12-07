@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('header')
<header class="header">
        <div class="header__inner">
            <h1 class="header__logo">Atte</h1>
        </div>
</header>
@endsection

@section('content')
<!-- <div class="main__content"> -->
    <div class="content__form">
        <div class="form-title">
            <h3 class="form-title-log">ログイン</h3>
        </div>
        <div class="form">
            <form class="form-box" action="/login" method="post">
            @csrf
                <div class="form-item">
                    <input type="email" name="email" class="form-control" placeholder="メールアドレス" value="{{ old('email') }}">
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-item">
                    <input type="password" name="password" class="form-control" placeholder="パスワード">
                    <div class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-item">
                    <button class="form-item-btn" type="submit">ログイン</button>
                </div>
                <div class="account-check">
                    <p class="account-check-message"> アカウントをお持ちでない方はこちらから</p>
                    <a class="account-check-register" href="/register">会員登録</a>
                </div>
            </form>
        </div>
    </div>
<!-- </div> -->
@endsection
