@extends('admin.default')

@section('page-header')
	 <small>{{ trans('app.update user') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'route'  => [ ADMIN . '.users.update', $item->id ],
			'method' => 'put',
			'files'  => true
		])
	!!}

		@include('admin.users.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>

	{!! Form::close() !!}

@stop
