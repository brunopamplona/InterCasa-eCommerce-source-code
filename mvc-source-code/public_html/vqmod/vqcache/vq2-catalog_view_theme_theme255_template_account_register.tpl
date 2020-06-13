<?php echo $header; ?>
<?php if ($error_warning) { ?>
	<div class="span12">
		<div class="warning"><?php echo $error_warning; ?></div>
	</div>
<?php } ?>
	<div class="<?php if ($column_right) { ?>span9<?php } else { ?>span12<?php } ?>">
	<div class="row">
	<div class="<?php if ($column_left or $column_right) { ?>span9<?php } ?> <?php if ($column_left and $column_right
	) {
		?>span6<?php } ?> <?php if (!$column_right and !$column_left) { ?>span12 <?php } ?>" id="content"><?php echo $content_top; ?>
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>
	<h1><?php echo $heading_title; ?></h1>

	<div class="box-container">
	<?php echo $content_bottom; ?>
	<p><?php echo $text_account_already; ?></p>

	<form class="form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="register">
	<div class="content">
	<div class="container-fluid">

		<div class="row-fluid">
			<div class="span6">
				<h2><?php echo $text_your_details; ?></h2>
				<!--nome-->
				<div class="control-group">
					<label class="control-label" for="firstname"><span class="required">*</span> <?php echo $entry_firstname; ?></label>

					<div class="controls">
						<input class="span9" type="text" name="firstname" required="required" value="<?php echo $firstname; ?>"/>
						<?php if ($error_firstname) { ?>
							<span class="error help-inline"><?php echo $error_firstname; ?></span>
						<?php } ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="lastname"><span class="required">*</span> <?php echo $entry_lastname; ?></label>

					<div class="controls">
						<input class="span9" type="text" name="lastname" required="required" value="<?php echo $lastname; ?>"/>
						<?php if ($error_lastname) { ?>
							<span class="error help-inline"><?php echo $error_lastname; ?></span>
						<?php } ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="email"><span class="required">*</span> <?php echo $entry_email; ?></label>

					<div class="controls">
						<input class="span10" type="text" required="required" name="email" value="<?php echo $email; ?>"/>
						<?php if ($error_email) { ?>
							<span class="error help-inline"><?php echo $error_email; ?></span>
						<?php } ?>
					</div>
				</div>

				<div id="tax-id-display">
					<div class="control-group">
						<label class="control-label" for="tax_id"><span id="tax-id-required" class="required">*</span> <?php echo $entry_tax_id; ?></label>

						<div class="controls">
							<input class="span6" type="text" required="required" name="tax_id" value="<?php echo $tax_id; ?>"/>
							<?php if ($error_tax_id) { ?>
								<span class="error help-inline"><?php echo $error_tax_id; ?></span>
							<?php } ?>
						</div>
					</div>
				</div>
				<!-- /#tax-id-display -->


				<div class="control-group">
					<label class="control-label" for="telephone"><span class="required">*</span> <?php echo $entry_telephone; ?></label>

					<div class="controls">
						<input class="span5" type="tel" required="required" name="telephone" value="<?php echo $telephone; ?>"/>
						<?php if ($error_telephone) { ?>
							<span class="error help-inline"><?php echo $error_telephone; ?></span>
						<?php } ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="fax"> <span id="fax-required" class="required">*</span><?php echo $entry_fax; ?></label>

					<div class="controls">
						<input class="span5" type="tel" required="required" name="fax" value="<?php echo $fax; ?>"/>
						<?php if ($error_fax) { ?>
							<span class="error help-inline"><?php echo $error_fax; ?></span>
						<?php } ?>
					</div>
				</div>

			</div>
			<!-- /.span6 -->
			<div class="span6">
				<h2><?php echo $text_your_address; ?></h2>
				<!-- field -->
				<div class="control-group">
					<label class="control-label" for="postcode">
                   <span id="postcode-required" class="required">*</span> <?php echo $entry_postcode; ?>
					</label>

					<div class="controls">
						
                
			<?php
				$wsceps = $this->config->get('wsceps');
				$config_language = $this->config->get('config_language');
				$config_country_id = $this->config->get('config_country_id');

				if($config_country_id == 30 && isset($wsceps['autocep']) && $wsceps['autocep'])
				{
					echo '<input class="span4"  type="text" name="postcode" value="'.$postcode.'" maxlength="9" placeholder="XXXXX-XXX" /> <a href="javascript:;"><img src="image/reload.png" id="autopreencher" style="position: relative; top: 4px"/></a>';
				}else
				{
					echo '<input class="span4"  type="text" name="postcode" value="'.$postcode.'" />';
				}
			?>
			
            
						<?php if ($error_postcode) { ?>
							<span class="error help-inline"><?php echo $error_postcode; ?></span>
						<?php } ?>
					</div>
				</div>
				<!-- field -->
				<div id="company-id-display">
					<div class="control-group" style="display: <?php echo(count($customer_groups) > 1 ? 'block' : 'none'); ?>;">
						<label class="control-label" for="customer_group_id"><?php echo $entry_customer_group; ?></label>

						<div class="controls">
							<?php foreach ($customer_groups as $customer_group) { ?>
								<?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
									<label class="radio" for="customer_group_id<?php echo $customer_group['customer_group_id']; ?>">
										<input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>"
										       id="customer_group_id<?php echo $customer_group['customer_group_id']; ?>" checked="checked"/>
										<?php echo $customer_group['name']; ?>
									</label>
								<?php } else { ?>

									<label class="radio" for="customer_group_id<?php echo $customer_group['customer_group_id']; ?>">
										<input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>"
										       id="customer_group_id<?php echo $customer_group['customer_group_id']; ?>"/>
										<?php echo $customer_group['name']; ?>
									</label>
									<br/>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>
				<!-- /#company-id-display -->

				<div class="control-group">
					<label class="control-label" for="address_1"><span class="required">*</span> <?php echo $entry_address_1; ?></label>

					<div class="controls">
						<input class="span10" required="required" type="text" name="address_1" value="<?php echo $address_1; ?>"/>
						<?php if ($error_address_1) { ?>
							<span class="error"><?php echo $error_address_1; ?></span>
						<?php } ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="telephone"><?php echo $entry_company; ?></label>

					<div class="controls">
						<input class="span10" type="text" name="company" value="<?php echo $company; ?>"/>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="address_2"><?php echo $entry_address_2; ?></label>

					<div class="controls">
						<input class="span8" type="text" name="address_2" value="<?php echo $address_2; ?>"/>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="city"><span class="required">*</span> <?php echo $entry_city; ?></label>

					<div class="controls">
						<input class="span10" required="required" type="text" name="city" value="<?php echo $city; ?>"/>
						<?php if ($error_city) { ?>
							<span class="error help-inline"><?php echo $error_city; ?></span>
						<?php } ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="country_id"><span class="required">*</span> <?php echo $entry_country; ?></label>

					<div class="controls">
						<select name="country_id">
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
							<span class="error help-inline"><?php echo $error_country; ?></span>
						<?php } ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="zone_id"><span class="required">*</span> <?php echo $entry_zone; ?></label>

					<div class="controls">
						<select name="zone_id">
						</select>
						<?php if ($error_zone) { ?><span class="error help-inline"><?php echo $error_zone; ?></span><?php } ?>
					</div>
				</div>


			</div>
			<!-- /.span6 -->
		</div>
		<!-- /.row-fluid -->
		<div class="row-fluid">
			<div class="span6">
				<h2><?php echo $text_your_password; ?></h2>

				<div class="control-group">
					<label class="control-label" required="required" for="password"><span class="required">*</span> <?php echo $entry_password; ?></label>

					<div class="controls">
						<input class="span6" type="password" name="password" value="<?php echo $password; ?>"/>
						<?php if ($error_password) { ?>
							<span class="error help-inline"><?php echo $error_password; ?></span>
						<?php } ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="confirm"><span class="required">*</span> <?php echo $entry_confirm; ?></label>

					<div class="controls">
						<input class="span6" required="required" type="password" name="confirm" value="<?php echo $confirm; ?>"/>
						<?php if ($error_confirm) { ?>
							<span class="error help-inline"><?php echo $error_confirm; ?></span>
						<?php } ?>
					</div>
				</div>

			</div>
			<!-- /.span6 -->
			<div class="span6">
				<h2><?php echo $text_newsletter; ?></h2>

				<div class="control-group">
					<label class="control-label" for="newsletter"><?php echo $entry_newsletter; ?></label>

					<div class="controls">
						<?php if ($newsletter) { ?>
							<label class="radio inline">
								<input type="radio" name="newsletter" value="1" checked="checked"/>
								<?php echo $text_yes; ?>
							</label>
							<label class="radio inline">
								<input type="radio" name="newsletter" value="0"/>
								<?php echo $text_no; ?>
							</label>
						<?php } else { ?>
							<label class="radio inline">
								<input type="radio" name="newsletter" value="1"/>
								<?php echo $text_yes; ?>
							</label>
							<label class="radio inline">
								<input type="radio" name="newsletter" value="0" checked="checked"/>
								<?php echo $text_no; ?>
							</label>
						<?php } ?>
					</div>
				</div>


			</div>
			<!-- /.span6 -->
		</div>
		<!-- /.row-fluid -->
		<div class="row-fluid">

			<!-- /.span6 -->
			<div class="span12">
				<?php if ($text_agree) { ?>
					<div class="buttons">
						<div class="">
							<label class="checkbox">
								<?php echo $text_agree; ?>
								<?php if ($agree) { ?>
									<input type="checkbox" name="agree" value="1" checked="checked"/>
								<?php } else { ?>
									<input type="checkbox" name="agree" value="1"/>
								<?php } ?>
							</label>
							<hr/>
							<a style="margin-bottom: 50px" onclick="$('#register').submit();" class="button"><span><?php echo $button_continue; ?></span></a>

						</div>

					</div>
				<?php } else { ?>

					<div class="buttons">
						<div class="">
							<a onclick="$('#register').submit();" class="button"><span><?php echo $button_continue; ?></span></a>
						</div>
					</div>
				<?php } ?>
			</div>
			<!-- /.span6 -->
		</div>
		<!-- /.row-fluid -->
	</div>
	<!-- /.container-fluid -->
	</div>


	</form>
	</div>
	</div>
	<?php echo $column_left; ?>
	</div>
	</div>
<?php echo $column_right; ?>

	<script type="text/javascript"><!--
		$('input[name=\'customer_group_id\']:checked').live('change', function () {
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

		$('input[name=\'customer_group_id\']:checked').trigger('change');
		//--></script>
	<script type="text/javascript"><!--
		$('select[name=\'country_id\']').bind('change', function () {
			$.ajax({
				url: 'index.php?route=account/register/country&country_id=' + this.value,
				dataType: 'json',
				beforeSend: function () {
					$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/theme255/image/loading.gif" alt="" /></span>');
				},
				complete: function () {
					$('.wait').remove();
				},
				success: function (json) {
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
				error: function (xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		});

		$('select[name=\'country_id\']').trigger('change');
		//--></script>
	<script type="text/javascript"><!--
		$(document).ready(function () {
			$('.colorbox').fancybox({

			});
		});
		//--></script>

                
                <script type="text/javascript">
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
			?> </script>
			<script type="text/javascript">
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
			</script>
			
            
<?php echo $footer; ?>