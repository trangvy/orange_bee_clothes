<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategory;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function index() {
        $categories = Category::all();

        return view('admin.category.index', ['categories' => $categories]);
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(CreateCategory $request) {
        $data = $request->only([
            'name',
        ]);

        $category = $this->categoryService->store($data);

        return redirect()->route('admin.category.index')->with('status', __('category.status'));
    }
   
    public function edit($id) {
        $category = Category::find($id);
        
        if (!$category) {
            return redirect()->route('admin.category.index')->with('status', __('category.not_found'));
        }

        return view('admin.category.edit', ['category' => $category]);
    }
    
    public function update(CreateCategory $request, $id) {
        $data = $request->only([
            'name',
        ]);

        $category = $this->categoryService->update($id, $data);

        if (!$category) {
            return back()->with('status', __('category.update_fail'));
        }
        
        return redirect()->route('admin.category.index')->with('status', __('category.updated'));
    }
    
    public function destroy($id) {

        $del = $this->categoryService->destroy($id);

        $result = [
            'status' => $del,
            'msg' => $del ? __('message.delete_success') : __('message.delete_fail'),
        ];
        
        return response()->json($result);
    }
}
