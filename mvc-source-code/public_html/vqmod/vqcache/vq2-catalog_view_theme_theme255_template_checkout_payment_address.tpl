<?php if ($addresses) { ?>
<label class="radio" for="payment-address-existing"><?php echo $text_address_existing; ?>
	<input type="radio" name="payment_address" value="existing" id="payment-address-existing" checked="checked" />
</label>
<div id="payment-existing">
  <select name="address_id" style="width: 100%; margin-bottom: 15px;" size="5">
	<?php foreach ($addresses as $address) { ?>
	<?php if ($address['address_id'] == $address_id) { ?>
	<option value="<?php echo $address['address_id']; ?>" selected="selected"><?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?></option>
	<?php } else { ?>
	<option value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?></option>
	<?php } ?>
	<?php } ?>
  </select>
</div>
<p>
	<label class="radio" for="payment-address-new"><?php echo $text_address_new; ?>
		<input type="radio" name="payment_address" value="new" id="payment-address-new" />
	</label>
</p>
<?php } ?>
<div id="payment-new" style="display: <?php echo ($addresses ? 'none' : 'block'); ?>;">
	<div class="form form-horizontal">
		<div class="control-group">
			<label class="control-label" for="firstname"><span class="required">*</span> <?php echo $entry_firstname; ?></label>
			<div class="controls">
				<input type="text" name="firstname" value="" class="large-field" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="lastname"><span class="required">*</span> <?php echo $entry_lastname; ?></label>
			<div class="controls">
				<input type="text" name="lastname" value="" class="large-field" />
			</div>
		</div>

		<?php if ($company_id_display) { ?>
		<div class="control-group">
			<label class="control-label" for="company_id">
				<?php if ($company_id_required) { ?>
					<span class="required">*</span>
				<?php } ?>
			<?php echo $entry_company_id; ?></label>
			<div class="controls">
				<input type="text" name="company_id" value="" class="large-field" />
			</div>
		</div>
		<?php } ?>
		<?php if ($tax_id_display) { ?>
		<div class="control-group">
			<label class="control-label" for="tax_id">
				<?php if ($tax_id_required) { ?>
				<span class="required">*</span>
				<?php } ?>
				<?php echo $entry_tax_id; ?>
			</label>
			<div class="controls">
				<input type="text" name="tax_id" value="" class="large-field" />
			</div>
		</div>
		<?php } ?>
		<div class="control-group">
			<label class="control-label" for="postcode"><span id="payment-postcode-required" class="required">*</span> <?php echo $entry_postcode; ?></label>
			<div class="controls">
				<input type="text" name="postcode" value="" class="large-field" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="address_1"><span class="required">*</span> <?php echo $entry_address_1; ?></label>
			<div class="controls">
				<input type="text" name="address_1" value="" class="large-field" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="company"><?php echo $entry_company; ?></label>
			<div class="controls">
				<input type="text" name="company" value="" class="large-field" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="address_2"><?php echo $entry_address_2; ?></label>
			<div class="controls">
				<input type="text" name="address_2" value="" class="large-field" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="city"><span class="required">*</span> <?php echo $entry_city; ?></label>
			<div class="controls">
				<input type="text" name="city" value="" class="large-field" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="country_id"><span class="required">*</span> <?php echo $entry_country; ?></label>
			<div class="controls">
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
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="address_2"><span class="required">*</span> <?php echo $entry_zone; ?></label>
			<div class="controls">
				<select name="zone_id" class="large-field"></select>
			</div>
		</div>
	</div>
</div>
<br />
<div class="buttons">
  <div class="right">
	<a id="button-payment-address" class="button-cont-right fright" ><?php echo $button_continue; ?><i class="icon-circle-arrow-right"></i></a>
  </div>
</div>
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
							$disabledOrOcult = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']", "#payment-new").attr(\'disabled\', \'disabled\');';
							$enableShow = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']", "#payment-new").removeAttr(\'disabled\');';
						}
						if($hideDisabled == 3)
						{
							$disabledOrOcult = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']", "#payment-new").parent().parent().hide();';
							$enableShow = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']", "#payment-new").parent().parent().show();';
						}
					}

					echo $disabledOrOcult;
			?>
					var warning_street_number = "<?php echo $wsceps['warning_street_number']; ?>";
					$("select[name='country_id']", "#payment-new").change(function()
					{
						if(this.value == 30)
						{
							if($("#autopreencher3").length == 0)
							{
								$("input[name='postcode']", "#payment-new").after(' <a href="javascript:;"><img src="image/reload.png" id="autopreencher3" style="position: relative; top: 4px"/></a>');

							}
						}
						else
						{
							$("#autopreencher3").remove();
						<?php
							echo $enableShow;
						?>
						}
					});

				<?php if($wsceps['wsmethod'] == 2){ ?>
				$("input[name='postcode']", "#payment-new").live("change", function()
				{
					$autopreencher3Button = $("#autopreencher3");
				<?php }else{ ?>
				$("#autopreencher3").live("click", function()
				{
					$autopreencher3Button = $(this);
				<?php } ?>

				erValCep = /^[0-9]{5}-?[0-9]{3}$/;
				cep = $("input[name='postcode']", "#payment-new").val();
				if(!erValCep.test(cep))
				{
					$("input[name='postcode']", "#payment-new").focus().select();
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
							echo '$autopreencher3Button.after(\'<span class="wait">&nbsp;<img src="components/com_mijoshop/opencart/image/loading.gif" alt="" /></span>\');';
						}
						else
						{
							echo '$autopreencher3Button.after(\'<span class="wait">&nbsp;<img src="image/loading.gif" alt="" /></span>\');';
						}
						?>
						$autopreencher3Button.hide();
					},
					success: function(rpt)
					{
						$(".wait").remove();
						$autopreencher3Button.show();
						<?php
							echo $enableShow;
						?>
						if(rpt.success)
						{
							$(".lembrete").remove();
							$("input[name='address_1']", "#payment-new").val(rpt.data.logradouro);
							$("input[name='address_2']", "#payment-new").val(rpt.data.bairro);
							$("input[name='city']", "#payment-new").val(rpt.data.cidade);
							$("select[name='country_id'] option[value='30']", "#payment-new").attr('selected',true).trigger("change");
							$("input[name=\'address_1\']", "#payment-new").after("<span class='lembrete' style='color: red'><br />"+warning_street_number+"</span>");

							setTimeout(function()
							{
								$("select[name='zone_id'] option", "#payment-new").each(function()
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
						$autopreencher3Button.show();
						<?php
						echo $enableShow;
						?>
					}
				});
			});
			<?php } ?>
			
            
$('#payment-address input[name=\'payment_address\']').live('change', function() {
	if (this.value == 'new') {
		$('#payment-existing').hide();
		$('#payment-new').show();
	} else {
		$('#payment-existing').show();
		$('#payment-new').hide();
	}
});
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
//--></scri