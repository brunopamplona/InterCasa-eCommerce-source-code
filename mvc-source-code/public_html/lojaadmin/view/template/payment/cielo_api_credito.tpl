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
        <a href="#tab-parcelamentos"><?php echo $tab_parcelamentos; ?></a>
        <a href="#tab-situacoes-pedido"><?php echo $tab_situacoes_pedido; ?></a>
        <a href="#tab-finalizacao"><?php echo $tab_finalizacao; ?></a>
        <a href="#tab-campos"><?php echo $tab_campos; ?></a>
        <a href="#tab-clearsale"><?php echo $tab_clearsale; ?></a>
        <a href="#tab-fcontrol"><?php echo $tab_fcontrol; ?></a>
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-geral">
          <table class="form">
            <tr>
              <td><?php echo $entry_chave; ?></td>
              <td>
                <input type="text" name="cielo_api_credito_chave" value="<?php echo $cielo_api_credito_chave; ?>" size="50" />
                <?php if ($error_chave) { ?>
                <span class="error"><?php echo $error_chave; ?></span>
                <?php } ?>
                <input type="hidden" name="save_stay" id="save_stay" value="0" />
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_total; ?></td>
              <td><input type="text" name="cielo_api_credito_total" value="<?php echo $cielo_api_credito_total; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_geo_zone; ?></td>
              <td>
                <select name="cielo_api_credito_geo_zone_id">
                  <option value="0"><?php echo $text_all_zones; ?></option>
                  <?php foreach ($geo_zones as $geo_zone) { ?>
                  <?php if ($geo_zone['geo_zone_id'] == $cielo_api_credito_geo_zone_id) { ?>
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
                <select name="cielo_api_credito_status">
                  <?php if ($cielo_api_credito_status) { ?>
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
              <td><input type="text" name="cielo_api_credito_sort_order" value="<?php echo $cielo_api_credito_sort_order; ?>" size="1" /></td>
            </tr>
          </table>
        </div>
        <div id="tab-api">
          <table class="form">
            <tr>
              <td><span class="required">*</span> <?php echo $entry_merchantid; ?></td>
              <td>
                <input type="text" name="cielo_api_credito_merchantid" value="<?php echo $cielo_api_credito_merchantid; ?>" size="40" />
                <?php if ($error_merchantid) { ?>
                <span class="error"><?php echo $error_merchantid; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_merchantkey; ?></td>
              <td>
                <input type="text" name="cielo_api_credito_merchantkey" value="<?php echo $cielo_api_credito_merchantkey; ?>" size="50" />
                <?php if ($error_merchantkey) { ?>
                <span class="error"><?php echo $error_merchantkey; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_soft_descriptor; ?></td>
              <td>
                <input type="text" name="cielo_api_credito_soft_descriptor" value="<?php echo $cielo_api_credito_soft_descriptor; ?>" />
                <?php if ($error_soft_descriptor) { ?>
                <span class="error"><?php echo $error_soft_descriptor; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_ambiente; ?></td>
              <td>
                <select name="cielo_api_credito_ambiente">
                  <?php if ($cielo_api_credito_ambiente) { ?>
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
                <select name="cielo_api_credito_debug">
                  <?php if ($cielo_api_credito_debug) { ?>
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
              <td><?php echo $entry_captura; ?></td>
              <td>
                <select name="cielo_api_credito_captura">
                  <?php if ($cielo_api_credito_captura) { ?>
                  <option value="1" selected="selected"><?php echo $text_manual; ?></option>
                  <option value="0"><?php echo $text_automatica; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_manual; ?></option>
                  <option value="0" selected="selected"><?php echo $text_automatica; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
          </table>
        </div>
        <div id="tab-parcelamentos">
          <table class="form">
            <tr>
              <td><?php echo $entry_calculo; ?></td>
              <td>
                <select name="cielo_api_credito_calculo">
                  <?php if ($cielo_api_credito_calculo) { ?>
                  <option value="1" selected="selected"><?php echo $text_simples; ?></option>
                  <option value="0"><?php echo $text_composto; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_simples; ?></option>
                  <option value="0" selected="selected"><?php echo $text_composto; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_minimo; ?></td>
              <td><input type="text" name="cielo_api_credito_minimo" value="<?php echo $cielo_api_credito_minimo; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_desconto; ?></td>
              <td><input type="text" name="cielo_api_credito_desconto" value="<?php echo $cielo_api_credito_desconto; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_visa; ?></td>
              <td>
                <?php echo $text_ativar; ?>&nbsp;
                <select name="cielo_api_credito_visa">
                  <?php if ($cielo_api_credito_visa) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_parcelas; ?>&nbsp;
                <select name="cielo_api_credito_visa_parcelas">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_visa_parcelas) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_sem_juros; ?>&nbsp;
                <select name="cielo_api_credito_visa_sem_juros">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_visa_sem_juros) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_juros; ?>&nbsp;
                <input type="text" name="cielo_api_credito_visa_juros" value="<?php echo $cielo_api_credito_visa_juros; ?>" size="1" />
                <?php if ($error_visa) { ?>
                <div class="error"><?php echo $error_visa; ?></div>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_mastercard; ?></td>
              <td>
                <?php echo $text_ativar; ?>&nbsp;
                <select name="cielo_api_credito_mastercard">
                  <?php if ($cielo_api_credito_mastercard) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_parcelas; ?>&nbsp;
                <select name="cielo_api_credito_mastercard_parcelas">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_mastercard_parcelas) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_sem_juros; ?>&nbsp;
                <select name="cielo_api_credito_mastercard_sem_juros">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_mastercard_sem_juros) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_juros; ?>&nbsp;
                <input type="text" name="cielo_api_credito_mastercard_juros" value="<?php echo $cielo_api_credito_mastercard_juros; ?>" size="1" />
                <?php if ($error_mastercard) { ?>
                <div class="error"><?php echo $error_mastercard; ?></div>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_diners; ?></td>
              <td>
                <?php echo $text_ativar; ?>&nbsp;
                <select name="cielo_api_credito_diners">
                  <?php if ($cielo_api_credito_diners) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_parcelas; ?>&nbsp;
                <select name="cielo_api_credito_diners_parcelas">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_diners_parcelas) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_sem_juros; ?>&nbsp;
                <select name="cielo_api_credito_diners_sem_juros">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_diners_sem_juros) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_juros; ?>&nbsp;
                <input type="text" name="cielo_api_credito_diners_juros" value="<?php echo $cielo_api_credito_diners_juros; ?>" size="1" />
                <?php if ($error_diners) { ?>
                <div class="error"><?php echo $error_diners; ?></div>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_discover; ?></td>
              <td>
                <?php echo $text_ativar; ?>&nbsp;
                <select name="cielo_api_credito_discover">
                  <?php if ($cielo_api_credito_discover) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_elo; ?></td>
              <td>
                <?php echo $text_ativar; ?>&nbsp;
                <select name="cielo_api_credito_elo">
                  <?php if ($cielo_api_credito_elo) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_parcelas; ?>&nbsp;
                <select name="cielo_api_credito_elo_parcelas">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_elo_parcelas) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_sem_juros; ?>&nbsp;
                <select name="cielo_api_credito_elo_sem_juros">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_elo_sem_juros) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_juros; ?>&nbsp;
                <input type="text" name="cielo_api_credito_elo_juros" value="<?php echo $cielo_api_credito_elo_juros; ?>" size="1" />
                <?php if ($error_elo) { ?>
                <div class="error"><?php echo $error_elo; ?></div>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_amex; ?></td>
              <td>
                <?php echo $text_ativar; ?>&nbsp;
                <select name="cielo_api_credito_amex">
                  <?php if ($cielo_api_credito_amex) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_parcelas; ?>&nbsp;
                <select name="cielo_api_credito_amex_parcelas">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_amex_parcelas) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_sem_juros; ?>&nbsp;
                <select name="cielo_api_credito_amex_sem_juros">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_amex_sem_juros) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_juros; ?>&nbsp;
                <input type="text" name="cielo_api_credito_amex_juros" value="<?php echo $cielo_api_credito_amex_juros; ?>" size="1" />
                <?php if ($error_amex) { ?>
                <div class="error"><?php echo $error_amex; ?></div>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_hipercard; ?></td>
              <td>
                <?php echo $text_ativar; ?>&nbsp;
                <select name="cielo_api_credito_hipercard">
                  <?php if ($cielo_api_credito_hipercard) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_parcelas; ?>&nbsp;
                <select name="cielo_api_credito_hipercard_parcelas">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_hipercard_parcelas) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_sem_juros; ?>&nbsp;
                <select name="cielo_api_credito_hipercard_sem_juros">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_hipercard_sem_juros) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_juros; ?>&nbsp;
                <input type="text" name="cielo_api_credito_hipercard_juros" value="<?php echo $cielo_api_credito_hipercard_juros; ?>" size="1" />
                <?php if ($error_hipercard) { ?>
                <div class="error"><?php echo $error_hipercard; ?></div>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_jcb; ?></td>
              <td>
                <?php echo $text_ativar; ?>&nbsp;
                <select name="cielo_api_credito_jcb">
                  <?php if ($cielo_api_credito_jcb) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_parcelas; ?>&nbsp;
                <select name="cielo_api_credito_jcb_parcelas">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_jcb_parcelas) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_sem_juros; ?>&nbsp;
                <select name="cielo_api_credito_jcb_sem_juros">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_jcb_sem_juros) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_juros; ?>&nbsp;
                <input type="text" name="cielo_api_credito_jcb_juros" value="<?php echo $cielo_api_credito_jcb_juros; ?>" size="1" />
                <?php if ($error_jcb) { ?>
                <div class="error"><?php echo $error_jcb; ?></div>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_aura; ?></td>
              <td>
                <?php echo $text_ativar; ?>&nbsp;
                <select name="cielo_api_credito_aura">
                  <?php if ($cielo_api_credito_aura) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_parcelas; ?>&nbsp;
                <select name="cielo_api_credito_aura_parcelas">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_aura_parcelas) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_sem_juros; ?>&nbsp;
                <select name="cielo_api_credito_aura_sem_juros">
                  <?php foreach ($parcelas as $parcela) { ?>
                  <?php if ($parcela == $cielo_api_credito_aura_sem_juros) { ?>
                  <option value="<?php echo $parcela; ?>" selected="selected"><?php echo $parcela; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $parcela; ?>"><?php echo $parcela; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>&nbsp;
                <?php echo $text_juros; ?>&nbsp;
                <input type="text" name="cielo_api_credito_aura_juros" value="<?php echo $cielo_api_credito_aura_juros; ?>" size="1" />
                <?php if ($error_aura) { ?>
                <div class="error"><?php echo $error_aura; ?></div>
                <?php } ?>
              </td>
            </tr>
          </table>
        </div>
        <div id="tab-situacoes-pedido">
          <table class="form">
            <tr>
              <td><?php echo $entry_situacao_pendente; ?></td>
              <td>
                <select name="cielo_api_credito_situacao_pendente_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $cielo_api_credito_situacao_pendente_id) { ?>
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
                <select name="cielo_api_credito_situacao_autorizada_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $cielo_api_credito_situacao_autorizada_id) { ?>
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
                <select name="cielo_api_credito_situacao_nao_autorizada_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $cielo_api_credito_situacao_nao_autorizada_id) { ?>
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
                <select name="cielo_api_credito_situacao_capturada_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $cielo_api_credito_situacao_capturada_id) { ?>
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
                <select name="cielo_api_credito_situacao_cancelada_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $cielo_api_credito_situacao_cancelada_id) { ?>
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
                <input type="text" name="cielo_api_credito_titulo" value="<?php echo $cielo_api_credito_titulo; ?>" size="50" />
                <?php if ($error_titulo) { ?>
                <span class="error"><?php echo $error_titulo; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_imagem; ?></td>
              <td valign="top">
                <div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" />
                  <input type="hidden" name="cielo_api_credito_imagem" value="<?php echo $cielo_api_credito_imagem; ?>" id="image" />
                  <br />
                  <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>
                  &nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a>
                </div>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_exibir_juros; ?></td>
              <td>
                <select name="cielo_api_credito_exibir_juros">
                  <?php if ($cielo_api_credito_exibir_juros) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>
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
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_credito_cor_normal_texto" value="<?php echo $cielo_api_credito_cor_normal_texto; ?>" />&nbsp;
                      <?php echo $text_fundo; ?>&nbsp;
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_credito_cor_normal_fundo" value="<?php echo $cielo_api_credito_cor_normal_fundo; ?>" />&nbsp;
                      <?php echo $text_borda; ?>&nbsp;
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_credito_cor_normal_borda" value="<?php echo $cielo_api_credito_cor_normal_borda; ?>" />&nbsp;
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $entry_botao_efeito; ?></td>
                    <td>
                      <?php echo $text_texto; ?>&nbsp;
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_credito_cor_efeito_texto" value="<?php echo $cielo_api_credito_cor_efeito_texto; ?>" />&nbsp;
                      <?php echo $text_fundo; ?>&nbsp;
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_credito_cor_efeito_fundo" value="<?php echo $cielo_api_credito_cor_efeito_fundo; ?>" />&nbsp;
                      <?php echo $text_borda; ?>&nbsp;
                      <input class="jscolor {hash:true}" type="text" name="cielo_api_credito_cor_efeito_borda" value="<?php echo $cielo_api_credito_cor_efeito_borda; ?>" />&nbsp;
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <h2><?php echo $text_recaptcha; ?></h2>
                <p><?php echo $text_recaptcha_registrar; ?></p>
                <table class="form">
                  <tr>
                    <td><?php echo $entry_recaptcha_site_key; ?></td>
                    <td>
                      <input type="text" name="cielo_api_credito_recaptcha_site_key" value="<?php echo $cielo_api_credito_recaptcha_site_key; ?>" size="50" />
                      <?php if ($error_recaptcha_site_key) { ?>
                      <span class="error"><?php echo $error_recaptcha_site_key; ?></span>
                      <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $entry_recaptcha_secret_key; ?></td>
                    <td>
                      <input type="text" name="cielo_api_credito_recaptcha_secret_key" value="<?php echo $cielo_api_credito_recaptcha_secret_key; ?>" size="50" />
                      <?php if ($error_recaptcha_secret_key) { ?>
                      <span class="error"><?php echo $error_recaptcha_secret_key; ?></span>
                      <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $entry_recaptcha_status; ?></td>
                    <td>
                      <select name="cielo_api_credito_recaptcha_status">
                        <?php if ($cielo_api_credito_recaptcha_status) { ?>
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
              </td>
            </tr>
          </table>
        </div>
        <div id="tab-campos">
          <table class="form">
            <tr>
              <td><?php echo $entry_razao; ?></td>
              <td>
                <select name="cielo_api_credito_razao_coluna">
                  <option value=""></option>
                  <?php foreach ($columns as $column) { ?>
                  <?php if ($column['Field'] == $cielo_api_credito_razao_coluna) { ?>
                  <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_cnpj; ?></td>
              <td>
                <select name="cielo_api_credito_cnpj_coluna">
                  <option value=""></option>
                  <?php foreach ($columns as $column) { ?>
                  <?php if ($column['Field'] == $cielo_api_credito_cnpj_coluna) { ?>
                  <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_cpf; ?></td>
              <td>
                <select name="cielo_api_credito_cpf_coluna">
                  <option value=""></option>
                  <?php foreach ($columns as $column) { ?>
                  <?php if ($column['Field'] == $cielo_api_credito_cpf_coluna) { ?>
                  <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_numero_cobranca; ?></td>
              <td>
                <select name="cielo_api_credito_numero_cobranca_coluna">
                  <option value=""></option>
                  <?php foreach ($columns as $column) { ?>
                  <?php if ($column['Field'] == $cielo_api_credito_numero_cobranca_coluna) { ?>
                  <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_numero_entrega; ?></td>
              <td>
                <select name="cielo_api_credito_numero_entrega_coluna">
                  <option value=""></option>
                  <?php foreach ($columns as $column) { ?>
                  <?php if ($column['Field'] == $cielo_api_credito_numero_entrega_coluna) { ?>
                  <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_complemento_cobranca; ?></td>
              <td>
                <select name="cielo_api_credito_complemento_cobranca_coluna">
                  <option value=""></option>
                  <?php foreach ($columns as $column) { ?>
                  <?php if ($column['Field'] == $cielo_api_credito_complemento_cobranca_coluna) { ?>
                  <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_complemento_entrega; ?></td>
              <td>
                <select name="cielo_api_credito_complemento_entrega_coluna">
                  <option value=""></option>
                  <?php foreach ($columns as $column) { ?>
                  <?php if ($column['Field'] == $cielo_api_credito_complemento_entrega_coluna) { ?>
                  <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
          </table>
        </div>
        <div id="tab-clearsale">
          <table class="form">
            <tr>
              <td><span class="required">*</span> <?php echo $entry_clearsale_codigo; ?></td>
              <td>
                <input type="text" name="cielo_api_credito_clearsale_codigo" value="<?php echo $cielo_api_credito_clearsale_codigo; ?>" />
                <?php if ($error_clearsale_codigo) { ?>
                <span class="error"><?php echo $error_clearsale_codigo; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_clearsale_ambiente; ?></td>
              <td>
                <select name="cielo_api_credito_clearsale_ambiente">
                  <?php if ($cielo_api_credito_clearsale_ambiente) { ?>
                  <option value="1" selected="selected"><?php echo $text_producao; ?></option>
                  <option value="0"><?php echo $text_homologacao; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_producao; ?></option>
                  <option value="0" selected="selected"><?php echo $text_homologacao; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td>
                <select name="cielo_api_credito_clearsale_status">
                  <?php if ($cielo_api_credito_clearsale_status) { ?>
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
        <div id="tab-fcontrol">
          <table class="form">
            <tr>
              <td><span class="required">*</span> <?php echo $entry_fcontrol_login; ?></td>
              <td>
                <input type="text" name="cielo_api_credito_fcontrol_login" value="<?php echo $cielo_api_credito_fcontrol_login; ?>" />
                <?php if ($error_fcontrol_login) { ?>
                <span class="error"><?php echo $error_fcontrol_login; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_fcontrol_senha; ?></td>
              <td>
                <input type="text" name="cielo_api_credito_fcontrol_senha" value="<?php echo $cielo_api_credito_fcontrol_senha; ?>" />
                <?php if ($error_fcontrol_senha) { ?>
                <span class="error"><?php echo $error_fcontrol_senha; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td>
                <select name="cielo_api_credito_fcontrol_status">
                  <?php if ($cielo_api_credito_fcontrol_status) { ?>
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
            url: 'index.php?route=payment/cielo_api_credito/imageLogo&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
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