<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Seeder;


class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru');
        })->get();

        foreach ($users as  $user) {
            Guru::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'nip' => $user->email,
                'nik' => Str
            ]);
        }
    }
}
