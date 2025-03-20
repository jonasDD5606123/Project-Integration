<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- R Nummer -->
        <div>
            <x-input-label for="r_nummer" :value="__('R Nummer')" />
            <x-text-input id="r_nummer" class="block mt-1 w-full" type="text" name="r_nummer" :value="old('r_nummer')" required autofocus autocomplete="r_nummer" />
            <x-input-error :messages="$errors->get('r_nummer')" class="mt-2" />
        </div>

        <!-- Voornaam -->
        <div class="mt-4">
            <x-input-label for="voornaam" :value="__('Voornaam')" />
            <x-text-input id="voornaam" class="block mt-1 w-full" type="text" name="voornaam" :value="old('voornaam')" required autocomplete="voornaam" />
            <x-input-error :messages="$errors->get('voornaam')" class="mt-2" />
        </div>

        <!-- Achternaam -->
        <div class="mt-4">
            <x-input-label for="achternaam" :value="__('Achternaam')" />
            <x-text-input id="achternaam" class="block mt-1 w-full" type="text" name="achternaam" :value="old('achternaam')" required autocomplete="achternaam" />
            <x-input-error :messages="$errors->get('achternaam')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role ID (optional) -->
        <div class="mt-4">
            <x-input-label for="rol_id" :value="__('Role ID')" />
            <x-text-input id="rol_id" class="block mt-1 w-full" type="number" name="rol_id" :value="old('rol_id')" required />
            <x-input-error :messages="$errors->get('rol_id')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
