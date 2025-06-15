@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Welcome to the dashboard</h2>
    <h1>Set Your Password, {{ $user->voornaam }}</h1>

<form method="POST" action="{{ $postUrl }}">
    @csrf

    <div>
        <label for="password">New Password</label>
        <input id="password" type="password" name="password" required autofocus>
        @error('password')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <button type="submit">Set Password</button>
</form>
@endsection
