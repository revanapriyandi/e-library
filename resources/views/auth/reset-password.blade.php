<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <x-slot name="title">Reset Password</x-slot>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ Request::route('token') }}">
            <div class="form-group">
                <x-label for="email">{{ __('Email') }}</x-label>
                <x-input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" id="email"
                    name="email" value="{{ Request::route('email') ?? old('email') }}" required autofocus />
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
                <x-button type="submit" class="btn btn-primary btn-block">
                    {{ __('Atur Ulang Kata Sandi') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
