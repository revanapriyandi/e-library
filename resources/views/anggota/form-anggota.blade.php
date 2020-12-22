@include('anggota.modalForm')
<form wire:submit.prevent="submitData()" class="needs-validation" novalidate="">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <x-label for="nama" required>{{ __('Nama') }}</x-label>
                        <x-input type="text" class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Nama') }}" required wire:model="nama" />
                        <x-input-error for="nama" />
                    </div>
                    <div class="form-group">
                        <x-label for="email" required>{{ __('Email') }}</x-label>
                        <x-input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Email') }}" required wire:model="email" />
                        <x-input-error for="email" />
                    </div>
                    <div class="form-group">
                        <x-label for="hp" required>{{ __('Hp/Whatsapp') }}</x-label>
                        <x-input type="text" class="form-control {{ $errors->has('hp') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Hp') }}" required wire:model="hp" />
                        <x-input-error for="hp" />
                    </div>
                    @if ($job == 'siswa')
                    <div class="form-group">
                        <x-label for="kelas" required>{{ __('Kelas') }}</x-label>
                        <select name="kelas" id="kelas" wire:model="kelas" required>
                            <option value="XXX">XXXX</option>
                        </select>
                        <x-input-error for="kelas" />
                    </div>
                    @endif
                    @if ($job != 'nonSekolah')
                    <div class="form-group">
                        <x-label for="institusi" required>{{ __('Institusi') }}</x-label>
                        <x-input type="text" class="form-control {{ $errors->has('institusi') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('institusi') }}" required wire:model="institusi" />
                        <x-input-error for="institusi" />
                    </div>
                    @endif
                    <div class="form-group">
                        <x-label for="telpon">{{ __('Telpon (Opsional)') }}</x-label>
                        <x-input type="text" class="form-control {{ $errors->has('telpon') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Telpon') }}" wire:model="telpon" />
                        <x-input-error for="telpon" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="card card-primary">
                <div class="card-body">

                    <div class="form-group">
                        <x-label for="photo">{{ __('Photo Diri') }}</x-label>
                        <x-input type="file" class="form-control {{ $errors->has('photo') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Photo') }}" wire:model="photo" />
                        <x-input-error for="photo" />
                    </div>

                    <div class="form-group">
                        <x-label for="kodepos" required>{{ __('ZIP') }}</x-label>
                        <x-input type="number" class="form-control {{ $errors->has('kodepos') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('ZIP') }}" required wire:model="kodepos" />
                        <x-input-error for="kodepos" />
                    </div>
                    <div class="form-group">
                        <x-label for="alamat" required>{{ __('Alamat') }}</x-label>
                        <textarea name="alamat" id="alamat" required cols="30" rows="10" class="form-control"
                            wire:model="alamat" placeholder="Alamat"></textarea>
                        <x-input-error for="alamat" />
                    </div>
                    <div class="form-group">
                        <x-label for="keterangan">{{ __('Keterangan (Opsional)') }}</x-label>
                        <textarea name="keterangan" placeholder="Keterangan" id="keterangan" cols="30" rows="10"
                            class="form-control" wire:model="keterangan"></textarea>
                        <x-input-error for="keterangan" />
                    </div>

                </div>
            </div>
        </div>
    </div>
    <x-button class="btn btn-primary btn-block" type="submit">{{ __('Simpan') }}</x-button>
</form>
@push('js')
<script>
    @if ($job == null)
        $('#modalForm').modal('show');
    @endif
</script>
@endpush
