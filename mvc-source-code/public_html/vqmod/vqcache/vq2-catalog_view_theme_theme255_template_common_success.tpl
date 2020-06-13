<?php echo $header; ?>
<div class="<?php if ($column_right) { ?>span9<?php } else {?>span12<?php } ?>">
	<div class="row">
<div  class="<?php if ($column_left or $column_right) { ?>span9<?php } ?> <?php if ($column_left and $column_right) { ?>span6<?php } ?> <?php if (!$column_right and !$column_left) { ?>span12 <?php } ?>" id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <div class="box-container">

			
			<!-- MIT : Order Id-->
			<?php if(isset($text_order_id)) { ?>
			  <p><strong>N° do seu pedido: <?php echo $text_order_id;?></strong></p>
			<?php } ?>
			  <!-- MIT : Order Id END-->
			  
			
            
    <?php echo $text_message; ?>  
  
   
    
    <div class="buttons">
      <div class="right"><a href="<?php echo $continue; ?>" class="button"><span><?php echo $button_continue; ?></span></a></div>
   
    </div>
  </div>
  <?php echo $content_bottom; ?></div>
    <?php echo $column_left; ?>
	</div>
</div>
<?php echo $column_right; ?>



<!-- Google Code for Compra Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1066018175;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "RVgaCLqVmlYQ_8qo_AM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1066018175/?label=RVgaCLqVmlYQ_8qo_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>




<script type="text/javascript">
	window._st_account = 1885;
	window._cv_data = {
		'order_id': <?php echo $this->session->data['order_id']; ?>,      // Número do pedido
		'valor': '<?php echo str_replace("R$", "", $this->session->data['total']); ?>'
	};
	(function () {
		var ss = document.createElement('script');
		ss.type = 'text/javascript';
		ss.async = true;
		ss.src = '//app.shoptarget.com.br/js/tracking.js';
		var sc = document.getElementsByTagName('script')[0];
		sc.parentNode.insertBefore(ss, sc);
	})();
</script>




				<?php if (isset($ecommerce_tracking_status)) { ?>
					<?php if ($ecommerce_tracking_status && $order && $order_products) { ?>
						<?php echo $start_google_code; ?>

						<?php if ($ecommerce_global_object) { ?>
							<?php echo $ecommerce_global_object; ?>('require', 'ecommerce', 'ecommerce.js');

							<?php echo $ecommerce_global_object; ?>('ecommerce:addTransaction', {
								'id': "<?php echo $order['order_id']; ?>",
								'affiliation': "<?php echo $order['store_name']; ?>",
								'revenue': "<?php echo $order['order_total']; ?>",
								'shipping': "<?php echo $order['order_shipping']; ?>",
								'tax': "<?php echo $order['order_tax']; ?>",
								'currency': "<?php echo $order['currency_code']; ?>"
							});

							<?php foreach($order_products as $order_product) { ?>
							<?php echo $ecommerce_global_object; ?>('ecommerce:addItem', {
								'id': "<?php echo $order_product['order_id']; ?>",
								'name': "<?php echo $order_product['name']; ?>",
								'sku': "<?php echo $order_product['sku']; ?>",
								'category': "<?php echo $order_product['category']; ?>",
								'price': "<?php echo $order_product['price']; ?>",
								'quantity': "<?php echo $order_product['quantity']; ?>"
							});
							<?php } ?>

							<?php echo $ecommerce_global_object; ?>('ecommerce:send');
						<?php } else { ?>
							_gaq.push(['_set', 'currencyCode', '<?php echo $order['currency_code']; ?>']);

							_gaq.push(['_addTrans',
								"<?php echo $order['order_id']; ?>",
								"<?php echo $order['store_name']; ?>",
								"<?php echo $order['order_total']; ?>",
								"<?php echo $order['order_tax']; ?>",
								"<?php echo $order['order_shipping']; ?>",
								"<?php echo $order['payment_city']; ?>",
								"<?php echo $order['payment_zone']; ?>",
								"<?php echo $order['payment_country']; ?>"
							]);

							<?php foreach($order_products as $order_product) { ?>
							_gaq.push(['_addItem',
								"<?php echo $order_product['order_id']; ?>",
								"<?php echo $order_product['sku']; ?>",
								"<?php echo $order_product['name']; ?>",
								"<?php echo $order_product['category']; ?>",
								"<?php echo $order_product['price']; ?>",
								"<?php echo $order_product['quantity']; ?>"
							]);
							<?php } ?>

							_gaq.push(['_trackTrans']);
						<?php } ?>

						<?php echo $end_google_code; ?>
					<?php } else { ?>
						<?php echo $google_analytics; ?>
					<?php } ?>
				<?php } ?>
			
<?php echo $footer; ?>

                            
                            