<?php

namespace App\Http\Controllers\Parkiran;

use Livewire\Component;

class ParkirKeluarController extends Component
{
    public function render()
    {
        return view('parkiran.keluar')
            ->extends('_layouts.base', ['page' => 'Parkir Keluar']);        
    }
}
