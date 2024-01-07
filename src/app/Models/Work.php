<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    
    // 操作可能にするものを指定
    protected $fillable = [
        'user_id',
        'date',
        'work_start',
        'work_end',
    ];

    // Userモデルとのリレーション
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Restモデルとのリレーション
    public function rests(){
        return $this->hasMany('App\Models\Rest');
    }

    // 日付別でデータを表示する際のデータを取得するメソッド
    public function getDataByDate($date) {
        return $this->whereDate('date', $date)->get();
    }
}
