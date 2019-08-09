@extends('adminlte::page')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('post.post_list') }}</div>
                    <a href="/admin/posts/create" class="btn btn-info" role="button" style="margin-bottom:20px;">{{ __('post.create') }}</a>
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
                                <th scope="col">{{ __('post.title') }}</th>
                                <th scope="col">{{ __('post.content') }}</th>
                                <th scope="col">{{ __('post.image') }}</th>
                                <th scope="col">{{ __('post.body') }}</th>
                                <th scope="col">{{ __('post.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr class="row_{{ $post->id }}">
                                    <th scope="row">{{ $post->id }}</th>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->content }}</td>
                                        <td>{{ $post->image }}</td>
                                        <td>{{ $post->body }}</td>
                                        <td>
                                            <div id="btn-del-post" class="btn btn-info btn-del-post" role="button" data-post-id="{{ $post->id }}">{{ __('post.delete') }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row justify-content-center">
                          {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/delete_post.js') }}"></script>
@endsection
