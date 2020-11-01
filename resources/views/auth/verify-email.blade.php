<x-guest-layout>
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div
                    class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="login-brand">
                        <x-authentication-card-logo />
                    </div>
                    @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success" role="alert">
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                    </div>
                    @endif
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Verifikasi Email Anda</h4>
                        </div>

                        <div class="card-body">
                            {{ __('Terima kasih telah mendaftar! Sebelum memulai, dapatkah Anda memverifikasi alamat email Anda dengan mengklik link yang
                            baru saja kami kirimkan kepada Anda? Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan email lainnya kepada Anda.') }}

                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                </div>
                                <div class="mt-5 d-block">
                                    <x-button type="submit" class=" btn btn-primary">
                                        {{ __('Resend Verification Email') }}
                                    </x-button>
                            </form>
                            <div class="float-right">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-small">
                                        {{ __('Logout?') }}
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</x-guest-layout>
