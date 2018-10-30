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
        self::success(self::toArray($message));
        return redirect()->route($route);
    }

    public static function failedResponse ($message = null)
    {
        throw ValidationException::withMessage(self::toArray($message));
    }

    public static function toArray ($val, $key = 'message')
    {
        if (!is_array($val))
            return [$key => $val];
        return $val;
    }

    public static function getTypes ($type = null)
    {
        $types = collect(
            array(
                Conf::ROLE_CASHIER => 'Cashier',
                Conf::ROLE_SUBADMIN => 'Sub Admin',
                Conf::ROLE_ADMIN => 'Admin'
            )
        );


        if (!is_null($type)) {
            if ($types->has($type))
                return $types->get($type);
            else
                return false;
        }

        return $types;
    }
}
