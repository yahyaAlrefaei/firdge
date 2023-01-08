@extends('admin.default')

@section('page-header')
    <small>{{ trans('app.invoices') }}</small>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endpush
@section('content')
<div class="mB-20">
    <a href="{{ route(ADMIN . '.invoices.create') }}" class="btn btn-info">
        {{ trans('app.add-invoice') }}
    </a>
</div>
<div class="  bg-white  ">
    <div class="row">
        <div class="col-12">
            <div class="pt-30 pl-20">
                    <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <table id="" style="width: 100%;" class="table table-bordered data-table responsive table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('app.seasonName')}}</th>
                                    <th>{{__('app.client')}}</th>
                                    <th>{{__('app.total_amount')}}</th>
                                    <th>{{__('app.paid_amount')}}</th>
                                    <th>{{__('app.remained_amount')}}</th>
                                    <th>{{__('app.percent_discount')}}</th>
                                    <th>{{__('app.fixed_discount')}}</th>
                                    <th>{{__('app.ton_price')}}</th>
                                    <th>{{__('app.date')}}</th>
                                    <th>{{__('app.picked_by')}}</th>
                                    <th>{{__('app.actions')}}</th>
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

$(document).ready(function() {
    var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              searching: false,
               paging: true, 
               info: true,
              ajax: {
                url : "{{ route('admin.invoices.index') }}",
                data : function(d) {
                }
            },
              columns: [
                  {data: 'DT_RowIndex', name: 'index'},
                  {data: 'season.seasonName', name: 'season.seasonName'},
                  {data: 'client.name', name: 'client.name'},
                  {data: 'total_amount', name: 'total_amount'},
                  {data: 'paid_amount', name: 'paid_amount'},
                  {data: 'remained_amount', name: 'remained_amount'},
                  {data: 'percent_discount', name: 'percent_discount'},
                  {data: 'fixed_discount', name: 'fixed_discount'},
                  {data: 'ton_price', name: 'ton_price'},
                  {data: 'date', name: 'date'},
                  {data: 'picked_by.name', name: 'picked_by.name'},
                  {data: 'actions', name: 'actions', sortable:false , searchable:false},
                  
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