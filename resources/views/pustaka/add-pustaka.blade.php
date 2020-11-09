<div>
    @push('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    @endpush
    <section class="section">
        <div class="section-body">
            <form wire:submit.prevent="store" class="needs-validation" novalidate="">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group ">
                                    <x-label for="judul">
                                        {{ __('Judul') }}
                                    </x-label>
                                    <x-input type="text" wire:model="judul" name="judul" id="judul" required
                                        class="{{ $errors->has('judul') ? ' is-invalid' : '' }}" />
                                    <x-input-error for="judul" />
                                </div>
                                <div class="form-group ">
                                    <x-label for="harga">
                                        {{ __('Harga Satuan') }}
                                    </x-label>
                                    <x-input type="text" name="harga" wire:model="harga" id="harga" required
                                        class="{{ $errors->has('harga') ? ' is-invalid' : '' }}" onBlur="Blur('harga')"
                                        onFocus="Fokus('harga')" />
                                    <x-input-error for="harga" />
                                </div>
                                <div class="form-group " wire:ignore>
                                    <x-label for="katalog">
                                        {{ __('Katalog') }}
                                    </x-label>
                                    <select name="katalog" id="katalog" data-placeholder="Katalog Pustaka"
                                        class="form-control select2 {{ $errors->has('katalog') ? ' is-invalid' : '' }}"
                                        wire:model="katalog" required>
                                        <option value=""></option>
                                        @foreach ($katalogs as $ktlg)
                                        <option value="{{ $ktlg->id }}">{{ $ktlg->kode }} -
                                            {{ $ktlg->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="katalog" />
                                </div>
                                <div class="form-group " wire:ignore>
                                    <x-label for="penulis">
                                        {{ __('Penulis') }}
                                    </x-label>
                                    <select name="penulis" id="penulis" data-placeholder="Penulis"
                                        class="form-control select2 {{ $errors->has('penulis') ? ' is-invalid' : '' }}"
                                        wire:model="penulis" required>
                                        <option value=""></option>
                                        @foreach ($penuliss as $pnlis)
                                        <option value="{{ $pnlis->id }}">{{ $pnlis->kode }} -
                                            {{ $pnlis->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="penulis" />
                                </div>
                                <div class="form-group" wire:ignore>
                                    <x-label for="penerbit">
                                        {{ __('Penerbit') }}
                                    </x-label>
                                    <select name="penerbit" id="penerbit"
                                        class="form-control select2 {{ $errors->has('penerbit') ? ' is-invalid' : '' }}"
                                        data-placeholder="Penerbit" wire:model="penerbit" required>
                                        <option value=""></option>
                                        @foreach ($penerbits as $pnbit)
                                        <option value="{{ $pnbit->id }}">{{ $pnbit->kode }} -
                                            {{ $pnbit->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="penerbit" />
                                </div>
                                <div class="form-group " wire:ignore>
                                    <x-label for="format">
                                        {{ __('Format') }}
                                    </x-label>
                                    <select name="format" id="format"
                                        class="form-control select2 {{ $errors->has('format') ? ' is-invalid' : '' }}"
                                        data-placeholder="Format Pustaka" wire:model="format" required>
                                        <option value=""></option>
                                        @foreach ($formats as $frmat)
                                        <option value="{{ $frmat->id }}">{{ $frmat->kode }} - {{ $frmat->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="format" />
                                </div>
                                <div class="form-group " wire:ignore>
                                    <x-label for="tahun">
                                        {{ __('Tahun Terbit') }}
                                    </x-label>
                                    <select name="tahun" id="tahun"
                                        class="form-control select2 {{ $errors->has('tahun') ? ' is-invalid' : '' }}"
                                        data-placeholder="Tahun Terbit" wire:model="tahun" required>
                                        <option value=""></option>
                                        @for ($i=date('Y'); $i>=date('Y')-32; $i-=1)
                                        <option value="{{ $i }}"> {{ $i }} </option>
                                        @endfor
                                    </select>
                                    <x-input-error for="tahun" />
                                </div>
                                <div class="form-group ">
                                    <x-label for="keyword">
                                        {{ __('Keyword') }}
                                    </x-label>
                                    <x-input type="text" wire:model="keyword" name="keyword" id="keyword" required
                                        class="{{ $errors->has('keyword') ? ' is-invalid' : '' }}" />
                                    <x-input-error for="keyword" />
                                </div>
                                <div class="form-group ">
                                    <x-label for="keteranganfisik">
                                        {{ __('Keterangan Fisik') }}
                                    </x-label>
                                    <textarea name="keteranganfisik"
                                        class="form-control {{ $errors->has('keteranganfisik') ? ' is-invalid' : '' }}"
                                        id="" cols="30" rows="10" wire:model="keteranganfisik" name="keteranganfisik"
                                        id="keteranganfisik" required></textarea>
                                    <x-input-error for="keteranganfisik" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group ">
                                    <x-label for="jumlah">
                                        {{ __('Alokasi Jumlah ') }}
                                    </x-label>
                                    <div class="input-group">
                                        <x-input type="number" wire:model="jumlah" name="jumlah" id="jumlah" required
                                            class="{{ $errors->has('jumlah') ? ' is-invalid' : '' }}" />
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Buah
                                            </div>
                                        </div>
                                        <x-input-error for="jumlah" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <x-label for="cover">
                                        {{ __('Cover') }}
                                    </x-label>
                                    @if($cover)
                                    <figure class="mb-4 ">
                                        <img src="{{ $cover->temporaryUrl() }}" width="40%" alt="}"
                                            class="imagecheck-image">
                                    </figure>
                                    @else
                                    <figure class="mb-4 ">
                                        <img src="{{ asset('assets/img/news/img01.jpg') }}" width="40%" height="40%"
                                            alt="}" class="imagecheck-image">
                                    </figure>
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" name="cover" accept="image/*" wire:model="cover"
                                            class="custom-file-input" id="cover">
                                        <label class="custom-file-label">Choose File</label>
                                    </div>
                                    <x-input-error for="cover" />
                                </div>
                                <div class="form-group " wire:ignore>
                                    <x-label for="abstraksi">
                                        {{ __('Abstraksi') }}
                                    </x-label>
                                    <textarea name="abstraksi" id="abstraksi"
                                        class="form-control {{ $errors->has('abstraksi') ? ' is-invalid' : '' }}"
                                        wire:model="abstraksi" required></textarea>
                                    <x-input-error for="abstraksi" />
                                </div>
                                <div class="form-group ">
                                    <x-label for="keterangan">
                                        {{ __('Keterangan Tambahan') }}
                                    </x-label>
                                    <textarea name="keterangan" id="keterangan" class="form-control"
                                        wire:model="keterangan"></textarea>
                                    <x-input-error for=" keterangan" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-button type="submit" class="btn btn-primary btn-block"  wire:loading.class="btn disabled btn-primary btn-progress btn-block">{{ __('Simpan') }}</x-button>
            </form>
        </div>
    </section>

    @push('js')
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('js/rupiah.js') }}"></script>
    <script>
        window.livewire.on('resetInputs', () => {
            $('#abstraksi').summernote('reset');
            $('.select2').val(null).trigger('change');
        });
        $(document).ready(function() {
        $('.select2').on('change', function(e){
            let elementName = $(this).attr('id');
            @this.set(elementName, e.target.value);
        })
        $(window).resize(function() {
            $('.select2').css('width', "100%");
        });
        $('#abstraksi').summernote({
            dialogsInBody: true,
            minHeight: 150,
            toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('abstraksi', contents);
                }
            }
        });
    });

    function Blur(elementId){
        var value = document.getElementById(elementId).value;
        if (value==''){
            document.getElementById(elementId).value = 0 ;
            if (elementId=='harga')
                formatRupiah(elementId) ;
            else
                document.getElementById(elementId).value = 0 ;
        }else {
            if (isNaN(value)){
                document.getElementById(elementId).value = 0 ;
            if (elementId=='harga')
                formatRupiah(elementId) ;
            else
                document.getElementById(elementId).value = 0 ;
            } else {
                if (elementId=='harga')
                    formatRupiah(elementId) ;
            }
        }
    }
    function Fokus(elementId){
        unformatRupiah(elementId) ;
    }
    </script>
    @endpush
</div>
