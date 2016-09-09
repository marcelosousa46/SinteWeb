<?php
namespace App\Classes;

/**
* Classe IPI - Imposto sobre Produto Industrializado
*/
class NfeIpi
{
	private $nItem
	private $cst
	private $clEnq
	private $cnpjProd
	private $cSelo
	private $qSelo
	private $cEnq
	private $vBC
	private $pIPI
	private $qUnid
	private $vUnid
	private $vIPI
	
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

	public function getclEnq()
	{
	    return $this->clEnq;
	}
	 
	public function setclEnq($clEnq)
	{
	    $this->clEnq = $clEnq;
	    return $this;
	}

	public function getcnpjProd()
	{
	    return $this->cnpjProd;
	}
	 
	public function setcnpjProd($cnpjProd)
	{
	    $this->cnpjProd = $cnpjProd;
	    return $this;
	}

	public function getcSelo()
	{
	    return $this->cSelo;
	}
	 
	public function setcSelo($cSelo)
	{
	    $this->cSelo = $cSelo;
	    return $this;
	}

	public function getqSelo()
	{
	    return $this->qSelo;
	}
	 
	public function setqSelo($qSelo)
	{
	    $this->qSelo = $qSelo;
	    return $this;
	}

	public function getcEnq()
	{
	    return $this->cEnq;
	}
	 
	public function setcEnq($cEnq)
	{
	    $this->cEnq = $cEnq;
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

	public function getpIPI()
	{
	    return $this->pIPI;
	}
	 
	public function setpIPI($pIPI)
	{
	    $this->pIPI = $pIPI;
	    return $this;
	}

	public function getqUnid()
	{
	    return $this->qUnid;
	}
	 
	public function setqUnid($qUnid)
	{
	    $this->qUnid = $qUnid;
	    return $this;
	}

	public function getvUnid()
	{
	    return $this->vUnid;
	}
	 
	public function setvUnid($vUnid)
	{
	    $this->vUnid = $vUnid;
	    return $this;
	}

	public function getvIPI()
	{
	    return $this->vIPI;
	}
	 
	public function setvIPI($vIPI)
	{
	    $this->vIPI = $vIPI;
	    return $this;
	}
}