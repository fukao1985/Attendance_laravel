<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    public function create() {
        return view('login');
    }
}
