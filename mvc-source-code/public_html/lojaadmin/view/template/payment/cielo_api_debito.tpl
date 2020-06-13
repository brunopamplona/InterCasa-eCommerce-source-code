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
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?> <?php echo $versao; ?></h1>
      <div class="buttons">
        <a onclick="$('#save_stay').val('1');$('#form').submit();" class="button"><?php echo $button_save_stay; ?></a>
        <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
        <a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>
    <div class="content">
      <div id="htabs" class="htabs">
        <a href="#tab-geral"><?php echo $tab_geral; ?></a>
        <a href="#tab-api"><?php echo $tab_api; ?></a>
        <a href="#tab-situacoes-pedido"><?php echo $tab_situacoes_pedido; ?></a>
        <a href="#tab-finalizacao"><?php echo $tab_finalizacao; ?></a>
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-geral">
          <table class="form">
            <tr>
              <td><?php echo $entry_chave; ?></td>
              <td>
                <input type="text" name="cielo_api_debito_chave" value="<?php echo $cielo_api_debito_chave; ?>" size="50" />
                <?php if ($error_chave) { ?>
                <span class="error"><?php echo $error_chave; ?></span>
                <?php } ?>
                <input type="hidden" name="save_stay" id="save_stay" value="0" />
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_total; ?></td>
              <td><input type="text" name="cielo_api_debito_total" value="<?php echo $cielo_api_debito_total; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_geo_zone; ?></td>
              <td>
                <select name="cielo_api_debito_geo_zone_id">
                  <option value="0"><?php echo $text_all_zones; ?></option>
                  <?php foreach ($geo_zones as $geo_zone) { ?>
                  <?php if ($geo_zone['geo_zone_id'] == $cielo_api_debito_geo_zone_id) { ?>
                  <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td>
                <select name="cielo_api_debito_status">
                  <?php if ($cielo_api_debito_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_sort_order; ?></td>
              <td><input type="text" name="cielo_api_debito_sort_order" value="<?php echo $cielo_api_debito_sort_order; ?>" size="1" /></td>
            </tr>
          </table>
        </div>
        <div id="tab-api">
          <table class="form">
            <tr>
              <td><span class="required">*</span> <?php echo $entry_merchantid; ?></td>
              <td>
                <input type="text" name="cielo_api_debito_merchantid" value="<?php echo $cielo_api_debito_merchantid; ?>" size="40" />
                <?php if ($error_merchantid) { ?>
                <span class="error"><?php echo $error_merchantid; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_merchantkey; ?></td>
              <td>
                <input type="text" name="cielo_api_debito_merchantkey" value="<?php echo $cielo_api_debito_merchantkey; ?>" size="50" />
                <?php if ($error_merchantkey) { ?>
                <span class="error"><?php echo $error_merchantkey; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_soft_descriptor; ?></td>
              <td>
                <input type="text" name="cielo_api_debito_soft_descriptor" value="<?php echo $cielo_api_debito_soft_descriptor; ?>" />
                <?php if ($error_soft_descriptor) { ?>
                <span class="error"><?php echo $error_soft_descriptor; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_ambiente; ?></td>
              <td>
                <select name="cielo_api_debito_ambiente">
                  <?php if ($cielo_api_debito_ambiente) { ?>
                  <option value="1" selected="selected"><?php echo $text_sandbox; ?></option>
                  <option value="0"><?php echo $text_producao; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_sandbox; ?></option>
                  <option value="0" selected="selected"><?php echo $text_producao; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_debug; ?></td>
              <td>
                <select name="cielo_api_debito_debug">
                  <?php if ($cielo_api_debito_debug) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_visa; ?></td>
              <td>
                <select name="cielo_api_debito_visa">
                  <?php if ($cielo_api_debito_visa) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_mastercard; ?></td>
              <td>
                <select name="cielo_api_debito_mastercard">
                  <?php if ($cielo_api_debito_mastercard) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
          </table>
        </div>
        <div id="tab-situacoes-pedido">
          <table class="form">
            <tr>
              <td><?php echo $entry_situacao_pendente; ?></td>
              <td>
                <select name="cielo_api_debito_situacao_pendente_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $cielo_api_debito_situacao_pendente_id) { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_situacao_autorizada; ?></td>
              <td>
                <select name="cielo_api_debito_situacao_autorizada_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $cielo_api_debito_situacao_autorizada_id) { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_situacao_nao_autorizada; ?></td>
              <td>
                <select name="cielo_api_debito_situacao_nao_autorizada_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $cielo_api_debito_situacao_nao_autorizada_id) { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_situacao_capturada; ?></td>
              <td>
                <select name="cielo_api_debito_situacao_capturada_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $cielo_api_debito_situacao_capturada_id) { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_situacao_cancelada; ?></td>
              <td>
                <select name="cielo_api_debito_situacao_cancelada_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $cielo_api_debito_situacao_cancelada_id) { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
          </table>
        </div>
        <div id="tab-finalizacao">
          <table class="form">
            <tr>
              <td><span class="required">*</span> <?php echo $entry_titulo; ?></td>
              <td>
                <input type="text" name="cielo_api_debito_titulo" value="<?php echo $cielo_api_debito_titulo; ?>" size="50" />
                <?php if ($error_titulo) { ?>
                <span class="error"><?php echo $error_titulo; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_imagem; ?></td>
              <td valign="top">
                <div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" />
                  <input type="hidden" name="cielo_api_debito_imagem" value="<?php echo $cielo_api_debito_imagem; ?>" id="image" />
                  <br />
                  <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>
                  &nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <h2><?php echo $text_botao; ?></h2>
                <table class="form">
                  <tr>
                    <td><?php echo $entry_botao_normal; ?></td>
                    <td>
                      <?php echo $text_texto; ?>&nbsp;
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_debito_cor_normal_texto" value="<?php echo $cielo_api_debito_cor_normal_texto; ?>" />&nbsp;
                      <?php echo $text_fundo; ?>&nbsp;
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_debito_cor_normal_fundo" value="<?php echo $cielo_api_debito_cor_normal_fundo; ?>" />&nbsp;
                      <?php echo $text_borda; ?>&nbsp;
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_debito_cor_normal_borda" value="<?php echo $cielo_api_debito_cor_normal_borda; ?>" />&nbsp;
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $entry_botao_efeito; ?></td>
                    <td>
                      <?php echo $text_texto; ?>&nbsp;
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_debito_cor_efeito_texto" value="<?php echo $cielo_api_debito_cor_efeito_texto; ?>" />&nbsp;
                      <?php echo $text_fundo; ?>&nbsp;
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_debito_cor_efeito_fundo" value="<?php echo $cielo_api_debito_cor_efeito_fundo; ?>" />&nbsp;
                      <?php echo $text_borda; ?>&nbsp;
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_debito_cor_efeito_borda" value="<?php echo $cielo_api_debito_cor_efeito_borda; ?>" />&nbsp;
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
  $('#htabs a').tabs();

  function image_upload(field, thumb) {
    $('#dialog').remove();

    $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

    $('#dialog').dialog({
      title: '<?php echo $text_image_manager; ?>',
      close: function (event, ui) {
        if ($('#' + field).attr('value')) {
          $.ajax({
            url: 'index.php?route=payment/cielo_api_debito/imageLogo&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
            dataType: 'text',
            success: function(text) {
              $('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
            }
          });
        }
      },
      bgiframe: false,
      width: 800,
      height: 400,
      resizable: false,
      modal: false
    });
  };
//--></script>
<?php echo $footer; ?>