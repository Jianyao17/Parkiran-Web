<?php

namespace App\Http\Controllers\Parkiran;

use Livewire\Component;

class ParkirRuangController extends Component
{
    public $jumlahMasuk = 12;

    public function mount()
    {
        $this->jumlahMasuk = 40;
    }

    public function render()
    {
        return view('parkiran.set-ruang')
            ->extends('_layouts.base', ['page' => 'Parkir Ruang']);
    }
}
