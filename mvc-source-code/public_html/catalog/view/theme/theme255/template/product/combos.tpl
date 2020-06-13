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
					<?php if ($combos) { ?>
						<div class="product-filter">
							<div class="limit"><b><?php echo $text_limit; ?></b>
								<select onchange="location = this.value;">
									<?php foreach ($limits as $limits) { ?>
										<?php if ($limits['value'] == $limit) { ?>
											<option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
										<?php } else { ?>
											<option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
										<?php } ?>
									<?php } ?>
								</select>
							</div>
							<div class="display"><b><?php echo $text_display; ?></b> <?php echo $text_list; ?>  <a onclick="display('grid');"><?php echo $text_grid; ?></a></div>
						</div>
						<div class="product-compare"></div>
						<div class="product-grid">
							<ul class="row">

								<?php
								$i = 0;
								foreach ($combos as $combo) {

									$i++; ?>
									<?php
									if ($i % 4 == 1) {
										$a = 'first-in-line';
									} elseif ($i % 4 == 0) {
										$a = 'last-in-line';
									} else {
										$a = '';
									}
									?>
									<li class="span3 <?php echo $a ?>" id="combo<?php echo $combo['combo_id']; ?>">
										<?php if ($combo['thumb']) { ?>
											<div class="image">
												<a href="<?php echo $combo['href']; ?>">
													<img id="combo_img_<?php echo $combo['combo_id']; ?>" src="<?php echo $combo['thumb']; ?>"
														  alt="<?php echo $combo['name']; ?>"/>
												</a>
											</div>
										<?php } ?>
										<div class="name"><a href="<?php echo $combo['href']; ?>"><?php echo $combo['name']; ?></a></div>
										<div class="description">
											<?php foreach ($combo['products'] as $product) { ?>
												<?php echo $product['quantity'] . ' x ' ?>
												<a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
												<?php if ($product['price']) { ?>
													<span class="price2">
												  <?php if (!$product['special']) { ?>
													  <?php echo $product['price']; ?>
												  <?php } else { ?>
													  <?php echo $product['special']; ?>
												  <?php } ?>
												</span>
												<?php } ?>
												<br/>
											<?php } ?>
										</div>

										<?php if ($combo['total']) { ?>
											<div class="price">
												<?php if (!$combo['discount']) { ?>
													<?php echo $combo['total']; ?>
												<?php } else { ?>
													<span class="price-old"><?php echo $combo['total']; ?></span> <span
														class="price-new"><?php echo $combo['discount']; ?></span>
												<?php } ?>
												<?php if ($combo['tax']) { ?>
													<br/>
													<span class="price-tax"><?php echo $text_tax; ?> <?php echo $combo['tax']; ?></span>
												<?php } ?>
											</div>
											<div class="parcelemento-container">
												<?php
												$product['special'] = null;
												$product['price'] = ($combo['discount']) ? $combo['discount'] : $combo['total'];
												Parcelamento::e($product); ?>
											</div>
										<?php } ?>
										<div class="cart">
											<a onclick="addComboToCart('<?php echo $combo['combo_id']; ?>');" class="button">
												<span><?php echo $button_combo_cart; ?></span>
											</a>
										</div>
										<div class="wishlist"><span class="save-percent"><?php if ($combo['discount']) {
													printf($save_percent, $combo['percent']);
												} ?></span></div>
									</li>
								<?php } ?>
							</ul>
						</div>
						<div class="pagination"><?php echo $pagination; ?></div>
					<?php } else { ?>
						<div class="content"><?php echo $text_empty; ?></div>
						<div class="buttons">
							<div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
						</div>
					<?php } ?>
				</div>
				<?php echo $content_bottom; ?></div>
			<?php echo $column_left; ?>
		</div>
	</div>
<?php echo $column_right; ?>


	<script type="text/javascript">
		function addComboToCart(combo_id) {
			$.ajax({
				url: 'index.php?route=checkout/cart/addcombo',
				type: 'POST',
				data: 'combo_id=' + combo_id,
				dataType: 'json',
				success: function(json) {
					$('.success, .warning, .attention, .information, .error').remove();

					if (json['redirect']) {
						location = json['redirect'];

						$('#notification').html('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');

						$('.warning').fadeIn('slow');

						$('html, body').animate({ scrollTop: 0 }, 'slow');
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
	<script type="text/javascript"><!--
		function display(view) {
			if (view == 'list') {
				$('.product-grid ').attr('class', 'product-list');
				$('.product-list ul').removeClass('row');
				$('.product-list ul li').removeClass('span3');
				$('.product-list ul li').each(function(index, element) {
					html = '';
					html += '<div class="row">';
					var image = $(element).find('.image').html();

					if (image != null) {
						html += '<div class="image span2">' + image + '</div>';
					}
					html += '<div class="left span5">';
					html += '<div class="name">' + $(element).find('.name').html() + '</div>';
					html += '<div class="description">' + $(element).find('.description').html() + '</div>';
					var price = $(element).find('.price').html();
					if (price != null) {
						html += '<div class="price">' + price  + '</div>';
						html += '<div class="parcelemento-container">' + $(element).find('.parcelemento-container').html() + '</div>';
					}
					html += '<div class="cart-button">';
					html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
					//html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
					//html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
					html += '<div class="clear">' + $(element).find('.clear').html() + '</div>';
					html += '</div>';
					var rating = $(element).find('.rating').html();
					if (rating != null) {
						html += '<div class="rating">' + rating + '</div>';
					}
					html += '</div>';
					html += '</div>';



					$(element).html(html);
				});

				$('.display').html('<b><?php echo $text_display; ?></b> <div id="list_b"><i class="icon-list"></i></div> <a id="grid_a" onclick="display(\'grid\');"><i class="icon-th"></i></a>');

				$.totalStorage('display', 'list');
			} else {
				$('.product-list').attr('class', 'product-grid');
				$('.product-grid ul').addClass('row');
				$('.product-grid ul li').addClass('span3');
				$('.product-grid ul li').each(function(index, element) {
					html = '';

					var image = $(element).find('.image').html();

					if (image != null) {
						html += '<div class="image">' + image + '</div>';
					}
					html += '<div class="left">';




					html += '<div class="name">' + $(element).find('.name').html() + '</div>';
					var price = $(element).find('.price').html();

					if (price != null) {
						html += '<div class="price">' + price  + '</div>';
						html += '<div class="parcelemento-container">' + $(element).find('.parcelemento-container').html() + '</div>';
					}
					html += '<div class="description">' + $(element).find('.description').html() + '</div>';


					html += '<div class="cart-button">';
					html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
					//html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
					//html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
					html += '<div class="clear">' + $(element).find('.clear').html() + '</div>';
					html += '</div>';

					var rating = $(element).find('.rating').html();

					if (rating != null) {
						html += '<div class="rating">' + rating + '</div>';
					}

					html += '</div>';
					$(element).html(html);
				});

				$('.display').html('<b><?php echo $text_display; ?></b> <a id="list_a" onclick="display(\'list\');"><i class="icon-list"></i></a>  <div id="grid_b"><i class="icon-th"></i></i></div>');

				$.totalStorage('display', 'grid');
			}
			if ($('body').width() > 940) {
				// tooltip demo
				$('.tooltip-toggle').tooltip({
					selector: "a[data-toggle=tooltip]"
				})
				$('.tooltip-1').tooltip({
					placement:'bottom'
				})
				$('.tooltip-2').tooltip({
					placement:'top'
				})
			}

		}

		view = $.totalStorage('display');

		if (view) {
			display(view);
		} else {
			display('grid');
		}
		//--></script>
<?php echo $footer; ?>