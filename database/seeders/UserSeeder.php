<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $faker = Faker::create();

      if(Schema::hasTable('users')){
        $exists = DB::table('users')->where('email', 'admin@gmail.com')->exists();
        if(!$exists){
          DB::table('users')->insert([
          'name' => 'Admin',
          'email' => 'admin@gmail.com',
          'password' => Hash::make('123456'),
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
        }

        // Insert 50 users với tên random
        $users = [];
        for($i = 1; $i <= 50; $i++) {
          $users[] = [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
          ];
        }
        DB::table('users')->insert($users);
      }
    }
}
