<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Crypt;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $user = User::updateOrCreate([
            'nim' => '11112222',
            'nama' => $faker->name,
            'email' => '11112222@mail.unej.ac.id',
            'password' => bcrypt('password'),
            'token' => Crypt::encrypt('password'),
            'angkatan' => '2023',
        ]);
        $user->assignRole('Superadmin');

        $user = User::updateOrCreate([
            'nim' => '33334444',
            'nama' => $faker->name,
            'email' => '33334444@mail.unej.ac.id',
            'password' => bcrypt('password'),
            'token' => Crypt::encrypt('password'),
            'angkatan' => '2023',
        ]);
        $user->assignRole('Admin');

        $user = User::updateOrCreate([
            'nim' => '55556666',
            'nama' => $faker->name,
            'email' => '55556666@mail.unej.ac.id',
            'password' => bcrypt('password'),
            'token' => Crypt::encrypt('password'),
            'angkatan' => '2023',
        ]);
        $user->assignRole('Umum');
    }
}
