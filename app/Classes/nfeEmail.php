<?php
namespace App\Classes;

use NFePHP\NFe\ToolsNFe;
use NFePHP\Extras\Danfe;
use NFePHP\Common\Files\FilesFolders;

/**
* Eviar o Email para o cliente
*/
class nfeEmail
{
  private $nfe;

  function __construct() {
  	$this->nfe = new ToolsNFe('../vendor/nfephp-org/nfephp/config/config.json');
  }

  public function getEmail($nfe,$chave){
    $this->nfe->setModelo('55');

    $path     = $this->nfe->aConfig["pathNFeFiles"];
    $mesano   = date('Ym');

    $pathXml  = "{$path}/homologacao/enviadas/aprovadas/{$mesano}/{$chave}-protNFe.xml";
    $pathPdf  = "{$path}/homologacao/pdf/{$mesano}/{$chave}-danfe.pdf";

    $aMails   = array($nfe->participante->email);

    $templateFile = '';
    $comPdf       = true;
    try {
        $this->nfe->enviaMail($pathXml, $aMails, $templateFile, $comPdf, $pathPdf);
        return true;
    } catch (NFePHP\Common\Exception\RuntimeException $e) {
        return false;
    }    
  }
}