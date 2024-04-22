<?php

namespace App\Http\Controllers\Admin;

use App\Models\RuangParkir;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class RuangParkirController extends Component
{
    public $nama_ruang, $kode_ruang, $kapasitas, $target_ruang;
    public $ruang_parkir;

    public function render()
    {
        $this->ruang_parkir = RuangParkir::GetRuang();
                
        return view('admin.ruang-parkir')
            ->extends('_layouts.base-admin', ['page' => 'Ruang Parkir']);
    }

    public function store()
    {
        // Validate Ruang Parkir Attribute
        $this->validate([
            'nama_ruang' => 'min:4|max:255|unique:ruang_parkir,nama_ruang',
            'kode_ruang' => 'required|string|min:1|max:255',
            'kapasitas' => 'required|gt:0'
        ]);

        // Store Ruang Record to database
        $Failed = RuangParkir::StoreRuang($this->nama_ruang, $this->kode_ruang, $this->kapasitas);

        // Check if validation fails
        if ($Failed) 
        {
            $this->dispatchBrowserEvent('notify',
                ['type' => 'failed', 'message' => 'Ruang Gagal Ditambahkan']);
            // Return with errors
            return $this->addError('fails', 'List Kode Ruang has already been taken.');
        }

        $this->dispatchBrowserEvent('notify',
            ['type' => 'success', 'message' => 'Ruang Berhasil Ditambahkan']);

        $this->resetValue();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editRuang($nama)
    {
        $ruang = RuangParkir::where('nama_ruang', $nama)->get();
        $kode_ruang = $ruang->first()->kode_ruang[0];
        $kapasitas = $ruang->count();

        if (!$ruang) 
        {
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('notify', 
            [ 'type' => 'failed', 'message' => 'Ruang Tidak Ditemukan']);  
            return;
        } 

        $this->target_ruang = $nama;
        $this->nama_ruang = $nama;
        $this->kode_ruang = $kode_ruang;
        $this->kapasitas = $kapasitas;
    }

    public function update()
    {
        // Validate Ruang Parkir Attribute
        $this->validate([
            'nama_ruang' => 
            ['min:4', 'max:255', Rule::unique('ruang_parkir', 'nama_ruang')->ignore($this->target_ruang, 'nama_ruang')],
            'kode_ruang' => 'required|string|min:1|max:255',
            'kapasitas' => 'required|gt:0'
        ]);

        $Failed = RuangParkir::UpdateRuang($this->target_ruang, $this->nama_ruang, $this->kode_ruang, $this->kapasitas);

        // Check if validation fails
        if ($Failed) 
        {
            $this->dispatchBrowserEvent('notify',
                ['type' => 'failed', 'message' => 'Ruang Gagal Ditambahkan']);
            // Return with errors
            return $this->addError('fails', 'List Kode Ruang has already been taken.');
        }

        $this->dispatchBrowserEvent('notify',
            ['type' => 'success', 'message' => 'Ruang Berhasil Diperbarui']);

        $this->resetValue();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteRuang($nama) 
    {
        // Check Ruang if exist
        $ruang = RuangParkir::where('nama_ruang', $nama)->exists();
        
        if (!$ruang) 
        {
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('notify', 
            [ 'type' => 'failed', 'message' => 'Ruang Tidak Ditemukan']);  
            return;
        } 
        $this->nama_ruang = $nama;
    }
    
    public function delete()
    {
        // Delete muliple records of ruang parkir
        RuangParkir::DeleteRuang($this->nama_ruang);

        $this->dispatchBrowserEvent('notify', 
        [ 'type' => 'success', 'message' => 'User Berhasil Dihapus']);

        $this->resetValue();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function resetValue()
    {
        $this->target_ruang = '';
        $this->nama_ruang = '';
        $this->kode_ruang = '';
        $this->kapasitas = '';
    }
}
