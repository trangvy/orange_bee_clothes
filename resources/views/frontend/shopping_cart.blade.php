@extends('layouts.orangebee')

@section('content')
    <section id="cart_items">
        @if (Session::has('cart'))
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="alert alert-success" style="display: none;"></div>
                <div class="alert alert-warning" style="display: none;"></div>
                <div class="cart_list table-responsive">
                    <table class="table_cart">
                        <thead>
                        <tr>
                            <th class="product">{{ __('cart.image') }}</th>
                            <th class="description">{{ __('cart.pro_name') }}</th>
                            <th class="unit_price">{{ __('cart.unit_price') }}</th>
                            <th class="quantity">{{ __('cart.quantity') }}</th>
                            <th class="value">{{ __('cart.value') }}</th>
                            <th class="action">{{ __('cart.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (is_array($products) || is_object($products))
                            @foreach ($products as $product)
                                <tr class="row_{{ $product['item']->id }}">
                                    <td class="product_img"><a href="#"><img src="{{ asset(config('product.image_path') . $product['item']->image) }}" alt="cart"></a></td>
                                    <td class="product_des">
                                        <h3>{{ $product['item']->name }}</h3>
                                        <p>{{ $product['item']->description }}</p>
                                    </td>
                                    <td class="u_price">{{ $product['item']->price }}</td>
                                    <td class="cart_quantity p_quantity">
                                        <div class="pp_quantity">
                                            <a class="cart_quantity_up fa fa-plus" data-product-id="{{ $product['item']->id }}" role="button"></a>
                                            <input class="cart_quantity_input" type="text" name="quantity_{{ $product['item']->id }}" value="{{$product['quantity']}}" size="2" readonly>
                                            <a class="cart_quantity_down fa fa-minus" data-product-id="{{ $product['item']->id }}" role="button"></a>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price" data-product-id="{{ $product['item']->id }}">{{ number_format($product['price']) }}</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" data-product-id="{{ $product['item']->id }}" role="button"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="shopping_cart_action">
                    <div class="row">
                        <div class="col-md-4 col-sm-8 col-xs-12">
                            <div class="right_shopping">
                                <a href="{{ url('/home')}}"><p>{{ __('cart.continue') }}</p></a>
                                <a href="{{ route('cart.delCartAll')}}" class="clear"><p>{{ __('cart.clear') }}</p></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="discount_coupon">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="total_right">
                                <table>
                                    <tr>
                                        <th>{{ __('cart.total') }}</th>
                                        <th><p class="cart_sum_total_price" data-product-id="{{ $product['item']->id }}">{{ number_format($totalPrice) }}</p></th>
                                    </tr>
                                </table>
                                <a href="#" class="check_out">{{ __('cart.proceed_checkout') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-sm-6 col-md-6 col-sm-offset-3 col-md-offset-3">
                    <h2>{{ __('cart.no_item') }}</h2>
                </div>
            </div>
    </section>
    @endif
@endsection
@section('js')
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection
