@extends('adminlte::page')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('brand.brand_list') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="alert alert-success" role="alert" style="display: none;">
                            </div>
                            <div class="alert alert-warning" role="alert" style="display: none;">
                            </div>
                        <table class="table" width="100%">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('brand.name') }}</th>
                                <th scope="col">{{ __('brand.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr class="row_{{ $brand->id }}">
                                    <th scope="row">{{ $brand->id }}</th>
                                        <td>{{ $brand->name }}</td>
                                        <td>
                                            <a href="brands/{{ $brand->id }}/edit" class="btn btn-info" role="button">{{ __('brand.edit') }}</a>
                                            <div id="btn-del-brand" class="btn btn-info btn-del-brand" role="button" data-brand-id="{{ $brand->id }}">{{ __('brand.delete') }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/delete_brand.js') }}"></script>
@endsection
