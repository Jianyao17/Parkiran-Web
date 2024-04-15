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
                <th class="align-middle"scope="row">1</th>
                <td class="align-middle">Mark</td>
                <td class="align-middle">Otto</td>
                <td class="align-middle">@mdo</td>
                <td class="align-middle">
                    <button class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit </button>
                    <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle">Jacob</td>
                <td class="align-middle">Thornton</td>
                <td class="align-middle">@fat</td>
                <td class="align-middle">
                    <button class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit </button>
                    <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">3</th>
                <td class="align-middle" colspan="2">Larry the Bird</td>
                <td class="align-middle">@twitter</td>
                <td class="align-middle">
                    <button class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit </button>
                    <button class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus </button>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Modal Window --}}
    <div wire:ignore.self class="modal" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <form wire:submit.prevent="store">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                name="username" id="username" value="{{ old('username') }}" wire:model="username" autofocus>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                name="password" id="password" wire:model="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">User Role </label>
                            <select class="form-select" name="role" id="role" wire:model="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" @if($loop->first) selected @endif>{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        window.addEventListener('close-modal', e => {
            $('#userModal').modal('hide');
        })
    </script>
</div>
