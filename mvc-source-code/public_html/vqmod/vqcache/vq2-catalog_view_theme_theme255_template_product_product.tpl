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

		      <?php if ($accessories) { ?>
              <div style="border-bottom: 1px solid #E7E7E7;color: #4D4D4D;margin-bottom: 20px;overflow: auto; padding: 0 5px 5px;">
              <h2><?php echo $text_accessories; ?></h2><br />
		      <table style="width: 100%;">
		        <?php $has_required = false;?>
		      	<?php foreach ($accessories as $accessory) { ?>
		        <?php if ($accessory['required'] == '1') $has_required = true;?>
		        <tr>
		          <td align="left" style="padding:2px;border-bottom:1px dotted #DDDDDD;">
		            <a href="<?php echo $accessory['popup']; ?>" title="<?php echo $accessory['name']; ?>" class="colorbox" rel="colorbox_accessory"><img src="<?php echo $accessory['image']; ?>" title="<?php echo $accessory['name']; ?>" alt="<?php echo $accessory['name']; ?>" /></a>
		          </td>
		          <td style="padding:2px 0;border-bottom:1px dotted #DDDDDD;"><?php echo ($accessory['required'] == '0') ? "" : '*';?></td>		          
		          <td align="left" style="padding:2px;border-bottom:1px dotted #DDDDDD;">
		            <a href="<?php echo $accessory['href']; ?>"><?php echo $accessory['name']; ?></a>
		          </td>
		          <td align="right" style="padding:2px;border-bottom:1px dotted #DDDDDD;">
		            <?php if (!$accessory['special']) { ?>
		            <span><?php echo $accessory['price']; ?></span>
		            <?php } else { ?>
		            <span style="text-decoration: line-through;"><?php echo $accessory['price']; ?></span> <span style="color: #F00;"><?php echo $accessory['special']; ?></span>
		            <?php } ?>
			        <?php if ($accessory['discounts'] && !$accessory['special']) { ?>
			        <br />
			        <div style="font-size:11px; color:#999;">
			          <?php foreach ($accessory['discounts'] as $discount) { ?>
			          <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?><br />
			          <?php } ?>
			        </div>
			        <?php } ?>		            
		          </td>
		          <td align="right" style="white-space:nowrap;padding:2px;border-bottom:1px dotted #DDDDDD;" >
		          	<?php echo $text_qty; ?>
		          	<input type="text" name="accessories[<?php echo $accessory['product_id'];?>]" id="accessories[<?php echo $accessory['product_id'];?>]" onclick="this.select();" onkeyup="getDiscount(<?php echo $accessory['product_id'];?>, this.value);;" size="2" style="width:20px;" value="<?php echo ($accessory['required']) ? $accessory['minimum'] : 0; ?>" />
		          	<input type="hidden" name="accessories_values[<?php echo $accessory['product_id'];?>]" id="accessories_values[<?php echo $accessory['product_id'];?>]" value="<?php echo ($accessory['special_value']) ? $accessory['special_value'] : $accessory['price_value'];?>" />
			        <?php if ($accessory['minimum'] > 1) { ?>
			        <br /><span style="font-size:11px; color:#999;"><?php echo sprintf($this->language->get('text_minimum_qty_accessory'), $accessory['minimum']); ?></span>
			        <?php } ?>		          	
		          </td>		          
		        </tr>
		        <?php } ?>
		        <tr>
		        	<td colspan="4" align="right" style="color: #666;"><?php echo $text_total_accessories;?></td>
		        	<td align="right"><div id="total_accessories">0.0</div></td>
		        </tr>
		        <tr>
		        	<td colspan="4" align="right" style="color: #666; font-weight: bold;"><?php echo $text_total_geral;?></td>
		        	<td align="right" style="color: #ff8600; font-weight: bold; font-size: 17px;"><div id="total_geral" style="font-weight: bold;"><?php echo ($special) ? $special : $price; ?></div></td>
		        </tr>
		        <tr><td colspan="5" style="font-size: 11px; color:#666;" align="right"><?php echo ($has_required) ? $text_accessory_required : '';?></td></tr>
				<tr><td colspan="5" id="accessory_msg"></td></tr>
		      </table>
		      </div>
		      <?php } ?>
              
			  <input type="hidden" name="price_value" id="price_value" value="<?php echo ($special_value) ? $special_value : $price_value; ?>" />
              <input type="hidden" name="accessories_ids" id="accessories_ids" value="<?php echo implode('.', $accessories_ids); ?>" />
			
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

				<!--VALDEIR - CALCULA FRETE-->
				<?php if ($shipping): ?>
				<div id="calcula_cep">
					<div><?php echo $calculaFrete_help ?></div><br />
					<form name="frmCalculaFrete" method="post" action="#">
						<label><?php echo $calculaFrete_cep ?></label>&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $zipcode ?>" name="postcode" id="postcode" />

          <input type="hidden" name="combo_id" value="0" />
			
						<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
						<input type="submit" id="calcular" class="button" value="<?php echo $calculaFrete_botao ?>" />
					</form>
					<div id="resultado"></div>
					<div id="aviso" style="display:none;"><?php echo $calculaFrete_aviso ?></div>
				</div>
				<?php endif; ?>
				<!--FIM VALDEIR - CALCULA FRETE-->
			
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
<?php if ($objConfig->get('product_reviews_status')) { ?>
			<?php if ($objConfig->get('product_reviews_summary_status')) { ?>
			<div class="product_review_summary">
				<div class="product_name"><?php echo $text_product_review; ?></div>
				<div class="left">
					<div class="general_avarage"><?php echo $text_general_avarage; ?> <img src="image/product_review/stars-<?php echo $objConfig->get('product_reviews_appearance_customer_rating'); ?>-<?php echo round($rating, 0); ?>.png" alt="<?php echo $reviews; ?>" /></div>
					<div class="count_mark"><?php echo $text_general_count_mark; ?></div>
					<a onClick="$('html, body').animate({ scrollTop: $('input[name=\'name\']').offset().top }, 2000);" class="button"><?php echo $button_write_review; ?></a>
					<?php if ($recommend_total && $objConfig->get('product_reviews_recommend_status')) { ?>
					<div class="count_recommend_product"><?php echo $text_count_recommend_product; ?></div>
					<?php } ?>
				</div>
				<div class="right">
					<?php if ($total_ratings) { ?>
					<div class="product_rating_list">
						<ul>
							<?php $sum_rating = 0; ?>
							<?php $sum_total = 0; ?>
							<?php foreach ($total_ratings as $product_rating) { ?>
							<?php $rating = $product_rating['sum_rating'] / $product_rating['total']; ?>
							<li><?php echo $product_rating['name']; ?><img src="image/product_review/stars-<?php echo $objConfig->get('product_reviews_appearance_customer_rating'); ?>-<?php echo round($rating, 0); ?>.png" alt="<?php echo round($rating, 0); ?>" /></li>
							<?php } ?>
						</ul>
					</div>
					<?php } ?>
				</div>
				<div style="clear: both;"></div>
			</div>
			<?php } ?>
			<?php if ($objConfig->get('product_reviews_sort_status')) { ?>
			<div class="product_review_sort"><b><?php echo $text_sort; ?></b>
				<select onchange="$('#review').fadeOut('slow'); $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>&sort=' + this.value); $('#review').fadeIn('slow');">
					<?php foreach ($product_review_sorts as $sorts) { ?>
					<option value="<?php echo $sorts['value']; ?>"><?php echo $sorts['text']; ?></option>
					<?php } ?>
				</select>
			</div>
			<?php } ?>
			<?php } ?>
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
						<span class="radio"><?php if ($objConfig->get('product_reviews_status')) {
				if ($ratings) {
					echo'<table class="product_rating">';
					foreach ($ratings as $rating) {
						echo'<tr><td>' . $rating['name'] . '</td><td><input type="hidden" name="rating[' . $rating['rating_id'] . ']" value="" /><div class="rating_star2" data-average="5" data-id="' . $rating['rating_id'] . '"></div></td></tr>';
					}
					echo'</table>';

					if ($objConfig->get('product_reviews_pros_status') || $objConfig->get('product_reviews_cons_status')) {
					echo'<table class="pros_cons">';
					echo'<tr>';

					if ($objConfig->get('product_reviews_pros_status') || $objConfig->get('product_reviews_predefined_pros_cons_status')) {
					echo'<td class="pros" style="width:50%!important;">' . $entry_add_pros . '</td>';
					}

					if ($objConfig->get('product_reviews_cons_status') || $objConfig->get('product_reviews_predefined_pros_cons_status')) {
					echo'<td class="cons">' . $entry_add_cons . '</td>';
					}

					echo'</tr>';
					echo'<tr>';

					echo'<td>';
					if ($predefined_pros && $objConfig->get('product_reviews_predefined_pros_cons_status')) {
						foreach ($predefined_pros as $pros) {
							echo'<div class="predefined_pros_cons"><input type="checkbox" name="predefined_pros[]" value="' . base64_encode($pros['name']) . '" /> ' . $pros['name'] . '</div>';
						}
					}

					if ($objConfig->get('product_reviews_pros_status')) {
					echo'<input type="text" name="review_pros[]" />';
					}
					echo'</td>';

					echo'<td>';
					if ($predefined_cons && $objConfig->get('product_reviews_predefined_pros_cons_status')) {
						foreach ($predefined_cons as $cons) {
							echo'<div class="predefined_pros_cons"><input type="checkbox" name="predefined_cons[]" value="' . base64_encode($cons['name']) . '" /> ' . $cons['name'] . '</div>';
						}
					}

					if ($objConfig->get('product_reviews_cons_status')) {
					echo'<input type="text" name="review_cons[]" />';
					}
					echo'</td>';

					echo'</tr>';
					echo'</table>';
					}

					if ($objConfig->get('product_reviews_image_status')) {
					echo'<div style="margin-top: 20px;">' . $entry_review_image . ' <span class="left-button-org"><span class="right-button-org"><input type="button" value="' . $button_upload . '" id="review_image" class="button"></span></span><div id="review_images"></div></div>';
					}

					if ($objConfig->get('product_reviews_recommend_status')) {
					echo'<div style="margin-top: 20px;">' . $entry_recommend_product . ' <select name="recommend" class="form-control"><option value="y">' . $text_yes . '</option><option value="n">' . $text_no . '</option></select></div>';
					}
				}
			} else { ?><?php echo $entry_bad; ?></span>&nbsp;
						<input type="radio" name="rating" value="1" />
						&nbsp;
						<input type="radio" name="rating" value="2" />
						&nbsp;
						<input type="radio" name="rating" value="3" />
						&nbsp;
						<input type="radio" name="rating" value="4" />
						&nbsp;
						<input type="radio" name="rating" value="5" />
						&nbsp; <span class="radio"><?php echo $entry_good; ?></span><?php } ?></span><br />
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


  				<div id="tab-questions" class="tab-content"></div>
			
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


				<?php echo $combo; ?>
			
  <?php echo $content_bottom; ?></div>
  <?php echo $column_left; ?>
	</div>
