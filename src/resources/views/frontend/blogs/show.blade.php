@extends('Yk\LaravelBlogs::layouts.app')

@section('content')
	<h1>{{ $blog->locale->title }}</h1>

	{!! $blog->locale->body !!}

	<a href="{{ Route::has('frontend.blogs.index') ? route('frontend.blogs.index') : '#' }}" class="btn btn-lg btn-default btn-block">
		Back
	</a>
@append

@section('styles')
	<link href="{{ asset('/vendor/yk/laravel-blogs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

	<meta property="og:site_name" content="{{ config('app.name', '') }}">
	<meta property="og:title" content="{{ $blog->meta_title }}">
	<meta property="og:description" content="{{ $blog->meta_description }}">
	{{--
	<meta property="og:image" content="">
	--}}
	<meta property="og:url" content="{{ route('frontend.blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) }}">
	<meta property="og:type" content="website">

	<meta name="twitter:title" content="{{ $blog->meta_title }}">
	<meta name="twitter:description" content="{{ $blog->meta_description }}">
	{{--
	<meta name="twitter:image" content="">
	--}}
	<meta name="twitter:card" content="{{ route('frontend.blogs.show', ['id' => $blog->id]) }}">
	<meta name="twitter:image:alt" content="{{ $blog->locale->title }}">
@append

@section('head.title'){{ $blog->meta_title }}@append

@section('head.meta.description'){{ $blog->meta_description }}@append

