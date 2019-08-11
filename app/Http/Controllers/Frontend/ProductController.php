<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function show($id) {
        $product = Product::find($id);
        $colors = $product->colors->unique()->values()->all();
        $sizes = $product->sizes->unique()->values()->all();
        $recommendPros = Product::where('brand_id', $product->brand_id)->get();
        $data = [];

        if (!$product) {
            return back()->with('status', __('products.not_found'));
        }

        $imageLists = json_decode($product->images_detail, true);
        $data = ['product' => $product, 
                'recommendPros' => $recommendPros, 
                'imageLists' => $imageLists,
                'colors' => $colors,
                'sizes' => $sizes];

        return view('product.show', $data);
    }
}
