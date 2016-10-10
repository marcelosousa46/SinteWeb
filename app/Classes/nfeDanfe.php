<?php
namespace App\Classes;

use NFePHP\NFe\ToolsNFe;
use NFePHP\Extras\Danfe;

/**
* Eviar o Xml para Sefaz
*/
class nfeDanfe
{
  private $nfe;

  function __construct() {
  	$this->nfe = new ToolsNFe('../vendor/nfephp-org/nfephp/config/config.json');
  }

  public function getDanfe($nfe,$aXml){
    $danfe    = new Danfe($aXml, 'P', 'A4', $this->nfe->aConfig['aDocFormat']->pathLogoFile, 'I', '');
    $path     = $this->nfe->aConfig["pathNFeFiles"];
    $mesano   = date('Ym');
//    if(mkdir("/path/to/my/dir", 0700))
    $pdfDanfe = "{$path}/homologacao/pdf/{$mesano}/{$nfe->chv_nfe}-danfe.pdf";
    $id       = $danfe->montaDANFE();
    $salva    = $danfe->printDANFE($pdfDanfe, 'F'); //Salva o PDF na pasta
    $abre     = $danfe->printDANFE("{$id}-danfe.pdf", 'I'); //Abre o PDF no Navegador
    return true;
  }
}