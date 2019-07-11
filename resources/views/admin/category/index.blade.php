@extends('adminlte::page')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('category.category_list') }}</div>
                    <a href="/admin/categories/create" class="btn btn-info" role="button" style="margin-bottom:20px;">{{ __('category.create') }}</a>
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
                                <th scope="col">{{ __('category.name') }}</th>
                                <th scope="col">{{ __('category.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="row_{{ $category->id }}">
                                    <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="categories/{{ $category->id }}/edit" class="btn btn-info" role="button">{{ __('category.edit') }}</a>
                                            <div id="btn-del-category" class="btn btn-info btn-del-category" role="button" data-category-id="{{ $category->id }}">{{ __('category.delete') }}</div>
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
    <script src="{{ asset('js/delete_category.js') }}"></script>
@endsection
