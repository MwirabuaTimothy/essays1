@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Account Login
@stop

@section('css')

	<link rel="stylesheet" href="{{ asset('assets/styles/css/login.css')}} ">

@stop

@section('content')


<div class="clearfix" id="a-signin">
  <div class="social-signin">
    <div id="facebook_connect"><a href="#"></a></div>
    <div id="twitter_signin"><a href="#"></a></div>
  </div>
  <form method="post" action="" class="form-horizontal">
	<!-- CSRF Token -->
	<fieldset>
		<legend>
			<h3 class="gradient-light">Sign in</h3>
		</legend>
		<p>Welcome back to BookCheetah. Log in to your account so that you can access your bookshelf and wishlist.</p>
	<input type="hidden" name="csrf_token" id="csrf_token" value="{{ Session::getToken() }}" />

	<!-- Email -->
	<div class="control-group {{ $errors->has('email') ? 'error' : '' }}">
		<label class="control-label" for="email">Email</label>
		<div class="controls">
			<input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
			{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
		</div>
	</div>
	<!-- ./ email -->

	<!-- Password -->
	<div class="control-group {{ $errors->has('password') ? 'error' : '' }}">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
			<input type="password" name="password" id="password" value="" />
			{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
		</div>
	</div>
	<!-- ./ password -->

	<p><a href="/forgot_password" class="a-forgot-password"><!-- Forgot your password? --></a></p>
	<!-- Login button -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary">Login</button>
		</div>
	</div>
	<!-- ./ login button -->
	</fieldset>
</form>
</div>

			

<div id="facebook">
	<span class="button-signin-facebook"><div class="facebook_connect_wrap small"><a href="?provider=Facebook"><!-- Sign up with Facebook --></a></div></span>
</div>
@stop

