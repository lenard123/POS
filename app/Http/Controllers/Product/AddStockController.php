<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Validator;
use App\Model\Product;

class AddStockController extends Controller
{
    public function addStock (Request $request, $id)
    {
        $this->validateStock($request);

        if ($this->updateStock($request, $id) )
            return Util::successResponse('admin','Stocks added successfully.');
        else
            return Util::failedResponse('addstock', 'Failed to add stocks');
    }

    private function updateStock (Request $request, $id)
    {
        $product = Product::find($id);
        $stock = $product->quantity + $request->quantity;
        return $product->update(['quantity'=>$stock]);
    }

    private function validateStock (Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|numeric'
        ]);
    }
}
