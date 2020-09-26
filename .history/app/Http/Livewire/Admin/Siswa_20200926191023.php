<?php

namespace App\Http\Livewire\Admin;

use App\Models\Siswa as ModelsSiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Siswa extends Component
{
    public $user_id, $kelas_id, $nama, $nis, $jenkel, $tgl_lahir;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Data Siswa",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        return view('livewire.admin.siswa', [
            'siswas' => ModelsSiswa::all()
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'nis'=> 'required',
            'jenkel' => 'required',
            'tgl_lahir' => 'required'
        ]);

        $user = User::createOrUpdate([
            'email' => $this->nis
        ],[
            'nama' => $this->nama,
            'email' => $this->nis,
            'password' => Hash::make($this->nis)
        ]);

        ModelsSiswa::createOrUpdate([
            'nis' => $this->nis
        ], [
            'nama' => $this->nama,
            'nis' => $this->nis,
            'jenkel' => $this->jenkel,
            'tgl_lahir' => $this->tgl_lahir,
            'user_id' => $user->id,
            'kelas_id' => null
        ]);


    }
}
