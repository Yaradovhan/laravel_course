@extends('semantic.layouts.app')

@section('content')

    <div class="ui equal width centered grid">
        <div class="stretched row">
            <div class="eight wide column">
                <form class="ui fluid form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h4 class="ui dividing header">{{ __('Login') }}</h4>

                    <div class="field">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                               autofocus>
                    </div>

                    <div class="field">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" value="{{ old('password') }}" required
                               autocomplete="password" autofocus>
                    </div>

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
            </div>
        </div>
    </div>


@endsection
