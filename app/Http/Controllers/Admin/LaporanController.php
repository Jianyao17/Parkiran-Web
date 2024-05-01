<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;
use Livewire\Component;
use Livewire\WithPagination;

class LaporanController extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';

    public $bulan = 'All', $search;

    public function render()
    {
        $laporan = Laporan::query();
        $laporan->where('tgl_laporan', 'like', '%' . $this->search . '%');

        if ($this->bulan != 'All') $laporan->whereMonth('tgl_laporan', $this->bulan);
        

        $list_laporan = $laporan->orderBy('tgl_laporan')->paginate(30);
        
        return view('admin.laporan', ['list_laporan' => $list_laporan])
            ->extends('_layouts.base-admin', ['page' => 'Laporan']);
    }

    public function report()
    {
        Laporan::GenerateReport();
    }
}
