@extends('admin.default')

@section('page-header')
    <small>{{ __('app.manage_processes') }}</small>
@endsection

@section('content')
    <div class="row" style="margin-right: 10px;">
        <div class=" mB-20">
            <a href="{{ route(ADMIN . '.processes.create') }}" class="btn btn-info">
                {{ trans('app.add_button') }}
            </a>
        </div>
        {{--        <div  class="col-4"> --}}
        {{--            <label>{{__('app.seasonName')}}</label> --}}
        {{--            <select  style="background-color: transparent" type="text" class="form-control" name="season_id" value="{{ old('season_id') }}"> --}}
        {{--                <option value="">{{__('app.all')}}</option> --}}
        {{--                @foreach ($seasons as $k => $v) --}}
        {{--                    <option value="{{$v->id}}" >{{ $v->seasonName }}</option> --}}
        {{--                @endforeach --}}
        {{--            </select> --}}
        {{--        </div> --}}

    </div>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">

        <div class="table-responsive">
            <a href="{{ route(ADMIN . '.processes.export') }}" class="btn btn-primary d-inline-block"><i
                    class="fa fa-print"></i></a>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{ __('app.seasonName') }}</th>
                        <th>{{ __('app.client') }}</th>
                        <th>{{ __('app.floor') }}</th>
                        <th>{{ __('app.warehouse') }}</th>
                        <th>{{ __('app.number_kilo') }}</th>
                        <th>{{ __('app.product') }}</th>
                        <th>{{ __('app.type') }}</th>
                        <th>{{ __('app.sacks_type') }}</th>
                        <th>{{ __('app.sacks_number') }}</th>
                        <th>{{ __('app.sacks_color') }}</th>
                        <th>{{ __('app.process_type') }}</th>
                        <th>{{ __('app.date') }}</th>
                        <th>{{ __('app.notes') }}</th>
                        <th>{{ __('app.Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->seasonRelation->seasonName }}</td>
                            <td>{{ $item->clientRelation['name'] }}</td>
                            <td>{{ $item->floorRelation->floorName }}</td>
                            <td>{{ $item->warehouseRelation->warehouseName }}</td>
                            <td>{{ $item->number_kilo }}</td>
                            <td>{{ $item->productRelation['productName'] }}</td>
                            <td>{{ $item->typeRelation['type'] }}</td>
                            <td>{{ $item->sacksRelation['sacksName'] }}</td>
                            <td>{{ $item->sacks_number }}</td>
                            <td>{{ $item->sacks_color }}</td>

                            <td>
                                @php
                                    if ($item->process_type == 'insert') {
                                        echo '<span class="badge badge-primary">' . __('app.' . $item->process_type) . '</span>';
                                    } elseif ($item->process_type == 'exit') {
                                        echo '<span class="badge badge-dark">' . __('app.' . $item->process_type) . '</span>';
                                    }
                                @endphp
                            </td>
                            <td>{{ $item->date }}</td>
                            <td>
                                <span class="badge badge-info" onclick="showNotes({{ $item }})">
                                    <i class="fa-solid fa-eye" style="font-size: 20px;cursor: pointer"></i>
                                </span>
                            </td>

                            <td>
                                <ul class="list-inline">
                                    {{--                                    @if ($item['is_full_exit'] == true) --}}
                                    {{--                                        <span class="badge badge-success" > --}}
                                    {{--                                                {{__("app.ejected")}} --}}
                                    {{--                                            </span> --}}
                                    {{--                                    @endif --}}
                                    {{--                                    @if ($item['is_full_exit'] == false) --}}
                                    {{--                                        <li class="list-inline-item"> --}}
                                    {{--                                            <a href="{{ route(ADMIN . '.processes.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a> --}}
                                    {{--                                        </li> --}}
                                    {{--                                    @endif --}}
                                    <li class="list-inline-item">
                                        {!! Form::open([
                                            'class' => 'delete',
                                            'url' => route(ADMIN . '.processes.destroy', $item->id),
                                            'method' => 'DELETE',
                                        ]) !!}
                                        <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i
                                                class="ti-trash"></i></button>
                                        {!! Form::close() !!}
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="{{ route(ADMIN . '.processes.pdf', $item->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-print"></i></a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="modal fade" id="logs" tabindex="-1" role="dialog" aria-labelledby="logs" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.logs') }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('app.date') }}</th>
                                            <th scope="col">{{ __('app.process_type') }}</th>
                                            <th scope="col">{{ __('app.number_tons') }}</th>
                                            <th scope="col">{{ __('app.sacks_number') }}</th>
                                            <th scope="col">{{ __('app.car_number') }}</th>
                                            <th scope="col">{{ __('app.driver_name') }}</th>
                                            <th scope="col">{{ __('app.driver_number') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody class="theLogsShow">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="showTheNotes" tabindex="-1" role="dialog" aria-labelledby="logs"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.notes') }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container theNotes">

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        function showLogs(data) {
            $('.theLogsShow').html('')
            $.each(data[0]['logs'], function(index, val) {
                $('.theLogsShow').append(
                    '<tr>' +
                    '<th>' + val.date + '</th>' +
                    '<td>' + (val.process_type == "insert" ? "ادخال" : "اخراج") + '</td>' +
                    '<td>' + val.number_tons + '</td>' +
                    '<td>' + val.sacks_number + '</td>' +
                    '<td>' + val.car_number + '</td>' +
                    '<td>' + val.driver_name + '</td>' +
                    '<td>' + val.driver_number + '</td>' +




                    '</tr>'
                )
            })
            $("#logs").modal('show');
        }

        function showNotes(data) {
            console.log(data.notes)
            if (data.notes) {
                $('.theNotes').html('<p style="word-wrap: break-word" >' + data.notes + '</p>')
            } else {
                $('.theNotes').html('<p style="word-wrap: break-word" >' + "{{ __('app.no_description') }}" + '</p>')
            }

            $("#showTheNotes").modal('show');
        }
    </script>
@endpush
