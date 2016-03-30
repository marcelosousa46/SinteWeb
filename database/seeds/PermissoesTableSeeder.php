<?php

use Illuminate\Database\Seeder;
use App\Models\Permissoes;

class PermissoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	     DB::table('permissoes')->insert([
	               'users_id' => 1,
	               'rotinas_id' => 1,
	               'tipo' => '1',        
	               'crud' => 'AAAAA',        
	                ]);      

	     DB::table('permissoes')->insert([
	               'users_id' => 1,
	               'rotinas_id' => 2,
	               'tipo' => '1',        
	               'crud' => 'AAAAA',        
	                ]);      
    }
}
