<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            if($row[0] != "Nama"){
                $username = $row[1];
                $user = User::updateOrCreate([
                    'email' => $username
                ],[
                    'name' => $row[0],
                    'email' => $username,
                    'password' => Hash::make($username)
                ]);

                Siswa::updateOrCreate([
                    'nis' => $row[1]
                ], [
                    'nama' => $row[0],
                    'nik' => $row[1],
                    'nip' => $row[2],
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
