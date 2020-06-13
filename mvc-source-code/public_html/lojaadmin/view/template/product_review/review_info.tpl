<?php echo str_replace(array('view/javascript/jquery/jquery-1.6.1.min.js', 'view/javascript/jquery/jquery-1.7.1.min.js', 'http://code.jquery.com/jquery-1.7.2.min.js'), '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', $header); ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
          <table class="table table-bordered">
		    <tbody>
			  <tr>
			    <td class="text-left" width="180"><?php echo $text_review_title; ?></td>
			    <td class="text-left"><?php echo $review_title; ?></td>
			  </tr>
			  <tr>
			    <td class="text-left"><?php echo $text_author; ?></td>
			    <td class="text-left"><?php echo $author; ?></td>
			  </tr>
			  <tr>
			    <td class="text-left"><?php echo $text_date_added; ?></td>
			    <td class="text-left"><?php echo $date_added; ?></td>
			  </tr>
			  <?php if ($date_reply) { ?>
			  <tr>
			    <td class="text-left"><?php echo $text_date_reply; ?></td>
			    <td class="text-left"><?php echo $date_reply; ?></td>
			  </tr>
			  <?php } ?>
			  <tr>
			    <td class="text-left"><?php echo $text_product; ?></td>
			    <td class="text-left"><?php echo $product; ?></td>
			  </tr>
			  <tr>
			    <td class="text-left"><?php echo $text_text; ?></td>
			    <td class="text-left"><?php echo $text; ?></td>
			  </tr>
			  <tr>
			    <td class="text-left"><?php echo $text_rating; ?></td>
			    <td class="text-left" style="white-space: nowrap;"><?php if ($ratings) { ?>
			      <?php foreach ($ratings as $rating) { ?>
				  <div style="margin-bottom: 3px;"><img src="view/javascript/AdvancedProductReviews/image/stars-<?php echo $rating['rating']; ?>.png" alt="" title="" style="vertical-align: middle;" /> <?php echo $rating['name']; ?></div>
				  <?php } ?>
			      <?php } else { ?>
				  <div style="margin-bottom: 3px;"><img src="view/javascript/AdvancedProductReviews/image/stars-<?php echo $rating_avg; ?>.png" alt="" title="" style="vertical-align: middle;" /></div>
				  <?php } ?></td>
			  </tr>
			  <tr>
			    <td class="text-left"><?php echo $text_store; ?></td>
			    <td class="text-left"><?php echo $store; ?></td>
			  </tr>
			  <tr>
			    <td class="text-left"><?php echo $text_language; ?></td>
			    <td class="text-left"><?php echo $language; ?></td>
			  </tr>
			   <tr>
			    <td class="text-left"><?php echo $text_recommend; ?></td>
			    <td class="text-left"><?php echo $recommend; ?></td>
			  </tr>
			  <?php if ($pros) { ?>
			  <tr>
			    <td class="text-left"><?php echo $text_pros; ?></td>
			    <td class="text-left"><table style="border: none;">
				<tbody>
				<?php foreach ($pros as $row) { ?>
				<tr>
				  <td width="20"><i class="fa fa-thumbs-o-up text-success"></i></td>
				  <td><?php echo $row['name']; ?></td>
			    </tr>
				<?php } ?>
				</tbody>
			      </table></td>
			  </tr>
			  <?php } ?>
			  <?php if ($cons) { ?>
			  <tr>
			    <td class="text-left"><?php echo $text_cons; ?></td>
			    <td class="text-left"><table style="border: none;">
				<tbody>
				<?php foreach ($cons as $row) { ?>
				<tr>
				  <td width="20"><i class="fa fa-thumbs-o-down text-danger"></i></td>
				  <td><?php echo $row['name']; ?></td>
			    </tr>
				<?php } ?>
				</tbody>
			    </table></td>
			  </tr>
			  <?php } ?>
			  <?php if ($images) { ?>
			  <tr>
			    <td class="text-left"><?php echo $text_image; ?></td>
			    <td valign="top" class="left">
			      <?php foreach ($images as $image) { ?>
			      <div style="display: inline-block; margin: 10px 10px 0 0; text-align: center;"><a href="<?php echo $image['popup']; ?>" target="_blank"><img class="image" src="<?php echo $image['thumb']; ?>" alt="" /></a></div>
				  <?php } ?></td>
			  </tr>
			  <?php } ?>
			  <tr>
			    <td class="text-left"><?php echo $text_status; ?></td>
			    <td class="text-left"><?php echo $status; ?></td>
			  </tr>
          </table>
          <hr />
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-comment"><?php echo $entry_comment; ?></label>
            <div class="col-sm-10">
              <textarea name="comment" placeholder="<?php echo $entry_comment; ?>" id="input-comment" class="form-control"><?php echo $comment; ?></textarea>
            </div>
          </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label"><?php echo $entry_comment_image; ?></label>
            <div class="col-sm-4">
              <div><button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button></div>
			    <?php foreach ($comment_images as $image) { ?>
			    <div style="display: inline-block; margin: 10px 10px 0 0; text-align: center;"><img class="image" src="<?php echo $image['thumb']; ?>" alt="" /><input type="hidden" name="comment_images[]" value="<?php echo $image['image']; ?>" /><br /><a onclick="$(this).parent('div').remove();" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></div>
				<?php } ?>
            </div>
          </div>
		  <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
              <a onclick="$('#form').submit();" id="button-save" class="btn btn-primary"><?php echo $button_save; ?></a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#button-upload').on('click', function() {
	$('#form-upload').remove();
	
	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');
	
	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);		
			
			$.ajax({
				url: 'index.php?route=product_review/review/upload&token=<?php echo $token; ?>',
				type: 'post',		
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,		
				beforeSend: function() {
					$('#button-upload').button('loading');
				},
				complete: function() {
					$('#button-upload').button('reset');
				},	
				success: function(json) {
					if (json['error']) {
						alert(json['error']);
					}
								
					if (json['success']) {
						alert(json['success']);
						
						$('#button-upload').closest('div').after('<div style="display: inline-block; margin: 10px 10px 0 0; text-align: center;"><img class="image" src="' + json['thumb'] + '" alt="" /><input type="hidden" name="comment_images[]" value="' + json['file'] + '" /><br /><a onclick="$(this).parent(\'div\').remove();" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></div>');
					}
				},			
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script>
<?php echo $footer; ?>