<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new User;
        $u->name = "admin";
        $u->email = "admin@fake.com";
        $u->email_verified_at = date('Y-m-d h:i:s');
        $u->password = Hash::make('123');
        $u->save();
    }
}
