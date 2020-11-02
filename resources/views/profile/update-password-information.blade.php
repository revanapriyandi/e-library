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
                                    <a class="nav-item nav-link active show"
                                        href="{{ route('profile.update-password') }}">Update
                                        Password
                                    </a>
                                    <a class="nav-item nav-link" href="{{ route('profile.update-lainnya') }}">Lainnya
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="updatepassword" role="tabpanel">
                                        <h4 class="mb-3">Perbarui Kata Sandi</h4>
                                        <hr>
                                        <p class="text-small text-muted">
                                            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk
                                            tetap
                                            aman.
                                        </p>
                                        <div>
                                            <form wire:submit.prevent="updatePassword" class="needs-validation"
                                                novalidate="">
                                                <div class="form-group">
                                                    <x-label class="control-label" for="current_password">
                                                        {{ __('Current Password') }}<span class="text-danger">*</span>
                                                    </x-label>
                                                    <x-input name="current_password" type="password"
                                                        class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                                                        id="current_password" required=""
                                                        wire:model.defer="state.current_password"
                                                        autocomplete="current-password" />
                                                    <x-input-error for="current_password" />
                                                </div>
                                                <div class="form-group">
                                                    <x-label class="control-label" for="password">
                                                        {{ __('New Password') }}<span class="text-danger">*</span>
                                                    </x-label>
                                                    <x-input name="password" type="password"
                                                        class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                        id="password" required="" wire:model.defer="state.password"
                                                        autocomplete="new-password" />
                                                    <x-input-error for="password" />
                                                </div>
                                                <div class="form-group">
                                                    <x-label class="control-label" for="password_confirmation">
                                                        {{ __('Confirm Password') }}<span class="text-danger">*</span>
                                                    </x-label>
                                                    <x-input name="password_confirmation" type="password"
                                                        class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                                        id="password_confirmation"
                                                        wire:model.defer="state.password_confirmation"
                                                        autocomplete="new-password" required />
                                                    <x-input-error for="password_confirmation" />
                                                </div>
                                                <x-button type="submit" class="float-right btn btn-primary "
                                                    wire:loading.class="float-right btn disabled btn-primary btn-progress">
                                                    Simpan
                                                </x-button>

                                            </form>
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
</div>
