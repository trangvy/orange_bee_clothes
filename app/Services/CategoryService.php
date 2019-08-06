<?php
namespace App\Services;
use App\Models\Category;
class CategoryService
{
    public function store($data) { 
        try {
            $category = Category::create($data);
        } catch (\Exception $e) {
            return back()->with('status', $e->getMessage());
        }
        
        return $category;
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
            
        }

        return $del;
    }
}
