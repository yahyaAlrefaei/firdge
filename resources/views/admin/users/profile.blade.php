@extends('admin.default')

@section('page-header')
    <small>{{ trans('app.edit profile') }}</small>
@stop

@section('content')
    {!! Form::model($item, [
            'route'  => [ ADMIN . '.updateProfile', $item->id ],
            'method' => 'post',
            'files'  => true
        ])
    !!}

    @include('admin.users.formProfile')

    <button type="submit" class="btn btn-success">{{ trans('app.edit_button') }}</button>

    {!! Form::close() !!}

@stop
