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
                    <li><a class="list-item" href="/attendance">日付一覧</a></li>
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
                @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
                @endif
                <h3 class="form-title-log">{{ Auth::user()->name }}さんお疲れ様です！</h3>
            </div>
            <div class="form">
                <div class="form-box">
                    <div class="form-item">
                        <form action="{{ route('work.start') }}" method="post">
                        @csrf
                            <input type="radio" name="work" id="work-btn-start" value="{{ \Carbon\Carbon::now() }}" />
                            <input type="submit" name="submit" class="btn-label" value="勤務開始"/>
                        </form>
                    </div>
                    <div class="form-item">
                        <form action="{{ route('work.end') }}" method="post">
                        @csrf
                            <input type="radio" name="work" id="work-btn-end" value="{{ \Carbon\Carbon::now() }}" />
                            <input type="submit" name="submit" class="btn-label" value="勤務終了"/>
                        </form>
                    </div>
                    <div class="form-item">
                        <form action="{{ route('rest.start') }}" method="post">
                        @csrf
                            <input type="radio" name="rest" id="rest-btn-start" value="{{ \Carbon\Carbon::now() }}" />
                            <input type="submit" name="submit" class="btn-label" value="休憩開始"/>
                        </form>
                    </div>
                    <div class="form-item">
                        <form action="{{ route('rest.end') }}" method="post">
                        @csrf
                            <input type="radio" name="rest" id="rest-btn-end" value="{{ \Carbon\Carbon::now() }}" />
                            <input type="submit" name="submit" class="btn-label" value="休憩終了"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
@endsection
