<?php

namespace App\Http\Controllers\Parkiran;

use App\Models\Kendaraan;
use Livewire\Component;

class ParkirKeluarController extends Component
{
    public $search;
    public $active_kendaraan;

    public function render()
    {
        $kendaraan = Kendaraan::query()->where('status', 'Active')->orderBy('waktu_masuk', 'desc');
        $kendaraan->where('plat_kendaraan', 'like', '%' . $this->search . '%');

        $this->active_kendaraan = $kendaraan->get();

        return view('parkiran.keluar')
            ->extends('_layouts.base', ['page' => 'Parkir Keluar']);        
    }

    public function keluar($id)
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) 
        {
            $this->dispatchBrowserEvent('notify', 
            [ 'type' => 'failed', 'message' => 'Kendaraan Tidak Ditemukan']);
            return;
        }

        $waktu_parkir = $kendaraan->waktu_masuk->diffInHours(now());
        $biaya = ($waktu_parkir >= 1) ? $waktu_parkir * 2000.0 : 0.0;

        $kendaraan->update([
            'status' => 'Finished',
            'waktu_keluar' => now(),
            'biaya' => $biaya,
        ]);

        $this->resetValue();
        $this->emit('update_keluar');
        $this->dispatchBrowserEvent('notify', 
        [ 'type' => 'success', 'message' => 'Kendaraan Berhasil Dikeluarkan']);
    }

    private function resetValue()
    {
        $this->search = '';
    }
}
