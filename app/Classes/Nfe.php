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
	private $nfe;
	private $nfeTools;

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
		$dhEmi    = date("Y-m-d\TH:i:sP",strtotime($nota->dt_doc));
		$dhSaiEnt = date("Y-m-d\TH:i:sP",strtotime($nota->dt_doc));
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
		$xLgr    = $emitente->xLgr;
		$nro     = $emitente->nro;
		$xCpl    = $emitente->xcpl;
		$xBairro = $emitente->xbairro;
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
		$indIEDest     = '1';
		$IE            = $nota->participante->ie;
		$ISUF          = '';
		$IM            = '2300309';
		$email         = 'marcelosousa46@gmail.com';
		$resp          = $this->nfe->tagdest($CNPJ, $CPF, $idEstrangeiro, $xNome, $indIEDest, $IE, $ISUF, $IM, $email);

		//Endereço do destinatário
		$xLgr    = $nota->participante->endereco;
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
		    $uCom     = $prod->produtos->unidade->codigo;
		    $qCom     = $prod->qtd;
		    $vUnCom   = $prod->vl_item;
		    $vProd    =  number_format($prod->vl_item * $prod->qtd, 2, '.', ''); // todo trocar criar vl_merc
		    $cEANTrib = '';
		    $uTrib    = $prod->produtos->unidade->codigo;
		    $qTrib    = '1';
		    $vUnTrib  = $prod->vl_item;
		    $vFrete   = '';
		    $vSeg     = '';
		    $vDesc    = '';
		    $vOutro   = '';
		    $indTot   = '1';
		    $xPed     = '';
		    $nItemPed = '';
		    $nFCI     = '';
		    $resp     = $this->nfe->tagprod($nItem, $cProd, $cEAN, $xProd, $NCM, $NVE, $CEST, $EXTIPI, $CFOP, $uCom,$qCom, $vUnCom, $vProd, $cEANTrib, $uTrib, $qTrib, $vUnTrib, $vFrete, $vSeg, $vDesc, $vOutro, $indTot, $xPed, $nItemPed, $nFCI);

