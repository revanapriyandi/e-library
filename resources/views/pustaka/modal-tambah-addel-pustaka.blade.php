<div>
    <x-modal wire:ignore.self tabindex="-1" role="dialog" class="modal" id="modalAddelPustaka">
        <x-slot name="title">
            {{ __( 'Tambah Pustaka ') }}
        </x-slot>
        <x-slot name="content">
            <form class="needs-validation" novalidate="">
                <div class="form-group">
                    <x-input type="number" class="form-control {{ $errors->has('jumlah') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Jumlah') }}" required wire:model="jumlah" />
                    <x-input-error for="jumlah" />
                </div>
        </x-slot>
        <x-slot name="footer">
            <x-button class="btn btn-secondary" data-dismiss="modal">
                {{ __('Batal') }}
            </x-button>

            <x-button type="button" class="btn btn-primary" wire:loading.class="btn disabled btn-primary btn-progress"
                wire:click.prevent="store()">
                {{ __('Simpan') }}
            </x-button>
            </form>
        </x-slot>
    </x-modal>
</div>
