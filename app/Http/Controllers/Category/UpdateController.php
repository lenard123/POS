<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Validation\Rule;
use Validator;
use App\Model\Category;

class UpdateController extends Controller
{
    public function update (Request $request, $id)
    {
        $validator = $this->validateCategory($request, $id);
        if ($validator->fails())
            return $this->sendFailedResponse($validator);

        $this->updateCategory($request, $id);

        return redirect()->route('category');
    }

    private function updateCategory (Request $request, $id)
    {
        Category::find($id)->update(
            $this->getData($request, $id)
        );
        Util::success(['Category updated successfully.']);
    }

    private function sendFailedResponse ($validator) 
    {
        return redirect()->route('category')
                         ->withErrors($validator)
                         ->withInput();
    }

    private function validateCategory (Request $request, $id)
    {
        return Validator::make($this->getData($request, $id), [
            'category' => 'required|exists:category,id',
            'name' => ['required', Rule::unique('category')->ignore($id)],
        ]);
    }

    private function getData (Request $request, $id)
    {
        $data = $request->only('name');
        $data['category'] = $id;
        return $data;
    }
}
