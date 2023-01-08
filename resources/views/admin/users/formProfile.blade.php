<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', __('app.Username') ) !!}

            {!! Form::myInput('email', 'email', __('app.Email') ) !!}

            {!! Form::myInput('password', 'password', __('app.Password')  ) !!}

            {!! Form::myInput('password', 'password_confirmation', __('app.Password again')  ) !!}

            {!! Form::myFile('avatar', __('app.Avatar') ) !!}

            {!! Form::myTextArea('bio', __('app.Bio')) !!}
        </div>
    </div>
    @if (isset($item) && $item->avatar)
        <div class="col-sm-4">
            <div class="bgc-white p-20 bd">
                <img src="{{ $item->avatar }}" alt="">
            </div>
        </div>
    @endif
</div>
