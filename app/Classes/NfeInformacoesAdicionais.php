<?php
namespace App\Classes;

/**
* Classe da Nfe Informações Adcionais
*/
class NfeInformacoesAdicionais
{

	private $nItem
    private $vDesc 

    public function getnItem()
    {
        return $this->nItem;
    }
     
    public function setnItem($nItem)
    {
        $this->nItem = $nItem;
        return $this;
    }

    public function getvDesc()
    {
        return $this->vDesc;
    }
     
    public function setvDesc($vDesc)
    {
        $this->vDesc = $vDesc;
        return $this;
    }

}