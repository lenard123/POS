<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use App\Rules\Password;
use App\Model\User;
use Auth;

class ChangePasswordController extends Controller
{
    public function changePassword (Request $request)
    {
        $this->validatePassword($request);

        $this->updatePassword($request);

        return Util::successResponse('account', 'Password updated successfully.');
    }

    private function updatePassword (Request $request)
    {
        $user = User::find(Auth::id());
        return $user->update($this->getData($request));
    }

    private function getData (Request $request)
    {
        return array('password' => bcrypt($request->password));
    }

    private function validatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => ['required', new Password],
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
    }
}
