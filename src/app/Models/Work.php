<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    // Userモデルとのリレーション
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Restモデルとのリレーション
    public function rests(){
        return $this->hasMany('App\Models\Rest');
    }

}
