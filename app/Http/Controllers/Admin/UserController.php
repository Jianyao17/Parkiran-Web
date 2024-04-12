<?php

namespace App\Http\Controllers\Admin;

use Livewire\Component;

class UserController extends Component
{
    public function render()
    {
        return view('admin.users')->with('page', 'Users');
    }
}
