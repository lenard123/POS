<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;

class GetController extends Controller
{
    public function index (Request $request)
    {
        $data['products'] = Product::paginate(15);
        return view('admin.index', $data);
    }

    public function add ()
    {
        $data['categories'] = Category::all();
        return view('admin.addproduct', $data);
    }

    public function addStock ($id)
    {
        $data['product'] = Product::find($id);
        return view('admin.addstock', $data);
    }

    public function update ($id)
    {
        $data['product'] = Product::find($id);
        $data['categories'] = Category::all();
        return view('admin.updateproduct', $data);
    }

}
