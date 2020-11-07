@push('button')
<x-button class="float-right btn btn-primary" data-toggle="modal" data-target="#modalPenerbit" id="btnTambahData">
    {{ __('Tambah data') }}
</x-button>
<a href="" class="float-right btn btn-secondary">Cetak</a>
@endpush
@push('css')
<link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
@endpush
<div class="mt-4 row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Penerbit </h4>
            </div>
            <div class="card-body">
                @include('penerbit.modal-penerbit')
                <x-select-search>
                    @slot('filter')
                    wire:model="perPage"
                    @endslot
                    @slot('search')
                    wire:model="query"
                    @endslot
                </x-select-search>
                <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="penerbitTable">
                        <thead align="center">
                            <tr>
                                <th width="5px">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jumlah Judul</th>
                                <th>Jumlah Pustaka</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Keterangan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @empty($datas->total())
                            <tr>
                                <td colspan="9">Tidak ada data</td>
                            </tr>
                            @else
                            @foreach ($datas as $data)
                            @php
                            $num_judul = App\Models\Penerbit::join('pustaka',
                            'penerbit.id','pustaka.penerbit')->where('pustaka.penerbit',$data->id)->get();
                            $num_pustaka =
                            App\Models\Pustaka::rightJoin('daftar_pustaka','pustaka.id','daftar_pustaka.pustaka')->where('pustaka.penerbit',$data->id)->select('daftar_pustaka.id')->get();
                            @endphp
                            <tr>
                                <td width="5px">{{ $no++ }}</td>
                                <td>{{ $data->kode }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $num_judul->count() }}
                                    @if(!empty($num_judul)) <a href=""><span class="fa fa-search"></span></a> @endif
                                </td>
                                <td>{{ $num_pustaka->count() }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td> <a href="tel:{{ $data->telepon }}">{{ $data->telepon }}</a></td>
                                <td width="25%">{{ $data->keterangan }}</td>
                                <td>
                                    <x-button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#modalPenerbit" wire:click="edit({{ $data->id }})">
                                        <span class="fa fa-edit"></span></x-button>
                                    <x-button class="btn btn-danger btn-sm"
                                        onclick="confirm('Confirm delete?') || event.stopImmediatePropagation()"
                                        wire:click="destroy({{ $data->id }})">
                                        <span class="fa fa-trash"></span></x-button>
                                </td>
                            </tr>
                            @endforeach
                            @endempty
                        </tbody>
                    </table>
                </div>
                <div class="float-right">
                    {{ $datas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script type="text/javascript">
    window.livewire.on('updatedPenerbit', () => {
        $('#modalPenerbit').modal('hide');
        });
    window.livewire.on('penerbitStore', () => {
        $('#modalPenerbit').modal('hide');
        });
</script>
@endpush
