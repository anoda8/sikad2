<?php

namespace App\Http\Livewire\Admin;

use App\Models\Guru;
use App\Models\KelasOnline;
use App\Models\Pengumuman;
use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $coba;
    public $judul;
    public $kelon_perpage = 10;

    public function mount()
    {
        $this->judul = "Beranda";
    }

    public function render()
    {
        $jumlah_siswa = Siswa::count();
        $jumlah_guru = Guru::count();
        $jumlah_kelon = KelasOnline::whereDate('wkt_masuk', date("Y-m-d"))->count();
        $kelon = KelasOnline::whereDate('wkt_masuk', date("Y-m-d"))->with(['kelas', 'mapel', 'author'])->paginate($this->kelon_perpage);
        $pengumuman = Pengumuman::where('tujuan', 'all')->with(['author', 'komentar'])->latest()->take(3)->get();

        return view('livewire.admin.dashboard', [
            'jumlah' => [
                'siswa' => $jumlah_siswa,
                'guru' => $jumlah_guru,
                'kelon' => $jumlah_kelon
            ],
            'data' => [
                'kelon' => $kelon,
                'pengumuman' => $pengumuman
            ]
        ]);
    }
}
