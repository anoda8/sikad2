<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tugas as ModelsTugas;
use Livewire\Component;

class Tugas extends Component
{
    public $perpage;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Monitoring Tugas",
            'keterangan' => ""
        ];
    }

    public function mount()
    {
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $tugase = ModelsTugas::with(['mapel', 'kelas', 'author', 'respon'])->latest();
        return view('livewire.admin.tugas', [
            'tugase' => $tugase
        ]);
    }
}
