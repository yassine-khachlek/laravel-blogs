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

<form action="{{ Route::has('blogs.store') ? route('blogs.store') : '#' }}" method="POST">
	{{ method_field('POST') }}
	{{ csrf_field() }}

	<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	    <input name="title" type="text" value="{{ old('title') }}" class="form-control" placeholder="Title">

        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
	</div>

	<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
	    <textarea name="body" rows="10" class="form-control" placeholder="Body">{{ old('body') }}</textarea>

        @if ($errors->has('body'))
            <span class="help-block">
                <strong>{{ $errors->first('body') }}</strong>
            </span>
        @endif
	</div>

	<div class="checkbox">
		<label>
			<input name="published" type="checkbox" value="1" {{ old('published') ? 'checked="checked"' : '' }}>
			<noscript>Published</noscript>
		</label>
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

<link href="{{ asset('/vendor/yk/laravel-blogs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}" rel="stylesheet">
@append

@section('scripts')
<script src="{{ asset('/vendor/yk/laravel-blogs/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>

<script src="{{ asset('/vendor/yk/laravel-blogs/tinymce/tinymce.min.js') }}"></script>

<script type="text/javascript">
$( document ).ready(function() {
	tinymce.init({
	  selector: 'textarea',
	  height: 300,
	  menubar: true,
	  plugins: [
	    'advlist autolink lists link image charmap print preview anchor',
	    'searchreplace visualblocks code fullscreen',
	    'insertdatetime media table contextmenu paste code'
	  ],
	  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	  content_css: '//www.tinymce.com/css/codepen.min.css'
	});

	$("[name='published']").bootstrapSwitch({onText: 'Publish', offText: 'Draft'});
	$(".checkbox > label").css("padding-left", "0px");
})
</script>
@append