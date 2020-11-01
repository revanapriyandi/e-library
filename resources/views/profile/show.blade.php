<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="pt-3 container-fluid">
                    <div class="container">
                        <div class="my-5 row" id="settings-nav">
                            <div class="pb-5 col-md-3">
                                <div class="nav flex-column nav-pills" aria-orientation="vertical">
                                    <a class="nav-item nav-link" href="{{ route('profile.update-profile') }}">Profile
                                        Information</a>
                                    </a>
                                    <a class="nav-item nav-link" href="{{ route('profile.update-password') }}">Update
                                        Password
                                    </a>
                                    <a class="nav-item nav-link active show"
                                        href="{{ route('profile.update-lainnya') }}">Lainnya
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="lainnya" role="tabpanel">

                                        <h4 class="mb-3">{{ __('Pengaturan Lainnya') }}</h4>
                                        <hr>
                                        <div class="section-title">{{ __('Pengaturan Email') }}
                                        </div>
                                        <form wire:submit.prevent="updateEmail" class="needs-validation" novalidate="">
                                            <div class="form-group">
                                                <label class="control-label" for="name">{{ __('Email
                                                Baru') }}</label>
                                                <input type="email" name="new_email"
                                                    placeholder="Masukkan email baru Anda"
                                                    class="form-control {{ $errors->has('new_email') ? ' is-invalid' : '' }}"
                                                    required="" wire:model.defer="new-email">
                                                <x-input-error for="new_email" />
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
                                            <x-button type="submit" class=" btn btn-primary">
                                                {{ __('Ubah Email') }}
                                            </x-button>
                                        </form>
                                        <hr>
                                        <div class="section-title">{{ __('Browser Sessions') }}
                                        </div>
                                        @livewire('profile.logout-other-browser-sessions-form')
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
