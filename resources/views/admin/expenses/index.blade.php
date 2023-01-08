@extends('admin.default')

@section('page-header')
     <small>{{ trans('app.expenses') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.expenses.create') }}" class="btn btn-info">
            {{ trans('app.add_expense') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <div class="table-responsive">
            <a href="{{route(ADMIN . '.expenses.export')}}" class="btn btn-primary d-inline-block"><i class="fa fa-print"></i></a>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{__('app.type')}}</th>
                        <th>{{__('app.amount')}}</th>
                        <th>{{__('app.date')}}</th>
                        <th>{{__('app.notes')}}</th>
                        <th>{{__('app.Actions')}}</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($expenses as $item)
                        <tr>
                            <td>{{ __("app.$item->type") }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->notes }}</td>

                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route(ADMIN . '.expenses.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                    <li class="list-inline-item">
                                        {!! Form::open([
                                            'class'=>'delete',
                                            'url'  => route(ADMIN . '.expenses.destroy', $item->id),
                                            'method' => 'DELETE',
                                            ])
                                        !!}

                                            <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>

                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

@endsection
