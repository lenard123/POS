<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use App\Model\Product;

class AddController extends Controller
{
    public function add (Request $request)
    {
        $this->validateProduct($request);

        if ($this->insertProduct($request))
            return Util::successResponse('addproduct', 'Product added successfully');
        else
            return Util::failedResponse('An error occured, while adding the product.');
    }

    private function insertProduct (Request $request)
    {
        return Product::create($request->all());
    }

    private function validateProduct (Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|exists:category,id',
            'code' => 'required|unique:products',
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric'  
        ]);
    }
}
