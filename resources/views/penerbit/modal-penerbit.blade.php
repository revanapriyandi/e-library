<div>
    <x-modal wire:ignore.self tabindex="-1" role="dialog" class="modal" id="modalPenerbit">
        <x-slot name="close">
            wire:click="cancel()"
        </x-slot>
        @slot('lg',true)
        <x-slot name="title">
            {{ __( $updateMode ? 'Update Penerbit ' : 'Tambah Penerbit ') }}
        </x-slot>
        <x-slot name="content">
            <form class="needs-validation" novalidate="">
                <div class="form-group">
                    <x-input type="text" class="form-control {{ $errors->has('kode') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Kode') }}" required wire:model="kode" />
                    <x-input-error for="kode" />
                </div>
                <div class="form-group">
                    <x-input type="text" class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Nama') }}" required wire:model="nama" />
                    <x-input-error for="nama" />
                </div>
                <div class="row">
                    <div class=" col-md-6">
                        <div class="form-group">
                            <x-input type="text" class="form-control {{ $errors->has('telpon') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Telpon') }}" wire:model="telpon" />
                            <x-input-error for="telpon" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Email') }}" wire:model="email" />
                            <x-input-error for="email" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-md-6">
                        <div class="form-group">
                            <x-input type="text" class="form-control {{ $errors->has('fax') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Fax') }}" wire:model="fax" />
                            <x-input-error for="fax" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-input type="text" class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Website') }}" wire:model="website" />
                            <x-input-error for="website" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <x-input type="text" class="form-control {{ $errors->has('kontak') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Kontak') }}" wire:model="kontak" />
                    <x-input-error for="kontak" />
                </div>
                <div class="form-group">
                    <textarea name="alamat" id="alamat" cols="30" rows="10"
                        class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" wire:model="alamat"
                        placeholder="{{ __('Alamat') }}"></textarea>
                    <x-input-error for="alamat" />
                </div>
                <div class="form-group">
                    <textarea name="keterangan" id="keterangan" cols="30" rows="10"
                        class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}"
                        wire:model="keterangan" placeholder="{{ __('Keterangan') }}"></textarea>
                    <x-input-error for="keterangan" />
                </div>
        </x-slot>
        <x-slot name="footer">
            <x-button class="btn btn-secondary" data-dismiss="modal" wire:click="cancel()">
                {{ __('Batal') }}
            </x-button>

            <x-button type="button" class="btn btn-primary" wire:loading.class="btn disabled btn-primary btn-progress"
                wire:click.prevent="{{ $updateMode ? 'update()' : 'store()' }}">
                {{ __('Simpan') }}
            </x-button>
            </form>
        </x-slot>
    </x-modal>
</div>
