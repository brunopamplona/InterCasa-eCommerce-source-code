<?php
/*
  Review Booster
  Premium Extension
  
  Copyright (c) 2013 - 2019 Adikon.eu
  http://www.adikon.eu/
  
  You may not copy or reuse code within this file without written permission.
*/
?>
<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>
	 <script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
	<h1><?php echo $heading_title; ?></h1>
	<div id="review_booster" class="review_booster">
		<?php if ($success) { ?>
		<p class="rb-success"><?php echo $success; ?></p>
		<div class="buttons clearfix">
			<div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
		</div>
		<?php } else { ?>
		<p><?php echo $text_description; ?></p>
		<h4><b><?php echo $text_product; ?></b></h4>
		<table border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<?php foreach ($products as $product) { ?>
				<tr>
					<?php if ($product_image_status && $type != 'product_single') { ?>
					<td width="<?php echo $product_image_width; ?>" style="padding: 2px;"><img src="<?php echo $product['image']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" class="rb-image" /></td>
					<?php } ?>
					<td valign="middle"><?php if (!$product_image_status || $type == 'product_single') { ?>
					&bullet; 
					<?php } ?><?php echo $product['name']; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
			<?php if ($type != 'product_single') { array_splice($products, 1, count($products)); } ?>
			<?php foreach ($products as $product) { ?>
			<?php $product_id = ($type != 'order') ? $product['product_id'] : 'all'; ?>
			<fieldset>
				<?php if ($type == 'product_single') { ?>
				<div class="form-group">
					<div class="rb-product-name">
						<?php if ($product_image_status) { ?>
						<img src="<?php echo $product['image']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" class="rb-image" />
						<?php } ?> <?php echo $product['name']; ?>
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label class="control-label"><?php echo $entry_rating; ?></label>
					<table style="border:0; padding:0; margin:0;" class="pr-ratings">
						<tbody>
							<?php foreach ($product['ratings'] as $rating) { ?>
							<tr>
								<td align="left" class="pr-rating-name"><?php echo $rating['name']; ?></td>
								<td class="pr-rating-star">
									<?php for ($j = 1; $j <= 5; $j++) { ?>
									<label class="radio-inline">
										<input type="radio" name="review[<?php echo $product_id; ?>][rating][<?php echo $rating['rating_id']; ?>]" value="<?php echo $j; ?>" <?php echo (((isset($review[$product_id]['rating'][$rating['rating_id']]) && $j == $review[$product_id]['rating'][$rating['rating_id']]) || (!isset($review[$product_id]['rating'][$rating['rating_id']]) && $j == 5)) ? 'checked' : ''); ?> /> 
										<?php for ($k = 1; $k <= $j; $k++) { ?>★<?php } ?>
									</label>
									<?php } ?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<?php if (isset($error_rating[$product_id])) { ?>
					<div class="error"><?php echo $error_rating[$product_id]; ?></div>
					<?php } ?>
				</div>
				<div class="form-group">
					<label class="control-label"><?php echo $entry_review; ?></label>
					<textarea name="review[<?php echo $product_id; ?>][text]" rows="6"><?php echo ((isset($review[$product_id]['text'])) ? $review[$product_id]['text'] : ''); ?></textarea>
					<?php if (isset($error_review[$product_id])) { ?>
					<div class="error"><?php echo $error_review[$product_id]; ?></div>
					<?php } ?>
				</div>
				<?php if ($apr_image_status) { ?>
				<div class="form-group">
					<label class="control-label"><?php echo $entry_image; ?></label>
					<button type="button" id="button-review-image<?php echo $product_id; ?>" data-loading-text="<?php echo $text_loading; ?>" class="button"><?php echo $button_upload; ?></button>
					<ul id="rb-images<?php echo $product_id; ?>" class="list-inline rb-images">
						<?php if (isset($images[$product_id])) { ?>
						<?php foreach ($images[$product_id] as $image) { ?>
						<li><img src="<?php echo $image['thumb']; ?>" alt="" class="rb-image" /><input type="hidden" name="review[<?php echo $product_id; ?>][images][]" value="<?php echo $image['image']; ?>" /></li>
						<?php } ?>
						<?php } ?>
					</ul>
					<script type="text/javascript"><!--
					new AjaxUpload('#button-review-image<?php echo $product_id; ?>', {
						action: '<?php echo $apr_image_url; ?>',
						name: 'file',
						autoSubmit: true,
						responseType: 'json',
						onSubmit: function(file, extension) {
							$('#button-review-image<?php echo $product_id; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
							$('#button-review-image<?php echo $product_id; ?>').attr('disabled', true);
						},
						onComplete: function(file, json) {
							$('#button-review-image<?php echo $product_id; ?>').attr('disabled', false);

							$('.error').remove();

							if (json['success']) {
								alert(json['success']);

								if (/product_review\//i.test(json['file']) == false) {
									json['file'] = 'product_review/review/' + json['file'];
								}

								$('#rb-images<?php echo $product_id; ?>').append('<li><img src="' + json['thumb'] + '" alt="" class="rb-image" /><input type="hidden" name="review[<?php echo $product_id; ?>][images][]" value="' + json['file'] + '" /></li>');
							}

							if (json['error']) {
								$('#button-review-image<?php echo $product_id; ?>').after('<span class="error">' + json['error'] + '</span>');
							}

							$('.loading').remove();	
						}
					});
					//--></script>
				</div>
				<?php } ?>
			</fieldset>
			<?php } ?>
			<?php if ($noticed_status || $gdpr_status) { ?>
			<fieldset class="rb-noticed">
				<?php if ($noticed_status) { ?>
				<div class="form-group">
					<label class="control-label"><?php echo $entry_noticed; ?></label>
					<select name="noticed">
						<?php foreach ($notices as $key => $value) { ?>
						<?php if ($key == $noticed) { ?>
						<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
						<?php } else { ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
				<?php } ?>
				<?php if ($gdpr_status) { ?>
				<div class="form-group">
					<?php if ($gdpr) { ?>
					<input type="checkbox" name="gdpr" value="1" checked="checked" />
					<?php } else { ?>
					<input type="checkbox" name="gdpr" value="1" />
					<?php } ?> <?php echo $text_gdpr; ?>
					<?php if ($error_gdpr) { ?>
					<div class="error"><?php echo $error_gdpr; ?></div>
					<?php } ?>
				</div>
				<?php } ?>
			</fieldset>
			<?php } ?>
			<div class="buttons">
				<div class="right">
					<input type="submit" class="button" value="<?php echo $button_submit; ?>" />
				</div>
			</div>
		</form>
		<?php } ?>
	</div>
<?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
if (typeof jQuery.fn.live == 'undefined' || !(jQuery.isFunction(jQuery.fn.live))) {
	jQuery.browser = {};
	(function () {
		jQuery.browser.msie = false;
		jQuery.browser.version = 0;
		if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
			jQuery.browser.msie = true;
			jQuery.browser.version = RegExp.$1;
		}
	})();

	jQuery.fn.extend({
		live: function (event, callback) {
			if (this.selector) {
				jQuery(document).on(event, this.selector, callback);
			}
		}
	});
}
//--></script>
<style>
.review_booster {}
	.review_booster table { width:auto; margin:0; padding:0; border-collapse:collapse; }
	.review_booster h4 { font-size:15px; margin-top:20px; margin-bottom:10px; font-weight:500; }
	.review_booster fieldset { border:0; padding-top:15px; }
	.review_booster fieldset:first-child { border-top:1px solid #eeeeee; margin-top: 20px; }
	.review_booster fieldset.rb-noticed { border-top:1px solid #eeeeee; }
	.review_booster .form-group + .form-group { margin-top:10px; }
	.review_booster label { font-weight:bold; margin-bottom:3px; }
	.review_booster textarea { width:100%; }
	.review_booster .buttons { margin-top:15px; }
	.rb-success { margin-top:40px; text-align:center; font-size:1.1em; line-height:1.8; }
	.rb-product-name { color:#666; text-align:left; vertical-align:middle; font-weight:600; font-size:15px; }
	.rb-image { border:1px solid #dddddd; vertical-align:middle; margin-right:10px; }
	.rb-images { margin-top:10px; }
		.rb-images > li { display:inline-block; }
		.rb-images .rb-image { margin:0px; }
	.pr-ratings {}
		.pr-rating-name { padding-top:7px; padding-right:30px; font-weight:700; }
		.pr-rating-star {}
			.pr-rating-star .radio-inline { color:<?php echo $color; ?>; font-size:21px; line-height:1; padding-top:7px; padding-left:20px; display:inline-block; }
</style>
<?php echo $footer; ?>