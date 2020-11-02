<div>
    <div class="section-title">{{ __('Pengaturan Email') }}
    </div>
    <form wire:submit.prevent="updateEmail" class="needs-validation" novalidate="">
        <div class="form-group">
            <label class="control-label" for="name">{{ __('Email
                                                                                        Baru') }}</label>
            <input type="email" name="email" placeholder="Masukkan email baru Anda"
                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" required=""
                wire:model.defer="email">
            <x-input-error for="email" />
            <small class="form-text text-muted">
                Ketika Anda
                mengirim permintaan untuk mengubah Email Anda,
                {{ config('app.name') }} akan
                mengirim email verifikasi untuk memvalidasi bahwa
                Email yang Anda masukkan di atas adalah benar milik Anda. </small>
            <small class="form-text text-muted"> Email
                Anda baru akan berubah ketika Anda sudah menekan link verifikasi
                yang terdapat di email verifikasi tersebut.
            </small>
        </div>
        <x-button type="submit" class=" btn btn-primary" wire:loading.class="btn disabled btn-primary btn-progress">
            {{ __('Ubah Email') }}
        </x-button>
    </form>
</div>
