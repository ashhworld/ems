# ems
Employee Management System

Steps to configure EMS Project:
-------------------------------

1. Unzip the EMS Project Folder in your documentRoot path

my project path is: 
E:\projects

2. goto the root of the project in command prompt and update composer:
	cmd:
	> composer update

3.create database named "ems".

4. update database confuguration in project:
    E:\projects\ems\config\database.php
    My configuration is :
    'mysql' => [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'database' => 'ems',
            'username' => 'root',
            'password' => 'password',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

4. run migration:
	> php artisan migrate
 
5. run seeder:
	> php artisan db:seed --class=UsersTableSeeder
	> php artisan db:seed --class=DepartmentsTableSeeder
	> php artisan db:seed --class=RolesTableSeeder

6. Run Sql script for dummy Employee data:
in your database "ems".

File found in attchment "ems_users_salary.sql"



Steps to create local domain:
-----------------------------

1. create virtual host
    C:/xampp/apache/conf/extra/httpd-vhosts.conf

2. edit file and paste the below code and update by your configuration

    <VirtualHost *:80>
        DocumentRoot "E:/projects/ems/public"
        ServerName ems.localhost
        <Directory "E:/projects/ems/public">
        </Directory>
    </VirtualHost>

3. Now, go to Windows > Search > Run and paste the following line:
    C:\Windows\System32\drivers\etc\hosts

4. add your local domain name
    127.0.0.1      ems.localhost
5. goto httpd.conf file
    My file is in "C:\Apache24\conf" location

    <VirtualHost 127.0.0.1>
        ServerAdmin admin@ems.localhost
        DocumentRoot "E:/projects/ems/public"
        ServerName ems.localhost
        ErrorLog logs/ems-error.log
        CustomLog logs/ems-access_log common
            
        <Directory E:\projects/ems/public>
                AllowOverride All
        </Directory>

    </VirtualHost>
