@extends('admin.default')

@section('page-header')
	 <small>{{ trans('app.update_expense') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'route'  => [ ADMIN . '.expenses.update', $item->id ],
			'method' => 'put',
			'files'  => true
		])
	!!}

		@include('admin.expenses.form')

		<button style="margin-right: 200px;" type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>

	{!! Form::close() !!}

@stop
