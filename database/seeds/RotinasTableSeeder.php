<?php

use Illuminate\Database\Seeder;
use App\models\Rotinas;

class RotinasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	     DB::table('rotinas')->insert([
	               'descricao' => 'Entrada de dados',
	               'url' => '#',
	               'tipo' => '0',
	               'nivel' => '1',
                  ]);

	     DB::table('rotinas')->insert([
	               'descricao' => 'Usuários',
	               'url' => 'usuarios',
	               'tipo' => '1',
	               'nivel' => '1',
                   ]);

       DB::table('rotinas')->insert([
	               'descricao' => 'Configurações',
	               'url' => '#',
	               'tipo' => '0',
	               'nivel' => '1',
                  ]);
      DB::table('rotinas')->insert([
	               'descricao' => 'Permissões',
	               'url' => 'permissoes',
	               'tipo' => '1',
	               'nivel' => '1',
                  ]);      

    }
}
