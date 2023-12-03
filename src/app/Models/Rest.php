<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    // Workモデルとのリレーション
    public function work(){
        return $this->belongsTo('App\Models\Work');
    }

}