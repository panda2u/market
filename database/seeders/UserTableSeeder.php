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
        $uadmin = new User;
        $uadmin->name = "admin";
        $uadmin->email = "admin@fake.com";
        $uadmin->password = Hash::make('123');
        $uadmin->save();
    }
}
