<div class="m-3 my-4">
    <h2 class="text-start">Ruang Parkir</h2>
    <p>Tambah, Edit, & Hapus Ruang Parkir</p>

    <div class="d-flex justify-content-start py-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahRuangModal">
            <i class="bi bi-plus-square me-1"></i> Tambah Ruang </button>
    </div>

    {{-- Ruang Parkir Table --}}
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Ruang</th>
                <th scope="col">Range Kode</th>
                <th scope="col">Kapasitas</th>
                <th scope="col">Last Update</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($ruang_parkir as $ruangan)
                <tr>
                    <th class="align-middle" scope="row">{{ $loop->index + 1 }}</th>
                    <td class="align-middle">{{ $ruangan['nama_ruang'] }}</td>
                    <td class="align-middle">
                        {{ $ruangan['kode_ruang'] . '1' }} - {{ $ruangan['kode_ruang'] . $ruangan['kapasitas'] }}
                    </td>
                    <td class="align-middle">{{ $ruangan['kapasitas'] }}</td>
                    <td class="align-middle">{{ $ruangan['updated_at'] }}</td>
                    <td class="align-middle">
                        <button class="btn btn-primary" wire:click="editRuang('{{$ruangan['nama_ruang']}}')"
                            data-bs-toggle="modal" data-bs-target="#editRuangModal">
                            <i class="bi bi-pencil-square me-1"></i> Edit </button>
                        <button class="btn btn-danger" wire:click="deleteRuang('{{$ruangan['nama_ruang']}}')"
                            data-bs-toggle="modal" data-bs-target="#deleteRuangModal">
                            <i class="bi bi-trash3 me-1"></i> Hapus </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Tambah Modal Window --}}
    <div wire:ignore.self class="modal" id="tambahRuangModal" tabindex="-1" aria-labelledby="tambahRuangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <form wire:submit.prevent="store">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Ruang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Ruang</label>
                            <input wire:model="nama_ruang"
                                class="form-control @error('nama_ruang') is-invalid @enderror" type="text"
                                value="{{ old('nama_ruang') }}" name="nama_ruang" autofocus>
                            @error('nama_ruang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputGroup" class="form-label">Masukan Kapasitas & Kode Ruang</label>
                            <div class="input-group has-validation" id="inputGroup">
                                <span class="input-group-text">Kode Ruang</span>
                                <input class="form-control  @error('kode_ruang') is-invalid @enderror"
                                    wire:model="kode_ruang" id="kode1" name="kode" value="{{ old('kode') }}"
                                    type="text" placeholder="e.g A">
                                <span class="input-group-text">Kapasitas</span>
                                <input class="form-control  @error('kapasitas') is-invalid @enderror"
                                    wire:model="kapasitas" id="kapasitas1" name="kapasitas"
                                    value="{{ old('kapasitas') }}" type="number">
                                <div class="mb-3 invalid-feedback position-relative">
                                    @error('kode_ruang')
                                        <div class="position-absolute start-0">{{ $message }}</div>
                                    @enderror
                                    @error('kapasitas')
                                        <div class="position-absolute end-0">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="outputField1" class="form-label">Kode ruang yang dihasilkan :</label>
                            <textarea class="form-control bg-body-tertiary @error('fails') is-invalid @enderror" id="outputField1"
                                placeholder="none" style="min-height: 90px" disabled>
                                {{-- A1, A2, A3, A4, A5, A6, A7 --}}
                            </textarea>
                            @error('fails')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Ruang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal Window --}}
    <div wire:ignore.self class="modal" id="editRuangModal" tabindex="-1" aria-labelledby="editRuangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <form wire:submit.prevent="update">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Ruang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Ruang</label>
                            <input wire:model="nama_ruang"
                                class="form-control @error('nama_ruang') is-invalid @enderror" type="text"
                                value="{{ old('nama_ruang') }}" name="nama_ruang" autofocus>
                            @error('nama_ruang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputGroup" class="form-label">Masukan Kapasitas & Kode Ruang</label>
                            <div class="input-group has-validation" id="inputGroup">
                                <span class="input-group-text">Kode Ruang</span>
                                <input class="form-control  @error('kode_ruang') is-invalid @enderror"
                                    wire:model="kode_ruang" id="kode1" name="kode"
                                    value="{{ old('kode') }}" type="text" placeholder="e.g A">
                                <span class="input-group-text">Kapasitas</span>
                                <input class="form-control  @error('kapasitas') is-invalid @enderror"
                                    wire:model="kapasitas" id="kapasitas1" name="kapasitas"
                                    value="{{ old('kapasitas') }}" type="number">
                                <div class="mb-3 invalid-feedback position-relative">
                                    @error('kode_ruang')
                                        <div class="position-absolute start-0">{{ $message }}</div>
                                    @enderror
                                    @error('kapasitas')
                                        <div class="position-absolute end-0">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="outputField1" class="form-label">Kode ruang yang dihasilkan :</label>
                            <textarea class="form-control bg-body-tertiary @error('fails') is-invalid @enderror" id="outputField2"
                                placeholder="none" style="min-height: 90px" disabled>
                                {{-- A1, A2, A3, A4, A5, A6, A7 --}}
                            </textarea>
                            @error('fails')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Modal Window --}}
    <div wire:ignore.self class="modal" id="deleteRuangModal" tabindex="-1"
        aria-labelledby="deleteRuangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Ruang Parkir</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Apakah anda yakin ingin menghapus {{ $nama_ruang ?? 'Ruang' }}?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">
                        <i class="bi bi-trash3 me-1"></i> Hapus Ruang </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const input_kode = document.getElementsByName("kode");
        const input_kapasitas = document.getElementsByName("kapasitas");

        const display1 = document.querySelector("#outputField1");
        const display2 = document.querySelector("#outputField2");

        input_kode.forEach(kode => {
            input_kapasitas.forEach(kapasitas => {
                kode.addEventListener("change", () => {
                    GenerateRuangParkir(kapasitas.value, kode.value);
                });
                kapasitas.addEventListener("change", () => {
                    GenerateRuangParkir(kapasitas.value, kode.value);
                });
            });
        });

        function GenerateRuangParkir(kapasitas, kodeRuang) {
            let ruang_parkir = [];
            let n = kapasitas;

            for (let i = 0; i < n; i++) {
                ruang_parkir.push(kodeRuang + (i + 1));
            }

            display1.value = ruang_parkir.join(', ');
            display2.value = ruang_parkir.join(', ');

            return ruang_parkir;
        }

        window.addEventListener('close-modal', e => {
            $('.modal').modal('hide');
        });

        document.addEventListener('livewire:load', () => {
            const livewire = @this;
            const updateModal = document.getElementById("editRuangModal");

            updateModal.addEventListener('hidden.bs.modal', () => {
                livewire.resetValue();
            });
        });
    </script>
</div>
