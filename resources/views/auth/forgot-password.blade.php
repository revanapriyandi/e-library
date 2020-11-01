<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <x-slot name="title">Lupa Password</x-slot>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <p class="text-muted">Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <x-label for="email">{{ __('Email') }}</x-label>
                <x-input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" id="email"
                    name="email" value="{{ old('email') }}" required autofocus />
                <x-input-error for="email" />
            </div>

            <div class="form-group">
                <x-button type="submit" class="btn btn-primary btn-block">
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
