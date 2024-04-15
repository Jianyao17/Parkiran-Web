<?php

namespace App\Http\Controllers\Parkiran;

use Livewire\Component;

class ParkirMasukController extends Component
{
    public function render()
    {
        return view('parkiran.masuk')
            ->extends('_layouts.base', ['page' => 'Parkir Masuk']);
    }
}
