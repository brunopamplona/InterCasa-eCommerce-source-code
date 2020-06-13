<script type="text/javascript">
	if ($('.container').width() > 723) {
		(function($){$.fn.equalHeights=function(minHeight,maxHeight){tallest=(minHeight)?minHeight:0;this.each(function(){if($(this).height()>tallest){tallest=$(this).height()}});if((maxHeight)&&tallest>maxHeight)tallest=maxHeight;return this.each(function(){$(this).height(tallest)})}})(jQuery)
	$(window).load(function(){
		if($(".maxheight-feat").length){
		$(".maxheight-feat").equalHeights()}
	});
	};
</script>
<div class="box featured" id="featured-box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
	<div class="box-product">
		<ul class="row">
		  <?php $i=0; foreach ($products as $product) { $i++ ?>
		  <?php 
			   $perLine = 4;
			   $spanLine = 4;
			   $last_line = "";
							$total = count($products);
							$totModule = $total%$perLine;
							if ($totModule == 0)  { $totModule = $perLine;}
							if ( $i > $total - $totModule) { $last_line = " last_line";}
							if ($i%$perLine==1) {
								$a='first-in-line';
							}
							elseif ($i%$perLine==0) {
								$a='last-in-line';
							}
							else {
								$a='';
							}
						?>
			<li class="<?php echo $a. $last_line ;?> span<?php echo $spanLine ;?>">
				<script type="text/javascript">
				$(document).ready(function(){
					$("a.colorbox<?php echo $i?>").colorbox({
					rel: 'colorbox',
					inline:true,
					html: true,
					width:'58%',
					maxWidth:'780px',
					height:'70%',
					opacity:0.6,
					open:false,
					returnFocus:false,
					fixed: false,
					title: false,
					href:'.quick-view<?php echo $i;?>',
					current:'Produto {current} of {total}'
					});
					});
				</script> 
				<div class="image2">
					<?php if($product['image'] && $product['thumb']){ ?>
							<a class="double-image clearfix" href="<?php echo $product['href']; ?>">
								<img class="img-first" id="img_<?php echo $product['product_id']; ?>" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
								<img class="img-hover" id="im2_<?php echo $product['product_id']; ?>" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
							</a>
					<?php }else{ ?>
						<?php if ($product['thumb']) { ?><a href="<?php echo $product['href']; ?>"><img id="img_<?php echo $product['product_id']; ?>" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a><?php } ?>
					<?php } ?>
					
				</div>
				<div style="display:none;">
					<div  class="quick-view<?php echo $i;?> preview">
						<div class="wrapper marg row-fluid">
							<div class="left span4">
								<?php if ($product['thumb1']) { ?>
									<div class="image3">
										<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb1']; ?>" alt="<?php echo $product['name']; ?>" /></a>
										
									</div>
								<?php } ?>
							</div>
							<div class="right span8">
								<h3><?php echo $product['name']; ?></h3>
								<div class="inf">
									<?php if ($product['author']) {?>
										<span class="manufacture"><?php echo $text_manufacturer; ?> <a href="<?php echo $product['manufacturers'];?>"><?php echo $product['author']; ?></a></span>
									<?php }?>
									<?php if ($product['model']) {?>
										<span class="model"><?php echo $text_model; ?><?php echo $product['model']; ?></span>
									<?php }?>
									<span class="prod-stock-2"><?php echo $text_availability; ?></span>
										
										<?php
										   if ($product['text_availability'] > 0) { ?>
										 <span class="prod-stock"><?php echo $text_instock; ?></span>
										<?php } else { ?>
											   <span class="prod-stock"><?php echo $text_outstock; ?></span>
										 <?php
										 }	
										 ?>
									<?php if ($product['price']) { ?>
										<div class="price">
									  <span class="text-price">De</span>
									  <?php if (!$product['special']) { ?>
										  A partir de: <?php echo $product['price']; ?>
									  <?php } else { ?>
									  <span class="price-new"><span class="price-old">&nbsp&nbsp;<?php echo $product['price']; ?></span> <br/> Por&nbsp;
                                          <?php echo $product['special']; ?></span>
									  <?php } ?>
											<div class="clear"></div>
											<?php
											Parcelamento::e($product);
											Desconto::e($product);
											?>
									</div>
									<?php } ?>
								</div>
								<div class="cart-button">
									<div class="cart">
										<a title="<?php echo $button_cart; ?>" data-id="<?php echo $product['product_id']; ?>;" class="button addToCart-1 ">
											<!--<i class="icon-shopping-cart"></i>-->
											<span><?php echo $button_cart; ?></span>
										</a>
									</div>

									<div class="wishlist">
										<a class="tooltip-1" title="<?php echo $button_wishlist; ?>"  onclick="addToWishList('<?php echo $product['product_id']; ?>');">
											<i class="icon-star"></i>
											<span><?php echo $button_wishlist; ?></span>
										</a>
									</div>
									<div class="compare">
										<a class="tooltip-1" title="<?php echo $button_compare; ?>"  onclick="addToCompare('<?php echo $product['product_id']; ?>');">
											<i class="icon-bar-chart"></i>
											<span><?php echo $button_compare; ?></span>
										</a>
									</div>
									<span class="clear"></span>
								</div>
								<div class="clear"></div>
								<div class="rating">
									<img height="18" src="catalog/view/theme/theme255/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" />
								</div>
							</div>
						</div>
						<div class="description">
							<?php echo $product['description'];?>
						</div>
						
					</div>
				</div>
				<a href="<?php echo $product['href']; ?>"   rel="colorbox" class="colorbox<?php echo $i;?> quick-view-button"><i class=" icon-search "></i></a>
				<div class="inner">
					<div class="f-left">
						
						<div class="name maxheight-feat"><a href="<?php echo $product['href']; ?>"><h3><?php echo $product['name']; ?></h3></a></div>
						<?php if ($product['price']) { ?>
						<div class="price">
							<?php if (!$product['special']) { ?>
								A partir de: <?php echo $product['price']; ?>
							<?php } else { ?>
							<span class="price-new">De <span class="price-old">&nbsp&nbsp;<?php echo $product['price']; ?></span> <br/> Por&nbsp; <?php
                                echo $product['special']; ?></span>
							<?php } ?>
                            <?php
									 Parcelamento::e($product);
									 Desconto::e($product);
									 ?>
						</div>
						<?php } ?>
						<!--<?php if ($product['description']) {?>
						<div class="description"><?php echo mb_substr($product['description1'],0,60,'UTF-8').'...';?></div>
						<?php } ?>-->
						
					</div>
					<div class="cart-button">
						<div class="cart"><a title="<?php echo $button_cart; ?>" data-id="<?php echo $product['product_id']; ?>;" class="button addToCart"><i class="icon-shopping-cart"></i><span><?php echo $button_cart; ?></span></a></div>

						
						<!--<div class="compare"><a class="tooltip-1" title="<?php echo $button_compare; ?>"  onclick="addToCompare('<?php echo $product['product_id']; ?>');"><i class="icon-bar-chart"></i><span><?php echo $button_compare; ?></span></a></div>
						<div class="wishlist"><a class="tooltip-1" title="<?php echo $button_wishlist; ?>"  onclick="addToWishList('<?php echo $product['product_id']; ?>');"><i class="icon-star"></i><span><?php echo $button_wishlist; ?></span></a></div>-->
						<span class="clear"></span>
					</div>
					<div class="clear"></div>
					<?php if ($product['rating']) { ?>
					<div class="rating">
						<img height="13" src="catalog/view/theme/theme255/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" />
					</div>
					<?php } ?>
				</div>
				<div class="clear"></div>
			</li>
		  <?php } ?>
		</ul>
	</div>
	<div class="clear"></div>
  </div>
</div>