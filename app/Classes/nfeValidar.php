<?php
namespace App\Classes;

use NFePHP\NFe\ToolsNFe;
/**
 * Validar o XML gerado e assinado
 */
class nfeValidar
{
  private $nfe;

  function __construct() {
  	$this->nfe = new ToolsNFe('../vendor/nfephp-org/nfephp/config/config.json');
  }
  public function getValidar($chave,$tpAmb,$xml)
  {
    $this->nfe->setModelo('55');

    if (! $this->nfe->validarXml($xml) || sizeof($this->nfe->errors)) {
        return $this->nfe->errors;
    }
    return true;
  }
}
