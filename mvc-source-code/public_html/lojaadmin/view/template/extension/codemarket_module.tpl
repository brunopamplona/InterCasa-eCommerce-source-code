<?php echo $header; ?>
<!-- PROIBIDO MODIFICAR ESTE ARQUIVO -->
<div id="content">
    <div class="container-fluid">
    <?php if(empty($cliente)) { ?>
    <div class="col-sm-5">
    <h3><a href = "http://www.codemarket.com.br">Ativar Token Geral - Code Market</a></h3>
    <form id="vg_form">
    <div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" class="form-control" name="codemarket_val_email" placeholder="Seu E-mail na Code Market">
    </div>
    <div class="form-group">
    <label for="token">Token Geral</label>
    <input type="password" class="form-control" name="codemarket_val_token" placeholder="Seu Token Geral na Code Market">
    </div>
    <button type="submit" id="vg_botao" class="btn btn-success">Validar</button>
    </form>
    </div>       
    <script>
    $("#vg_botao" ).on( "click", function(e) {
    e.preventDefault();

    var dados = $('#vg_form').serialize();
    $.ajax({
    type: "POST",
    data: dados,
    url: "<?php echo $validar; ?>",       
    success: function (data) {
        console.log(data);
        if(data == 1) {
            alert("Validação aprovada, atualizando página");
            location.reload(); 
        }else {
            alert("Verifique se informou corretamente o E-mail e Token!")
        }
    }
    });
    });
    </script>
    <?php } ?>
<?php if((!empty($dom)) and (!empty($email)) and (!empty($cliente))) { ?>
<div id='carregar'>Carregando...</div>
<script>    
$.ajax({
type: "POST",
data: {dom: "<?php echo $dom; ?>", email: "<?php echo $email; ?>",token: "<?php echo $cliente; ?>",url_ticket: "<?php echo $url_ticket; ?>",url_cache: "<?php echo $url_cache; ?>",
      usuario_id: "<?php echo $usuario_id; ?>",grupo_nome: "<?php echo $grupo_nome; ?>",grupo_id: "<?php echo $grupo_id; ?>"},
url: "<?php echo $code_modulos; ?>",       
})
.done(function(conteudo) {
$('#carregar').html(conteudo);
});
</script>
<?php } ?>
</div>
</div>
<?php echo $footer; ?>