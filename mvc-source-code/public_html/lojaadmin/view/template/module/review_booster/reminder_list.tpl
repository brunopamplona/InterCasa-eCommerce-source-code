<?php
/*
  Review Booster
  Premium Extension
  
  Copyright (c) 2013 - 2019 Adikon.eu
  http://www.adikon.eu/
  
  You may not copy or reuse code within this file without written permission.
*/
?>
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<?php if ($links) { ?>
			<div class="btn-group manage-link">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
				<ul class="dropdown-menu">
					<?php foreach ($links as $manage_link) { ?>
					<?php if ($manage_link['name']) { ?>
					<li><a href="<?php echo $manage_link['href']; ?>"><?php echo $manage_link['name']; ?></a></li>
					<?php } else { ?>
					<li class="divider"></li>
					<?php } ?>
					<?php } ?>
				</ul>
			</div>
			<?php } ?>
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
				<div class="btn-group pull-right">
					<button type="button" data-toggle="modal" data-target="#reminderFilterModal" class="btn btn-warning btn-sm"><span data-toggle="tooltip" title="<?php echo $button_filter; ?>"><i class="fa fa-search fa-fw"></i></span></button>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_reset; ?>" class="btn btn-default btn-sm" onclick="location = 'index.php?route=<?php echo $module_path; ?>/reminder&<?php echo $token; ?>';"><i class="fa fa-times fa-fw"></i></button>
				</div>
				<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-reminder" class="form-horizontal">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<td style="width: 1px;" class="text-center"><button type="button" form="form-reminder" formaction="<?php echo $delete; ?>" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-reminder').submit() : false;"><i class="fa fa-trash-o"></i></button></td>
									<td style="width: 20px;" class="text-center"><?php echo $column_id; ?></td>
									<td class="text-left"><?php echo $column_customer; ?></td>
									<td class="text-left"><?php echo $column_order_id; ?></td>
									<td class="text-left"><?php echo $column_product; ?></td>
									<td class="text-left"><?php echo $column_coupon; ?></td>
									<td class="text-left"><?php echo $column_gdpr; ?></td>
									<td class="text-left"><?php echo $column_review; ?></td>
									<td class="text-right"><?php echo $column_date_added; ?></td>
									<td class="text-right"></td>
								</tr>
							</thead>
							<tbody>
								<?php if ($reminders) { ?>
								<?php foreach ($reminders as $reminder) { ?>
								<tr data-reminder-id="<?php echo $reminder['email_id']; ?>">
									<td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $reminder['email_id']; ?>" /></td>
									<td class="text-center"><?php echo $reminder['email_id']; ?></td>
									<td class="text-left"><?php echo $reminder['customer']; ?><?php if ($reminder['test']) { ?>
										<i data-toggle="tooltip" title="<?php echo $text_test; ?>" class="fa fa-info-circle fa-fw text-danger" ></i>
									<?php } ?></td>
									<td class="text-left"><?php echo $reminder['order_id']; ?></td>
									<td class="text-left"><?php if ($reminder['product']) { ?><div style="max-width:380px;">
										<table class="table table-bordered" style="margin-bottom:0;">
											<tbody>
												<?php foreach ($reminder['product'] as $product) { ?>
												<tr>
													<td class="text-left"><?php echo $product['name']; ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div><?php } ?></td>
									<td class="text-left"><?php echo $reminder['coupon']; ?></td>
									<td class="text-left"><?php echo $reminder['gdpr']; ?></td>
									<td class="text-left"><?php echo $reminder['review']; ?></td>
									<td class="text-right"><?php echo $reminder['date_added']; ?></td>
									<td class="text-right"><a href="<?php echo $reminder['view']; ?>" target="_blank" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
									<td class="text-center" colspan="10"><?php echo $text_no_results; ?></td>
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
				<div class="modal fade" id="reminderFilterModal" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label"><?php echo $entry_email; ?></label>
											<input type="text" name="filter_email" value="<?php echo $filter_email; ?>" placeholder="<?php echo $entry_email; ?>" class="form-control" />
										</div>
										<div class="form-group">
											<label class="control-label"><?php echo $entry_order_id; ?></label>
											<input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" placeholder="<?php echo $entry_order_id; ?>" class="form-control" />
										</div>
										<div class="form-group">
											<label class="control-label"><?php echo $entry_coupon; ?></label>
											<input type="text" name="filter_coupon" value="<?php echo $filter_coupon; ?>" placeholder="<?php echo $entry_coupon; ?>" class="form-control" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label"><?php echo $entry_store; ?></label>
											<select name="filter_store_id" class="form-control">
												<option value="*"></option>
												<?php foreach ($stores as $store) { ?>
												<?php if ($store['store_id'] == $filter_store_id) { ?>
												<option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
												<?php } else { ?>
												<option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
												<?php } ?>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label"><?php echo $entry_date_review; ?></label>
											<div class="input-group date">
												<input type="text" name="filter_date_review" value="<?php echo $filter_date_review; ?>" placeholder="<?php echo $entry_date_review; ?>" data-date-format="YYYY-MM-DD" class="form-control" />
												<span class="input-group-btn">
													<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label"><?php echo $entry_date_added; ?></label>
											<div class="input-group date">
												<input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" class="form-control" />
												<span class="input-group-btn">
													<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn btn-link" data-dismiss="modal"><?php echo $button_close; ?></button>
								<button type="button" id="button-filter" class="btn btn-primary"><?php echo $button_filter; ?></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 text-center">
			<br />Adikon.eu, All Rights Reserved.
		</div>
	</div>
<script type="text/javascript"><!--
function getFilter(id) {
	filter_param = [];

	$(id + ' :input').each(function() {
		var $name = $(this).attr('name') + '';
		var $value = $(this).val();

		if ($name.indexOf('filter_') !== -1) {
			if (this.type == 'select-one') {
				if ($value != '*') {
					filter_param.push($name + '=' + encodeURIComponent($value));
				}
			} else if (this.type == 'checkbox' || this.type == 'radio') {
				if ($(this).is(':checked')) {
					filter_param.push($name + '=' + encodeURIComponent($value));
				}
			} else {
				if ($value) {
					filter_param.push($name + '=' + encodeURIComponent($value));
				}
			}
		}
	});

	return filter_param.join('&');
}

$('#button-filter').on('click', function() {
	filter = getFilter('#reminderFilterModal');

	location = 'index.php?route=<?php echo $module_path; ?>/reminder&<?php echo $token; ?>&' + filter;
});
//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
</div>
<?php echo $footer; ?>