<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $coba, $level, $users;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "User ".$this->level,
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();

        $this->users = User::whereHas(
            'roles', function($q){
                $q->where('name', $this->level);
            }
        )->get();

    }

    public function render()
    {
        return view('livewire.admin.users');
    }


}
