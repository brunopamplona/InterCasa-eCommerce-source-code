<?php echo str_replace(array('view/javascript/jquery/jquery-1.6.1.min.js', 'view/javascript/jquery/jquery-1.7.1.min.js', 'http://code.jquery.com/jquery-1.7.2.min.js'), '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', $header); ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $reason; ?>" data-toggle="tooltip" title="<?php echo $button_reason; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a> <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-reason').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
                <label class="control-label" for="input-store"><?php echo $entry_store; ?></label>
                <select name="filter_store_id" id="input-store" class="form-control">
                  <option value="*"></option>
				  <?php foreach ($stores as $store) { ?>
				  <?php if ($store['store_id'] == $filter_store_id) { ?>
				  <option value="<?php echo $store['store_id']; ?>" selected><?php echo $store['name']; ?></option>
				  <?php } else { ?>
				  <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
				  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
			<div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-date-start"><?php echo $entry_date_start; ?></label>
                <div class="input-group date">
				  <input type="text" name="filter_date_added_start" value="<?php echo $filter_date_added_start; ?>" data-date-format="YYYY-MM-DD" placeholder="<?php echo $entry_date_start; ?>" id="input-date-start" class="form-control" />
				  <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
				</div>
              </div>
            </div>
			<div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-date-stop"><?php echo $entry_date_stop; ?></label>
                <div class="input-group date">
				  <input type="text" name="filter_date_added_stop" value="<?php echo $filter_date_added_stop; ?>" data-date-format="YYYY-MM-DD" placeholder="<?php echo $entry_date_stop; ?>" id="input-date-stop" class="form-control" />
				  <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
				</div>
              </div>
			  <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
		  </div>
		</div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-reason">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php echo $column_review; ?></td>
                  <td class="text-left"><?php echo $column_title; ?></td>
				  <td class="text-right"><?php if ($sort == 'ar.store_id') { ?>
                    <a href="<?php echo $sort_store_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_store; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_store_id; ?>"><?php echo $column_store; ?></a>
                    <?php } ?></td>
				  <td class="text-right"><?php if ($sort == 'ar.reported') { ?>
                    <a href="<?php echo $sort_reported; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_reported; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_reported; ?>"><?php echo $column_reported; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'ar.date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                    <?php } ?></td>
				  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($reports) { ?>
				<?php foreach ($reports as $report) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($report['report_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $report['report_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $report['report_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $report['review']; ?></td>
                  <td class="text-left"><?php echo $report['title']; ?></td>
                  <td class="text-right"><?php echo $stores[$report['store']]['name']; ?></td>
				  <td class="text-right" width="20"><?php echo $report['reported']; ?></td>
				  <td class="text-right"><?php echo $report['date_added']; ?></td>
                  <td class="text-right"><a href="<?php echo $report['delete']; ?>" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a> <a href="<?php echo $report['delete_review']; ?>" data-toggle="tooltip" title="<?php echo $button_delete_review; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td>
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
	url = 'index.php?route=product_review/report&token=<?php echo $token; ?>';

	var filter_store_id = $('select[name=\'filter_store_id\']').val();
	
	if (filter_store_id != '*') {
		url += '&filter_store_id=' + encodeURIComponent(filter_store_id);
	}

	var filter_date_added_start = $('input[name=\'filter_date_added_start\']').val();

	if (filter_date_added_start) {
		url += '&filter_date_added_start=' + encodeURIComponent(filter_date_added_start);
	}

	var filter_date_added_stop = $('input[name=\'filter_date_added_stop\']').val();

	if (filter_date_added_stop) {
		url += '&filter_date_added_stop=' + encodeURIComponent(filter_date_added_stop);
	}

	location = url;
});

<?php if (version_compare(VERSION, '2.0') < 0) { ?>
$(document).ready(function() {
	$('#input-date-start').datepicker({dateFormat: 'yy-mm-dd'});
	$('#input-date-stop').datepicker({dateFormat: 'yy-mm-dd'});
});
<?php } else { ?>
$('.date').datetimepicker({
	pickTime: false
});
<?php } ?>
//--></script>
<?php echo $footer; ?>