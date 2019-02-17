@extends('layout')

@section('title','Login')
@section('content')
	<h1>Kérlek jelentkezz be!</h1>
	<form method="POST" action="/login">
		@csrf

		<table>
			<tr>
				<td>Felhasználónév</td>
				<td>
					<input type="text" name="username">
				</td>
			</tr><tr>
				<td>Jelszó</td>
				<td>
					<input type="password" name="password">
				</td>
			</tr>
			<tr>
				<td>Bejelentkezés</td>
				<td><input type="submit" name="login" value="Login"></td>
			</tr>
		</table>
		@if(session('failedLogins')>2)
			<div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
		@endif
	</form>
	@if(session('message'))
		<p>{{ session('message') }}</p>
	@endif
@endsection


