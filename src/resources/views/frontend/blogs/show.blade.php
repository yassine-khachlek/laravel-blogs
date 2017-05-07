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
	<meta property="og:title" content="{{ $blog->locale->title }}">
	<meta property="og:description" content="{{ str_limit(preg_replace('/\s+/', ' ', trim(strip_tags(str_replace("&nbsp;", "", $blog->locale->body)))), 160, '') }}">
	{{--
	<meta property="og:image" content="http://euro-travel-example.com/thumbnail.jpg">
	--}}
	<meta property="og:url" content="{{ route('frontend.blogs.show', ['id' => $blog->id]) }}">
	<meta property="og:type" content="website">

	<meta name="twitter:title" content="{{ $blog->locale->title }}">
	<meta name="twitter:description" content="{{ str_limit(preg_replace('/\s+/', ' ', trim(strip_tags(str_replace("&nbsp;", "", $blog->locale->body)))), 160, '') }}">
	{{--
	<meta name="twitter:image" content="">
	--}}
	<meta name="twitter:card" content="{{ route('frontend.blogs.show', ['id' => $blog->id]) }}">
	<meta name="twitter:image:alt" content="{{ $blog->locale->title }}">
@append

@section('head.title'){{ str_limit($blog->locale->title, 60, '') }}@append

@section('head.meta.description'){{ str_limit(preg_replace('/\s+/', ' ', trim(strip_tags(str_replace("&nbsp;", "", $blog->locale->body)))), 160, '') }}@append

