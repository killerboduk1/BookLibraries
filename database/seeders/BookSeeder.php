<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Library;
use App\Models\User;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $libraries = Library::all();

        foreach ($libraries as $library) {
            Book::create([
                'library_id' => $library->id,
                'title' => 'Sample Book - '.$library->id,
                'author' => 'John Doe - '.$library->id,
                'status' => 'available',
            ]);

            User::create([
                'name' => 'John Doe - '.$library->id,
                'email' => 'john'.$library->id.'@example.com',
                'password' => bcrypt('password'),
                'library_id' => $library->id,
            ]);

        }
    }
}
