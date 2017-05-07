@extends('Yk\LaravelBlogs::layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<a href="{{ Route::has('backend.blogs.index') ? route('backend.blogs.index') : '#' }}" class="btn btn-lg btn-primary btn-block">
				<i class="fa fa-list" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div>

<form action="{{ Route::has('backend.blogs.update') ? route('backend.blogs.update', ['id' => $blog->id]) : '#' }}" method="POST">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	@foreach(Config::get('yk.laravel-blogs.languages') as $language_key => $language)
	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
	        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $language_key }}" aria-expanded="true" aria-controls="collapse{{ $language_key }}">
				@if(Config::get('yk.laravel-blogs.languages.'.$language_key.'.'.'flag'))
				<span class="flag-icon flag-icon-{{ $language['flag'] }}"></span>
				@endif
	          {{ $language['native_name'] }}
	        </a>
	      </h4>
	    </div>
	    <div id="collapse{{ $language_key }}" class="panel-collapse collapse {{ $language_key === App::getLocale() ? 'in' :'' }}" role="tabpanel" aria-labelledby="headingOne">
	      <div class="panel-body">

			<div class="form-group{{ $errors->has('title_'.$language_key) ? ' has-error' : '' }}">
			    <input name="title_{{ $language_key }}" type="text" value="{{ old('title', $blog->getTranslation($language_key)->title) }}" class="form-control" placeholder="Title">

		        @if ($errors->has('title_'.$language_key))
		            <span class="help-block">
		                <strong>{{ $errors->first('title_'.$language_key) }}</strong>
		            </span>
		        @endif
			</div>

			<div class="form-group{{ $errors->has('body_'.$language_key) ? ' has-error' : '' }}">
			    <textarea name="body_{{ $language_key }}" rows="10" class="form-control" placeholder="Body">{{ old('body', $blog->getTranslation($language_key)->body) }}</textarea>

		        @if ($errors->has('body_'.$language_key))
		            <span class="help-block">
		                <strong>{{ $errors->first('body_'.$language_key) }}</strong>
		            </span>
		        @endif
			</div>

			<div class="checkbox">
				<label>
					<input name="published_{{ $language_key }}" type="checkbox" value="1" {{ old('published_'.$language_key, $blog->getTranslation($language_key)->published) ? 'checked="checked"' : '' }}>
					<noscript>Publish</noscript>
				</label>
			</div>

	      </div>
	    </div>
	  </div>

	@endforeach
	</div>

	<div class="checkbox">
		<label>
			<input name="published" type="checkbox" value="1" {{ old('published', $blog->published) ? 'checked="checked"' : '' }}>
			<noscript>Publish</noscript>
		</label>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<a href="{{ Route::has('backend.blogs.index') ? route('backend.blogs.index') : '#' }}" class="btn btn-lg btn-block btn-default">
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/css/flag-icon.min.css" />

<style type="text/css">
	.panel-title > a:link, a:hover, a:active, a:visited{
		text-decoration: none;
	}
</style>
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

	$("[name^='published_']").bootstrapSwitch({onText: 'Publish', offText: 'Draft'});
	$("[name='published']").bootstrapSwitch({onText: 'Publish', offText: 'Draft'});
	$(".checkbox > label").css("padding-left", "0px");
})
</script>
@append