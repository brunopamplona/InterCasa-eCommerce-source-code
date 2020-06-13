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
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
         <div id="tabs" class="htabs">
            <a href="#tab_config" id="link_tab_config"><?php echo $tab_config; ?></a>
            <a href="#tab_config_avanc" id="link_tab_config_avanc"><?php echo $tab_config_avanc; ?></a>            
         </div>
         
         <div id="tab_config">
            <table class="form">
            <tr>
              <td><?php echo $entry_fraud_key_systemmaster; ?></td>
              <td>
                <input type="text" name="smclearsale_sm_chave" value="<?php echo $smclearsale_sm_chave; ?>" />
                <?php if($error_smclearsale_sm_chave){ ?>
                <span class="error"><?php echo $error_smclearsale_sm_chave; ?></span>
                <?php } ?>
              </td>
            </tr>  
            <tr>
              <td><?php echo $entry_fraud_key_clearsale; ?></td>
              <td>
                <input type="text" name="smclearsale_chave" value="<?php echo $smclearsale_chave; ?>" />
                <?php if($error_smclearsale_chave){ ?>
                <span class="error"><?php echo $error_smclearsale_chave; ?></span>
                <?php } ?>
              </td>
            </tr>  
            <tr>
              <td><?php echo $entry_fraud_detection_clearsale; ?></td>
              <td><?php if ($smclearsale_status) { ?>
                <input type="radio" name="smclearsale_status" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="smclearsale_status" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="smclearsale_status" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="smclearsale_status" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_clearsale_teste; ?></td>
              <td><?php if (!$smclearsale_teste) { ?>
                <input type="radio" name="smclearsale_teste" value="0" checked="checked" />
                <?php echo $text_clearsale_prod; ?>
                <input type="radio" name="smclearsale_teste" value="1" />
                <?php echo $text_clearsale_homolog; ?>
                <?php } else { ?>
                <input type="radio" name="smclearsale_teste" value="0" />
                <?php echo $text_clearsale_prod; ?>
                <input type="radio" name="smclearsale_teste" value="1" checked="checked" />
                <?php echo $text_clearsale_homolog; ?>
                <?php } ?></td>
            </tr>                                  
          </table>
         </div>
         

          <div id="tab_config_avanc">
               <h2><?php echo $entry_clearsale_form_pag; ?></h2>
               <table class="list">                                              
                <thead>
                    <tr>
                        <td class="left">CLEAR SALE</td>
                        <td class="left">LOJA</td>
                    </tr>
                </thead>   
                <tbody> 
                    <tr>
                        <td class="left"><span>1</span> - <span>Cartão de Crédito</span></td>
                        <td class="left">
                            <select name="smclearsale_form_pag[1]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                <?php if($v['cod']==$smclearsale_form_pag[1]){ ?>
                                    <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                 <?php } ?>
                                <?php } ?>
                            </select> 
                        </td>
                    </tr>    
                    <tr>
                        <td><span>2</span> - <span>Boleto Bancário</span></td>
                        <td>
                            <select name="smclearsale_form_pag[2]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                <?php if($v['cod']==$smclearsale_form_pag[2]){ ?>
                                    <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                 <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>                                    
                    <tr>
                        <td><span>3</span> - <span>Débito bancário</span></td>
                        <td>
                            <select name="smclearsale_form_pag[3]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                    <?php if($v['cod']==$smclearsale_form_pag[3]){ ?>
                                        <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                     <?php } ?>
                                <?php } ?>
                            </select> 
                        </td>
                    </tr>
                    <tr>
                        <td><span>4</span> - <span>Débito Bancário – Dinheiro</span></td>
                        <td>
                            <select name="smclearsale_form_pag[4]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                <?php if($v['cod']==$smclearsale_form_pag[4]){ ?>
                                    <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                 <?php } ?>
                                <?php } ?>
                            </select>  
                        </td>
                    </tr>
                    <tr>
                        <td><span>5</span> - <span>Débito Bancário – Cheque</span></td>
                        <td>
                             <select name="smclearsale_form_pag[5]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                    <?php if($v['cod']==$smclearsale_form_pag[5]){ ?>
                                        <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                     <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><span>6</span> - <span>Transferência Bancária</span></td>
                        <td>
                            <select name="smclearsale_form_pag[6]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                    <?php if($v['cod']==$smclearsale_form_pag[6]){ ?>
                                        <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                     <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><span>7</span> - <span>Sedex a Cobrar</span></td>
                        <td>
                            <select name="smclearsale_form_pag[7]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                    <?php if($v['cod']==$smclearsale_form_pag[7]){ ?>
                                        <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                     <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><span>8</span> - <span>Cheque</span></td>
                        <td>
                            <select name="smclearsale_form_pag[8]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                    <?php if($v['cod']==$smclearsale_form_pag[8]){ ?>
                                        <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                     <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><span>9</span> - <span>Dinheiro</span></td>
                        <td>
                            <select name="smclearsale_form_pag[9]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                    <?php if($v['cod']==$smclearsale_form_pag[9]){ ?>
                                        <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                     <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><span>10</span> - <span>Financiamento</span></td>
                        <td>
                            <select name="smclearsale_form_pag[10]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                    <?php if($v['cod']==$smclearsale_form_pag[10]){ ?>
                                        <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                     <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><span>11</span> - <span>Fatura</span></td>
                        <td>
                            <select name="smclearsale_form_pag[11]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                    <?php if($v['cod']==$smclearsale_form_pag[11]){ ?>
                                        <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                     <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><span>12</span> - <span>Cupom</span></td>
                        <td>
                            <select name="smclearsale_form_pag[12]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                    <?php if($v['cod']==$smclearsale_form_pag[12]){ ?>
                                        <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                     <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><span>13</span> - <span>Multicheque</span></td>
                        <td>
                            <select name="smclearsale_form_pag[13]">
                                <option value="0">Não informado</option>   
                                <?php foreach($meiosdepagamentos as $k=>$v){ ?>
                                    <?php if($v['cod'] == $smclearsale_form_pag[13]){ ?>
                                        <option selected="true" value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $v['cod']; ?>"><?php echo $v['name'];?></option>
                                     <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr> 
                    </tbody>
                </table> 

                <h2><?php echo $entry_clearsale_status_pedidos; ?></h2>
                
                <?php foreach ($status_pedidos as $key => $status): ?>
                    <div>
                    <?php if (in_array($status['order_status_id'], $smclearsale_status_pedidos)): ?>
                        <input type="checkbox" checked="true" name="smclearsale_status_pedidos[]" value="<?php echo $status['order_status_id'] ?>">
                    <?php else: ?>
                        <input type="checkbox" name="smclearsale_status_pedidos[]" value="<?php echo $status['order_status_id'] ?>">
                    <?php endif ?>                                    
                    <span><?php echo $status['name']; ?></span> 
                    </div>
                <?php endforeach ?>  
          </div>

      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
    $('#tabs a').tabs(); 
//--></script>
<?php echo $footer; ?>