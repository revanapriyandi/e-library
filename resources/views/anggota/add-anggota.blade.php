<section class="section">
    <div class="section-body">
        <form wire:submit.prevent="store()" class="needs-validation" novalidate="">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <x-label for="nama" required>{{ __('Nama') }}</x-label>
                                <x-input type="text"
                                    class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Nama') }}" required wire:model="nama" />
                                <x-input-error for="nama" />
                            </div>
                            <div class="form-group">
                                <x-label for="email" required>{{ __('Email') }}</x-label>
                                <x-input type="text"
                                    class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Email') }}" required wire:model="email" />
                                <x-input-error for="email" />
                            </div>
                            <div class="form-group">
                                <x-label for="hp" required>{{ __('Hp/Whatsapp') }}</x-label>
                                <x-input type="text" class="form-control {{ $errors->has('hp') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Hp') }}" required wire:model="hp" />
                                <x-input-error for="hp" />
                            </div>
                            <div wire:ignore>
                                @if (request()->job == 'siswa')
                                <div class="form-group">
                                    <x-label for="kelas" required>{{ __('Kelas') }}</x-label>
                                    <select name="kelas" id="kelas" wire:model="kelas" class="form-control" required>
                                        <option value="">{{ __('Silahkan Pulih Kelas') }}</option>
                                        @forelse ($dataKelas as $dk)
                                        <option value="{{ $dk->id }}">{{ $dk->name }}</option>
                                        @empty
                                        <option value="#">{{ __('Tidak ada data') }}</option>
                                        @endforelse
                                    </select>
                                    <x-input-error for="kelas" />
                                </div>
                                @endif
                                @if (request()->job != 'nonSekolah')
                                <div class="form-group">
                                    <x-label for="institusi" required>{{ __('Institusi') }}</x-label>
                                    <x-input type="text"
                                        class="form-control {{ $errors->has('institusi') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('institusi') }}" required wire:model="institusi" />
                                    <x-input-error for="institusi" />
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <x-label for="telpon">{{ __('Telpon (Opsional)') }}</x-label>
                                <x-input type="text"
                                    class="form-control {{ $errors->has('telpon') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Telpon') }}" wire:model="telpon" />
                                <x-input-error for="telpon" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-12">
                    <div class="card card-primary">
                        <div class="card-body">

                            <div class="form-group ">
                                <x-label for="photo">
                                    {{ __('Photo') }}
                                </x-label>
                                @if($photo)
                                <figure class="mb-4 ">
                                    <img src="{{ $photo->temporaryUrl() }}" width="40%" alt="}"
                                        class="imagecheck-image">
                                </figure>
                                @else
                                <figure class="mb-4 ">
                                    <img src="{{ asset('assets/img/news/img01.jpg') }}" width="40%" height="40%" alt="}"
                                        class="imagecheck-image">
                                </figure>
                                @endif
                                <div class="custom-file">
                                    <input type="file" name="photo" accept="image/*" wire:model="photo"
                                        class="custom-file-input" id="photo">
                                    <label class="custom-file-label">Choose File</label>
                                </div>
                                <x-input-error for="photo" />
                            </div>

                            <div class="form-group">
                                <x-label for="kodepos" required>{{ __('ZIP') }}</x-label>
                                <x-input type="number"
                                    class="form-control {{ $errors->has('kodepos') ? ' is-invalid' : '' }}"
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
            <x-button class="btn btn-primary btn-block" type="submit">
                {{ __('Simpan') }}</x-button>
        </form>

    </div>
</section>
