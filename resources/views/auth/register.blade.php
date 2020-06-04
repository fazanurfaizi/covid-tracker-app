@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <fieldset>
                    <h2>{{ __('Register') }}</h2>
                    <hr class="colorgraph">
                    <div class="form-group my-4">
                        <input id="name" type="text" class="form-control input-lg @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="{{ __('Name') }}">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <input id="email" type="email"
                            class="form-control input-lg @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email"
                            placeholder="{{ __('E-Mail Address') }}">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <input id="password" type="password"
                            class="form-control input-lg @error('password') is-invalid @enderror" name="password"
                            required autocomplete="current-password" placeholder="{{ __('Password') }}">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <input id="password-confirm" type="password" class="form-control input-lg"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="{{ __('Confirm Password') }}">
                    </div>
                    <hr class="colorgraph">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-75">{{ __('Register') }}</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</div>
@endsection