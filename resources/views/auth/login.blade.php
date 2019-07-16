{{--@extends('layouts.app')--}}
@extends('semantic.layouts.app')

{{--@section('breadcrumbs')--}}
{{--{!! Breadcrumbs::render('login') !!}--}}
{{--@endsection--}}

@section('content')

    <form class="ui form" method="POST" action="{{ route('login') }}">
        @csrf
        <h4 class="ui dividing header">{{ __('Login') }}</h4>
        <div class="field @error('email') error @enderror">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        @error('email')
        <span class="ui error" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror

        <div class="field @error('password') error @enderror">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" value="{{ old('password') }}" required
                   autocomplete="current-password" autofocus>
        </div>
        @error('password')
        <span class="ui error" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror

        <div class="inline field">
            <div class="ui checkbox">
                <input type="checkbox" name="remember"
                       id="remember" {{ old('remember') ? 'checked' : '' }} class="hidden">
                <label for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>

        <button class="ui button" type="submit">{{ __('Login') }}</button>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </form>
@endsection
