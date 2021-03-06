<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $level, $nama, $username, $password, $repass, $userId, $perpage = 5;
    public $modeEdit = false;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "User ".ucwords($this->level),
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::whereHas('roles', function($q){$q->where('name', $this->level);})->paginate($this->perpage)
        ]);
    }

    public function simpanUser()
    {
        $this->validateDate = $this->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
            'repass' => 'required_with:password|same:password'
        ]);

        $user = User::updateOrCreate([
            'email' => $this->username
        ],[
            'name' => $this->nama,
            'email' => $this->username,
            'password' => Hash::make($this->password)
        ]);

        $user->attachRole($this->level);
        $this->emit('closeModalUser');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.ucwords($this->level)]);
        $this->clearFormUser();
    }

    public function doEditUser(){
        $this->validateDate = $this->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'nullable|min:6',
            'repass' => 'sometimes|required_with:password|same:password'
        ]);

        $user = User::updateOrCreate([
            'email' => $this->username
        ],[
            'name' => $this->nama,
            'email' => $this->username,
            'password' => Hash::make($this->password)
        ]);

        $this->emit('closeModalUser');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil mengubah '.$user->name]);
        $this->clearFormUser();
    }

    public function userEdit($id)
    {
        $user = User::find($id);
        $this->nama = $user->name;
        $this->username = $user->email;
        $this->password = null;
        $this->repass = null;
        $this->modeEdit = true;
    }

    public function userDelete($id)
    {
        $user = User::find($id);
        $nama = $user->name;
        $user->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => $nama." dihapus !"]);
    }

    public function clearFormUser()
    {
        $this->nama = '';
        $this->username = '';
        $this->password = '';
        $this->repass = '';
        $this->modeEdit = false;
    }


}
