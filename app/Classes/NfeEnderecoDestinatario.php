<?php
namespace App\Classes;

/**
* Classe Endereco do Destinatário
*/
class NfeEnderecoDestinatario
{
	private $xLgr
	private $nro
	private $xCpl
	private $xBairro
	private $cMun
	private $xMun
	private $UF
	private $CEP
	private $cPais
	private $xPais
	private $fone

	public function getXLgr()
	{
	    return $this->xLgr;
	}
	 
	public function setXLgr($xLgr)
	{
	    $this->xLgr = $xLgr;
	    return $this;
	}

	public function getNro()
	{
	    return $this->nro;
	}
	 
	public function setNro($nro)
	{
	    $this->nro = $nro;
	    return $this;
	}

	public function getXCpl()
	{
	    return $this->xCpl;
	}
	 
	public function setXCpl($xCpl)
	{
	    $this->xCpl = $xCpl;
	    return $this;
	}

	public function getXBairro()
	{
	    return $this->xBairro;
	}
	 
	public function setXBairro($xBairro)
	{
	    $this->xBairro = $xBairro;
	    return $this;
	}

	public function getCMun()
	{
	    return $this->cMun;
	}
	 
	public function setCMun($cMun)
	{
	    $this->cMun = $cMun;
	    return $this;
	}

	public function getXMun()
	{
	    return $this->xMun;
	}
	 
	public function setXMun($xMun)
	{
	    $this->xMun = $xMun;
	    return $this;
	}

	public function getUF()
	{
	    return $this->UF;
	}
	 
	public function setUF($UF)
	{
	    $this->UF = $UF;
	    return $this;
	}

	public function getCEP()
	{
	    return $this->CEP;
	}
	 
	public function setCEP($CEP)
	{
	    $this->CEP = $CEP;
	    return $this;
	}

	public function getCPais()
	{
	    return $this->cPais;
	}
	 
	public function setCPais($cPais)
	{
	    $this->cPais = $cPais;
	    return $this;
	}

	public function getXPais()
	{
	    return $this->xPais;
	}
	 
	public function setXPais($xPais)
	{
	    $this->xPais = $xPais;
	    return $this;
	}

	public function getFone()
	{
	    return $this->fone;
	}
	 
	public function setFone($fone)
	{
	    $this->fone = $fone;
	    return $this;
	}
	
}