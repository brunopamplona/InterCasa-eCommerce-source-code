<?php echo str_replace(array('view/javascript/jquery/jquery-1.6.1.min.js', 'view/javascript/jquery/jquery-1.7.1.min.js', 'http://code.jquery.com/jquery-1.7.2.min.js'), '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', $header); ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-review" id="button-save" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-review" class="form-horizontal">
		  <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-author"><?php echo $entry_author; ?></label>
            <div class="col-sm-4">
			  <input type="text" name="author" value="<?php echo $author; ?>" placeholder="<?php echo $entry_author; ?>" id="input-author" class="form-control" />
              <?php if ($error_author) { ?>
              <div class="text-danger"><?php echo $error_author; ?></div>
              <?php } ?>
            </div>
          </div>
		  <div class="form-group required">
			<label class="col-sm-2 control-label s_help" for="input-product"><?php echo $entry_product; ?><b><?php echo $help_product; ?></b></label>
            <div class="col-sm-4">
			  <input type="text" name="product" value="<?php echo $product; ?>" placeholder="<?php echo $entry_product; ?>" <?php if ($product_id) { echo'readonly'; } ?> id="input-product" class="form-control" />
			  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
              <?php if ($error_product) { ?>
              <div class="text-danger"><?php echo $error_product; ?></div>
              <?php } ?>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-review-title"><?php echo $entry_review_title; ?></label>
            <div class="col-sm-4">
			  <input type="text" name="review_title" value="<?php echo $review_title; ?>" placeholder="<?php echo $entry_review_title; ?>" id="input-review-title" class="form-control" />
            </div>
          </div>
		  <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-text"><?php echo $entry_text; ?></label>
            <div class="col-sm-4">
              <textarea name="text" cols="40" rows="5" id="input-text" class="form-control"><?php echo $text; ?></textarea>
              <?php if ($error_text) { ?>
              <div class="text-danger"><?php echo $error_text; ?></div>
              <?php } ?>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-rating"><?php echo $entry_rating; ?></label>
            <div class="col-sm-4">
              <input type="hidden" name="rating" value="" />
			  <div id="rating">
			    <div class="alert alert-danger"><?php echo $error_select; ?></div>
			  </div>
			  <?php if ($error_rating) { ?>
              <div class="text-danger"><?php echo $error_rating; ?></div>
              <?php } ?>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-comment"><?php echo $entry_comment; ?></label>
            <div class="col-sm-4">
              <textarea name="comment" cols="40" rows="5" id="input-comment" class="form-control"><?php echo $comment; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-store"><?php echo $entry_store; ?></label>
            <div class="col-sm-4">
              <select name="store_id" id="input-store" class="form-control">
                <?php foreach ($stores as $store) { ?>
                <?php if ($store['store_id'] == $store_id) { ?>
                <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-language"><?php echo $entry_language; ?></label>
            <div class="col-sm-4">
              <select name="language_id" id="input-language" class="form-control">
                <option value="0"><?php echo $text_select; ?></option>
				<?php foreach ($languages as $language) { ?>
                <?php if ($language['language_id'] == $language_id) { ?>
                <option value="<?php echo $language['language_id']; ?>" selected="selected"><?php echo $language['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $language['language_id']; ?>"><?php echo $language['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-pros"><?php echo $entry_pros; ?></label>
            <div class="col-sm-4">
              <div class="input-group">
			    <span class="input-group-addon"><i class="fa fa-thumbs-o-up text-success"></i></span>
				<input type="text" name="pv" class="form-control" placeholder="<?php echo $entry_pros; ?>" />
				<span class="input-group-btn">
				  <button class="btn btn-default" onclick="addPros();" type="button">+</button>
				</span>
			  </div>
			  <div id="pros" class="well well-sm" style="margin-top:4px; margin-bottom: 0px; height: 150px; overflow: auto;">
				<?php foreach ($pros as $row) { ?>
                <div><i class="fa fa-minus-circle"></i> <?php echo $row['name']; ?>
                  <input type="hidden" name="pros[][name]" value="<?php echo $row['name']; ?>" />
                </div>
                <?php } ?>
			  </div>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-cons"><?php echo $entry_cons; ?></label>
            <div class="col-sm-4">
              <div class="input-group">
			    <span class="input-group-addon"><i class="fa fa-thumbs-o-down text-danger"></i></span>
				<input type="text" name="pc" class="form-control" placeholder="<?php echo $entry_cons; ?>" />
				<span class="input-group-btn">
				  <button class="btn btn-default" onclick="addCons();" type="button">+</button>
				</span>
			  </div>
			  <div id="cons" class="well well-sm" style="margin-top:4px; margin-bottom: 0px; height: 150px; overflow: auto;">
				<?php foreach ($cons as $row) { ?>
                <div><i class="fa fa-minus-circle"></i> <?php echo $row['name']; ?>
                  <input type="hidden" name="cons[][name]" value="<?php echo $row['name']; ?>" />
                </div>
                <?php } ?>
			  </div>
            </div>
          </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label s_help"><?php echo $entry_image; ?><b><?php echo $help_image; ?></b></label>
            <div class="col-sm-4">
              <div><button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button></div>
			    <?php foreach ($images as $image) { ?>
			    <div style="display: inline-block; margin: 10px 10px 0 0; text-align: center;"><img class="image" src="<?php echo $image['thumb']; ?>" alt="" /><input type="hidden" name="images[]" value="<?php echo $image['image']; ?>" /><br /><a onclick="$(this).parent('div').remove();" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></div>
				<?php } ?>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-recommend"><?php echo $entry_recommend; ?></label>
            <div class="col-sm-4">
              <select name="recommend" id="input-recommend" class="form-control">
                <option value="0"><?php echo $text_select; ?></option>
                <?php if ($recommend == 'y') { ?>
                <option value="y" selected="selected"><?php echo $text_yes; ?></option>
				<option value="n"><?php echo $text_no; ?></option>
                <?php } elseif ($recommend == 'n') { ?>
				<option value="y"><?php echo $text_yes; ?></option>
                <option value="n" selected="selected"><?php echo $text_no; ?></option>
                <?php } else { ?>
				<option value="y"><?php echo $text_yes; ?></option>
				<option value="n"><?php echo $text_no; ?></option>
				<?php } ?>
              </select>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label s_help" for="input-date-added"><?php echo $entry_date_added; ?><b>YYYY-MM-DD</b></label>
            <div class="col-sm-4">
			  <input type="text" name="date_added" value="<?php echo $date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" id="input-date-added" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-4">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
var product_id = '<?php echo $product_id ? (int)$product_id : 0; ?>';
var review_id = '<?php echo (isset($_GET['review_id'])) ? (int)$_GET['review_id'] : 0; ?>';

function generateRating(id) {
	if (id == product_id) {
		rating = '<?php echo $product_rating; ?>';
	} else {
		rating = '';
	}

	$.ajax({
		url: 'index.php?route=product_review/review/rating&token=<?php echo $token; ?>&product_id=' + encodeURIComponent(id) + '&review_id=' + encodeURIComponent(review_id),
		type: 'post',
		data: {prc : rating},
		dataType: 'html',
		beforeSend: function() {
			$('#rating').html('<div class="wait"><i class="fa fa-spin fa-spinner"></i></span></div>');
			$('#button-save').attr('disabled', true);
		},	
		complete: function() {
			$('#button-save').attr('disabled', false);
		},
		success: function(html) {
			$('#rating').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

function addPros() {
	pros = $('input[name="pv"]').val().replace(/(<([^>]+)>)/ig, "").trim();

	if (pros == '') {
		return;
	}

	$('#pros').append('<div><i class="fa fa-minus-circle"></i> ' + pros + '<input type="hidden" name="pros[][name]" value="' + pros + '" /></div>');
	$('input[name="pv"]').val('');
}

function addCons() {
	cons = $('input[name="pc"]').val().replace(/(<([^>]+)>)/ig, "").trim();

	if (cons == '') {
		return;
	}

	$('#cons').append('<div><i class="fa fa-minus-circle"></i> ' + cons + '<input type="hidden" name="cons[][name]" value="' + cons + '" /></div>');
	$('input[name="pc"]').val('');
}

$('#pros, #cons').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

$(document).ready(function(){
	if (product_id != '0') {
		generateRating(product_id);
	}
});
//--></script>
<script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	select: function(item) {
		$('input[name=\'product\']').val(item['label']);
		$('input[name=\'product_id\']').val(item['value']);

		generateRating(item['value']);

		return false;	
	}
});

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
						
						$('#button-upload').closest('div').after('<div style="display: inline-block; margin: 10px 10px 0 0; text-align: center;"><img class="image" src="' + json['thumb'] + '" alt="" /><input type="hidden" name="images[]" value="' + json['file'] + '" /><br /><a onclick="$(this).parent(\'div\').remove();" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></div>');
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