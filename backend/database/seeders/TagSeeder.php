<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Tag::insert([
               ['name' => 'VIP', 'created_at' => now(), 'updated_at' => now()],
               ['name' => 'New Customer', 'created_at' => now(), 'updated_at' => now()],
               ['name' => 'Hot Lead', 'created_at' => now(), 'updated_at' => now()],
               ['name' => 'Potential', 'created_at' => now(), 'updated_at' => now()],
           ]);
    }
}