</div>
<?php echo $column_right; ?>


				<!--VALDEIR - CALCULA FRETE-->
				<?php if ($shipping): ?>
				<script type="text/javascript"><!--

				//Aplica CSS na div calcula_cep
				$("#calcula_cep").css({
					'border-bottom':'1px solid #E7E7E7',
					//'border-top':'1px solid #E7E7E7',
					margin:'0 0 20px 0',
					padding:'10px 0'
				});

				//Aplica CSS na div resultado e aviso
				$("#resultado, #aviso").css({
					display:'none',
					padding:'10px 0 0'
				});

				//Quando o botão calcular for clicado
				$('.option input').first().attr('checked', true);
				$("#calcular").click(function() {
    //Envia a solicitação via AJAX
    $.ajax({
        url: 'index.php?route=valdeir/calcula_frete',
        type: 'post',
        data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
        dataType: 'json',
        success: function(json) {
            if (json['shipping_method']) {
                    html = '<h2><?php echo $calculaFrete_titulo ?></h2>';
                    html += '  <table class="radio">';

                    for (i in json['shipping_method']) {
                        html += '<tr>';
                        html += '  <td colspan="3"><b>' + json['shipping_method'][i]['title'] + '</b></td>';
                        html += '</tr>';

                        if (!json['shipping_method'][i]['error']) {
                            for (j in json['shipping_method'][i]['quote']) {
                                html += '<tr class="highlight">';

                                html += '<td><input type="hidden" /></td>';

                                html += '  <td><label for="' + json['shipping_method'][i]['quote'][j]['code'] + '">' + json['shipping_method'][i]['quote'][j]['title'] + '</label></td>';
                                html += '  <td style="text-align: right;"><label for="' + json['shipping_method'][i]['quote'][j]['code'] + '">' + json['shipping_method'][i]['quote'][j]['text'] + '</label></td>';
                                html += '</tr>';
                            }
                        } else {
                            html += '<tr>';
                            html += '  <td colspan="3"><div class="error">' + json['shipping_method'][i]['error'] + '</div></td>';
                            html += '</tr>';
                        }
                    }

                    html += '  </table>';
                    html += '  <br />';
                } else {
                    html = '<h2>Erro</h2> <ul>';

                    $error = json['error'];

                    for (var p in $error) {
                        html += '<li>' + $error[p] + '<li>';
                    }

                    html += '</li>';
                }

                $.colorbox({
                    overlayClose: true,
                    opacity: 0.5,
                    width: '600px',
                    href: false,
                    html: html
                });

        }
    });

    return false;
});

				//--></script>
				<?php endif; ?>
				<!-- FIM VALDEIR - CALCULA FRETE-->
			
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

			if (json['error']['accessory']) {
				var error_msg = '';
				for (i in json['error']['accessory']) {
					error_msg += json['error']['accessory'][i] + '<br />';
				}
				$('#accessory_msg').html('<div class="warning">' + error_msg + '</div>');
			}
			
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


  				$('#tab-questions').load('index.php?route=module/productquestion/getForm&product_id=<?php echo $product_id; ?>');
			
