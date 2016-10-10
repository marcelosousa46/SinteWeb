<?php
namespace App\Classes;

use NFePHP\NFe\ToolsNFe;

/**
 * Consultar Recibo pela Nfe.php
 */
class nfeConsultar
{
  private $nfe;

  function __construct() {
  	$this->nfe = new ToolsNFe('../vendor/nfephp-org/nfephp/config/config.json');
  }
  public function getConsulta($recibo,$tpAmb)
  {
  	$aResposta = array();
    $retorno   = $this->nfe->sefazConsultaRecibo($recibo, $tpAmb, $aResposta);

    return $aResposta;
  }
}
