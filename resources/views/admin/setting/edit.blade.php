@extends('admin.default')

@section('page-header')
	 <small>{{ trans('app.update client') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'route'  => [ ADMIN . '.clients.update', $item->id ],
			'method' => 'put',
			'files'  => true
		])
	!!}

		@include('admin.clients.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>

	{!! Form::close() !!}

@stop
