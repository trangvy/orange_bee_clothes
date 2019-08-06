<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use Validator;

class UploadImage extends Controller
{

    public function store(Request $request) {
        $validation = Validator::make($request->all(), [

            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validation->passes()) {
            $image = $request->file('select_file');
            $newName = date('Ymd_His') . '.' . $image->getClientOriginalName();
            $image->move(public_path('images'), $newName);
            
            return response()->json([
                'message' => 'posts.image_upload_success',
                'image_path' => url('/') . '/' .'images' . '/' . config('posts.image_path') . $newName,
            ]);
        } else {
            
            return response()->json([
                'message' => $validation->errors()->all(),
            ]);
        }
    }
}
