<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;
use Livewire\Component;
use Livewire\WithPagination;

class LaporanController extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';

    public $bulan = 'All', $orderBy = 'tgl_laporan', $search;

    public function render()
    {
        $laporan = Laporan::query();
        $laporan->where('tgl_laporan', 'like', '%' . $this->search . '%');

        if ($this->bulan != 'All') $laporan->whereMonth('tgl_laporan', $this->bulan);
        

        $list_laporan = $laporan->orderBy($this->orderBy, $this->orderBy == 'tgl_laporan' ? 'asc' : 'desc')
                                ->paginate(30);
        
        return view('admin.laporan', ['list_laporan' => $list_laporan])
            ->extends('_layouts.base-admin', ['page' => 'Laporan']);
    }

    public function report()
    {
        $result = Laporan::GenerateReport();

        if (!$result) 
        {
            $this->dispatchBrowserEvent('notify', 
                [ 'type' => 'failed', 'message' => 'Laporan Gagal Dibuat']);  
        } 
        else 
        {
            $this->dispatchBrowserEvent('notify', 
            [ 'type' => 'success', 'message' => 'Laporan Berhasil Dibuat']);
        }
    }
}
