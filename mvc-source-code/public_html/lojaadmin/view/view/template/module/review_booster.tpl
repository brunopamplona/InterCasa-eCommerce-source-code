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
				<button type="submit" form="form-setting" id="button-save" class="btn btn-primary"><?php echo $button_save; ?></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
		<div class="panel panel-default panel-nav-tabs">
			<div class="panel-heading">
				<div class="pull-right">
					<select onChange="location.href = this.value">
						<?php foreach ($stores as $store) { ?>
						<?php if ($store['store_id'] == $filter_store_id) { ?>
						<option value="<?php echo $store['filter']; ?>" selected="selected"><?php echo $store['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $store['filter']; ?>"><?php echo $store['name']; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
				<ul class="nav nav-tabs" id="general-tabs">
					<li class="active"><a href="#tab-setting" data-toggle="tab"><?php echo $tab_setting; ?></a></li>
					<li><a href="#tab-support" data-toggle="tab">Support</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-setting" class="form-horizontal">
					<div class="tab-content">
						<div class="tab-pane active in" id="tab-setting">
							<div class="setting-name"><?php echo $caption_general; ?></div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_module_status; ?></label>
								<div class="col-sm-10">
									<select name="<?php echo $module_name; ?>[status]" class="form-control">
										<?php if ($status == 1) { ?>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										<?php } ?>
									</select>
									<div class="help-block">
										<div class="alert alert-info">The following line should be added to the CRON, if you want automatically send notification. <a href="http://www.youtube.com/watch?v=ibcE3BrUKpw" target="_blank">How to set cron job in directadmin</a>?<br /><b>wget -q "<?php echo $cron; ?>"</b><br /><br />If you have a problem to set the cron job on your own server, please use setcronjob.com or easycron.com and use following the url.<br /><b><?php echo $cron; ?></b></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_to; ?></label>
								<div class="col-sm-10">
									<select name="<?php echo $module_name; ?>[to]" class="form-control">
										<?php if ($to == 'customer') { ?>
										<option value="customer" selected="selected"><?php echo $text_to_1; ?></option>
										<option value="guest"><?php echo $text_to_2; ?></option>
										<option value="all"><?php echo $text_to_3; ?></option>
										<?php } elseif ($to == 'guest') { ?>
										<option value="customer"><?php echo $text_to_1; ?></option>
										<option value="guest" selected="selected"><?php echo $text_to_2; ?></option>
										<option value="all"><?php echo $text_to_3; ?></option>
										<?php } else { ?>
										<option value="customer"><?php echo $text_to_1; ?></option>
										<option value="guest"><?php echo $text_to_2; ?></option>
										<option value="all" selected="selected"><?php echo $text_to_3; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label s_help"><?php echo $entry_order_status; ?><i><?php echo $help_order_status; ?></i></label>
								<div class="col-sm-10">
									<div class="well well-sm" style="height: 150px; overflow: auto;">
										<?php foreach ($order_statuses as $order_status_1) { ?>
										<div class="checkbox">
											<label>
												<?php if (in_array($order_status_1['order_status_id'], $order_status)) { ?>
												<input type="checkbox" name="<?php echo $module_name; ?>[order_status][]" value="<?php echo $order_status_1['order_status_id']; ?>" checked="checked" />
												<?php echo $order_status_1['name']; ?>
												<?php } else { ?>
												<input type="checkbox" name="<?php echo $module_name; ?>[order_status][]" value="<?php echo $order_status_1['order_status_id']; ?>" />
												<?php echo $order_status_1['name']; ?>
												<?php } ?>
											</label>
										</div>
										<?php } ?>
									</div>
									<?php if (isset($error['order_status'])) { ?>
									<div class="text-danger"><?php echo $error['order_status']; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label s_help"><?php echo $entry_new_order_status; ?><i><?php echo $help_new_order_status; ?></i></label>
								<div class="col-sm-10">
									<select name="<?php echo $module_name; ?>[new_order_status]" class="form-control">
										<option value="0"><?php echo $text_no_change; ?></option>
										<?php foreach ($order_statuses as $order_status_1) { ?>
										<?php if ($order_status_1['order_status_id'] == $new_order_status) { ?>
										<option value="<?php echo $order_status_1['order_status_id']; ?>" selected="selected"><?php echo $order_status_1['name']; ?></option>
										<?php } else { ?>
										<option value="<?php echo $order_status_1['order_status_id']; ?>"><?php echo $order_status_1['name']; ?></option>
										<?php } ?>
										<?php } ?>
									</select>
									<div class="checkbox">
										<label>
											<?php if ($notify) { ?>
											<input type="checkbox" name="<?php echo $module_name; ?>[notify]" value="1" checked />
											<?php echo $entry_notify; ?>
											<?php } else { ?>
											<input type="checkbox" name="<?php echo $module_name; ?>[notify]" value="1" />
											<?php echo $entry_notify; ?>
											<?php } ?>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label s_help"><?php echo $entry_exclude_customer_group; ?><i><?php echo $help_exclude_customer_group; ?></i></label>
								<div class="col-sm-10">
									<div class="well well-sm" style="height: 150px; overflow: auto;">
										<?php foreach ($customer_groups as $customer_group_1) { ?>
										<div class="checkbox">
											<label>
												<?php if (in_array($customer_group_1['customer_group_id'], $exclude_customer_group)) { ?>
												<input type="checkbox" name="<?php echo $module_name; ?>[exclude_customer_group][]" value="<?php echo $customer_group_1['customer_group_id']; ?>" checked="checked" />
												<?php echo $customer_group_1['name']; ?>
												<?php } else { ?>
												<input type="checkbox" name="<?php echo $module_name; ?>[exclude_customer_group][]" value="<?php echo $customer_group_1['customer_group_id']; ?>" />
												<?php echo $customer_group_1['name']; ?>
												<?php } ?>
											</label>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_approve_review_status; ?></label>
								<div class="col-sm-5">
									<select name="<?php echo $module_name; ?>[approve_review_status]" class="form-control">
										<?php if ($approve_review_status == 1) { ?>
										<option value="1" selected="selected"><?php echo $text_yes; ?></option>
										<option value="0"><?php echo $text_no; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_yes; ?></option>
										<option value="0" selected="selected"><?php echo $text_no; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-5">
									<div class="input-group">
										<span class="input-group-addon"><?php echo $entry_approve_review_rating; ?></span>
										<select name="<?php echo $module_name; ?>[approve_review_rating]" class="form-control">
											<?php foreach ($ratings as $value) { ?>
											<?php if ($approve_review_rating == $value) { ?>
											<option value="<?php echo $value; ?>" selected="selected"><?php echo $value; ?></option>
											<?php } else { ?>
											<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
											<?php } ?>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label s_help"><?php echo $entry_day; ?><i><?php echo $help_day; ?></i></label>
								<div class="col-sm-4">
									<div class="input-group">
										<input type="text" name="<?php echo $module_name; ?>[day]" value="<?php echo $day; ?>" placeholder="<?php echo $entry_day; ?>" class="form-control" />
										<span class="input-group-addon"><?php echo $text_day; ?></span>
									</div>
									<?php if (isset($error['day'])) { ?>
									<div class="text-danger"><?php echo $error['day']; ?></div>
									<?php } ?>
								</div>
								<label class="col-sm-2 control-label s_help"><?php echo $entry_previous; ?><i><?php echo $help_previous; ?></i></label>
								<div class="col-sm-4">
									<select name="<?php echo $module_name; ?>[previous]" class="form-control">
										<?php if ($previous == 1) { ?>
										<option value="1" selected="selected"><?php echo $text_yes; ?></option>
										<option value="0"><?php echo $text_no; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_yes; ?></option>
										<option value="0" selected="selected"><?php echo $text_no; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label s_help"><?php echo $entry_coupon_status; ?><i><?php echo $help_coupon_status; ?></i></label>
								<div class="col-sm-10">
									<div class="row">
										<div class="col-sm-6 col-md-4">
											<div class="form-group">
												<div class="col-sm-12">
													<select name="<?php echo $module_name; ?>[coupon_status]" class="form-control">
														<option value="0"><?php echo $text_disabled; ?></option>
														<?php if ($coupon_status == 'percentage') { ?>
														<option value="percentage" selected="selected"><?php echo $text_percentage; ?></option>
														<?php } else { ?>
														<option value="percentage"><?php echo $text_percentage; ?></option>
														<?php } ?>
														<?php if ($coupon_status == 'fixed') { ?>
														<option value="fixed" selected="selected"><?php echo $text_fixed; ?></option>
														<?php } else { ?>
														<option value="fixed"><?php echo $text_fixed; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-md-4">
											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon"><?php echo $entry_coupon_value; ?></span>
														<input type="text" name="<?php echo $module_name; ?>[coupon_discount]" value="<?php echo $coupon_discount; ?>" placeholder="<?php echo $entry_coupon_value; ?>" class="form-control" />
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-md-4">
											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon"><?php echo $entry_coupon_validity; ?></span>
														<input type="text" name="<?php echo $module_name; ?>[coupon_validity]" value="<?php echo $coupon_validity; ?>" placeholder="<?php echo $entry_coupon_validity; ?>" class="form-control" />
														<span class="input-group-addon"><?php echo $text_day; ?></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="setting-name"><?php echo $caption_appearance; ?></div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_type; ?></label>
								<div class="col-sm-10">
									<select name="<?php echo $module_name; ?>[type]" class="form-control">
										<?php if ($type == 'order') { ?>
										<option value="order" selected="selected"><?php echo $text_type_1; ?></option>
										<option value="product"><?php echo $text_type_2; ?></option>
										<option value="product_single"><?php echo $text_type_3; ?></option>
										<?php } elseif ($type == 'product') { ?>
										<option value="order"><?php echo $text_type_1; ?></option>
										<option value="product" selected="selected"><?php echo $text_type_2; ?></option>
										<option value="product_single"><?php echo $text_type_3; ?></option>
										<?php } else { ?>
										<option value="order"><?php echo $text_type_1; ?></option>
										<option value="product"><?php echo $text_type_2; ?></option>
										<option value="product_single" selected="selected"><?php echo $text_type_3; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_star; ?></label>
								<div class="col-sm-6">
									<select name="<?php echo $module_name; ?>[star]" class="form-control">
										<?php foreach ($colors as $key => $value) { ?>
										<?php if ($star == $key) { ?>
										<option value="<?php echo $key; ?>" selected="selected"><?php echo $value['name']; ?></option>
										<?php } else { ?>
										<option value="<?php echo $key; ?>"><?php echo $value['name']; ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-4">
									<div class="input-group">
										<span class="input-group-addon"><?php echo $entry_star_custom; ?></span>
										<span class="input-group-addon">#</span>
										<input type="text" name="<?php echo $module_name; ?>[star_custom]" value="<?php echo $star_custom; ?>" placeholder="<?php echo $entry_star_custom; ?>" class="form-control" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_product_image_status; ?></label>
								<div class="col-sm-10">
									<div class="row">
										<div class="col-sm-6 col-md-4">
											<div class="form-group">
												<div class="col-sm-12">
													<select name="<?php echo $module_name; ?>[product_image_status]" class="form-control">
														<?php if ($product_image_status == 1) { ?>
														<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
														<option value="0"><?php echo $text_disabled; ?></option>
														<?php } else { ?>
														<option value="1"><?php echo $text_enabled; ?></option>
														<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-md-4">
											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
														<input type="text" name="<?php echo $module_name; ?>[product_image_width]" value="<?php echo $product_image_width; ?>" placeholder="<?php echo $text_width; ?>" class="form-control" />
														<span class="input-group-addon">px</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-md-4">
											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
														<input type="text" name="<?php echo $module_name; ?>[product_image_height]" value="<?php echo $product_image_height; ?>" placeholder="<?php echo $text_height; ?>" class="form-control" />
														<span class="input-group-addon">px</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label s_help"><?php echo $entry_product_limit; ?><i><?php echo $help_product_limit; ?></i></label>
								<div class="col-sm-10">
									<input type="text" name="<?php echo $module_name; ?>[product_limit]" value="<?php echo $product_limit; ?>" placeholder="<?php echo $entry_product_limit; ?>" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label s_help"><?php echo $entry_verified_buyer_status; ?><i><?php echo $help_verified_buyer_status; ?></i></label>
								<div class="col-sm-10">
									<div class="row">
										<div class="col-sm-6 col-md-6">
											<div class="form-group">
												<div class="col-sm-12">
													<select name="<?php echo $module_name; ?>[verified_buyer_status]" class="form-control">
														<?php if ($verified_buyer_status == 1) { ?>
														<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
														<option value="0"><?php echo $text_disabled; ?></option>
														<?php } else { ?>
														<option value="1"><?php echo $text_enabled; ?></option>
														<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-md-6">
											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group language-dropdown">
														<span class="input-group-addon"></span>
														<?php foreach ($languages as $language) { ?>
														<input type="text" name="<?php echo $module_name; ?>[verified_buyer_text][<?php echo $language['language_id']; ?>]" value="<?php echo is_array($verified_buyer_text) ? (isset($verified_buyer_text[$language['language_id']]) ? $verified_buyer_text[$language['language_id']] : '') : $verified_buyer_text; ?>" data-language="<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_verified_buyer_text; ?>" class="form-control" />
														<?php } ?>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
															<ul class="dropdown-menu dropdown-menu-right">
																<?php foreach ($languages as $language) { ?>
																<li><a data-language="<?php echo $language['language_id']; ?>" data-image="<?php echo $language['image']; ?>"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
																<?php } ?>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label s_help"><?php echo $entry_manually_status; ?><i><?php echo $help_manually_status; ?></i></label>
								<div class="col-sm-10">
									<select name="<?php echo $module_name; ?>[manually_status]" class="form-control">
										<?php if ($manually_status == 1) { ?>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_field; ?></label>
								<div class="col-sm-10">
									<div class="row">
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon"><?php echo $entry_field_gdpr; ?></span>
														<select name="<?php echo $module_name; ?>[gdpr_status]" class="form-control">
															<?php if ($gdpr_status == 1) { ?>
															<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
															<option value="0"><?php echo $text_disabled; ?></option>
															<?php } else { ?>
															<option value="1"><?php echo $text_enabled; ?></option>
															<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<div class="col-sm-12">
													<select name="<?php echo $module_name; ?>[gdpr_information_id]" class="form-control">
														<?php foreach ($informations as $information) { ?>
														<?php if ($gdpr_information_id == $information['information_id']) { ?>
														<option value="<?php echo $information['information_id']; ?>" selected="selected"><?php echo $information['title']; ?></option>
														<?php } else { ?>
														<option value="<?php echo $information['information_id']; ?>"><?php echo $information['title']; ?></option>
														<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon"><?php echo $entry_field_noticed; ?></span>
														<select name="<?php echo $module_name; ?>[noticed_status]" class="form-control">
															<?php if ($noticed_status == 1) { ?>
															<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
															<option value="0"><?php echo $text_disabled; ?></option>
															<?php } else { ?>
															<option value="1"><?php echo $text_enabled; ?></option>
															<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<input type="text" name="noticed" class="form-control" placeholder="<?php echo $entry_noticed; ?>" />
														<span class="input-group-btn">
															<button class="btn btn-primary" onclick="addNoticed();" type="button"><i class="fa fa-plus"></i></button>
														</span>
													</div>
													<div id="noticed" style="margin-top: 4px;">
														<?php foreach ($notice as $value) { ?>
														<div class="input-group">
															<input type="text" name="<?php echo $module_name; ?>[notice][]" class="form-control" value="<?php echo $value; ?>" placeholder="<?php echo $entry_noticed; ?>" />
															<span class="input-group-btn">
																<button class="btn btn-danger" onclick="$(this).parents('div.input-group').remove();" type="button"><i class="fa fa-minus"></i></button>
															</span>
														</div>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="setting-name"><?php echo $caption_integration; ?></div>
							<div class="form-group">
								<label class="col-sm-2 control-label s_help"><?php echo $entry_apr_status; ?><i><?php echo $help_apr_status; ?></i></label>
								<div class="col-sm-10">
									<select name="<?php echo $module_name; ?>[apr_status]" class="form-control">
										<?php if ($apr_status == 1) { ?>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label s_help"><?php echo $entry_apr_image_status; ?><i><?php echo $help_apr_image_status; ?></i></label>
								<div class="col-sm-10">
									<select name="<?php echo $module_name; ?>[apr_image_status]" class="form-control">
										<?php if ($apr_image_status == 1) { ?>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="setting-name"><?php echo $caption_template; ?></div>
							<div class="form-group">
								<div class="col-sm-12">
									<ul class="nav nav-tabs" id="language">
										<?php foreach ($languages as $language) { ?>
										<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></a></li>
										<?php } ?>
									</ul>
									<div class="tab-content">
										<?php foreach ($languages as $language) { ?>
										<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
											<div class="form-group">
												<label class="col-sm-2 control-label s_help"><?php echo $entry_link_text; ?><i><?php echo $help_link_text; ?></i></label>
												<div class="col-sm-10">
													<input type="text" name="<?php echo $module_name; ?>[link_text][<?php echo $language['language_id']; ?>]" value="<?php echo (!is_array($link_text)) ? $link_text : (isset($link_text[$language['language_id']]) ? $link_text[$language['language_id']] : ''); ?>" placeholder="<?php echo $entry_link_text; ?>" class="form-control" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label"><?php echo $entry_mail; ?></label>
												<div class="col-sm-10">
													<div class="form-group">
														<div class="col-sm-12">
															<input type="text" name="<?php echo $module_name; ?>[email][<?php echo $language['language_id']; ?>][subject]" value="<?php echo (isset($email[$language['language_id']]['subject'])) ? $email[$language['language_id']]['subject'] : ((isset($email['subject']) && !is_array($email['subject'])) ? $email['subject'] : ''); ?>" placeholder="<?php echo $text_subject; ?>" class="form-control" />
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-12">
															<textarea name="<?php echo $module_name; ?>[email][<?php echo $language['language_id']; ?>][description]" id="input-description<?php echo $language['language_id']; ?>" data-toggle="summernote" class="form-control summernote"><?php echo isset($email[$language['language_id']]['description']) ? $email[$language['language_id']]['description'] : ((isset($email['description']) && !is_array($email['description'])) ? $email['description'] : ''); ?></textarea>
															<div class="help-block"><button type="button" data-toggle="modal" data-target="#shortcodeModal" class="btn btn-warning"><i class="fa fa-list"></i> Shortcodes</button> <button type="button" data-toggle="modal" data-target="#testModal" class="btn btn-default"><i class="fa fa-envelope"></i> Test Message</button></div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-support">
							<div class="row">
								<div class="col-sm-8 col-md-8">
									<div class="row">
										<div class="col-sm-8">
											<h4><b>You need help?</b></h4>
											<p>If you have any questions, idea or need help please feel free to contact us via ticket system</p>
										</div>
										<div class="col-sm-4 text-right">
											<a onclick="window.open('https://www.adikon.eu/login')" class="btn btn-warning btn-lg">Submit Ticket</a>
										</div>
									</div>
									<hr />
									<div class="row">
										<div class="col-sm-8">
											<h4><b>Need something customized?</b></h4>
											<p>Custom services, installations, custom theme integrations & updates and resolving conflicts with other third party extensions</p>
										</div>
										<div class="col-sm-4 text-right">
											<a onclick="window.open('http://www.adikon.eu/contact')" class="btn btn-info btn-lg">Get a Quote</a>
										</div>
									</div>
								</div>
								<div class="col-sm-4 col-md-4">
									<div class="panel-default">
										<div class="panel-body">
											<p><a onclick="window.open('http://www.adikon.eu')" class="btn-link">Official Website</a></p>
											<p><a onclick="window.open('http://www.opencart.com/index.php?route=marketplace/extension&filter_member=adikon')" class="btn-link">Our Modules</a></p>
											<p><a onclick="window.open('http://www.adikon.eu/support-i8/review-booster-order-reviews-i25')" class="btn-link">Documentation</a></p>
										</div>
									</div>
								</div>
							</div>
							<script type="text/javascript">
							var mod_id = '1187';
							var domain = '<?php echo $bGljZW5zZV9kb21haW4; ?>';
							</script>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-sm-12 text-center">
			<br />Adikon.eu, All Rights Reserved.
		</div>
		<div id="shortcodeModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Shortcode List</h4>
					</div>
					<div class="modal-body">
						<table class="table table-bordered table-hover">
							<tbody>
								<tr>
									<td><b>{order_id}</b><br />unique order ID</td>
									<td><b>{date_order}</b><br />date of order creation</td>
								</tr>
								<tr>
									<td><b>{firstname}</b><br />first name</td>
									<td><b>{lastname}</b><br />last name</td>
								</tr>
								<tr>
									<td><b>{email}</b><br />customer email</td>
									<td><b>{list}</b><br />list of ordered products</td>
								</tr>
								<tr>
									<td><b>{form}</b><br />review form</td>
									<td><b>{link}</b><br />link to review form on the website</td>
								</tr>
								<tr>
									<td><b>{store_name}</b><br />store name</td>
									<td><b>{unsubscribe}</b><br />link to unsubscribe</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn btn-link" data-dismiss="modal"><?php echo $button_close; ?></button>
					</div>
				</div>
			</div>
		</div>
		<div id="testModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Send a test message</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Enter your email address (save settings before sending)</label>
									<input type="text" name="test" value="" placeholder="" class="form-control" />
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn btn-link" data-dismiss="modal"><?php echo $button_close; ?></button>
						<button type="button" onClick="sendEmailTest();" class="btn btn-primary"><?php echo $button_send; ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php if (version_compare(VERSION, '3', '>=')) { ?>
<link href="view/javascript/codemirror/lib/codemirror.css" rel="stylesheet" />
<link href="view/javascript/codemirror/theme/monokai.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/codemirror/lib/codemirror.js"></script>
<script type="text/javascript" src="view/javascript/codemirror/lib/xml.js"></script>
<script type="text/javascript" src="view/javascript/codemirror/lib/formatting.js"></script>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/summernote-image-attributes.js"></script>
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<?php } elseif (version_compare(VERSION, '2.3', '>=')) { ?>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<?php } elseif (version_compare(VERSION, '2', '<')) { ?>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="view/javascript/ckeditor/adapters/jquery.js"></script>
<?php } ?>
<script type="text/javascript"><!--
$('textarea.summernote').each(function() {
	<?php if (version_compare(VERSION, '2', '<')) { ?>
	var instance = $(this).attr('id');

	CKEDITOR.replace(instance, {
		filebrowserBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
		filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
		filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
		filebrowserUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
		filebrowserImageUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
		filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
		height: 500
	});
	<?php } elseif (version_compare(VERSION, '2.3', '<')) { ?>
	$(this).summernote({height: 550});
	<?php } ?>
});
//--></script>
<script type="text/javascript"><!--
$('.language-dropdown .dropdown-menu a').on('click', function(e) {
	e.preventDefault();

	$(this).parent().parent().find('li').removeClass('active');
	$(this).parent().addClass('active');

	var element = $(this).parents('.language-dropdown');

	element.find('span:first').html('<img src="' + $(this).data('image') + '" title="" />');
	element.find('input').hide();
	element.find('input[data-language="' + $(this).data('language') + '"]').css('display', 'table-cell');
});

$('.language-dropdown').each(function(index) {
	$(this).find('.dropdown-menu a:first').trigger('click');
});
//--></script>
<script type="text/javascript"><!--
function sendEmailTest(store_id) {
	email = $('input[name="test"]').val().trim();

	if (email.length > 0) {
		$.ajax({
			url: '<?php echo $cron; ?>&test=1&email=' + encodeURIComponent(email),
			dataType: 'text',
			success: function(data) {
				alert(data);
			}
		});
	}

	return false;
}

function addNoticed() {
	noticed = $('input[name="noticed"]').val().replace(/(<([^>]+)>)/ig, "").trim();

	if (noticed == '') {
		return;
	}

	$('#noticed').append('<div class="input-group"><input type="text" name="<?php echo $module_name; ?>[notice][]" class="form-control" value="' + noticed + '" placeholder="<?php echo $entry_noticed; ?>" /><span class="input-group-btn"><button class="btn btn-danger" onclick="$(this).parents(\'div.input-group\').remove();" type="button"><i class="fa fa-minus"></i></button></span></div>');

	$('input[name="noticed"]').val('');
}
//--></script>
<script type="text/javascript"><!--
<?php if ($filter_tab_show) { ?>
$('#general-tabs a[href="#tab-<?php echo $filter_tab_show; ?>"]').tab('show');
<?php } ?>

$('#language a:first').tab('show');

$('#button-save').on('click', function(e) {
	$('#form-setting').submit();
});
//--></script>
</div>
<?php echo $footer; ?>