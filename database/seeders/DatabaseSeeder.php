<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table("users")->insert([
            [
                "id" => 1,
                "name" => "admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make("123123123"),
                "role" => "admin",
                "syubah" => "AsySyuhada"
            ],
            [
                "id" => 2,
                "name" => "dudung",
                "email" => "dudung@gmail.com",
                "password" => Hash::make("123123123"),
                "role" => "jamiah",
                "syubah" => "AsySyuhada"
            ],
            [
                "id" => 3,
                "name" => "ujang",
                "email" => "ujang@gmail.com",
                "password" => Hash::make("123123123"),
                "role" => "syubah",
                "syubah" => "AsySyuhada"
            ],
            [
                "id" => 4,
                "name" => "asep",
                "email" => "asep@gmail.com",
                "password" => Hash::make("123123123"),
                "role" => "mudir",
                "syubah" => "AsySyuhada"
            ]
        ]);
        DB::table("members")->insert([
            [
                "id" => 1,
                "name" => "basit",
                "nas" => "201223030",
                "syubah" => "AsySyuhada",
                "holaqoh" => "001",
                "farah" => "002",
            ],
            [
                "id" => 2,
                "name" => "panji",
                "nas" => "201223031",
                "syubah" => "AsySyuhada",
                "holaqoh" => "001",
                "farah" => "002",
            ]
        ]);
    }
}
