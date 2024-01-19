@extends('layouts.app')

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
        <div class="content__form">
        <!-- 日付表示箇所 -->
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

        <!-- データ表示箇所(table) -->
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
                        <form action="{{ route('show.data') }}" method="get">
                        @csrf
                        @foreach ($attendances as $attendance)
                            <tr class="table-data">
                                <td class="table-name">{{ $attendance->name }}</td>
                                <td class="table-work-start">{{ $attendance->work_start }}</td>
                                <td class="table-work-end">{{ $attendance->work_end }}</td>
                                @php
                                    $rest_start = strtotime($attendance->rest_start);
                                    $rest_end = strtotime($attendance->rest_end);
                                    $restTimeDiff = $rest_end - $rest_start;
                                    $formattedRestTime = gmdate('H:i:s', $restTimeDiff);
                                    $restTime = $formattedRestTime;
                                @endphp
                                <td class="table-rest">{{ $restTime }}</td>
                                @php
                                    $work_start = strtotime($attendance->work_start);
                                    $work_end = strtotime($attendance->work_end);
                                    $workTimeDiff = $work_end - $work_start - $restTimeDiff;
                                    $formattedWorkTime = gmdate('H:i:s', $workTimeDiff);
                                    $workTime = $formattedWorkTime;
                                @endphp
                                <td class="table-work">{{ $workTime }}</td>
                            </tr>
                        @endforeach
                        </form>
                    </table>
                </div>
                <div class="table-page">
                    <div class="table-pagination">
                            {{ $attendances->appends(request()->input())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
@endsection
