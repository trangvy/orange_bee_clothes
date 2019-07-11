@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('category.create_category') }}</h3>
                    </div>
                    <form method="POST" action="{{ route('admin.category.store') }}" class="form-horizontal">
                        @csrf
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} ">
                                <label for="{{ $errors->has('name') ? 'inputError' : 'name' }}" class="col-sm-3 control-label">
                                    @if ($errors->has('name'))
                                        <i class="fa fa-times-circle-o"></i>
                                    @endif
                                    {{ __('category.name') }}
                                </label>
                                <div class="col-sm-9">
                                    <input id="name" type="text" class="form-control" id="{{ $errors->has('name') ? 'inputError' : '' }}" name="name" value="{{ old('name') }}" autofocus>
                                    @error('name')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary pull-right">{{ __('category.create') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
