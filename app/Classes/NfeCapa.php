<?php
namespace App\Classes;

/**
* Implementação da classe Nfe.
*/
class NfeCapa
{
    public $cUF;
    public $cNF;
    public $natOp;
    public $indPag;
    public $mod;
    public $serie;
    public $nNF;
    public $dhEmi;
    public $dhSaiEnt; 
    public $tpNF;
    public $idDest; 
    public $cMunFG;
    public $tpImp; 
    public $tpEmis;
    public $tpAmb;
    public $finNFe;
    public $indFinal;
    public $indPres;
    public $procEmi;
    public $verProc;
    public $dhCont;
    public $xJust;

    public $ano;
    public $mes;
    public $cnpj; 
    public $chave;
    public $versao;

    public $cDV; 
    public $resp;

    public function setcUF($cUF)
    {
        $this->cUF = $cUF;
    	return $this;
    }
    public function getcUF()
    {
        return $this->cUF;
    }

    public function setcNF($cNF)
    {
        $this->cUF = $cNF;
	    return $this;
    }
    public function getcNF()
    {
        return $this->cNF;
    }

    public function setnatOp($natOp)
    {
        $this->natOp = $natOp;
	    return $this;
    }
    public function getnatOp()
    {
        return $this->natOp;
    }

    public function getIndPag()
    {
        return $this->indPag;
    }
    
    public function setIndPag($indPag)
    {
        $this->indPag = $indPag;
        return $this;
    }

    public function getMod()
    {
        return $this->mod;
    }
     
    public function setMod($mod)
    {
        $this->mod = $mod;
        return $this;
    }

    public function getSerie()
    {
        return $this->serie;
    }
     
    public function setSerie($serie)
    {
        $this->serie = $serie;
        return $this;
    }

    public function getNNF()
    {
        return $this->nNF;
    }
     
    public function setNNF($nNF)
    {
        $this->nNF = $nNF;
        return $this;
    }

    public function getDhEmi()
    {
        return $this->dhEmi;
    }
     
    public function setDhEmi($dhEmi)
    {
        $this->dhEmi = $dhEmi;
        return $this;
    }

    public function getDhSaiEnt()
    {
        return $this->dhSaiEnt;
    }
     
    public function setDhSaiEnt($dhSaiEnt)
    {
        $this->dhSaiEnt = $dhSaiEnt;
        return $this;
    }

    public function getTpNF()
    {
        return $this->tpNF;
    }
     
    public function setTpNF($tpNF)
    {
        $this->tpNF = $tpNF;
        return $this;
    }

    public function getIdDest()
    {
        return $this->idDest;
    }
     
    public function setIdDest($idDest)
    {
        $this->idDest = $idDest;
        return $this;
    }

    public function getCMunFG()
    {
        return $this->cMunFG;
    }
     
    public function setCMunFG($cMunFG)
    {
        $this->cMunFG = $cMunFG;
        return $this;
    }

    public function getTpImp()
    {
        return $this->tpImp;
    }
     
    public function setTpImp($tpImp)
    {
        $this->tpImp = $tpImp;
        return $this;
    }

    public function getTpEmis()
    {
        return $this->tpEmis;
    }
     
    public function setTpEmis($tpEmis)
    {
        $this->tpEmis = $tpEmis;
        return $this;
    }

    public function getTpAmb()
    {
        return $this->tpAmb;
    }
     
    public function setTpAmb($tpAmb)
    {
        $this->tpAmb = $tpAmb;
        return $this;
    }

    public function getFinNFe()
    {
        return $this->finNFe;
    }
     
    public function setFinNFe($finNFe)
    {
        $this->finNFe = $finNFe;
        return $this;
    }

    public function getIndFinal()
    {
        return $this->indFinal;
    }
     
    public function setIndFinal($indFinal)
    {
        $this->indFinal = $indFinal;
        return $this;
    }    

    public function getIndPres()
    {
        return $this->indPres;
    }
     
    public function setIndPres($indPres)
    {
        $this->indPres = $indPres;
        return $this;
    }

    public function getProcEmi()
    {
        return $this->procEmi;
    }
     
    public function setProcEmi($procEmi)
    {
        $this->procEmi = $procEmi;
        return $this;
    }

    public function get()
    {
        return $this->verProc;
    }
     
    public function set($verProc)
    {
        $this->verProc = $verProc;
        return $this;
    }

    public function getDhCont()
    {
        return $this->dhCont;
    }
     
    public function setDhCont($dhCont)
    {
        $this->dhCont = $dhCont;
        return $this;
    }

    public function getXJust()
    {
        return $this->xJust;
    }
     
    public function setXJust($xJust)
    {
        $this->xJust = $xJust;
        return $this;
    }

    public function getAno()
    {
        return $this->ano;
    }
     
    public function setAno($ano)
    {
        $this->ano = $ano;
        return $this;
    }

    public function getMes()
    {
        return $this->mes;
    }
     
    public function setMes($mes)
    {
        $this->mes = $mes;
        return $this;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }
     
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    public function getChave()
    {
        return $this->chave;
    }
     
    public function setChave($chave)
    {
        $this->chave = $chave;
        return $this;
    }

    public function getVersao()
    {
        return $this->versao;
    }
     
    public function setVersao($versao)
    {
        $this->versao = $versao;
        return $this;
    }

    public function getResp()
    {
        return $this->resp;
    }
     
    public function setResp($resp)
    {
        $this->resp = $resp;
        return $this;
    }

}

