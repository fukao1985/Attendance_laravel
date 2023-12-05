<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;

class RestController extends Controller
{
    public function dateAttendance() {
        return view('attendance');
    }
}
