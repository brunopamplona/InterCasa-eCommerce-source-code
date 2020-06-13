<?php echo str_replace(array('view/javascript/jquery/jquery-1.6.1.min.js', 'view/javascript/jquery/jquery-1.7.1.min.js', 'http://code.jquery.com/jquery-1.7.2.min.js'), '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', $header); ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a> <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-attribute').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
		    <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              </div>
            </div>
			<div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-review"><?php echo $entry_review; ?></label>
                <input type="text" name="filter_review_id" value="<?php echo $filter_review_id; ?>" placeholder="<?php echo $entry_review; ?>" id="input-review" class="form-control" />
              </div>
            </div>
			<div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-type"><?php echo $entry_type; ?></label>
                <select name="filter_type" id="input-type" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_type) { ?>
                  <option value="1" selected="selected"><?php echo $text_pros; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_pros; ?></option>
                  <?php } ?>
                  <?php if (!$filter_type && !is_null($filter_type)) { ?>
                  <option value="0" selected="selected"><?php echo $text_cons; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_cons; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
		  </div>
		  <div class="row">
		    <div class="col-sm-4">
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
            </div>
			<div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-author"><?php echo $entry_author; ?></label>
                <input type="text" name="filter_author" value="<?php echo $filter_author; ?>" placeholder="<?php echo $entry_author; ?>" id="input-author" class="form-control" />
              </div>
            </div>
			<div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-added-by"><?php echo $entry_added_by; ?></label>
                <select name="filter_added_by" id="input-added-by" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_added_by == 'a') { ?>
                  <option value="a" selected="selected"><?php echo $text_added_admin; ?></option>
				  <option value="u"><?php echo $text_added_user; ?></option>
                  <?php } elseif ($filter_added_by == 'u') { ?>
				  <option value="a"><?php echo $text_added_admin; ?></option>
				  <option value="u" selected="selected"><?php echo $text_added_user; ?></option>
                  <?php } else { ?>
				  <option value="a"><?php echo $text_added_admin; ?></option>
				  <option value="u"><?php echo $text_added_user; ?></option>
				  <?php } ?>
                </select>
              </div>
            </div>
		  </div>
		  <div class="row">
		    <div class="col-sm-offset-8 col-sm-4">
			  <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
		  </div>
		</div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-attribute">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php if ($sort == 'a.name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'r.review_id') { ?>
                    <a href="<?php echo $sort_review; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_review; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_review; ?>"><?php echo $column_review; ?></a>
                    <?php } ?></td>
				  <td class="text-right" colspan="2"><?php if ($sort == 'a.type') { ?>
                    <a href="<?php echo $sort_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_type; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_type; ?>"><?php echo $column_type; ?></a>
                    <?php } ?></td>
				  <td class="text-right"><?php if ($sort == 'r.author') { ?>
                    <a href="<?php echo $sort_author; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_author; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_author; ?>"><?php echo $column_author; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'a.status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                    <?php } ?></td>
				  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($attributes) { ?>
				<?php foreach ($attributes as $attribute) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($attribute['attribute_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $attribute['attribute_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $attribute['attribute_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $attribute['name']; ?></td>
                  <td class="text-left"><a href="<?php echo $attribute['review_href']; ?>"><?php echo $attribute['review_id']; ?></a></td>
                  <td class="text-right"><?php echo $attribute['type']; ?></td>
				  <td class="text-right" width="20"><?php echo ($attribute['image']) ? '<i class="fa fa-thumbs-o-up text-success"></i>' : '<i class="fa fa-thumbs-o-down text-danger"></i>'; ?></td>
				  <td class="text-right"><?php echo $attribute['author']; ?></td>
                  <td class="text-right"><?php echo $attribute['status']; ?></td>
                  <td class="text-right"><a href="<?php echo $attribute['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="7"><?php echo $text_no_results; ?></td>
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
	url = 'index.php?route=product_review/attribute&token=<?php echo $token; ?>';

	var filter_name = $('input[name=\'filter_name\']').val();

	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_review_id = $('input[name=\'filter_review_id\']').val();

	if (filter_review_id) {
		url += '&filter_review_id=' + encodeURIComponent(filter_review_id);
	}

	var filter_type = $('select[name=\'filter_type\']').val();

	if (filter_type != '*') {
		url += '&filter_type=' + encodeURIComponent(filter_type);
	}

	var filter_author = $('input[name=\'filter_author\']').val();

	if (filter_author) {
		url += '&filter_author=' + encodeURIComponent(filter_author);
	}

	var filter_added_by = $('select[name=\'filter_added_by\']').val();

	if (filter_added_by != '*') {
		url += '&filter_added_by=' + encodeURIComponent(filter_added_by);
	}

	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}

	location = url;
});

$('input[name=\'filter_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=product_review/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['attribute_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});

$('input[name=\'filter_author\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=product_review/attribute/autocompleteauthor&token=<?php echo $token; ?>&filter_author=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['author'],
						value: item['attribute_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_author\']').val(item['label']);
	}
});
//--></script>
<?php echo $footer; ?>