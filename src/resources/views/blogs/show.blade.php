@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<a href="{{ Route::has('blogs.index') ? route('blogs.index') : '#' }}" class="btn btn-lg btn-primary btn-block">
				<i class="fa fa-list" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div>

<h1>{{ $blog->locale->title }}</h1>

<div class="row">
	<div class="col-md-12">
		{!! $blog->locale->body !!}
	</div>
	<div class="col-md-12">
		@if($blog->published)
			<span class="label label-success">Published</span>
		@else
			<span class="label label-default">Draft</span>
		@endif
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<form action="{{ Route::has('blogs.destroy') ? route('blogs.destroy', ['id' => $blog->id]) : '#' }}" method="POST" onsubmit="return confirm('Do you really want to delete the post?');">
				{{ method_field('DELETE') }}
				{{ csrf_field() }}
				<button type="submit" class="btn btn-lg btn-danger btn-block">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</button>
			</form>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<a href="{{ Route::has('blogs.edit') ? route('blogs.edit', ['id' => $blog->id]) : '#' }}" class="btn btn-lg btn-warning btn-block">
				<i class="fa fa-edit" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div>
@append

@section('styles')
<link href="{{ asset('/vendor/yk/laravel-blogs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
@append

@section('scripts')

@append