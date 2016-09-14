"use restrict";

$(document).ready(function(){
  $('.guiMoneyMask').bind('input',function(){
    guiMoneyMask();
     
    // Exemplo get float:
    var value = getGuiMoneyFloat(1);
    $('#guiMoneyFloat').html(value);
  });

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
         $('#cfop').focus();
         return item;
      }
  });
  
});
// Butões da Inclusão do item da nota
$(".btnExcluir").bind("click", Excluir);
$("#btnAdicionar").bind("click", Adicionar); 
//**
// Funções JS
//**
// Funções da Itens da nota fiscal
function Adicionar(){
  var cod_item  = $("#cod_item").val();
  var descricao = $("#descricao").val();
  var qtd       = $("#qtd").val();
  var vl_item   = $("#vl_item").val();
  var id_item   = $("#id_item").val();
  var id_natop  = $("#id_natop").val();
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
    $("#vl_merc").trigger('focus');
    $('#cod_item').focus();
  } else {  
    $('.mensagem').removeClass('visible');
    $('.mensagem').addClass('hidden');
    $("#tblCadastro tbody").append(
      "<tr>"+
      "<td>"+cod_item+"</td>"+
      "<td>"+descricao+"</td>"+
      "<td class='text-right'>"+qtd+"</td>"+
      "<td class='text-right'>"+vl_item+"</td>" +
      "<td><button class='btnExcluir btn btn-default btn-xs' type='button'><span class='glyphicon glyphicon-remove'></span></button></td>"+
      "</tr>");

    // Preencher aba de totalizações
    //***
    // Soma o valor da mercadorias após inclusão do item
    $("#vl_merc").val(getValorMercadoria($("#vl_item").val(),$("#qtd").val()));
    //***
    // Soma o valor da quantidade após inclusão do item
    $("#qtd_item").val(getTotalItens($("#qtd").val()));
    //***
    $('#vl_merc').maskMoney('mask')
    $('#qtd_item').maskMoney('mask')
    // Limpar campos após inclusão
    $("#cod_item").val("");
    $("#descricao").val("");
    $("#qtd").val("");
    $("#vl_item").val("");
    $('#cod_item').focus();
    //***
    $(".btnExcluir").bind("click", Excluir);
  }
};
function Excluir(){
    var par = $(this).parent().parent(); //tr
    par.remove();
    // Diminue o valor da mercadorias após exclusão do item
    $("#vl_merc").val(parseFloat($("#vl_merc").val()) - (getValorMercadoria($("#vl_item").val(),$("#qtd").val())));
    //***
    // Diminue a quantidade do item após exclusão do item
    $("#qtd_item").val((parseFloat($("#qtd_item").val())-getTotalItens($("#qtd").val())));
    //***
    $('#vl_merc').maskMoney('mask')
    $('#qtd_item').maskMoney('mask')
    $('#cod_item').focus();

};
function getValorMercadoria(valor,qtde)
{
  return parseFloat(valor)*parseFloat(qtde)*100;
}
function getTotalItens(qtde)
{
  return parseFloat($("#qtd_item").val())+parseFloat(qtde)*100;
}
function getBaseCalculo(){

}
function getValorIcms(){

}
function getGuiMoneyFloat()
{
        var money = guiMoneyMask(1);
        
         if(!money){
          return 0;
        }
        money = money.replace(",",".");
        
        return parseFloat( money );
}
function guiMoneyMask(getMoney)
{
    var icon = "R$";
   
    
    icon += " ";
    var money = $(".guiMoneyMask").val();
   
    money = money.replace(icon,"");
    money = money.replace(" ","");
    
    money = money.replace(",","");
    money = money.replace(".","");
    
    if(money === ""){
      return;
    }
    if(isNaN(money)){
      $(".guiMoneyMask").val("");
      return;
    }
    
    $(".guiMoneyMask").val("");
   
   var aux = money+'';
      
    if(aux.length < 3){
      aux = aux.replace(/([0-9]{2})$/g, "0,$1");
    } else if(aux.length > 2){
      aux = aux.replace(/([0-9]{2})$/g, ",$1");
    }
    
    if(aux.length > 2){
        var tmp = aux.split(",");
        aux = parseInt(tmp[0])+","+tmp[1];
       
    }
    
   
    
    $(".guiMoneyMask").val(icon+aux);
     if(getMoney === 1){
      return aux;
    }
}

                