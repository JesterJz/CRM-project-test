<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);

        $adminRoleId = Role::where('name', 'Admin')->first()->id;
        $admin->roles()->attach($adminRoleId);

        $roleIds = Role::pluck('id')->toArray();
        User::factory(10)->create()->each(function ($user) use ($roleIds) {
            $user->roles()->attach($roleIds[array_rand($roleIds)]);
        });
    }
}
