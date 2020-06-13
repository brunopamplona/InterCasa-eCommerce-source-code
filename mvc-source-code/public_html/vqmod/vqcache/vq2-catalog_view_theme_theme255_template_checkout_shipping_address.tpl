<?php if ($addresses) { ?>
<label class="radio" for="shipping-address-existing"><?php echo $text_address_existing; ?>
		<input type="radio" name="shipping_address" value="existing" id="shipping-address-existing" checked="checked" />
</label>
<div id="shipping-existing">
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
	<label class="radio" for="shipping-address-new"><?php echo $text_address_new; ?>
		<input type="radio" name="shipping_address" value="new" id="shipping-address-new" />
	</label>
</p>
<?php } ?>
<div id="shipping-new" class="xxxx" style="display: <?php echo ($addresses ? 'none' : 'block'); ?>;">
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

	  <div class="control-group">
		  <label class="control-label" for="postcode"><span id="shipping-postcode-required" class="required">*</span> <?php echo $entry_postcode; ?></label>
		  <div class="controls">
			  <input type="text" name="postcode" value="<?php echo $postcode; ?>" class="large-field" />
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
<div class="buttons">
  <div class="right">
   <a id="button-shipping-address" class="button-cont-right fright" ><?php echo $button_continue; ?><i class="icon-circle-arrow-right"></i></a>
  </div>
</div>
<script type="text/javascript"><!--
$('#shipping-address input[name=\'shipping_address\']').live('change', function() {
	if (this.value == 'new') {
		$('#shipping-existing').hide();
		$('#shipping-new').show();
	} else {
		$('#shipping-existing').show();
		$('#shipping-new').hide();
	}
});
//--></script> 
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
							$disabledOrOcult = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']", "#shipping-new").attr(\'disabled\', \'disabled\');';
							$enableShow = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']").removeAttr(\'disabled\');';
						}
						if($hideDisabled == 3)
						{
							$disabledOrOcult = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']", "#shipping-new").parent().parent().hide();';
							$enableShow = '$("input[name=\'address_1\'], input[name=\'address_2\'], input[name=\'city\']", "#shipping-new").parent().parent().show();';
						}
					}

					echo $disabledOrOcult;
			?>
					var warning_street_number = "<?php echo $wsceps['warning_street_number']; ?>";
					$("select[name='country_id']", "#shipping-new").change(function()
					{
						if(this.value == 30)
						{
							if($("#autopreencher2").length == 0)
							{
								$("input[name='postcode']", "#shipping-new").after(' <a href="javascript:;"><img src="image/reload.png" id="autopreencher2" style="position: relative; top: 4px"/></a>');

							}
						}
						else
						{
							$("#autopreencher2").remove();
						<?php
							echo $enableShow;
						?>
						}
					});

				<?php if($wsceps['wsmethod'] == 2){ ?>
				$("input[name='postcode']", "#shipping-new").live("change", function()
				{
					$autopreencher2Button = $("#autopreencher2");
				<?php }else{ ?>
				$("#autopreencher2").live("click", function()
				{
					$autopreencher2Button = $(this);
				<?php } ?>

				erValCep = /^[0-9]{5}-?[0-9]{3}$/;
				cep = $("input[name='postcode']", "#shipping-new").val();
				if(!erValCep.test(cep))
				{
					$("input[name='postcode']", "#shipping-new").focus().select();
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
							echo '$autopreencher2Button.after(\'<span class="wait">&nbsp;<img src="components/com_mijoshop/opencart/image/loading.gif" alt="" /></span>\');';
						}
						else
						{
							echo '$autopreencher2Button.after(\'<span class="wait">&nbsp;<img src="image/loading.gif" alt="" /></span>\');';
						}
						?>
						$autopreencher2Button.hide();
					},
					success: function(rpt)
					{
						$(".wait").remove();
						$autopreencher2Button.show();
						<?php
							echo $enableShow;
						?>
						if(rpt.success)
						{
							$(".lembrete").remove();
							$("input[name='address_1']", "#shipping-new").val(rpt.data.logradouro);
							$("input[name='address_2']", "#shipping-new").val(rpt.data.bairro);
							$("input[name='city']", "#shipping-new").val(rpt.data.cidade);
							$("select[name='country_id'] option[value='30']", "#shipping-new").attr('selected',true).trigger("change");
							$("input[name='address_1']", "#shipping-new").after("<span class='lembrete' style='color: red'><br />"+warning_street_number+"</span>");

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
						$autopreencher2Button.show();
						<?php
						echo $enableShow;
						?>
					}
				});
			});
			<?php } ?>
			
            
$('#mark');
$('#shipping-address select[name=\'country_id\']').bind('change', function() {
	if (this.value == '') return;
	$.ajax({
		url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#shipping-address select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/theme255/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#shipping-postcode-required').show();
			} else {
				$('#shipping-postcode-required').hide();
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
			
			$('#shipping-address select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#shipping-address select[name=\'country_id\']').trigger('change');
//--></script>