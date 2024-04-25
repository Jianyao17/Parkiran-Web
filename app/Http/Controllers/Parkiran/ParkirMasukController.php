<?php

namespace App\Http\Controllers\Parkiran;

use App\Models\Kendaraan;
use App\Models\RuangParkir;
use Livewire\Component;

class ParkirMasukController extends Component
{
    public $plat_kendaraan;
    public $terakhir_ditambahkan, $ruang_tersisa;

    public function render()
    {
        $this->terakhir_ditambahkan = Kendaraan::latest('waktu_masuk')->where('status', 'Active')->take(10)->get();

        $kapasitas = RuangParkir::where('status', 'kosong')->count();
        $terpakai = RuangParkir::where('status', 'terisi')->count();
        $this->ruang_tersisa = ['kapasitas' => $kapasitas, 'terpakai' => $terpakai];

        return view('parkiran.masuk')
            ->extends('_layouts.base', ['page' => 'Parkir Masuk']);
    }

    public function store()
    {
        $this->validate(['plat_kendaraan' => 'required|unique:kendaraan,plat_kendaraan']);

        Kendaraan::insert([
            'plat_kendaraan' => $this->plat_kendaraan,
            'waktu_masuk' => now(),
            'status' => 'Active',
        ]);

        $this->resetValue();
        $this->emit('update_masuk');
        $this->dispatchBrowserEvent('notify', 
        [ 'type' => 'success', 'message' => 'Kendaraan Berhasil Ditambahkan']);
    }

    private function resetValue()
    {
        $this->plat_kendaraan = '';
    }
}
