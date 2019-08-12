@extends('layouts.orangebee')
@section('title', $product->name )
@section('content')
<div class="alert alert-success {{ !session('status') ? 'hidden' : ''  }}">
        {{ session('status') }}
    </div>
<section class="product_detail_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="product_img_tab clearfix">
                   <div class="product_main_img tab-content">
                       <div id="one" role="tabpanel"  class="p_tab_img active">
                           <a href="#"><img id="zoom_01" src="{{ asset(config('products.image_path') . $product->image) }}" data-zoom-image="{{ asset(config('products.image_path') . $product->image) }}" alt=""></a>
                       </div>
                   </div>
                   <div class="product_img_list">
                       <ul role="tablist">
                            @foreach( $imageLists as $image)
                               <li role="presentation" class="active"><a href="#one" aria-controls="one" role="tab" data-toggle="tab"><img src="{{ asset(config('products.image_path') . $image) }}" alt=""></a></li>
                            @endforeach
                       </ul>
                   </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="product_detail">
                    <div class="product_title">
                        <h2>{{ $product->name }}</h2><br>
                        <a href="#"><i class="fa fa-star"></i></a>
                        <a href="#"><i class="fa fa-star"></i></a>
                        <a href="#"><i class="fa fa-star"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <a href="#"><i class="fa fa-star-o"></i></a>
                        <h3>
                            {{ __('products.pro_currency') }}{{ $product->price }} 
                        </h3>
                        <p>{{ $product->description ? $product->id : '' }}</p>
                        <p class="available">{{ __('products.pro_avaible') }}: <span>{{ $product->quantity > 0 ? __('products.status.1') : __('products.status.2') }}</span></p>
                        <p class="available">{{ __('products.pro_brand') }}: <span>{{ $product->brand->name }}</span></p>
                        <div class="size_quantity clearfix">
                            <div class="size">
                                <h2>Size</h2>
                                <div class="size_form">
                                    @foreach ($sizes as $size)
                                    <a href="#">{{ $size->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="quantity">
                                <h2>quantity</h2>
                                <input type="number" value="1">
                            </div>
                        </div>
                        <div class="product_details_color">
                            <h2>color</h2>
                            <div class="color_spans">
                                @foreach ($colors as $color)
                                <a href="#" alter="{{ $color->name }}"><span class="white" style="background-color: {{ $color->value }}""></span></a>
                                @endforeach
                            </div>
                            <div class="favorite_icons">
                                <a href="#"><i class="fa fa-heart"></i></a>
                                <a href="#"><i class="fa fa-exchange"></i></a>
                                <a href="#" class="add_to_cart">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="sale_area_title">
                    <h1>RELATED PRODUCTS</h1>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="owl_sale_wrapper">
                    @foreach ($recommendPros as $key => $product)
                        <div class="single_featured">
                            <div class="single_featured_img">
                                <a href="shop.html">
                                <img class="primary_image" src="{{ asset(config('products.image_path') . $product->image) }}" alt="sale">
                            </div>
                            <div class="actions">
                                <div class="action_button">
                                    <ul>
                                        <li><a href="#" data-toggle="tooltip" title="Add to cart"><i class="fa fa-shopping-cart"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" title="Favorite"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" title="Compair"><i class="fa fa-refresh"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="single_featured_label">
                                <a href="{{ route('product.show', $product->id)}}"><h2>{{ $product->name }}</h2></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star-o"></i></a>
                                <a href="#"><i class="fa fa-star-o"></i></a>
                                <a href="#"><i class="fa fa-star-o"></i></a>
                                <h3>{{ __('products.pro_currency') }}{{ $product->price }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    <script src="{{ asset('js/product.js') }}"></script>
@endsection