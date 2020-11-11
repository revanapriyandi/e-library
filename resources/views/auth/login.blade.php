<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <x-slot name="title">Login</x-slot>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group">
                <x-label for="email">{{ __('Email') }}</x-label>
                <x-input id="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email"
                    value="{{ old('email') }}" tabindex="1" required autofocus />
                <x-input-error for="email" />
            </div>

            <div class="form-group">
                <div class="d-block">
                    <x-label for="password" class="control-label">{{ __('Password') }}</x-label>
                    <div class="float-right">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-small">
                            {{ __('Lupa password?') }}
                        </a>
                        @endif
                    </div>
                </div>
                <x-input type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                    tabindex="2" required autocomplete="current-password" />
                <x-input-error for="password" />
            </div>
            <div class="form-group">
                <x-button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    {{ __('Masuk') }}
                </x-button>
            </div>
        </form>
        {{-- <div class="mt-3 text-center text-muted">
            Tidak Memiliki Akun ? <a href="{{ route('register') }}">Mendaftar</a>
        </div> --}}
    </x-authentication-card>
</x-guest-layout>
