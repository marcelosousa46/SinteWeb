<?php
namespace App\Classes;

/**
* Classe do Produto da NFe
*/
class NfeProduto
{
    private $nItem$
    private $cProd
    private $cEAN
    private $xProd
    private $NCM
    private $EXTIPI
    private $CFOP
    private $uCom
    private $qCom
    private $vUnCom
    private $vProd
    private $cEANTrib
    private $uTrib
    private $qTrib
    private $vUnTrib
    private $vFrete
    private $vSeg
    private $vDesc
    private $vOutro
    private $indTot
    private $xPed
    private $nItemPed
    private $nFCI

    public function getnItem()
    {
        return $this->nItem;
    }
     
    public function setnItem($nItem)
    {
        $this->nItem = $nItem;
        return $this;
    }

    public function getcProd()
    {
        return $this->cProd;
    }
     
    public function setcProd($cProd)
    {
        $this->cProd = $cProd;
        return $this;
    }

    public function getcEAN()
    {
        return $this->cEAN;
    }
     
    public function setcEAN($cEAN)
    {
        $this->cEAN = $cEAN;
        return $this;
    }

    public function getxProd()
    {
        return $this->xProd;
    }
     
    public function setxProd($xProd)
    {
        $this->xProd = $xProd;
        return $this;
    }
	
	public function getNCM()
	{
	    return $this->NCM;
	}
	 
	public function setNCM($NCM)
	{
	    $this->NCM = $NCM;
	    return $this;
	}

	public function getEXTIPI()
	{
	    return $this->EXTIPI;
	}
	 
	public function setEXTIPI($EXTIPI)
	{
	    $this->EXTIPI = $EXTIPI;
	    return $this;
	}

	public function getCFOP()
	{
	    return $this->CFOP;
	}
	 
	public function setCFOP($CFOP)
	{
	    $this->CFOP = $CFOP;
	    return $this;
	}

	public function getuCom()
	{
	    return $this->uCom;
	}
	 
	public function setuCom($uCom)
	{
	    $this->uCom = $uCom;
	    return $this;
	}

	public function getqCom()
	{
	    return $this->qCom;
	}
	 
	public function setqCom($qCom)
	{
	    $this->qCom = $qCom;
	    return $this;
	}

	public function getvUnCom()
	{
	    return $this->vUnCom;
	}
	 
	public function setvUnCom($vUnCom)
	{
	    $this->vUnCom = $vUnCom;
	    return $this;
	}

	public function getvProd()
	{
	    return $this->vProd;
	}
	 
	public function setvProd($vProd)
	{
	    $this->vProd = $vProd;
	    return $this;
	}

	public function getcEANTrib()
	{
	    return $this->cEANTrib;
	}
	 
	public function setcEANTrib($cEANTrib)
	{
	    $this->cEANTrib = $cEANTrib;
	    return $this;
	}

	public function getuTrib()
	{
	    return $this->uTrib;
	}
	 
	public function setuTrib($uTrib)
	{
	    $this->uTrib = $uTrib;
	    return $this;
	}

	public function getqTrib()
	{
	    return $this->qTrib;
	}
	 
	public function setqTrib($qTrib)
	{
	    $this->qTrib = $qTrib;
	    return $this;
	}

	public function getvUnTrib()
	{
	    return $this->vUnTrib;
	}
	 
	public function setvUnTrib($vUnTrib)
	{
	    $this->vUnTrib = $vUnTrib;
	    return $this;
	}

	public function getvFrete()
	{
	    return $this->vFrete;
	}
	 
	public function setvFrete($vFrete)
	{
	    $this->vFrete = $vFrete;
	    return $this;
	}

    public function getvSeg()
    {
        return $this->vSeg;
    }
     
    public function setvSeg($vSeg)
    {
        $this->vSeg = $vSeg;
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

    public function getvOutro()
    {
        return $this->vOutro;
    }
     
    public function setvOutro($vOutro)
    {
        $this->vOutro = $vOutro;
        return $this;
    }

    public function getindTot()
    {
        return $this->indTot;
    }
     
    public function setindTot($indTot)
    {
        $this->indTot = $indTot;
        return $this;
    }

    public function getxPed()
    {
        return $this->xPed;
    }
     
    public function setxPed($xPed)
    {
        $this->xPed = $xPed;
        return $this;
    }

    public function getnItemPed()
    {
        return $this->nItemPed;
    }
     
    public function setnItemPed($nItemPed)
    {
        $this->nItemPed = $nItemPed;
        return $this;
    }

    public function getnFCI()
    {
        return $this->nFCI;
    }
     
    public function setnFCI($nFCI)
    {
        $this->nFCI = $nFCI;
        return $this;
    }

}