@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<a href="{{ Route::has('backend.blogs.create') ? route('backend.blogs.create') : '#' }}" class="btn btn-lg btn-success btn-block">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div>

@if($blogs->count())
	<table class="table table-striped table-hover">
		<thead>
			<th>ID</th>
			<th>Title</th>
			<th></th>
			<th></th>
		</thead>
		<body>
		@foreach($blogs as $blog)
			<tr>
				<td>
					{{ $blog->id }}
				</td>
				<td>
					{{ $blog->locale->title }}
				</td>
				<td>
					@if($blog->published)
						<span class="label label-success pull-right">Published</span>
					@else
						<span class="label label-default pull-right">Draft</span>
					@endif
				</td>
				<td>
					<form action="{{ Route::has('backend.blogs.destroy') ? route('backend.blogs.destroy', ['id' => $blog->id]) : '#' }}" method="POST" class="form-inline pull-right">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<button type="submit" class="btn btn-lg btn-danger">
							<i class="fa fa-trash" aria-hidden="true"></i>
						</button>
					</form>

					<a href="{{ Route::has('backend.blogs.edit') ? route('backend.blogs.edit', ['id' => $blog->id]) : '#' }}" class="btn btn-lg btn-warning pull-right">
						<i class="fa fa-edit" aria-hidden="true"></i>
					</a>

					<a href="{{ Route::has('backend.blogs.show') ? route('backend.blogs.show', ['id' => $blog->id]) : '#' }}" class="btn btn-lg btn-primary pull-right">
						<i class="fa fa-eye" aria-hidden="true"></i>
					</a>
				</td>
			</tr>
		@endforeach
		</body>
	</table>

	@if( method_exists($blogs, 'links') )
		{{ $blogs->links() }}
	@endif
@else
	<div class="alert alert-danger" role="alert">
		No items available.
	</div>
@endif
@append

@section('styles')
<link href="{{ asset('/vendor/yk/laravel-blogs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

<style type="text/css">
	.table > tbody > tr > td:last-child > a {
		margin-left: 8px;
	}
	.table > tbody > tr > td:last-child > form {
		margin-left: 8px;
	}
</style>
@append