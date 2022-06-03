<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'name' => 'Super Admin',
            'email' => 'admin@test.test',
            'email_verified_at' => '2021-01-01',
            'password' => bcrypt('12345678'),
        ]);
        $user->save();
    }
}
