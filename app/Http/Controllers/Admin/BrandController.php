<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBrand;

class BrandController extends Controller
{
    public function index() {
        $brands = Brand::all();

        return view('admin.brand.index', ['brands' => $brands]);
    }

    public function create() {
        return view('admin.brand.create');
    }

    public function store(CreateBrand $request) {
        $data = $request->only([
            'name',
        ]);

        try {
            $brand = Brand::create($data);
        } catch (\Exception $e) {
            return back()->with('status', $e->getMessage());
        }

        return redirect()->route('admin.brand.index')->with('status', __('brand.status'));
    }
   
    public function edit($id) {
        $brand = Brand::find($id);
        
        if (!$brand) {
            return redirect()->route('admin.brand.index')->with('status', __('brand.not_found'));
        }

        return view('admin.brand.edit', ['brand' => $brand]);
    }
    
    public function update(CreateBrand $request, $id) {
        $data = $request->only([
            'name',
        ]);

        try {
            $brand = Brand::find($id);
            $brand->update($data);
            return redirect()->route('admin.brand.index')->with('status', __('brand.updated'));
        } catch (\Exception $e) {
            return back()->with('status', __('brand.update_fail'));
        }
    }
    
    public function destroy($id) {
        try {
            $brand = Brand::find($id);
            $brand->delete();
            $result = [
                'status' => true,
                'msg' => __('message.delete_success'),
            ];
        } catch (\Exception $e) {
            $result = [
                'status' => false,
                'msg' => __('message.delete_fail'),
            ];
        }
        
        return response()->json($result);
    }
}
