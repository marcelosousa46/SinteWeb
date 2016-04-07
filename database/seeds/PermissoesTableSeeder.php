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
	               'liberado' => 'A',
	               'incluir' => 'A',
	               'alterar' => 'A',
	               'consultar' => 'A',
	               'excluir' => 'A',
	                ]);

	     DB::table('permissoes')->insert([
	               'users_id' => 1,
	               'rotinas_id' => 2,
	               'liberado' => 'A',
	               'incluir' => 'A',
	               'alterar' => 'A',
	               'consultar' => 'A',
	               'excluir' => 'A',
	                ]);
        DB::table('permissoes')->insert([
 	               'users_id' => 1,
 	               'rotinas_id' => 3,
	               'liberado' => 'A',
	               'incluir' => 'A',
	               'alterar' => 'A',
	               'consultar' => 'A',
	               'excluir' => 'A',
 	                ]);

 	     DB::table('permissoes')->insert([
 	               'users_id' => 1,
 	               'rotinas_id' => 4,
	               'liberado' => 'A',
	               'incluir' => 'A',
	               'alterar' => 'A',
	               'consultar' => 'A',
	               'excluir' => 'A',
 	                ]);

 	     DB::table('permissoes')->insert([
 	               'users_id' => 1,
 	               'rotinas_id' => 5,
	               'liberado' => 'A',
	               'incluir' => 'A',
	               'alterar' => 'A',
	               'consultar' => 'A',
	               'excluir' => 'A',
 	                ]);
    }
}
