<?php

use Illuminate\Database\Seeder;
use App\User;

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
	               'name' => 'Marcelo Sousa',
	               'email' => 'marcelosousa46@gmail.com',
                   'password' => bcrypt('mar141012'),  
	               ]);      
    }
}
