@extends('_layouts.base-admin')

@section('content')
    <div class="m-3 my-4">
        <h2 class="text-start">User Parkiran Web</h2>
        <p>Tambah, Edit, & Hapus User</p>
        <div class="d-flex justify-content-start py-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                <i class="bi bi-person-add me-1"></i> Tambah User </button>
        </div>

        {{-- Users Table --}}
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>
                        <button class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit </button>
                        <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>
                        <button class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit </button>
                        <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                    <td>
                        <button class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit </button>
                        <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Modal Window --}}
        <div class="modal" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            <div class="mb-3">
                                <label for="userRole" class="form-label">User Role </label>
                                <select class="form-select" id="userRole">
                                    <option value="petugas-masuk">Petugas Masuk</option>
                                    <option value="petugas-keluar">Petugas Keluar</option>
                                    <option value="petugas-ruang">Petugas Ruang</option>
                                    <option value="admin">Admin</option>
                                </select>
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
