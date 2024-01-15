@extends('layouts.app')
<?php
use Carbon\Carbon;
?>

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}" />
@endsection

@section('header')
<header class="header">
        <div class="header__inner">
            <h1 class="header__logo">Atte</h1>
            <nav class="header__nav">
                <ul class="header__nav-list">
                    <li><a class="list-item" href="/">ホーム</a></li>
                    <li><a class="list-item" href="/users">ユーザー一覧</a></li>
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
                <div>
                    <form action="/attendance" method="get">
                    @csrf
                    @if (isset($previous))
                        <button name="date" class="form-button" value="{{ $previous->format('Y-m-d') }}"><</button>
                    @endif
                    </form>
                </div>
                <h3 class="form-title-log">{{ $selectDay->format('Y-m-d') }}</h3>
                <div>
                    <form action="/attendance" method="get">
                    @csrf
                    @if (isset($next))
                        <button name="date" class="form-button" valus="{{ $next->format('Y-m-d') }}">></button>
                    @endif
                    </form>
                </div>
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
                            @foreach ($rests as $rest)
                            <tr class="table-data">
                                <td class="table-name">{{ $rest->work->user->name??'匿名' }}</td>
                                <td class="table-work-start">{{ $rest->work->work_start }}</td>
                                <td class="table-work-end">{{ $rest->work->work_end }}</td>
                                @php
                                    $rest_start = strtotime($rest->rest_start);
                                    $rest_end = strtotime($rest->rest_end);
                                    $restTimeDiff = $rest_end - $rest_start;
                                    $restTimeSeconds = floor($restTimeDiff % 60);
                                    $restTimeMinutes = floor($restTimeDiff / 60);
                                    $restTimeHours = floor($restTimeMinutes / 60);
                                    $restTime = $restTimeHours . ":" . $restTimeMinutes . ":" . $restTimeSeconds;
                                @endphp
                                <td class="table-rest">{{ $restTime }}</td>
                                @php
                                    $work_start = strtotime($rest->work->work_start);
                                    $work_end = strtotime($rest->work->work_end);
                                    $workTimeDiff = $work_end - $work_start - $restTimeDiff;
                                    $workTimeSeconds = floor($workTimeDiff % 60);
                                    $workTimeMinutes = floor($workTimeDiff / 60);
                                    $workTimeHours = floor($workTimeMinutes / 60);
                                    $workTime = $workTimeHours . ":" . $workTimeMinutes . ":" . $workTimeSeconds;
                                @endphp
                                <td class="table-work">{{ $workTime }}</td>
                            </tr>
                            @endforeach
                        </form>
                    </table>
                </div>
                <div class="table-page">
                    <div class="table-pagination">
                            {{ $rests->appends(request()->input())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        <!-- ページネーション -->
                {{-- {{ $works->appends(request()->input())->links('pagination::bootstrap-4') }} --}}
        </div>
        <!-- </div> -->
@endsection