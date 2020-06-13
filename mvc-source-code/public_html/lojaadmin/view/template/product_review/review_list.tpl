<?php echo str_replace(array('view/javascript/jquery/jquery-1.6.1.min.js', 'view/javascript/jquery/jquery-1.7.1.min.js', 'http://code.jquery.com/jquery-1.7.2.min.js'), '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', $header); ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a> <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-review').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<?php if ($error_rating) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_rating; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label" for="input-product"><?php echo $entry_product; ?></label>
                <input type="text" name="filter_product" value="<?php echo $filter_product; ?>" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-author"><?php echo $entry_author; ?></label>
                <input type="text" name="filter_author" value="<?php echo $filter_author; ?>" placeholder="<?php echo $entry_author; ?>" id="input-author" class="form-control" />
              </div>
			  <div class="form-group">
                <label class="control-label" for="input-average"><?php echo $entry_average; ?></label>
                <select name="filter_average" id="input-average" class="form-control">
                  <option value="*"></option>
				  <?php for ($i = 1; $i <= 5; $i++) { ?>
				  <?php if ($filter_average == $i) { ?>
                  <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                  <?php } ?>
				  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status && !is_null($filter_status)) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
			  <div class="form-group">
                <label class="control-label" for="input-store"><?php echo $entry_store; ?></label>
                <select name="filter_store" id="input-store" class="form-control">
                  <option value="*"></option>
				  <?php foreach ($stores as $store_id => $name) { ?>
                  <?php if (!is_null($filter_store) && $filter_store == $store_id) { ?>
                  <option value="<?php echo $store_id; ?>" selected="selected"><?php echo $name; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $store_id; ?>"><?php echo $name; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
		<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-review">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php if ($sort == 'pd.name') { ?>
                    <a href="<?php echo $sort_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_product; ?>"><?php echo $column_product; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'r.author') { ?>
                    <a href="<?php echo $sort_author; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_author; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_author; ?>"><?php echo $column_author; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php echo $column_rating; ?></td>
                  <td class="text-left"><?php if ($sort == 'rating_avg') { ?>
                    <a href="<?php echo $sort_avg; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_avg; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_avg; ?>"><?php echo $column_avg; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'pros') { ?>
                    <a href="<?php echo $sort_pros; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_pros; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_pros; ?>"><?php echo $column_pros; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'cons') { ?>
                    <a href="<?php echo $sort_cons; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_cons; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_cons; ?>"><?php echo $column_cons; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'r.vote_yes') { ?>
                    <a href="<?php echo $sort_vote_yes; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_vote_yes; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_vote_yes; ?>"><?php echo $column_vote_yes; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'r.vote_no') { ?>
                    <a href="<?php echo $sort_vote_no; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_vote_no; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_vote_no; ?>"><?php echo $column_vote_no; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'r.date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'r.store_id') { ?>
                    <a href="<?php echo $sort_store_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_store; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_store_id; ?>"><?php echo $column_store; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'r.status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                    <?php } ?> [<a onclick="$('#form-review').attr('action', '<?php echo $save; ?>'); $('#form-review').submit();" class="btn btn-link" style="color: #FF0000; padding: 0px 0px!important;"><?php echo $button_save; ?></a>]</td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($reviews) { ?>
				<?php foreach ($reviews as $review) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($review['review_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $review['review_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $review['review_id']; ?>" />
                    <?php } ?></td>
                  <td class="left"><?php if (!$review['images']) { ?>
                    <?php echo $review['name']; ?>
                    <?php } else { ?>
                    <div style="margin-bottom: 12px;"><?php echo $review['name']; ?></div><?php foreach ($review['images'] as $image) { ?>
                    <div style="display: inline-block; text-align: center;"><a href="<?php echo $image['popup']; ?>" target="_blank"><img src="<?php echo $image['thumb']; ?>" alt="<?php echo $review['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></a><br /><a id="button-delete-image" data-image-id="<?php echo $image['review_image_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></div>
                    <?php } ?>
                    <?php } ?></td>
                  <td class="left"><?php echo $review['author']; ?></td>
                  <td class="left" style="white-space: nowrap;"><?php if ($review['ratings']) { ?>
                    <?php foreach ($review['ratings'] as $rating) { ?>
                    <div style="margin-bottom: 3px;"><img src="view/javascript/AdvancedProductReviews/image/stars-<?php echo $rating['rating']; ?>.png" alt="" title="" style="vertical-align: middle;" /> <?php echo $rating['name']; ?></div>
                    <?php } ?>
                    <?php } else { ?>
                    <div style="margin-bottom: 3px;"><img src="view/javascript/AdvancedProductReviews/image/stars-<?php echo $review['rating_avg']; ?>.png" alt="" title="" style="vertical-align: middle;" /></div>
                    <?php } ?></td>
                  <td class="left"><?php if ($review['rating_avg'] <= 2) { ?>
                    <span style="color: #FF0000;"><?php echo $review['rating_avg']; ?></span>
                    <?php } elseif ($review['rating_avg'] <= 4) { ?>
                    <span style="color: #FFA500;"><?php echo $review['rating_avg']; ?></span>
                    <?php } else { ?>
                    <span style="color: #008000;"><?php echo $review['rating_avg']; ?></span>
                    <?php } ?></td>
                  <td class="left"><?php echo ($review['pros']) ? '<a href="' . $review['href_pros'] . '">' . $review['pros'] . '</a>' : 0; ?></td>
                  <td class="left"><?php echo ($review['cons']) ? '<a href="' . $review['href_cons'] . '">' . $review['cons'] . '</a>' : 0; ?></td>
                  <td class="left"><?php echo ($review['vote_yes']) ? $review['vote_yes'] . ' <a href="' . $review['href_vote_yes'] . '" class="button btn-xs btn-danger"><i class="fa fa-minus-circle"></i></a>' : 0; ?></td>
                  <td class="left"><?php echo ($review['vote_no']) ? $review['vote_no'] . ' <a href="' . $review['href_vote_no'] . '" class="button btn-xs btn-danger"><i class="fa fa-minus-circle"></i></a>' : 0; ?></td>
                  <td class="left"><?php echo $review['date_added']; ?></td>
                  <td class="left"><?php echo $review['store']; ?></td>
                  <td class="left"><select name="status[<?php echo $review['review_id']; ?>]" class="form-control">
                    <?php if ($review['status']) { ?>
                    <option value="1" selected><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected><?php echo $text_disabled; ?></option>
                    <?php } ?>
                    </select></td>
                  <td class="text-right"><a href="<?php echo $review['view']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a> <a href="<?php echo $review['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="13"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=product_review/review&token=<?php echo $token; ?>';

	var filter_product = $('input[name=\'filter_product\']').val();

	if (filter_product) {
		url += '&filter_product=' + encodeURIComponent(filter_product);
	}

	var filter_author = $('input[name=\'filter_author\']').val();

	if (filter_author) {
		url += '&filter_author=' + encodeURIComponent(filter_author);
	}

	var filter_average = $('select[name=\'filter_average\']').val();

	if (filter_average != '*') {
		url += '&filter_average=' + encodeURIComponent(filter_average); 
	}

	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status); 
	}

	var filter_store = $('select[name=\'filter_store\']').val();

	if (filter_store != '*') {
		url += '&filter_store=' + encodeURIComponent(filter_store); 
	}

	var filter_date_added = $('input[name=\'filter_date_added\']').val();

	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}

	location = url;
});

$('a#button-delete-image').on('click', function() {
	if (!confirm('<?php echo $text_delete; ?>')) {
		return false;
	}

	var box = $(this).parent('div');
	var copy = box.html();
	var review_image_id = $(this).attr('data-image-id');

	$.ajax({
		url: 'index.php?route=product_review/review/deleteimage&token=<?php echo $token; ?>',
		type: 'post',
		dataType: 'json',
		data: 'review_image_id=' + encodeURIComponent(review_image_id),
		beforeSend: function() {
			box.html('<i class="fa fa-spin fa-spinner"></i>');
		},
		complete: function() {

		},
		success: function(data) {
			if (data['error']) {
				alert(data['error']);

				box.html(copy);
			}

			if (data['success']) {
				box.remove();
			}
		}
	});
});

$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<?php echo $footer; ?>