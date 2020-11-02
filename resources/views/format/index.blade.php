<x-app-layout>
    <x-slot name="header">
        {{ __('Daftar Format Pustaka') }}
    </x-slot>
    @push('button')
    <a href="" class="float-right btn btn-primary">Tambah data</a>
    <a href="" class="float-right btn btn-secondary">Cetak</a>
    @endpush
    <div class="card">
        <div class="card-body">
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
                    <tbody align="center"></tbody>
                </table>
            </div>
        </div>
    </div>
    @push('js')
    <script>
        $("#formatTable").dataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('format.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kode', name: 'kode'},
                {data: 'nama', name: 'nama'},
                {data: 'jml_judul', name: 'jml_judul'},
                {data: 'jml_pustaka', name: 'jml_pustaka'},
                {data: 'keterangan', name: 'keterangan'},
                {data: 'aksi', name: 'aksi', orderable: false, searchable: false},
            ],
        });
    </script>
    @endpush
</x-app-layout>
