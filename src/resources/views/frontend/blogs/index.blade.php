@extends('Yk\LaravelBlogs::layouts.app')

@section('content')
	@if($blogs->count())
		@foreach($blogs as $blog)
			<h2>
				<a href="{{ Route::has('frontend.blogs.show') ? route('frontend.blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) : '#' }}">
					{{ $blog->locale->title }}
				</a>
			</h2>

			<p>
				{{ $blog->description }}
			</p>

			<a href="{{ Route::has('frontend.blogs.show') ? route('frontend.blogs.show', ['id' => $blog->id, 'slug' => $blog->slug]) : '#' }}" class="btn btn-lg btn-primary btn-block">
				Read more...
			</a>
		@endforeach

		@if( method_exists($blogs, 'links') )
			{{ $blogs->links() }}
		@endif
	@else
		<div class="alert alert-danger" role="alert">
			No items available.
		</div>
	@endif
@append
