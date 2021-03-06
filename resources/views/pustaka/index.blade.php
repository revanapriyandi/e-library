@push('js')
<script src="{{ asset('js/daftar_pustaka.js') }}"></script>
@endpush
@push('button')
<a href="{{ route('pustaka.create') }}" class="float-right btn btn-primary">
    {{ __('Tambah data') }}
</a>
<a href="" class="float-right btn btn-secondary">Cetak</a>
@endpush
@push('css')
<link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
@endpush
<div class="mt-4 row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <x-select-search>
                    @slot('filter')
                    wire:model="perPage"
                    @endslot
                    @slot('search')
                    wire:model="query"
                    @endslot
                </x-select-search>
                <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="rakTable">
                        <thead align="center">
                            <tr>
                                <th width="5px">{{ __('No') }}</th>
                                <th width="20%">{{ __('Katalog') }}</thw>
                                <th width="40%">{{ __('Judul') }}</th>
                                <th>{{ __('Jumlah Tersedia') }}</th>
                                <th>{{ __('Jumlah Dipinjam') }}</th>
                                <th>{{ __('Cetak Label & Barkode') }}</th>
                                <th>Add /<br />{{__(' Del Pustaka')}}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @forelse ($datas as $data => $pus)
                            <tr>
                                <td>{{$data + $datas->firstItem() }}</td>
                                <td>{{ $pus->katalogs->kode }} - {{ $pus->katalogs->nama }}</td>
                                <td>{{ ucFirst($pus->judul) }}</td>
                                <td>{{ $pus->daftarPustaka->where('status',1)->count() }}</td>
                                <td>{{ $pus->daftarPustaka->where('status',0)->count() }}</td>
                                <td>
                                    <x-link href="javascript:cetak_nomor({{ $pus->id }})" data-toggle="tooltip"
                                        data-placement="bottom" title="Cetak Label."><span class="fa fa-barcode"></span>
                                    </x-link>
                                </td>
                                <td>
                                    <x-link href="{{ route('pustaka.adddel',$pus->id) }}" data-toggle="tooltip"
                                        data-placement="bottom" title="Penambahan dan Pengurangan Pustaka."><span
                                            class="fa fa-book"></span>
                                    </x-link>
                                </td>
                                <td>
                                    <a href="javascript:" wire:click="$emit('triggerDelete',{{ $pus->id }})">
                                        <span class="fa fa-trash text-danger"></span>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="float-right">
                    {{ $datas->links() }}
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @this.on('triggerDelete', PustakaId => {
                swal({
                    title: 'Are you sure?',
                    text: 'Once deleted, you will not be able to recover this imaginary file!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                        if (result) {
                            @this.call('destroy',PustakaId)
                            window.livewire.on('alert', param => {
                            swal(param['message']);
                            });
                        } else {
                            swal('Operation Canceled.');
                        }
                    });
                });
            });
    </script>
    @endpush
</div>
