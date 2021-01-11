<div>
    <x-modal wire:ignore.self data-backdrop="false" data-keyboard="false" tabindex="-1" role="dialog" class="modal"
        id="modalForm">
        @slot('close')
        wire:click="cancel()"
        @endslot
        <x-slot name="title">
            {{ __( 'Pilih Role') }}
        </x-slot>
        <x-slot name="content">
            <div class="ml-5 buttons">
                <button type="button" wire:click="tipeJob('pegawai')" class="btn btn-warning">Pegawai</button>
                <button type="button" wire:click="tipeJob('siswa')" class="btn btn-primary ">Siswa</button>
                <button type="button" wire:click="tipeJob('nonSekolah')" class="btn btn-dark ">Anggota Luar
                    Sekolah</button>
            </div>
        </x-slot>
        <x-slot name="footer">
    </x-modal>
</div>
