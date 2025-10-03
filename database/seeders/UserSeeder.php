<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'id' => 1,
                'nama_mahasiswa' => 'Rizky Mahesa',
                'nim' => 'A662573A',
                'kelas_id' => 1
            ],
            [
                'id' => 2,
                'nama_mahasiswa' => 'Ahmad Fikri',
                'nim' => 'B772888B',
                'kelas_id' => 2
            ]
        ]);
        
    }
}
