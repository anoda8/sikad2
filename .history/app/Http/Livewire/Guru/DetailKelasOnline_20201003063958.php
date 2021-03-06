<?php

namespace App\Http\Livewire\Guru;

use App\Models\KelasOnline;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailKelasOnline extends Component
{
    public $kelonid;
    public $chat, $inputChat = null;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Detail Kelas",
            'keterangan' => ""
        ];
    }

    public function mount($kelonid){
        $this->level = request()->segment(3);
        $this->kelonid = $kelonid;
    }

    public function render()
    {
        $kelons = KelasOnline::where('id', $this->kelonid)->with(['kelas', 'mapel', 'author'])->get()->first();
        $this->heading = [
            'judul' => $kelons->kelas->nama." [".$kelons->mapel->nama."]",
            'keterangan' => $kelons->materi
        ];
        $komentare = Komentar::where('kelon_id', $this->kelonid)->orderBy('created_at', 'ASC')->get();
        return view('livewire.guru.detail-kelas-online',[
            'kelons' => $kelons, 'komentare' => $komentare
        ]);
    }

    public function simpanKomen()
    {
        if($this->inputChat != null){
            Komentar::create([
                'kelon_id' => $this->kelonid,
                'author_id' => Auth::id(),
                'komentar' => $this->inputChat
            ]);
        }
    }


}
