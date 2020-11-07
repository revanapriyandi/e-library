@push('button')
<x-button class="float-right btn btn-primary" data-toggle="modal" data-target="#modalRak" id="btnTambahData">
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
                <h4>All Rak Pustaka</h4>
            </div>
            <div class="card-body">
                @include('rak.modal-rak')
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
                                <th>Rak</th>
                                <th>Jumlah Judul</th>
                                <th>Jumlah Pustaka</th>
                                <th>Keterangan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @empty($datas->total())
                            <tr>
                                <td colspan="6">Tidak ada data</td>
                            </tr>
                            @else
                            @foreach ($datas as $data)
                            @php
                            $jml_judul = App\Models\Katalog::where('rak', $data->id)->join('pustaka',
                            'katalog.id','pustaka.katalog')->get();
                            @endphp
                            <tr>
                                <td width="5px">{{ $no++ }}</td>
                                <td>{{ $data->rak }}</td>
                                <td>{{ $jml_judul->count() }}</td>
                                <td>{{ $jml_judul->sum('jumlah') }}</td>
                                <td>{{ $data->keterangan }}</td>
                                <td>
                                    <x-button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalRak"
                                        wire:click="edit({{ $data->id }})">
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
    window.livewire.on('rakStore', () => {
        $('#modalRak').modal('hide');
        });
    window.livewire.on('updatedRak', () => {
        $('#modalRak').modal('hide');
        });
</script>
@endpush