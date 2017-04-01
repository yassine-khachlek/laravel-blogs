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

<form action="{{ Route::has('blogs.update') ? route('blogs.update', ['id' => $blog->id]) : '#' }}" method="POST">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	    <input name="title" type="text" value="{{ old('title', $blog->title) }}" class="form-control" placeholder="Title">

        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
	</div>

	<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
	    <textarea name="body" rows="10" class="form-control" placeholder="Body">{{ old('body', $blog->body) }}</textarea>

        @if ($errors->has('body'))
            <span class="help-block">
                <strong>{{ $errors->first('body') }}</strong>
            </span>
        @endif
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<a href="{{ Route::has('blogs.index') ? route('blogs.index') : '#' }}" class="btn btn-lg btn-block btn-default">
					CANCEL
				</a>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<button type="submit" class="btn btn-danger btn-block btn-lg">
					SAVE
				</button>
			</div>
		</div>
	</div>
</form>
@append

@section('styles')
<link href="{{ asset('/vendor/yk/laravel-blogs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
@append

@section('scripts')

@append