@extends('layouts.app')
<?php
use Carbon\Carbon;
?>

@section('css')
<link rel="stylesheet" href="{{ asset('css/users.css') }}" />
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
            <div class="form-title">
                <div>
                <h3 class="form-title-log">ユーザー 一覧</h3>
                </div>
            </div>

        <!-- データを表示する表(table) -->
            <div class="form">
                <div class="form-table">
                    <table>
                        <tr class="table-title">
                            <th class="table-id">id</th>
                            <th class="table-name">名前</th>
                            <th class="table-email">メールアドレス</th>
                        </tr>
                        <form action="">
                            @foreach ($users as $user)
                            <tr class="table-data">
                                <td class="table-id">{{ $user->id }}</td>
                                <td class="table-name">
                                    <a href="{{ route('users.data', $user->id) }}">
                                    {{ $user->name }}
                                    </a>
                                </td>
                                <td class="table-email">{{ $user->email }}</td>
                            </tr>
                            @endforeach
                        </form>
                    </table>
                </div>
                <div class="table-page">
                    <div class="table-pagination">
                            {{ $users->appends(request()->input())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
@endsection
