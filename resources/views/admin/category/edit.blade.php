@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('category.edit_category') }}</h3>
                    </div>
                    <form method="POST" action="{{ route('admin.category.update', $category->id) }}" class="form-horizontal">
                        @csrf
                        <div class="box-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="alert alert-success" style="display: none"></div>
                            <div class="alert alert-warning" style="display: none;"></div>
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} ">
                                <label for="{{ $errors->has('name') ? 'inputError' : 'name' }}" class="col-sm-3 control-label">
                                    @error('name')
                                        <span>{{ $message }}</span>
                                    @enderror
                                    {{ __('category.name') }}
                                </label>
                                <div class="col-sm-9">
                                    <input id="name" type="text" class="form-control" id="{{ $errors->has('name') ? 'inputError' : '' }}" name="name" value="{{ $category->name }}" autofocus>
                                    @error('name')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary pull-right">{{ __('category.update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
