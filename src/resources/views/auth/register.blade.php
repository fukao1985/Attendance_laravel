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
            {{-- @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
            @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
            @endif --}}
            <div class="form">
                <form class="form-box" action="/register" method="post">
                @csrf
                    <div class="form-item">
                        <input type="name" name="name" class="form-control" placeholder="名前" value="{{ old('name') }}">
                        <div class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                        </div>
                    </div>
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
                        <input type="password" name="password_confirmation"  class="form-control" placeholder="確認用パスワード">
                        <div class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                        </div>
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
