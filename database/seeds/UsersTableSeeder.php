<?php

use Illuminate\Database\Seeder;

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
            'department_id' => 1,  
            'role_id' => 1,  
            'full_name' => "Admin",  
            'mobile_no' => "9999999999",  
            'email_id' => "admin@gmail.com",  
            'password' => "020da6fda07cbd85d0e544fa08bc544d", 
            'dob' => '1990-12-12',
            'doj' => '2014-06-01',
            'status' => 1, 
            'created_at' => date('Y-d-m H:i:s')
        ]);
    }
}
