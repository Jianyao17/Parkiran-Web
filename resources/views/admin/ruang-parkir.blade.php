@extends('_layouts.base-admin')

@section('content')
    <div class="m-3 my-4">
        <h2 class="text-start">Ruang Parkir</h2>
        <p>Tambah, Edit, & Hapus Ruang Parkir</p>

        <div class="d-flex justify-content-start py-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ruangParkirModal">
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
                    <th scope="row">1</th>
                    <td>Lantai-1</td>
                    <td>A1 - A12</td>
                    <td>12</td>
                    <td>
                        <button class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit </button>
                        <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Lantai-2</td>
                    <td>B1 - B12</td>
                    <td>12</td>
                    <td>
                        <button class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit </button>
                        <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Lantai-3</td>
                    <td>C1 - C12</td>
                    <td>12</td>
                    <td>
                        <button class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit </button>
                        <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Modal Window --}}
        <div class="modal" id="ruangParkirModal" tabindex="-1" aria-labelledby="ruangParkirModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Ruang</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="namaRuang" class="form-label">Nama Ruang</label>
                                <input type="text" id="namaRuang" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="inputGroup" class="form-label">Masukan Kapasitas & Kode Ruang</label>
                                <div class="input-group flex-nowrap" id="inputGroup">
                                    <span class="input-group-text">Kapasitas</span>
                                    <input type="number" id="kapasitas" class="form-control">
                                    <span class="input-group-text">Kode Ruang</span>
                                    <input type="text" id="kodeRuang" class="form-control" placeholder="e.g A">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="outputField" class="form-label">Kode ruang yang dihasilkan :</label>
                                <div class="form-control bg-body-tertiary" id="outputField">
                                    A1, A2, A3, A4, A5, A6, A7
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
