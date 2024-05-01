<?php

namespace App\Http\Controllers\Parkiran;

use App\Events\OnKendaraanUpdate;
use App\Models\Kendaraan;
use App\Models\RuangParkir;
use Livewire\Component;
use Livewire\WithPagination;

class ParkirKeluarController extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';

    public $search;

    public function render()
    {
        $kendaraan = Kendaraan::query()->where('status', 'Active')->orderBy('waktu_masuk', 'desc');
        $kendaraan->where('plat_kendaraan', 'like', '%' . $this->search . '%');

        $active_kendaraan = $kendaraan->paginate(20);

        return view('parkiran.keluar', ['active_kendaraan' => $active_kendaraan])
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

        if ($kendaraan->ruang_parkir) 
        {
            RuangParkir::where('kode_ruang', $kendaraan->ruang_parkir)
                        ->update(['status' => 'kosong']);
        }

        $kendaraan->update([
            'status' => 'Finished',
            'waktu_keluar' => now(),
            'biaya' => $biaya,
        ]);
        
        $this->resetValue();
        $this->dispatchBrowserEvent('notify', 
        [ 'type' => 'success', 'message' => 'Kendaraan Berhasil Dikeluarkan']);
        
        OnKendaraanUpdate::dispatch();
    }

    private function resetValue()
    {
        $this->search = '';
    }
}
