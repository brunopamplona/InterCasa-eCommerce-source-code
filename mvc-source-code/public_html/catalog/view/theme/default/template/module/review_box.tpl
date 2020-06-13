<style>
<?php echo html_entity_decode($objConfig->get('product_reviews_box_css'), ENT_QUOTES, 'UTF-8'); ?>
</style>
<div class="box review_box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <?php if ($reviews): ?>
	<div class="box-product">
    <?php foreach ($reviews as $review) { ?>
      <div>
        <div class="review_text"><?php echo $review['text']; ?></div>
        <div class="review_author"><?php echo $review['author']; ?> <span class="review_date"><?php echo $review['date']; ?></span></div>
        <div class="review_rating"><img src="image/product_review/stars-<?php echo $objConfig->get('product_reviews_appearance_customer_rating'); ?>-<?php echo $review['rating']; ?>.png" alt="<?php echo $review['rating']; ?>" /></div>
      </div>
    <?php } ?>
    </div>
	<?php if ($button) { ?>
	<a href="<?php echo $all; ?>" class="button"><?php echo $button_view; ?></a>
	 <?php } ?>
	<?php endif; ?>
  </div>
</div>