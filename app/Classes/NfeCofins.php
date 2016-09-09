<?php
namespace App\Classes;

/**
* Classe NfeCofins - COFINS - Contribuição para o Financiamento da Seguridade Social
*/
class NfePis
{
	private $nItem
	private $cst
	private $vBC
	private $pCOFINS
	private $vCOFINS
	private $qBCProd
	private $vAliqProd

	public function getnItem()
	{
	    return $this->nItem;
	}
	 
	public function setnItem($nItem)
	{
	    $this->nItem = $nItem;
	    return $this;
	}

	public function getcst()
	{
	    return $this->cst;
	}
	 
	public function setcst($cst)
	{
	    $this->cst = $cst;
	    return $this;
	}

	public function getvBC()
	{
	    return $this->vBC;
	}
	 
	public function setvBC($vBC)
	{
	    $this->vBC = $vBC;
	    return $this;
	}

	public function getpCOFINS()
	{
	    return $this->pCOFINS;
	}
	 
	public function setpCOFINS($pPIS)
	{
	    $this->pCOFINS = $pCOFINS;
	    return $this;
	}

	public function getvCOFINS()
	{
	    return $this->vCOFINS;
	}
	 
	public function setvPIS($vCOFINS)
	{
	    $this->vCOFINS = $vCOFINS;
	    return $this;
	}

	public function getqBCProd()
	{
	    return $this->qBCProd;
	}
	 
	public function setqBCProd($qBCProd)
	{
	    $this->qBCProd = $qBCProd;
	    return $this;
	}

	public function getvAliqProd()
	{
	    return $this->vAliqProd;
	}
	 
	public function setvAliqProd($vAliqProd)
	{
	    $this->vAliqProd = $vAliqProd;
	    return $this;
	}
	
}