@extends('admin.default')

@section('page-header')
	 <small>{{ trans('app.add_new_process') }}</small>
@stop

@section('content')

        <div class="container" style="padding: 20px;background-color: #fff">
               <form method="POST" action="{{route(ADMIN . '.processes.store')}}">
                   @csrf
                   <div class="row">
                       <div  class="col-6">
                           <label>{{__('app.process_type')}}</label>
                           <select type="text"  class="form-control" id="process_type" name="process_type" value="{{ old('process_type') }}">
                               <option value="">----</option>
                               <option value="insert" >{{ __('app.insert') }}</option>
                               <option value="exit" >{{ __('app.exit') }}</option>
                           </select>
                       </div>
                       <div  class="col-6">
                           <label>{{__('app.client')}}</label>
                           <select type="text" class="form-control" id="client_id" name="client_id"  value="{{ old('client_id') }}">
                               <option value="">----</option>
                           @foreach($clients as $k => $v )
                                   <option value="{{$v->id}}" >{{ $v->name }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div  class="col-6">
                           <label>{{__('app.floor')}}</label>
                           <select type="text" class="form-control floorSelect" name="floor_id"  value="{{ old('floor') }}">
                               <option value="">----</option>
                               @foreach($floor as $k => $v )
                                   <option value="{{$v->id}}" >{{ $v->floorName }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div  class="col-6">
                           <label>{{__('app.warehouse')}}</label>
                           <select type="text" disabled="true" class="form-control warehouseSelect " name="warehouse_id"  value="{{ old('warehouse') }}">
{{--                               @foreach($warehouse as $k => $v )--}}
{{--                                   <option value="{{$v->id}}" >{{ $v->warehouseName }}</option>--}}
{{--                               @endforeach--}}
                           </select>
                       </div>
                       <div  class="col-6">
                           <label>{{__('app.product')}}</label>
                           <select type="text" class="form-control productSelect" id="product_id" name="product_id"  value="{{ old('product_id') }}">
                               <option value="">----</option>
                               @foreach($products as $k => $v )
                                   <option value="{{$v->id}}" >{{ $v->productName }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div  class="col-6">
                           <label>{{__('app.type')}}</label>
                           <select type="text"  disabled class="form-control typeSelect" id="product_type_id" name="product_type_id" value="{{ old('product_type_id') }}">

                           </select>
                       </div>
                       <div  class="col-6">
                           <label>{{__('app.number_kilo')}}</label>
                           <input type="number" class="form-control " id="number_kilo" name="number_kilo" value="{{ old('number_tons') }}">
                           <small class="text-success" id="stock_number"></small>
                           
                           <small class="invalid-feedback stock_msg"></small>
                       </div>

                       <div  class="col-6">
                           <label>{{__('app.sacks_type')}}</label>
                           <select type="text" class="form-control" name="sacks_type_id" value="{{ old('sacks_type_id') }}">
                               <option value="">----</option>
                           @foreach($sacks_type as $k => $v )
                                 <option value="{{$v->id}}" >{{ $v->sacksName }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div  class="col-6">
                           <label>{{__('app.sacks_number')}}</label>
                           <input type="number" class="form-control" id="sacks_number" name="sacks_number" value="{{ old('sacks_number') }}">
                           <small class="text-success sacks_number" id=""></small>
                           
                           <small class="invalid-feedback sacks_msg"></small>
                       </div>
                       <div  class="col-6">
                           <label>{{__('app.sacks_color')}}</label>
                           <input type="text" class="form-control" name="sacks_color" value="{{ old('sacks_color') }}">
                       </div>
                       <div  class="col-6">
                           <label>{{__('app.seasonName')}}</label>
                           <select type="text" class="form-control" name="season_id" value="{{ old('season_id') }}">
                              @foreach($seasons as $season )
                                <option value="{{$season->id}}" >{{ $season->seasonName }}</option>
                             @endforeach 
                           </select>
                       </div>

                       <div  class="col-6">
                        <label>{{__('app.driver')}}</label>
                        <select type="text" class="form-control drivers" name="driver_id"  value="{{ old('client_id') }}">
                            <option value="">----</option>
                            @foreach($drivers as $k => $v )
                                <option value="{{$v->id}}" >{{ $v->name }}</option>
                            @endforeach
                        </select>
                    </div>

                       <div  class="col-6">
                           <label>{{__('app.car_number')}}</label>
                           <input type="text" class="form-control car_number" name="car_number" value="{{ old('car_number') }}">
                       </div>

                       <div  class="col-6" id="driver_name">
                           <label>{{__('app.driver_name')}}</label>
                           <input type="text" class="form-control driver_name" name="driver_name" value="{{ old('driver_name') }}">
                       </div>

                       <div  class="col-6">
                           <label>{{__('app.driver_number')}}</label>
                           <input type="text" class="form-control driver_number" name="driver_number" value="{{ old('driver_number') }}">
                       </div>

                       <div  class="col-6">
                           <label>{{__('app.date')}}</label>
                           <input type="date" class="form-control" name="date" value="{{ old('date') ?? now()->toDateString() }}">
                       </div>
                       <div  class="col-12">
                           <label>{{__('app.notes')}}</label>
                           <textarea class="form-control" name="notes" >{{ old('notes') }}</textarea>
                       </div>
                   </div>
                   <div  class="col-12 mt-5" >
                       <button type="submit" id="submit-btn" class="btn btn-primary">{{ trans('app.save') }}</button>
                   </div>
               </form>
        </div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">


    $(".drivers").change(function(){
        $('.driver_name').html('')
        $('.driver_number').html('')

        let v = $(this).val();
        if(v){
            $.ajax({
            url : `/admin/showDriver/${v}`,
            type : 'GET',
            dataType:'json',
            success : function(res) {
                if(res.success){
                    $('#driver_name').addClass('d-none')
                    $('.driver_name').val(res.drivers.name)
                    $('.driver_number').val(res.drivers.phone)
                    $('.car_number').val(res.drivers.car_number)
                }
            },
            error : function(request,error)
            {
                console.log(request)
            }
        });
        }else {
            $('#driver_name').removeClass('d-none')
            $('.driver_name').val('')
            $('.driver_number').val('')
            $('.car_number').val('')
        }
       
    });
    $(".floorSelect").change(function(){
        $('.warehouseSelect').html('')
        let v = $(this).val()
        $.ajax({
            url : `/admin/warehouseRelatedFloor/${v}`,
            type : 'GET',
            dataType:'json',
            success : function(res) {
                if(res.success){
                    $('.warehouseSelect').append('<option value="">----</option>')
                    $.each(res.warehouse , function(index, value)  {
                        $('.warehouseSelect').append("<option value='"+value.id+"'>"+value.warehouseName+"</option>")
                    })
                    $('.warehouseSelect').attr('disabled',false)
                }
            },
            error : function(request,error)
            {
                console.log(request)
            }
        });
    });

    $(".productSelect").change(function(){
        $('.typeSelect').html('')
        let v = $(this).val()
        $.ajax({
            url : `/admin/getTypeByProduct/${v}`,
            type : 'GET',
            dataType:'json',
            success : function(res) {
                if(res.success){
                    $('.typeSelect').append('<option value="">----</option>')
                    $.each(res.type , function(index, value)  {
                        $('.typeSelect').append("<option value='"+value.id+"'>"+value.type+"</option>")
                    })
                    $('.typeSelect').attr('disabled',false)
                }
            },
            error : function(request,error)
            {
                console.log(request)
            }
        });
    });


  $("#process_type, #client_id , #product_id , #product_type_id , #number_kilo , #sacks_number").on('change' , function() {
    let process_type = $("#process_type").val()
    let client_id = $("#client_id").val()
    let product_id = $("#product_id").val()
    let product_type_id = $("#product_type_id").val()
    let number_kilo = $("#number_kilo").val()
    let sacks_number = $("#sacks_number").val()
    if(process_type == 'exit' && client_id && product_id && product_type_id && number_kilo > 0 && sacks_number > 0){
       
        $.ajax({
            url : "{{asset('/admin/check-client-stock')}}",
            type : 'GET',
            dataType:'json',
            data : {
                process_type,
                client_id,
                product_id,
                product_type_id,
                number_kilo,
                sacks_number
            },
            success : function(res) {
                console.log(res)
                if(res.success){
                   if(res.exceeded_wight == true) {
                    $("#stock_number").text("رصيد العميل المتاح حاليا هو :" + res.stock)
                    $(".stock_msg").text("")
                    // $("#number_kilo").addClass("is-invalid")
                    // $("#number_kilo").val(res.stock)
                    
                   }
                   if(res.exceeded_sacks == true) {
                    $(".sacks_number").text("رصيد العميل المتاح حاليا هو :" + res.sacks)
                    $(".sacks_msg").text("عفوا رصيد العميل من الشكائر لايسمح لإتمام العملية")
                    $(".sacks_number").addClass("is-invalid")
                    $("#sacks_number").val(res.sacks)
                    
                   }

                   else {
                    $("#stock_number").text("رصيد العميل المتاح حاليا هو :" + res.stock)
                    $(".sacks_number").text("رصيد العميل من الشكائر المتاح حاليا هو :" + res.sacks)
                    
                   }
                }
            },
            error : function(request,error)
            {
                console.log(request)
            } 
        });
    } 
    else if(process_type == 'insert' && client_id && product_id && product_type_id && number_kilo > 0) {
        $("#number_kilo").removeClass("is-invalid")
        $("#stock_number").text('')
        $(".stock_msg").text('')
        $(".sacks_msg").text('')
        $(".sacks_number").text('')
    }
  });
</script>

@stop
