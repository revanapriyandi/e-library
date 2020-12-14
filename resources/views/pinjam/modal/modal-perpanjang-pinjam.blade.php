<div>
    <x-modal wire:ignore.self tabindex="-1" role="dialog" class="modal" id="modalPerpanjangPinjam">
        <x-slot name="title">
            {{ __(  'Perpanjang Peminjaman') }}
        </x-slot>
        <x-slot name="content">
            <form class="needs-validation" novalidate="">
                <div class="form-group">
                    <x-input type="text" class="form-control {{ $errors->has('kode') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Kode Pustaka') }}" readonly disabled required wire:model="kode" />
                    <x-input-error for="kode" />
                </div>
                <div class="form-group">
                    <x-input type="text" class="form-control {{ $errors->has('judul') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Judul') }}" required readonly disabled wire:model="judul" />
                    <x-input-error for="judul" />
                </div>
                <div class="form-group">
                    <x-input type="date" min="{{ date('Y-m-d') }}"
                        max="{{ date('Y-m-d',strtotime('+7 day',strtotime(date('Y-m-d')))) }}"
                        class="form-control {{ $errors->has('tgl_kembali') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Tanggal Kembali') }}" value="25/04/2002" required
                        wire:model="tgl_kembali" />
                    <x-input-error for="tgl_kembali" />
                </div>
                <div class="form-group">
                    <textarea name="keterangan" id="keterangan"
                        class="form-control {{ $errors->has('keterangan') ? ' is-invalid' : '' }}" cols="30" rows="10"
                        wire:model="keterangan"></textarea>
                    <x-input-error for="keterangan" />
                </div>
        </x-slot>
        <x-slot name="footer">
            <x-button class="btn btn-secondary" data-dismiss="modal">
                {{ __('Batal') }}
            </x-button>

            <x-button type="button" class="btn btn-primary" wire:loading.class="btn disabled btn-primary btn-progress"
                wire:click.prevent="perpanjangUpdate()">
                {{ __('Simpan') }}
            </x-button>
            </form>
        </x-slot>
    </x-modal>
</div>
