@extends('admin.default')

@section('page-header')
	 <small>{{ trans('app.manage setting') }}</small>
@stop

@section('content')



        <div class="container" style="background-color: #fff; padding: 20px">
                <form action="{{ route( ADMIN . '.setting.store' ) }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="row" >
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bgc-white p-20 bd">
                                        {{-- <img src="{{'/storage/logo/'.$items['logo']}}" alt="logo"> --}}
                                        <img src="{{asset('uploads/logo/'.$items['logo'])}}" alt="logo">
                                        <input type="text" name="oldLogo" hidden  value="{{$items['logo']}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="exampleInputEmail1" class="form-label" >{{__('app.company_name')}}</label>
                                    <input type="text"   name="company_name" class="form-control"  value="{{$items['company_name']}}">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{__("app.owner_name")}}</label>
                                    <input type="text"   name="owner_name" class="form-control"  value="{{$items['owner_name']}}">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{__("app.Email")}}</label>
                                    <input type="text"   name="email" class="form-control"  value="{{$items['email']}}">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{__("app.phone")}}</label>
                                    <input type="text"    name="phone" class="form-control"  value="{{$items['phone']}}">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{__("app.phone2")}}</label>
                                    <input type="text"    name="other_phone" class="form-control"  value="{{$items['other_phone']}}">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{__("app.location")}} </label>
                                    <input type="text" name="location" class="form-control"  value="{{$items['location']}}">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{__("app.desc")}}</label>
                                    <textarea   name="desc" class="form-control" >
                                        {{$items['desc']}}
                                    </textarea>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{__("app.logo")}} </label>
                                    <input type="file"  name="logo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="background_image" class="form-label">{{__("app.background-image")}} </label>
                                    <input type="file"  name="background_image" class="form-control" id="background_image" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
                        </div>
                    </div>

                </form>
        </div>
@stop
