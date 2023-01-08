@extends('layouts.app')

@section('content')

    <h4 class="fw-300 c-grey-900 mB-40">{{__('app.Login')}}</h4>
    @if ($errors->has('error'))
        <span class="form-text text-danger">
            <small>{{ trans('app.'.$errors->first('error')) }}</small>
        </span>
    @endif
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('error') ? ' has-error' : '' }}">
            <label for="name" class="text-normal text-dark">{{__('app.name')}}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="form-group{{ $errors->has('error') ? ' has-error' : '' }}">
            <label for="password" class="text-normal text-dark">{{ __('app.Password')}}</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <div class="peers ai-c jc-sb fxw-nw">
                <div class="peer">
{{--                    <div class="checkbox checkbox-circle checkbox-info peers ai-c">--}}
{{--                        <input type="checkbox" id="remember" name="remember" class="peer" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                        <label for="remember" class=" peers peer-greed js-sb ai-c">--}}
{{--                            <span class="peer peer-greed">{{__("app.Remember Me")}}</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
                </div>
                <div class="peer">
                    <button class="btn btn-primary">{{__('app.Login')}}</button>
                </div>
            </div>
        </div>
        <div class="peers ai-c jc-sb fxw-nw">
{{--            <div class="peer">--}}
{{--                <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                    Forgot Your Password?--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="peer">--}}
{{--                <a href="/register" class="btn btn-link">Create new account</a>--}}
{{--            </div>--}}
        </div>
    </form>

@endsection
