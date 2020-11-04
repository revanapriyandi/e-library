@push('button')
<x-button class="float-right btn btn-primary" data-toggle="modal" data-target="#modalFormat" id="btnTambahData">
    {{ __('Tambah data') }}
</x-button>
<a href="" class="float-right btn btn-secondary">Cetak</a>
@endpush
<div class="card">
    <div class="card-body">
        @include('format.modal-tambah-data')
        <div class="table-responsive">
            <table class="table table-striped dataTable no-footer" id="formatTable">
                <thead align="center">
                    <tr>
                        <th width="5px">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Jumlah Judul</th>
                        <th>Jumlah Pustaka</th>
                        <th>Keterangan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody align="center">
                    @foreach ($data as $data)
                    @php
                    $jml_judul = App\Models\Pustaka::where('format', $data->id)->count();
                    $jumlahAll = App\Models\Pustaka::where('format', $data->id)->sum('jumlah');
                    @endphp
                    <tr>
                        <td width="5px">{{ $no++ }}</td>
                        <td>{{ $data->kode }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $jml_judul }}</td>
                        <td>{{ $jumlahAll }}</td>
                        <td>{{ $data->keterangan }}</td>
                        <td>
                            <x-button class=" btn btn-warning btn-sm" wire:click="edit({{ $data->id }})"
                                data-target="#modalFormat" data-toggle="modal" id="btnEditData"><span
                                    class="fa fa-edit"></span>
                            </x-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('js')
<script>
    $("#formatTable").dataTable({

    });
    window.livewire.on('formatStore', () => {
    $('#modalFormat').modal({show: false});
    });
</script>
@endpush
