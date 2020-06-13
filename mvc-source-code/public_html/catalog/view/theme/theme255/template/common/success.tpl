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



<?php echo $footer; ?>

                            
                            