<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lob;

class LobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $Lobs = factory(Lob::class, 200)->create();
        \App\Models\Lob::factory()->count(30)->create(); 

    }
}
