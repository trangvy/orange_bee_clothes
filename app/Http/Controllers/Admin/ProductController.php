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
            'attribute_quantity',
            'description',
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
        } catch (\Exception $e) {dd($e->getMessage());
            return back()->with('status', $e->getMessage());
        }

        return redirect()->route('product.show',$product->id)->with('status', __('products.status'));
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
        $destinationFolder = public_path() . '/' . config('product.image_path');

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
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $imageLists = json_decode($product->images_detail,true);
        $colors = Color::all();
        $sizes = Size::all();
        $data = ['product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'imageLists' => $imageLists,
            'colors' => $colors,
            'sizes' => $sizes,
        ];

        if (!$product) {
            return redirect()->route('products.list')->with('status', __('products.not_found'));
        }

        return view('admin.products.edit', $data);
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
            'attribute_quantity',
            'description',
            'image_delete',
            'attribute_id',
        ]);
;
        if (isset($data['image'])) {            
            $image = $this->upload($data['image']);

            if (!$image['status']) {
                return back()->with('status', $image['msg']);
            }

            $data['image'] = $image['file_name'];
        }

        if (isset($data['images_detail'])) {
            $imageList = [];

            foreach ($data['images_detail'] as $item) {
                $image = $this->upload($item);

                if (!$image['status']) {
                    return back()->with('status', $image['msg']);
                }

                $imageList[] = $image['file_name'];
            }

            $data['images_detail'] = $imageList;
        }

        try {
            $product = Product::find($id);
            $oldImage = $product->image;
            $oldImageList = json_decode($product->images_detail,true);

            if (isset($data['images_detail']) && !isset($data['image_delete'])) {
                $newImageList =  array_merge($oldImageList, $data['images_detail']);
                $data['images_detail'] = json_encode($newImageList,JSON_FORCE_OBJECT);
            }

            if (isset($data['image_delete']) && !isset($data['images_detail'])) {
                $imagesDelete = explode(',', $data['image_delete']);
                $newImageList = array_diff($oldImageList, $imagesDelete);
                $data['images_detail'] = json_encode($newImageList,JSON_FORCE_OBJECT);
                unset($data['image_delete']);
            }

            if (isset($data['images_detail']) && isset($data['image_delete'])) {
                $imagesDelete = explode(',', $data['image_delete']);
                $newImageList = array_diff($oldImageList, $imagesDelete);
                $newImageList =  array_merge($newImageList, $data['images_detail']);
                $data['images_detail'] = json_encode($newImageList,JSON_FORCE_OBJECT);
                unset($data['image_delete']);
            }

            $product->update($data);
            
            if (isset($data['image'])) {
                $imagePath = public_path() . '/' . config('product.image_path') . $oldImage;

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            if (isset($data['image_delete'])) {
                $imagesDelete = explode(',', $data['image_delete']);
                foreach ($imagesDelete as $image) {
                    $imagePath = public_path() . '/' . config('product.image_path') . $oldImageList;

                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }

            //Update attribute
            foreach ($data['attribute_id'] as $key => $attributeId) {

                $attribute = ProductAttribute::find($attributeId);
                $oldImage = $attribute->attribute_image;
                $attributes['color_id'] = $data['color_id'][$key];
                $attributes['size_id'] = $data['size_id'][$key];
                $attributes['attribute_quantity'] = $data['attribute_quantity'][$key];
                $attributes['attribute_image'] = $oldImage;

                if (isset($data['attribute_image'][$key])) {            
                    $attribute_image = $this->upload($data['attribute_image'][$key]);
                    if (!$attribute_image['status']) {
                        return back()->with('status', $attribute_image['msg']);
                    }
                    var_dump("co link img");
                    $attributes['attribute_image'] = $attribute_image['file_name'];
                }

                $attribute->update($attributes);

                if (isset($data['attribute_image'][$key])) {
                    $imagePath = public_path() . '/' . config('product.image_path') . $oldImage;
                    var_dump("xoa anh ". $oldImage);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }

            return redirect(route('product.index', $product->id))->with('status', __('products.updated'));
        } catch (\Exception $e) {
            dd($e->getMessage(), $data);
            return back()->with('status', __('products.update_fail'));
        }
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
