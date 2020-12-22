@push('button')
<a href="{{ route('anggota.form') }}" class="float-right btn btn-primary" id="btnTambahData">
    {{ __('Tambah data') }}
</a>
<a href="" class="float-right btn btn-secondary">Cetak</a>
@endpush
<div class="card">
    <div class="card-header">
        <h4>{{ __('Semua Anggota') }}</h4>
    </div>
    <div class="card-body">
        <div class="float-left">
            <select class="form-control selectric">
                <option>Action For Selected</option>
                <option>Move to Draft</option>
                <option>Move to Pending</option>
                <option>Delete Pemanently</option>
            </select>
        </div>
        <x-select-search>
            @slot('search')
            wire:model="query"
            @endslot
        </x-select-search>

        <div class="clearfix mb-3"></div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead align="center">
                    <tr>
                        <th class="pt-2 text-center">#</th>
                        <th>{{ __('Nama') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Pekerjaan') }}</th>
                        <th>{{ __('HP') }}</th>
                        <th>{{ __('Tgl Daftar') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody align="center">
                    @forelse ($datas as $data => $dat)
                    <tr>
                        <td>{{$data + $datas->firstItem() }}</td>
                        <td>
                            <div class="accordion-header" role="button" data-toggle="collapse"
                                data-target="#panel-body-1" aria-expanded="true">
                                <img alt="image" src="{{ $dat->getPicture() }}" class="rounded-circle" width="35"
                                    data-toggle="title" title="">
                                <div class="ml-1 d-inline-block">{{ $dat->nama }}</div>
                            </div>
                        </td>
                        <td>
                            <a href="mailto:{{ $dat->email }}">{{ $dat->email }}</a>
                        </td>
                        <td>
                            {!! $dat->getPekerjaan() !!}
                        </td>
                        <td>
                            <a href="tel:{{ $dat->hp }}">{{ $dat->hp }}</a>
                        </td>
                        <td>{{ $dat->created_at->diffForHumans() }}</td>
                        <td>
                            {!! $dat->getStatus() !!}
                        </td>
                        <td>
                            <a href="javascript:" class="btn btn-warning btn-sm" data-target="#modalAnggota"
                                data-toggle="modal" data-placement="bottom" title=""
                                data-original-title="Edit Anggota"><i class="fa fa-edit"></i></a>
                            <a href="" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom"
                                title="" data-original-title="Hapus Anggota"><i class="fa fa-trash"></i></a>
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
