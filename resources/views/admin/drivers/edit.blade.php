@extends('admin.default')

@section('page-header')
	 <small>{{ trans('app.update driver') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'route'  => [ ADMIN . '.drivers.update', $item->id ],
			'method' => 'put',
			'files'  => true
		])
	!!}

		@include('admin.drivers.form')

		<button style="margin-right: 200px;" type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>

	{!! Form::close() !!}

@stop
