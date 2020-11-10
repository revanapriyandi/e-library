<div>
    <x-modal wire:ignore.self tabindex="-1" role="dialog" class="modal" id="modalPenulis">
        @slot('close')
        wire:click="cancel()"
        @endslot
        <x-slot name="title">
            {{ __( $updateMode ? 'Update Penulis ' : 'Tambah Penulis ') }}
        </x-slot>
        <x-slot name="content">
            <form class="needs-validation" novalidate="">
                <div class="form-group">
                    <x-input type="text" class="form-control {{ $errors->has('kode') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Kode') }}" required wire:model="kode" />
                    <x-input-error for="kode" />
                </div>
                <div class="form-group">
                    <x-input type="text" class="form-control {{ $errors->has('gelar_depan') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Gelar Depan') }}" required wire:model="gelar_depan" />
                    <x-input-error for="gelar_depan" />
                </div>
                <div class="form-group">
                    <x-input type="text" class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Nama') }}" required wire:model="nama" />
                    <x-input-error for="nama" />
                </div>
                <div class="form-group">
                    <x-input type="text" class="form-control {{ $errors->has('gelar_belakang') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Gelar Belakang') }}" required wire:model="gelar_belakang" />
                    <x-input-error for="gelar_belakang" />
                </div>
                <div class="form-group">
                    <x-input type="text" class="form-control {{ $errors->has('kontak') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Kontak') }}" required wire:model="kontak" />
                    <x-input-error for="kontak" />
                </div>
                <div class="form-group">
                    <textarea name="biografi" id="biografi" cols="30" rows="10"
                        class="form-control {{ $errors->has('biografi') ? 'is-invalid' : '' }}" wire:model="biografi"
                        placeholder="{{ __('Biografi') }}"></textarea>
                    <x-input-error for="biografi" />
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
