<?php echo str_replace(array('view/javascript/jquery/jquery-1.6.1.min.js', 'view/javascript/jquery/jquery-1.7.1.min.js', 'http://code.jquery.com/jquery-1.7.2.min.js'), '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', $header); ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-attribute" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-attribute" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
            <div class="col-sm-4">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label"><?php echo $entry_type; ?></label>
			<div class="col-sm-4">
			  <select name="type" id="input-type" class="form-control">
                <?php if ($type) { ?>
                <option value="1" selected="selected"><?php echo $text_pros; ?></option>
                <option value="0"><?php echo $text_cons; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_pros; ?></option>
                <option value="0" selected="selected"><?php echo $text_cons; ?></option>
                <?php } ?>
			  </select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label"><?php echo $entry_added_by; ?></label>
			<div class="col-sm-4">
			  <select name="added_by" id="input-added_by" class="form-control">
                <?php if (!$added_by || $added_by == 'a') { ?>
                <option value="a" selected="selected"><?php echo $text_added_admin; ?></option>
                <?php } elseif ($added_by == 'u') { ?>
                <option value="u" selected="selected"><?php echo $text_added_user; ?></option>
                <?php } else { ?>
				<option value="a"><?php echo $text_added_admin; ?></option>
                <option value="u"><?php echo $text_added_user; ?></option>
				<?php } ?>
			  </select>
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