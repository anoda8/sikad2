<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Jurusan extends Component
{
    public $nama, $singkat, $tingkat;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Jurusan / Tingkat",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        return view('livewire.admin.jurusan');
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'singkat' => 'required',
            'tingkat' => 'required'
        ]);


    }
}
