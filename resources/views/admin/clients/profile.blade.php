@extends('admin.default')

@section('page-header')
    <small>{{ trans('app.client profile') }}</small>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">
@endpush
@section('content')
<style>


    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .profile-button {
        background: rgb(99, 39, 120);
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #682773
    }

    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }

    .profile-button:active {
        background: #682773;
        box-shadow: none
    }

    .back:hover {
        color: #682773;
        cursor: pointer
    }

    .labels {
        font-size: 11px
    }

    .add-experience:hover {
        background: #BA68C8;
        color: #fff;
        cursor: pointer;
        border: solid 1px #BA68C8
    }
</style>



<div class="  bg-white  ">
    <div class="row">
        <div class="col-5 ">
            <div class="p-30">
                @if (isset($client->user) && $client->user->avatar != null)
                <img  class="rounded-circle" width="150px" src="{{asset($client->user->avatar)}}">
                @else 
                <img  class="rounded-circle" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                @endif
                <div class="row">
                    <div class="col-6">
                       <h6>{{__("app.name")}}</h6>
                    </div>
                    <div class="col-6">
                        <h5>{{ $client->name}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h6>{{__("app.phone")}}</h6>
                    </div>
                    <div class="col-6">
                        <h5>{{ $client->phone}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h6>{{__("app.phone2")}}</h6>
                    </div>
                    <div class="col-6">
                        <h5>{{ $client->phone2}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h6>{{__("app.companyName")}}</h6>
                    </div>
                    <div class="col-6">
                        <h5>{{ $client->companyName}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h6>{{__("app.address")}}</h6>
                    </div>
                    <div class="col-6">
                        <h5>{{ $client->address}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h6>{{__("app.ID_card_number")}}</h6>
                    </div>
                    <div class="col-6">
                        <h5>{{ $client->ID_card_number}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="pt-30 pl-20">
                <div class="dropdown mb-10">
                    <button class="btn btn-primary dropdown-toggle" 
                    type="button" id="dropdownMenuButton" data-toggle="dropdown" 
                    aria-haspopup="true" aria-expanded="false">
                     {{__("app.season_list")}}
                    </button>
                    <input type="hidden" id="seasonFilter">
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach ($seasons as $s)
                        {{-- {{url(ADMIN . '/clients/' .$client->id .'?season=' .$s->id )}} --}}
                        <a class="dropdown-item season-item" 
                        href="#!" data-id="{{$s->id}}">{{$s->seasonName}}</a>
                        @endforeach
                    </div>
                  </div>
                    <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <table style="width: 100%;" class="table table-bordered data-table responsive">
                                <h2>{{__("app.stock")}}</h2>
                                <a href="{{route(ADMIN . '.clients.exportClientStock' , $client->id)}}" class="btn btn-primary d-inline-block">
                                    <i class="fa fa-print"></i></a>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('app.number_kilo')}}</th>
                                    <th>{{__('app.product')}}</th>
                                    <th>{{__('app.the_type')}}</th>
                                    <th>{{__('app.sacks_number')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <br>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
    
                <div class="table-responsive">
            
                    <h2>{{__("app.advances")}}</h2>
                    <a href="{{route(ADMIN . '.clients.exportClientAdvances' , $client->id)}}" class="btn btn-primary d-inline-block">
                        <i class="fa fa-print"></i></a>
                    <table id="" class="table data-table2 table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('app.seasonName')}}</th>
                                <th>{{__('app.amount')}}</th>
                                <th>{{__('app.date')}}</th>
                            </tr>
                        </thead>
            
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="pt-30 pl-20">
                    <div class="bgc-white bd bdrs-3 p-20 mB-20">
                        <h2>{{__('app.finances')}}</h2>
                        <a href="{{route(ADMIN . '.clients.exportClientFinances' , $client->id)}}" class="btn btn-primary d-inline-block">
                            <i class="fa fa-print"></i></a>
                            <table style="width: 100%;" class="table table-bordered table-process responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('app.seasonName')}}</th>
                                    <th>{{__('app.total_kgs')}}</th>
                                    <th>{{__('app.total_sacks')}}</th>
                                    <th>{{__('app.kgs_in_stock')}}</th>
                                    <th>{{__('app.sacks_in_stock')}}</th>
                                    <th>{{__('app.ton_price')}}</th>
                                    <th>{{__('app.total_amount')}}</th>
                                    <th>{{__('app.paid_amount')}}</th>
                                    <th>{{__('app.remained_amount')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="bgc-white bd bdrs-3 p-20 mB-20">

    <div class="table-responsive">
        <div class="">
            <h2>{{__("app.processes")}}</h2>
            <a href="{{route(ADMIN . '.clients.exportClientProcesses' , $client->id)}}" class="btn btn-primary d-inline-block">
                <i class="fa fa-print"></i></a>
        </div>
        
        <table id="" class="table data-table1 table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('app.seasonName')}}</th>
                    <th>{{__('app.floor')}}</th>
                    <th>{{__('app.warehouse')}}</th>
                    <th>{{__('app.product')}}</th>
                    <th>{{__('app.type')}}</th>
                    <th>{{__('app.sacks_type')}}</th>
                    <th>{{__('app.process_type')}}</th>
                    <th>{{__('app.date')}}</th>
                    <th>{{__('app.sacks_number')}}</th>
                    <th>{{__('app.number_kilo')}}</th>
                </tr>
            </thead>

            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection

<script type="text/javascript">
</script>
@push('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script type="text/javascript">

$(function() {
    var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              searching: false,
               paging: true, 
               info: true,
              ajax: {
                url : "{{ route('admin.clients.show' , $client->id) }}",
                data : function(d) {

                    d.season_id = $("#seasonFilter").val()
                }
            },
              columns: [
                  {data: 'DT_RowIndex', name: 'index'},
                  {data: 'number_kilo', name: 'number_kilo'},
                  {data: 'product_relation.productName', name: 'productName'},
                  {data: 'type_relation.type', name: 'type'},
                  {data: 'sacks_number', name: 'sacks_number'},
                  
              ]
          });

          var table2 = $('.table-process').DataTable({
              processing: false,
              serverSide: true,
              searching: false,
               paging: true, 
               info: true,
              ajax: {
                url : "{{ route('admin.client.displayClientAdvances' , $client->id) }}"
            },
              columns: [
                  {data: 'DT_RowIndex', name: 'index'},
                  {data: 'seasonName', name: 'seasonName'},
                  {data: 'total_kgs', name: 'total_kgs'},
                  {data: 'total_sacks', name: 'total_sacks'},
                  {data: 'kgs_in_stock', name: 'kgs_in_stock'},
                  {data: 'sacks_in_stock', name: 'sacks_in_stock'},
                  {data: 'ton_price', name: 'ton_price'},
                  {data: 'total_amount', name: 'total_amount'},
                  {data: 'paid_amount', name: 'paid_amount'},
                  {data: 'remained_amount', name: 'remained_amount'},
                  
              ]
          });
    
          var table3 = $('.data-table1').DataTable({
            buttons: [
                 'pdf'
              ],
              processing: true,
              serverSide: true,
              searching: false,
               paging: true, 
               info: true,
              ajax: {
                url : "{{ route('client.processes', $client->id) }}",
                data : function(d) {
                }
            },
              columns: [
                  {data: 'DT_RowIndex', name: 'index'},
                  {data: 'season_relation.seasonName', name: 'season_relation.seasonName'},
                  {data: 'floor_relation.floorName', name: 'floor_relation.floorName'},
                  {data: 'warehouse_relation.warehouseName', name: 'warehouse_relation.warehouseName'},
                  {data: 'product_relation.productName', name: 'product_relation.productName'},
                  {data: 'type_relation.type', name: 'type_relation.type'},
                  {data: 'sacks_relation.sacksName', name: 'sacks_relation.sacksName'},
                  {data: 'process_type_d', name: 'process_type_d'},
                  {data: 'date', name: 'date'},
                  {data: 'sacks_number', name: 'sacks_number'},
                  {data: 'number_kilo', name: 'number_kilo'},
              ]
          });
          table3.buttons().container().appendTo( $('.col-sm-6:eq(0)', table3.table().container() ) );

          //////////////////////////////////////////////
          var table4 = $('.data-table2').DataTable({
              processing: true,
              serverSide: true,
              searching: false,
               paging: true, 
               info: true,
              ajax: {
                url : "{{ route('client.advances', $client->id) }}",
                data : function(d) {
                }
            },
              columns: [
                  {data: 'DT_RowIndex', name: 'index'},
                  {data: 'season.seasonName', name: 'season.seasonName'},
                  {data: 'amount', name: 'amount'},
                  {data: 'date', name: 'date'},
              ]
          });

          $(".season-item").on('click' , function(e) {
            let season_id = $(this).attr('data-id');
            $("#seasonFilter").val(season_id)
            table.draw();
          })
})
       
 </script>
@endpush