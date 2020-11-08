@push('button')
<a href="" class="float-right btn btn-primary">
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
                                <th width="5px">No</th>
                                <th>Katalog</th>
                                <th width="40%">Judul</th>
                                <th>Jumlah Tersedia</th>
                                <th>Jumlah Dipinjam</th>
                                <th>Cetak Label & Barkode</th>
                                <th>Add /<br /> Del Pustaka</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @empty($datas->total())
                            <tr>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                            @else

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
