@extends('admin.default')

@section('page-header')
	 <small>{{ trans('app.add_new_client') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => [ ADMIN . '.clients.store' ],
			'files' => false,
			'class' => 'client-form'
		])
	!!}

		@include('admin.clients.form')

		<button  style="margin-right: 200px;" type="submit" class="btn btn-primary client-submit">{{ trans('app.add_button') }}</button>

	{!! Form::close() !!}

@stop
