<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  <?php } ?>
</div>
<?php if(isset($error_warning)) { ?>
<div class="warning">
<?php echo $error_warning; ?>
</div>
<?php } ?>
<div class="box">
	<div class="heading">
		<h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
		<div class="buttons"><a onclick="$('#form').submit();" class="button btn btn-primary"><?php echo $button_save; ?></a> <a onclick="location = '<?php echo $cancel; ?>';" class="button btn btn-primary"><?php echo $button_cancel; ?></a></div>
	</div>
	<div class="content">
		<br />
		<div id="checkupdate" class="attention"></div>

		<div class="row-fluid">
			<div class="span8">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
					<table class="form">
						<tr>
							<td><?php echo $autocep_text; ?></td>
							<td>
								<input name="autocep" id="autocep" type="checkbox" <?php echo ($autocep ? 'checked' : ''); ?> />
							</td>
						</tr>
						<tr>
							<td><?php echo $fields_address_text; ?></td>
							<td>
								<input name="acaocampos" type="radio" value="1" <?php echo ($acaocampos == 1 ? 'checked' : ''); ?> /> <?php echo $nada_text; ?>
								<input name="acaocampos" type="radio" value="2" <?php echo ($acaocampos == 2 ? 'checked' : ''); ?> /> <?php echo $disable_text; ?>
								<input name="acaocampos" type="radio" value="3" <?php echo ($acaocampos == 3 ? 'checked' : ''); ?> /> <?php echo $hide_text; ?>
							</td>
						</tr>
						<tr>
							<td><?php echo $txt_select_ws_method; ?></td>
							<td>
								<select name="wsmethod">
									<option value="1" <?php echo ($wsmethod == 1 ? 'selected' : ''); ?>><?php echo $txt_click_button; ?></option>
									<option value="2" <?php echo ($wsmethod == 2 ? 'selected' : ''); ?>><?php echo $txt_blur_field; ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td><?php echo $entry_warning_street_number; ?></td>
							<td>
								<input name="warning_street_number" type="text" size="50" value="<?php echo $warning_street_number; ?>" />
							</td>
						</tr>
						<tr>
							<td><?php echo $entry_hide_country_set_brazil; ?></td>
							<td>
								<input name="hide_country_set_brazil" type="checkbox" value="1" <?php echo ($hide_country_set_brazil ? 'checked' : ''); ?> />
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
<!--
checking_update_text = "<?php echo $checking_update_text; ?>";

$(function()
{
	$.ajax(
	{
		url: '<?php echo $urlcheckupdate; ?>',
		dataType: 'json',
		beforeSend: function()
		{
			$("#checkupdate").text(checking_update_text);
		},
		success: function(data)
		{
			if(data.update)
			{
				$("#checkupdate").html(data.html);
			}
			else
			{
				$("#checkupdate").html(data.html);
				setTimeout(function()
				{
					$("#checkupdate").hide();
				}, 5000);
			}
		},
		error: function(xhr, ajaxOptions, thrownError)
		{
			setTimeout(function()
			{
				$("#checkupdate").hide();
			}, 5000);
		}
	});
});

//-->
</script>
<?php echo $footer; ?>