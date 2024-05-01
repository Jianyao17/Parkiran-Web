<?php

namespace App\Http\Controllers\Parkiran;

use App\Models\Kendaraan;
use App\Models\RuangParkir;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ParkirRuangController extends Component
{
    public $kendaraanMasuk, $kendaraanParkir;
    public $ruangParkir, $ruangGroup;


    public function mount() 
    {
        $this->updateRuang();
        $this->updateMasuk();
        $this->updateParkir();
    }

    public function render()
    {
        $this->UpdateView();
        $this->ruangGroup = RuangParkir::GetRuangGroup();

        return view('parkiran.set-ruang')
            ->extends('_layouts.base', ['page' => 'Parkir Ruang']);
    }

    public function UpdateView()
    {
        $key = 'UpdateKendaraan_' . auth()->user()->id;
        $event = Cache::get($key);

        if ($event) 
        {
            Cache::forget($key);

            $this->updateMasuk();
            $this->updateParkir();
        }
    }

    public function updateRuang()
    {
        // update list of ruang parkir di setiap lantai
        $this->ruangParkir = RuangParkir::GetRuangParkir();

        $this->emit('Update:RuangParkir');
    }

    public function updateMasuk() 
    {
        // update list of active kendaraan with none ruang parkir
        $this->kendaraanMasuk = Kendaraan::select('plat_kendaraan')
                                        ->where('status', 'Active')
                                        ->where('ruang_parkir', null)
                                        ->get()->toArray();
        
        $this->emit('Update:KendaraanMasuk');
    }

    public function updateParkir()
    {
        // update kendaraan aktif yang ada di ruang parkir
        $this->kendaraanParkir = Kendaraan::select('plat_kendaraan', 'ruang_parkir')
                                        ->where('status', 'Active')
                                        ->where('ruang_parkir', '!=', null)
                                        ->get()->toArray();

        $this->emit('Update:KendaraanParkir');
    }

    public function UpdateDatabase($data)
    {
        foreach ($data as $item) 
        {
            $kendaraan = Kendaraan::where('plat_kendaraan', $item['plat_kendaraan'])->get()->first();

            if ($kendaraan->ruang_parkir != null) 
            {
                RuangParkir::where('kode_ruang', $kendaraan->ruang_parkir)
                            ->update(['status' => 'kosong']);
            }
            
            Kendaraan::where('plat_kendaraan', $item['plat_kendaraan'])
                    ->update(['ruang_parkir' => $item['ruang_parkir']]);      
            
            RuangParkir::where('kode_ruang', $item['ruang_parkir'])
                        ->update(['status' => 'terisi']);
        }
    }
}
