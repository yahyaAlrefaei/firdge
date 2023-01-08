@extends('admin.default')

@section('page-header')
	 <small>{{ trans('app.add_new_user') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => [ ADMIN . '.users.store' ],
			'files' => true
		])
	!!}

		@include('admin.users.form')

		<button style="margin-right: 200px;" type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>

	{!! Form::close() !!}

@stop
