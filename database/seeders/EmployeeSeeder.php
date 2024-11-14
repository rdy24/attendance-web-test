<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = [
            [
                'name' => 'Rendra',
                'email' => 'rendragituloh@gmail.com',
                'password' => bcrypt('password'),
                'employee' => [
                    'date_of_birth' => '2011-11-11',
                    'city' => 'Jogja',
                    'status' => 'active',
                ],
            ],
            [
                'name' => 'Khariz',
                'email' => 'kharizajaah@gmail.com',
                'password' => bcrypt('password'),
                'employee' => [
                    'date_of_birth' => '2012-12-12',
                    'city' => 'Bantul',
                    'status' => 'active',
                ],
            ],
            [
                'name' => 'Joko',
                'email' => 'jokoterdepan@gmail.com',
                'password' => bcrypt('password'),
                'employee' => [
                    'date_of_birth' => '2010-10-10',
                    'city' => 'Sleman',
                    'status' => 'active',
                ],
            ],
            [
                'name' => 'Mariyam',
                'email' => 'maiyamyuk@gmail.com',
                'password' => bcrypt('password'),
                'employee' => [
                    'date_of_birth' => '2009-09-09',
                    'city' => 'Gunung Kidul',
                    'status' => 'active',
                ],
            ]
        ];

        foreach ($user as $u) {
            $user = \App\Models\User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => $u['password'],
            ]);
            $user->assignRole('user');
            $user->employee()->create($u['employee']);
        }
    }
}
