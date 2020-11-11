@push('button')
<x-button class="float-right btn btn-primary" data-toggle="modal" data-target="#modalAddelPustaka" id="btnTambahData">
    {{ __('Tambah Pustaka') }}
</x-button>
<a href="javascript:" onclick='PrintBarcode()' class="float-right btn btn-secondary"><span
        class=" fa fa-barcode"></span>
    Cetak
    Label & Pustaka</a>
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
                                <th width="5px">No</th>
                                <th width="25%">{{ __('Kode Pustaka') }}</th>
                                <th width="20%">{{ __('Status') }}</thw>
                                <th width="40%">{{ __('Informasi') }}</th>
                                <th>{{ __('Aktif') }}</th>
                                <th>{{ __('Cetak barcode') }}</th>
                                <th>{{ __('Hapus') }}</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @forelse ($datas as $data => $pus)
                            <tr>
                                <td>{{$data + $datas->firstItem() }}</td>
                                <td>
                                    <strong>{{ $pus->kodepustaka }}</strong><br />
                                    <span>Barcode: {{ $pus->info1 }} </span>
                                </td>
                                <td>{!! $pus->statused !!}</td>
                                <td></td>
                                <td>
                                    @if ($pus->aktif == '1')
                                    @if($pus->status == '0' )
                                    <a href="javascript:" data-toggle='tooltip' data-placement='bottom'
                                        title='Tidak bisa mengubah pustaka ini karena telah dipinjam sebelumnya.'>
                                        <span class="fa fa-smile text-primary"></span>
                                    </a>
                                    @else
                                    <a href="javascript:" wire:click="$emit('setActive',{{ $pus->id }})">
                                        <span class="fa fa-smile text-primary"></span>
                                    </a>
                                    @endif
                                    @else
                                    <a href="javascript:" wire:click="$emit('setActive',{{ $pus->id }})">
                                        <span class="fa fa-frown text-warning"></span>
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                            class="custom-control-input" id="ck{{ $pus->id }}">
                                        <label for="ck{{ $pus->id }}" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td>
                                    @if ($pus->status == '1')
                                    <a href="javascript:" wire:click="$emit('triggerDelete',{{ $pus->id }})">
                                        <span class="fa fa-trash text-danger"></span>
                                    </a>
                                    @else
                                    <a href="javascript:" data-toggle='tooltip' data-placement='bottom'
                                        title='Tidak bisa menghapus pustaka ini karena telah dipinjam sebelumnya.'>
                                        <span class="fa fa-trash text-danger"></span>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Tidak ada data</td>
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
    @include('pustaka.modal-tambah-addel-pustaka')
    @push('js')
    <script src="{{ asset('js/daftar_pustaka.js') }}"></script>
    <script>
        window.livewire.on('pustakaStore', () => {
        $('#modalAddelPustaka').modal('hide');
        });
        document.addEventListener('DOMContentLoaded', function () {
            @this.on('triggerDelete', daftarPustakaId => {
                swal({
                    title: 'Are you sure?',
                    text: 'Once deleted, you will not be able to recover this imaginary file!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                        if (result) {
                            @this.call('destroy',daftarPustakaId)
                            window.livewire.on('alert', param => {
                            swal(param['message']);
                            });
                        } else {
                            swal('Operation Canceled.');
                        }
                    });
                });
            @this.on('setActive', daftarPustakaId => {
                swal({
                    title: 'Are you sure?',
                    text: 'Apakah anda akan mengubah status aktif pustaka ini?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                        if (result) {
                            @this.call('Active',daftarPustakaId)
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
