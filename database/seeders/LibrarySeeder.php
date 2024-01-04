<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Library;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Library::create([
            'name' => 'Central Library',
            'address' => '123 Main St, Cityville',
        ]);

        Library::create([
            'name' => 'Public Library',
            'address' => '3000 Melm Street',
        ]);

        Library::create([
            'name' => 'Anchorage',
            'address' => '423 Jerry Toth Drive',
        ]);
    }
}
