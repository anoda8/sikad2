<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mapel as ModelsMapel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Mapel extends Component
{
    public $guru, $author_id, $nama;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Mata Pelajaran",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $gurus = User::whereHas('roles', function($q){
            $q->where('name', 'guru');
        })->get();
        return view('livewire.admin.mapel', [
            'gurus' => $gurus
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'guru' => 'required'
        ]);

        ModelsMapel::create([
            'user_id' => $this->guru,
            'author_id' => Auth::id(),
            'nama' => $this->nama
        ]);

        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.$this->nama]);
        $this->clearForm();
    }

    public function clearForm()
    {

    }
}
