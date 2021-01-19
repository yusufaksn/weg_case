<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

     DB::table('users')->insert([
            'name' => 'DEV1',
            'user_role_id' => 1,
            'level' => 1,
     ]);
     DB::table('users')->insert([
            'name' => 'DEV2',
            'user_role_id' => 1,
            'level' => 2,
     ]);
     DB::table('users')->insert([
            'name' => 'DEV3',
            'user_role_id' => 1,
            'level' => 3,
     ]);
     DB::table('users')->insert([
            'name' => 'DEV4',
            'user_role_id' => 1,
            'level' => 4,
     ]);
     DB::table('users')->insert([
            'name' => 'DEV5',
            'user_role_id' => 1,
            'level' => 5,
     ]);

    }
}
