// Bloqueando caracteres alfanumericos e CTRL+V e clique direito nos campos
$(document).ready(function(){
    $('#nr_cartao').bind('keydown',SomenteNumero);
    $('#cod_seg').bind('keydown',SomenteNumero);
    $('#mes_cartao').bind('keydown',SomenteNumero);
    $('#ano_cartao').bind('keydown',SomenteNumero);    
    
    $("#nr_cartao").bind("contextmenu",function(e){
        e.preventDefault();
        return false;
    });
    
    $("#cod_seg").bind("contextmenu",function(e){
        e.preventDefault();
        return false;
    });
    
    $("#mes_cartao").bind("contextmenu",function(e){
        e.preventDefault();
        return false;
    });
    
    $("#ano_cartao").bind("contextmenu",function(e){
        e.preventDefault();
        return false;
    });
});

// Permitir somente numeros e bloquear CTRL+V no campo
function SomenteNumero(e){        
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which < 96 || e.which > 105)) {
            return false;
    }
}

// Calculando parcelamento
$(document).ready(function(){            
    $.fn.parcelamento = function(bandeira,parcelas,operacao){        
        var html  = "<div><span>Calculando parcelamento ...</span>";
            html += "<img style='float: right; width: 75px;' src='image/cielo/"+bandeira+".jpg' />";
            html += "</div>";
        var a = $.floatingMessage(html,{
                    position : "bottom-right",
                    className : ""
        });
        $.ajax({
            url: 'index.php?route=payment/smcielopageloja/parcelamento&bandeira='+bandeira+'&parcelas='+parcelas+'&operacao='+operacao,
            type: 'GET',
            async: true,
            cache: false,            
            dataType: 'html',
            error: function(retorno){
                alert(retorno);
            },
            success: function(data) {
              $('#parcelas').html(data);                              
            }
        }).done(function(){        
           setTimeout(function(){
                a.floatingMessage("destroy");
           },1000);           
        });     
        
    }
    
    $("#bandeira").change(function(){        
        var bandeira = $("#bandeira").val();
        var parcelas = $('option:selected', this).attr('parc');
        var operacao = $('option:selected', this).attr('op');
        $(this).parcelamento(bandeira,parcelas,operacao);
                     
    });

    
    $("#formulario").submit(function(){
        var html =  "<div style='text-align: center;'>"
            html += "<img style='width: 45px; float: left;' src='image/processa.gif' />";
            html += "<br /><span>Processando seu pagamento ... </span>";
            html += "</div>"; 
        var msg = $.floatingMessage(html,{
                    position : "bottom-right",
                    className : ""
        });              
       
    });
    
    var bandeira = $("#bandeira").val();
    var parcelas = $('#bandeira option:selected', this).attr('parc');
    var operacao = $('#bandeira option:selected', this).attr('op');

    $(this).parcelamento(bandeira,parcelas,operacao);   

    $("#button-confirm").click(function(){
        $.ajax({
            url: 'index.php?route=payment/smcielopageloja/processar',
            type: 'post',
            dataType: 'json',
            data: $("#formulario").serialize(),
            beforeSend: function() {
                $("#resp-cielo").html('');                
                $("#resp-cielo").fadeOut();                

                var html = '';

                if($("input[name=nome_cartao]").val()==''){
                    html += '<div class="warning"><p>Informe o Titular do cartão</p></div>';                    
                }

                if($("input[name=nr_cartao]").val()==''){
                    html += '<div class="warning"><p>Informe o Número do cartão</p></div>';                    
                }

                if($("input[name=mes_cartao]").val()==''){
                    html += '<div class="warning"><p>Informe o Mês do cartão</p></div>';                    
                }

                if($("input[name=ano_cartao]").val()==''){
                    html += '<div class="warning"><p>Informe o Ano do cartão</p></div>';                    
                }

                if($("input[name=cod_seg]").val()==''){
                    html += '<div class="warning"><p>Informe o Código de Segurança do cartão</p></div>';                    
                }

                if(html){
                    $("#resp-cielo").append(html);
                    $("#resp-cielo").fadeIn();
                    return false;
                }    


                $.fancybox(
                     $("#process-cielo").html(), //fancybox works perfect with hidden divs
                     {
                        //fancybox options
                        maxWidth    : 800,
                        maxHeight   : 600,
                        fitToView   : false,
                        width       : '50%',
                        height      : '5%',
                        autoSize    : false,
                        closeBtn    : false,
                        closeClick  : false,                        
                        openEffect  : 'none',
                        closeEffect : 'none',
                        helpers   : { 
                           overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
                        }
                     }
                );
            },
            complete: function() {               
                $.fancybox.close();
            },
            error: function(e){
                console.log('Erro ao enviar o post');
                console.log(e);
            },
            success: function(json) {
                console.log('Sucesso ao enviar o post');
                console.log(json);       
                if(json['erro']){                    
                    $("#resp-cielo").append(json['erro']);
                    $("#resp-cielo").fadeIn();
                }         
                if(json['location']){
                    window.location = json['location'];                    
                }else{
                    $("#resp-cielo").append("<p>Houver uma falha ao tentar processar sua transação! Por favor tente novamente, caso o problema persista, contate a administração da loja para indentificar o problema. </p>");
                    $("#resp-cielo").fadeIn();
                }
            }
        });

    });   
 
});