<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 22
        ]);


        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 23
        ]);


        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 24
        ]);


        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 25
        ]);

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 26
        ]);

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 27
        ]);

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 28
        ]);
    }
}
