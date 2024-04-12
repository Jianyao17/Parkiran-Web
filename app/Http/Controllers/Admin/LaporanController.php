<?php

namespace App\Http\Controllers\Admin;

use Livewire\Component;

class LaporanController extends Component
{
    public function render()
    {
        return view('admin.laporan')->with('page', 'Laporan');
    }
}
