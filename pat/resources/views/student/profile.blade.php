@include('partials.header')

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

    <button type="submit">Wijzig wachtwoord</button>
</form>
