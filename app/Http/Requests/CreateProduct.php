<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'sku' => ['required'],
            'category_id' => ['required', 'numeric'],
            'brand_id' => ['required', 'numeric'],          
            'price' => 'required|max:22|regex:/^\d*(\.\d{1,2})?$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
            'images_detail' => 'required',
            // 'color_id.*' => 'required',
            // 'size_id.*' => 'required',
            // 'attribute_image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
            // 'attribute_quantity.*' => 'required',
        ];
    }
}
