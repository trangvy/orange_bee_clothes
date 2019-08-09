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
<header class="masthead" style="background-image: url('img/post-bg.jpg')">
    <div class="overlay">
   		<div class="container">
      		<div class="row">
        		<div class="col-lg-8 col-md-10 mx-auto">
          			<div class="post-heading">
           				<h1>{{ $post->title }}</h1>
            			<span class="meta">Posted by
              			<a href="#">Start Bootstrap</a>on August 24, 2019</span>
	          		</div>
	        	</div>
	      	</div>
	    </div>
	</div>
</header>
<body>
	<article>
	    <div class="container">
	      	<div class="row">
		        <div class="col-lg-8 col-md-10 mx-auto">
		        <p>{{ $post->body }}</p>
		        </div>
	      	</div>
	    </div>
  	</article>
</body>
@endsection
