<?php
//OpenCart Extension
//Project Name: OpenCart Combo/Bundle
//Author: Fanha Giang a.k.a fanha99
//Email (PayPal Account): fanha99@gmail.com
//License: Commercial
?>
<?php if ($combos) { ?>
  <div id="tab-combo" class="tab-content">
  <?php foreach ($combos as $combo) { ?>
    <div class="combo-box" id="combo<?php echo $combo['combo_id']; ?>">
		<div class="combo-name"><a href="<?php echo $combo['href']; ?>"><?php echo $combo['name'];?></a></div>
		<div class="combo-thumbs">
		  <?php $frist_product = 0; ?>
		  <?php foreach ($combo['products'] as $product) { ?>
			<?php if ($product['thumb']) { ?>
				<?php if ($frist_product == 0) { ?>
					<span><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></span>
				<?php } else { ?>
					<span><img src="image/plus.png" style="margin-bottom: <?php echo (($combo_image_product_height - 18) / 2); ?>px;"/></span>
					<span><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></span>
				<?php } ?>
			<?php } ?>
			<?php $frist_product ++; ?>
		  <?php } ?>
		</div>
	
		<div class="combo-price">
		  <?php if ($combo['total']) { ?>
		  <div class="price">
			<?php if (!$combo['discount']) { ?>
			<?php echo $combo['total']; ?>
			<?php } else { ?>
			 <span class="save-percent"><?php printf($save_percent, $combo['percent']); ?></span><br />
			<span class="price-old"><?php echo $combo['total']; ?></span> <span class="price-new"><?php echo $combo['discount']; ?></span>
			<?php } ?>
			<?php if ($combo['tax']) { ?>
			<br />
			<span class="price-tax"><?php echo $text_tax; ?> <?php echo $combo['tax']; ?></span>
			<?php } ?>
		  </div>
		  <?php } ?>
			<a onclick="addComboToCart('<?php echo $combo['combo_id']; ?>');" class="button"><?php echo $button_combo_cart; ?></a>
		</div>
	  
		<div class="combo-clear"></div>
		<ul>	  
		  <?php $frist_product = 0; ?>					
		  <?php foreach ($combo['products'] as $product) { ?>
		  <li>
			<?php if ($frist_product == 0) { ?>
				<?php echo $product['quantity'] . ' x <strong>' . $this_item . '</strong>'. $product['name']; ?>
			<?php } else { ?>
			<?php echo $product['quantity'] . ' x '?><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
			<?php } ?>
			<?php if ($product['price']) { ?>
			<span class="price <?php if ($frist_product == 0) { echo 'this_item_price'; } ?>">
			  <?php if (!$product['special']) { ?>
			  <?php echo $product['price']; ?>
			 <?php } else { ?>
			  <?php echo $product['special']; ?>
			  <?php } ?>
			</span>
			<?php } ?>
			<?php $frist_product ++; ?>
		  </li>
		  <?php } ?>
		</ul>
    </div>
    <?php } ?>
  </div>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/combos.css" />

<script type="text/javascript">
function addComboToCart(id) {
	$('input[name=combo_id]').val(id);
	$.ajax({
		url: 'index.php?route=checkout/cart/addcombo',
		type: 'POST',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information, .error').remove();
			
			if (json['error']) {
				if (json['error']['product_id'] != <?php echo $product_id?>) {
					location = json['redirect'];
				}
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}

					$('#notification').html('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
					
					$('.warning').fadeIn('slow');
					
					$('html, body').animate({ scrollTop: 0 }, 'slow'); 

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
}
</script>
<?php } ?>