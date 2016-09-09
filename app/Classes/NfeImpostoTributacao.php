<?php
namespace App\Classes;

/**
* Classe da NFe - ICMS - Imposto sobre Circulação de Mercadorias e Serviços
*/
class NfeImpostoTributacao
{

	private $nItem
	private $orig
	private $cst
	private $modBC
	private $pRedBC
	private $vBC
	private $pICMS
	private $vICMS
	private $vICMSDeson
	private $motDesICMS
	private $modBCST
	private $pMVAST
	private $pRedBCST
	private $vBCST
	private $pICMSST
	private $vICMSST
	private $pDif
	private $vICMSDif
	private $vICMSOp
	private $vBCSTRet
	private $vICMSSTRet

	public function getnItem()
	{
	    return $this->nItem;
	}
	 
	public function setnItem($nItem)
	{
	    $this->nItem = $nItem;
	    return $this;
	}

	public function getorig()
	{
	    return $this->orig;
	}
	 
	public function setorig($orig)
	{
	    $this->orig = $orig;
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

	public function getmodBC()
	{
	    return $this->modBC;
	}
	 
	public function setmodBC($modBC)
	{
	    $this->modBC = $modBC;
	    return $this;
	}

	public function getpRedBC()
	{
	    return $this->pRedBC;
	}
	 
	public function setpRedBC($pRedBC)
	{
	    $this->pRedBC = $pRedBC;
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

	public function getpICMS()
	{
	    return $this->pICMS;
	}
	 
	public function setpICMS($pICMS)
	{
	    $this->pICMS = $pICMS;
	    return $this;
	}

	public function getvICMS()
	{
	    return $this->vICMS;
	}
	 
	public function setvICMS($vICMS)
	{
	    $this->vICMS = $vICMS;
	    return $this;
	}

	public function getvICMSDeson()
	{
	    return $this->vICMSDeson;
	}
	 
	public function setvICMSDeson($vICMSDeson)
	{
	    $this->vICMSDeson = $vICMSDeson;
	    return $this;
	}

	public function getmotDesICMS()
	{
	    return $this->motDesICMS;
	}
	 
	public function setmotDesICMS($motDesICMS)
	{
	    $this->motDesICMS = $motDesICMS;
	    return $this;
	}

	public function getmodBCST()
	{
	    return $this->modBCST;
	}
	 
	public function setmodBCST($modBCST)
	{
	    $this->modBCST = $modBCST;
	    return $this;
	}

	public function getpMVAST()
	{
	    return $this->pMVAST;
	}
	 
	public function setpMVAST($pMVAST)
	{
	    $this->pMVAST = $pMVAST;
	    return $this;
	}

	public function getpRedBCST()
	{
	    return $this->pRedBCST;
	}
	 
	public function setpRedBCST($pRedBCST)
	{
	    $this->pRedBCST = $pRedBCST;
	    return $this;
	}

	public function getvBCST()
	{
	    return $this->vBCST;
	}
	 
	public function setvBCST($vBCST)
	{
	    $this->vBCST = $vBCST;
	    return $this;
	}

	public function getpICMSST()
	{
	    return $this->pICMSST;
	}
	 
	public function setpICMSST($pICMSST)
	{
	    $this->pICMSST = $pICMSST;
	    return $this;
	}

	public function getvICMSST()
	{
	    return $this->vICMSST;
	}
	 
	public function setvICMSST($vICMSST)
	{
	    $this->vICMSST = $vICMSST;
	    return $this;
	}

	public function getpDif()
	{
	    return $this->pDif;
	}
	 
	public function setpDif($pDif)
	{
	    $this->pDif = $pDif;
	    return $this;
	}

	public function getvICMSDif()
	{
	    return $this->vICMSDif;
	}
	 
	public function setvICMSDif($vICMSDif)
	{
	    $this->vICMSDif = $vICMSDif;
	    return $this;
	}

	public function getvICMSOp()
	{
	    return $this->vICMSOp;
	}
	 
	public function setvICMSOp($vICMSOp)
	{
	    $this->vICMSOp = $vICMSOp;
	    return $this;
	}

	public function getvBCSTRet()
	{
	    return $this->vBCSTRet;
	}
	 
	public function setvBCSTRet($vBCSTRet)
	{
	    $this->vBCSTRet = $vBCSTRet;
	    return $this;
	}

	public function getvICMSSTRet()
	{
	    return $this->vICMSSTRet;
	}
	 
	public function setvICMSSTRet($vICMSSTRet)
	{
	    $this->vICMSSTRet = $vICMSSTRet;
	    return $this;
	}
}