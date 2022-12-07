<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'nama' => 'Putra Ramdhan D',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345'),
                'jk' => 'L',
                'umur' => '25',
                'alamat' => 'JL. Gatot MangkuPraja',
                'roles_id' => '1',
                
            ],
            [
                'nama' => 'M Ibnu Maggie',
                'email' => 'perawat@gmail.com',
                'password' => bcrypt('12345'),
                'jk' => 'L',
                'umur' => '21',
                'alamat' => 'JL. Ciranjang',
                'roles_id' => '2',
                
            ],
            [
                'nama' => 'Zulpahmi Herman',
                'email' => 'dokter@gmail.com',
                'password' => bcrypt('12345'),
                'jk' => 'L',
                'umur' => '28',
                'alamat' => 'JL. Sawah Gede',
                'roles_id' => '3',
                
            ],
            
        ];

        foreach ($users as $key => $value){
            User::create($value);
        }
    }
}
