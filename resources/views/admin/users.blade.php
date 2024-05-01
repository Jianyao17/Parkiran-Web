<div class="m-3 my-4">
    <h2 class="text-start">User Parkiran Web</h2>
    <p>Tambah, Edit, & Hapus User</p>
    <div class="d-flex justify-content-start py-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
            <i class="bi bi-person-add me-1"></i> Tambah User </button>
    </div>

    {{-- Users Table --}}
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">No Telp</th>
                <th scope="col">Date Created</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($users as $user)
                <tr>
                    <th class="align-middle" scope="row">{{ $loop->index + 1 }}</th>
                    <td class="align-middle fw-normal">{{ $user->username }}</td>
                    <td class="align-middle fst-italic">{{ $user->role }}</td>
                    <td class="align-middle">{{ $user->no_telp }}</td>
                    <td class="align-middle">
                        {{ $user->created_at->format('H:i') }} | 
                        @if ($user->created_at->isToday())
                            Hari Ini
                        @elseif ($user->created_at->isYesterday())
                            Kemarin
                        @else
                            {{ $user->created_at->format('d-M-Y') }}
                        @endif
                    </td>
                    <td class="align-middle">
                        <button class="btn btn-primary" wire:click="editUser({{ $user->id }})"
                            data-bs-target="#editUserModal" data-bs-toggle="modal">
                            <i class="bi bi-pencil-square me-1"></i> Edit </button>
                        <button class="btn btn-danger" wire:click="deleteUser({{ $user->id }})"
                            data-bs-target="#deleteUserModal" data-bs-toggle="modal">
                            <i class="bi bi-trash3 me-1"></i> Hapus </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Create Modal Window --}}
    <div wire:ignore.self class="modal" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel"
        aria-hidden="true">
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
                                name="username" value="{{ old('username') }}" wire:model="username"
                                autofocus>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" wire:model="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telp</label>
                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror"
                                name="no_telp" wire:model="no_telp">
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">User Role </label>
                            <select class="form-select" name="role" wire:model="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}"
                                        @if ($loop->first) selected @endif>{{ $role }}</option>
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

    {{-- Edit Modal Window --}}
    <div wire:ignore.self class="modal" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <form wire:submit.prevent="update">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close" wire:click="resetValue"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}" wire:model="username"
                                autofocus>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" wire:model="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telp</label>
                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror"
                                name="no_telp" id="no_telp" wire:model="no_telp">
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">User Role </label>
                            <select class="form-select" name="role" wire:model="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}"
                                        @if ($loop->first) selected @endif>{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="resetValue" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Modal Window --}}
    <div wire:ignore.self class="modal" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Apakah anda yakin ingin menghapus {{ $username ?? 'User' }}?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">
                        <i class="bi bi-trash3 me-1"></i> Hapus User </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('close-modal', e => {
            $('.modal').modal('hide');
        })

        document.addEventListener('livewire:load', () => {
            const livewire = @this;
            const updateModal = document.getElementById("editUserModal");

            updateModal.addEventListener('hidden.bs.modal', () => {
                livewire.resetValue();
            });
        });
    </script>
</div>
