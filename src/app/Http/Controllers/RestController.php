<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestController extends Controller
{
    public function dateAttendance() {
        return view('attendance');
    }
}
