@push('css')
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush
<div class="mt-4 row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="float-left" wire:ignore>
                    <select class="form-control select2" wire:model="kriteria" name="kriteria" id="kriteria"
                        data-minimum-results-for-search="Infinity">
                        <option value="all">100 Peminjaman Terakhir</option>
                        <option value="tglpinjam">Tanggal Peminjaman</option>
                        <option value="tglkembali">Jadwal Pengembalian</option>
                        <option value="nis">NIS Siswa</option>
                        <option value="nip">NIP Pegawai</option>
                    </select>
                    <div class="mt-3 form-inline">
                        <div class="row col-md-12 col-lg-12 col-12">
                            <div class="col-md-6 col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="periode">Periode Awal</label>
                                    <div class="input-group mx-sm-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input id="tglAwal" name="tglAwal" wire:model="tglAwal" type="text"
                                            class="form-control datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="periode">Periode Akhir</label>
                                    <div class="input-group mx-sm-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input id="tglAkhir" name="tglAkhir" wire:model="tglAkhir" type="text"
                                            class="form-control datepicker">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-select-search>
                    @slot('search')
                    wire:model="query"
                    @endslot
                </x-select-search>
                <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="rakTable">
                        <thead align="center">
                            <tr>
                                <th width='4%' height="30">No</th>
                                <th width='10%'>Tanggal Pinjam</th>
                                <th width='10%'>Jadwal Kembali</th>
                                <th width='22%'>Anggota</th>
                                <th width='*'>Pustaka</th>
                                <th width='15%'>Keterangan</th>
                                <th width='5%'>Telat<br>(<em>hari</em>)</th>
                                <th width='5%'>Pengem<br>balian</th>
                                <th width='5%'>Perpan<br>jangan</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            {{--  @forelse ($datas as $data => $pus)

                            @empty
                            <tr>
                                <td colspan="9">Tidak ada data</td>
                            </tr>
                            @endforelse  --}}
                        </tbody>
                    </table>
                </div>
                <div class="float-right">
                    {{--  {{ $datas->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').on('change', function(e){
            let elementName = $(this).attr('id');
            @this.set(elementName, e.target.value);
        })
        $(window).resize(function() {
            $('.select2').css('width', "100%");
        });
    });
</script>
@endpush
