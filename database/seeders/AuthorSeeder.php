<?php

namespace Database\Seeders;

use App\Models\Author;
use Database\Factories\AuthorFactory;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        // Author::factory(30)->create();

        $curdate = date("Y-m-d H:i:s");

        $authors = [
            ['id' => 1, 'name' => 'Fenti Rahma', 'created_at' => $curdate],
            ['id' => 2, 'name' => 'Aziz Arif Rizaldi', 'created_at' => $curdate],
            ['id' => 3, 'name' => 'Hadian Rahmat', 'created_at' => $curdate],
        ];
                
        DB::table('authors')->insert($authors);        
    }
}
