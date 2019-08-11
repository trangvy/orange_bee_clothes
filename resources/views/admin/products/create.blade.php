@extends('adminlte::page')

@section('title', __('products.pro_create'))

@section('content_header')
    <h1>{{ __('products.pro_create') }}</h1>
@stop 
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/orange_style.css') }}" rel="stylesheet">
@stop

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-info">
                    <!-- form start -->
                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="box-body">                    
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} ">
                                <label for="{{ $errors->has('name') ? 'inputError' : 'name' }}" class="col-sm-3 control-label">
                                    @if ($errors->has('name'))
                                        <i class="fa fa-times-circle-o"></i> 
                                    @endif
                                    {{ __('Product Name') }}
                                </label>

                                <div class="col-sm-9">
                                    <input id="name" type="text" class="form-control" id="{{ $errors->has('name') ? 'inputError' : '' }}" name="name" value="{{ old('name') }}" autofocus>

                                    @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('sku') ? 'has-error' : '' }} ">
                                <label for="{{ $errors->has('sku') ? 'inputError' : 'sku' }}" class="col-sm-3 control-label">
                                    @if ($errors->has('sku'))
                                        <i class="fa fa-times-circle-o"></i> 
                                    @endif
                                    {{ __('Sku') }}
                                </label>

                                <div class="col-sm-9">
                                    <input id="sku" type="text" class="form-control" id="{{ $errors->has('sku') ? 'inputError' : '' }}" name="sku" value="{{ old('sku') }}" autofocus>

                                    @if ($errors->has('sku'))
                                    <span class="help-block">{{ $errors->first('sku') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }} ">
                                <label for="{{ $errors->has('category_id') ? 'inputError' : 'category_id' }}" class="col-sm-3 control-label">
                                    @if ($errors->has('category_id'))
                                        <i class="fa fa-times-circle-o"></i> 
                                    @endif
                                    {{ __('Category') }}
                                </label>

                                <div class="col-sm-9">
                                    <select class="form-control select2" data-placeholder="Select a Category"
                                        style="width: 100%;"id="{{ $errors->has('category_id') ? 'inputError' : 'category_id' }}" name="category_id" value="{{ old('category_id') }}">
                                    @foreach ($categories as $category)  
                                        <option value="{{ $category->id }}" <?php if (old('category_id') == $category->id) echo "selected" ?>>{{ $category->name}}</option>
                                    @endforeach
                                    </select>                               
                                    @if ($errors->has('category_id'))
                                    <span class="help-block">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group {{ $errors->has('brand_id') ? 'has-error' : '' }} ">
                                <label for="{{ $errors->has('brand_id') ? 'inputError' : 'brand_id' }}" class="col-sm-3 control-label">
                                    @if ($errors->has('brand_id'))
                                        <i class="fa fa-times-circle-o"></i> 
                                    @endif
                                    {{ __('Brand') }}
                                </label>

                                <div class="col-sm-9">
                                    <select class="form-control select2" data-placeholder="Select a Brand"
                                        style="width: 100%;"id="{{ $errors->has('brand_id') ? 'inputError' : 'brand_id' }}" name="brand_id" value="{{ old('brand_id') }}">
                                    @foreach ($brands as $brand)  
                                        <option value="{{ $brand->id }}" <?php if (old('brand_id') == $brand->id) echo "selected" ?>>{{ $brand->name}}</option>
                                    @endforeach
                                    </select>

                                    @if ($errors->has('brand_id'))
                                    <span class="help-block">{{ $errors->first('brand_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }} ">
                                <label for="{{ $errors->has('price') ? 'inputError' : 'price' }}" class="col-sm-3 control-label">
                                    @if ($errors->has('price'))
                                        <i class="fa fa-times-circle-o"></i> 
                                    @endif
                                    {{ __('Price') }}
                                </label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id=" {{ $errors->has('price') ? 'inputError' : 'price' }}" name="price" value="{{ old('price') }}">

                                    @if ($errors->has('price'))
                                    <span class="help-block">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }} ">
                                <label for="{{ $errors->has('image') ? 'inputError' : 'image' }}" class="col-sm-3 control-label">
                                    @if ($errors->has('image'))
                                        <i class="fa fa-times-circle-o"></i> 
                                    @endif
                                    {{ __('Image') }}
                                </label>

                                <div class="col-sm-9">
                                    <input type="file"  name="image" class="form-control-file" id="image">

                                    @if ($errors->has('image'))
                                    <span class="help-block">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('images_detail') ? 'has-error' : '' }} ">
                                <label for="{{ $errors->has('images_detail') ? 'inputError' : 'images_detail' }}" class="col-sm-3 control-label">
                                    @if ($errors->has('images_detail'))
                                        <i class="fa fa-times-circle-o"></i> 
                                    @endif
                                    {{ __('Images Detail') }}
                                </label>

                                <div class="col-sm-9">
                                    <input type="file" name="images_detail[]" multiple>

                                    @if ($errors->has('images_detail'))
                                    <span class="help-block">{{ $errors->first('images_detail') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="attribute-label">
                                <div class="col-sm-3 ">
                                    <span>Color</span>
                                </div>
                                <div class="col-sm-3">
                                    <span>Size</span>
                                </div>
                                <div class="col-sm-3">
                                    <span>Quantity</span>
                                </div>
                                <div class="col-sm-3">
                                    <span>Image</span>
                                </div>
                            </div>
                            <div class="attribute-value">
                                <div class="first-row col-sm-12">
                                    <div class="col-sm-3">
                                        <div class="form-group {{ $errors->has('color_id[]') ? 'has-error' : '' }} ">
                                            <div class="col-sm-12">
                                                <select class="form-control" name="color_id[]">
                                                    @foreach ($colors as $color)  
                                                        <option value="{{$color->id}}">{{ $color->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <select class="form-control" name="size_id[]">
                                                @foreach ($sizes as $size)  
                                                    <option value="{{ $size->id }}">{{ $size->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <input 
                                                    type="number" 
                                                    class="form-control" 
                                                    name="attribute_quantity[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <input type="file"  name="attribute_image[]" class="form-control-file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            
                            <div class="col-md-4">
                                <a class="btn" role="button" id="btn-attr-add">{{ __('attribute.attribute_add_new') }}</a>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary pull-right">{{ __('Create') }}</button>
                            </div>                          
                        </div>
                        <!-- /.box-footer -->                     
                    </form>

                    <div class="template hidden col-sm-12">
                        <div class="col-sm-3">
                            <div class="form-group {{ $errors->has('color_id[]') ? 'has-error' : '' }} ">
                                <div class="col-sm-12">
                                    <select class="form-control" name="color_id[]">
                                        @foreach ($colors as $color)  
                                            <option value="{{$color->id}}">{{ $color->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select class="form-control" name="size_id[]">
                                    @foreach ($sizes as $size)  
                                        <option value="{{ $size->id }}">{{ $size->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        name="attribute_quantity[]">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="file"  name="attribute_image[]" class="form-control-file">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/admin_product.js') }}"></script>
@stop

