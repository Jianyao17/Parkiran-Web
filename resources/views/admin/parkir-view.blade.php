<div class="m-3 my4">
    <h2 class="text-start">Parkiran</h2>
    <p>History Parkir Kendaraan</p>

    <div class="py-3 d-flex justify-content-start position-sticky sticky-searchbar">
        <select wire:model="waktu" class="flex-grow-0 form-select bg-body-tertiary shadow-sm" id="timeFilter">
            <option value="Semua" selected>Semua</option>
            <option value="Hari Ini">Hari Ini</option>
            <option value="Kemarin">Kemarin</option>
            <option value="Minggu Ini">Minggu Ini</option>
            <option value="Bulan Ini">Bulan Ini</option>
            <option value="Tahun Ini">Tahun Ini</option>
        </select>
        <div class="col-8 mx-2 rounded-2 shadow-sm">
            <input wire:model="search" type="search" id="inputBar" class="form-control" 
                oninput="this.value = this.value.toUpperCase()" placeholder="Cari History Parkir Kendaraan : Ctrl+/">
        </div>
        <select wire:model="status" class="flex-grow-0 form-select bg-body-tertiary shadow-sm" id="statusFilter">
            <option value="All" selected>All</option>
            <option value="Active">Active</option>
            <option value="Finished">Finished</option>
        </select>
    </div>

    {{-- Parkiran Table --}}
    <table wire:poll class="table table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Plat Kendaraan</th>
                <th scope="col">Tempat Parkir</th>
                <th scope="col">Waktu Masuk</th>
                <th scope="col">Waktu Keluar</th>
                <th scope="col">Biaya (Rp)</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($list_kendaraan as $kendaraan)
                <tr>
                    <th class="align-middle" scope="row">{{ $loop->index + 1 }}</th>
                    <td class="align-middle fw-bold">{{ $kendaraan->plat_kendaraan }}</td>
                    <td class="align-middle">{{ $kendaraan->ruang_parkir }}</td>
                    <td class="align-middle">
                        @if ($kendaraan->waktu_masuk != null)
                            {{ $kendaraan->waktu_masuk->format('H:i') }} | 
                            {{ $kendaraan->waktu_masuk->format('d-M-Y') }}
                        @endif
                    </td>
                    <td class="align-middle">
                        @if ($kendaraan->waktu_keluar != null)
                            {{ $kendaraan->waktu_keluar->format('H:i') }} | 
                            {{ $kendaraan->waktu_keluar->format('d-M-Y') }}
                        @endif
                    </td>
                    <td class="align-middle">Rp. {{ number_format($kendaraan->biaya, 2) }}</td>
                    @if ($kendaraan->status == 'Active')
                        <td class="align-middle fw-medium text-success">
                            <i class="bi bi-square-fill me-1"></i> Active 
                        </td>
                    @elseif ($kendaraan->status == 'Finished')
                        <td class="align-middle fw-medium text-primary">
                            <i class="bi bi-square-fill me-1"></i> Finished 
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $list_kendaraan->links() }}
    </div>
</div>
