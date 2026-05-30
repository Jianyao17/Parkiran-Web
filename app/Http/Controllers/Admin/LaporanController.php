<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class LaporanController extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';

    public $bulan = 'All', $orderBy = 'tgl_laporan', $search;

    private function laporanQuery()
    {
        $laporan = Laporan::query();
        $laporan->where('tgl_laporan', 'like', '%' . $this->search . '%');

        if ($this->bulan != 'All') $laporan->whereMonth('tgl_laporan', $this->bulan);

        return $laporan;
    }

    public function render()
    {
        $list_laporan = $this->laporanQuery()
                                ->orderBy($this->orderBy, $this->orderBy == 'tgl_laporan' ? 'asc' : 'desc')
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

    public function downloadLaporan()
    {
        $laporan = $this->laporanQuery()
                        ->orderBy($this->orderBy, $this->orderBy == 'tgl_laporan' ? 'asc' : 'desc')
                        ->get();

        $fileName = 'laporan-' . now()->format('Y-m-d_His') . '.csv';

        return response()->streamDownload(function () use ($laporan) {
            $output = fopen('php://output', 'w');

            fputcsv($output, ['Tanggal Laporan', 'Jumlah Kendaraan', 'Pendapatan (Rp)']);

            foreach ($laporan as $item) {
                fputcsv($output, [
                    optional($item->tgl_laporan)->format('d-m-Y'),
                    $item->jumlah_kendaraan,
                    $item->pendapatan_rp,
                ]);
            }

            fclose($output);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function downloadPdfLaporan(Request $request)
    {
        $bulan = $request->query('bulan', 'All');
        $orderBy = $request->query('orderBy', 'tgl_laporan');
        $search = $request->query('search', '');

        $laporan = Laporan::query()
            ->where('tgl_laporan', 'like', "%$search%")
            ->when($bulan !== 'All', function($q) use ($bulan) {
                $q->whereMonth('tgl_laporan', $bulan);
            })
            ->orderBy($orderBy, $orderBy == 'tgl_laporan' ? 'asc' : 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.laporan_pdf', ['laporan' => $laporan]);
        $fileName = 'laporan-' . now()->format('Y-m-d_His') . '.pdf';
        return $pdf->download($fileName);
    }
}