$('#button-review').bind('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: $("#form-review").serialize(),
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

				
			<?php if ($objConfig->get('product_reviews_status')) { ?>
			$('input[name^=\'review_pros\']').each(function(index) {
				if (!$(this).is(':last-child')) {
					$(this).remove();
				}
			});

			$('input[name^=\'review_cons\']').each(function(index) {
				if (!$(this).is(':last-child')) {
					$(this).remove();
				}
			});

			$('input[name^=\'rating\']').each(function(index) {
				$(this).val('');
			});
			<?php } ?>
			
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


			<script type="text/javascript"><!--
			function update_accessories(){
				
				if($('#accessories_ids').attr('value') == '') return;
				
				var product_quantity = $('input[name="quantity"]').attr('value');
			
				if(!isNaN(product_quantity)){
			
					var product_price = $('#price_value').attr('value');
			
					var product_total = product_price * product_quantity;
				
					var accessories_ids = $('#accessories_ids').attr('value').split('.');
					
					var total_accessories = 0;
					for (var i = 0; i < accessories_ids.length; i++) {
						
						qtde = document.getElementById("accessories["+accessories_ids[i]+"]").value;
						if(isNaN(qtde)) {
							document.getElementById("accessories["+accessories_ids[i]+"]").value = 0;
						}
						else{
							value = document.getElementById("accessories_values["+accessories_ids[i]+"]").value;
					
							total_accessories += qtde*value;
						}
					}
					var total_geral = product_total + total_accessories;
				
					$('#total_accessories').html('R$ ' + total_accessories.toFixed(2));
					$('#total_geral').html('R$ ' + total_geral.toFixed(2));
				}
				else{
					$('input[name="quantity"]').attr('value', 1);
				}	
			}
			
			$(document).ready(function() {
				update_accessories();
			});
			
			function getDiscount(product_id, quantity){
				$.ajax({
					url: 'index.php?route=product/product/discount&product_id=' + product_id,
					type: 'post',
					dataType: 'json',
					data: 'quantity=' + quantity,
					beforeSend: function() {
						$('#accessory_msg').html('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
					},
					complete: function() {
						$('.attention').remove();
					},
					success: function(data) {
						if (data['error']) {
							$('#accessory_msg').html('<div class="warning">' + data['error'] + '</div>');
						}
						
						if (data['success']) {
							document.getElementById("accessories_values["+product_id+"]").value = data['price'];
						}
						update_accessories();
					}
				});			
			}
			$('input[name="quantity"]').keyup(function() {
				update_accessories();
			});
			//--></script>
			

			<style>
			.verified_buyer {
				background-color: #698b22;
				color: #ffffff;
				padding: 2px 4px;
				font-size: 11px;
				font-weight: normal;
				-webkit-border-radius: 3px;
				-khtml-border-radius: 3px;    
				-moz-border-radius: 3px;
				border-radius: 3px;
			}
			</style>
			
<?php if ($objConfig->get('product_reviews_status')) {
			echo'<style>' . html_entity_decode($objConfig->get('product_reviews_form_css'), ENT_QUOTES, 'UTF-8') . "\n" . html_entity_decode($objConfig->get('product_reviews_list_css'), ENT_QUOTES, 'UTF-8') . "\n" . html_entity_decode($objConfig->get('product_reviews_pros_cons_list_css'), ENT_QUOTES, 'UTF-8') . "\n" . html_entity_decode($objConfig->get('product_reviews_rating_css'), ENT_QUOTES, 'UTF-8') . "\n" . html_entity_decode($objConfig->get('product_reviews_helpfulness_css'), ENT_QUOTES, 'UTF-8') . "\n" . html_entity_decode($objConfig->get('product_reviews_sort_css'), ENT_QUOTES, 'UTF-8') . "\n" . html_entity_decode($objConfig->get('product_reviews_total_rating_css'), ENT_QUOTES, 'UTF-8') . "\n" . html_entity_decode($objConfig->get('product_reviews_image_css'), ENT_QUOTES, 'UTF-8') . "\n" . html_entity_decode($objConfig->get('product_reviews_comment_css'), ENT_QUOTES, 'UTF-8') . "\n" . html_entity_decode($objConfig->get('product_reviews_summary_css'), ENT_QUOTES, 'UTF-8') . "\n" . html_entity_decode($objConfig->get('product_reviews_share_css'), ENT_QUOTES, 'UTF-8') . '</style>';
			} ?>

			  <?php if ($objConfig->get('product_reviews_status')) { ?>
			  <?php if ($objConfig->get('product_reviews_report_abuse_status')) { ?>
			  <input type="hidden" name="r_id" value="" />
			  <?php if (version_compare(VERSION, '2.0') < 0) { ?>
			  <div id="dialog-report-abuse" title="<?php echo $text_report_abuse; ?>">
			    <p class="validateTips"></p>
				<?php foreach ($reasons as $reason) { ?>
			    <input type="radio" name="reason_id" value="<?php echo $reason['reason_id']; ?>" /> <?php echo $reason['name']; ?><br />
			    <?php } ?>
			    <input type="radio" name="reason_id" value="0" /> <?php echo $text_other_reason; ?><br /><input type="text" name="other" value="" class="ui-widget-content ui-corner-all" style="margin: 3px 0 0 25px;" />
			  </div>
			  <?php } else { ?>
			  <div class="modal fade" id="dialog-report-abuse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
				  <div class="modal-content">
				    <div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <h4 class="modal-title" id="myModalLabel"><?php echo $text_report_abuse; ?></h4>
				    </div>
				    <div class="modal-body">
					  <p class="validateTips"></p>
					  <?php foreach ($reasons as $reason) { ?>
					  <input type="radio" name="reason_id" value="<?php echo $reason['reason_id']; ?>" /> <?php echo $reason['name']; ?><br />
					  <?php } ?>
					  <input type="radio" name="reason_id" value="0" /> <?php echo $text_other_reason; ?><br /><input type="text" name="other" value="" class="form-control" style="width: 200px; margin: 3px 0 0 25px;" />
				    </div>
				    <div class="modal-footer">
				      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				      <button type="button" class="btn btn-primary" id="button-reason-send"><?php echo $button_continue; ?></button>
				    </div>
			      </div>
			    </div>
			  </div>
			  <?php } ?>
			  <?php } ?>

			  <?php if ($objConfig->get('product_reviews_image_status')) { ?>
			  <?php if (version_compare(VERSION, '2.0') < 0) { ?>
			  <script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
			  <?php } ?>

			  <?php } ?>
			  <script type="text/javascript"><!--
			  $(document).ready(function(){
			    <?php if ($objConfig->get('product_reviews_report_abuse_status')) { ?>
				$(document).delegate('a#report_abuse', 'click', function() {
				  <?php if ($objConfig->get('product_reviews_report_abuse_guest') && !$objCustomer->isLogged()) { ?>
				  alert('<?php echo $error_logged_report_abuse; ?>');
				  <?php } else { ?>
				  $('input[name="r_id"]').val($(this).attr("rel"));

				  <?php if (version_compare(VERSION, '2.0') < 0) { ?>
				  $("#dialog-report-abuse").dialog("open");
				  <?php } else { ?>
				  $("#dialog-report-abuse").modal('show');
				  <?php } ?>
				  <?php } ?>
				});

				<?php if (version_compare(VERSION, '2.0') < 0) { ?>
				 $("#dialog-report-abuse").dialog({
				  autoOpen: false,
				  height: 300,
				  width: 350,
				  modal: true,
				  buttons: {
				    "<?php echo $button_continue; ?>": function() {
					  $.ajax({
					    url: 'index.php?route=product/allreviews/reportabuse&review_id=' + $('input[name="r_id"]').val(),
						type: 'post',
						dataType: 'json',
						data: 'reason_id=' + encodeURIComponent($('input[name=\'reason_id\']:checked').val()) + '&def=' + encodeURIComponent($('input[name=\'other\']').val()),
						beforeSend: function() {
						  $(".validateTips").text("").removeClass("ui-state-highlight ui-state-error ui-state-success");
						},
						complete: function() { },
						success: function(data) {
						  if (data['error']) {
						    $(".validateTips").text(data['error']).addClass("ui-state-highlight ui-state-error").css('padding', '10px');
						  }

						  if (data['success']) {
							$(".validateTips").text(data['success']).addClass("ui-state-highlight ui-state-success").css('padding', '10px');

							$("#dialog-report-abuse").siblings('.ui-dialog-buttonpane').find('button:first').hide();
						  }
						}
					  });
				    },
				    Cancel: function() {
				      $(this).dialog("close");
				    }
				  },
				  close: function() {
					$(".validateTips").text("").removeClass("ui-state-highlight ui-state-error ui-state-success").css('padding', '0px');
					$("#dialog-report-abuse").siblings('.ui-dialog-buttonpane').find('button:first').show();
					$('input[name=\'other\']').val('');
				  }
				});
				<?php } else { ?>
				$(document).delegate('#button-reason-send', 'click', function() {
				  if ($('input[name=\'reason_id\']:checked').length <= 0) {
				    return;
				  }

				  $.ajax({
				    url: 'index.php?route=product/allreviews/reportabuse&review_id=' + $('input[name="r_id"]').val(),
				    type: 'post',
				    dataType: 'json',
				    data: 'reason_id=' + encodeURIComponent($('input[name=\'reason_id\']:checked').val()) + '&def=' + encodeURIComponent($('input[name=\'other\']').val()),
				    beforeSend: function() {
				      $(".validateTips").html("");
				    },
				    complete: function() { },
				    success: function(data) {
					  if (data['error']) {
					    $(".validateTips").html('<div class="alert alert-danger">' + data['error'] + '</div>').css('padding', '10px');
					  }

					  if (data['success']) {
					    $(".validateTips").html('<div class="alert alert-success">' + data['success'] + '</div>').css('padding', '10px');

					    $("#dialog-report-abuse").find('#button-reason-send').hide();
					  }
				    }
				  });
				});
				<?php } ?>
				<?php } ?>

				function isMobileDetect() {
					return (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino|android|ipad|playbook|silk/i.test(navigator.userAgent||navigator.vendor||window.opera)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test((navigator.userAgent||navigator.vendor||window.opera).substr(0,4)))
				}

				$('.rating_star2').jRating({
					smallStarsPath: 'catalog/view/javascript/jRating-master/jquery/icons/small.png',
					mediumStarsPath: 'catalog/view/javascript/jRating-master/jquery/icons/medium.png',
					bigStarsPath: 'catalog/view/javascript/jRating-master/jquery/icons/stars.png',
					phpPath: '<?php echo HTTP_SERVER; ?>catalog/view/javascript/jRating-master/php/jRating.php',
					step: true,
					type: '<?php echo $objConfig->get('product_reviews_appearance_type'); ?>',
					length: 5,
					rateMax: 5,
					showRateInfo: false,
					canRateAgain: true,
					nbRates: 7,
					onClick : function(element, rate) {
						if (isMobileDetect()) {
							$('input[name="rating[' + $(element).attr('data-id') + ']"]').val(rate);
						} else {
							$('input[name="rating[' + $(element).parent('div').attr('data-id') + ']"]').val(rate);
						}
					},
					onTouchstart : function(element, rate) {
						if (isMobileDetect()) {
							$('input[name="rating[' + $(element).attr('data-id') + ']"]').val(rate);
						} else {
							$('input[name="rating[' + $(element).parent('div').attr('data-id') + ']"]').val(rate);
						}
					}
				});

				<?php if ($objConfig->get('product_reviews_helpfulness_status')) { ?>
				$(document).delegate('.product_review_vote button', 'click', function() {
					<?php if ($objConfig->get('product_reviews_helpfulness_guest') && !$objCustomer->isLogged()) { ?>
					alert('<?php echo $error_logged_helpfull; ?>');
					<?php } else { ?>
					var helpfull_box = $(this).parents('.product_review_helpfulness').find('span:first');
					var helpfull_box_copy = helpfull_box.html();

					$.ajax({
						url: 'index.php?route=product/allreviews/vote&product_id=<?php echo $objRequest->get['product_id']?>',
						type: 'post',
						dataType: 'json',
						data: 'vote=' + encodeURIComponent($(this).attr('data-vote')) + '&review_id=' + encodeURIComponent($(this).attr('data-review-id')),
						beforeSend: function() {
							<?php if (version_compare(VERSION, '2.0') < 0) { ?>
							helpfull_box.html('<img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_please_wait; ?>');
							<?php } else { ?>
							helpfull_box.html('<i class="fa fa-spin fa-spinner"></i> <?php echo $text_please_wait; ?>');
							<?php } ?>
						},
						complete: function() { },
						success: function(data) {
							if (data['error']) {
								alert(data['error']);

								helpfull_box.html(helpfull_box_copy);
							}

							if (data['success']) {
								helpfull_box.html(data['success']);
							}
						}
					});
					<?php } ?>
				});
				<?php } ?>
			});

			var pros_cons_limit = '<?php echo (int)$objConfig->get('product_reviews_pros_cons_limit'); ?>';

			$('.pros_cons').on('keyup', 'input[name^="review_pros"], input[name^="review_cons"]', function() {
				name = $(this).attr('name').replace('[]', '');

				if (this.value != '') {
					if ($('input[name^="' + name + '"]:last').val() != '' && $('input[name^="' + name + '"]').length < pros_cons_limit) {
						$('input[name^="' + name + '"]:last').after('<input type="text" name="' + name + '[]" />');
					}
				} else {
					if (this.value == '' && $('input[name^="' + name + '"]').length > 1) {
						if (!$(this).is(':last-child')) {
							$(this).remove();
						}

						if ($('input[name^="' + name + '"]:last').val() != '') {
							$('input[name^="' + name + '"]:last').after('<input type="text" name="' + name + '[]" />');

							$('input[name^="' + name + '"]:last').focus();
						}
					}
				}
			});

			<?php if ($objConfig->get('product_reviews_image_status')) { ?>
			<?php if (version_compare(VERSION, '2.0') < 0) { ?>
			new AjaxUpload('#review_image', {
				action: 'index.php?route=product/allreviews/reviewimageupload',
				name: 'file',
				autoSubmit: true,
				responseType: 'json',
				onSubmit: function(file, extension) {
					$('#review_image').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
					$('#review_image').attr('disabled', true);
				},
				onComplete: function(file, json) {
					$('#review_image').attr('disabled', false);

					$('.error').remove();

					if (json['success']) {
						alert(json['success']);

						$('#review_images').append('<div class="rimage"><img src="' + json['thumb'] + '" alt="" /><input type="hidden" name="review_images[]" value="' + json['file'] + '" /></div>');

						if ($('#review_images > div').length >= <?php echo (int)$objConfig->get('product_reviews_image_limit'); ?>) {
							$('#review_image').remove();
						}
					}

					if (json['error']) {
						$('#review_image').after('<span class="error">' + json['error'] + '</span>');
					}

					$('.loading').remove();	
				}
			});
			<?php } else { ?>
			$('#review_image').on('click', function() {
				var node = this;

				$('#form-upload').remove();

				$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

				$('#form-upload input[name=\'file\']').trigger('click');

				timer = setInterval(function() {
					if ($('#form-upload input[name=\'file\']').val() != '') {
						clearInterval(timer);

						$.ajax({
							url: 'index.php?route=product/allreviews/reviewimageupload',
							type: 'post',
							dataType: 'json',
							data: new FormData($('#form-upload')[0]),
							cache: false,
							contentType: false,
							processData: false,
							beforeSend: function() {
								$(node).button('loading');
							},
							complete: function() {
								$(node).button('reset');
							},
							success: function(json) {
								$('.text-danger').remove();
					
								if (json['error']) {
									$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
								}
					
								if (json['success']) {
									alert(json['success']);

									$('#review_images').append('<div class="rimage"><img src="' + json['thumb'] + '" alt="" /><input type="hidden" name="review_images[]" value="' + json['file'] + '" /></div>');

									if ($('#review_images > div').length >= <?php echo (int)$objConfig->get('product_reviews_image_limit'); ?>) {
										$(node).remove();
									}
								}
							},
							error: function(xhr, ajaxOptions, thrownError) {
								alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
							}
						});
					}
				}, 500);
			});
			<?php } ?>
			<?php } ?>
			//--></script>
			<?php } ?>
			
<?php echo $footer; ?>
                            