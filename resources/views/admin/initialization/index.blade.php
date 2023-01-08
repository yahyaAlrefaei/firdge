@extends('admin.default')

@section('page-header')
<small>{{ trans('app.initialization_system') }}</small>
@stop

@section('content')

        <!-- Modal  add  product name-->
        <div class="modal fade"  id="product_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.product type') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form id="productForm" method="POST" action="{{route(ADMIN . '.productsType.store')}}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group{{ $errors->has('productName') ? ' has-error' : '' }}">
                                        <label> {{__('app.productName')}}</label>
                                        <input name="productName" class="form-control" type="text">
    @if ($errors->has('productName'))
                                            <span class="form-text text-danger">
                                            <small>{{ $errors->first('productName') }}</small>
                                        </span>
@endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                                <button type="submit" id="submitProductForm" class="btn btn-primary">{{ __('app.add') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- model  edit product name --}}
        <div class="modal fade"  id="edit_product_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.product type edit') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form id="editproductForm" method="POST" action="{{route(ADMIN . '.updateProductsType')}}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group{{ $errors->has('productName') ? ' has-error' : '' }}">
                                        <label> {{__('app.productName')}}</label>
                                        <input name="productName" class="form-control editproductName" type="text">
                                        <input name="id" hidden class="form-control editproductId" type="text">

    @if ($errors->has('productName'))
                                            <span class="form-text text-danger">
                                            <small>{{ $errors->first('productName') }}</small>
                                        </span>
@endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                                <button type="submit" id="editsubmitProductForm" class="btn btn-success">{{ __('app.edit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal  add products type -->
        <div class="modal fade"  id="types_potatoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.types_potatoes') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route(ADMIN . '.type.store')}}">
    @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label> {{__('app.product')}}</label>
                                    <select name="product" class="form-control">
@foreach($productsType as $k => $v )
                                            <option value="{{$v->id}}">{{$v->productName}}</option>
@endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label> {{__('app.type')}}</label>
                                    <input name="type" class="form-control" type="text" >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                                <button type="submit" id="submitProductForm" class="btn btn-primary">{{ __('app.add') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal  edit products type -->
        <div class="modal fade"  id="edittypes_potatoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.edit types_potatoes') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route(ADMIN .'.typeUpdate')}}">
    @csrf
                            <div class="row">
                                <div class="col-6">
                                    <input name="id" hidden class="form-control theId"  type="text" >
                                    <label> {{__('app.product')}}</label>
                                    <select name="product" class="form-control theProduct">
@foreach($productsType as $k => $v )
                                            <option value="{{$v->id}}">{{$v->productName}}</option>
@endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label> {{__('app.type')}}</label>
                                    <input name="type" class="form-control theType"  type="text" >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                                <button type="submit" id="submitProductForm" class="btn btn-success">{{ __('app.edit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal add sacks  -->
        <div class="modal fade"  id="types_sacks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.types_sacks') }}</h5>
                    </div>
                    <div class="modal-body">
                       <form method="POST" action="{{route(ADMIN .'.sacks.store')}}">
    @csrf
                           <div class="row" >
                               <div class="col-12">
                                   <label>{{__('app.sacks name')}}</label>
                                   <input type="text" class="form-control" name="sacksName">
                               </div>
                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                               <button type="submit" class="btn btn-primary">{{ __('app.add') }}</button>
                           </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal edit sacks  -->
        <div class="modal fade"  id="editTypes_sacks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.edit types_sacks') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route(ADMIN .'.sacksUpdate')}}">
    @csrf
                            <div class="row" >
                                <div class="col-12">
                                    <label>{{__('app.sacks name')}}</label>
                                    <input type="text" class="form-control sacksId" hidden name="id">
                                    <input type="text" class="form-control editSacksName" name="sacksName">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                                <button type="submit" class="btn btn-success">{{ __('app.edit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- model  add floor  name --}}
        <div class="modal fade"  id="floorNameModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.add floorName') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form id="floorForm" method="POST" action="{{route(ADMIN . '.floors.store')}}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label> {{__('app.floorName')}}</label>
                                        <input name="floorName" class="form-control " type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                                <button type="submit" id="floorForm" class="btn btn-primary">{{ __('app.add') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- model  edit floor  name --}}
        <div class="modal fade"  id="editfloorNameModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.update floorName') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form id="floorForm" method="POST" action="{{route(ADMIN . '.floorsUpdate')}}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label> {{__('app.floorName')}}</label>
                                        <input name="id" hidden class="form-control floorNameId" type="text">
                                        <input name="floorName" class="form-control editFloorName" type="text">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                                <button type="submit" id="floorForm" class="btn btn-success">{{ __('app.edit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal  add warehouse  -->
        <div class="modal fade"  id="warehouseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.add_warehouse') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route(ADMIN . '.warehouse.store')}}">
    @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label> {{__('app.floorName')}}</label>
                                    <select name="floor_id" class="form-control">
@foreach($floors as $k => $v )
                                            <option value="{{$v->id}}">{{$v->floorName}}</option>
@endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label> {{__('app.warehouse name')}}</label>
                                    <input name="warehouseName" class="form-control" type="text" >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                                <button type="submit" id="submitProductForm" class="btn btn-primary">{{ __('app.add') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal  edit warehouse  -->
        <div class="modal fade"  id="editwarehouseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.edit_warehouse') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route(ADMIN . '.warehouseUpdate')}}">
    @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label> {{__('app.floorName')}}</label>
                                    <select name="floor_id" class="form-control editWarehouseFloor">
@foreach($floors as $k => $v )
                                            <option value="{{$v->id}}">{{$v->floorName}}</option>
@endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label> {{__('app.warehouse name')}}</label>
                                    <input name="id"  hidden class="form-control warehouseID" type="text" >
                                    <input name="warehouseName" class="form-control warehouseNameEdit"  type="text" >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                                <button type="submit" id="submitProductForm" class="btn btn-success">{{ __('app.edit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- model  add seasn  name --}}
        <div class="modal fade"  id="addSeason" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.add_season') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form id="floorForm" method="POST" action="{{route(ADMIN . '.seasons.store')}}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label> {{__('app.seasonName')}}</label>
                                        <input name="seasonName" class="form-control " type="text">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label> {{__('app.ton_price')}}</label>
                                        <input name="ton_price" class="form-control " type="number">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                                <button type="submit" id="floorForm" class="btn btn-primary">{{ __('app.add') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- model  add seasn  name --}}
        <div class="modal fade"  id="editSeasonModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('app.edit_season') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form id="floorForm" method="POST" action="{{route(ADMIN . '.Editseason')}}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label> {{__('app.seasonName')}}</label>
                                        <input name="id" hidden class="form-control editTheSeasonId" type="text">
                                        <input name="seasonName" class="form-control editTheSeason" type="text">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label> {{__('app.ton_price')}}</label>
                                        <input name="ton_price" class="form-control ton_price" type="number">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.close') }}</button>
                                <button type="submit" id="floorForm" class="btn btn-success">{{ __('app.edit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        {{--        buttuns --}}
        <div class="" style="display: flex; margin-top: 10px" >
            <div class="p-5 mB-20 add_product_type"   data-toggle="modal" data-target="#product_type" >
                <button    class="btn btn-info">
                    {{ trans('app.add_product_type') }}
                </button>
            </div>
            <div class="p-5 mB-20 add_types_potatoes"  data-toggle="modal" data-target="#types_potatoes">
                <button   class="btn btn-info">
                    {{ trans('app.add_types_potatoes') }}
                </button>
            </div>
            <div class="p-5 mB-20 add_types_sacks" data-toggle="modal" data-target="#types_sacks" >
                <button   class="btn btn-info">
                    {{ trans('app.add_types_sacks') }}
                </button>
            </div>
            <div class="p-5 mB-20 add_types_sacks" data-toggle="modal" data-target="#floorNameModel" >
                <button   class="btn btn-info">
                    {{ trans('app.add_floors') }}
                </button>
            </div>
            <div class="p-5 mB-20 add_types_sacks" data-toggle="modal" data-target="#warehouseModal" >
                <button   class="btn btn-info">
                    {{ trans('app.add_warehouse') }}
                </button>
            </div>
            <div class="p-5 mB-20 add_types_sacks" data-toggle="modal" data-target="#addSeason" >
                <button   class="btn btn-info">
                    {{ trans('app.add_season') }}
                </button>
            </div>
        </div>


        <div class="row" style="margin-top: 10px">
            {{--  product --}}
            <div class="col-6">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="" style="font-family: Cairo">{{__('app.products')}}</h4>
                    <div class="table-responsive">
                        <table id="dataTable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{__('app.id')}}</th>
                                    <th>{{__('app.productName')}}</th>
                                    <th>{{__('app.actions')}}</th>

                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>{{__('app.id')}}</th>
                                    <th>{{__('app.productName')}}</th>
                                    <th>{{__('app.productName')}}</th>
                                </tr>
                            </tfoot>
                            <tbody class="productsTable">
@foreach($productsType as $k => $v  )
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$v['productName']}}</td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <button  class="btn btn-primary btn-sm"  onclick="editProduct({{$v}})"><span class="ti-pencil"></span></button>
                                                </li>
                                                <li class="list-inline-item">
                                                    {!! Form::open([
                                                        'class'=>'delete',
                                                        'url'  => route(ADMIN . '.productsType.destroy', $v->id),
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
            </div>

            {{-- type  --}}
            <div class="col-6">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="table-responsive">
                        <h4 class="" style="font-family: Cairo">{{__('app.type')}}</h4>
                        <table id="dataTable2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>{{__('app.id')}}</th>
                                <th>{{__('app.the_type')}}</th>
                                <th>{{__('app.product')}}</th>
                                <th>{{__('app.actions')}}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{__('app.id')}}</th>
                                <th>{{__('app.type')}}</th>
                                <th>{{__('app.product')}}</th>
                                <th>{{__('app.actions')}}</th>
                            </tr>
                            </tfoot>
                            <tbody class="productsTable">
@foreach($types as $k => $v  )
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$v['type']}}</td>
                                    <td>{{$v['productRelation']['productName']}}</td>

                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <button  class="btn btn-primary btn-sm"  onclick="editType({{$v}})"><span class="ti-pencil"></span></button>
                                            </li>
                                            <li class="list-inline-item">
                                                {!! Form::open([
                                                    'class'=>'delete',
                                                    'url'  => route(ADMIN . '.type.destroy', $v->id),
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
            </div>

            {{--floor--}}
            <div class="col-6">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="table-responsive">
                        <h4 class="" style="font-family: Cairo">{{__('app.floors')}}</h4>
                        <table id="dataTable4" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>{{__('app.id')}}</th>
                                <th>{{__('app.floorName')}}</th>
                                <th>{{__('app.actions')}}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{__('app.id')}}</th>
                                <th>{{__('app.floorName')}}</th>
                                <th>{{__('app.actions')}}</th>
                            </tr>
                            </tfoot>
                            <tbody class="productsTable">
@foreach($floors as $k => $v  )
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$v['floorName']}}</td>

                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <button  class="btn btn-primary btn-sm"  onclick="editfloors({{$v}})"><span class="ti-pencil"></span></button>
                                            </li>
                                            <li class="list-inline-item">
                                                {!! Form::open([
                                                    'class'=>'delete',
                                                    'url'  => route(ADMIN . '.floors.destroy', $v->id),
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
            </div>

            {{--warehouse--}}
            <div class="col-6">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="table-responsive">
                        <h4 class="" style="font-family: Cairo">{{__('app.warehouses')}}</h4>
                        <table id="dataTable5" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>{{__('app.id')}}</th>
                                <th>{{__('app.warehouseName')}}</th>
                                <th>{{__('app.floorName')}}</th>
                                <th>{{__('app.actions')}}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{__('app.id')}}</th>
                                <th>{{__('app.warehouseName')}}</th>
                                <th>{{__('app.floorName')}}</th>
                                <th>{{__('app.actions')}}</th>
                            </tr>
                            </tfoot>
                            <tbody class="productsTable">
@foreach($warehouse as $k => $v  )
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$v['warehouseName']}}</td>
                                    <td>{{$v['floorRelation']['floorName']}}</td>

                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <button  class="btn btn-primary btn-sm"  onclick="editWarehouse({{$v}})"><span class="ti-pencil"></span></button>
                                            </li>
                                            <li class="list-inline-item">
                                                {!! Form::open([
                                                    'class'=>'delete',
                                                    'url'  => route(ADMIN . '.warehouse.destroy', $v->id),
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
            </div>

            {{--season--}}
            <div class="col-6">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="table-responsive">
                        <h4 class="" style="font-family: Cairo">{{__('app.seasons')}}</h4>
                        <table id="dataTable6" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>{{__('app.id')}}</th>
                                <th>{{__('app.seasonName')}}</th>
                                <th>{{__('app.ton_price')}}</th>
                                <th>{{__('app.actions')}}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{__('app.id')}}</th>
                                <th>{{__('app.seasonName')}}</th>
                                <th>{{__('app.ton_price')}}</th>
                                <th>{{__('app.actions')}}</th>
                            </tr>
                            </tfoot>
                            <tbody class="productsTable">
@foreach($seasons as $k => $v  )
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$v['seasonName']}}</td>
                                    <td>{{$v['ton_price']}}</td>
                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <button  class="btn btn-primary btn-sm"  onclick="editSeason({{$v}})"><span class="ti-pencil"></span></button>
                                            </li>
                                            <li class="list-inline-item">
                                                {!! Form::open([
                                                    'class'=>'delete',
                                                    'url'  => route(ADMIN . '.seasons.destroy', $v->id),
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
            </div>

            {{--sacks--}}
            <div class="col-6">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="table-responsive">
                        <h4 class="" style="font-family: Cairo">{{__('app.sacks')}}</h4>
                        <table id="dataTable3" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>{{__('app.id')}}</th>
                                <th>{{__('app.sacks name')}}</th>
                                <th>{{__('app.actions')}}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{__('app.id')}}</th>
                                <th>{{__('app.sacks name')}}</th>
                                <th>{{__('app.actions')}}</th>
                            </tr>
                            </tfoot>
                            <tbody class="productsTable">
                            @foreach($sacks as $k => $v  )
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$v['sacksName']}}</td>

                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <button  class="btn btn-primary btn-sm"  onclick="editSacks({{$v}})"><span class="ti-pencil"></span></button>
                                            </li>
                                            <li class="list-inline-item">
                                                {!! Form::open([
                                                    'class'=>'delete',
                                                    'url'  => route(ADMIN . '.sacks.destroy', $v->id),
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
            </div>

        </div>
@stop


    <script type="text/javascript">

        function editProduct(data){
            $('.editproductId').val(data.id)
            $('.editproductName').val(data.productName)
            $("#edit_product_type").modal('show');
        }
        function editType(data){
            $('.theId').val(data.id)
            $('.theProduct').val(data.product_id)
            $('.theType').val(data.type)
            $("#edittypes_potatoes").modal('show');
        }
        function editSacks(data){
            $('.sacksId').val(data.id)
            $('.editSacksName').val(data.sacksName)
            $("#editTypes_sacks").modal('show');
        }
        function editfloors(data){
            $('.floorNameId').val(data.id)
            $('.editFloorName').val(data.floorName)
            $("#editfloorNameModel").modal('show');
        }
        function editWarehouse(data){
            $('.warehouseID').val(data.id)
            $('.editWarehouseFloor').val(data.floor_id)
            $('.warehouseNameEdit').val(data.warehouseName)
            $("#editwarehouseModal").modal('show');
        }

        function editSeason(data){
            $('.editTheSeasonId').val(data.id)
            $('.editTheSeason').val(data.seasonName)
            $('.ton_price').val(data.ton_price)
            $("#editSeasonModel").modal('show');
        }
    </script>
