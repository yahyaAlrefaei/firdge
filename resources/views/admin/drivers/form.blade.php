<div class="row mB-40">
	<div class="col-md-8 col-sm-12 m-auto ">
		<div class="bgc-white p-20 bd">

			{!! Form::myInput('text', 'name', __('app.name') ) !!}

            {!! Form::myInput('text', 'card_id', __('app.card_id') ) !!}

            {!! Form::myInput('number', 'phone', __('app.phone') ) !!}


			<div class="form-group">
				<label for="car_number">{{__('app.car_number')}}</label>
				<input type="text" name="car_number" class="form-control" value="{{isset($item) ? $item->car_number : old('car_number')}}">
			</div>

		</div>
	</div>

</div>
