<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Author::factory()
            ->count(10)
            ->hasBooks(3)
            ->create();
    }
}
