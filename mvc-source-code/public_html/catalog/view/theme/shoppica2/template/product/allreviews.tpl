<?php echo $header; ?>

  <!-- ---------------------- -->
  <!--     I N T R O          -->
  <!-- ---------------------- -->
  <div id="intro">
    <div id="intro_wrap">
      <div class="s_wrap">
        <div id="breadcrumbs" class="s_col_12">
          <?php foreach ($breadcrumbs as $breadcrumb): ?>
          <?php echo $breadcrumb['separator']; ?><a href="<?php echo str_replace('&', '&amp;', $breadcrumb['href']); ?>"><?php echo $breadcrumb['text']; ?></a>
          <?php endforeach; ?>
        </div>
        <h1><?php echo $heading_title; ?></h1>
      </div>
    </div>
  </div>
  <!-- end of intro -->
  <style>
  <?php
  if ($this->registry->get('config')->get('product_reviews_default_view') == 'grid') {
	echo html_entity_decode($this->registry->get('config')->get('product_reviews_page_grid_css'), ENT_QUOTES, 'UTF-8');
  } else {
    echo html_entity_decode($this->registry->get('config')->get('product_reviews_page_list_css'), ENT_QUOTES, 'UTF-8');
  }
  ?>
  </style>
  <!-- ---------------------- -->
  <!--      C O N T E N T     -->
  <!-- ---------------------- -->
  <div id="content" class="s_wrap">
  
    <?php if (isset($tbData) && $tbData->common['column_position'] == "left" && $column_right): ?>
    <div id="left_col" class="s_side_col">
    <?php echo $column_right; ?>
    </div>
    <?php endif; ?>

    <div id="specials" class="s_main_col">

      <?php echo $content_top; ?>

      <?php if (!$reviews): ?>
      <p class="align_center s_f_16 s_p_20_0"><?php echo $text_empty; ?></p>
      <?php endif; ?>

      <?php if ($reviews): ?>

      <div id="listing_options">
        <div id="listing_arrange">
          <span class="s_label"><?php echo $text_sort; ?></span>
          <div id="listing_sort" class="s_switcher">
            <?php foreach ($sorts as $sortss): ?>
              <?php if (($sort . '-' . $order) == $sortss['value']): ?>
                <span class="s_selected"><?php echo $sortss['text']; ?></span>
				<?php break; ?>
              <?php endif; ?>
            <?php endforeach; ?>
            <ul class="s_options" style="display: none;">
            <?php foreach ($sorts as $sortss): ?>
              <?php if (($sort . '-' . $order) != $sortss['value']): ?>
                <li><a href="<?php echo $sortss['href']; ?>"><?php echo $sortss['text']; ?></a></li>
              <?php endif; ?>
            <?php endforeach; ?>
            </ul>
          </div>
          <span class="s_label"><?php echo $text_limit; ?></span>
          <div id="items_per_page" class="s_switcher">
            <?php foreach ($limits as $limitss): ?>
              <?php if ($limit == $limitss['value']): ?>
                <span class="s_selected"><?php echo $limitss['text']; ?></span>
              <?php endif; ?>
            <?php endforeach; ?>
            <ul class="s_options" style="display: none;">
            <?php foreach ($limits as $limitss): ?>
              <?php if ($limit != $limitss['value']): ?>
                <li><a href="<?php echo $limitss['href']; ?>"><?php echo $limitss['text']; ?></a></li>
              <?php endif; ?>
            <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div id="view_mode" class="s_nav">
        </div>
      </div>

      <div class="clear"></div>

      <div class="s_listing s_list_view clearfix all_review">
        <?php foreach ($reviews as $review): ?>

		<div class="s_itemR review_<?php echo $review['review_id']; ?>">

		  <div class="left">
        <div class="review_list_author"><b><?php echo $review['author']; ?></b> <?php echo $review['date']; ?> <span><?php echo $text_purchase; ?> <a href="<?php echo $review['href']; ?>"><?php echo $review['product']; ?></a></span></div>
        <div class="review_list_text"><?php echo $review['text']; ?></div>
	    <?php if ($this->registry->get('config')->get('product_reviews_image_status')) { ?>
	    <?php foreach ($review['images'] as $image) { ?>
	    <a href="<?php echo $image['popup']; ?>" class="product_review_image_popup"><img src="<?php echo $image['thumb']; ?>" alt="<?php echo $review['author']; ?>" title="<?php echo $review['author']; ?>" align="top" /></a>
	    <?php } ?>
	    <?php } ?>
	    <?php if ($this->registry->get('config')->get('product_reviews_pros_status') || $this->registry->get('config')->get('product_reviews_cons_status')) { ?>
	    <div class="product_feature">
	      <?php if ($this->registry->get('config')->get('product_reviews_pros_status') && $review['product_pros']) { ?>
	      <div>
	        <img src="image/product_review/pros.png" alt="<?php echo $text_pros; ?>" title="<?php echo $text_pros; ?>" /><b class="pros"><?php echo $text_pros; ?></b>
		    <ul>
		      <?php foreach ($review['product_pros'] as $pros) { ?>
		      <li><?php echo $pros['name']; ?></li>
		      <?php } ?>
		    </ul>
	      </div>
	      <?php } ?>
	      <?php if ($this->registry->get('config')->get('product_reviews_cons_status') && $review['product_cons']) { ?>
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
		    <li><?php echo $rating['name']; ?><img src="image/product_review/stars-<?php echo $this->registry->get('config')->get('product_reviews_appearance_customer_rating'); ?>-<?php echo $rating['rating']; ?>.png" alt="<?php echo $rating['rating']; ?>" /></li>
		    <?php } ?>
		    <?php if ($this->registry->get('config')->get('product_reviews_total_rating_status')) { ?>
		    <li class="product_review_total_rating"><?php echo $text_average_review; ?><img src="image/product_review/stars-<?php echo $this->registry->get('config')->get('product_reviews_appearance_customer_rating'); ?>-<?php echo $review['rating']; ?>.png" alt="<?php echo $review['rating']; ?>" /></li>
	     	<?php } ?>
		   <?php } else { ?>
		   <li>&nbsp;<img src="image/product_review/stars-<?php echo $this->registry->get('config')->get('product_reviews_appearance_customer_rating'); ?>-<?php echo $review['rating']; ?>.png" alt="<?php echo $review['rating']; ?>" /></li>
		  <?php } ?>
	      </ul>
        </div>
		<?php if ($this->registry->get('config')->get('product_reviews_share_status')) { ?>
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
		  <span class="clear"></span>
        </div>

        <?php endforeach; ?>
        <span class="clear"></span>
      </div>

      <div class="pagination">
        <?php echo $pagination; ?>
      </div>

      <?php endif; ?>

      <?php echo $content_bottom; ?>

    </div>

    <?php if (isset($tbData) && $tbData->common['column_position'] == "right" && $column_right): ?>
    <div id="right_col" class="s_side_col">
    <?php echo $column_right; ?>
    </div>
    <?php endif; ?>

  </div>
  <!-- end of content -->



<?php echo $footer; ?>
