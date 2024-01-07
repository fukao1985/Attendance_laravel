@extends('layouts.app')
<?php
use Carbon\Carbon;
?>

@section('css')
<link rel="stylesheet" href="{{ asset('css/users_data.css') }}" />
@endsection

@section('header')
<header class="header">
        <div class="header__inner">
            <h1 class="header__logo">Atte</h1>
            <nav class="header__nav">
                <ul class="header__nav-list">
                    <li><a class="list-item" href="/">ホーム</a></li>
                    <li><a class="list-item" href="/attendance">日付一覧</a></li>
                    <li>
                        <form class="logout-form" action="/logout" method="post">
                        @csrf
                            <button type="submit" class="list-button">ログアウト</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
@endsection

@section('content')
<!-- <div class="main__content"> -->
        <div class="content__form">
        <!-- 日付のところ -->
            <div class="form-title">
                {{-- <div>
                    <form action="/attendance" method="get">
                    @csrf
                    @if (isset($previous))
                        <button name="date" class="form-button" value="{{ $previous->format('Y-m-d') }}"><</button>
                    @endif
                    </form>
                </div> --}}
                {{-- <h3 class="form-title-log">{{ $selectDay->format('Y-m-d') }}</h3> --}}
                <h3 class="form-title-log">id</h3>
                {{-- <div>
                    <form action="/attendance" method="get">
                    @csrf
                    @if (isset($next))
                        <button name="date" class="form-button" valus="{{ $next->format('Y-m-d') }}">></button>
                    @endif
                    </form>
                </div> --}}
            </div>

        <!-- データを表示する表(table) -->
            <div class="form">
                <div class="form-table">
                    <table>
                        <tr class="table-title">
                            <th class="table-name">名前</th>
                            <th class="table-work-start">勤務開始</th>
                            <th class="table-work-end">勤務終了</th>
                            <th class="table-rest">休憩時間</th>
                            <th class="table-work">勤務時間</th>
                        </tr>
                        <form action="">
                            @foreach ($works as $work)
                            <tr class="table-data">
                                <td class="table-name">{{ $work->user->name??'匿名' }}</td>
                                <td class="table-work-start">{{ $work->work_start }}</td>
                                <td class="table-work-end">{{ $work->work_end }}</td>
                                <td class="table-rest">休憩時間</td>
                                <td class="table-work">勤務時間</td>
                            </tr>
                            @endforeach
                        </form>
                    </table>
                </div>
                {{-- <div class="table-page">
                    <div class="table-pagination">
                            {{ $works->appends(request()->input())->links('pagination::bootstrap-4') }}
                    </div>
                </div> --}}
            </div>
        <!-- ページネーション -->
                {{-- {{ $works->appends(request()->input())->links('pagination::bootstrap-4') }} --}}
        </div>
        <!-- </div> -->
@endsection