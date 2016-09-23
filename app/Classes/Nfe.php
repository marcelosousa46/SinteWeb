<?php
namespace App\Classes;

use NFePHP\NFe\MakeNFe;
use NFePHP\NFe\ToolsNFe;
use App\Models\emitente;

/**
* Nfe Gerar NFe.
*/
class Nfe
{
	public $nfe;
	public $nfeTools;
    
    function __construct() {

		$this->nfe      = new MakeNFe();
		$this->nfeTools = new ToolsNFe('../vendor/nfephp-org/nfephp/config/config.json');

    }

	public function getnfe($nota)
	{
        $emitente = emitente::find(1);
        
		$cUF      = $emitente->cuf;
		$natOp    = $nota->natop->descricao;
		$indPag   = $nota->ind_pagto;
		$dhSaiEnt = $nota->dt_e_es;
		$cnpj     = $this->nfeTools->aConfig['cnpj'];
		$ano      = date('y',strtotime($nota->dt_doc));
		$mes      = date('m',strtotime($nota->dt_doc));
		$mod      = $nota->cod_mod;
		$serie    = $nota->ser;
		$nNF      = $nota->num_doc;
		$dhEmi    = $nota->dt_doc;
		$tpEmis   = $nota->tpemis;
		$tpAmb    = '2';
		$tpNF     = '1';
		$tpImp    = '1';
		$idDest   = '1';
		$cMunFG   = $emitente->cmun;
		$finNFe   = '1';
		$indFinal = '0';
		$indPres  = '9';
		$procEmi  = '0';
		$verProc  = '1.0.0'; 
        $dhCont   = ''; 
        $xJust    = ''; 
		$cNF      = str_pad($nota->num_doc, 8, "0", STR_PAD_LEFT);
        $chave    = $this->nfe->montaChave($cUF, $ano, $mes, $cnpj, $mod, $serie, $nNF, $tpEmis, $cNF);
		$versao   = '3.10';
		$resp     = $this->nfe->taginfNFe($chave, $versao);
		$cDV      = substr($chave, -1);
		$resp     = $this->nfe->tagide($cUF, $cNF, $natOp, $indPag, $mod, $serie, $nNF, $dhEmi, $dhSaiEnt, 
			                           $tpNF, $idDest, $cMunFG, $tpImp, $tpEmis, $cDV, $tpAmb, $finNFe, 
			                           $indFinal, $indPres, $procEmi, $verProc, $dhCont, $xJust);

		//Dados do emitente - (Importando dados do config.json)
		$CNPJ  = $this->nfeTools->aConfig['cnpj'];
		$CPF   = ''; // Utilizado para CPF na nota
		$xNome = $this->nfeTools->aConfig['razaosocial'];
		$xFant = $this->nfeTools->aConfig['nomefantasia'];
		$IE    = $this->nfeTools->aConfig['ie'];
		$IEST  = $this->nfeTools->aConfig['iest'];
		$IM    = $this->nfeTools->aConfig['im'];
		$CNAE  = $this->nfeTools->aConfig['cnae'];
		$CRT   = $this->nfeTools->aConfig['regime'];
		$resp  = $this->nfe->tagemit($CNPJ, $CPF, $xNome, $xFant, $IE, $IEST, $IM, $CNAE, $CRT);

		//endereço do emitente
		$xLgr    = $emitente->xlgr;
		$nro     = $emitente->nro;
		$xCpl    = $emitente->xcpl;
		$xBairro = $emitente->bairro;
		$cMun    = $emitente->cmun;
		$xMun    = $emitente->xmun;
		$UF      = $emitente->uf;
		$CEP     = $emitente->cep;
		$cPais   = $emitente->cpais;
		$xPais   = $emitente->xpais;
		$fone    = $emitente->fone;
		$resp    = $this->nfe->tagenderEmit($xLgr, $nro, $xCpl, $xBairro, $cMun, $xMun, $UF, $CEP, $cPais, $xPais, $fone);

		//destinatário
		$CNPJ          = $nota->participante->cnpj;
		$CPF           = '';
		$idEstrangeiro = '';
		$xNome         = $nota->participante->nome;
		$indIEDest     = $nota->participante->ie;
		$IE            = '';
		$ISUF          = '';
		$IM            = '2300309';
		$email         = 'marcelosousa46@gmail.com';
		$resp          = $this->nfe->tagdest($CNPJ, $CPF, $idEstrangeiro, $xNome, $indIEDest, $IE, $ISUF, $IM, $email);

		//Endereço do destinatário
		$xLgr    = $nota->participante->enderco;
		$nro     = $nota->participante->numero;
		$xCpl    = $nota->participante->complemento;
		$xBairro = $nota->participante->bairro;
		$cMun    = '2300309';
		$xMun    = 'Acopiara';
		$UF      = 'CE';
		$CEP     = '63560000';
		$cPais   = '1058';
		$xPais   = 'Brasil';
		$fone    = '8835650540';
		$resp    = $this->nfe->tagenderDest($xLgr, $nro, $xCpl, $xBairro, $cMun, $xMun, $UF, $CEP, $cPais, $xPais, $fone);

		//produtos 
		foreach ($nota->itens as $prod) {
		    $nItem    = $prod->num_item;
		    $cProd    = $prod->produtos->codigo;
		    $cEAN     = $prod->produtos->codigo_barra;
		    $xProd    = $prod->produtos->descricao;
		    $NCM      = $prod->produtos->ncm->codigo;
		    $NVE      = '';
		    $CEST     = '';
		    $EXTIPI   = '';
		    $CFOP     = $prod->natop->codigo;
		    $uCom     = $prod->produtos->unidade->codigo; // $prod['uCom'];
		    $qCom     = $prod->qtd;
		    $vUnCom   = $prod->vl_item;
		    $vProd    = $prod->vl_item * $prod->qtd; // todo trocar criar vl_merc
		    $cEANTrib = '';
		    $uTrib    = $prod->produtos->unidade->codigo;
		    $qTrib    = $prod->qtd;
		    $vUnTrib  = $prod->vl_item;
		    $vFrete   = '';
		    $vSeg     = '';
		    $vDesc    = '';
		    $vOutro   = '';
		    $indTot   = '1';
		    $xPed     = '';
		    $nItemPed = '';
		    $nFCI     = '';
		    $resp     = $this->nfe->tagprod($nItem, $cProd, $cEAN, $xProd, $NCM, $NVE, $CEST, $EXTIPI, $CFOP, $uCom, 
		    	                            $qCom, $vUnCom, $vProd, $cEANTrib, $uTrib, $qTrib, $vUnTrib, $vFrete, $vSeg,
		    	                            $vDesc, $vOutro, $indTot, $xPed, $nItemPed, $nFCI);
		}

//        dd($resp);

		//monta a NFe e retorna na tela
		$resp = $this->nfe->montaNFe();

		if ($resp) {
		    $xml = $this->nfe->getXML();
		    // $filename = "/var/www/nfe/homologacao/entradas/{$chave}-nfe.xml"; // Ambiente Linux
            dd($xml);
		    $filename = "C:/xampp/htdocs/nfephp/xmls/NF-e/homologacao/entradas/{$chave}-nfe.xml"; // Ambiente Windows
		    file_put_contents($filename, $xml);
		//    chmod($filename, 0777);
		    echo $xml;
		} else {
		    header('Content-type: text/html; charset=UTF-8');
		    foreach ($nfe->erros as $err) {
		        echo 'tag: &lt;'.$err['tag'].'&gt; ---- '.$err['desc'].'<br>';
		    }
		}


	    return json_encode($resp);
	}
}