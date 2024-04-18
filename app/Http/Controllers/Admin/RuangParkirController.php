<?php

namespace App\Http\Controllers\Admin;

use Livewire\Component;

class RuangParkirController extends Component
{
    public $nama_ruang, $kode_ruang, $kapasitas;

    public function render()
    {
        return view('admin.ruang-parkir')
            ->extends('_layouts.base-admin', ['page' => 'Ruang Parkir']);
    }

    public function store()
    {


        $this->dispatchBrowserEvent('notify', 
        [ 'type' => 'success', 'message' => 'Ruang Berhasil Ditambahkan']);

        $this->resetValue();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function update()
    {

        
        $this->dispatchBrowserEvent('notify', 
        [ 'type' => 'success', 'message' => 'Ruang Berhasil Diperbarui']);

        $this->resetValue();
        $this->dispatchBrowserEvent('close-modal');
    }

    private function resetValue()
    {
        $this->nama_ruang = '';
        $this->kode_ruang = '';
        $this->kapasitas = '';
    }
}
