@extends('admin.default')

@section('page-header')
     <small>{{ trans('app.manage users') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.users.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{__('app.name')}}</th>
                        <th>{{__('app.Email')}}</th>
                        <th>{{__('app.role')}}</th>
                        <th>{{__('app.details')}}</th>
                        <th>{{__('app.Actions')}}</th>
                    </tr>
                </thead>



                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td><a href="{{ route(ADMIN . '.users.edit', $item->id) }}">{{ $item->name }}</a></td>
                            <td>{{ $item->email }}</td>
                           @if ($item->role == 1)
                               <td>
                                <span class="btn btn-primary">Admin</span>
                               </td>
                           @else
                           <td>
                            <span class="btn btn-success">{{__('app.client')}}</span>
                           </td>
                           @endif

                           <td>
                            @if (isset($item->client))
                                <a href="{{route(ADMIN . '.clients.show' , $item->client->id)}}">{{$item->client->name}}</a>
                            @else
                                <li>{{$item->name}}</li>
                            @endif
                           </td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route(ADMIN . '.users.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                    <li class="list-inline-item">
                                        {!! Form::open([
                                            'class'=>'delete',
                                            'url'  => route(ADMIN . '.users.destroy', $item->id),
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
