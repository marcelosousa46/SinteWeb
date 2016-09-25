<?php
namespace App\Classes;

use NFePHP\NFe\ToolsNFe;

/**
 * Assinar Xml gerado pela Nfe.php
 */
class nfeAssinar
{
  private $nfe;

  function __construct() {
  	$this->nfe = new ToolsNFe('../vendor/nfephp-org/nfephp/config/config.json');
  }
  public function getAssinar($chave,$xml)
  {
    $xml = $this->nfe->assina($xml);
    return $xml;
  }
}
