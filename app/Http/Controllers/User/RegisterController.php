<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use App\Rules\AccountType;
use App\Model\User;

class RegisterController extends Controller
{

    public function register (Request $request)
    {
        $this->validateUser($request);

        $this->createUser($request);

        return Util::successResponse('account', 'Account Registered successfully.');
    }

    private function createUser (Request $request)
    {
        return User::create($this->getData($request));
    }

    private function getData (Request $request)
    {
        $data = $request->only('name', 'email', 'type', 'password');
        $data['password'] = bcrypt($data['password']);
        return $data;
    }

    private function validateUser (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'type' => ['required', 'numeric', new AccountType],
            'password'=> 'required|string',
            'confirm_password' => 'required|same:password'
        ]);
    }
}
