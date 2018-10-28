<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Util extends Controller
{
    public static function success ($data)
    {
        return request()->session()->flash('successes', $data);
    }

    public static function successResponse ($route, $message = null)
    {
        self::success(['message' => $message]);
        return redirect()->route($route);
    }

    public static function failedResponse ($message = null)
    {
        throw ValidationException::withMessage([
            'message' => $message
        ]);
    }
}
