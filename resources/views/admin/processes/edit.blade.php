@extends('admin.default')

@section('page-header')
    <small>{{ trans('app.edit_process') }}</small>
@stop

@section('content')


    <div class="container" style="padding: 20px;background-color: #fff">
        <form method="POST" action="{{route(ADMIN . '.processesUpdate' , $item->id)}}">
            @csrf
            <div class="row">
                <div  class="col-6">
                    <label>{{__('app.process_type')}}</label>
                    <select type="text"   class="form-control" name="process_type" >
{{--                        <option value="">----</option>--}}
                        <option value="insert" >{{ __('app.exit') }}</option>
                    </select>
                </div>
                <div  class="col-6">
                    <label>{{__('app.client')}}</label>
                    <select type="text"  class="form-control" name="client_id"   value="{{ $item['client_id'] }}">
                        <option value="">----</option>
                        @foreach($clients as $k => $v )
                            <option @php if($item['client_id'] == $v->id ){echo 'selected';} @endphp
                                value="{{$v->id}}" >{{ $v->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div  class="col-6">
                    <label>{{__('app.floor')}}</label>
                    <select type="text"  class="form-control floorSelect" name="floor_id"  value="{{ $item['floor_id']}}">
                        <option value="">----</option>
                        @foreach($floor as $k => $v )
                            <option  @php if($item['floor_id'] == $v->id ){echo 'selected';} @endphp
                                value="{{$v->id}}" >{{ $v->floorName }}</option>
                        @endforeach
                    </select>
                </div>
                <div  class="col-6">
                        <label>{{__('app.warehouse')}}</label>
                        <select type="text"  class="form-control warehouseSelect " name="warehouse_id"  value="{{ $item['warehouse_id']}}">
                                   @foreach($warehouse as $k => $v )
                                       <option  @php if($item['warehouse_id'] == $v->id ){echo 'selected';} @endphp
                                           value="{{$v->id}}" >{{ $v->warehouseName }}</option>
                                   @endforeach
                        </select>
                    </div>
                <div  class="col-6">
                    <label>{{__('app.product')}}</label>
                    <select type="text"  class="form-control productSelect" name="product_id"  value="{{$item['product_id']}}">
                        <option value="">----</option>
                        @foreach($products as $k => $v )
                            <option @php if($item['product_id'] == $v->id ){echo 'selected';} @endphp
                                value="{{$v->id}}" >{{ $v->productName }}</option>
                        @endforeach
                    </select>
                </div>
                <div  class="col-6">
                    <label>{{__('app.type')}}</label>
                    <select type="text"   class="form-control typeSelect" name="product_type_id" value="{{ $item['product_type_id']}}">
                        <option value="">----</option>
                        @foreach($types as $k => $v )
                            <option  @php if($item['product_type_id'] == $v->id ){echo 'selected';} @endphp
                                     value="{{$v->id}}" >{{ $v->type }}</option>
                        @endforeach
                    </select>
                </div>
                <div  class="col-6">
                    <label>{{__('app.number_tons')}}</label>
                    <input type="number"  class="form-control" name="number_tons" value="{{ $item['number_tons'] }}">
                </div>
                <div  class="col-6">
                    <label>{{__('app.sacks_type')}}</label>
                    <select type="text"  class="form-control"  name="sacks_type_id" value="{{ $item['sacks_type_id']}}">
                        <option value="">----</option>
                        @foreach($sacks_type as $k => $v )
                            <option  @php if($item['sacks_type_id'] == $v->id ){echo 'selected';} @endphp
                                value="{{$v->id}}" >{{ $v->sacksName }}</option>
                        @endforeach
                    </select>
                </div>
                <div  class="col-6">
                    <label>{{__('app.sacks_number')}}</label>
                    <input type="number"  class="form-control" name="sacks_number" value="{{ $item['sacks_number'] }}">
                </div>
                <div  class="col-6">
                    <label>{{__('app.sacks_color')}}</label>
                    <input type="text"  class="form-control" name="sacks_color" value="{{ $item['sacks_color'] }}">
                </div>
                <div  class="col-6">
                    <label>{{__('app.seasonName')}}</label>
                    <select type="text"  class="form-control" name="season_id" value="{{ $item['season_id'] }}">
                           @foreach($seasons as $k => $v )
{{--                               <option value="{{$seasons->id}}" >{{ $seasons->seasonName }}</option>--}}
                               <option  @php if($item['season_id'] == $v->id ){echo 'selected';} @endphp
                                   value="{{$v->id}}" >{{ $v->seasonName }}
                               </option>
                           @endforeach
                    </select>
                </div>
                <div  class="col-6">
                    <label>{{__('app.car_number')}}</label>
                    <input type="text" class="form-control" name="car_number" value="{{ $item['car_number'] }}">
                </div>
                <div  class="col-6">
                    <label>{{__('app.driver_name')}}</label>
                    <input type="text" class="form-control" name="driver_name" value="{{ $item['driver_name'] }}">
                </div>
                <div  class="col-6">
                    <label>{{__('app.driver_number')}}</label>
                    <input type="text" class="form-control" name="driver_number" value="{{ $item['driver_number'] }}">
                </div>

                <div  class="col-6">
                    <label>{{__('app.inserTdate')}}</label>
                    <input type="date"   class="form-control" name="date" value="{{ $item['date'] }}">
                </div>
                <div  class="col-12">
                    <label>{{__('app.notes')}}</label>
                    <textarea   class="form-control" name="notes" >{{ $item['notes'] }}</textarea>
                </div>
            </div>
            <div  class="col-12 mt-5" >
                <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">


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


    </script>

@stop


