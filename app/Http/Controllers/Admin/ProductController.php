<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductAttribute;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProduct;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.products.create', ['categories' => $categories, 'brands' => $brands, 'colors' => $colors, 'sizes' => $sizes]);
    }

    public function store(CreateProduct $request) {

        $data = $request->only([
            'category_id',
            'brand_id',
            'type_id',
            'name',
            'sku',
            'price',
            'image',
            'images_detail',
            'quantity',
            'color_id',
            'size_id',
            'attribute_image',
            'attribute_quantity'
        ]);
        $image = $this->upload($data['image']);

        if (!$image['status']) {
            return back()->with('status', $image['msg']);
        }

        $data['image'] = $image['file_name'];
        $imageList = [];

        foreach ($data['images_detail'] as $item) {
            $image = $this->upload($item);

            if (!$image['status']) {
                return back()->with('status', $image['msg']);
            }

            $imageList[] = $image['file_name'];
        }

        $data['images_detail'] = json_encode($imageList,JSON_FORCE_OBJECT);

        try {
            $data['quantity'] = array_sum($data['attribute_quantity']);
            $data['user_id'] = auth()->id();
            $data['delete_shop'] = 0;
            $data['count_buy'] = 0;
            $data['count_view'] = 0;

            $product = Product::create($data);

            $attributes['product_id'] = $product->id;
            foreach ($data['color_id'] as $key => $value) {
                $attributes['color_id'] = $value;
                $attributes['size_id'] = $data['size_id'][$key];
                $attributes['attribute_quantity'] = $data['attribute_quantity'][$key];

                $attribute_image = $this->upload($data['attribute_image'][$key]);
                if (!$attribute_image['status']) {
                    return back()->with('status', $attribute_image['msg']);
                }

                $attributes['attribute_image'] = $attribute_image['file_name'];
                ProductAttribute::create($attributes);
            }

        } catch (\Exception $e) {
            return back()->with('status', $e->getMessage());
        }

        return redirect()->route('product.index')->with('status', __('products.status'));
    }

    public function addMore() {
        $colors = Color::all();
        $sizes = Size::all();
        $result = [
                'status' => true,
                'colors' => $colors,
                'sizes' => $sizes
            ];

        return response()->json($result);
    }

    private function upload($file) {
        $destinationFolder = public_path() . '/' . config('products.image_path');

        try {
            $fileName = $file->getClientOriginalName() . '_' . date('Ymd_His');
            $imageFileType = $file->getClientOriginalExtension();

            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif' ) {
                $result = [
                    'status' => false,
                    'msg' => __('products.msg'),
                ];
            }

            $file->move($destinationFolder, $fileName);
            $result = [
                'status' => true,
                'file_name' => $fileName,
            ];
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $result = [
                'status' => false,
                'msg' => $msg,
            ];
        }

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            $result = [
                'status' => false,
                'message' => __('products.not_found'),
            ];
        } else {
            try {
                $product->delete_shop = 1;
                $product->save();
                $result = [
                    'status' => true,
                    'message' => __('products.delete_success'),
                ];
            } catch (\Exception $e) {
                $result = [
                    'status' => true,
                    'message' => __('products.delete_fail'),
                    'error' => $e->getMessage()
                ];
            }
        }

        return response()->json($result);
    }
}
