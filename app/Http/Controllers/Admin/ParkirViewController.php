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

    protected $listeners = [ 'update_masuk' => 'render', 'update_keluar' => 'render' ];


    public function mount()
    {
        $this->waktu = 'Semua';
        $this->status = 'All';
    }

    public function render()
    {
        $kendaraan = Kendaraan::query();
        $kendaraan->where('plat_kendaraan', 'like', '%' . $this->search . '%');

        switch ($this->waktu) 
        {
            case 'Hari Ini' : 
                $kendaraan->whereDate('waktu_masuk', Carbon::today());
                break;
            case 'Kemarin' : 
                $kendaraan->whereDate('waktu_masuk', Carbon::yesterday());
                break;
            case 'Minggu Ini' : 
                $kendaraan->whereDate('waktu_masuk', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'Bulan Ini' :
                $kendaraan->whereDate('waktu_masuk', [Carbon::now()->startOfMonth(), Carbon::now()]);
                break;
            case 'Tahun Ini' :
                $kendaraan->whereDate('waktu_masuk', [Carbon::now()->startOfYear(), Carbon::now()]);
                break;
        }

        if ($this->status != 'All') 
            $kendaraan->where('status', $this->status);
        
        $list_kendaraan = $kendaraan->orderBy('waktu_masuk', 'desc')->paginate(30);

        return view('admin.parkir-view', ['list_kendaraan' => $list_kendaraan])
            ->extends('_layouts.base-admin', ['page' => 'Parkiran']);
    }
}
