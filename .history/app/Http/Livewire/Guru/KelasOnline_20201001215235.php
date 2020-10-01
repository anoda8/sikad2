<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasOnline as ModelsKelasOnline;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class KelasOnline extends Component
{
    public $mapelid, $kelasid, $materi, $isimateri, $wktmulai, $wktselesai, $tgl_kelon, $videopath;
    public $guruid;
    public $formopen = false;
    public $dokumen;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Kelas Online",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
        $this->guruid = Guru::where('user_id', Auth::id())->get()->first()->id;
    }

    public function render()
    {
        $mapel = Mapel::where('thajaran', session('thajaran'))->where('guru_id', $this->guruid)->with(['guru'])->get();
        $pembl = Pembelajaran::where('thajaran', session('thajaran'))->where('mapel_id', $this->mapelid)->with(['kelas'])->get();
        return view('livewire.guru.kelas-online',[
            'mapels' => $mapel, 'pembelajaran' => $pembl
        ]);
    }

    public function formToggle()
    {
        $this->formopen == true ?? false;
    }

    public function simpan()
    {
        $this->emitUp('postCkEditor');
        $this->validate([
            'tgl_kelon' => 'required',
            'mapelid' => 'required',
            'kelasid' => 'required',
            'materi' => 'required',
            'isimateri' => 'required',
            'wktmulai' => 'required',
            'wktselesai' => 'required',
            'dokumen' => '',
            'videopath' => '',
        ]);

        ModelsKelasOnline::updateOrCreate([
            'kelas_id' => $this->kelasid,
            'mapel_id' => $this->mapelid,
            'materi' => $this->materi,
            'isi_materi' => $this->isimateri,
            'wkt_masuk' => $this->tgl_kelon." ".$this->wktmulai,
            'wkt_selesai' => $this->tgl_kelon." ".$this->wktselesai,
        ]);

        $this->clearForm();
        $this->emit('closeAddForm');

    }

    public function clearForm()
    {
        $this->tgl_kelon = '';
        $this->mapelid = '';
        $this->kelasid = '';
        $this->materi = '';
        $this->isimateri = '';
        $this->wktmulai = '';
        $this->wktselesai = '';
    }
}
