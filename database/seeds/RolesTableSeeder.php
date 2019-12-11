<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([[
            'name' => 'Admin',
            'created_at' => date('Y-d-m H:i:s')
        ],[
            'name' => 'Team Leader',
            'created_at' => date('Y-d-m H:i:s')
        ],[
            'name' => 'Team Member',
            'created_at' => date('Y-d-m H:i:s')
        ]]);
    }
}
