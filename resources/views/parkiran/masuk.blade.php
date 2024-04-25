<div class="container">
    <div class="row p-5 border-start border-end border-bottom rounded-bottom-3">
        <div class="py-3 px-2 d-flex">
            <div class="flex-grow-1 input-group has-validation">
                <input wire:model="plat_kendaraan" class="form-control @error('plat_kendaraan') is-invalid @enderror fs-4 fw-medium rounded-3" 
                    style="height: 60px" type="text" placeholder="Input Plat Kendaraan" oninput="this.value = this.value.toUpperCase()" autofocus>
                <div class="mb-3 invalid-feedback position-relative">
                    @error('plat_kendaraan')
                        <div class="position-absolute start-0 fs-6">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button wire:click="store" class="btn btn-primary ms-3 fs-5 fw-medium shadow-sm" style="width: 300px; height: 60px">
                <i class="bi bi-car-front-fill me-1"></i> Tambah Kendaraan
            </button>
        </div>
        <div class="px-2 fs-5 d-flex flex-row justify-content-start">
            <div class="me-2 d-flex flex-row">
                <div class="fw-semibold me-2">Ruangan Yang Tersedia : </div>
                <div>{{ $ruang_tersisa['terpakai'] }} / {{ $ruang_tersisa['kapasitas'] }}</div>
            </div>
            <div class="ms-2 d-flex flex-row">
                <div class="fw-semibold me-2">Waktu Tanggal : </div>
                <div id="clock">
                    {{-- 08:45 - Monday, 24 April 2024 --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 border rounded-3">
        <h5 class="m-0 p-3 px-3 bg-body-tertiary">Terakhir Ditambahkan</h5>
        {{-- Laporan Table --}}
        <table class="table table-responsive table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Plat Kendaraan</th>
                    <th scope="col">Waktu Masuk</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($terakhir_ditambahkan as $kendaraan)
                    <tr>
                        <th class="align-middle" scope="row">{{ $loop->index + 1 }}</th>
                        <td class="align-middle fw-medium">{{ $kendaraan->plat_kendaraan }}</td>
                        <td class="align-middle">{{ $kendaraan->waktu_masuk->format('H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        // Live Clock 
        var clockElement = document.getElementById('clock');

        function clock() { 
            let now = new Date();
            let date = now.toLocaleDateString('id-ID', { weekday:"long", year:"numeric", month:"short", day:"numeric" });
            let time = ("0" + now.getHours()).substr(-2) + ":" + ("0" + now.getMinutes()).substr(-2) + ":" + ("0" + now.getSeconds()).substr(-2);

            clockElement.textContent = time + " - " + date;
        }
        setInterval(clock, 100);
    </script>
</div>
