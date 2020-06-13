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
            <div class="buttons">
                <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
                <a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
            </div>
        </div>
        <div class="content">
          <div id="tabs" class="htabs">
            <a href="#tab_config" id="link_tab_config"><?php echo $tab_config; ?></a>
            <a href="#tab_config_avanc" id="link_tab_config_avanc"><?php echo $tab_config_avanc; ?></a>
            <a href="#tab_transacoes" id="link_tab_transacao"><?php echo $tab_transacoes; ?></a>            
          </div>
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">          
            <div id="tab_config">              
              <table class="form">
                        <tr>
                          <td><?php echo $entry_licenca; ?></td>
                          <td>
                              <input type="text" name="smcielopageloja_licenca" value="<?php echo $smcielopageloja_licenca; ?>" style="width: 250px;" />
                          </td>
                        </tr>                        
                        <tr>
                          <td><span class="required">*</span> <?php echo $entry_afiliacao; ?></td>
                          <td>
                            <input type="text" name="smcielopageloja_afiliacao" value="<?php echo $smcielopageloja_afiliacao; ?>" />
                            <span class="help">Ex.: 1006993069 </span>
                            <?php if ($error_afiliacao) { ?>
                            <span class="error"><?php echo $error_afiliacao; ?></span>
                            <?php } ?>
                          </td>
                        </tr>                        
                        <tr>
                            <td><span class="required">*</span> <?php echo $entry_chave; ?></td>
                              <td>
                              <input style="width:500px" type="text" name="smcielopageloja_chave" value="<?php echo $smcielopageloja_chave; ?>" />
                              <span class="help">Ex.: 25fbb99741c739dd84d7b06ec78c9bac718838630f30b112d033ce2e621b34f3 </span>
                              <?php if ($error_chave) { ?>
                              <span class="error"><?php echo $error_chave; ?></span>
                              <?php } ?>
                            </td>
                        </tr>
                        <tr>
                          <td><?php echo $entry_total; ?></td>
                          <td><input type="text" name="smcielopageloja_total" value="<?php echo $smcielopageloja_total; ?>" /></td>
                        </tr>
                        <tr>
                            <td><?php echo $entry_teste; ?></td>
                            <td>
                              <select name="smcielopageloja_teste">
                                <?php if ($smcielopageloja_teste) { ?>
                                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                <option value="0"><?php echo $text_no; ?></option>
                                <?php } else if (!$smcielopageloja_teste) { ?>
                                <option value="1"><?php echo $text_yes; ?></option>
                                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                <?php } else { ?>
                                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                <option value="0"><?php echo $text_no; ?></option>
                                <?php } ?>
                              </select>
                        </td>
                </tr>
                <tr>
                    <td><?php echo $entry_cartao_visae; ?></td>
                    <td>
                    <select name="smcielopageloja_cartao_visae">
                        <?php if ($smcielopageloja_cartao_visae) { ?>
                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                        <option value="0"><?php echo $text_no; ?></option>
                        <?php } else if (!$smcielopageloja_cartao_visae) { ?>
                        <option value="1"><?php echo $text_yes; ?></option>
                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                        <?php } else { ?>
                        <option value="1" selected="selected"><?php echo $text_no; ?></option>
                        <option value="0"><?php echo $text_yes; ?></option>
                        <?php } ?>
                    </select>
                    &nbsp;<?php echo $entry_parcelas;?>
                    <input style="width:50px" type="text" readonly="true" name="smcielopageloja_visae_parcelas" value="<?php echo $smcielopageloja_visae_parcelas; ?>" />
                    </td>
                </tr>
                <tr>
                        <td><?php echo $entry_cartao_visa; ?></td>
                        <td><select name="smcielopageloja_cartao_visa">
                            <?php if ($smcielopageloja_cartao_visa) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } else if (!$smcielopageloja_cartao_visa) { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } ?>
                        </select>
                        &nbsp;<?php echo $entry_parcelas;?><input style="width:50px" type="text" name="smcielopageloja_visa_parcelas" value="<?php echo $smcielopageloja_visa_parcelas; ?>" />
                    </td>
                </tr>                
                <tr>
                    <td><?php echo $entry_cartao_mastercard; ?></td>
                    <td>
                        <select name="smcielopageloja_cartao_mastercard">
                            <?php if ($smcielopageloja_cartao_mastercard) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } else if (!$smcielopageloja_cartao_mastercard) { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } ?>
                        </select>
                        &nbsp;<?php echo $entry_parcelas;?><input style="width:50px" type="text" name="smcielopageloja_mastercard_parcelas" value="<?php echo $smcielopageloja_mastercard_parcelas; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_cartao_diners; ?></td>
                    <td>
                        <select name="smcielopageloja_cartao_diners">
                            <?php if ($smcielopageloja_cartao_diners) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } else if (!$smcielopageloja_cartao_diners) { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } ?>
                        </select>
                        &nbsp;<?php echo $entry_parcelas;?>
                        <input style="width: 50px" type="text" name="smcielopageloja_diners_parcelas" value="<?php echo $smcielopageloja_diners_parcelas; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_cartao_discover; ?></td>
                    <td>
                        <select name="smcielopageloja_cartao_discover">
                            <?php if ($smcielopageloja_cartao_discover) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } else if (!$smcielopageloja_cartao_discover) { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } ?>
                        </select>
                        &nbsp;<?php echo $entry_parcelas;?><input style="width:50px" type="text" name="smcielopageloja_discover_parcelas" value="<?php echo $smcielopageloja_discover_parcelas; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_cartao_elo; ?></td>
                    <td>
                        <select name="smcielopageloja_cartao_elo">
                            <?php if ($smcielopageloja_cartao_elo) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } else if (!$smcielopageloja_cartao_elo) { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } ?>
                        </select>
                        &nbsp;<?php echo $entry_parcelas;?><input style="width:50px" type="text" name="smcielopageloja_elo_parcelas" value="<?php echo $smcielopageloja_elo_parcelas; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_cartao_amex; ?></td>
                    <td>
                        <select name="smcielopageloja_cartao_amex">
                            <?php if ($smcielopageloja_cartao_amex) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } else if (!$smcielopageloja_cartao_amex) { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } ?>
                        </select>
                        &nbsp;
                        <?php echo $entry_parcelas;?><input style="width:50px" type="text" name="smcielopageloja_amex_parcelas" value="<?php echo $smcielopageloja_amex_parcelas; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><span class="required">*</span> <?php echo $entry_autentic_visa_master;?></td></td>
                    <td>
                        <select name="smcielopageloja_autentic_visa_master">
                            <?php if($smcielopageloja_autentic_visa_master == 1){ ?>
                            <option selected value="1">Somente autenticada</option>
                            <option value="3">Autenticada e Nao Autenticada</option>
                            <?php }elseif ($smcielopageloja_autentic_visa_master == 3){ ?>
                            <option value="1">Somente autenticada</option>
                            <option selected value="3">Autenticada e Nao Autenticada</option>
                            <?php }else{ ?>
                            <option value="1">Somente autenticada</option>
                            <option value="3">Autenticada e Nao Autenticada</option>
                            <?php } ?>
                        </select>
                        <span>
                        <br />
                        Obs.: Para Diners, Discover, Elo e Amex o valor sera
                        sempre Autenticada e Nao Autenticada, pois estas bandeiras nao possuem programa
                        de autenticacao.
                        </span>
                    </td>
                </tr>
                <tr>
                  <td><span class="required">*</span> <?php echo $entry_cartao_semjuros;?></td>
                    <td><input style="width:50px" type="text" name="smcielopageloja_cartao_semjuros" value="<?php echo $smcielopageloja_cartao_semjuros; ?>" />
                    <?php if ($error_cartao_semjuros) { ?>
                    <span class="error"><?php echo $error_cartao_semjuros; ?></span>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <td><span class="required">*</span> <?php echo $entry_cartao_minimo;?></td>
                  <td><input style="width:100px" type="text" name="smcielopageloja_cartao_minimo" value="<?php echo $smcielopageloja_cartao_minimo; ?>" />
                  <?php if ($error_cartao_minimo) { ?>
                  <span class="error"><?php echo $error_cartao_minimo; ?></span>
                  <?php } ?>
                  </td>
                </tr>
                <tr>
                  <td><span class="required">*</span> <?php echo $entry_cartao_juros;?></td>
                  <td><input style="width:50px" type="text" name="smcielopageloja_cartao_juros" value="<?php echo $smcielopageloja_cartao_juros; ?>" />
                  <?php if ($error_cartao_juros) { ?>
                  <span class="error"><?php echo $error_cartao_juros; ?></span>
                  <?php } ?>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $entry_parcelamento; ?></td>
                  <td>
                  <select name="smcielopageloja_parcelamento">
                  <option value="2"><?php echo $text_loja; ?></option>
                  </select>
                  </td>
                </tr>

                <tr>
                  <td><?php echo $entry_aprovado; ?></td>
                  <td>
                  <select name="smcielopageloja_aprovado_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $smcielopageloja_aprovado_id) { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                  </select>
                  </td>
                </tr>

                <tr>
                  <td><?php echo $entry_nao_aprovado; ?></td>
                  <td><select name="smcielopageloja_nao_aprovado_id">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $smcielopageloja_nao_aprovado_id) { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                  </select>
                  </td>
                </tr>

                <tr>
                  <td><?php echo $entry_geo_zone; ?></td>
                  <td><select name="smcielopageloja_geo_zone_id">
                  <option value="0"><?php echo $text_all_zones; ?></option>
                  <?php foreach ($geo_zones as $geo_zone) { ?>
                  <?php if ($geo_zone['geo_zone_id'] == $smcielopageloja_geo_zone_id) { ?>
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
                  <td><select name="smcielopageloja_status">
                  <?php if ($smcielopageloja_status) { ?>
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
                  <td><input type="text" name="smcielopageloja_sort_order" value="<?php echo $smcielopageloja_sort_order; ?>" size="1" /></td>
                </tr>

                </table>
            </div>

            <div id="tab_config_avanc">
                <table class="form">
                    <tbody>
                        <tr>
                            <td style="width: 300px;"><?php echo $entry_cancel_transac_pedido_excluido ?></td>
                            <td>
                                <select name="smcielopageloja_cancelar_transacao_pedido_excluido">
                                  <?php if ($smcielopageloja_cancelar_transacao_pedido_excluido) { ?>
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
                            <td style="width: 300px;"><?php echo $entry_cancel_transac_pedido_cancelado; ?></td>
                            <td>                            
                                <?php foreach ($status_pedidos as $key => $status): ?>
                                    <?php if (in_array($status['order_status_id'], $smcielopageloja_status_pedido_cancelamento_transacao)): ?>
                                        <input type="checkbox" checked="true" name="smcielopageloja_status_pedido_cancelamento_transacao[]" value="<?php echo $status['order_status_id'] ?>">
                                    <?php else: ?>
                                        <input type="checkbox" name="smcielopageloja_status_pedido_cancelamento_transacao[]" value="<?php echo $status['order_status_id'] ?>">
                                    <?php endif ?>                                    
                                    <span><?php echo $status['name']; ?></span> 
                                    <br>
                                <?php endforeach ?>    
                            </td>                            
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Transacoes -->
            <div id="tab_transacoes">
              <table class="list">
                <thead>
                  <tr>                   
                    <td class="center"><?php echo $coluna_pedido_numero ?></td>
                    <td class="left"><?php echo $coluna_tid ?></td>
                    <td class="left"><?php echo $coluna_pan ?></td>
                    <td class="center"><?php echo $coluna_status ?></td>                    
                    <td class="center"><?php echo $coluna_pedido_valor ?></td>                    
                    <td class="center"><?php echo $coluna_pedido_data ?></td>                    
                  </tr>
                </thead>                
                <tbody>
                  <?php if ($transacoes): ?>
                    <?php foreach ($transacoes as $key => $transacao): ?>
                      <tr>                      
                        <td class="center"><?php echo $transacao['pedido_numero']; ?></td> 
                        <td class="left"><?php echo $transacao['tid']; ?></td> 
                        <td class="left"><?php echo $transacao['pan']; ?></td> 
                        <td class="center"><?php echo $transacao['status']; ?></td>                         
                        <td class="center"><?php echo $transacao['pedido_valor']; ?></td>                         
                        <td class="center"><?php echo $transacao['pedido_data']; ?></td> 
                      </tr>
                    <?php endforeach ?>
                  <?php else: ?>
                    <tr>
                      <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
                    </tr>  
                  <?php endif ?>                  
                </tbody>
              </table>
              <div class="pagination">
                  <?php echo $pagination; ?>
              </div>
            </div>
          

          </form>
        </div>
    </div>
</div>
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
<?php if(isset($_GET['page'])): ?>
$("#link_tab_transacao").click();
<?php endif ?>
//--></script>
<?php echo $footer; ?>