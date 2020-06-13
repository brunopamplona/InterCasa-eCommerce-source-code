<div class="row-fluid">
	<div class="span6">
		<h2><?php echo $text_your_details; ?></h2>
		<span class="required">*</span> <?php echo $entry_firstname; ?><br />
		<input type="text" name="firstname" value="" class="large-field" />
		<br />
		<br />
		<span class="required">*</span> <?php echo $entry_lastname; ?><br />
		<input type="text" name="lastname" value="" class="large-field" />
		<br />
		<br />
		<span class="required">*</span> <?php echo $entry_email; ?><br />
		<input type="text" name="email" value="" class="large-field" />
		<br />
		<br />
		<span class="required">*</span> <?php echo $entry_telephone; ?><br />
		<input type="text" name="telephone" value="" class="large-field" />
		<br />
		<br />
		<span id="fax-required" class="required">*</span> <?php echo $entry_fax; ?><br />
		<input type="text" name="fax" id="register_fax" value="" class="large-field" />
		<br />
		<br />
		<h2><?php echo $text_your_password; ?></h2>
		<span class="required">*</span> <?php echo $entry_password; ?><br />
		<input type="password" name="password" value="" class="large-field" />
		<br />
		<br />
		<span class="required">*</span> <?php echo $entry_confirm; ?> <br />
		<input type="password" name="confirm" value="" class="large-field" />
		<br />
		<br />
		<br />
	</div>

	<div class="span6">
		<h2><?php echo $text_your_address; ?></h2>
		
                
                        
            



		<div style="display: <?php echo (count($customer_groups) > 1 ? 'table-row' : 'none'); ?>;">
			<?php echo $entry_customer_group; ?><br />
			<?php foreach ($customer_groups as $customer_group) { ?>
				<?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
					<input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" id="customer_group_id<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
					<label for="customer_group_id<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></label>
					<br />
				<?php } else { ?>
					<input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" id="customer_group_id<?php echo $customer_group['customer_group_id']; ?>" />
					<label for="customer_group_id<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></label>
					<br />
				<?php } ?>
			<?php } ?>
			<br />
		</div>
		<div id="company-id-display"><span id="company-id-required" class="required">*</span> <?php echo $entry_company_id; ?><br />
			<input type="text" name="company_id" value="" class="large-field" />
			<br />
			<br />
		</div>
		<div id="tax-id-display"><span id="tax-id-required" class="required">*</span> <?php echo $entry_tax_id; ?><br />
			<input type="text" name="tax_id" value="" class="large-field" />
			<br />
			<br />
		</div>

                
			<span id="payment-postcode-required" class="required">*</span> <?php echo $entry_postcode; ?><br />
			<input type="text" name="postcode" value="<?php echo $postcode; ?>" class="large-field" />
			<br />
			<br />
			
            
		<span class="required">*</span> <?php echo $entry_address_1; ?><br />
		<input type="text" name="address_1" value="" class="large-field" />
		<br />
		<br />
		<?php echo $entry_company; ?><br />
		<input type="text" name="company" value="" class="large-field" />
		<br />
		<br />
		<?php echo $entry_address_2; ?><br />
		<input type="text" name="address_2" value="" class="large-field" />
		<br />
		<br />
		<span class="required">*</span> <?php echo $entry_city; ?><br />
		<input type="text" name="city" value="" class="large-field" />
		<br />
		<br />
		
                
			<?php
			$wsceps = $this->config->get('wsceps');
			?>
			<span class="required">*</span> <?php echo $entry_zone; ?><br />
			<select name="zone_id" class="large-field">
			</select>
			<br />
			<br />
			<?php if ($wsceps['hide_country_set_brazil'])
			{
				echo '<div style="display: none">';
			}
			?>
			<span class="required">*</span> <?php echo $entry_country; ?><br />
			<select name="country_id" class="large-field">
			  <option value=""><?php echo $text_select; ?></option>
			  <?php foreach ($countries as $country) { ?>
			  <?php if ($country['country_id'] == $country_id) { ?>
			  <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
			  <?php } else { ?>
			  <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
			  <?php } ?>
			  <?php } ?>
			</select>
			<?php if ($wsceps['hide_country_set_brazil'])
			{
				echo '</div>';
			}
			?>
			
            















		<br />
		<br />
		<br />
	</div>
</div>
<!-- /.row-fluid -->
<div style="clear: both; padding-top: 15px; border-top: 1px solid #EEEEEE;">
  <label for="newsletter">
  <input class="checkbox" type="checkbox" name="newsletter" value="1" id="newsletter" />
  <?php echo $entry_newsletter; ?></label>
  <br />
  <?php if ($shipping_required) { ?>
  <input type="checkbox" name="shipping_address" value="1" id="shipping" checked="checked" />
  <label for="shipping"><?php echo $entry_shipping; ?></label>
  
  <?php } ?>

</div>
<?php if ($text_agree) { ?>
<div class="buttons">
  <div><label class="checkbox">
    <?php echo $text_agree; ?>
    <input type="checkbox" name="agree" value="1" />
    </label>
    <a id="button-register" class="button"><span><?php echo $button_continue; ?></span></a>
  </div>
</div>
<?php } else { ?>
<div class="buttons">
  <div class="right">
    <a id="button-register" class="button"><span><?php echo $button_continue; ?></span></a>
  </div>
</div>
<?php } ?>
<script type="text/javascript"><!--

                
			<?php
				$wsceps = $this->config->get('wsceps');
				$config_language = $this->config->get('config_language');
				$config_country_id = $this->config->get('config_country_id');

				if(isset($wsceps['autocep']) && $wsceps['autocep'])
				{
					//$hideDisabled = isset($wsceps['acaocampos']) && $wsceps['acaocampos'] == 2 ? 2 : 1;
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
			
            
$('#payment-address input[name=\'customer_group_id\']:checked').live('change', function() {
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_required'] = '<?php echo $customer_group['company_id_required']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_required'] = '<?php echo $customer_group['tax_id_required']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('#company-id-display').show();
		} else {
			$('#company-id-display').hide();
		}
		
		if (customer_group[this.value]['company_id_required'] == '1') {
			$('#company-id-required').show();
		} else {
			$('#company-id-required').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('#tax-id-display').show();
		} else {
			$('#tax-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_required'] == '1') {
			$('#tax-id-required').show();
		} else {
			$('#tax-id-required').hide();
		}	
	}
});

$('#payment-address input[name=\'customer_group_id\']:checked').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('#payment-address select[name=\'country_id\']').bind('change', function() {
    if (this.value == '') return;
	$.ajax({
		url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#payment-address select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/theme255/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#payment-postcode-required').show();
			} else {
				$('#payment-postcode-required').hide();
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
			
			$('#payment-address select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#payment-address select[name=\'country_id\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('.colorbox').colorbox({
	width: 640,
	height: 480
});
//--></script> 