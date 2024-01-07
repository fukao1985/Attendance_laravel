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
                        @if ('work.start')
                            <form action="{{ route('work.start') }}" method="post">
                            @csrf
                                <input desabled type="submit" name="submit" class="btn-label" value="勤務開始" style="color:#f2f2f2" />
                            </form>
                        @elseif ('work.start' && 'work.end')
                            <form action="{{ route('work.start') }}" method="post">
                            @csrf
                                <input desabled type="submit" name="submit" class="btn-label" value="勤務開始" style="color:#f2f2f2"/>
                            </form>
                        @else
                            <form action="{{ route('work.start') }}" method="post">
                            @csrf
                                <input type="submit" name="submit" class="btn-label" value="勤務開始" />
                            </form>
                        @endif
                    </div>

                    {{-- 勤務終了 --}}
                    <div class="form-item">
                        @if ('work.start')
                            <form action="{{ route('work.end') }}" method="post">
                            @csrf
                                <input type="submit" name="submit" class="btn-label" value="勤務終了" />
                            </form>
                        @elseif ('work.start' && 'work.end')
                            <form action="{{ route('work.end') }}" method="post">
                            @csrf
                                <input desabled type="submit" name="submit" class="btn-label" value="勤務終了" style="color:#f2f2f2"/>
                            </form>
                        @else
                            <form action="{{ route('work.end') }}" method="post">
                            @csrf
                                <input desabled type="submit" name="submit" class="btn-label" value="勤務終了" style="color:#f2f2f2"/>
                            </form>
                        @endif
                    </div>

                    {{-- 休憩開始 --}}
                    <div class="form-item">
                        @if ('work.start' && 'rest.start')
                            <input desabled type="submit" name="submit" class="btn-label" value="休憩開始" style="color:#f2f2f2"/>
                        @elseif ('work.start')
                            <form action="{{ route('rest.start') }}" method="post">
                            @csrf
                                <input type="submit" name="submit" class="btn-label" value="休憩開始"/>
                            </form>
                        @elseif ('work.start' && 'rest.end')
                            <form action="{{ route('rest.start') }}" method="post">
                            @csrf
                                <input type="submit" name="submit" class="btn-label" value="休憩開始"/>
                            </form>
                        @else
                            <form action="{{ route('rest.start') }}" method="post">
                            @csrf
                                <input desabled type="submit" name="submit" class="btn-label" value="休憩開始" style="color:#f2f2f2"/>
                            </form>
                        @endif
                    </div>

                    {{-- 休憩終了 --}}
                    <div class="form-item">
                        @if ('work.start' && 'rest.start')
                            <form action="{{ route('rest.end') }}" method="post">
                            @csrf
                                <input type="submit" name="submit" class="btn-label" value="休憩終了"/>
                            </form>
                        @else
                            <form action="{{ route('rest.end') }}" method="post">
                            @csrf
                                <input desabled type="submit" name="submit" class="btn-label" value="休憩終了" style="color:#f2f2f2" />
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
@endsection
