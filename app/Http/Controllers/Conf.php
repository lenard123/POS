<?php

namespace App\Http\Controllers;

class Conf
{
    const ROLE_CASHIER = 0;
    const ROLE_SUBADMIN = 1;
    const ROLE_ADMIN = 2;

    const ERROR_CODE = [
        '0001' => 'SQLSTATE[HY000] [2002] No connection could be made because the target machine actively refused it.'
    ];
}
