<?php echo $header; ?>
<div class="<?php if ($column_right) { ?>span9<?php } else {?>span12<?php } ?>">
	<div class="row">
<div class="<?php if ($column_left or $column_right) { ?>span9<?php } ?> <?php if ($column_left and $column_right) { ?>span6<?php } ?> <?php if (!$column_right and !$column_left) { ?>span12 <?php } ?>" id="content"><?php echo $content_top; ?>
	<script type="application/ld+json">
    {
    "@context": "http://schema.org/",
    "@type": "Product",
    "name": "<?php echo $heading_title; ?>",
    "offers": {
    "@type": "Offer",
    "priceCurrency": "<?php echo $this->currency->getCode();?>",
	"price": "<?php if (!$special) { echo preg_replace('/[^0-9.]+/','',$price);}else{echo preg_replace('/[^0-9.]+/','',$special);} ?>",
	"itemCondition" : "http://schema.org/NewCondition",
	"availability" : "<?php if ($stock >= 1){echo 'In Stock';}else{echo $stock;} ?>"
    }
    }
    </script>
    <div itemscope itemtype="http://schema.org/Product">
    <meta itemprop="name" content="<?php echo $heading_title; ?>" />
    <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
    <meta itemprop="priceCurrency" content="<?php echo $this->currency->getCode();?>">
    <meta itemprop="price" content="<?php if (!$special) { echo preg_replace('/[^0-9.]+/','',$price);}else{echo preg_replace('/[^0-9.]+/','',$special);} ?>">
    <meta itemprop="availability" content="<?php if ($stock >= 1){echo 'In Stock';}else{echo $stock;} ?>">
    <meta itemprop="itemCondition" itemtype="http://schema.org/OfferItemCondition" content="http://schema.org/NewCondition" />
    </div>
    </div>
	
	<div class="breadcrumb">
	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
	<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
	<?php } ?>
	</div>
	<div class="product-info">
		<div class="row">

		<div class="span6">
			<!--<span class="view"><?php echo $heading_title; ?></span >-->

	<script type="text/javascript">
		jQuery(document).ready(function(){
		var myPhotoSwipe = $("#gallery a").photoSwipe({ enableMouseWheel: false , enableKeyboard: false, captionAndToolbarAutoHideDelay:0 });
		});
		
			function Mudarestado(el) {
			    var display = document.getElementById(el).style.display;
			    if(display == "none")
			        document.getElementById(el).style.display = 'block';
			    else
			        document.getElementById(el).style.display = 'none';
		       }
		
		
	</script>

	<?php $i=0; if ($thumb || $images) { $i++  ?>
	<div id="full_gallery">
		<ul id="gallery">
			<?php foreach ($images as $image) { ?>
			<li><a href="<?php echo $image['popup']; ?>" data-something="something<?php echo $i?>" data-another-thing="anotherthing<?php echo $i?>"><img src="<?php echo $image['thumb']; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
				<?php } ?>
		</ul>

	</div>
	<?php } ?>

		<?php if ($thumb || $images) { ?>
		<div id="default_gallery" class="left spacing">

			<?php foreach ($images as $image) { ?>
			<div class="zoom-top">
				<a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"  data-gal="prettyPhoto[gallery1]" >
					<img src="" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
				</a>
			</div>
			<?php } ?>
			<?php if ($thumb) { ?>
			<div class="image">
				<a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class = 'cloud-zoom' id='zoom1' rel="position: 'right'">
					<img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
				</a>
				<a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>">
				<!--<img id="image" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />-->
				</a>
			</div>
			<?php } ?>

			<?php if ($images) { ?>
				<div class="image-additional">
					<ul id="image-additional">
						<?php foreach ($images as $image) { ?>
						 <li>
							<a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: '<?php echo $image['thumb']; ?>' ">
								<img src="<?php echo $image['small']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
							</a>
						</li>
						<?php } ?>
					</ul>
					<div class="clear"></div>
				</div>
			<?php } ?>
		</div>
		<?php } ?>
		</div>
	<div class="span6">
		<h1><?php echo $heading_title; ?></h1>
	  <div class="description">
		<div class="product-section">
			<?php if ($manufacturer) { ?>
			<span><?php echo $text_manufacturer; ?></span> <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a><br />
			<?php } ?>
			<span><?php echo $text_model; ?></span> <?php echo $model; ?><br />
			<?php if ($reward) { ?>
			<span><?php echo $text_reward; ?></span> <?php echo $reward; ?><br />
			<?php } ?>
			<span><?php echo $text_stock; ?></span><div class="prod-stock <?php echo ($stock_status) ? NULL: 'no-stock'; ?> "><?php echo $stock; ?></div>
		</div>

	  <?php if ($price) { ?>
	  <div class="price">
		<span class="text-price"></span>
		<?php if (!$special) { ?>
			<?php echo (StringHelper::isKit($heading_title)) ? 'À partir de' : 'Por'; ?>: <span class="price-new"><?php echo $price; ?></span>
            <?php } else { ?>
            De <span class="price-old"><?php echo $price; ?></span>Por <span class="price-new"><?php echo $special; ?></span>
		<?php } ?>

		  <?php
		   Parcelamento::e($price, $special);
		   Desconto::e($price, $special);
		  ?>

		<?php if ($points) { ?>
		<span class="reward"><small><?php echo $text_points; ?> <?php echo $points; ?></small></span>
		<?php } ?>
		<?php if ($discounts) { ?>
		<div class="discount">
		  <?php foreach ($discounts as $discount) { ?>
		  <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?><br />
		  <?php } ?>
		</div>
		<?php } ?>

	  </div>
	  <?php } ?>

	  <?php if ($options) { ?>
	  <div class="options">
		<h2></h2>
		<?php foreach ($options as $option) { ?>
		<?php if ($option['type'] == 'select') { ?>
		<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
		  <label><?php if ($option['required']) { ?>
		  <span class="required">*</span>
		  <?php } ?>
		  <b><?php echo $option['name']; ?>:</b></label>
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
		<?php } ?>
		<?php if ($option['type'] == 'radio') { ?>
		<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
			<label>
		  <?php if ($option['required']) { ?>
		  <span class="required">*</span>
		  <?php } ?>
		  <b><?php echo $option['name']; ?>:</b></label>
		  <?php foreach ($option['option_value'] as $option_value) { ?>

		  <label class="radio" for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
			  <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /><?php echo $option_value['name']; ?>
			<?php if ($option_value['price']) { ?>
			(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
			<?php } ?>
		  </label>
		    <?php } ?>
		</div>
		<br />
		<?php } ?>
		<?php if ($option['type'] == 'checkbox') { ?>
		<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
		  <label><?php if ($option['required']) { ?>
		  <span class="required">*</span>
		  <?php } ?>
		  <b><?php echo $option['name']; ?>:</b></label>
		  <?php foreach ($option['option_value'] as $option_value) { ?>

		  <label class="checkbox" for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /><?php echo $option_value['name']; ?>
			<?php if ($option_value['price']) { ?>
			(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
			<?php } ?>
		  </label>
		    <?php } ?>
		</div>
		<br />
		<?php } ?>
		<?php if ($option['type'] == 'image') { ?>
		<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
		  <label><?php if ($option['required']) { ?>
		  <span class="required">*</span>
		  <?php } ?>
		  <?php echo $option['name']; ?>:</label>
			<table class="option-image">
			  <?php foreach ($option['option_value'] as $option_value) { ?>
			  <tr>
				<td style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
				<td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>

					<?php if ($option_value['price']) { ?>
					(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
					<?php } ?>
				  </label></td>
			  </tr>
			  <?php } ?>
			</table>
		</div>

		<?php } ?>
		<?php if ($option['type'] == 'text') { ?>
		<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
		  <label><?php if ($option['required']) { ?>
		  <span class="required">*</span>
		  <?php } ?>
		  <?php echo $option['name']; ?>:</label>
		  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
		</div>
		<?php } ?>
		<?php if ($option['type'] == 'textarea') { ?>
		<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
		 <label><?php if ($option['required']) { ?>
		  <span class="required">*</span>
		  <?php } ?>
		  <?php echo $option['name']; ?>:</label>
		  <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
		</div>
		<?php } ?>
		<?php if ($option['type'] == 'file') { ?>
		<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
		  <label><?php if ($option['required']) { ?>
		  <span class="required">*</span>
		  <?php } ?>
		  <?php echo $option['name']; ?>:</label>
		  <a id="button-option-<?php echo $option['product_option_id']; ?>" class="btn"><?php echo $button_upload; ?></a>
		  <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
		</div>
		<br />
		<?php } ?>
		<?php if ($option['type'] == 'date') { ?>
		<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
		  <label><?php if ($option['required']) { ?>
		  <span class="required">*</span>
		  <?php } ?>
		  <?php echo $option['name']; ?>:</label>
		  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
		</div>
		<br />
		<?php } ?>
		<?php if ($option['type'] == 'datetime') { ?>
		<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
		  <label><?php if ($option['required']) { ?>
		  <span class="required">*</span>
		  <?php } ?>
		  <?php echo $option['name']; ?>:</label>
		  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
		</div>
		<br />
		<?php } ?>
		<?php if ($option['type'] == 'time') { ?>
		<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
		  <label><?php if ($option['required']) { ?>
		  <span class="required">*</span>
		  <?php } ?>
		  <?php echo $option['name']; ?>:</label>
		  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
		</div>
		<br />
		<?php } ?>
		<?php } ?>
	  </div>
	  <?php } ?>
	  <div class="cart">
		<div class="prod-row">
			<div class="cart-top">
				<div class="cart-top-padd form-inline">
					<label><?php echo $text_qty; ?>
						<input class="q-mini" type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" />
						<input class="q-mini" type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
					</label>
					<a id="button-cart" class="button-prod" ><i class="icon-shopping-cart"></i><?php echo $button_cart; ?></a>
				</div>
				<div class="extra-button">
					<div class="wishlist">
						<a   onclick="addToWishList('<?php echo $product_id; ?>');" title="<?php echo $button_wishlist; ?>"><i class="icon-star"></i><span><?php echo $button_wishlist; ?></span></a>
					</div>
					<div class="compare">
						<a   onclick="addToCompare('<?php echo $product_id; ?>');" title="<?php echo $button_compare; ?>"><i class="icon-bar-chart"></i><span><?php echo $button_compare; ?></span></a>
					</div>
				</div>
				<div class="clear"></div>
				<?php if ($minimum > 1) { ?>
				<div class="minimum"><?php echo $text_minimum; ?></div>
				<?php } ?>
			</div>
		</div>
		</div>
		<div id="marcadorcep"></div>
		<div class="clear"></div>
		<?php if ($review_status) { ?>
		<div class="review">
			<div>
				<img src="catalog/view/theme/theme255/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />&nbsp;&nbsp;
				<div class="btn-rew">
					<a href="#tab-review" class="show-tab-review"><?php echo $reviews; ?></a>
					<a href="#tab-review" class="show-tab-review"><i class="icon-pencil"></i><?php echo $text_write; ?></a>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		<div class="clear"></div>
		<div class="share">
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_sharing_toolbox"></div>
		</div>
	</div>
  </div>
  </div>
		<?php if ($review_status) { ?>
			<div class="tabs" id="tab-review" style="display: none">
				<div class="tab-heading">
					<?php echo $tab_review; ?>
				</div>
				<div class="tab-content">
					<form id="form-review">
					<div id="review"></div>
					<h2 id="review-title"><?php echo $text_write; ?></h2>
					<label><?php echo $entry_name; ?></label>
					<input type="text" name="name" value="" />
					<br />
					<br />
					<label><?php echo $entry_review; ?></label>
					<textarea name="text" cols="40" rows="8" style="width: 93%;"></textarea>
					<div class="clear"></div>
					<span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
					<br />
					<label class="inline"><?php echo $entry_rating; ?></label>
					<div class="form-inline border">
						<span class="radio"><?php echo $entry_bad; ?></span>&nbsp;
						<input type="radio" name="rating" value="1" />
						&nbsp;
						<input type="radio" name="rating" value="2" />
						&nbsp;
						<input type="radio" name="rating" value="3" />
						&nbsp;
						<input type="radio" name="rating" value="4" />
						&nbsp;
						<input type="radio" name="rating" value="5" />
						&nbsp; <span class="radio"><?php echo $entry_good; ?></span><br />
					</div>

					<label><?php echo $entry_captcha; ?></label>
					<input type="text" name="captcha" value="" />

					<img src="index.php?route=product/product/captcha" alt="" id="captcha" />
					<br />
					<div class="buttons">
						<div><a id="button-review" class="button-cont-right"><?php echo $button_continue; ?><i class="icon-circle-arrow-right"></i></a></div>
					</div>
					</form>
				</div>
			</div>
		<?php } ?>
	<div class="tabs">
		<div class="tab-heading" onclick="Mudarestado('descricao')">>
			<?php echo $tab_description; ?>
		</div>
		<div id="descricao" class="tab-content">
			<?php echo $description; ?>
		</div>
	</div>
	<?php if ($attribute_groups) { ?>
	<div class="tabs">
		<div class="tab-heading">
			<?php echo $tab_attribute; ?>
		</div>

			<div class="tab-content">
				<table class="attribute table table-bordered" >
				<?php foreach ($attribute_groups as $attribute_group) { ?>
				<thead>
					<tr>
					<td colspan="2"><?php echo $attribute_group['name']; ?></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($attribute_group['attribute'] as $attribute) { ?>
					<tr>
					<td><?php echo $attribute['name']; ?></td>
					<td><?php echo $attribute['text']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
				<?php } ?>
				</table>

		</div>
	</div>
	<?php } ?>

	<?php if ($tags) { ?>
	<div class="tabs">
		<div class="tab-heading">
			<?php echo $text_tags; ?>
		</div>
		<div class="tab-content">
			<div class="tags">
			<b><?php echo $text_tags; ?></b>
				<?php for ($i = 0; $i < count($tags); $i++) { ?>
					<?php if ($i < (count($tags) - 1)) { ?>
						<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
					<?php } else { ?>
						<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>

  </div>
<?php $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<div style="100%" data-width="100%" class="fb-comments" data-href="<?php echo $actual_link; ?>" data-numposts="7" data-colorscheme="light"></div>

	<?php if ($products) { ?>
		<div class="tab-heading-alt">
			<h2 class="mt0"><?php echo $tab_related;?></h2>
		</div>
		<div  class="related">
			<div class="box-product">
				<ul class="related-slider">
					<?php $j = 0; foreach ($products as $product) { $j++; ?>
						<li class="related-info" id="product-related-count-<?php echo $j; ?>">
							<?php if ($product['thumb']) { ?>
								<div class="image">
									<a href="<?php echo $product['href']; ?>"><img id="img_<?php echo $product['product_id']; ?>" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a>

								</div>
							<?php } ?>
							<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
							<?php if ($product['price']) { ?>
								<div class="price">
									<?php if (!$product['special']) { ?>
										<?php echo $product['price']; ?>
									<?php } else { ?>
										<span class="price-new"><?php echo $product['special']; ?></span><span class="price-old"><?php echo $product['price']; ?></span>
									<?php } ?>

								</div>
							<?php } ?>
							<div class="cart-button">
								<div class="cart">
									<a title="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button ">
										<!--<i class="icon-shopping-cart"></i>-->
										<span><?php echo $button_cart; ?></span>
									</a>
								</div>
								<?php /* <!--<a href="<?php// echo $product['href']; ?>" class="button details"><span><?php// echo $button_details; ?></span></a>-->
               <!--<div class="wishlist"><a class="tooltip-2" title="<?php echo $button_wishlist; ?>"  onclick="addToWishList('<?php echo $product['product_id']; ?>');"><i class="icon-star"></i><span><?php echo $button_wishlist; ?></span></a></div>-->
               <!--<div class="compare"><a class="tooltip-2" title="<?php echo $button_compare; ?>"  onclick="addToCompare('<?php echo $product['product_id']; ?>');"><i class="icon-bar-chart"></i><span><?php echo $button_compare; ?></span></a></div>-->
				*/?><span class="clear"></span>
							</div>
							<div class="rating">
								<?php if ($product['rating']) { ?>
									<img height="13" src="catalog/view/theme/theme255/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" />
								<?php } ?>
							</div>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	<?php } ?>

  <?php echo $content_bottom; ?></div>
  <?php echo $column_left; ?>
	</div>
</div>
<?php echo $column_right; ?>

<script type="text/javascript"><!--
$('#button-cart').bind('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
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
			}

			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<span><i class="icon-remove-sign"></i></span></div>');

				$('.success').fadeIn('slow');

				$('#cart-total').html(json['total']);
				$('#cart-total2').html(json['total']);
				$('#cart').load('index.php?route=module/cart #cart > *');
				$('html, body').animate({ scrollTop: 0 }, 'slow');
				location.href ="index.php?route=checkout/cart";

			}
			setTimeout(function() {$('.success').fadeOut(1000)},3000)
		}
	});
});
//--></script>
<?php if ($options) { ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php foreach ($options as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript"><!--
new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
	action: 'index.php?route=product/product/upload',
	name: 'file',
	autoSubmit: true,
	responseType: 'json',
	onSubmit: function(file, extension) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/theme255/image/loading.gif" class="loading" style="padding-left: 5px;" />');
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
$('#review .pagination a').live('click', function() {
	$('#review').fadeOut('slow');

	$('#review').load(this.href);

	$('#review').fadeIn('slow');

	return false;
});

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').bind('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-review').attr('disabled', true);
			$('#review-title').after('<div class="attention"><img src="catalog/view/theme/theme255/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				$('#review-title').after('<div class="warning">' + data['error'] + '</div>');
			}

			if (data['success']) {
				$('#review-title').after('<div class="success">' + data['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
});
//--></script>
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
                            