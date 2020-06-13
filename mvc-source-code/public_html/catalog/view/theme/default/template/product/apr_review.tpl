<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
<div class="product_review_list">
  <div class="left">
    <?php if ($objConfig->get('product_reviews_review_title_status') && $review['review_title']) { ?>
    <div class="review_list_title"><b><?php echo $review['review_title']; ?></b></div>
    <?php } ?>
	<div class="review_list_author"><b><?php echo $review['author']; ?></b> <?php echo $text_on; ?> <?php echo $review['date_added']; ?></div>
    <div class="review_list_text"><?php echo $review['text']; ?></div>
	<?php if ($objConfig->get('product_reviews_image_status')) { ?>
	<?php foreach ($review['images'] as $image) { ?>
	<a href="<?php echo $image['popup']; ?>" class="product_review_image_popup"><img src="<?php echo $image['thumb']; ?>" alt="" title="" align="top" /></a>
	<?php } ?>
	<?php } ?>
	<?php if ($objConfig->get('product_reviews_pros_status') || $objConfig->get('product_reviews_cons_status')) { ?>
	<div class="product_feature">
	  <?php if ($objConfig->get('product_reviews_pros_status') && $review['product_pros']) { ?>
	  <div>
	    <img src="image/product_review/pros.png" alt="<?php echo $text_pros; ?>" title="<?php echo $text_pros; ?>" /><b class="pros"><?php echo $text_pros; ?></b>
		<ul>
		  <?php foreach ($review['product_pros'] as $pros) { ?>
		  <li><?php echo $pros['name']; ?></li>
		  <?php } ?>
		</ul>
	  </div>
	  <?php } ?>
	  <?php if ($objConfig->get('product_reviews_cons_status') && $review['product_cons']) { ?>
	  <div>
	    <img src="image/product_review/cons.png" alt="<?php echo $text_cons; ?> title="<?php echo $text_cons; ?>" /><b class="cons"><?php echo $text_cons; ?></b>
		<ul>
		  <?php foreach ($review['product_cons'] as $cons) { ?>
		  <li><?php echo $cons['name']; ?></li>
		  <?php } ?>
		</ul>
	  </div>
	  <?php } ?>
    </div>
    <?php } ?>
  </div>
  <div class="right">
    <div class="product_rating_list">
	  <ul>
	    <?php if ($review['ratings']) { ?>
		<?php foreach ($review['ratings'] as $rating) { ?>
		<li><?php echo $rating['name']; ?><img src="image/product_review/stars-<?php echo $objConfig->get('product_reviews_appearance_customer_rating'); ?>-<?php echo $rating['rating']; ?>.png" alt="<?php echo $rating['rating']; ?>" /></li>
		<?php } ?>
		<?php if ($objConfig->get('product_reviews_total_rating_status')) { ?>
		<li class="product_review_total_rating"><?php echo $text_average_review; ?><img src="image/product_review/stars-<?php echo $objConfig->get('product_reviews_appearance_customer_rating'); ?>-<?php echo $review['rating']; ?>.png" alt="<?php echo $review['rating']; ?>" /></li>
		<?php } ?>
		<?php } else { ?>
		<li>&nbsp;<img src="image/product_review/stars-<?php echo $objConfig->get('product_reviews_appearance_customer_rating'); ?>-<?php echo $review['rating']; ?>.png" alt="<?php echo $review['rating']; ?>" /></li>
		<?php } ?>
	  </ul>
    </div>
	<?php if ($objConfig->get('product_reviews_share_status')) { ?>
	<div class="product_review_social add-this">
	  <div class="addthis_toolbox addthis_default_style addthis_16x16_style" addthis:url="<?php echo $review['share_url']; ?>" addthis:title="<?php echo $review['share_title']; ?>" addthis:description="<?php echo str_replace('"', '', $review['text']); ?>">
	    <a class="addthis_button_facebook"></a>
		<a class="addthis_button_twitter" title="Tweet" href="#"></a>
		<a class="addthis_button_google_plusone_share"></a>	
		<a class="addthis_button_email"></a>
	  </div>
	  <script type="text/javascript">var addthis_config = {"data_track_clickback": true};</script>
	  <script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4ddcdd811ceeda00"></script>
	  <!-- AddThis Button END -->
	</div>
	<?php } ?>
  </div>
  <div style="clear: both;"></div>
  <?php if ($objConfig->get('product_reviews_helpfulness_status') || $objConfig->get('product_reviews_report_abuse_status')) { ?>
  <div class="product_review_helpfulness">
    <?php if ($objConfig->get('product_reviews_helpfulness_status')) { ?>
	<span class="product_review_vote"><?php echo $review['helpfulness']; ?></span>
	<?php } ?>&nbsp;
	<?php if ($objConfig->get('product_reviews_report_abuse_status')) { ?>
	<a id="report_abuse" rel="<?php echo $review['review_id']; ?>"><?php echo $text_report_it; ?></a>
    <?php } ?>
  </div>
  <?php } ?>
  <?php if ($review['comment']) { ?>
  <div class="product_review_comment">
    <div class="comment_author"><?php echo $text_reply; ?> <b><?php echo $objConfig->get('product_reviews_comment_author'); ?></b> <?php echo $text_on; ?> <?php echo $review['comment_date_added']; ?></div>
    <div class="comment_text"><?php echo $review['comment']; ?></div>
	<?php if ($objConfig->get('product_reviews_comment_image_status')) { ?>
	<?php foreach ($review['comment_images'] as $image) { ?>
	<a href="<?php echo $image['popup']; ?>" class="product_review_image_popup"><img src="<?php echo $image['thumb']; ?>" alt="<?php echo $review['author']; ?>" title="<?php echo $review['author']; ?>" align="top" /></a>
	<?php } ?>
	<?php } ?>
  </div>
  <?php } ?>
</div>
<?php } ?>
<div class="pagination"><?php echo $pagination; ?></div>
<?php } else { ?>
<div class="content"><?php echo $text_no_reviews; ?></div>
<?php } ?>
<?php if ($objConfig->get('product_reviews_image_status')) { ?>
<script type="text/javascript"><!--
if (typeof($.fancybox) == 'function') {
  $('a.product_review_image_popup').fancybox({
    width: <?php echo $objConfig->get('product_reviews_image_popup_width'); ?>,
	height: <?php echo $objConfig->get('product_reviews_image_popup_height'); ?>,
	autoDimensions: false
  });
}

if (typeof($.colorbox) == 'function') {
  $('a.product_review_image_popup').colorbox({
    width: <?php echo $objConfig->get('product_reviews_image_popup_width'); ?>,
    height: <?php echo $objConfig->get('product_reviews_image_popup_height'); ?>
  });
}

if (typeof($.prettyPhoto) !== 'undefined') {
  $('a.product_review_image_popup').prettyPhoto({
    theme: 'light_square',
	opacity: 0.5,
	social_tools: "",
	deeplinking: false
  });
}

if (typeof($.magnificPopup) !== 'undefined') {
  $('a.product_review_image_popup').magnificPopup({
    type: 'image',
	tLoading: 'Loading image #%curr%...',
	mainClass: 'mfp-img-mobile',
	image: {
	  tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
	  titleSrc: function(item) {
	    return item.el.attr('title');
	  }
	}
  });
}
//--></script>
<?php } ?>