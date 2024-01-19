# Atte
“Atte（アット）”は勤怠管理システムです。<br>
利用するには会員登録が必要となります。
<img width="1093" alt="勤怠画面" src="https://github.com/fukao1985/Attendance_laravel/assets/141505803/d74e15d0-acae-4c41-b671-1457f658329e">

***

## 作成した目的
従業員の勤務状態を管理するため。

***

## アプリケーションURL

***

## 機能一覧
* 会員登録機能(メール認証未完成)
* ログイン機能
* ログアウト機能
* 勤怠開始機能
* 勤怠終了機能
* 休憩開始機能(1日に何度でも可能)
* 休憩終了機能(1日に何度でも可能)
* 日付別勤怠情報取得機能
* ユーザー別勤怠情報取得機能
* ページネーション機能(5件ずつ取得)

**0時をまたいで勤務・休憩を終了する際の仕様について**

- 勤務終了
    - 勤務を開始する際に作成されたworkレコードのwork_endを24:00:00で更新
    - 新しいworkレコードをwork_startを00:00:00、work_endを現在時刻で作成
- 休憩終了
    - 休憩を開始する際に作成されたrestレコードのrest_endを24:00:00で更新
    - 勤務を開始する際に作成されたworkレコードのwork_endを24:00:00で更新
    - 新しいworkレコードをwork_startを00:00:00、work_endをnullで作成
    - 新しいrestレコードをrest_startを00:00:00、rest_endを現在時刻で作成

***

## 使用技術
* Laravel 8.x
* Laravel Fortify
* PHP
* MySQL 8.0.26
* Niginx
* Docker/Docker-compose
* Node.js
* bootstrap

***

## テーブル設計
### usersテーブル
|Column|Type|Options| 
|:---:|:---:|:---:| 
|name|varchar(191)|null: false|
|email|varchar(191)|null: false|
|password|varchar(191)|null: false|
|created_at|timestamp|———|
|updated_at|timestamp|———|

### worksテーブル
|Column|Type|Options| 
|:---:|:---:|:---:| 
|user_id|bigint|null: false|
|date|date|null: false|
|work_start|time|———|
|work_end|time|———|
|created_at|timestamp|———|
|updated_at|timestamp|———|

### restsテーブル
|Column|Type|Options| 
|:---:|:---:|:---:| 
|work_id|bigint|null: false|
|date|date|null: false|
|rest_start|time|———|
|rest_end|time|———|
|created_at|timestamp|———|
|updated_at|timestamp|———|

***

## ER図
<img width="999" alt="Attendance ER図" src="https://github.com/fukao1985/Attendance_laravel/assets/141505803/56448644-3bd3-4f7e-805e-640411975026">






 

