@extends('admin.default')

@section('content')

    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item  w-100">
            <div class="row gap-20">
                <!-- #Toatl Visits ==================== -->
                <div class='col-md-3'>
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">{{__("app.Total clients")}}</h6>
                        </div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed">
                                    <i class="fa-solid fa-users" style="font-size: 27px"></i>
                                </div>
                                <div class="peer">
                                    {{ \App\Models\Client::all()->count()}}
                                    {{--                                    <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">+10%</span>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- #Total Page Views ==================== -->
                <div class='col-md-3'>
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">{{__('app.total fridge')}}</h6>
                        </div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed">
                                    <i class="fa-solid fa-truck-ramp-box" style="font-size: 27px"></i>
                                </div>
                                <div class="peer">
                                    {{ array_sum(\App\Models\stock::all()->pluck('number_kilo')->toArray()) ." ". __('app.number_kilo')}}
{{--                                    <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">-7%</span>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- #Unique Visitors ==================== -->
                <div class='col-md-3'>
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">{{__("app.process_today")}}</h6>
                        </div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed">
                                    <i class="fa-solid fa-truck-moving" style="font-size: 27px"></i>
                                </div>
                                <div class="peer">
                                     @php $today = \Carbon\Carbon::now()->toDateString() @endphp
                                    {{ \App\Models\processe::where('date',$today)->get()->count()}}

                                    {{--                                    <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">~12%</span>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- #Bounce Rate ==================== -->
                <div class='col-md-3'>
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1"> {{__('app.users')}}</h6>
                        </div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed">
                                    <i class="fa-solid fa-user-gear" style="font-size: 27px"></i>
                                </div>
                                <div class="peer">
                                    {{ \App\Models\User::get()->count()}}

                                    {{--                                    <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">33%</span>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="masonry-item col-12">
            <!-- #Site Visits ==================== -->
            <div class="bd bgc-white">
                <div class="peers fxw-nw@lg+ ai-s">

                    <div style="width:80%;margin: auto">
                        {!! $chartjs->render() !!}
                    </div>
                </div>


@endsection



