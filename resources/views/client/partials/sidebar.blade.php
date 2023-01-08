<div class="sidebar">
	<div class="sidebar-inner">
		<!-- ### $Sidebar Header ### -->
		<div class="sidebar-logo">
			<div class="peers ai-c fxw-nw">
				<div class="peer peer-greed">
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
				<div class="peer">
					<div class="mobile-toggle sidebar-toggle">
						<a href="" class="td-n">
							<i class="ti-arrow-circle-left"></i>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- ### $Sidebar Menu ### -->
		<ul class="sidebar-menu scrollable pos-r">
			@include('client.partials.menu')
		</ul>
	</div>
</div>
