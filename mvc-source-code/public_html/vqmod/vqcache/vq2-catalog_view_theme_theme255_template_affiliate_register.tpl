<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="span12">
    <div class="warning"><?php echo $error_warning; ?></div>
  </div>
<?php } ?>
<div class="<?php if ($column_right) { ?>span9<?php } else {?>span12<?php } ?>">
	<div class="row">
<div class="<?php if ($column_left or $column_right) { ?>span9<?php } ?> <?php if ($column_left and $column_right) { ?>span6<?php } ?> <?php if (!$column_right and !$column_left) { ?>span12 <?php } ?>" id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <div class="box-container">
      <p><?php echo $text_account_already; ?></p>
      <p><?php echo $text_signup; ?></p>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="register">
        <h2><?php echo $text_your_details; ?></h2>
        <div class="content">
          <table class="form">
            <tr>
              <td><span class="required">*</span> <?php echo $entry_firstname; ?></td>
              <td><input class="q1" type="text" name="firstname" value="<?php echo $firstname; ?>" />
                <?php if ($error_firstname) { ?>
                <span class="error"><?php echo $error_firstname; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_lastname; ?></td>
              <td><input class="q1" type="text" name="lastname" value="<?php echo $lastname; ?>" />
                <?php if ($error_lastname) { ?>
                <span class="error"><?php echo $error_lastname; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_email; ?></td>
              <td><input class="q1" type="text" name="email" value="<?php echo $email; ?>" />
                <?php if ($error_email) { ?>
                <span class="error"><?php echo $error_email; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_telephone; ?></td>
              <td><input class="q1" type="text" name="telephone" value="<?php echo $telephone; ?>" />
                <?php if ($error_telephone) { ?>
                <span class="error"><?php echo $error_telephone; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_fax; ?></td>
              <td><input class="q1" type="text" name="fax" value="<?php echo $fax; ?>" /></td>
            </tr>
          </table>
        </div>
        <h2><?php echo $text_your_address; ?></h2>
        <div class="content">
          <table class="form">
            <tr>
              <td><?php echo $entry_company; ?></td>
              <td><input class="q1" type="text" name="company" value="<?php echo $company; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_website; ?></td>
              <td><input class="q1" type="text" name="website" value="<?php echo $website; ?>" /></td>
            </tr>

                
			<tr>
			  <td><span id="postcode-required" class="required">*</span> <?php echo $entry_postcode; ?></td>
			  
                
			<?php
				$wsceps = $this->config->get('wsceps');
				$config_language = $this->config->get('config_language');
				$config_country_id = $this->config->get('config_country_id');

				if($config_country_id == 30 && isset($wsceps['autocep']) && $wsceps['autocep']){
				?>
					<td><input type="text" name="postcode" value="<?php echo $postcode; ?>" maxlength="9" /> <a href="javascript:;"><img src="image/reload.png" id="autopreencher" style="position: relative; top: 4px"/></a>
			<?php }else { ?>
					<td><input type="text" name="postcode" value="'.$postcode.'" maxlength="9" />
			<?php } ?>
			
            
				<?php if ($error_postcode) { ?>
				<span class="error"><?php echo $error_postcode; ?></span>
				<?php } ?></td>
			</tr>
			
            
            <tr>
              <td><span class="required">*</span> <?php echo $entry_address_1; ?></td>
              <td><input class="q1" type="text" name="address_1" value="<?php echo $address_1; ?>" />
                <?php if ($error_address_1) { ?>
                <span class="error"><?php echo $error_address_1; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_address_2; ?></td>
              <td><input class="q1" type="text" name="address_2" value="<?php echo $address_2; ?>" /></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_city; ?></td>
              <td><input class="q1" type="text" name="city" value="<?php echo $city; ?>" />
                <?php if ($error_city) { ?>
                
                
				<span class="error"><?php echo $error_city; ?></span>
				<?php } ?></td>
			</tr>
			
            









            <tr>
              
                
			<?php
			$wsceps = $this->config->get('wsceps');
			?>
			<td><span class="required">*</span> <?php echo $entry_zone; ?></td>
			  <td><select name="zone_id">
				</select>
				<?php if ($error_zone) { ?>
				<span class="error"><?php echo $error_zone; ?></span>
				<?php } ?></td>
        </tr>
		<?php if ($wsceps['hide_country_set_brazil']) { ?>
        <tr style="display: none">
		<?php }else{ ?>
        <tr>
		<?php } ?>
          <td><span class="required">*</span> <?php echo $entry_country; ?></td>
          <td><select name="country_id">
              <option value=""><?php echo $text_select; ?></option>
              <?php foreach ($countries as $country) { ?>
              <?php if ($country['country_id'] == $country_id) { ?>
              <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
            <?php if ($error_country) { ?>
            <span class="error"><?php echo $error_country; ?></span>
            <?php } ?></td>
			
            





















            </tr>
          </table>
        </div>
        <h2><?php echo $text_payment; ?></h2>
        <div class="content">
          <table class="form">
            <tbody>
              <tr>
                <td><?php echo $entry_tax; ?></td>
                <td><input class="q1" type="text" name="tax" value="<?php echo $tax; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_payment; ?></td>
                <td><?php if ($payment == 'cheque') { ?>
                  <input type="radio" name="payment" value="cheque" id="cheque" checked="checked" />
                  <?php } else { ?>
                  <input type="radio" name="payment" value="cheque" id="cheque" />
                  <?php } ?>
                  <label for="cheque"><?php echo $text_cheque; ?></label>
                  <?php if ($payment == 'paypal') { ?>
                  <input type="radio" name="payment" value="paypal" id="paypal" checked="checked" />
                  <?php } else { ?>
                  <input type="radio" name="payment" value="paypal" id="paypal" />
                  <?php } ?>
                  <label for="paypal"><?php echo $text_paypal; ?></label>
                  <?php if ($payment == 'bank') { ?>
                  <input type="radio" name="payment" value="bank" id="bank" checked="checked" />
                  <?php } else { ?>
                  <input type="radio" name="payment" value="bank" id="bank" />
                  <?php } ?>
                  <label for="bank"><?php echo $text_bank; ?></label></td>
              </tr>
            </tbody>
            <tbody id="payment-cheque" class="payment">
              <tr>
                <td><?php echo $entry_cheque; ?></td>
                <td><input class="q1" type="text" name="cheque" value="<?php echo $cheque; ?>" /></td>
              </tr>
            </tbody>
            <tbody class="payment" id="payment-paypal">
              <tr>
                <td><?php echo $entry_paypal; ?></td>
                <td><input class="q1" type="text" name="paypal" value="<?php echo $paypal; ?>" /></td>
              </tr>
            </tbody>
            <tbody id="payment-bank" class="payment">
              <tr>
                <td><?php echo $entry_bank_name; ?></td>
                <td><input class="q1" type="text" name="bank_name" value="<?php echo $bank_name; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_bank_branch_number; ?></td>
                <td><input class="q1" type="text" name="bank_branch_number" value="<?php echo $bank_branch_number; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_bank_swift_code; ?></td>
                <td><input class="q1" type="text" name="bank_swift_code" value="<?php echo $bank_swift_code; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_bank_account_name; ?></td>
                <td><input class="q1" type="text" name="bank_account_name" value="<?php echo $bank_account_name; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_bank_account_number; ?></td>
                <td><input class="q1" type="text" name="bank_account_number" value="<?php echo $bank_account_number; ?>" /></td>
              </tr>
            </tbody>
          </table>
        </div>
        <h2><?php echo $text_your_password; ?></h2>
        <div class="content">
          <table class="form">
            <tr>
              <td><span class="required">*</span> <?php echo $entry_password; ?></td>
              <td><input class="q1" type="password" name="password" value="<?php echo $password; ?>" />
                <?php if ($error_password) { ?>
                <span class="error"><?php echo $error_password; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_confirm; ?></td>
              <td><input class="q1" type="password" name="confirm" value="<?php echo $confirm; ?>" />
                <?php if ($error_confirm) { ?>
                <span class="error"><?php echo $error_confirm; ?></span>
                <?php } ?></td>
            </tr>
          </table>
        </div>
        <?php if ($text_agree) { ?>
        <div class="buttons">
          <div class="right"><?php echo $text_agree; ?>
            <?php if ($agree) { ?>
            <input type="checkbox" name="agree" value="1" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="agree" value="1" />
            <?php } ?>
            <a onclick="$('#register').submit();" class="button"><span><?php echo $button_continue; ?></span></a>
          </div>
        </div>
        <?php } else { ?>
        <div class="buttons">
          <div class="right">
            <a onclick="$('#register').submit();" class="button"><span><?php echo $button_continue; ?></span></a>
          </div>
        </div>
        <?php } ?>
      </form>
  </div>
  <?php echo $content_bottom; ?></div>
        <?php echo $column_left; ?>
	</div>
</div>
<?php echo $column_right; ?>

<script type="text/javascript"><!--

                
			<?php
				$wsceps = $this->config->get('wsceps');
				$config_language = $this->config->get('config_language');
				$config_country_id = $this->config->get('config_country_id');

				if(isset($wsceps['autocep']) && $wsceps['autocep'])
				{

					$hideDisabled = isset($wsceps['acaocampos']) ? $wsceps['acaocampos'] : 1;
					$disabledOrOcult = $enableShow = '';
					if($config_country_id == 30 && $this->request->server['REQUEST_METHOD'] != 'POST')
					{
						if($hideDisabled == 2)
						{
							$disabledOrOcult = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']").attr(\'disabled\', \'disabled\').attr(\'title\', \'Preencha o CEP primeiro\');';
							$enableShow = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']").removeAttr(\'disabled\').removeAttr(\'title\');';
						}
						if($hideDisabled == 3)
						{
							$disabledOrOcult = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']").parent().parent().hide();';
							$enableShow = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']").parent().parent().show();';
						}
					}

					echo $disabledOrOcult;
			?>
					var warning_street_number = "<?php echo $wsceps['warning_street_number']; ?>";
					$("select[name='country_id']").change(function()
					{
						if(this.value == 30)
						{
							if($("#autopreencher").length == 0)
							{
								$("input[name='postcode']").after(' <a href="javascript:;"><img src="image/reload.png" id="autopreencher" style="position: relative; top: 4px"/></a>');
							}
						}
						else
						{
							$("#autopreencher").remove();
						<?php
							echo $enableShow;
						?>
						}
					});

				<?php if($wsceps['wsmethod'] == 2){ ?>
				$("input[name='postcode']").live("change", function()
				{
					$autopreencherButton = $("#autopreencher");
				<?php }else{ ?>
				$("#autopreencher").live("click", function()
				{
					$autopreencherButton = $(this);
				<?php } ?>
				erValCep = /^[0-9]{5}-?[0-9]{3}$/;
				cep = $("input[name='postcode']").val();
				if(!erValCep.test(cep))
				{
					$("input[name='postcode']").focus().select();
					return false;
				}

				<?php
				if(defined('_JEXEC'))
				{
					echo 'url = "index.php?option=com_mijoshop&format=raw&tmpl=component&route=account/register/getcep&cep="+cep;';
				}
				else
				{
					echo 'url = "index.php?route=account/register/getcep&cep="+cep;';
				}
				?>

				$.ajax(
				{
					url: url,
					dataType: "json",
					beforeSend: function()
					{
						<?php if(defined('_JEXEC'))
						{
							echo '$autopreencherButton.after(\'<span class="wait">&nbsp;<img src="components/com_mijoshop/opencart/image/loading.gif" alt="" /></span>\');';
						}
						else
						{
							echo '$autopreencherButton.after(\'<span class="wait">&nbsp;<img src="image/loading.gif" alt="" /></span>\');';
						}
						?>
						$autopreencherButton.hide();
					},
					success: function(rpt)
					{
						$(".wait").remove();
						$autopreencherButton.show();
						<?php
							echo $enableShow;
						?>
						if(rpt.success)
						{
							$(".lembrete").remove();
							$("input[name='address_1']").val(rpt.data.logradouro);
							$("input[name='address_2']").val(rpt.data.bairro);
							$("input[name='city']").val(rpt.data.cidade);
							$("select[name='country_id'] option[value='30']").attr('selected',true).trigger("change");
							$("input[name=\'address_1\']").after("<span class='lembrete' style='color: red'><br />"+warning_street_number+"</span>");

							setTimeout(function()
							{
								$("select[name='zone_id'] option").each(function()
								{
									if($(this).text().toLowerCase() == rpt.data.estado.toLowerCase())
									{
										$(this).attr('selected',true);
									}
								});
							}, 1000);
						}
					},
					error: function()
					{
						$(".wait").remove();
						$autopreencherButton.show();
						<?php
						echo $enableShow;
						?>
					}
				});
			});
			<?php } ?>
			
            
$('select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=affiliate/register/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/theme255/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#postcode-required').show();
			} else {
				$('#postcode-required').hide();
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script>
<script type="text/javascript"><!--
$('input[name=\'payment\']').bind('change', function() {
	$('.payment').hide();
	
	$('#payment-' + this.value).show();
});

$('input[name=\'payment\']:checked').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.colorbox').fancybox({
		
	});
});
//--></script> 
<?php echo $footer; ?>