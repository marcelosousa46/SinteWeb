<?php
namespace App\Classes;

/**
* Classe NfeDadosfatura - dados da fatura
*/
class ClassName extends AnotherClass
{
	private $nFat
	private $vOrig
	private $vDesc
	private $vLiq

	public function getnFat()
	{
	    return $this->nFat;
	}
	 
	public function setnFat($nFat)
	{
	    $this->nFat = $nFat;
	    return $this;
	}

	public function getvOrig()
	{
	    return $this->vOrig;
	}
	 
	public function setvOrig($vOrig)
	{
	    $this->vOrig = $vOrig;
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

	public function getvLiq()
	{
	    return $this->vLiq;
	}
	 
	public function setvLiq($vLiq)
	{
	    $this->vLiq = $vLiq;
	    return $this;
	}

}