<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
		  <tr>
            <td>Sobre:</td>
            <td>M&oacute;dulo de Boleto Ita&uacute; - Sem Registro.</td>
          </tr>
		 <tr>
            <td>Nome do M&oacute;dulo:<span class="help">Nome que sera mostrado ao cliente na lista de meios de pagamento.</span></td>
            <td><input type="text" name="itauloja5_nome" value="<?php echo $itauloja5_nome; ?>" size="70" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_total; ?></td>
            <td><input type="text" name="itauloja5_total" value="<?php echo $itauloja5_total; ?>" /></td>
          </tr>        
          <tr>
            <td><?php echo $entry_order_status; ?><br /><span class="help">Status padr&atilde;o que os pedidos seram criados.</span></td>
            <td><select name="itauloja5_order_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $itauloja5_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="itauloja5_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $itauloja5_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="itauloja5_status">
                <?php if ($itauloja5_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="itauloja5_sort_order" value="<?php echo $itauloja5_sort_order; ?>" size="1" /></td>
          </tr>
		  <tr>
            <td>Identifica&ccedil;&atilde;o Cedente:<br /><span class="help">Conforme Lei Federal 12.039, de 01/10/2009.</span></td>
            <td><input type="text" name="itauloja5_cedente" value="<?php echo $itauloja5_cedente; ?>" size="70" /></td>
          </tr>
		  <tr>
            <td>CPF/CNPJ:<br /><span class="help">Conforme Lei Federal 12.039, de 01/10/2009.</span></td>
            <td><input type="text" name="itauloja5_cpfcnpj" value="<?php echo $itauloja5_cpfcnpj; ?>" size="30" /></td>
          </tr>
		  <tr>
            <td>Endere&ccedil;o Cedente:<br /><span class="help">Conforme Lei Federal 12.039, de 01/10/2009.</span></td>
            <td><textarea name="itauloja5_endereco" rows="3" cols="50"><?php echo $itauloja5_endereco; ?></textarea></td>
          </tr>
		  <tr>
            <td>Agencia e Digito:<br /><span class="help">Agencia e o digito ????-X penas n&uacute;meros.</span></td>
            <td><input type="text" name="itauloja5_agencia" value="<?php echo $itauloja5_agencia; ?>" size="12" />-<input type="text" name="itauloja5_agenciadg" value="<?php echo $itauloja5_agenciadg; ?>" size="2" /></td>
          </tr>
		  <tr>
            <td>Conta e Digito:<br /><span class="help">Contae o digito ????????-X apenas n&uacute;meros.</span></td>
            <td><input type="text" name="itauloja5_conta" value="<?php echo $itauloja5_conta; ?>" size="12" />-<input type="text" name="itauloja5_contadg" value="<?php echo $itauloja5_contadg; ?>" size="2" /></td>
          </tr>
		  <tr>
            <td>Carteira:<br /><span class="help">Testadas: 175, 174, 104, 109, 178, 157.</span></td>
            <td><input type="text" maxlength="3" name="itauloja5_carteira" value="<?php echo $itauloja5_carteira; ?>" size="20" /></td>
          </tr>

		  <tr>
            <td>Taxa do Boleto:<br /><span class="help">Taxa do Boleto caso seja cobrada. Ex: 2.50</span></td>
            <td><input type="text" name="itauloja5_taxa" value="<?php echo $itauloja5_taxa; ?>" size="10" /></td>
          </tr>
		  <tr>
            <td>Dias para Expira&ccedil;&atilde;o:<br /><span class="help">Numero de dias. Ex: 5</span></td>
            <td><input type="text" name="itauloja5_dias" value="<?php echo $itauloja5_dias; ?>" size="10" /></td>
          </tr>
		  <tr>
            <td>Demostrativo 01:</td>
            <td><input type="text" name="itauloja5_demo1" value="<?php echo $itauloja5_demo1; ?>" size="70" /></td>
          </tr>
		  <tr>
            <td>Demostrativo 02:</td>
            <td><input type="text" name="itauloja5_demo2" value="<?php echo $itauloja5_demo2; ?>" size="70" /></td>
          </tr>
		  <tr>
            <td>Demostrativo 03:</td>
            <td><input type="text" name="itauloja5_demo3" value="<?php echo $itauloja5_demo3; ?>" size="70" /></td>
          </tr>
		  <tr>
            <td>Instru&ccedil;&otilde;es 01:</td>
            <td><input type="text" name="itauloja5_ins1" value="<?php echo $itauloja5_ins1; ?>" size="70" /></td>
          </tr>
		  <tr>
            <td>Instru&ccedil;&otilde;es 02:</td>
            <td><input type="text" name="itauloja5_ins2" value="<?php echo $itauloja5_ins2; ?>" size="70" /></td>
          </tr>
		  <tr>
            <td>Instru&ccedil;&otilde;es 03:</td>
            <td><input type="text" name="itauloja5_ins3" value="<?php echo $itauloja5_ins3; ?>" size="70" /></td>
          </tr>
		  <tr>
            <td>Instru&ccedil;&otilde;es 04:</td>
            <td><input type="text" name="itauloja5_ins4" value="<?php echo $itauloja5_ins4; ?>" size="70" /></td>
          </tr>

        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 