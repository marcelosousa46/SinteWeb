<?php
namespace App\Classes;

/**
* Classe NFe Imposto dos Itens
*/
class NfeImpostoItem
{
	private $nItem
    private $vTotTrib

    public function getnItem()
    {
        return $this->nItem;
    }
     
    public function setnItem($nItem)
    {
        $this->nItem = $nItem;
        return $this;
    }

    public function getvTotTrib()
    {
        return $this->vTotTrib;
    }
     
    public function setvTotTrib($vTotTrib)
    {
        $this->vTotTrib = $vTotTrib;
        return $this;
    }

}