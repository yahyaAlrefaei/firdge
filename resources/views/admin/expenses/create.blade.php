@extends('admin.default')

@section('page-header')
	 <small>{{ trans('app.add_expense') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => [ ADMIN . '.expenses.store' ],
			'files' => false
		])
	!!}

		@include('admin.expenses.form')

		<button style="margin-right: 200px;" type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>

	{!! Form::close() !!}

@stop
