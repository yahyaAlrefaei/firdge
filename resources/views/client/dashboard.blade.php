@extends('client.layout')

@section('page-header')
    <small>{{ trans('app.client-dashboard') }}</small>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endpush

@section('content')

<div class="bgc-white bd bdrs-3 p-20 mB-20">

    <div class="table-responsive">
        <h2>{{__("app.processes")}}</h2>
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
<br>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">

            <div class="table-responsive">
        
                <h2>{{__("app.advances")}}</h2>
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

    <div class="col-md-6 col-sm-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">

            <div class="table-responsive">
        
                <h2>{{__("app.stock")}}</h2>
                <table id="" class="table data-table3 table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('app.seasonName')}}</th>
                            <th>{{__('app.product')}}</th>
                             <th>{{__('app.type')}}</th>
                             <th>{{__('app.sacks_number')}}</th>
                             <th>{{__('app.number_kilo')}}</th>
                        </tr>
                    </thead>
        
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<br>
@endsection

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

$(document).ready(function() {
    var table = $('.data-table1').DataTable({
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

          var table2 = $('.data-table2').DataTable({
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

          var table3 = $('.data-table3').DataTable({
              processing: true,
              serverSide: true,
              searching: false,
               paging: true, 
               info: true,
              ajax: {
                url : "{{ route('client.stock', $client->id) }}",
                data : function(d) {
                }
            },
              columns: [
                  {data: 'DT_RowIndex', name: 'index'},
                  {data: 'season.seasonName', name: 'season.seasonName'},
                  {data: 'product_relation.productName', name: 'product_relation.productName'},
                  {data: 'type_relation.type', name: 'type_relation.type'},
                  {data: 'sacks_number', name: 'sacks_number'},
                  {data: 'number_kilo', name: 'number_kilo'},
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