<?php

namespace Database\Seeders;

use App\Models\Pipeline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PipelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Pipeline::insert([
            ['name' => 'Untreated', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Unreachable', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Negotiation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'In progress', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Won', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lost', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
