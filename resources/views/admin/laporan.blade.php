<div class="m-3 my-4">
    <div class="d-flex flex-row justify-content-between">
        <div>
            <h2 class="text-start">Laporan</h2>
            <p>Laporan Pendapatan Parkiran</p>
        </div>
        <button wire:click="report" class="btn btn-primary my-4">
            <i class="bi bi-file-earmark-plus me-2"></i>Buat Laporan
        </button>
    </div>
    <div wire:poll class="py-3 d-flex justify-content-start position-sticky sticky-searchbar">
        <select wire:model="bulan" class="form-select bg-body-tertiary shadow-sm" id="monthFilter" style="width: 32%">
            <option value="All" selected>All</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
        <div class="col-7 mx-2 rounded-2 shadow-sm">
            <input wire:model="search" type="search" id="inputBar" class="form-control" placeholder="Cari Tanggal Laporan : Ctrl+/">
        </div>
        <div class="input-group bg-body-tertiary shadow-sm" style="width: 70%">
            <span class="input-group-text">Order By</span>
            <select wire:model="orderBy" class="form-select" id="orderBy">
                <option value="tgl_laporan" selected>Tanggal Laporan</option>
                <option value="jumlah_kendaraan">Jumlah Kendaraan</option>
                <option value="pendapatan_rp">Pendapatan</option>
            </select>
        </div>
    </div>

    {{-- Laporan Table --}}
    <table wire:poll class="table table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tanggal Laporan</th>
                <th scope="col">Jumlah Kendaraan</th>
                <th scope="col">Pendapatan (Rp)</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($list_laporan as $laporan)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td class="align-middle">{{ $laporan->tgl_laporan->format('d-M-Y') }}</td>
                    <td class="align-middle">{{ $laporan->jumlah_kendaraan }}</td>
                    <td class="align-middle">Rp. {{ number_format($laporan->pendapatan_rp, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $list_laporan->links() }}
    </div>
</div>
