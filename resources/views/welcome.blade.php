@extends('layout')

@section('content')
	<h1>Üdvözöllek {{ session('name') }}!</h1>
	<h3>Utolsó bejelentkezés {{ session('last_login') }}</h3>
	<button onclick="window.location.href= '/logout'">Kijelentkezés</button>
	<h2>Elérhető oldalak:</h2>
	<ul>
	@foreach($sites as $site)
		<li>
			<a href="/{{ $site->link }}"> {{ $site->name }}</a>
			<p style="padding: 0 0 0 1em;margin:0.5em 0;">{{ $site->description }}</p>
		</li>
	@endforeach
	</ul>
@endsection
