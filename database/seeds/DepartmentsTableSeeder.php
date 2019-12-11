<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([[
            'name' => 'Admin'
        ],[
            'name' => 'HR',
        ],[
            'name' => 'Development',
        ],[
            'name' => 'Marketing & Sales',
        ],[
            'name' => 'Support',
        ],[
            'name' => 'Content Managment',
        ]]);
    }
}
