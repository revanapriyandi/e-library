@push('button')
<div class="mr-2 dropdown d-inline">
    <button class="float-right btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Tambah data') }}
    </button>
    <div class="dropdown-menu" x-placement="bottom-start"
        style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
        <a class="dropdown-item" href="{{ route('anggota.form',['job' => 'siswa']) }}">{{ __('Siswa') }}</a>
        <a class="dropdown-item" href="{{ route('anggota.form',['job' => 'pegawai']) }}">{{ __('Pegawai') }}</a>
        <a class="dropdown-item" href="{{ route('anggota.form',['job' => 'nonsekolah']) }}">{{ __('NonSekolah') }}</a>
    </div>
</div>
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
                        <th>{{ __('Noregistri') }}</th>
                        <th></th>
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
                    <tr @if($dat->aktif == false) style="color:red" @endif>
                        <td>{{$data + $datas->firstItem() }}</td>
                        <td>{{$dat->noregistrasi }}</td>
                        <td><img alt="image" src="{{ $dat->getPicture() }}" class="rounded-circle" width="35"
                                data-toggle="title" title=""></td>
                        <td>
                            <div class="accordion-header" role="button" data-toggle="collapse"
                                data-target="#panel-body-1" aria-expanded="true">

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
                        <td>{{ date('d/F/Y',strtotime($dat->created_at)) }}</td>
                        <td>
                            {!! $dat->getStatus($dat->id) !!}
                        </td>
                        <td>
                            <a href="javascript:" class="btn btn-warning btn-sm" data-target="#modalAnggota"
                                data-toggle="modal" data-placement="bottom" title=""
                                data-original-title="Edit Anggota"><i class="fa fa-edit"></i></a>
                            <a href="javascript:" wire:click="$emit('triggerDelete',{{ $dat->id }})"
                                class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title=""
                                data-original-title="Hapus Anggota"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">Tidak ada data</td>
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
@push('js')
<script type="text/javascript">
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
