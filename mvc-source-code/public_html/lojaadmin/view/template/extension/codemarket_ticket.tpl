<?php echo $header; ?>
<!-- PROIBIDO MODIFICAR ESTE ARQUIVO -->
<div id="content">
    <div class="container-fluid">
    <?php if(empty($cliente)) { ?>
    <div class="col-sm-5">
    <h2 ><a href = "http://www.codemarket.com.br/">Code Market - Tickets</a></h2>
    <div class="alert alert-info"><h3><a href = "<?php echo $codemarket_module; ?>">Ative o Code Market Painel clicando aqui para usar o Ticket</a></h3></div>
    <?php } ?>
    <?php if((!empty($email)) and (!empty($cliente))) { ?>
    <div id='carregar'>Carregando...</div>
    <script>    
    $.ajax({
    type: "POST",
    data: {dom: "<?php echo $dom; ?>",email: "<?php echo $email; ?>",token: "<?php echo $cliente; ?>",urlModulos: "<?php echo $codemarket_module; ?>"},
    url: "<?php echo $ticketListar; ?>",       
    })
    .done(function(conteudo) {
    $('#carregar').html(conteudo);
    });
    </script>
    <?php } ?>
    </div>
</div>
<?php echo $footer; ?>