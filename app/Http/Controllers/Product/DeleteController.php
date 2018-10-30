<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Validator;
use App\Rules\Password;
use App\Model\Product;

class DeleteController extends Controller
{
    public function delete (Request $request, $id)
    {
        $this->validateDelete($request);

        if ($this->deleteProduct($id))
            return Util::successResponse('admin', 'Product deleted successfully.');
        else 
            return Util::failedResponse('admin', 'Failed to delete the product.');
    }

    private function deleteProduct ($id)
    {
        return Product::destroy($id);
    }

    private function validateDelete (Request $request)
    {
        $this->validate($request, [
            'password' => ['required', new Password],
        ]);
    }
}
