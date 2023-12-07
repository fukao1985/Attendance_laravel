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
                    <li><a class="list-item" href="/">日付一覧</a></li>
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
                <h3 class="form-title-log">2021-11-07</h3>
            </div>

        <!-- データを表示する表(table) -->
            <div class="form">
                <div class="form-table">
                    <table>
                        <tr class="table-title">
                            <th class="table-name">名前</th>
                            <th class="table-work-start">勤務開始</th>
                            <th class="table-sork-end">勤務終了</th>
                            <th class="table-rest">休憩時間</th>
                            <th class="table-work">勤務時間</th>
                        </tr>
                        <form action=" ">
                            <tr class="table-data">
                                <td class="table-name">{{ Auth::user()->name }}</td>
                                <td class="table-work-start">勤務開始</td>
                                <td class="table-sork-end">勤務終了</td>
                                <td class="table-rest">休憩時間</td>
                                <td class="table-work">勤務時間</td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>

        <!-- ページネーション -->
            <div class="table-page">

            </div>


        </div>
        <!-- </div> -->
@endsection
