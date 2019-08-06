@extends('adminlte::page')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Posts') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" required autofocus>
                                @error('title')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('image') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" required>
                                @error('image')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                            <div class="col-md-6">
                                <input id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required autofocus>
                                @error('content')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="equal height row">
                                <textarea name="body" id="editor"></textarea>
                            </div>
                            <script>
                                var simplemde = new SimpleMDE({ element: document.getElementById("editor") })
                            </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="container">
    <form method="POST" id="upload_form" enctype="multipart/form-data">
        @csrf
        <table class="table">
            <tr>
                <td width="40%" align="left"><label>Select File for Upload</label></td>
                </tr>
                <td width="30"><input type="file" name="select_file" id="select_file" /></td>
                </tr>
                <td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
            </tr>
        </table>
        <br/>
    </form>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/upload-image.js') }}"></script>
@endsection
