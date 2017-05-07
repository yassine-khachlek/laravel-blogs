@extends('Yk\LaravelBlogs::layouts.app')

@section('content')
<h1>{{ $blog->locale->title }}</h1>

<div class="row">
	<div class="col-md-12">
		{!! $blog->locale->body !!}
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<a href="{{ Route::has('frontend.blogs.index') ? route('frontend.blogs.index') : '#' }}" class="btn btn-lg btn-default btn-block">
				Back
			</a>
		</div>
	</div>
</div>
@append

@section('styles')
<link href="{{ asset('/vendor/yk/laravel-blogs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
@append