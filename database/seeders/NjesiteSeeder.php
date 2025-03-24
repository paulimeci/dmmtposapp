<?php

namespace Database\Seeders;

use App\Models\Njesia;
use Illuminate\Database\Seeder;

class NjesiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Njesia::insert([
            ['name' => 'KG'],
            ['name' => 'cope'],
            ['name' => 'koli'],
        ]);
    }
}
