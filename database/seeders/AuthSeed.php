<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Str;

class AuthSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // User::factory(20)->create();

        DB::table('users')->insert([
            'name'              => 'Administrator',
            'email'             => 'administrator@gmail.com',
            'password'          => Hash::make('abcd1234'),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'remember_token'    => Str::random(10),
            'created_at'        => date("Y-m-d H:i:s")
        ]);
    }
}
