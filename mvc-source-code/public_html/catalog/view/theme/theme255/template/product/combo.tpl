<?php
//OpenCart Extension
//Project Name: OpenCart Combo/Bundle
//Author: Fanha Giang a.k.a fanha99
//Email (PayPal Account): fanha99@gmail.com
//License: Commercial
?>
<?php echo $header; ?>
	<div class="<?php if ($column_right) { ?>span9<?php } else {?>span12<?php } ?>">
		<div class="row">
			<div class="<?php if ($column_left or $column_right) { ?>span9<?php } ?> <?php if ($column_left and $column_right) { ?>span6<?php } ?> <?php if (!$column_right and !$column_left) { ?>span12 <?php } ?>" id="content"><?php echo $content_top; ?>
				<div class="breadcrumb">
					<?php foreach ($breadcrumbs as $breadcrumb) { ?>
						<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
					<?php } ?>
				</div>
				<h1 class="style-1"><?php echo $heading_title; ?></h1>
				<div class="box-container">
				<div class="product-info">
				<?php if ($thumb || $images) { ?>
					<div class="left">
						<?php if ($thumb) { ?>
							<div class="image"><a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></a></div>
						<?php } ?>
						<?php if ($images) { ?>
							<div class="image-additional">
								<?php foreach ($images as $image) { ?>
									<a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="right">
				<?php if ($price) { ?>
					<div class="price"><?php echo $text_price; ?>
						<?php if (!$special) { ?>
							<?php echo $price; ?>
						<?php } else { ?>
							<span class="price-old"><?php echo $price; ?></span> <span class="price-new"><?php echo $special; ?></span>
						<?php } ?>
						<br />
						<?php if ($tax) { ?>
							<span class="price-tax"><?php echo $text_tax; ?> <?php echo $tax; ?></span><br />
						<?php } ?>
						<?php if ($points) { ?>
							<span class="reward"><small><?php echo $text_points; ?> <?php echo $points; ?></small></span><br />
						<?php } ?>
					</div>
				<?php } ?>

				<div class="options combo-options">
					<h2><?php echo $text_option; ?></h2>
					<br />
					<?php foreach ($products as $product) { ?>

						<div class="combo-product">
							<span><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></span>
							<span><?php echo $product['quantity'] . ' x '?><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></span>
						</div>

						<?php if ($product['profiles']): ?>
							<div id="profile-<?php echo $product['product_id'];?>" class="option">
								<span class="required">*</span><b><?php echo $text_payment_profile ?></b><br />
								<select id="select-profile-<?php echo $product['product_id'];?>" name="profile[<?php echo $product['product_id'];?>]">
									<option value=""><?php echo $text_select; ?></option>
									<?php foreach ($product['profiles'] as $profile): ?>
										<option value="<?php echo $profile['profile_id'] ?>"><?php echo $profile['name'] ?></option>
									<?php endforeach; ?>
								</select>
								<br />
								<span id="profile-<?php echo $product['product_id'];?>-description"></span>
							</div>
							<br />
						<?php endif; ?>

						<?php foreach ($product['options'] as $option) { ?>
							<?php if ($option['type'] == 'select') { ?>
								<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
									<?php if ($option['required']) { ?>
										<span class="required">*</span>
									<?php } ?>
									<b><?php echo $option['name']; ?>:</b><br />
									<select name="option[<?php echo $option['product_option_id']; ?>]">
										<option value=""><?php echo $text_select; ?></option>
										<?php foreach ($option['option_value'] as $option_value) { ?>
											<option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
												<?php if ($option_value['price']) { ?>
													(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
												<?php } ?>
											</option>
										<?php } ?>
									</select>
								</div>
								<br />
							<?php } ?>
							<?php if ($option['type'] == 'radio') { ?>
								<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
									<?php if ($option['required']) { ?>
										<span class="required">*</span>
									<?php } ?>
									<b><?php echo $option['name']; ?>:</b><br />
									<?php foreach ($option['option_value'] as $option_value) { ?>
										<input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
										<label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
											<?php if ($option_value['price']) { ?>
												(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
											<?php } ?>
										</label>
										<br />
									<?php } ?>
								</div>
								<br />
							<?php } ?>
							<?php if ($option['type'] == 'checkbox') { ?>
								<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
									<?php if ($option['required']) { ?>
										<span class="required">*</span>
									<?php } ?>
									<b><?php echo $option['name']; ?>:</b><br />
									<?php foreach ($option['option_value'] as $option_value) { ?>
										<input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
										<label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
											<?php if ($option_value['price']) { ?>
												(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
											<?php } ?>
										</label>
										<br />
									<?php } ?>
								</div>
								<br />
							<?php } ?>
							<?php if ($option['type'] == 'image') { ?>
								<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
									<?php if ($option['required']) { ?>
										<span class="required">*</span>
									<?php } ?>
									<b><?php echo $option['name']; ?>:</b><br />
									<table class="option-image">
										<?php foreach ($option['option_value'] as $option_value) { ?>
											<tr>
												<td style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
												<td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
												<td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
														<?php if ($option_value['price']) { ?>
															(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
														<?php } ?>
													</label></td>
											</tr>
										<?php } ?>
									</table>
								</div>
								<br />
							<?php } ?>
							<?php if ($option['type'] == 'text') { ?>
								<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
									<?php if ($option['required']) { ?>
										<span class="required">*</span>
									<?php } ?>
									<b><?php echo $option['name']; ?>:</b><br />
									<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
								</div>
								<br />
							<?php } ?>
							<?php if ($option['type'] == 'textarea') { ?>
								<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
									<?php if ($option['required']) { ?>
										<span class="required">*</span>
									<?php } ?>
									<b><?php echo $option['name']; ?>:</b><br />
									<textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
								</div>
								<br />
							<?php } ?>
							<?php if ($option['type'] == 'file') { ?>
								<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
									<?php if ($option['required']) { ?>
										<span class="required">*</span>
									<?php } ?>
									<b><?php echo $option['name']; ?>:</b><br />
									<input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="button">
									<input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
								</div>
								<br />
							<?php } ?>
							<?php if ($option['type'] == 'date') { ?>
								<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
									<?php if ($option['required']) { ?>
										<span class="required">*</span>
									<?php } ?>
									<b><?php echo $option['name']; ?>:</b><br />
									<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
								</div>
								<br />
							<?php } ?>
							<?php if ($option['type'] == 'datetime') { ?>
								<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
									<?php if ($option['required']) { ?>
										<span class="required">*</span>
									<?php } ?>
									<b><?php echo $option['name']; ?>:</b><br />
									<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
								</div>
								<br />
							<?php } ?>
							<?php if ($option['type'] == 'time') { ?>
								<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
									<?php if ($option['required']) { ?>
										<span class="required">*</span>
									<?php } ?>
									<b><?php echo $option['name']; ?>:</b><br />
									<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
								</div>
								<br />
							<?php } ?>
						<?php } ?>
					<?php } ?>
				</div>

				<div class="cart">
					<div><?php echo $text_qty; ?>
						<input id="combo_quantity" type="text" name="combo_quantity" size="2" value="<?php echo $minimum; ?>" />
						<input type="hidden" name="combo_id" value="<?php echo $combo_id; ?>" />
						&nbsp;
						<input type="button" value="<?php echo $button_combo_cart; ?>" id="button-cart" class="button" />
					</div>
				</div>
				<?php if ($review_status) { ?>
					<div class="review">
						<div class="share"><!-- AddThis Button BEGIN -->
							<div class="addthis_default_style"><a class="addthis_button_compact"><?php echo $text_share; ?></a> <a class="addthis_button_email"></a><a class="addthis_button_print"></a> <a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a></div>
							<script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script>
							<!-- AddThis Button END -->
						</div>
					</div>
				<?php } ?>
				</div>
				</div>
				<div id="tabs" class="htabs"><a href="#tab-description" target="_blank"><?php echo $tab_description; ?></a>
				</div>
				<div id="tab-description" class="tab-content"><?php echo $description; ?></div>
				</div>
				<?php echo $content_bottom; ?></div>
			<?php echo $column_left; ?>
		</div>
	</div>
<?php echo $column_right; ?>

<script type="text/javascript"><!--
$(document).ready(function() {
	$('.colorbox').colorbox({
		overlayClose: true,
		opacity: 0.5,
		rel: "colorbox"
	});
});
//--></script> 
<script type="text/javascript"><!--
$('#button-cart').bind('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/addcombo',
		type: 'post',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();
			
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}
				}
               
				if (json['error']['profile']) {
					for (i in json['error']['profile']) {
						$('#profile-' + i).after('<span class="error">' + json['error']['profile'][i] + '</span>');
					}
				}
			} 
			
			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
					
				$('.success').fadeIn('slow');
					
				$('#cart-total').html(json['total']);
				
				$('html, body').animate({ scrollTop: 0 }, 'slow'); 
			}	
		}
	});
});
//--></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php foreach ($products as $product) { ?>
<?php if ($product['profiles']) {?>
<script type="text/javascript"><!--
$('#select-profile-<?php echo $product['product_id'];?>').change(function(){
    $.ajax({
		url: 'index.php?route=product/product/getRecurringDescription',
		type: 'post',
		data: 'product_id=<?php echo $product['product_id'];?>&quantity=' + $("#combo_quantity").val() + '&profile_id=' + $("#select-profile-<?php echo $product['product_id'];?>").val(),
		dataType: 'json',
        beforeSend: function() {
            $('#profile-<?php echo $product['product_id'];?>-description').html('');
        },
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();
            
			if (json['success']) {
                $('#profile-<?php echo $product['product_id'];?>-description').html(json['success']);
			}	
		}
	});
});
//--></script>
<?php } ?>

<?php foreach ($product['options'] as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript"><!--
new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
	action: 'index.php?route=product/product/upload',
	name: 'file',
	autoSubmit: true,
	responseType: 'json',
	onSubmit: function(file, extension) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
	},
	onComplete: function(file, json) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);
		
		$('.error').remove();
		
		if (json['success']) {
			alert(json['success']);
			
			$('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
		}
		
		if (json['error']) {
			$('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
		}
		
		$('.loading').remove();	
	}
});
//--></script>
<?php } ?>
<?php } ?>
<?php } ?>
<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	if ($.browser.msie && $.browser.version == 6) {
		$('.date, .datetime, .time').bgIframe();
	}

	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	$('.datetime').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'h:m'
	});
	$('.time').timepicker({timeFormat: 'h:m'});
});
//--></script> 
<?php echo $footer; ?>