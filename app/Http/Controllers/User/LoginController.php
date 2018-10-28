<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Conf;
use App\Http\Controllers\Util;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated (Request $request, User $user)
    {
        if ($user->type == Conf::ROLE_CASHIER)
            return $this->sendSuccessResponse('cashier');
        else
            return $this->sendSuccessResponse('admin');
    }

    protected function sendSuccessResponse ($routename)
    {
        return Util::successResponse($routename, $this->getSuccessMessage());
    }

    protected function getSuccessMessage()
    {
        return "Login successfully, welcome {$this->getName()}";
    }

    protected function getName()
    {
        return request()->user()->name;
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
