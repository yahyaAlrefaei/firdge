@extends('admin.default')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endpush

@section('page-header')
	 <small>{{ trans('app.add-invoice') }}</small>
@endsection

@section('content')

@if (isset($invoice)) 

{!! Form::model($invoice, [
	'route'  => [ ADMIN . '.invoices.update', $invoice->id ],
	'method' => 'put',
	'files'  => true
])
!!}	
@else
{!! Form::open([
	'route' => [ ADMIN . '.invoices.store' ],
	'files' => false
])
!!}
@endif
		@include('admin.invoices.form')

		<button  style="margin-right: 200px;" type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>

	{!! Form::close() !!}

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

<script>
    $(".client_id , .season_id").on("change" , function() {
       let season_id = $(".season_id").val()
       let client_id = $(".client_id").val()
       if(season_id && client_id) {
           $.ajax({
               method: "POST",
               url: "{{url('admin/invoices/getFiniacialStatusOfClient')}}",
               dataType: "json",
               data: {
                   "_token": " {{ csrf_token() }}",
                   'season_id': season_id,
                   'client_id': client_id,
               },
           })
           .done(function(response) {
               console.log(response)
               if(response.success) {
                   $("#total_amount").val(response.total_required)
                   $("#paid_amount").val(response.paid_amount)
                   $("#remained_amount").val(response.remained_amount)
                   $("#ton_price").val(response.ton_price)
                   $("#total_tons").val(response.total_tons)

                   //make ajax datatable
             var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              searching: false,
               paging: true, 
               info: true,
              ajax: {
                url : "{{ route('admin.invoices.create') }}",
                data : function(d) {
                d.client_id = $(".client_id").val();
                d.season_id = $(".season_id").val();
                }
            },
              columns: [
                  {data: 'DT_RowIndex', name: 'index'},
                  {data: 'season.seasonName', name: 'season.seasonName'},
                  {data: 'amount', name: 'amount'},
                  {data: 'date', name: 'date'},
                  {data: 'picked_by.name', name: 'picked_by.name'},
                  
              ]
          });
                   //end datatable
               }
           })
       }
   })

   $(document).ready(function() {
   
    let season_id = $(".season_id").val()
    let client_id = $(".client_id").val()
    if(season_id && client_id) {
        $.ajax({
               method: "POST",
               url: "{{url('admin/invoices/getFiniacialStatusOfClient')}}",
               dataType: "json",
               data: {
                   "_token": " {{ csrf_token() }}",
                   'season_id': season_id,
                   'client_id': client_id,
               },
           })
           .done(function(response) {
               console.log(response)
               if(response.success) {
                   $("#total_amount").val(response.total_required)
                   $("#paid_amount").val(response.paid_amount)
                   $("#remained_amount").val(response.remained_amount)
                   $("#ton_price").val(response.ton_price)
                   $("#total_tons").val(response.total_tons)


                   //make ajax datatable
             var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              searching: false,
               paging: true, 
               info: true,
              ajax: {
                url : "{{ route('admin.invoices.create') }}",
                data : function(d) {
                d.client_id = $(".client_id").val();
                d.season_id = $(".season_id").val();
                }
            },
              columns: [
                  {data: 'DT_RowIndex', name: 'index'},
                  {data: 'season.seasonName', name: 'season.seasonName'},
                  {data: 'amount', name: 'amount'},
                  {data: 'date', name: 'date'},
                  {data: 'picked_by.name', name: 'picked_by.name'},
                  
              ]
          });
                   //end datatable
               }
           })
    }


    $("#fixed_discount").on("change" , function(e) {

        let fixed_discount = parseFloat($("#fixed_discount").val());
        let percent_discount = parseFloat($("#percent_discount").val());
           //collect values
           let total_amount = parseFloat($("#total_amount").val())
           let paid_amount = parseFloat($("#paid_amount").val()) 
           let remained_amount =parseFloat($("#remained_amount").val())
           let discount = 0
        if(fixed_discount > 0){
           if(fixed_discount != '' && fixed_discount > 0){
              discount = percent_discount > 0 ? (total_amount * (percent_discount / 100)) + fixed_discount : fixed_discount;
              remained_amount = total_amount - (discount + paid_amount);
           $("#remained_amount").val(remained_amount)
           }
        }else {
            if(percent_discount > 0){
                discount =  total_amount * (percent_discount / 100)
            }
            remained_amount = total_amount - (paid_amount + discount);
           $("#remained_amount").val(remained_amount)
        }
    });
    $("#percent_discount").on("change" , function(e) {

        let percent_discount = parseFloat($("#percent_discount").val());
        let fixed_discount = parseFloat($("#fixed_discount").val());
         //collect values
        let total_amount = parseFloat($("#total_amount").val())
        let paid_amount = parseFloat($("#paid_amount").val()) 
        let remained_amount =parseFloat($("#remained_amount").val())

        //new value paid
        if(percent_discount > 0){
           let discount = 0
           if(percent_discount != '' && percent_discount > 0){
              discount = fixed_discount > 0 ?  (total_amount * (percent_discount / 100)) + fixed_discount : total_amount * (percent_discount / 100);
           }
         remained_amount = total_amount - (discount + paid_amount);
        //    console.log(remained_amount)
           $("#remained_amount").val(remained_amount)
        }else {
            remained_amount = total_amount - (paid_amount);
           $("#remained_amount").val(remained_amount)
        }
    });

        })
</script>
@endpush