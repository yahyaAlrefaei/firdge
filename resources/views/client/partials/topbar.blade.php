<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li>
                <div class="peer peer-greed custom-logo">
					<a class='sidebar-link td-n' href="#">
						<div class="peers ai-c fxw-nw">
							<div class="peer">
								<div class="logo">
									{{-- <img
                                        style="border-radius: 25%;padding: 10px;"
                                        src="{{
                                    '/storage/logo/'. \App\Models\setting::where(['key' => 'logo'])->pluck('value')->first()
                                     }}" alt="">url('/uploads/background_images/$background')"  --}}
									
									 @php
										 $logo = \App\Models\setting::where(['key' => 'logo'])->pluck('value')->first();
									 @endphp

									 <img
                                        style="border-radius: 25%;padding: 10px;"
                                        src="{{ isset($logo) ?  url('/uploads/logo/' .$logo) : ''}}" alt=""> 
								</div>
							</div>

						</div>
					</a>
				</div>
            </li>
            <li class="search-box">
                <a class=" no-pdd-right" href="#">
                    {{ \App\Models\setting::where(['key' => 'company_name'])->pluck('value')->first()}}
                </a>
            </li>
        </ul>



        <ul class="nav-right">
            <li class="dropdown">
                <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                    <div class="peer mR-10">
                        <span class="fsz-sm c-grey-900">{{ $client->name }}</span>
                    </div>
                    <div class="peer mR-10">
                        <img class="w-2r bdrs-50p" src="{{ auth()->user()->avatar }}" alt="">
                    </div>
                </a>
                <ul class="dropdown-menu fsz-sm">
                    
                    <li>
                        <a href="/logout" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                            <i class="ti-power-off mR-10"></i>
                            <span>{{__("app.Logout")}}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
