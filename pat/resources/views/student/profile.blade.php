@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Welcome to the dashboard</h2>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.password') }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="current_password">Huidig Wachtwoord</label><br>
            <input type="password" name="current_password" id="current_password" required>
        </div>

        <div>
            <label for="password">Nieuw Wachtwoord</label><br>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <label for="password_confirmation">Bevestig Nieuw Wachtwoord</label><br>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-custom w-100" style="background: linear-gradient(90deg, #4f8cff 0%, #6edb8f 100%); color: #fff; font-weight: bold; border: none; border-radius: 8px; padding: 0.75rem 1.5rem; box-shadow: 0 2px 8px rgba(79,140,255,0.15); transition: background 0.3s;">
            <span style="margin-right: 0.5em;">🔒</span>Wijzig wachtwoord
        </button>
    </form>
@endsection