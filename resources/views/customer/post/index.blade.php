@extends('layouts.orangebee')

@section('css')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
   <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">
@endsection

@section('content')
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      @foreach ($posts as $post)
        <div class="post-preview">
          <a href="/posts/{{ $post->id }}">
            <h2 class="post-title">
              {{ $post->title }}
            </h2>
            <img src="{{ asset(config('post.image_path') . $post->image) }}"/>
            <h3 class="post-subtitle">
              <td>{{ $post->content }}</td>
            </h3>
          </a>
          <p class="post-meta">Posted by Ducanh on September 24, 2019</p>
        </div>
      @endforeach
      </div>
    </div>
  </div>
</body>
@endsection