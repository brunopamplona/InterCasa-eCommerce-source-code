<?php echo str_replace(array('view/javascript/jquery/jquery-1.6.1.min.js', 'view/javascript/jquery/jquery-1.7.1.min.js', 'http://code.jquery.com/jquery-1.7.2.min.js'), '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', $header); ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-rating" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-rating" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
            <div class="col-sm-4">
              <?php foreach ($languages as $language) { ?>
              <div class="input-group"><span class="input-group-addon"><?php echo $language['name']; ?></span>
                <input type="text" name="name[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($name[$language['language_id']]) ? $name[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" class="form-control" />
              </div>
              <?php if (isset($error_name[$language['language_id']])) { ?>
              <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
              <?php } ?>
              <?php } ?>
            </div>
          </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>
			<div class="col-sm-4">
			  <div class="well well-sm" style="height: 150px; overflow: auto;">
			    <?php foreach ($stores as $store) { ?>
				<div class="checkbox">
				  <label>
				    <?php if (in_array($store['store_id'], $rating_store)) { ?>
				    <input type="checkbox" name="rating_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
				    <?php echo $store['name']; ?>
				    <?php } else { ?>
				    <input type="checkbox" name="rating_store[]" value="<?php echo $store['store_id']; ?>" />
				    <?php echo $store['name']; ?>
				    <?php } ?>
				  </label>
				</div>
			    <?php } ?>
			  </div>
		    </div>
		  </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-4">
              <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
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
<?php echo $footer; ?>