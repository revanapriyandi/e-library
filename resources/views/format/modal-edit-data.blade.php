<div>
    <x-modal wire:ignore.self tabindex="-1" role="dialog" id="modalEditFormat">
        <x-slot name="title">
            {{ __('Update Format Pustaka' ) }}
        </x-slot>
        <x-slot name="content">
            <form class="needs-validation" novalidate="">
                <div class="form-group">
                    <x-input type="text" class="form-control {{ $errors->has('kode') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Kode') }}" required wire:model="kode" />
                    <x-input-error for="kode" />
                </div>
                <div class="form-group">
                    <x-input type="nama" class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Nama') }}" required wire:model="nama" />
                    <x-input-error for="nama" />
                </div>
                <div class="form-group">
                    <textarea name="keterangan" id="keterangan" cols="30" rows="10"
                        class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}"
                        wire:model="keterangan" placeholder="{{ __('Keterangan') }}"></textarea>
                    <x-input-error for="keterangan" />
                </div>
        </x-slot>
        <x-slot name="footer">
            <x-button class="btn btn-secondary" data-dismiss="modal">
                {{ __('Batal') }}
            </x-button>

            <x-button type="button" wire:click.prevent="update()" class="btn btn-primary"
                wire:loading.class="btn disabled btn-primary btn-progress">
                {{ __('Simpan') }}
            </x-button>
            </form>
        </x-slot>
    </x-modal>
    @push('js')
    <script>
        $("#modalEditFormat").modal({backdrop: false,show: false});
    </script>
    @endpush
</div>
