<script type="text/javascript">
		(function($){$.fn.equalHeights=function(minHeight,maxHeight){tallest=(minHeight)?minHeight:0;this.each(function(){if($(this).height()>tallest){tallest=$(this).height()}});if((maxHeight)&&tallest>maxHeight)tallest=maxHeight;return this.each(function(){$(this).height(tallest)})}})(jQuery)
	$(window).load(function(){
		if($(".maxheight").length){
		$(".maxheight").equalHeights()}
	})
</script>

<script type="text/javascript">
$(document).ready(function(){
$(function(){
$('.new-products  li ').last().addClass('last');
});
}); 
</script>
	<div class="box new-products">
		<div class="box-heading"><?php echo $heading_title; ?></div>
		<div class="box-content">
			<div class="box-product">
				<ul class="row">
		  <?php $i=0; foreach ($products as $product) { $i++ ?>
		  <?php 
			   $perLine = 6;
			   $spanLine = 2;
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
							<div class="inner">
								<div class="f-left">
									<div class="name maxheight"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
									<?php if ($product['price']) { ?>
									<div class="price">
										<?php if (!$product['special']) { ?>
											A partir de: <?php echo $product['price']; ?>
										<?php } else { ?>
										<span class="price-new">De <?php echo $product['special']; ?></span><span class="price-old"> Por&nbsp; <?php echo $product['price']; ?></span>
										<?php } ?>
                                        <?php Parcelamento::enl($product); ?>
									</div>
									<?php } ?>
									<!--<?php if ($product['description']) {?>
										<div class="description"><?php echo mb_substr($product['description1'],0,70,'UTF-8').'...';?></div>
									<?php } ?>-->
								</div>
								<div class="cart-button">
						<div class="cart"><a title="<?php echo $button_cart; ?>" data-id="<?php echo $product['product_id']; ?>;" class="button addToCart"><i class="icon-shopping-cart"></i><span><?php echo $button_cart; ?></span></a></div>

						
						<!--<div class="compare"><a class="tooltip-1" title="<?php echo $button_compare; ?>"  onclick="addToCompare('<?php echo $product['product_id']; ?>');"><i class="icon-bar-chart"></i><span><?php echo $button_compare; ?></span></a></div>
						<div class="wishlist"><a class="tooltip-1" title="<?php echo $button_wishlist; ?>"  onclick="addToWishList('<?php echo $product['product_id']; ?>');"><i class="icon-star"></i><span><?php echo $button_wishlist; ?></span></a></div>-->
						<span class="clear"></span>
					</div>
								<div class="clear"></div>
								<div class="rating">
								<?php if ($product['rating']) { ?>
									<img height="13" src="catalog/view/theme/theme255/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" />
								<?php } ?>
								</div>
							</div>
								<div class="clear"></div>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>