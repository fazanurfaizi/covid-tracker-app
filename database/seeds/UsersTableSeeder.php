<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'  => 'Admin Covid Tracker App',
            'email' => 'admin@admin.com',
            'password'=> bcrypt('admin1234'),
            'email_verified_at' => now(),
            'is_admin' => 1,
            'remember_token' => Str::random(10),
        ]);
    }
}
