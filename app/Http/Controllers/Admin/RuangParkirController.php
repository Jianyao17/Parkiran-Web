<?php

namespace App\Http\Controllers\Admin;

use Livewire\Component;

class RuangParkirController extends Component
{
    public function render()
    {
        return view('admin.ruang-parkir')->with('page', 'Ruang Parkir');
    }
}
