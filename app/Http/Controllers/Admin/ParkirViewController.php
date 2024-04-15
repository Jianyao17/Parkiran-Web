<?php

namespace App\Http\Controllers\Admin;

use Livewire\Component;

class ParkirViewController extends Component
{
    public function render()
    {
        return view('admin.parkir-view')
            ->extends('_layouts.base-admin', ['page' => 'Parkiran']);
    }
}
