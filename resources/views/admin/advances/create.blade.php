@extends('admin.default')

@section('page-header')
	 <small>{{ trans('app.add-advance') }}</small>
@stop

@section('content')

@if (isset($advance)) 

{!! Form::model($advance, [
	'route'  => [ ADMIN . '.advances.update', $advance->id ],
	'method' => 'put',
	'files'  => true
])
!!}	
@else
{!! Form::open([
	'route' => [ ADMIN . '.advances.store' ],
	'files' => false
])
!!}
@endif
		@include('admin.advances.form')

		<button  style="margin-right: 200px;" type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>

	{!! Form::close() !!}

@stop
