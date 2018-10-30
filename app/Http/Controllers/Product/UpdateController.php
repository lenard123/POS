<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Validation\Rule;
use App\Model\Product;

class UpdateController extends Controller
{
    public function update (Request $request, $id)
    {
        $this->validateProduct($request, $id);

        if ($this->updateProduct($request, $id))
            return Util::successResponse('admin', 'Product updated successfully');
        else 
            return Util::failedResponse('updateproduct', 'Failed to update product.');
    }

    private function updateproduct (Request $request, $id)
    {
        $product = Product::find($id);
        return $product->update($this->getData($request));
    }

    private function validateProduct (Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required|exists:category,id',
            'code' => ['required', Rule::unique('products')->ignore($id)],
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
    }

    private function getData (Request $request)
    {
        return $request->only('category_id', 'code', 'name', 'price', 'description');
    }
}
