<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = "%".request('query')."%";
        $products = Product::where('name', 'LIKE', $query)
                            ->orWhere('code', 'LIKE', $query)
                            ->get();
        return $products;
    }
}
