<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;

class GetController extends Controller
{
    public function index ()
    {
        $data['categories'] = Category::latest()->get();
        return view('admin.category', $data);
    }
}
