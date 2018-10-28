<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use App\Model\Category;
use Validator;
use App\Rules\Password;
use App\Rules\IsEmpty;

class DeleteController extends Controller
{
    public function delete (Request $request, $id)
    {
        $validator = $this->validatePassword($request, $id);
        if ($validator->fails())
            return $this->sendFailedResponse($validator);

        $this->deleteCategory($id);

        return redirect()->route('category');

    }

    private function deleteCategory ($id)
    {
        Category::destroy($id);
        Util::success(['Category deleted successfully.']);
    }

    private function sendFailedResponse ($validator)
    {
        return redirect()
                    ->route('category')
                    ->withErrors($validator)
                    ->withInput();
    }

    private function validatePassword (Request $request, $id)
    {
        return Validator::make($this->getData($request, $id), [
            'password' => ['required', 'string', new Password],
            'category' => 'required|exists:category,id',
            'products' => [new IsEmpty],
        ]);        
    }

    private function getData (Request $request, $id) {
        $data = $request->only('password');
        $data['category'] = $id;
        $data['products'] = Category::find($id)->products;
        return $data;
    }

    private function categoryExists ($id)
    {
        $category = Category::where('id', $id)->get();
        return $category->count() == 1;
    }
}
