@push('button')
<x-button class="float-right btn btn-primary" data-toggle="modal" data-target="#modalPenulis" id="btnTambahData">
    {{ __('Tambah data') }}
</x-button>
<a href="" class="float-right btn btn-secondary">Cetak</a>
@endpush
<div class="mt-4 row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Penulis </h4>
            </div>
            <div class="card-body">
                @include('penulis.modal-penulis')
                <x-select-search>
                    @slot('filter')
                    wire:model="perPage"
                    @endslot
                    @slot('search')
                    wire:model="query"
                    @endslot
                </x-select-search>
                <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="katalogTable">
                        <thead align="center">
                            <tr>
                                <th width="5px">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jumlah Judul</th>
                                <th>Jumlah Pustaka</th>
                                <th>Kontak</th>
                                <th>Keterangan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @empty($datas->total())
                            <tr>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                            @else
                            @foreach ($datas as $pen => $data)
                            @php
                            $num_judul = App\Models\Penulis::join('pustaka',
                            'penulis.id','pustaka.penulis')->where('pustaka.penulis',$data->id)->get();
                            $num_pustaka =
                            App\Models\Pustaka::rightJoin('daftar_pustaka','pustaka.id','daftar_pustaka.pustaka')->where('pustaka.penulis',$data->id)->select('daftar_pustaka.id')->get();
                            @endphp
                            <tr>
                                <td width="5px">{{ $pen + $datas->firstItem() }}</td>
                                <td>{{ $data->kode }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $num_judul->count() }}
                                    @if(!empty($num_judul)) <a href=""><span class="fa fa-search"></span></a> @endif
                                </td>
                                <td>{{ $num_pustaka->count() }}</td>
                                <td>{{ $data->kontak }}</td>
                                <td>{{ $data->keterangan }}</td>
                                <td>
                                    <x-button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#modalPenulis" wire:click="edit({{ $data->id }})">
                                        <span class="fa fa-edit"></span></x-button>
                                    <x-button class="btn btn-danger btn-sm"
                                        wire:click="$emit('triggerDelete',{{ $data->id }})">
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
    window.livewire.on('updatedPenulis', () => {
        $('#modalPenulis').modal('hide');
        });
    window.livewire.on('penulisStore', () => {
        $('#modalPenulis').modal('hide');
        });
    document.addEventListener('DOMContentLoaded', function () {
        @this.on('triggerDelete', id => {
            swal({
                title: 'Are you sure?',
                text: 'Once deleted, you will not be able to recover this imaginary file!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                    if (result) {
                        @this.call('destroy',id)
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
