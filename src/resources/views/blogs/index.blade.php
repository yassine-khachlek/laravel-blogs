@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<a href="{{ Route::has('blogs.create') ? route('blogs.create') : '#' }}" class="btn btn-lg btn-success btn-block">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div>

<table class="table table-striped table-hover">
	<body>
	@foreach($blogs as $blog)
		<tr>
			<td>
				{{ $blog->id }}
			</td>
			<td>
				{{ $blog->title }}
			</td>
			<td>
				<form action="{{ Route::has('blogs.destroy') ? route('blogs.destroy', ['id' => $blog->id]) : '#' }}" method="POST" class="form-inline pull-right">
					{{ method_field('DELETE') }}
					{{ csrf_field() }}
					<button type="submit" class="btn btn-lg btn-danger">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</button>
				</form>

				<a href="{{ Route::has('blogs.edit') ? route('blogs.edit', ['id' => $blog->id]) : '#' }}" class="btn btn-lg btn-warning pull-right">
					<i class="fa fa-edit" aria-hidden="true"></i>
				</a>

				<a href="{{ Route::has('blogs.show') ? route('blogs.show', ['id' => $blog->id]) : '#' }}" class="btn btn-lg btn-primary pull-right">
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
@append

@section('styles')
<link href="{{ asset('/vendor/yk/laravel-blogs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

<style type="text/css">
	.table :last-child > a {
		margin-left: 8px;
	}
	.table :last-child > form {
		margin-left: 8px;
	}
</style>
@append