@extends('Yk\LaravelBlogs::layouts.app')

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
	<table id="blogs-table" class="table table-striped table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
			</tr>
		</thead>
		<tbody>
		@foreach($blogs as $blog)
			<tr>
				<td>
					{{ str_pad($blog->id, 9, 0, STR_PAD_LEFT) }}
				</td>
				<td>
					{{ $blog->locale->title }}
				</td>
				{{--
				<td>
					@if($blog->published)
						<span class="label label-success pull-right">Published</span>
					@else
						<span class="label label-default pull-right">Draft</span>
					@endif
				</td>
				<td>
					<form action="{{ Route::has('backend.blogs.destroy') ? route('backend.blogs.destroy', ['id' => $blog->id]) : '#' }}" method="POST" class="form-inline pull-right" onsubmit="return confirm('Do you really want to delete the post?');">
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
				--}}
			</tr>
		@endforeach
		</tbody>
	</table>

	<noscript>
	@if( method_exists($blogs, 'links') )
		{{ $blogs->links() }}
	@endif
	</noscript>
@else
	<div class="alert alert-danger" role="alert">
		No items available.
	</div>
@endif
@append

@section('styles')
<link href="{{ asset('/vendor/yk/laravel-blogs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('/vendor/yk/laravel-blogs/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

<style type="text/css">
	.table > tbody > tr > td:last-child > a {
		margin-left: 8px;
	}
	.table > tbody > tr > td:last-child > form {
		margin-left: 8px;
	}
</style>
@append

@section('scripts')
<script src="{{ asset('/vendor/yk/laravel-blogs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/vendor/yk/laravel-blogs/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(function() {
    $('#blogs-table').DataTable({
        language: {
            "url": "{{ asset('/vendor/yk/laravel-blogs/datatables-i18n/i18n/en.json') }}"
        },
        processing: true,
        serverSide: true,
        
        ajax: '{{ route('backend.blogs.datatables.data') }}',
        
        columns: [
            { data: 'id', name: 'id' },
            { data: 'locale.title', name: 'translations.title' }
        ]
    });
});
</script>
@append