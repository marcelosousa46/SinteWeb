<?php
namespace App\Classes;

use NFePHP\NFe\ToolsNFe;

/**
 * Consultar Recibo pela Nfe.php
 */
class nfeCancela
{
  private $nfe;

  function __construct() {
  	$this->nfe = new ToolsNFe('../vendor/nfephp-org/nfephp/config/config.json');
  }
  public function getCancela($nota,$xJust)
  {
  	$aResposta = array();
    $tpAmb     = $this->nfe->aConfig['tpAmb'];
    $retorno   = $this->nfe->sefazCancela($nota->chv_nfe,$tpAmb, $xJust, $nota->nProt, $aResposta);

    return $aResposta;
  }
}
