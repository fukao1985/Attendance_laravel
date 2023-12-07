@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('header')
<header class="header">
        <div class="header__inner">
            <h1 class="header__logo">Atte</h1>
            <nav class="header__nav">
                <ul class="header__nav-list">
                    @if (Auth::check())
                    <li><a class="list-item" href="/">ホーム</a></li>
                    <li><a class="list-item" href="/">日付一覧</a></li>
                    <li>
                        <form class="logout-form" action="/logout" method="post">
                        @csrf
                            <button type="submit" class="list-button">ログアウト</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
@endsection

@section('content')
<!-- <div class="main__content"> -->
        <div class="content__form">
            <div class="form-title">
                <h3 class="form-title-log">{{ Auth::user()->name }}さんお疲れ様です！</h3>
            </div>
            <div class="form">
                <form class="form-box">
                    <div class="form-item">
                        <input type="radio" name="work" id="work-btn-start" value="start" />
                        <label class="btn-label" for="work-btn-start">勤務開始</label>
                    </div>
                    <div class="form-item">
                        <input type="radio" name="work" id="work-btn-end" value="end" />
                        <label class="btn-label" for="work-btn-end">勤務終了</label>
                    </div>
                    <div class="form-item">
                        <input type="radio" name="rest" id="rest-btn-start" value="start" />
                        <label class="btn-label" for="rest-btn-start">休憩開始</label>
                    </div>
                    <div class="form-item">
                        <input type="radio" name="rest" id="rest-btn-end" value="end" />
                        <label class="btn-label" for="rest-btn-end">休憩終了</label>
                    </div>
                </form>
            </div>
        </div>
        <!-- </div> -->
@endsection
