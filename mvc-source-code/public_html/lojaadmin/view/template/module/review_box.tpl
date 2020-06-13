<?php echo str_replace(array('view/javascript/jquery/jquery-1.6.1.min.js', 'view/javascript/jquery/jquery-1.7.1.min.js'), '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', $header); ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-review-box" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-review-box" class="form-horizontal">
          <?php if (version_compare(VERSION, '2.0.1') < 0) { ?>
		  <table id="module" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left"><?php echo $entry_header; ?></td>
                <td class="text-left"><?php echo $entry_type; ?></td>
			    <td class="text-left"><?php echo $entry_limit; ?></td>
                <td class="text-left"><?php echo $entry_all_review; ?></td>
                <td class="text-left"><?php echo $entry_layout; ?></td>
                <td class="text-left"><?php echo $entry_position; ?></td>
                <td class="text-left"><?php echo $entry_status; ?></td>
                <td class="text-right"><?php echo $entry_sort_order; ?></td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php $module_row = 1; ?>
              <?php foreach ($modules as $module) { ?>
              <tr id="module-row<?php echo $module_row; ?>">
                <td class="text-left"><?php foreach ($languages as $language) { ?>
				  <div class="input-group"><span class="input-group-addon"><?php echo $language['name']; ?></span>
				    <input type="text" name="review_box_module[<?php echo $module_row; ?>][header][<?php echo $language['language_id']; ?>]" value="<?php echo isset($module['header'][$language['language_id']]) ? $module['header'][$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_header; ?>" class="form-control" />
				  </div>
				  <?php } ?>
				  <?php if (isset($error_header[$module_row])) { ?>
				  <div class="text-danger"><?php echo $error_header[$module_row]; ?></div>
				  <?php } ?></td>
				<td class="text-left"><select name="review_box_module[<?php echo $module_row; ?>][type]" class="form-control">
                    <?php if (isset($module['type']) && $module['type'] == 'random') { ?>
                    <option value="random" selected="selected"><?php echo $text_random; ?></option>
                    <option value="latest"><?php echo $text_latest; ?></option>
				    <?php } else { ?>
                    <option value="random"><?php echo $text_random; ?></option>
				    <option value="latest" selected="selected"><?php echo $text_latest; ?></option>
                    <?php } ?>
                  </select></td>
				<td class="text-left"><input type="text" name="review_box_module[<?php echo $module_row; ?>][limit]" value="<?php echo $module['limit']; ?>" placeholder="<?php echo $entry_limit; ?>" class="form-control" /></td>
                <td class="text-left"><select name="review_box_module[<?php echo $module_row; ?>][button]" class="form-control">
                    <?php if (isset($module['button']) && $module['button']) { ?>
                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                    <option value="0"><?php echo $text_no; ?></option>
				    <?php } else { ?>
                    <option value="1"><?php echo $text_yes; ?></option>
				    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                    <?php } ?>
                  </select></td>
				<td class="text-left"><select name="review_box_module[<?php echo $module_row; ?>][layout_id]" class="form-control">
                    <?php foreach ($layouts as $layout) { ?>
                    <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                    <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
				<td class="text-left"><select name="review_box_module[<?php echo $module_row; ?>][position]" class="form-control">
                    <?php if ($module['position'] == 'content_top') { ?>
                    <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
                    <?php } else { ?>
                    <option value="content_top"><?php echo $text_content_top; ?></option>
                    <?php } ?>
                    <?php if ($module['position'] == 'content_bottom') { ?>
                    <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
                    <?php } else { ?>
                    <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
                    <?php } ?>
                    <?php if ($module['position'] == 'column_left') { ?>
                    <option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
                    <?php } else { ?>
                    <option value="column_left"><?php echo $text_column_left; ?></option>
                    <?php } ?>
                    <?php if ($module['position'] == 'column_right') { ?>
                    <option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
                    <?php } else { ?>
                    <option value="column_right"><?php echo $text_column_right; ?></option>
                    <?php } ?>
                  </select></td>
				<td class="text-left"><select name="review_box_module[<?php echo $module_row; ?>][status]" class="form-control">
                    <?php if ($module['status']) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select></td>
				<td class="text-left"><input type="text" name="review_box_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" class="form-control" /></td>
                <td class="text-left"><button type="button" onclick="$('#module-row<?php echo $module_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
              <?php $module_row++; ?>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="8"></td>
                <td class="text-left"><button type="button" onclick="addModule();" data-toggle="tooltip" title="<?php echo $button_add_module; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
              </tr>
            </tfoot>
          </table>
		  <?php } else { ?>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="review_box_module[0][name]" value="<?php echo isset($modules['name']) ? $modules['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-header"><?php echo $entry_header; ?></label>
            <div class="col-sm-10">
              <?php foreach ($languages as $language) { ?>
              <div class="input-group"><span class="input-group-addon"><?php echo $language['name']; ?></span>
                <input type="text" name="review_box_module[0][header][<?php echo $language['language_id']; ?>]" value="<?php echo isset($modules['header'][$language['language_id']]) ? $modules['header'][$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_header; ?>" class="form-control" />
              </div>
              <?php } ?>
			  <?php if (isset($error_header[0])) { ?>
              <div class="text-danger"><?php echo $error_header[0]; ?></div>
              <?php } ?>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-type"><?php echo $entry_type; ?></label>
            <div class="col-sm-10">
              <select name="review_box_module[0][type]" id="input-type" class="form-control">
                <?php if (isset($modules['type']) && $modules['type'] == 'random') { ?>
				<option value="random" selected="selected"><?php echo $text_random; ?></option>
				<option value="latest"><?php echo $text_latest; ?></option>
				<?php } else { ?>
				<option value="random"><?php echo $text_random; ?></option>
				<option value="latest" selected="selected"><?php echo $text_latest; ?></option>
				<?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
            <div class="col-sm-10">
              <input type="text" name="review_box_module[0][limit]" value="<?php echo isset($modules['limit']) ? $modules['limit'] : '5'; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-all-review"><?php echo $entry_all_review; ?></label>
            <div class="col-sm-10">
              <select name="review_box_module[0][button]" id="input-all-review" class="form-control">
			    <?php if (isset($modules['button']) && $modules['button']) { ?>
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
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="review_box_module[0][status]" id="input-status" class="form-control">
                <?php if (isset($modules['status']) && $modules['status']) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
		  <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>
<?php if (version_compare(VERSION, '2.0.1') < 0) { ?>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="text-left">';
	<?php foreach ($languages as $language) { ?>
	html += '      <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span><input type="text" name="review_box_module[' + module_row + '][header][<?php echo $language['language_id']; ?>]" value="" class="form-control" /></div>';
	<?php } ?>
	html += '    </td>';
	html += '    <td class="text-left"><select name="review_box_module[' + module_row + '][type]" class="form-control">';
	html += '      <option value="random"><?php echo $text_random; ?></option>';
	html += '      <option value="latest"><?php echo $text_latest; ?></option>';
	html += '    </select></td>';
	html += '    <td class="text-left"><input type="text" name="review_box_module[' + module_row + '][limit]" value="5" class="form-control" /></td>';
	html += '    <td class="text-left"><select name="review_box_module[' + module_row + '][button]" class="form-control">';
	html += '      <option value="1"><?php echo $text_yes; ?></option>';
	html += '      <option value="0"><?php echo $text_no; ?></option>';
	html += '    </select></td>';
	html += '    <td class="text-left"><select name="review_box_module[' + module_row + '][layout_id]" class="form-control">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="text-left"><select name="review_box_module[' + module_row + '][position]" class="form-control">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="text-left"><select name="review_box_module[' + module_row + '][status]" class="form-control">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="text-left"><input type="text" name="review_box_module[' + module_row + '][sort_order]" value="" class="form-control" /></td>';
	html += '    <td class="text-left"><button type="button" onclick="$(\'#module-row' + module_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script> 
<?php } ?>
<?php echo $footer; ?>