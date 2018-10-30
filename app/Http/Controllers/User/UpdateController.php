<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Validation\Rule;
use Auth;
use App\Rules\Password;
use App\Model\User;

class UpdateController extends Controller
{
    public function update (Request $request)
    {
        $this->validateUser($request);

        $this->updateUser($request);

        return Util::successResponse('account', 'Account updated successfully.');
    }

    private function updateUser (Request $request)
    {
        return User::find(Auth::id())->update($this->getData($request));
    }

    private function getData (Request $request)
    {
        return $request->only('name', 'email');
    }

    private function validateUser (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => ['required', Rule::unique('users')->ignore(Auth::id())],
            'password' => ['required', new Password]
        ]);
    }
}
