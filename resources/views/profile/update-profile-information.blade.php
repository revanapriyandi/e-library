<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="pt-3 container-fluid">
                    <div class="container">
                        <div class="my-5 row" id="settings-nav">
                            <div class="pb-5 col-md-3">
                                <div class="nav flex-column nav-pills" aria-orientation="vertical">
                                    <a class="nav-item nav-link active show"
                                        href="{{ route('profile.update-profile') }}">Profile
                                        Information</a>
                                    </a>
                                    <a class="nav-item nav-link " href="{{ route('profile.update-password') }}">Update
                                        Password
                                    </a>
                                    <a class="nav-item nav-link" href="{{ route('profile.update-lainnya') }}">Lainnya
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="account" role="tabpanel">
                                        <h4 class="mb-3">Pengaturan Akun</h4>
                                        <hr>
                                        <p class="text-small text-muted">
                                            Perbarui informasi profil dan alamat email akun Anda.
                                        </p>
                                        <div>
                                            <form wire:submit.prevent="updateProfileInformation"
                                                class="needs-validation" novalidate="">
                                                <div class="form-group">
                                                    <label class="control-label " for="image">Foto Diri</label>
                                                    <div class="row">
                                                        <div class="col-md-2">

                                                            @if($photo)
                                                            <figure class="mr-2 avatar avatar-xl">
                                                                <img src="{{ $photo->temporaryUrl() }}" alt="profile">
                                                            </figure>
                                                            @else
                                                            <figure class="mr-2 avatar avatar-xl">
                                                                <img src="{{ $this->user->profile_photo_url }}"
                                                                    alt="profile">
                                                            </figure>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-10">
                                                            Gambar Profile Anda sebaiknya memiliki rasio 1:1 dan
                                                            berukuran
                                                            tidak lebih dari 2MB.<br>
                                                            <x-input type="file"
                                                                class="form-control {{ $errors->has('photo') ? ' is-invalid' : '' }}"
                                                                title="Change Avatar" data-filename-placement="inside"
                                                                name="photo" id="upload_image" accept="image/*"
                                                                wire:model="photo" />
                                                            <x-input type="hidden" name="image" id="result_crop_img" />
                                                            <x-input-error for="photo" />
                                                        </div>
                                                        @if ($this->user->profile_photo_path)
                                                        <x-button type="button" class="mt-2 ml-2 btn btn-danger btn-sm"
                                                            wire:click="deleteProfilePhoto">
                                                            {{ __('Remove Photo') }}</x-button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <x-label class="control-label" for="nama">
                                                        {{ __('Nama Lengkap') }}<span class="text-danger">*</span>
                                                    </x-label>
                                                    <x-input name="nama" type="text"
                                                        class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                                        id="nama" required="" wire:model.defer="state.nama" />
                                                    <x-input-error for="nama" />
                                                </div>
                                                <div class="form-group">
                                                    <x-label class="control-label" for="pekerjaan">
                                                        {{ __('Profesi / Pekerjaan') }}<span
                                                            class="text-danger">*</span></x-label>
                                                    @if (empty($state['pekerjaan']))
                                                    <select
                                                        class="form-control {{ $errors->has('pekerjaan') ? ' is-invalid' : '' }}"
                                                        required="" wire:model.defer="state.pekerjaan" id="pekerjaan">
                                                        <option value="siswa">Siswa</option>
                                                        <option value="guru">Guru</option>
                                                        <option value="karyawan">Karyawan</option>
                                                    </select>
                                                    @else
                                                    <x-input name="pekerjaan"
                                                        class="form-control {{ $errors->has('pekerjaan') ? ' is-invalid' : '' }}"
                                                        id="pekerjaan" required=""
                                                        value="{{ucwords($state['pekerjaan'])}}" disabled readonly />
                                                    <x-input-error for="pekerjaan" />
                                                    @endif
                                                    <x-input-error for="pekerjaan" />
                                                </div>
                                                <div class="form-group">
                                                    <x-label class="control-label" for="telpon">{{ __('Hp') }}<span
                                                            class="text-danger">*</span></x-label>
                                                    <x-input name="telpon" type="text"
                                                        class="form-control {{ $errors->has('telpon') ? ' is-invalid' : '' }}"
                                                        required id="telpon" wire:model.defer="state.telpon" />
                                                    <x-input-error for="hp" />
                                                </div>
                                                <div class="section-title">{{ __('Alamat') }}<span
                                                        class="text-danger">*</span></div>
                                                @if (empty($state['alamat']))
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <x-label class="contol-label" for="address">Nama Jalan, No
                                                            Rumah, Gang, Komplek</x-label>
                                                        <x-input type="text" wire:model.defer="state.address"
                                                            name="address"
                                                            class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                            value="" data-bv-notempty="true"
                                                            data-bv-notempty-message="Mohon isikan detail alamat Anda" />
                                                        <x-input-error for="address" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-5">
                                                        <x-label class="contol-label" for="rtrw">RT/RW</x-label>
                                                        <x-input type="text" wire:model.defer="state.rtrw" name="rtrw"
                                                            class="form-control {{ $errors->has('rtrw') ? ' is-invalid' : '' }}"
                                                            value="000/000" data-bv-notempty="true"
                                                            data-bv-notempty-message="Mohon isikan RT/RW Anda" />
                                                        <x-input-error for="rtrw" />
                                                    </div>
                                                    <div class="col-md-7">
                                                        <x-label class="contol-label" for="village">Kelurahan / Desa
                                                        </x-label>
                                                        <x-input type="text" wire:model.defer="state.village"
                                                            name="village"
                                                            class="form-control {{ $errors->has('village') ? ' is-invalid' : '' }}"
                                                            value="" data-bv-notempty="true"
                                                            data-bv-notempty-message="Mohon isikan kelurahan/desa Anda" />
                                                        <x-input-error for="village" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <x-label class="contol-label" for="kecamatan">Kecamatan
                                                        </x-label>
                                                        <x-input type="text" wire:model.defer="state.kecamatan"
                                                            name="kecamatan"
                                                            class="form-control {{ $errors->has('kecamatan') ? ' is-invalid' : '' }}"
                                                            value="" data-bv-notempty="true"
                                                            data-bv-notempty-message="Mohon isikan kecamatan Anda" />
                                                        <x-input-error for="kecamatan" />

                                                    </div>

                                                    <div class="col-md-6">
                                                        <x-label class="contol-label" for="kabupaten">Kota / Kabupaten
                                                        </x-label>
                                                        <x-input type="text" wire:model.defer="state.kabupaten"
                                                            class="form-control {{ $errors->has('kabupaten') ? ' is-invalid' : '' }}"
                                                            id="kabupaten" required />
                                                        <x-input-error for="kabupaten" />
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group ">
                                                    <x-label class="contol-label" for="alamat">Alamat</x-label>
                                                    <textarea name="alamat" id="alamat"
                                                        class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}"
                                                        cols="30" rows="10" wire:model.defer="state.alamat"></textarea>
                                                    <x-input-error for="alamat" />
                                                </div>
                                                @endif
                                                <div class="form-group ">
                                                    <x-label class="contol-label" for="kodepos">Kode Pos</x-label>
                                                    <x-input wire:model.defer="state.kodepos" type="text" name="kodepos"
                                                        class="form-control " value="" data-bv-notempty="true"
                                                        data-bv-notempty-message="Mohon isikan kode pos Anda" />
                                                    <x-input-error for="kodepos" />
                                                </div>
                                                <x-button type="submit" class="float-right btn btn-primary ">Simpan
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
