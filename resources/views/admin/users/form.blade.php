<div class="row mB-40">
	<div class="col-md-8 col-sm-8 m-auto">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', __('app.Username') ) !!}

			{!! Form::myInput('text', 'email', __('app.Email') ) !!}

			{!! Form::myInput('password', 'password', __('app.Password')  ) !!}

			{!! Form::myInput('password', 'password_confirmation', __('app.Password again')  ) !!}

			<div class="form-group">
				<label for="role">{{__('app.Role')}}</label>
				<select name="role" class="form-control select2" id="">
					@foreach (config('variables.role') as $index=>$role)
					<option value="{{$index}}" {{isset($item) && $item->role == $index ? 'selected' : ""}}>{{$role}}</option>
					@endforeach
					
				</select>
			</div>
			{{-- {!! Form::mySelect('role', __('app.Role'), config('variables.role'), null, ['class' => 'form-control select2']) !!} --}}

			{!! Form::myFile('avatar', __('app.Avatar') ) !!}

			{!! Form::myTextArea('bio', __('app.Bio')) !!}
		</div>
	</div>
	@if (isset($item) && $item->avatar)
		<div class="col-sm-4">
			<div class="bgc-white p-20 bd">
				<img src="{{ asset($item->avatar)  }}" alt="">
			</div>
		</div>
	@endif
</div>
