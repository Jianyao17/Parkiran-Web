<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Kendaraan;
use Livewire\Component;
use Livewire\WithPagination;

class ParkirViewController extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';

    public $waktu, $status, $search;


    public function mount()
    {
        $this->waktu = 'Semua';
        $this->status = 'All';
    }

    public function render()
    {
        $kendaraan = Kendaraan::query();
        $kendaraan->where('plat_kendaraan', 'like', '%' . $this->search . '%');

        if ($this->status != 'All') $kendaraan->where('status', $this->status);
        
        switch ($this->waktu) 
        {
            case 'Hari Ini' : 
                $kendaraan->whereDate('waktu_masuk', Carbon::today());
                break;
            case 'Kemarin' : 
                $kendaraan->whereDate('waktu_masuk', Carbon::yesterday());
                break;
            case 'Minggu Ini' : 
                $kendaraan->whereBetween('waktu_masuk', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'Bulan Ini' :
                $kendaraan->whereBetween('waktu_masuk', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
                break;
            case 'Tahun Ini' :
                $kendaraan->whereBetween('waktu_masuk', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()]);
                break;
        }
        
        $list_kendaraan = $kendaraan->orderBy('status')->orderBy('waktu_masuk', 'desc')->paginate(30);

        return view('admin.parkir-view', ['list_kendaraan' => $list_kendaraan])
            ->extends('_layouts.base-admin', ['page' => 'Parkiran']);
    }
}
