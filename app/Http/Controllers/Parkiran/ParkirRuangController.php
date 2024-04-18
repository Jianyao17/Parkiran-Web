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

    public function updateMasuk() 
    {
        // update list of active kendaraan with none ruang parkir
    }

    public function updateRuang()
    {
        // update list of ruang parkir di setiap lantai
        // update kendaraan aktif yang ada di ruang parkir   
    }
}
