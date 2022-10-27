<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // Book::factory(70)->create();

        $curdate = date("Y-m-d H:i:s");

        $books = [
            ['id' => 1, 'author_id' => 1, 'title' => 'Akuntansi Pengantar 1', 'created_at' => $curdate],
            ['id' => 2, 'author_id' => 1, 'title' => 'Statistik Sosial; Teori dan aplikasi Program SPSS', 'created_at' => $curdate],
            ['id' => 3, 'author_id' => 2, 'title' => 'Aplikasi Klinis Induk Ovulasi & Stimulasi Ovariu', 'created_at' => $curdate],
            ['id' => 4, 'author_id' => 2, 'title' => 'Aplikasi Praktis Asuhan Keperawatan Keluarga', 'created_at' => $curdate],
            ['id' => 5, 'author_id' => 2, 'title' => 'Buku Ajar Tumbuh Kembang Remaja & Permasalahanya', 'created_at' => $curdate],
            ['id' => 6, 'author_id' => 3, 'title' => 'Jaringan Komputer 1', 'created_at' => $curdate],
        ];
                
        DB::table('books')->insert($books);        
    }
}
