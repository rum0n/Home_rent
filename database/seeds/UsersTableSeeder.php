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
         	'role_id'=>'1',
        	'name' => 'Admin',
        	'username' => 'admin',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('12345678'),
        ]);

		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'User',
			'username' => 'user',
			'email' => 'user@gmail.com',
			'password' => bcrypt('12345678'),
		]);

		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Ruhel',
			'username' => 'ruhel',
			'email' => 'ruhe@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Abid',
			'username' => 'abid',
			'email' => 'avid@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Tareq',
			'username' => 'tareq',
			'email' => 'tareq@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Deva',
			'username' => 'deva',
			'email' => 'deva@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Fateh',
			'username' => 'fateh',
			'email' => 'fateh@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Novonil',
			'username' => 'novo',
			'email' => 'novonil@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Saeed',
			'username' => 'saeed',
			'email' => 'saeed@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Titu',
			'username' => 'titu',
			'email' => 'titu@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Juhin',
			'username' => 'juhin',
			'email' => 'juhin@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Rumon',
			'username' => 'rumon',
			'email' => 'rumon@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Shahel',
			'username' => 'shahel',
			'email' => 'shahel@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Shuvo',
			'username' => 'shuvo',
			'email' => 'shuvo@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Iskan',
			'username' => 'iskan',
			'email' => 'iskan@gmail.com',
			'password' => bcrypt('12345678'),
		]);
		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'Lalshan',
			'username' => 'lalshan',
			'email' => 'lalshan@gmail.com',
			'password' => bcrypt('12345678'),
		]);

    }
}
