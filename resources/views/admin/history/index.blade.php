@extends('admin.default')

@section('page-header')
    <small>{{ __('app.history') }}</small>
@endsection

@section('content')


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th>{{__('app.user')}}</th>
                    <th>{{__('app.action')}}</th>
                    <th>{{__('app.number_kilo')}}</th>
                    <th>{{__('app.sacks_number')}}</th>
                    <th>{{__('app.date')}}</th>
                </tr>
                </thead>





                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <img class="rounded-circle " width="40px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"></td>
                        <td>{{ $item->userRelation->name }}</td>
                        <td>
                            @php
                                if($item->action == 'insert'){
                                    echo '<span class="badge badge-primary">'. __('app.'.$item->action).'</span>';
                                }else if ($item->action == 'exit'){
                                    echo '<span class="badge badge-dark">'. __('app.'.$item->action).'</span>';
                                }
                            @endphp
                        </td>
                        <td>{{ $item->number_kilo }}</td>
                        <td>{{ $item->sacks_number }}</td>
                        <td>{{ $item->date }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

@endsection
