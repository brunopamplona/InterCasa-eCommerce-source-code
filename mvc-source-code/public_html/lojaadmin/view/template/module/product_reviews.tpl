<?php echo str_replace(array('view/javascript/jquery/jquery-1.6.1.min.js', 'view/javascript/jquery/jquery-1.7.1.min.js', 'http://code.jquery.com/jquery-1.7.2.min.js'), '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', $header); ?>
<?php echo $column_left; ?>
<?php $bGljZW5zZV9kZXRhaWw = json_decode(base64_decode($license), true); ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-product-reviews" data-toggle="tooltip" title="<?php echo $button_save; ?>" id="button-save" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
	<?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<?php if (!isset($bGljZW5zZV9kZXRhaWw['status']) || !$bGljZW5zZV9kZXRhaWw['status']) { ?>
	<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Module does not have a license key, <a onClick="$('a[href=\'#tab-support\']').click();">activate it</a> to have access to free update and support system.
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
	<?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
		<div class="pull-right"><select onChange="location.href = this.value">
	    <?php foreach ($stores as $store) { ?>
		<?php if ($store['store_id'] == $filter_store_id) { ?>
		<option value="<?php echo $store['href']; ?>" selected="selected"><?php echo $store['name']; ?></option>
		<?php } else { ?>
		<option value="<?php echo $store['href']; ?>"><?php echo $store['name']; ?></option>
		<?php } ?>
		<?php } ?>
	    </select></div>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-product-reviews" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-css" data-toggle="tab"><?php echo $tab_css; ?></a></li>
            <li><a href="#tab-support" data-toggle="tab">Support</a></li>
          </ul>
		  <div class="tab-content">
		    <div class="tab-pane active in" id="tab-general">
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-module-status"><?php echo $entry_module_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[status]" id="input-module-status" class="form-control">
                    <?php if ($status == 1) { ?>
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
                <label class="col-sm-2 control-label s_help" for="input-notify-status"><?php echo $entry_notify_status; ?><b><?php echo $help_notify_status; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[notify_status]" id="input-notify-status" class="form-control">
                    <?php if ($notify_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-notify-email"><?php echo $entry_notify_email; ?></label>
                <div class="col-sm-4">
                  <input type="text" name="product_reviews[notify_email]" value="<?php echo $notify_email; ?>" placeholder="<?php echo $entry_notify_email; ?>" id="input-notify-email" class="form-control" />
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label s_help" for="input-notification"><?php echo $entry_notification; ?><b><?php echo $help_notification; ?></b></label>
                <div class="col-sm-4">
				  <textarea name="product_reviews[notification]" rows="6" placeholder="<?php echo $entry_notification; ?>" id="input-notification" class="form-control"><?php echo $notification; ?></textarea><div style="padding-top: 7px;"><b>{product}</b> - product name to which added review <b>{avg}</b> - average rating <b>{review}</b> - review added by the user</div>
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label s_help" for="input-comment-status"><?php echo $entry_comment_status; ?><b><?php echo $help_comment_status; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[comment_status]" id="input-comment-status" class="form-control">
                    <?php if ($comment_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-comment-author"><?php echo $entry_comment_author; ?></label>
                <div class="col-sm-4">
                  <input type="text" name="product_reviews[comment_author]" value="<?php echo $comment_author; ?>" placeholder="<?php echo $entry_comment_author; ?>" id="input-comment-author" class="form-control" />
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-comment-image-status"><?php echo $entry_comment_image_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[comment_image_status]" id="input-comment-image-status" class="form-control">
                    <?php if ($comment_image_status) { ?>
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
                <label class="col-sm-2 control-label s_help" for="input-colorbox-status"><?php echo $entry_colorbox_status; ?><b><?php echo $help_colorbox_status; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[colorbox_status]" id="input-colorbox-status" class="form-control">
                    <?php if ($colorbox_status) { ?>
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
                <label class="col-sm-2 control-label s_help" for="input-seo-keyword"><?php echo $entry_seo_keyword; ?><b><?php echo $help_seo_keyword; ?></b></label>
                <div class="col-xs-4">
                  <input type="text" name="product_reviews[seo_keyword]" value="<?php echo $seo_keyword; ?>" placeholder="<?php echo $entry_seo_keyword; ?>" id="input-seo-keyword" class="form-control" />
                </div>
				<div class="col-xs-4">
				  <?php echo HTTP_CATALOG . (($seo_keyword) ? $seo_keyword : 'index.php?route=product/allreviews'); ?>
				</div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label s_help" for="input-multistore-status"><?php echo $entry_multistore_status; ?><b><?php echo $help_multistore_status; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[multistore_status]" id="input-multistore-status" class="form-control">
                    <?php if ($multistore_status) { ?>
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
                <label class="col-sm-2 control-label s_help" for="input-language-status"><?php echo $entry_language_status; ?><b><?php echo $help_language_status; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[language_status]" id="input-language-status" class="form-control">
                    <?php if ($language_status) { ?>
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
                <label class="col-sm-2 control-label s_help" for="input-default-view"><?php echo $entry_default_view; ?><b><?php echo $help_default_view; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[default_view]" id="input-default-view" class="form-control">
						<option value="list" selected="selected"><?php echo $text_list; ?></option>
					</select>
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-review-title-status"><?php echo $entry_review_title_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[review_title_status]" id="input-review-title-status" class="form-control">
                    <?php if ($review_title_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-recommend-status"><?php echo $entry_recommend_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[recommend_status]" id="input-recommend-status" class="form-control">
                    <?php if ($recommend_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-predefined-pros-cons-status"><?php echo $entry_predefined_pros_cons_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[predefined_pros_cons_status]" id="input-predefined-pros-cons-status" class="form-control">
                    <?php if ($predefined_pros_cons_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-pros-status"><?php echo $entry_pros_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[pros_status]" id="input-pros-status" class="form-control">
                    <?php if ($pros_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-cons-status"><?php echo $entry_cons_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[cons_status]" id="input-cons-status" class="form-control">
                    <?php if ($cons_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-report-abuse-status"><?php echo $entry_report_abuse_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[report_abuse_status]" id="input-report-abuse-status" class="form-control">
                    <?php if ($report_abuse_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-helpfulness-status"><?php echo $entry_helpfulness_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[helpfulness_status]" id="input-helpfulness-status" class="form-control">
                    <?php if ($helpfulness_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-total-rating-status"><?php echo $entry_total_rating_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[total_rating_status]" id="input-total-rating-status" class="form-control">
                    <?php if ($total_rating_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-summary-status"><?php echo $entry_summary_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[summary_status]" id="input-summary-status" class="form-control">
                    <?php if ($summary_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-autoapprove"><?php echo $entry_autoapprove; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[autoapprove]" id="input-autoapprove" class="form-control">
                    <?php if ($autoapprove == 1) { ?>
                    <option value="1" selected="selected"><?php echo $text_yes_logged; ?></option>
                    <option value="2"><?php echo $text_yes_all; ?></option>
					<option value="0"><?php echo $text_no; ?></option>
					<?php } elseif ($autoapprove == 2) { ?>
                    <option value="1"><?php echo $text_yes_logged; ?></option>
					<option value="2" selected="selected"><?php echo $text_yes_all; ?></option>
                    <option value="0"><?php echo $text_no; ?></option>
					<?php } else { ?>
                    <option value="1"><?php echo $text_yes_logged; ?></option>
					<option value="2"><?php echo $text_yes_all; ?></option>
                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label s_help" for="input-autoapprove-rating"><?php echo $entry_autoapprove_rating; ?><b><?php echo $help_autoapprove_rating; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[autoapprove_rating]" id="input-autoapprove-rating" class="form-control">
				    <?php foreach ($product_ratings as $key => $rating) { ?>
					<?php if ($autoapprove_rating == $rating) { ?>
					<option value="<?php echo $rating; ?>" selected="selected"><?php echo $rating; ?></option>
					<?php } else { ?>
					<option value="<?php echo $rating; ?>"><?php echo $rating; ?></option>
					<?php } ?>
					<?php } ?>
                  </select>
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label s_help" for="input-appearance-type"><?php echo $entry_appearance_type; ?><b><?php echo $help_appearance_type; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[appearance_type]" id="input-appearance-type" class="form-control">
                    <?php foreach ($appearance as $key => $type) { ?>
					<?php if ($appearance_type == $type) { ?>
					<option value="<?php echo $type; ?>" selected="selected"><?php echo $type; ?></option>
					<?php } else { ?>
					<option value="<?php echo $type; ?>"><?php echo $type; ?></option>
					<?php } ?>
					<?php } ?>
                  </select>
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-appearance-customer-rating"><?php echo $entry_appearance_customer_rating; ?></label>
                <div class="col-sm-3">
                  <?php foreach ($appearance_customer as $key => $type) { ?>
				  <?php if (isset($type[1]) && $appearance_customer_rating == $type[1]) { ?>
				  <div class="radio">
				    <label><input type="radio" name="product_reviews[appearance_customer_rating]" value="<?php echo $type[1]; ?>" checked /> <img src="<?php echo $type[0]; ?>" style="vertical-align: 3%;" /></label>
				  </div>
				  <?php } else { ?>
				  <div class="radio">
				    <label><input type="radio" name="product_reviews[appearance_customer_rating]" value="<?php echo $type[1]; ?>" /> <img src="<?php echo $type[0]; ?>" style="vertical-align: 3%;" /></label>
				  </div>
				  <?php } ?>
				  <?php } ?>
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label s_help" for="input-purchase-status"><?php echo $entry_purchase_status; ?><b><?php echo $help_purchase_status; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[purchase_status]" id="input-purchase-status" class="form-control">
                    <?php if ($purchase_status) { ?>
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
                <label class="col-sm-2 control-label s_help" for="input-limit-product-status"><?php echo $entry_limit_product_status; ?><b><?php echo $help_limit_product_status; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[limit_product_status]" id="input-limit-product-status" class="form-control">
                    <?php if ($limit_product_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-report-abuse-guest"><?php echo $entry_report_abuse_guest; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[report_abuse_guest]" id="input-report-abuse-guest" class="form-control">
                    <?php if ($report_abuse_guest) { ?>
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
                <label class="col-sm-2 control-label s_help" for="input-rating-guest"><?php echo $entry_rating_guest; ?><b><?php echo $help_rating_guest; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[rating_guest]" id="input-rating-guest" class="form-control">
                    <?php if ($rating_guest) { ?>
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
                <label class="col-sm-2 control-label" for="input-captcha"><?php echo $entry_captcha; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[captcha]" id="input-captcha" class="form-control">
                    <?php if ($captcha) { ?>
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
                <label class="col-sm-2 control-label" for="input-helpfulness-guest"><?php echo $entry_helpfulness_guest; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[helpfulness_guest]" id="input-helpfulness-guest" class="form-control">
                    <?php if ($helpfulness_guest) { ?>
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
                <label class="col-sm-2 control-label" for="input-helpfulness-type"><?php echo $entry_helpfulness_type; ?></label>
                <div class="col-sm-4">
                  <?php if ($helpfulness_type == 'percentage') { ?>
				  <div class="radio"><label><input type="radio" name="product_reviews[helpfulness_type]" value="percentage" checked /> <img src="<?php echo $helpfulness_percentage; ?>" style="vertical-align: bottom;" /></label></div>
				  <div class="radio"><label><input type="radio" name="product_reviews[helpfulness_type]" value="numerically" /> <img src="<?php echo $helpfulness_numerically; ?>" style="vertical-align: bottom;" /></label></div>
				  <?php } else { ?>
				  <div class="radio"><label><input type="radio" name="product_reviews[helpfulness_type]" value="percentage" / > <img src="<?php echo $helpfulness_percentage; ?>" style="vertical-align: bottom;" /></label></div>
				  <div class="radio"><label><input type="radio" name="product_reviews[helpfulness_type]" value="numerically" checked /> <img src="<?php echo $helpfulness_numerically; ?>" style="vertical-align: bottom;" /></label></div>
				  <?php } ?>
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-share-status"><?php echo $entry_share_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[share_status]" id="input-share-status" class="form-control">
                    <?php if ($share_status) { ?>
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
                <label class="col-sm-2 control-label s_help" for="input-point-status"><?php echo $entry_point_status; ?><b><?php echo $help_point_status; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[point_status]" id="input-point-status" class="form-control">
                    <?php if ($point_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                    <option value="0"><?php echo $text_no; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_yes; ?></option>
                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                    <?php } ?>
                  </select>
                </div>
				<label class="col-sm-2 control-label"><?php echo $entry_reward_point; ?></label>
				<div class="col-sm-1">
				  <input type="text" name="product_reviews[reward_point]" value="<?php echo $reward_point; ?>" class="form-control" />
				</div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-description-point"><?php echo $entry_description_point; ?></label>
                <div class="col-sm-4">
                  <?php foreach ($languages as $language) { ?>
				  <div class="input-group"><span class="input-group-addon"><?php echo $language['name']; ?></span>
				    <input type="text" name="product_reviews[description_point][<?php echo $language['language_id']; ?>]" value="<?php echo (isset($description_point[$language['language_id']])) ? $description_point[$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_description_point; ?>" class="form-control" />
				  </div>
				  <?php } ?>
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label s_help" for="input-sort-status"><?php echo $entry_sort_status; ?><b><?php echo $help_sort_status; ?></b></label>
                <div class="col-sm-4">
                  <select name="product_reviews[sort_status]" id="input-sort-status" class="form-control">
                    <?php if ($sort_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-image-status"><?php echo $entry_image_status; ?></label>
                <div class="col-sm-4">
                  <select name="product_reviews[image_status]" id="input-image-status" class="form-control">
                    <?php if ($image_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-image-limit"><?php echo $entry_image_limit; ?></label>
                <div class="col-sm-4">
                  <input type="text" name="product_reviews[image_limit]" value="<?php echo $image_limit; ?>" placeholder="<?php echo $entry_image_limit; ?>" id="input-image-limit" class="form-control" />
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-image-thumb"><?php echo $entry_image_thumb; ?></label>
                <div class="col-sm-2">
                  <input type="text" name="product_reviews[image_thumb_width]" value="<?php echo $image_thumb_width; ?>" placeholder="<?php echo $entry_image_thumb_width; ?>" id="input-image-thumb" class="form-control" />
                </div>
				<div class="col-sm-2">
                  <input type="text" name="product_reviews[image_thumb_height]" value="<?php echo $image_thumb_height; ?>" placeholder="<?php echo $entry_image_thumb_height; ?>" id="input-image-thumb" class="form-control" />
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-image-popup"><?php echo $entry_image_popup; ?></label>
                <div class="col-sm-2">
                  <input type="text" name="product_reviews[image_popup_width]" value="<?php echo $image_popup_width; ?>" placeholder="<?php echo $entry_image_popup_width; ?>" id="input-image-popup" class="form-control" />
                </div>
				<div class="col-sm-2">
                  <input type="text" name="product_reviews[image_popup_height]" value="<?php echo $image_popup_height; ?>" placeholder="<?php echo $entry_image_popup_height; ?>" id="input-image-popup" class="form-control" />
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-product-page-limit"><?php echo $entry_product_page_limit; ?></label>
                <div class="col-sm-4">
                  <input type="text" name="product_reviews[limit]" value="<?php echo $limit; ?>" placeholder="<?php echo $entry_product_page_limit; ?>" id="input-product-page-limit" class="form-control" />
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-pros-cons-limit"><?php echo $entry_pros_cons_limit; ?></label>
                <div class="col-sm-4">
                  <input type="text" name="product_reviews[pros_cons_limit]" value="<?php echo $pros_cons_limit; ?>" placeholder="<?php echo $entry_pros_cons_limit; ?>" id="input-pros-cons-limit" class="form-control" />
                </div>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label s_help" for="input-pros-cons-character-limit"><?php echo $entry_pros_cons_character_limit; ?><b><?php echo $help_pros_cons_character_limit; ?></b></label>
                <div class="col-sm-2">
                  <input type="text" name="product_reviews[pros_cons_character_limit_from]" value="<?php echo $pros_cons_character_limit_from; ?>" placeholder="" id="input-pros-cons-character-limit" class="form-control" />
                </div>
				<div class="col-sm-2">
                  <input type="text" name="product_reviews[pros_cons_character_limit_to]" value="<?php echo $pros_cons_character_limit_to; ?>" placeholder="" id="input-pros-cons-character-limit" class="form-control" />
                </div>
              </div>
			</div>
			<div class="tab-pane fade" id="tab-css">
			  <div class="row">
                <div class="col-sm-2">
                  <ul class="nav nav-pills nav-stacked" id="css">
                    <li><a href="#tab-css-form" data-toggle="tab">Form add reviews</a></li>
					<li><a href="#tab-css-product-page" data-toggle="tab">Reviews on the product page</a></li>
					<li><a href="#tab-css-all-reviews" data-toggle="tab">Page with all review</a></li>
					<li><a href="#tab-css-box" data-toggle="tab">Box (latest/random)</a></li>
                  </ul>
                </div>
				<div class="col-sm-10">
                  <div class="tab-content">
				     <div class="tab-pane" id="tab-css-form">
					   <div class="form-group">
					     <div class="col-sm-12"><b>Review list</b></div>
					     <div class="col-sm-12">
						   <textarea name="product_reviews[form_css]" rows="9" placeholder="Review list" id="input-form-css" wrap="off" class="form-control"><?php echo $form_css; ?></textarea>
					     </div>
					   </div>
					 </div>
					 <div class="tab-pane" id="tab-css-product-page">
					   <div class="form-group">
					     <div class="col-sm-6">
						   <div class="col-sm-12"><b>Review list</b></div>
					       <div class="col-sm-12">
						     <textarea name="product_reviews[list_css]" rows="9" placeholder="Review list" id="input-list-css" wrap="off" class="form-control"><?php echo $list_css; ?></textarea>
					       </div>
						 </div>
						 <div class="col-sm-6">
						   <div class="col-sm-12"><b>Pros and cons list</b></div>
					       <div class="col-sm-12">
						     <textarea name="product_reviews[pros_cons_list_css]" rows="9" placeholder="Pros and cons list" id="input-pros-cons-list-css" wrap="off" class="form-control"><?php echo $pros_cons_list_css; ?></textarea>
						   </div>
						 </div>
					   </div>
					   <div class="form-group">
					     <div class="col-sm-6">
						   <div class="col-sm-12"><b>Rating list</b></div>
					       <div class="col-sm-12">
						     <textarea name="product_reviews[rating_css]" rows="9" placeholder="Rating list" id="input-rating-css" wrap="off" class="form-control"><?php echo $rating_css; ?></textarea>
					       </div>
						 </div>
						 <div class="col-sm-6">
						   <div class="col-sm-12"><b>Helpfulness</b></div>
					       <div class="col-sm-12">
						     <textarea name="product_reviews[helpfulness_css]" rows="9" placeholder="Helpfulness" id="input-helpfulness-css" wrap="off" class="form-control"><?php echo $helpfulness_css; ?></textarea>
					       </div>
						 </div>
					   </div>
					   <div class="form-group">
					     <div class="col-sm-6">
						   <div class="col-sm-12"><b>Sort reviews</b></div>
					       <div class="col-sm-12">
						     <textarea name="product_reviews[sort_css]" rows="9" placeholder="Sort reviews" id="input-sort-css" wrap="off" class="form-control"><?php echo $sort_css; ?></textarea>
					       </div>
						 </div>
						 <div class="col-sm-6">
						   <div class="col-sm-12"><b>Total rating of review</b></div>
					       <div class="col-sm-12">
						     <textarea name="product_reviews[total_rating_css]" rows="9" placeholder="Total rating of review" id="input-total-rating-css" wrap="off" class="form-control"><?php echo $total_rating_css; ?></textarea>
					       </div>
						 </div>
					   </div>
					   <div class="form-group">
					     <div class="col-sm-6">
						   <div class="col-sm-12"><b>Image presentation</b></div>
					       <div class="col-sm-12">
						     <textarea name="product_reviews[image_css]" rows="9" placeholder="Image presentation" id="input-image-css" wrap="off" class="form-control"><?php echo $image_css; ?></textarea>
					       </div>
						 </div>
						 <div class="col-sm-6">
						   <div class="col-sm-12"><b>Comment</b></div>
					       <div class="col-sm-12">
						     <textarea name="product_reviews[comment_css]" rows="9" placeholder="Comment" id="input-comment-css" wrap="off" class="form-control"><?php echo $comment_css; ?></textarea>
					       </div>
						 </div>
					   </div>
					   <div class="form-group">
					     <div class="col-sm-6">
						   <div class="col-sm-12"><b>Summary block</b></div>
					       <div class="col-sm-12">
						     <textarea name="product_reviews[summary_css]" rows="9" placeholder="Summary block" id="input-summary-css" wrap="off" class="form-control"><?php echo $summary_css; ?></textarea>
					       </div>
						 </div>
						 <div class="col-sm-6">
						   <div class="col-sm-12"><b>Share</b></div>
					       <div class="col-sm-12">
						     <textarea name="product_reviews[share_css]" rows="9" placeholder="Share" id="input-share-css" wrap="off" class="form-control"><?php echo $share_css; ?></textarea>
					       </div>
						 </div>
					   </div>
					 </div>
					 <div class="tab-pane" id="tab-css-all-reviews">
					   <div class="form-group">
					     <div class="col-sm-12"><b>All reviews</b></div>
					     <div class="col-sm-12">
						   <textarea name="product_reviews[page_list_css]" rows="9" placeholder="All reviews" id="input-page-list-css" wrap="off" class="form-control"><?php echo $page_list_css; ?></textarea>
					     </div>
					   </div>
					 </div>
					 <div class="tab-pane" id="tab-css-box">
					   <div class="form-group">
					     <div class="col-sm-12"><b>Box with review</b></div>
					     <div class="col-sm-12">
						   <textarea name="product_reviews[box_css]" rows="9" placeholder="Box with review" id="input-box-css" wrap="off" class="form-control"><?php echo $box_css; ?></textarea>
					     </div>
					   </div>
					 </div>
				  </div>
				</div>
			  </div>
			</div>
			<div class="tab-pane" id="tab-support">
			  <div id="rspLicense"></div>
			  <h3 style="margin-bottom: 25px;"><b>Your license</b></h3>
			  <?php if (isset($bGljZW5zZV9kZXRhaWw['status']) && $bGljZW5zZV9kZXRhaWw['status']) { ?>
			  <table class="table">
			    <tbody>
				  <tr>
				    <td style="width: 150px;">License key:</td>
					<td><span><?php echo $license_key; ?></span><input type="hidden" name="product_reviews[license]" class="license_detail form-control" value="<?php echo $license; ?>" />
				      <input type="text" name="product_reviews[license_key]" class="license_key form-control" style="display: none!important;" value="<?php echo $license_key; ?>" /> <a id="re-actLicense" class="btn btn-success">Re-activate</a></td>
				  </tr>
				  <tr>
				    <td>License for:</td>
					<td><?php echo $bGljZW5zZV9kZXRhaWw['customer']; ?>, <?php echo $bGljZW5zZV9kZXRhaWw['domain']; ?></td>
				  </tr>
				</tbody>
			  </table>
			  <?php } else { ?>
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-enter-license-key">Enter your license key:</label>
                <div class="col-xs-4">
                  <input type="text" name="product_reviews[license_key]" value="<?php echo $license_key; ?>" placeholder="xxxxx-xxxxx-xxxxx-xxxxx-xxxxx" id="input-enter-license-key" class="license_key form-control" />
                </div>
				<div class="col-xs-6">
                  <a id="actLicense" class="btn btn-success">Activate</a>
				</div>
              </div>
			  <?php } ?>
			  <br /><br /><br />
			  License required! <a onclick="window.open('https://www.adikon.eu/login')">Click here to get the license key</a>.<br /><br />
			  <b>Module page:</b> <a onclick="window.open('http://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=14198')">Advanced Product Reviews</a><br />
			  <b>Other modules:</b> <a onclick="window.open('http://www.opencart.com/index.php?route=marketplace/extension&filter_member=adikon')">On Opencart.com</a><br />
			  <br /><br />
			  Adikon.eu, All Rights Reserved.
			  <script type="text/javascript">
			  var mod_id = '4610';
			  var domain = '<?php echo base64_encode((!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : (defined('HTTP_SERVER') ? HTTP_SERVER : '')); ?>';
			  </script>
			  <script type="text/javascript" src="//www.adikon.eu/verify/"></script>
			</div>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#css a:first').tab('show');

$('input#input-seo-keyword').keyup(function(){
	var seokeyword = $(this).val().replace(/ /g, '-').toLowerCase();

	if (seokeyword) {
		$(this).parent().next('div').html('<?php echo HTTP_CATALOG; ?>' + seokeyword);
	} else {
		$(this).parent().next('div').html('<?php echo HTTP_CATALOG . 'index.php?route=product/allreviews'; ?>');
	}
});
//--></script>
<?php echo $footer; ?>