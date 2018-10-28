<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return Util::successResponse('login', 'Logout successfully.');
    }

}
