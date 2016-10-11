<?php
namespace App\Classes;

use NFePHP\NFe\ToolsNFe;
use NFePHP\Extras\Danfe;
use NFePHP\Common\Files\FilesFolders;

/**
* Eviar o Xml para Sefaz
*/
class nfeDanfe
{
  private $nfe;

  function __construct() {
  	$this->nfe = new ToolsNFe('../vendor/nfephp-org/nfephp/config/config.json');
  }

  public function getDanfe($nfe,$chave,$exibir){
    $path     = $this->nfe->aConfig["pathNFeFiles"];
    $mesano   = date('Ym');

    $xmlProt  = "{$path}/homologacao/enviadas/aprovadas/{$mesano}/{$chave}-protNFe.xml";
    $pdfDanfe = "{$path}/homologacao/pdf/{$mesano}/{$chave}-danfe.pdf";

    $docxml   = FilesFolders::readFile($xmlProt);
    $danfe    = new Danfe($docxml, 'P', 'A4', $this->nfe->aConfig['aDocFormat']->pathLogoFile, 'I', '');

    $id       = $danfe->montaDANFE();
    $salva    = $danfe->printDANFE($pdfDanfe, 'F'); //Salva o PDF na pasta
    if ($exibir){
      $abre = $danfe->printDANFE($pdfDanfe, 'I'); //Abre o PDF no Navegador
    }  
    return true;
  }
}