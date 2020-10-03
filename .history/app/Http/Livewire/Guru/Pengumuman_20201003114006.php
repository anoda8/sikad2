<?php

namespace App\Http\Livewire\Guru;

use App\Models\Jurusan;
use App\Models\Kelas;
use Livewire\Component;

class Pengumuman extends Component
{
    public $jurusanid = null, $kelasid = null, $tujuan = null, $judul, $isipengumuman, $tanggal, $waktu;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Pengumuman",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $kelases    = Kelas::where('thajaran', session('thajaran'))->get();
        $jurusans   = Jurusan::where('thajaran', session('thajaran'))->get();
        return view('livewire.guru.pengumuman',[
            'kelases' => $kelases, 'jurusans' => $jurusans
        ]);
    }

    public function setTujuan($tujuan)
    {
        $this->jurusanid = '';
        $this->kelasid = '';
        $this->tujuan = $tujuan;
    }

    public function setJurusan($jurusan)
    {
        $this->kelasid = '';
        $this->tujuan = '';
        $this->jurusanid = $jurusan;
    }

    public function setKelas($kelas)
    {
        $this->jurusanid = '';
        $this->tujuan = '';
        $this->kelasid = $kelas;
    }

    public function simpan()
    {
        $this->validate([
            'judul' => 'required',
            'isipengumuman' => 'required'
        ]);


    }
}
