<?php
namespace App\classes;

use App\Models\notaitens;

/**
* Classe de iteração com a tabela NotaItens
*/
class InterItens 
{
	public function relacionar($conteudo, $i){

        $itens = new notaitens([
          'num_item'      => $i + 1,
          'produtos_id'   => $conteudo->item_id_item[$i],
          'qtd'           => $conteudo->item_qtd[$i],
          'unid'          => 'UND',
          'vl_item'       => $conteudo->item_vl_item[$i], 
          'vl_desc'       => 0,
          'ind_mov'       => '',
          'cst_icms'      => $conteudo->item_cst[$i], 
          'natop_id'      => $conteudo->item_id_natop[$i], 
          'cod_nat'       => '',
          'vl_bc_icms'    => $conteudo->item_vl_merc[$i],
          'aliq_icms'     => $conteudo->item_icms[$i],
          'vl_icms'       => $conteudo->item_vl_icms[$i],
          'vl_bc_icms_ST' => 0,
          'aliq_ST'       => 0,
          'vl_icms_st'    => 0,
          'ind_apur'      => '0',
          'cst_ipi'       => '02',
          'cod_enq'       => '',
          'vl_bc_ipi'     => 0,
          'aliq_ipi'      => 0,
          'vl_ipi'        => 0,
          'cst_pis'       => '03',
          'vl_bc_pis'     => $conteudo->item_vl_merc[$i],
          'aliq_pis'      => $conteudo->item_pis[$i],
          'quant_bc_pis'  => '',
          'vl_pis'        => $conteudo->item_vl_pis[$i],
          'cst_cofins'    => '03',
          'vl_bc_cofins'  => $conteudo->item_vl_merc[$i],
          'aliq_cofins'   => $conteudo->item_cofins[$i],
          'quant_bc_pis'  => '',
          'vl_cofins'     => $conteudo->item_vl_cofins[$i],
          'cod_conta'     => ''
        ]);
        return $itens;
	}
	public function igualhar($conteudo, $item, $i){

//        $itens->num_item      = $conteudo->num_item[$i];
//		dd($item->produtos_id);
        $item->produtos_id   = $conteudo->item_id_item[$i];
        $item->qtd           = $conteudo->item_qtd[$i];
        $item->unid          = $conteudo->item_unid[$i];
        $item->vl_item       = $conteudo->item_vl_item[$i]; 
        $item->vl_desc       = $conteudo->item_vl_desc[$i];
        $item->ind_mov       = $conteudo->item_ind_mov[$i];
        $item->cst_icms      = $conteudo->item_cst[$i]; 
        $item->natop_id      = $conteudo->item_id_natop[$i]; 
        $item->cod_nat       = $conteudo->cod_nat[$i];
        $item->vl_bc_icms    = $conteudo->item_vl_merc[$i];
        $item->aliq_icms     = $conteudo->item_icms[$i];
        $item->vl_icms       = $conteudo->item_vl_icms[$i];
        $item->vl_bc_icms_ST = $conteudo->vl_bc_icms_ST[$i];
        $item->aliq_ST       = $conteudo->aliq_ST[$i];
        $item->vl_icms_st    = $conteudo->vl_icms[$i];
        $item->ind_apur      = $conteudo->ind_apur[$i];
        $item->cst_ipi       = $conteudo->cst_ipi[$i];
        $item->cod_enq       = $conteudo->cod_enq[$i];
        $item->vl_bc_ipi     = $conteudo->vl_bc_ipi[$i];
        $item->aliq_ipi      = $conteudo->aliq_ipi[$i];
        $item->vl_ipi        = $conteudo->vl_ipi[$i];
        $item->cst_pis       = $conteudo->cst_pis[$i];
        $item->vl_bc_pis     = $conteudo->item_vl_merc[$i];
        $item->aliq_pis      = $conteudo->item_pis[$i];
        $item->quant_bc_pis  = $conteudo->quant_bc_pis[$i];
        $item->vl_pis        = $conteudo->item_vl_pis[$i];
        $item->cst_cofins    = $conteudo->cst_cofins[$i];
        $item->vl_bc_cofins  = $conteudo->vl_bc_cofins[$i];
        $item->aliq_cofins   = $conteudo->aliq_cofins[$i];
        $item->quant_bc_pis  = $conteudo->quant_bc_pis[$i];
        $item->cod_conta     = $conteudo->cod_conta[$i];
        
        return $item;
	}

}

