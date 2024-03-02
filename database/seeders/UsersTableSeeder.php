<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //Admin
            [
            'full_name'=> 'Mosaad Admin',
            'username' => 'Admin' ,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'status' => 'active',
           ],

           //Vendor
           [
            'full_name'=> 'Mosaad Vendor',
            'username' => 'Vendor' ,
            'email' => 'vendor@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'vendor',
            'status' => 'active',
           ],

           //Customer

           [
            'full_name'=> 'Mosaad Customer',
            'username' => 'Customer' ,
            'email' => 'customer@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'customer',
            'status' => 'active',
           ],
        ]);
    }
}
