@extends('layouts.app')

@section('content')
<div class="container">

	<div class="row" style="margin-top:20px">
		<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form method="POST" action="{{ route('login') }}">
				@csrf

				<fieldset>
					<h2>{{ __('Login') }}</h2>
					<hr class="colorgraph">
					<div class="form-group mb-4">
						<input id="email" type="email"
							class="form-control input-lg @error('email') is-invalid @enderror" name="email"
							value="{{ old('email') }}" required autocomplete="email" autofocus
							placeholder="{{ __('E-Mail Address') }}">

						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group">
						<input id="password" type="password"
							class="form-control input-lg @error('password') is-invalid @enderror" name="password"
							required autocomplete="current-password" placeholder="{{ __('Password') }}">

						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<span class="button-checkbox">
						<button type="button" class="btn" data-color="info">{{ __('Remember Me') }}</button>
						<input type="checkbox" name="remember_me" id="remember_me"
							{{ old('remember') ? 'checked' : '' }} class="hidden">
						@if (Route::has('password.request'))
							<a class="btn btn-outline-warning pull-right" href="{{ route('password.request') }}">
								{{ __('Forgot Your Password?') }}
							</a>
						@endif
					</span>
					<hr class="colorgraph">
					<div class="text-center">
						<button type="submit" class="btn btn-success w-75">{{ __('Login') }}</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>

</div>
@endsection