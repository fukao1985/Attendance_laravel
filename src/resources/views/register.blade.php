@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
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
                <h3 class="form-title-log">会員登録</h3>
            </div>
            <div class="form">
                <form class="form-box">
                    <div class="form-item">
                        <input type="name" id="inputName" class="form-control" placeholder="名前" required autofocus>
                    </div>
                    <div class="form-item">
                        <input type="email" id="inputEmail" class="form-control" placeholder="メールアドレス" required
                            autofocus>
                    </div>
                    <div class="form-item">
                        <input type="password" id="inputPassword" class="form-control" placeholder="パスワード" required>
                    </div>
                    <div class="form-item">
                        <input type="password" id="inputPasswordConfirmation" class="form-control" placeholder="確認用パスワード" required>
                    </div>
                    <div class="form-item">
                        <button class="form-item-btn" type="submit">会員登録</button>
                    </div>
                    <div class="account-check">
                        <p class="account-check-message"> アカウントをお持ちの方はこちらから</p>
                        <a class="account-check-login" href="/login">ログイン</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- </div> -->
@endsection
