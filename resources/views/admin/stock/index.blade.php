@extends('admin.default')

@section('page-header')
     <small>{{ __('app.manage_stock') }}</small>
@endsection

@section('content')


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{__('app.owner')}}</th>
                        <th>{{__('app.number_kilo')}}</th>
                        <th>{{__('app.product')}}</th>
                        <th>{{__('app.the_type')}}</th>
                        <th>{{__('app.sacks_number')}}</th>
                    </tr>
                </thead>





                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->clientRelation->name }}</td>
                            <td>{{ $item->number_kilo }}</td>
                            <td>{{ $item->productRelation['productName'] }}</td>
                            <td>{{ $item->typeRelation['type'] }}</td>
                            <td>{{ $item->sacks_number }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

@endsection
