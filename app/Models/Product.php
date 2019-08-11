<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'brand_id',
        'type_id',
        'name',
        'sku',
        'price',
        'image',
        'images_detail',
        'quantity',
        'delete_shop',
        'count_buy',
        'count_view',
    ];

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function brand() {
        return $this->belongsTo('App\Models\Brand');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function colors() {
        return $this->belongsToMany('App\Models\Color', 'product_attributes', 'product_id', 'color_id')->withPivot('attribute_quantity', 'attribute_image');
    }

    public function sizes() {
        return $this->belongsToMany('App\Models\Size', 'product_attributes', 'product_id', 'size_id')->withPivot('attribute_quantity', 'attribute_image');
    }
}
