<?php
namespace App\Classes;

use NFePHP\NFe\MakeNFe;
use NFePHP\NFe\ToolsNFe;

/**
* Nfe Gerar NFe.
*/
class Nfe
{
	public $nfe;
	public $nfeTools;
	public $NfeCapa;
    
    function __construct() {

		$this->nfe = new MakeNFe();

		$this->nfeTools = new ToolsNFe('../vendor/nfephp-org/nfephp/config/config.json');

		$this->NfeCapa = new NfeCapa; // Capa da Nota Fiscal

    }

	public function getnfe($nota)
	{
		$this->NfeCapa->cUF   = $nota['cUF'];
//		$this->NfeCapa->cnpj  = $this->nfeTools->aConfig['cnpj'];
		$this->NfeCapa->chave = $this->nfe->montaChave($this->NfeCapa->cUF, $this->NfeCapa->ano, 
			                                           $this->NfeCapa->mes, $this->NfeCapa->cnpj, 
			                                           $this->NfeCapa->mod, $this->NfeCapa->serie, 
			                                           $this->NfeCapa->nNF, $this->NfeCapa->tpEmis,
			                                           $this->NfeCapa->cNF);
		$this->NfeCapa->versao = '3.10';
		$resp = $this->nfe->taginfNFe($this->NfeCapa->chave,$this->NfeCapa->versao);
        dd($resp);
	    return json_encode($resp);
	}
}