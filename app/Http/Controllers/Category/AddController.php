<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use App\Model\Category;
use Illuminate\Validation\ValidationException;

class AddController extends Controller
{
    public function add (Request $request)
    {
        
        $this->validateCategory($request);
        
        if ($this->insertCategory($request)) 
            return $this->sendSuccessResponse();
        else
            return $this->sendFailedResponse();

    }

    private function sendSuccessResponse ()
    {
        Util::success(['Category added successully.']);
        return redirect()->route('category');
    }

    private function sendFailedResponse ()
    {
        throw ValidationException::withMessage([
            'name' => 'An error occured while adding category.'
        ]);
    }

    private function insertCategory (Request $request)
    {
        return Category::create($this->getData($request));
    }

    private function getData (Request $request)
    {
        return $request->only('name');
    }

    private function validateCategory (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:category'
        ]);
    }

}
