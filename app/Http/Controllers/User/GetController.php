<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Conf;
use App\User;

class GetController extends Controller
{
    public function index ()
    {
        $data['users'] = User::all();
        $data['types'] = [
            Conf::ROLE_CASHIER => 'Cashier',
            Conf::ROLE_SUBADMIN => 'Sub Admin',
            Conf::ROLE_ADMIN => 'Admin',
        ];
        return view('admin.account', $data);
    }
}

