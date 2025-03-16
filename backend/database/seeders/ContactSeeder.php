<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Contact::factory(20)->create()->each(function ($contact) {
            $contact->tags()->attach(Tag::inRandomOrder()->take(rand(1, 4))->pluck('id'));
        });
    }
}
