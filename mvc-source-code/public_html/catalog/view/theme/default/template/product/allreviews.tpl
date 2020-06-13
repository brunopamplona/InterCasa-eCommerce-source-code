<?php if (version_compare(VERSION, '2.0') < 0) { ?>
<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <style>
  <?php
  if ($objConfig->get('product_reviews_default_view') == 'grid') {
	echo html_entity_decode($objConfig->get('product_reviews_page_grid_css'), ENT_QUOTES, 'UTF-8');
  } else {
    echo html_entity_decode($objConfig->get('product_reviews_page_list_css'), ENT_QUOTES, 'UTF-8');
  }
  ?>
  </style>
  <?php if ($reviews) { ?>
  <div class="product-filter">
    <div class="display"></div>
    <div class="limit"><?php echo $text_limit; ?>
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
    <div class="sort"><?php echo $text_sort; ?>
      <select onchange="location = this.value;">
        <?php foreach ($sorts as $sorts) { ?>
        <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
        <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="product-compare"></div>
  <div class="product-list all_review">
    <?php if ($objConfig->get('product_reviews_default_view') == 'grid') { ?>
	in development
	<?php } else { ?>
	<?php foreach ($reviews as $review) { ?>
    <div>
      <div class="left">
        <?php if ($objConfig->get('product_reviews_review_title_status') && $review['review_title']) { ?>
        <div class="review_list_title"><b><?php echo $review['review_title']; ?></b></div>
        <?php } ?>
		<div class="review_list_author"><b><?php echo $review['author']; ?></b> <?php echo $review['date']; ?> <span><?php echo $text_purchase; ?> <a href="<?php echo $review['href']; ?>"><?php echo $review['product']; ?></a></span></div>
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
	</div>
    <?php } ?>
	<?php } ?>
  </div>
  <div class="pagination"><?php echo $pagination; ?></div>
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
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <?php }?>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>

<?php } else { ?>

<?php echo $header; ?>
<div id="container" class="container j-container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li> <a href="<?php echo $breadcrumb['href']; ?>"> <?php echo $breadcrumb['text']; ?> </a> </li>
    <?php } ?>
  </ul>
  <style>
  <?php
  if ($objConfig->get('product_reviews_default_view') == 'grid') {
	echo html_entity_decode($objConfig->get('product_reviews_page_grid_css'), ENT_QUOTES, 'UTF-8');
  } else {
    echo html_entity_decode($objConfig->get('product_reviews_page_list_css'), ENT_QUOTES, 'UTF-8');
  }
  ?>
  </style>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <?php if ($reviews) { ?>
	  <div class="product-filter">
        <div class="row">
          <div class="col-sm-1 col-sm-offset-5 text-right">
            <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
          </div>
          <div class="col-sm-3 text-right">
            <select id="input-sort" class="form-control col-sm-3" onchange="location = this.value;">
              <?php foreach ($sorts as $sorts) { ?>
              <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
              <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </div>
          <div class="col-sm-1 text-right">
            <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
          </div>
          <div class="col-sm-2 text-right">
            <select id="input-limit" class="form-control" onchange="location = this.value;">
              <?php foreach ($limits as $limits) { ?>
              <?php if ($limits['value'] == $limit) { ?>
              <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
	  </div>
	  <br />
	  <div class="product-list all_review">
	    <?php if ($objConfig->get('product_reviews_default_view') == 'grid') { ?>
		in development
		<?php } else { ?>
		  <?php foreach ($reviews as $review) { ?>
		  <div>
		    <div class="left">
			  <?php if ($objConfig->get('product_reviews_review_title_status') && $review['review_title']) { ?>
			  <div class="review_list_title"><b><?php echo $review['review_title']; ?></b></div>
			  <?php } ?>
			  <div class="review_list_author"><b><?php echo $review['author']; ?></b> <?php echo $review['date']; ?> <span><?php echo $text_purchase; ?> <a href="<?php echo $review['href']; ?>"><?php echo $review['product']; ?></a></span></div>
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
		    </div>
		    <?php } ?>
		<?php } ?>
	  </div>
	  <div class="pagination"><?php echo $pagination; ?></div>
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
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
<?php } ?>