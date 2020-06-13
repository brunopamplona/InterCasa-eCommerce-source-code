<script type="text/javascript" src="catalog/view/javascript/jquery.floatingmessage.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/funcoescielo.js"></script>
<?php if ($teste) { ?>
<div class="warning"><?php echo $text_teste; ?></div>
<?php } ?>
<?php
$order_info  = $this->model_checkout_order->getOrder($this->session->data['order_id']);
$valor_total = number_format($order_info['total'],2);
$valor_total = str_replace(".","",$valor_total);
?>  

<div class="checkout-heading"><?php echo $text_barra; ?> </div>

<div id="process-cielo" style="display: none; text-align: center;">
    <center>
        <h2>PROCESSANDO SUA TRANSAÇÃO AGUARDE ...</h2>
        <img src="image/cielo/loading.gif" />        
    </center>
</div>

<div id="resp-cielo" style="display: none;" class="warning"></div>

<form method="post" action="index.php?route=payment/smcielopageloja/processar" id="formulario" >	
	<table border="0" style="width:100%">
		<tr>
          <td style="width: 50%;">
              <table border="0" style="width:100%">                
                <tr>
                <td style="width: 35%;">Bandeira: </td>
                <td>
                <select style="width: 220px;" name="bandeira" id="bandeira" >                
                <? if ($this->config->get('smcielopageloja_cartao_visae') == 1) { ?>
                <option op='D' parc="<?php echo $this->config->get('smcielopageloja_visae_parcelas');?>" value='visa'>Visa Electron</option>    				        
                <? }?>
                <? if ($this->config->get('smcielopageloja_cartao_visa') == 1) { ?>
                <option op='C' parc="<?php echo $this->config->get('smcielopageloja_visa_parcelas');?>" value='visa'>Visa Crédito</option>
                <? }?>
                <? if ($this->config->get('smcielopageloja_cartao_mastercard') == 1) { ?>
                <option op='C' parc="<?php echo $this->config->get('smcielopageloja_mastercard_parcelas');?>" value='mastercard'>Mastercard</option>
                <? }?>
                <? if ($this->config->get('smcielopageloja_cartao_diners') == 1) { ?>
                <option op='C' parc="<?php echo $this->config->get('smcielopageloja_diners_parcelas');?>" rel="<?php echo $this->config->get('smcielopageloja_visa_parcelas');?>" value='diners'>Diners</option>
                <? }?>
                <? if ($this->config->get('smcielopageloja_cartao_discover') == 1) { ?>
                <option op='C' parc="<?php echo $this->config->get('smcielopageloja_discover_parcelas');?>" value='discover'>Discover</option>
                <? }?>             
                <? if ($this->config->get('smcielopageloja_cartao_elo') == 1) { ?>
                <option op='C' parc="<?php echo $this->config->get('smcielopageloja_elo_parcelas');?>" value='elo'>Elo</option>              
                <? }?>              
                <? if ($this->config->get('smcielopageloja_cartao_amex') == 1) { ?>
                <option op='C' parc="<?php echo $this->config->get('smcielopageloja_amex_parcelas');?>" value='amex'>American Express</option>
                <? }?>                
                </select>    
                </td>          
                </tr>            
                <tr>
                    <td>Nome: </td>
                    <td><input type="text" title="Nome completo como impresso no cart&atilde;o" name="nome_cartao" value="" required="true" /></td>
                </tr>
                <tr>
                    <td>Nr. Cart&atilde;o: </td>
                    <td>                        
                        <input title="N&uacute;mero do seu cart&atilde;o" id="nr_cartao" maxlength="16"  type="text" name="nr_cartao" value="" required="true" />      
                        <br />                  
                        <strong style="line-height:10px;color:black; font-size: 8pt;">Somente n&uacute;meros</strong>
                    </td>
                </tr>
                <tr>
                    <td><span>Validade: </span></td>
                    <td>
                        <input class="input_cielo" placeholder="Ex: 12" type="text" onkeypress='return SomenteNumero(event)' title="M&ecirc;s de validade do seu cart&atilde;o" name="mes_cartao" id="mes_cartao" style="width: 50px;" maxlength="2" value="" required="true" />
                        /
                        <input class="input_cielo" type="text" onkeypress='return SomenteNumero(event)' pattern=".{4,}" title="Ano de validade do seu cart&atilde;o. Informe o ano completo Ex: 2015" name="ano_cartao" id="ano_cartao" style="width: 50px;" placeholder="Ex: 2015" maxlength="4" value="" required="true" /><br />                                                
                        <strong style="line-height:10px;color:black; font-size: 8pt;">Somente n&uacute;meros</strong>
                    </td>
                </tr>
                <tr>
                    <td>Cod. Seguran&ccedil;a: </td>
                    <td>
                        <input type="text"  onkeypress='return SomenteNumero(event)' title="C&oacute;digo de seguran&ccedil;a do seu cart&atilde;o" name="cod_seg" id="cod_seg" maxlength="4" value="" required="true" />
                        <br />
                        <strong style="line-height:10px;color:black; font-size: 8pt;">Somente n&uacute;meros</strong>
                    </td>
                </tr>
            </table>    	
        </td>
        <td style="width: 50%;" id="parcelas"></td>
        </tr>
	</table>
	<input type="hidden" name="valor_total" value="<?php echo $valor_total;?>" />
	<input type="hidden" name="pedido" value="<?php echo $this->session->data['order_id'];?>" />
	<div class="buttons">
		<div class="">
		 <input id="button-confirm" type="button" value="<?php echo $text_pagamento; ?>" class="button" />        
		</div>
	</div>
</form>

<p style="text-align:center"><?php echo $text_info; ?></p>