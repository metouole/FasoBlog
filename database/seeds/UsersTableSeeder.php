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
        	'role_id' => '1',
        	'name' => 'MD. Admin',
        	'username' => 'admin',
        	'email' => 'admin@fasoblog.com',
        	'password' => bcrypt('ghislain2010'),
        ]);


        DB::table('users')->insert([
        	'role_id' => '2',
        	'name' => 'MD. Author',
        	'username' => 'author',
        	'email' => 'author@fasoblog.com',
        	'password' => bcrypt('rootauthor'),
        ]);
    }
}
