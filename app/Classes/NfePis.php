<?php
namespace App\Classes;

/**
* Classe NfePis - PIS - Programa de Integração Social
*/
class NfePis
{
	private $nItem
	private $cst
	private $vBC
	private $pPIS
	private $vPIS
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

	public function getpPIS()
	{
	    return $this->pPIS;
	}
	 
	public function setpPIS($pPIS)
	{
	    $this->pPIS = $pPIS;
	    return $this;
	}

	public function getvPIS()
	{
	    return $this->vPIS;
	}
	 
	public function setvPIS($vPIS)
	{
	    $this->vPIS = $vPIS;
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