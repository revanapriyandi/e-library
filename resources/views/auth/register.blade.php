<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <x-slot name="title">Daftar</x-slot>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group">
                <x-label for="nama">{{ __('Nama Lengkap') }}</x-label>
                <x-input id="nama" class="{{ $errors->has('nama') ? ' is-invalid' : '' }}" type="text" name="nama"
                    value="{{ old('nama') }}" tabindex="1" required autofocus />
                <x-input-error for="nama" />
            </div>
            <div class="form-group">
                <x-label for="email">{{ __('Email') }}</x-label>
                <x-input id="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email"
                    value="{{ old('email') }}" tabindex="2" required />
                <x-input-error for="email" />
            </div>

            <div class="form-group">
                <x-label for="password" class="control-label">{{ __('Password') }}</x-label>
                <x-input type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                    tabindex="2" required autocomplete="new-password" />
                <x-input-error for="password" />
            </div>
            <div class="form-group">
                <x-label for="password" class="control-label">{{ __('Konfirmasi Password') }}</x-label>
                <x-input type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}"
                    name="password_confirmation" tabindex="2" required autocomplete="new-password" />
                <x-input-error for="password" />
            </div>

            <div class="form-group">
                <x-button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        <div class="mt-3 text-center text-muted">
            Sudah Memiliki Akun ? <a href="{{ route('login') }}">Masuk</a>
        </div>
    </x-authentication-card>
</x-guest-layout>