//				$resp = $this->nfe->montaNFe();
//				$xml = $this->nfe->getXML();
//				dd($xml);
				//Impostos
				$nItem    = $prod->num_item;
				$vTotTrib = $prod->vl_icms + $prod->vl_icms_st + $prod->vl_pis + $prod->vl_cofins + $prod->vl_ipi; //'449.90'; // 226.80 ICMS + 51.50 ICMSST + 50.40 IPI + 39.36 PIS + 81.84 CONFIS
				$resp = $this->nfe->tagimposto($nItem, $vTotTrib);

				//ICMS - Imposto sobre Circulação de Mercadorias e Serviços
				$nItem = $prod->num_item;
				$orig  = '0';
				$cst   = '00'; //  $prod->produtos->cst_icms
				if ($cst == '00')
				{
					 $modBC      = '3';
					 $pRedBC     = '';
					 $vBC        = $prod->vl_bc_icms;
					 $pICMS      = $prod->aliq_icms;
					 $vICMS      = $prod->vl_icms;
					 $vICMSDeson = '';
					 $motDesICMS = '';
					 $modBCST    = '';
					 $pMVAST     = '';
					 $pRedBCST   = '';
					 $vBCST      = '';
					 $pICMSST    = '';
					 $vICMSST    = '';
					 $pDif       = '';
					 $vICMSDif   = '';
					 $vICMSOp    = '';
					 $vBCSTRet   = '';
					 $vICMSSTRet = '';
					 $resp       = $this->nfe->tagICMS($nItem, $orig, $cst, $modBC, $pRedBC, $vBC, $pICMS, $vICMS, $vICMSDeson, $motDesICMS, $modBCST, $pMVAST, $pRedBCST, $vBCST, $pICMSST, $vICMSST, $pDif, $vICMSDif, $vICMSOp, $vBCSTRet, $vICMSSTRet);
 			  }
				if ($cst == '10')
				{
					$modBC      = '3';
					$pRedBC     = '';
					$vBC        = $prod->vl_bc_icms;
					$pICMS      = $prod->aliq_icms;
					$vICMS      = $prod->vl_icms;
					$vICMSDeson = '';
					$motDesICMS = '';
					$modBCST    = '5'; // Calculo Por Pauta (valor)
					$pMVAST     = '';
					$pRedBCST   = '';
					$vBCST      = $prod->vl_bc_icms_ST;
					$pICMSST    = $prod->alis_st;
					$vICMSST    = $prod->vl_icms_ST;
					$pDif       = '';
					$vICMSDif   = '';
					$vICMSOp    = '';
					$vBCSTRet   = '';
					$vICMSSTRet = '';
					$resp       = $this->nfe->tagICMS($nItem, $orig, $cst, $modBC, $pRedBC, $vBC, $pICMS, $vICMS, $vICMSDeson, $motDesICMS, $modBCST, $pMVAST, $pRedBCST, $vBCST, $pICMSST, $vICMSST, $pDif, $vICMSDif, $vICMSOp, $vBCSTRet, $vICMSSTRet);

					$vST = $vICMSST; // Total de ICMS ST

					//IPI - Imposto sobre Produto Industrializado
					$cst      = '52'; // 50 - Saída Isenta (Código da Situação Tributária)
					$clEnq    = '';
					$cnpjProd = '';
					$cSelo    = '';
					$qSelo    = '';
					$cEnq     = '999';
					$vBC      = '0.00';
					$pIPI     = '0.00';
					$qUnid    = '';
					$vUnid    = '';
					$vIPI     = '0.00';
					$resp = $this->nfe->tagIPI($nItem, $cst, $clEnq, $cnpjProd, $cSelo, $qSelo, $cEnq, $vBC, $pIPI, $qUnid, $vUnid, $vIPI);

					//PIS - Programa de Integração Social
					$cst       = $prod->cst_pis;
					$vBC       = '';
					$pPIS      = '';
					$vPIS      = $prod->vl_pis;
					$qBCProd   = $prod->vl_bc_pis;
					$vAliqProd = $prod->aliq_pis;
					$resp      = $this->nfe->tagPIS($nItem, $cst, $vBC, $pPIS, $vPIS, $qBCProd, $vAliqProd);

					//COFINS - Contribuição para o Financiamento da Seguridade Social
					$cst       = $prod->cst_cofins;
					$vBC       = '';
					$pCOFINS   = '';
					$vCOFINS   = $prod->vl_confins;
					$qBCProd   = $prod->vl_bc_cofins;
					$vAliqProd = $prod->aliq_cofins;
					$resp = $this->nfe->tagCOFINS($nItem, $cst, $vBC, $pCOFINS, $vCOFINS, $qBCProd, $vAliqProd);
				}
		}
		//Inicialização de váriaveis não declaradas...
		$vII     = isset($vII) ? $vII : 0;
		$vIPI    = isset($vIPI) ? $vIPI : 0;
		$vIOF    = isset($vIOF) ? $vIOF : 0;
		$vPIS    = isset($vPIS) ? $vPIS : 0;
		$vCOFINS = isset($vCOFINS) ? $vCOFINS : 0;
		$vICMS   = isset($vICMS) ? $vICMS : 0;
		$vBCST   = isset($vBCST) ? $vBCST : 0;
		$vST     = isset($vST) ? $vST : 0;
		$vISS    = isset($vISS) ? $vISS : 0;

		//total
		$vBC        = $nota->vl_bc_icms;
		$vICMS      = $nota->vl_icms;
		$vICMSDeson = '0.00';
		$vBCST      = $nota->vl_bc_icms_st;
		$vST        = $nota->vl_icms_st;
		$vProd      = $nota->vl_doc;
		$vFrete     = '0.00';
		$vSeg       = '0.00';
		$vDesc      = '0.00';
		$vII        = '0.00';
		$vIPI       = '0.00';
		$vPIS       = $nota->vl_pis;
		$vCOFINS    = $nota->vl_cofins;
		$vOutro     = '0.00';
		$vNF        = number_format($vProd-$vDesc-$vICMSDeson+$vST+$vFrete+$vSeg+$vOutro+$vII+$vIPI, 2, '.', '');
		$vTotTrib   = number_format($vICMS+$vST+$vII+$vIPI+$vPIS+$vCOFINS+$vIOF+$vISS, 2, '.', '');
		$resp       = $this->nfe->tagICMSTot($vBC, $vICMS, $vICMSDeson, $vBCST, $vST, $vProd, $vFrete, $vSeg, $vDesc, $vII, $vIPI, $vPIS, $vCOFINS, $vOutro, $vNF, $vTotTrib);

		//frete
		$modFrete = '0'; //0=Por conta do emitente; 1=Por conta do destinatário/remetente; 2=Por conta de terceiros; 9=Sem Frete;
		$resp     = $this->nfe->tagtransp($modFrete);

		// Calculo de carga tributária similar ao IBPT - Lei 12.741/12
		$federal  = number_format($vII+$vIPI+$vIOF+$vPIS+$vCOFINS, 2, ',', '.');
		$estadual  = number_format($vICMS+$vST, 2, ',', '.');
		$municipal = number_format($vISS, 2, ',', '.');
		$totalT    = number_format($federal+$estadual+$municipal, 2, ',', '.');
		$textoIBPT = "Valor Aprox. Tributos R$ {$totalT} - {$federal} Federal, {$estadual} Estadual e {$municipal} Municipal.";

		//Informações Adicionais
		//$infAdFisco = "SAIDA COM SUSPENSAO DO IPI CONFORME ART 29 DA LEI 10.637";
		$infAdFisco = "";
		$infCpl     = "Pedido Nº16 - {$textoIBPT} ";
		$resp       = $this->nfe->taginfAdic($infAdFisco, $infCpl);

//        dd($resp);

		//monta a NFe e retorna na tela
		$resp = $this->nfe->montaNFe();
		if ($resp) {
		    $xml = $this->nfe->getXML();
				// Assinar XML
				$assinar = new nfeAssinar;
				$xml = $assinar->getAssinar($chave, $xml);
				// Validar XML
				$validar = new nfeValidar;
				$resp = $validar->getValidar($chave,$tpAmb,$xml);
				if (!is_array($resp)) {
					// $filename = "/var/www/nfe/homologacao/entradas/{$chave}-nfe.xml"; // Ambiente Linux
			    $filename = "C:/xampp/htdocs/laravel/sinteweb/vendor/nfephp-org/nfephp/xmls/NF-e/homologacao/entradas/{$chave}-nfe.xml"; // Ambiente Windows
			    file_put_contents($filename, $xml);
			    // chmod($filename, 0777);
				} else {
					return $resp;
				};
		} else {
		    return $resp;
		}
	}
}
