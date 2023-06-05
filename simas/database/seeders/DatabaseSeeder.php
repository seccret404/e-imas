<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name'  => 'Administrator',
            'id_user'=>'123456',
            'email' => 'admin123@gmail.com',
            'jurusan'=>'admin sekolah',
            'kelas'=>'100',
            'role' => 'admin',
            'password'  => bcrypt('123456')
        ]);
    }
}
