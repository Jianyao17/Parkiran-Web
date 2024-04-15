<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Validation\Rule;
use Livewire\Component;

class UserController extends Component
{
    public $username, $password, $role;

    public $roles = ['Admin', 'Petugas-Masuk', 'Petugas-Ruang', 'Petugas-Keluar'];

    protected function rules() 
    {
        return [
            // 'username' => 'required|unique:users,username|min:3|max:255',
            'username' => 'required|min:3|max:255',
            'password' => 'required|min:8|max:255',
            'role' => [Rule::in($this->roles)]
        ];
    }

    public function render()
    {
        return view('admin.users')
            ->extends('_layouts.base-admin', ['page' => 'Users']);
    }

    public function store()
    {
        $this->validate(); 

        // create data
        $this->dispatchBrowserEvent('notify', 
        [ 'type' => 'success', 'message' => 'User Berhasil Ditambahkan']);

        $this->resetValue();
        $this->dispatchBrowserEvent('close-modal');
    }

    private function resetValue()
    {
        $this->username = '';
        $this->password = '';
        $this->role = '';
    }
}
