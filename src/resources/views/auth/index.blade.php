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
                <h3 class="form-title-log">
                    @if(session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
                    @endif
                {{ Auth::user()->name }}さんお疲れ様です！
                </h3>
            </div>
            <div class="form">
                <div class="form-box">
                    {{-- 勤務開始 --}}
                    <div class="form-item">
                        @if (session('startWork'))
                            <form action="{{ route('work.start') }}" method="post">
                            @csrf
                                <button desabled class="btn-label" style="color:#f2f2f2">勤務開始</button>
                            </form>
                        {{-- @elseif (!$startWork)
                            <form action="{{ route('work.start') }}" method="post">
                            @csrf
                                <input desabled type="submit" name="work_start" class="btn-label" value="勤務開始" style="color:#f2f2f2"/>
                            </form> --}}
                        @else
                            <form action="{{ route('work.start') }}" method="post">
                            @csrf
                                <button class="btn-label">勤務開始</button>
                            </form>
                        @endif
                    </div>

                    {{-- 勤務終了 --}}
                    <div class="form-item">
                        @if (session('startWork'))
                            <form action="{{ route('work.end') }}" method="post">
                            @csrf
                                <button type="submit" class="btn-label">勤務終了</button>
                            </form>
                        {{-- @elseif ('startWork' && 'work.end')
                            <form action="{{ route('work.end') }}" method="post">
                            @csrf
                                <input desabled type="submit" name="work_end" class="btn-label" value="勤務終了" style="color:#f2f2f2"/>
                            </form> --}}
                        @else
                            <form action="{{ route('work.end') }}" method="post">
                            @csrf
                                <button desabled class="btn-label" style="color:#f2f2f2">勤務終了</button>
                            </form>
                        @endif
                    </div>

                    {{-- 休憩開始 --}}
                    <div class="form-item">
                        {{-- 休憩開始ができる --}}
                        @if (session('startWork') && !session('startRest'))
                            <form action="{{ route('rest.start') }}" method="post">
                            @csrf
                                <button class="btn-label">休憩開始</button>
                            </form>
                        {{-- @elseif ('work.start')
                            <form action="{{ route('rest.start') }}" method="post">
                            @csrf
                                <input type="submit" name="submit" class="btn-label" value="休憩開始"/>
                            </form>
                        @elseif ('work.start' && 'rest.end')
                            <form action="{{ route('rest.start') }}" method="post">
                            @csrf
                                <input type="submit" name="submit" class="btn-label" value="休憩開始"/>
                            </form> --}}
                        @else
                            <form action="{{ route('rest.start') }}" method="post">
                            @csrf
                                <button desabled class="btn-label" style="color:#f2f2f2">休憩開始</button>
                            </form>
                        @endif
                    </div>

                    {{-- 休憩終了 --}}
                    <div class="form-item">
                        @if (session('startWork') && session('startRest'))
                            <form action="{{ route('rest.end') }}" method="post">
                            @csrf
                                <button class="btn-label">休憩終了</button>
                            </form>
                        @else
                            <form action="{{ route('rest.end') }}" method="post">
                            @csrf
                                <button desabled class="btn-label" style="color:#f2f2f2">休憩終了</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
@endsection
