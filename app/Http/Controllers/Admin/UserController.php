<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserController extends Component
{
    public $username, $password, $role, $no_telp, $user_id;
    public $users;

    public $roles = ['Admin', 'Petugas-Masuk', 'Petugas-Ruang', 'Petugas-Keluar'];


    public function render()
    {
        $this->users = User::all();

        return view('admin.users')
            ->extends('_layouts.base-admin', ['page' => 'Users']);
    }

    public function store()
    {
        // Validate data to be created
        $this->validate([ 
            'username' => 'required|unique:users,name|min:4|max:255',
            'password' => 'required|string|min:8|max:255',
            'role' => ['required', Rule::in($this->roles)],
            'no_telp' => 'required|numeric'
        ]); 

        // Create data in database
        User::create([
            'name' => $this->username,
            'password' => Hash::make($this->password),
            'no_telp' => $this->no_telp,
            'role' => $this->role,
        ]);

        $this->dispatchBrowserEvent('notify', 
        [ 'type' => 'success', 'message' => 'User Berhasil Ditambahkan']);

        $this->resetValue();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editUser($id) 
    {
        $user = User::find($id);

        if (!$user) 
        {
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('notify', 
            [ 'type' => 'failed', 'message' => 'User Tidak Ditemukan']);  
            return;
        }
        
        $this->user_id = $id; 
        $this->username = $user->name;
        $this->role = $user->role;
        $this->no_telp = $user->no_telp;
    }

    public function update() 
    {
        // Validate data to be updated
        $this->validate([ 
            'username' => 'required|min:4|max:255|unique:users,name,'.$this->user_id,
            'password' => 'required|min:8|max:255',
            'role' => ['required', Rule::in($this->roles)],
            'no_telp' => 'required|numeric'
        ]);
        
        // Update data in database
        User::find($this->user_id)->update([
            'name' => $this->username,
            'password' => Hash::make($this->password),
            'no_telp' => $this->no_telp,
            'role' => $this->role,
        ]);

        $this->dispatchBrowserEvent('notify', 
        [ 'type' => 'success', 'message' => 'User Berhasil Diperbarui']);

        $this->resetValue();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) 
        {
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('notify', 
            [ 'type' => 'failed', 'message' => 'User Tidak Ditemukan']);  
            return;
        }

        $this->user_id = $id;
        $this->username = $user->name;
    }

    public function delete()
    {
        User::find($this->user_id)->delete();

        $this->dispatchBrowserEvent('notify', 
        [ 'type' => 'success', 'message' => 'User Berhasil Dihapus']);

        $this->resetValue();
        $this->dispatchBrowserEvent('close-modal');
    }
    

    public function resetValue()
    {
        $this->username = '';
        $this->password = '';
        $this->no_telp = '';
        $this->role = '';
    }
}
