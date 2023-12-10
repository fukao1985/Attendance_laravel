<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    // 操作可能にするものを指定
    protected $fillable = [
        'work_id',
        'date',
        'rest_start',
        'rest_end',
    ];

    // Workモデルとのリレーション
    public function work(){
        return $this->belongsTo('App\Models\Work');
    }

}
