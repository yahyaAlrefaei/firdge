@push('css')
	<style>
		
	</style>
@endpush

<div class="row mB-40">
	<div class="col-md-8 col-sm-12 m-auto ">
		<div class="bgc-white p-20 bd">

			{!! Form::myInput('text', 'name', __('app.name') ) !!}

			{{-- {!! Form::myInput('number', 'phone', __('app.phone-ex') ) !!} --}}
			{{-- {!! Form::myInput('number', 'phone2', __('app.phone2-ex')  ) !!} --}}

			
			<div class="form-group">
				<label for="phone"> {{__('app.phone')}}</label>
				<input type="number" name="phone" class="form-control"
				 id="phone" aria-label="phone" aria-describedby="phone_number" value="{{isset($item) ? $item->phone : ''}}">
				{{-- <div class="input-group-append">
					<span class="input-group-text" id="phone_number">2+</span>
				  </div> --}}
				  <span class="text-danger" id="phone_valid"></span>
			  </div>
			 
			<div class="form-group">
				<label for="phone2"> {{__('app.phone2')}}</label>
				<input type="number" name="phone2" class="form-control" id="phone2"
				 aria-label="phone2" aria-describedby="phone_number" value="{{isset($item) ? $item->phone2 : ''}}">
				{{-- <div class="input-group-append">
					<span class="input-group-text" id="phone_number">2+</span>
				  </div> --}}
				  <span class="text-danger mb-2" id="phone2_valid"></span>  
			  </div>
			  
			{!! Form::myInput('text', 'companyName', __('app.companyName')  ) !!}

            {!! Form::myInput('text', 'address', __('app.address')  ) !!}

            {!! Form::myInput('number', 'ID_card_number', __('app.ID_card_number')  ) !!}

			@if (!isset($item))
			<div class="form-group" id="password">
				<label for="password">{{__('app.password')}}</label>
				<input type="password" class="form-control" name="password">
			</div>
			<div class="form-group">
					<input type="checkbox" id="create_as_user" name="create_as_user" checked style="padding: 4px;">
					<label for="create_as_user">{{__("app.create_as_user")}} <small class="text-success">({{__("app.use_phone_as_username")}})</small></label>
			 </div>

			<div class="form-group">
					<input type="checkbox" id="allow_login" checked name="allow_login"  style="padding: 4px;">
					<label for="allow_login">{{__("app.allow_login")}}</label>
			 </div>
			@endif
		</div>
	</div>

</div>

@push('js')
	<script>
		
		$("#create_as_user").on("change" , function() {
			let checked = $("#create_as_user").is(":checked");
			if(checked) {
				$("#password").removeClass("d-none")
				
			}else {
				$("#password").addClass("d-none");
			}
		});

		$("#phone").on("keyup" , function(e) {
			let input = $(this)
			let number = e.target.value
			if(number.length > 11) {
				$("#phone_valid").text("عفوا لا يجب ان يزيد رقم الهاتف عن 11 رقم")
				$(".client-submit").attr('disabled' , true)
				$(".client-form").attr('disabled' , true)
				return
			}else {
				$(".client-submit").removeAttr('disabled')
				$(".client-form").removeAttr('disabled')
				$("#phone_valid").text("")
			}
		})
		$("#phone2").on("keyup" , function(e) {
			let input = $(this)
			let number = e.target.value
			if(number.length > 11) {
				$("#phone2_valid").text("عفوا لا يجب ان يزيد رقم الهاتف عن 11 رقم")
				$(".client-submit").attr('disabled' , true)
				$(".client-form").attr('disabled' , true)
				return
			}else {
				$(".client-submit").removeAttr('disabled')
				$(".client-form").removeAttr('disabled')
				$("#phone2_valid").text("")
			}
		})
	</script>
@endpush