       <?php echo $header; ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<div class="<?php if ($column_right) { ?>span9<?php } else {?>span12<?php } ?>">
	<div class="row">
<div  class="<?php if ($column_left or $column_right) { ?>span9<?php } ?> <?php if ($column_left and $column_right) { ?>span6<?php } ?> <?php if (!$column_right and !$column_left) { ?>span12 <?php } ?>" id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1>Área do usuário: Auto Atendimento</h1>
  <div class="box-container clearfix">
	  <div class="container-fluid">
		  <div class="row-fluid">
			  <div class="span6 bg-gray">
				  <h2><?php echo $text_my_account; ?></h2>

				  <div class="content">
					  <ul>
						  <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
						  <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
						  <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
						  <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
					  </ul>
				  </div>
			  </div>
			  <!-- /.span6 -->
			  <div class="span6 bg-gray">
				  <h2><?php echo $text_my_orders; ?></h2>
				  <div class="content">
					  <ul>
						  <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
						  <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
						  <?php if ($reward) { ?>
							  <li><a href="<?php echo $reward; ?>"><?php echo $text_reward; ?></a></li>
						  <?php } ?>
						  <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
						  <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
					  </ul>
				  </div>
			  </div>
			  <!-- /.span6 -->
		  </div>
		  <!-- /.row-fluid -->

		  <div class="row-fluid">
			  <div class="span6 bg-gray">
				  <h2><?php echo $text_my_newsletter; ?></h2>
				  <div class="content">
					  <ul>
						  <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
					  </ul>
				  </div>
				  <!-- /.span6 -->
			  </div>
	  </div>
	  <!-- /.container-fluid -->





  </div>
  </div>
  <?php echo $content_bottom; ?></div>
        <?php echo $column_left; ?>
	</div>
</div>
<?php echo $column_right; ?>
        
<?php echo $footer; ?> 