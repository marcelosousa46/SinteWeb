<?php
namespace App\Classes;

use NFePHP\NFe\ToolsNFe;

/**
* Eviar o Xml para Sefaz
*/
class nfeEnvia
{
  private $nfe;

  function __construct() {
  	$this->nfe = new ToolsNFe('../vendor/nfephp-org/nfephp/config/config.json');
  }

  public function getEnviar($nfe,$chave,$tpAmb,$aXml){
  	$aResposta = array();
	$idLote    = '';
	$indSinc   = '0';
	$flagZip   = false;
	$retorno   = $nfe->sefazEnviaLote($aXml, $tpAmb, $idLote, $aResposta, $indSinc, $flagZip);
	return $aResposta;
  }
}