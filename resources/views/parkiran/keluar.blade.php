<div class="container">
    <div class="row p-5">
        <div class="mb-4 px-0 input-group input-group-lg shadow-sm rounded position-sticky sticky-searchbar">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input wire:model="search" type="search" class="form-control" placeholder="Cari Plat Kendaraan"
                oninput="this.value = this.value.toUpperCase()" autofocus>
        </div>

        {{-- Kendaraan Table --}}
        <table class="table table-hover ">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Plat Kendaraan</th>
                    <th scope="col">Tempat Parkir</th>
                    <th scope="col">Waktu Masuk</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($active_kendaraan as $kendaraan)
                    <tr>
                        <th class="align-middle fs-5" scope="row">{{ $loop->index + 1 }}</th>
                        <td class="align-middle fs-5 fw-medium">{{ $kendaraan->plat_kendaraan }}</td>
                        <td class="align-middle">{{ $kendaraan->ruang_parkir }}</td>
                        <td class="align-middle">
                            {{ $kendaraan->waktu_masuk->format('H:i') }} | 
                            @if ($kendaraan->waktu_masuk->isToday())
                                Hari Ini
                            @elseif ($kendaraan->waktu_masuk->isYesterday())
                                Kemarin
                            @else
                                {{ $kendaraan->waktu_masuk->format('d-M-Y') }}
                            @endif
                        </td>
                        <td class="align-middle">
                            <button wire:click="keluar({{ $kendaraan->id_kendaraan }})" class="btn btn-primary">
                                <i class="bi bi-box-arrow-right"></i> Keluar </button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th class="align-middle" scope="row">3</th>
                    <td class="align-middle fw-medium">L752</td>
                    <td class="align-middle">Lantai-1 | A7</td>
                    <td class="align-middle">08:54</td>
                    <td class="align-middle">
                        <button class="btn btn-primary"><i class="bi bi-box-arrow-right"></i> Keluar </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
