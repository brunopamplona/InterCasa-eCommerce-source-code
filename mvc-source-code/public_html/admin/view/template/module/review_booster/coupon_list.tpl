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
			<div class="pull-right">
				<a href="<?php echo $expire; ?>" class="btn btn-default"><i class="fa fa-trash"></i> <?php echo $button_expire; ?></a>
			</div>
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
					<button type="button" data-toggle="modal" data-target="#couponFilterModal" class="btn btn-warning btn-sm"><span data-toggle="tooltip" title="<?php echo $button_filter; ?>"><i class="fa fa-search fa-fw"></i></span></button>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_reset; ?>" class="btn btn-default btn-sm" onclick="location = 'index.php?route=<?php echo $module_path; ?>/coupon&<?php echo $token; ?>';"><i class="fa fa-times fa-fw"></i></button>
				</div>
				<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-coupon" class="form-horizontal">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<td style="width: 1px;" class="text-center"><button type="button" form="form-coupon" formaction="<?php echo $delete; ?>" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-coupon').submit() : false;"><i class="fa fa-trash-o"></i></button></td>
									<td style="width: 20px;" class="text-center"><?php echo $column_id; ?></td>
									<td class="text-left"><?php echo $column_name; ?></td>
									<td class="text-left"><?php echo $column_code; ?></td>
									<td class="text-left"><?php echo $column_discount; ?></td>
									<td class="text-left"><?php echo $column_date_start; ?></td>
									<td class="text-left"><?php echo $column_date_end; ?></td>
									<td class="text-left"><?php echo $column_used; ?></td>
									<td class="text-right"><?php echo $column_date_added; ?></td>
									<td class="text-left"><?php echo $column_status; ?></td>
								</tr>
							</thead>
							<tbody>
								<?php if ($coupons) { ?>
								<?php foreach ($coupons as $coupon) { ?>
								<tr data-coupon-id="<?php echo $coupon['coupon_id']; ?>">
									<td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $coupon['coupon_id']; ?>" /></td>
									<td class="text-center"><?php echo $coupon['coupon_id']; ?></td>
									<td class="text-left"><?php echo $coupon['name']; ?></td>
									<td class="text-left"><?php echo $coupon['code']; ?></td>
									<td class="text-left"><?php echo $coupon['discount']; ?></td>
									<td class="text-left"><?php echo $coupon['date_start']; ?></td>
									<td class="text-left"><?php echo $coupon['date_end']; ?></td>
									<td class="text-left"><?php echo $coupon['used']; ?></td>
									<td class="text-right"><?php echo $coupon['date_added']; ?></td>
									<td class="text-left"><?php echo $coupon['status']; ?></td>
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
				<div class="modal fade" id="couponFilterModal" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label"><?php echo $entry_name; ?></label>
											<input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" class="form-control" />
										</div>
										<div class="form-group">
											<label class="control-label"><?php echo $entry_code; ?></label>
											<input type="text" name="filter_code" value="<?php echo $filter_code; ?>" placeholder="<?php echo $entry_code; ?>" class="form-control" />
										</div>
										<div class="form-group">
											<label class="control-label"><?php echo $entry_used; ?></label>
											<select name="filter_used" class="form-control">
												<option value="*"></option>
												<?php if ($filter_used == '1') { ?>
												<option value="1" selected="selected"><?php echo $text_yes; ?></option>
												<?php } else { ?>
												<option value="1"><?php echo $text_yes; ?></option>
												<?php } ?>
												<?php if ($filter_used == '0') { ?>
												<option value="0" selected="selected"><?php echo $text_no; ?></option>
												<?php } else { ?>
												<option value="0"><?php echo $text_no; ?></option>
												<?php } ?>
											</select>
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
											<label class="control-label"><?php echo $entry_status; ?></label>
											<select name="filter_status" class="form-control">
												<option value="*"></option>
												<?php if ($filter_status == '1') { ?>
												<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
												<?php } else { ?>
												<option value="1"><?php echo $text_enabled; ?></option>
												<?php } ?>
												<?php if ($filter_status == '0') { ?>
												<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
												<?php } else { ?>
												<option value="0"><?php echo $text_disabled; ?></option>
												<?php } ?>
											</select>
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
	filter = getFilter('#couponFilterModal');

	location = 'index.php?route=<?php echo $module_path; ?>/coupon&<?php echo $token; ?>&' + filter;
});
//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
</div>
<?php echo $footer; ?>