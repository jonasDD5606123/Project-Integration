@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="custom-container" style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
        <div class="section" style="max-width: 600px; width: 100%;">
            <h2 class="page-title">Wijzig Wachtwoord</h2>

            {{-- Success message --}}
            @if(session('success'))
                <div class="alert-box">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Password update form --}}
            <form action="{{ route('profile.password') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password"><strong>Huidig Wachtwoord</strong></label><br>
                    <input type="password" name="current_password" id="current_password" required class="textarea">
                </div>

                <div>
                    <label for="password"><strong>Nieuw Wachtwoord</strong></label><br>
                    <input type="password" name="password" id="password" required class="textarea">
                </div>

                <div>
                    <label for="password_confirmation"><strong>Bevestig Nieuw Wachtwoord</strong></label><br>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="textarea">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-opslaan">Wijzig wachtwoord</button>
                </div>
            </form>
        </div>
    @endif
@endsection
