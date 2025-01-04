<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisibilidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('visibilidades')->insert([
            ['estado' => 'Público'],
            ['estado' => 'Privado'],
            ['estado' => 'Arquivado'],
        ]);
    }
}
