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
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <th class="align-middle" scope="row">1</th>
                <td class="align-middle">Lantai-1</td>
                <td class="align-middle">A1 - A12</td>
                <td class="align-middle">12</td>
                <td class="align-middle">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRuangModal">
                        <i class="bi bi-pencil-square me-1"></i> Edit </button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRuangModal"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle">Lantai-2</td>
                <td class="align-middle">B1 - B12</td>
                <td class="align-middle">12</td>
                <td class="align-middle">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRuangModal"><i
                            class="bi bi-pencil-square me-1"></i> Edit </button>
                    <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">3</th>
                <td class="align-middle">Lantai-3</td>
                <td class="align-middle">C1 - C12</td>
                <td class="align-middle">12</td>
                <td class="align-middle">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRuangModal"><i
                            class="bi bi-pencil-square me-1"></i> Edit </button>
                    <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">3</th>
                <td class="align-middle">Lantai-3</td>
                <td class="align-middle">C1 - C12</td>
                <td class="align-middle">12</td>
                <td class="align-middle">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRuangModal"><i
                            class="bi bi-pencil-square me-1"></i> Edit </button>
                    <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">3</th>
                <td class="align-middle">Lantai-3</td>
                <td class="align-middle">C1 - C12</td>
                <td class="align-middle">12</td>
                <td class="align-middle">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRuangModal"><i
                            class="bi bi-pencil-square me-1"></i> Edit </button>
                    <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">3</th>
                <td class="align-middle">Lantai-3</td>
                <td class="align-middle">C1 - C12</td>
                <td class="align-middle">12</td>
                <td class="align-middle">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRuangModal"><i
                            class="bi bi-pencil-square me-1"></i> Edit </button>
                    <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">3</th>
                <td class="align-middle">Lantai-3</td>
                <td class="align-middle">C1 - C12</td>
                <td class="align-middle">12</td>
                <td class="align-middle">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRuangModal"><i
                            class="bi bi-pencil-square me-1"></i> Edit </button>
                    <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">3</th>
                <td class="align-middle">Lantai-3</td>
                <td class="align-middle">C1 - C12</td>
                <td class="align-middle">12</td>
                <td class="align-middle">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRuangModal"><i
                            class="bi bi-pencil-square me-1"></i> Edit </button>
                    <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                </td>
            </tr>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Ruang</label>
                            <input wire:model="nama_ruang" class="form-control @error('nama_ruang') is-invalid @enderror"
                                type="text" value="{{ old('nama_ruang') }}" id="nama_ruang" autofocus>
                            @error('nama_ruang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Masukan Kapasitas & Kode Ruang</label>
                            <div class="input-group flex-nowrap" id="inputGroup">
                                <span class="input-group-text">Kode Ruang</span>
                                <input class="form-control" id="kode" name="kode" value="{{ old('kode') }}" type="text" placeholder="e.g A">
                                <span class="input-group-text">Kapasitas</span>
                                <input class="form-control" id="kapasitas" name="kapasitas" value="{{ old('kapasitas') }}" type="number">
                            </div>
                            @error('kode_ruang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode ruang yang dihasilkan :</label>
                            <textarea class="form-control bg-body-tertiary" id="outputField" placeholder="none" disabled>
                                {{-- A1, A2, A3, A4, A5, A6, A7 --}}
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal Window --}}
    <div class="modal" id="editRuangModal" tabindex="-1" aria-labelledby="editRuangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <form  wire:submit.prevent="update">
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
                            <input wire:model="nama_ruang" class="form-control @error('nama_ruang') is-invalid @enderror"
                                type="text" value="{{ old('nama_ruang') }}" id="nama_ruang" autofocus>
                            @error('nama_ruang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Masukan Kapasitas & Kode Ruang</label>
                            <div class="input-group flex-nowrap" id="inputGroup">
                                <span class="input-group-text">Kode Ruang</span>
                                <input class="form-control" id="kode" name="kode" value="{{ old('kode') }}" type="text" placeholder="e.g A">
                                <span class="input-group-text">Kapasitas</span>
                                <input class="form-control" id="kapasitas" name="kapasitas" value="{{ old('kapasitas') }}" type="number">
                            </div>
                            @error('kode_ruang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode ruang yang dihasilkan :</label>
                            <textarea class="form-control bg-body-tertiary" id="outputField" placeholder="none" disabled>
                                {{-- A1, A2, A3, A4, A5, A6, A7 --}}
                            </textarea>
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
    <div wire:ignore.self class="modal" id="deleteRuangModal" tabindex="-1" aria-labelledby="deleteRuangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Ruang Parkir</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Apakah anda yakin ingin menghapus Ruang?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">
                        <i class="bi bi-trash3 me-1"></i> Hapus </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const kapasitas_ruang = document.querySelector("#kapasitas");
        const kode_ruang = document.querySelector("#kode");
        const display = document.querySelector("#outputField");

        kapasitas_ruang.addEventListener("change", GenerateRuangParkir);
        kode_ruang.addEventListener("change", GenerateRuangParkir);

        function GenerateRuangParkir()
        {
            let ruang_parkir = [];
            let n = kapasitas_ruang.value;

            for (let i = 0; i < n; i++) {
                ruang_parkir.push(kode_ruang.value + i);
            }

            display.value = ruang_parkir;
        }

        window.addEventListener('close-modal', e => {
            $('.modal').modal('hide');
        })
    </script>
</div>
