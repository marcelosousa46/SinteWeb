<?php
namespace App\Classes;

/**
* Classe NfeDuplicatas - dados das duplicatas (Pagamentos)
*/
class ClassName extends AnotherClass
{
	private $nDup
    private $dVenc
    private $vDup
    private $resp

    public function getnDup()
    {
        return $this->nDup;
    }
     
    public function setnDup($nDup)
    {
        $this->nDup = $nDup;
        return $this;
    }

    public function getdVenc()
    {
        return $this->dVenc;
    }
     
    public function setdVenc($dVenc)
    {
        $this->dVenc = $dVenc;
        return $this;
    }

    public function getvDup()
    {
        return $this->vDup;
    }
     
    public function setvDup($vDup)
    {
        $this->vDup = $vDup;
        return $this;
    }
    
}