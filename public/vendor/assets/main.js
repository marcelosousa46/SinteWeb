"use restrict";

$(document).ready(function(){
  // Alerta para mensagens
  $(".alert").fadeTo(4000, 0.4).slideUp(700, function(){
    $(".alert").alert('close');
  });

  // Pesquisa pelo descrição da natureza da operação
  $('#natop_descricao').typeahead({
      source:  function (query, process) {
      var path = "../../../natop/autocomplete";    
      return $.get(path, { query: query }, function (data) {
              return process(data);
          });
      },
      updater: function (item) {
         $('#natop_descricao').val(item.name);
         $('#cfop').val(item.codigo);
         $('#id_natop').val(item.id);
         $('#cfop').focus();
         return item;
      }
  });

  // Pesquisa pelo descrição da natureza da operação - natop
  $('#natop').typeahead({
      source:  function (query, process) {
      var path = "../../../natop/autocomplete";    
      return $.get(path, { query: query }, function (data) {
              return process(data);
          });
      },
      updater: function (item) {
         $('#natop').val(item.name);
         $('#natop_id').val(item.id);
         $('#qtd').focus();
         return item;
      }
  });

  // Pesquisa pelo codigo da natureza
  $('#cfop').typeahead({
      source:  function (query, process) {
      var path = "../../../natop/codigo";    
      return $.get(path, { query: query }, function (data) {
              return process(data);
          });
      },
      updater: function (item) {
         $('#cfop').val(item.name);
         $('#natop_descricao').val(item.descricao);
         $('#id_natop').val(item.id);
         $('#vl_item').maskMoney('mask');
         $('#aliq_icms').maskMoney('mask');
         $('#qtd').focus();
         return item;
      }
  });
  
  // Pesquisa pelo descricao do produto
  $('#descricao').typeahead({
      source:  function (query, process) {
      var path = "../../../produtos/autocomplete";    
      return $.get(path, { query: query }, function (data) {
              return process(data);
          });
      },
      updater: function (item) {
         $('#descricao').val(item.name);
         $('#cod_item.tagCodProduto').val(item.codigo);
         $('#id_item').val(item.id);
         $('#vl_item').val(item.preco_venda);
         $('#cst').val(item.cst);
         $('#icms').val(item.icms);
         $('#pis').val(item.pis);
         $('#cofins').val(item.cofins);
         $('#vl_item').maskMoney('mask');
         $('#aliq_icms').maskMoney('mask');
         $('#cfop').focus();
         return item;
      }
  });

  // Pesquisa pelo codigo do produto
  $('#cod_item').typeahead({
      source:  function (query, process) {
      var path = "../../../produtos/codigo";    
      return $.get(path, { query: query }, function (data) {
              return process(data);
          });
      },
      updater: function (item) {
         $('#cod_item').val(item.name);
         $('#descricao').val(item.descricao);
         $('#id_item').val(item.id);
         $('#aliq_icms').val(item.icms);
         $('#vl_item').val(item.preco_venda);
         $('#cst').val(item.cst);
         $('#icms').val(item.icms);
         $('#pis').val(item.pis);
         $('#cofins').val(item.cofins);
         $('#vl_item').maskMoney('mask');
         $('#aliq_icms').maskMoney('mask');
         $('#cfop').focus();
         return item;
      }
  });

  // Pesquisa pelo codigo do participante
  $('#cli_cod').typeahead({
      source:  function (query, process) {
      var path = "../../../participante/codigo";    
      return $.get(path, { query: query }, function (data) {
              return process(data);
          });
      },
      updater: function (item) {
         $('#clie_cod').val(item.name);
         $('#cli_nome').val(item.nome);
         $('#participante_id').val(item.id);
         $('#cli_cod').focus();
         return item;
      }
  });

  // Pesquisa pelo nome do participante
  $('#cli_nome').typeahead({
      source:  function (query, process) {
      var path = "../../../participante/nome";    
      return $.get(path, { query: query }, function (data) {
              return process(data);
          });
      },
      updater: function (item) {
         $('#cli_cod').val(item.codigo);
         $('#cli_nome').val(item.name);
         $('#participante_id').val(item.id);
         $('#cli_cod').focus();
         return item;
      }
  });

  
});
// Butões da manutenção do item da nota
$(".btnExcluir").bind("click", Excluir);
$("#btnAdicionar").bind("click", Adicionar); 
//**
// Funções JS
//**
// Funções da Itens da nota fiscal
function Adicionar(){
  var cod_item    = $("#cod_item").val();
  var descricao   = $("#descricao").val();
  var qtd         = $("#qtd").maskMoney('unmasked')[0];
  var vl_item     = $("#vl_item").maskMoney('unmasked')[0];
  var id_item     = $("#id_item").val();
  var id_natop    = $("#id_natop").val();
  var cst         = $("#cst").val();
  var icms        = $("#icms").maskMoney('unmasked')[0];
  var pis         = $("#pis").maskMoney('unmasked')[0];
  var cofins      = $("#cofins").maskMoney('unmasked')[0];
  var vl_merc     = $("#qtd").maskMoney('unmasked')[0] *
                    $("#vl_item").maskMoney('unmasked')[0];
  var vl_doc      = vl_merc;                  
  var id_variavel = Math.floor((Math.random() * 100) + 1) + cod_item;
  
  if ( cst == '00'){
     var vl_bc_icms = vl_merc;
     var vl_icms    = (vl_bc_icms * icms / 100);
     var vl_pis     = (vl_bc_icms * pis / 100);
     var vl_cofins  = (vl_bc_icms * cofins / 100);

  } else {
     var vl_bc_icms = 0;
     var vl_icms    = 0;
     var vl_pis     = 0;
     var vl_cofins  = 0;

  }               

  $.ajax({
      type: "GET",
      url: '../../../produtos/id/'+id_item, 
      success: function (result) {
          if (Object.keys(result).length > 0){
             $("#id_item").val(result.id);
             $("#aliq_icms").val(result.icms);
          }
      },
      });
  $.ajax({
      type: "GET",
      url: '../../../natop/id/'+id_natop, 
      success: function (result) {
          if (Object.keys(result).length > 0){
             $("#id_natop").val(result.id);
          }
      },
      });

  if ($("#id_item").val() == 0 || $("#id_natop").val() == 0 || cod_item == "" || descricao == "" || qtd == "" || vl_item == "" ) {
    $('.mensagem').removeClass('hidden');
    $('.mensagem').addClass('visible');
    $("#mensagem").text('Campos com valores inválidos!');
    $('#cod_item').focus();
  } else {  
    $('.mensagem').removeClass('visible');
    $('.mensagem').addClass('hidden');
    $("#tblCadastro tbody").append(
      "<tr>"+
      "<td>"+cod_item+"</td>"+
      "<td>"+descricao+"</td>"+
      "<td class='text-right'>"+$('#qtd').val()+"</td>"+
      "<td class='text-right'>"+$('#vl_item').val()+"</td>" +
      "<td style='display:none'>"+vl_merc+"</td>" +
      "<td style='display:none'>"+vl_bc_icms+"</td>" +
      "<td style='display:none'>"+vl_icms+"</td>" +
      "<td style='display:none'>"+vl_pis+"</td>" +
      "<td style='display:none'>"+vl_cofins+"</td>" +
      "<td><button id='" + id_variavel +"' class='btnExcluir btn btn-default btn-xs' type='button'><span class='glyphicon glyphicon-remove'></span></button></td>"+
      "</tr>");

    // Preencher aba de totalizações
    //***
    // Soma o valor da mercadorias após inclusão do item
    $("#vl_merc").maskMoney('mask',($("#vl_merc").maskMoney('unmasked')[0] + vl_merc));
    //***
    // Soma o valor do documento após inclusão do item
    $("#vl_doc").maskMoney('mask',($("#vl_doc").maskMoney('unmasked')[0] + vl_merc));
    //***
    // Soma o valor da quantidade após inclusão do item
    $("#qtd_item").maskMoney('mask',($("#qtd_item").maskMoney('unmasked')[0] + 1)); 
    //***
    // Soma a base de calculo após inclusão do item
    $("#vl_bc_icms").maskMoney('mask',($("#vl_bc_icms").maskMoney('unmasked')[0] + vl_bc_icms));
    //***
    // Soma o icms após inclusão do item
    $("#vl_icms").maskMoney('mask',($("#vl_icms").maskMoney('unmasked')[0] + vl_icms));
    //***
    // Soma o pis após inclusão do item
    $("#vl_pis").maskMoney('mask',($("#vl_pis").maskMoney('unmasked')[0] + vl_pis));
    //***
    // Soma o cofins após inclusão do item
    $("#vl_cofins").maskMoney('mask',($("#vl_cofins").maskMoney('unmasked')[0] + vl_cofins));
    //***
    // Limpar campos após inclusão
    $("#cod_item").val("");
    $("#descricao").val("");
    $("#qtd").val("0,00");
    $("#vl_item").val("0,00");
    $('#cod_item').focus();
    //***
    // Exibir mascaras
    $('#qtd').maskMoney('mask');
    $('#vl_item').maskMoney('mask');
    $('#vl_merc').maskMoney('mask');
    $('#vl_doc').maskMoney('mask');
    $('#qtd_item').maskMoney('mask');
    $('#vl_bc_icms').maskMoney('mask');
    $('#vl_icms').maskMoney('mask');
    $('#vl_pis').maskMoney('mask');
    $('#vl_cofins').maskMoney('mask');
    $('#td_qtd').maskMoney('mask');
    $('#td_vl_item').maskMoney('mask');
    $("#tab2primary").append(
      "<input type='text' name='item_id_item[]' id='id_item"+ id_variavel + "' value='" + id_item + "' class='hidden'/>" +
      "<input type='text' name='item_vl_item[]' id='vl_item"+ id_variavel + "' value='" + vl_item + "' class='hidden'/>" +
      "<input type='text' name='item_qtd[]' id='qtd"+ id_variavel + "' value='" + qtd + "' class='hidden'/>" +
      "<input type='text' name='item_vl_icms[]' id='vl_icms"+ id_variavel + "' value='" + vl_icms + "' class='hidden'/>" +
      "<input type='text' name='item_vl_pis[]' id='vl_pis"+ id_variavel + "' value='" + vl_pis + "' class='hidden'/>" +
      "<input type='text' name='item_vl_cofins[]' id='vl_cofins"+ id_variavel + "' value='" + vl_cofins + "' class='hidden'/>" +
      "<input type='text' name='item_vl_merc[]' id='vl_merc"+ id_variavel + "' value='" + vl_merc +"' class='hidden'/>" +
      "<input type='text' name='item_cst[]' id='cst"+ id_variavel + "' value='" + cst +"' class='hidden'/>" +
      "<input type='text' name='item_id_natop[]' id='id_natop"+ id_variavel + "' value='" + id_natop +"' class='hidden'/>" +
      "<input type='text' name='item_icms[]' id='icms"+ id_variavel + "' value='" + icms + "' class='hidden'/>" +
      "<input type='text' name='item_pis[]' id='pis"+ id_variavel + "' value='" + pis + "' class='hidden'/>" +
      "<input type='text' name='item_cofins[]' id='cofins"+ id_variavel + "' value='" + cofins + "' class='hidden'/>"
      );

    //***
    $('#'+id_variavel).bind("click", Excluir);
  }
};
function Excluir(){
    var par = $(this).parent().parent(); //tr
    var vl_merc    = par.children("td:nth-child(5)");
    var vl_bc_icms = par.children("td:nth-child(6)");
    var vl_icms    = par.children("td:nth-child(7)");
    var vl_pis     = par.children("td:nth-child(8)");
    var vl_cofins  = par.children("td:nth-child(9)");
    
    par.remove();
    // Diminue o valor da mercadorias após exclusão do item
    $("#vl_merc").maskMoney('mask',($("#vl_merc").maskMoney('unmasked')[0] - parseFloat(vl_merc.html())));
    //***
    // Diminue o valor do documento após exclusão do item
    $("#vl_doc").maskMoney('mask',($("#vl_doc").maskMoney('unmasked')[0] - parseFloat(vl_merc.html())));
    //***
    // Diminue a quantidade do item após exclusão do item
    $("#qtd_item").maskMoney('mask',($("#qtd_item").maskMoney('unmasked')[0] - 1)); 
    //***
    // Diminue o valor da Base de calculo após exclusão do item
    $("#vl_bc_icms").maskMoney('mask',($("#vl_bc_icms").maskMoney('unmasked')[0] - parseFloat(vl_bc_icms.html())));
    //***
    // Diminue o valor do icms após exclusão do item
    $("#vl_icms").maskMoney('mask',($("#vl_icms").maskMoney('unmasked')[0] - parseFloat(vl_icms.html())));
    //***
    // Diminue o valor do pis após exclusão do item
    $("#vl_pis").maskMoney('mask',($("#vl_pis").maskMoney('unmasked')[0] - parseFloat(vl_pis.html())));
    //***
    // Diminue o valor do cofins após exclusão do item
    $("#vl_cofins").maskMoney('mask',($("#vl_cofins").maskMoney('unmasked')[0] - parseFloat(vl_cofins.html())));
    //***
    $('#cod_item').focus();
    // Exibir mascaras
    $('#vl_merc').maskMoney('mask');
    $('#vl_doc').maskMoney('mask');
    $('#qtd_item').maskMoney('mask');
    $('#vl_bc_icms').maskMoney('mask');
    $('#vl_icms').maskMoney('mask');
    $('#vl_pis').maskMoney('mask');
    $('#vl_cofins').maskMoney('mask');
    //***
};
// Mascaras
$('.mascara-monetaria').maskMoney({prefix:'',allowNegative: false,allowZero:true,defaultZero:true,thousands:'.', decimal:',',affixesStay: true});
$('.mascara-percent4').maskMoney({prefix:'',precision:4,allowNegative: false,allowZero:true,defaultZero:true,thousands:'.', decimal:',',affixesStay: true});

                