<?php
namespace App\Services;
use App\Category;

class ProductService
{
    public function store($data) { 
        try {
            $product = Product::create($data);
        } catch (\Exception $e) {
            return false;
        }
        
        return $product;
    }

    public function update($id, $data) {
        try {
            $category = Category::find($id);
            $category->update($data);
        } catch (\Exception $e) {
            return back()->with('status', $e->getMessage());
        }

        return $category;
    }

    public function destroy($id) {
        $del = false;
        try {
            $category = Category::find($id);
            $category->delete();
            $del = true;
        } catch (\Exception $e) {
            $del = false;
        }

        return $del;
    }
}
