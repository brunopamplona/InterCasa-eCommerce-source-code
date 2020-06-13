<?php
/***********************************************************************
  Extension: People's Code - Fee / Discount v1.2
  Copyright (C) 2013 People's Code
  Email: info.peoplescode@gmail.com
  Web: http://www.peoplescode.com
************************************************************************/
echo $header;
?>

<div id="content">

  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>

<style type="text/css" scoped>
  /*.box {min-width:1040px;}*/
  .box > .content {overflow:visible;}

  .hidden {padding:10px 0 16px 0; margin:0; font-size:13px; color:#555;}
  .hidden h3 {font-size:16px; color:#777; margin:0 24px 16px 24px; border-bottom:1px dotted #aaa;}
  .hidden p, .hidden ol  {padding:0 24px; line-height:18px}
  .hidden ol  {list-style-position:inside;}
  .hidden ol li {margin:6px 0;}

  .ui-state-highlight {display:block; visibility:hidden; border:none;}
  .ui-sortable-helper {cursor:move; box-shadow:0px 4px 6px #ddd;}

  #pfd_rows {border:none;}

  #pfd_rows thead td {font-size:14px; color:#555; vertical-align:middle; background:#EFEFEF;}
  #pfd_rows thead .info img {padding:3px; margin:0 14px -3px 6px; cursor:pointer; border-radius:50%; box-shadow:0px 2px 1px #ddd; background:#fff;}
  #pfd_rows thead .pfd_expand_checkbox, #pfd_rows tfoot .pfd_add {width:26px; text-align:center;}
 
  #pfd_rows tbody {background:#fff;}
  #pfd_rows td {border:1px solid #ddd; padding:8px; vertical-align:top; background:none;}
  #pfd_rows td .pfd_error img {margin:0 0 -4px 4px; cursor:help;}
  #pfd_rows td .pfd_dotted {border-top:1px dotted #aaa; margin-top:5px; padding-top:5px;}

  #pfd_rows td p {font-size:28px; text-align:center; color:#aaa;}
  #pfd_rows td input {color:#000;}
  #pfd_rows td .scrollbox {margin:4px 0; width:auto; min-height:90px;}
  #pfd_rows td .description input {width:85%; padding:2px; margin:0;}
  #pfd_rows td .description img {margin:0; padding:0; float:none;}
  #pfd_rows .pfd_expanded {min-height:90px; height:auto; overflow:visible;}
  #pfd_rows .pfd_expanded div {padding-right:0;}

  #pfd_rows .pfd_controls {vertical-align:middle;}
  #pfd_rows .pfd_controls tbody, #pfd_rows .pfd_controls td {padding:0; margin:0; background:none; border:none;}
  #pfd_rows .pfd_controls table td {padding:20px 0;}

  #pfd_rows .pfd_up, #pfd_rows .pfd_remove, #pfd_rows .pfd_down {vertical-align:middle;}
  #pfd_rows thead .pfd_expand_checkbox img, #pfd_rows .pfd_one_step_up img, #pfd_rows .pfd_up img, #pfd_rows .pfd_remove img, #pfd_rows .pfd_down img, #pfd_rows .pfd_one_step_down img, #pfd_rows .pfd_add img {border-radius:50%; box-shadow:0px 2px 1px #ddd;}
  
  #pfd_rows .pfd_expand_checkbox img {background:#6E6E6E;}
  #pfd_rows .pfd_up img, #pfd_rows .pfd_down img {background:#B0B0B0;}
  #pfd_rows .pfd_one_step_up img, #pfd_rows .pfd_one_step_down img {background:#AFCBE6;}
  #pfd_rows .pfd_remove img {background:#E36868;}
  #pfd_rows .pfd_add img {background:#548054;}

  #pfd_rows .error_message {}

  <?php if(isset($pc_fee_discount_style) && $pc_fee_discount_style) { ?>
    select {margin:4px 0; background:#fff; border:solid 1px #ddd; padding:2px 5px; border-radius:4px;}
    input {margin:2px 0; height:16px; background:#fff; border:solid 1px #ddd; border-radius:4px;}
    #pfd_rows .scrollbox {border:solid 1px #ddd;}
    #pfd_rows .odd {background:#F5F5F5;}
  <?php } ?>

  .pfd_copy {display:block; text-align:center; margin:12px 0;}
  .pfd_copy p {margin:20px 0; }
  .pfd_copy a {color:#000;}
  .pfd_copy a:hover {text-decoration:none;}
  .pfd_copy .pfd_logo {font-size:30px; font-weight:bold; font-style:italic; color:#636E75; text-decoration:none; text-shadow: 2px 2px 1px rgba(0, 0, 0, 0.1);}
  .pfd_copy .pfd_logo span {color:#90C6C5;}
</style>

  <div class="box">

    <div class="heading">
      <h1><img src="view/image/total.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>

    <div class="content">

    <!-- Help -->
    <div id="pfd_info">
      <div class="hidden">
          <h3><?php echo $help_conditions_h; ?></h3>
          <?php echo $help_conditions; ?>
        </div>
      <div class="hidden">
          <h3><?php echo $help_fee_discount_h; ?></h3>
          <?php echo $help_fee_discount; ?>
        </div>
    </div>
    <!-- // Help -->

    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table id="pfd_rows" class="list">
        <thead>
          <tr>
            <td colspan="3" class="info"><img src="view/image/peoplescode/pfd/pfd_info.png" alt="?" title="<?php echo $text_pfd_help; ?>" class="toggle_info" /><?php echo $text_pfd_conditions; ?></td>
            <td class="info"><img src="view/image/peoplescode/pfd/pfd_info.png" alt="?" title="<?php echo $text_pfd_help; ?>" class="toggle_info" /><?php echo $text_pfd_fee; ?></td>
            <td class="pfd_expand_checkbox">
              <a onclick="pfdExpand($(this));"><img src="view/image/peoplescode/pfd/pfd_expand.png" alt="<?php echo $text_pfd_expand; ?>" title="<?php echo $text_pfd_expand; ?>"/></a>
            </td>
          </tr>
        </thead>
      
    <?php $pc_fee_discount_id = 0; ?>
    
    <?php foreach ($pc_fee_discount_rows as $pc_fee_discount_row) { ?>

      <tbody id="pc_fee_discount_id_<?php echo $pc_fee_discount_id; ?>">
	      <tr>
          <!-- Conditions -->
          <td class="left">

            <!-- Shipping Method -->
            <div>
              <?php echo $entry_pfd_shipping; ?><br />
              <div class="scrollbox">
                <?php $class = 'odd'; ?>
                <?php foreach ($shipping_extensions as $extension) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (isset($pc_fee_discount_row['shippings_selected']) && in_array($extension['filename'], $pc_fee_discount_row['shippings_selected'])) { ?>
                      <input type="checkbox" name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][shippings_selected][]" value="<?php echo $extension['filename']; ?>" checked="checked" />
                      <?php echo $extension['name']; ?>
                    <?php } else { ?>
                      <input type="checkbox" name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][shippings_selected][]" value="<?php echo $extension['filename']; ?>" />
                      <?php echo $extension['name']; ?>
                    <?php } ?> 
                  </div>
                <?php } ?>
              </div>
              <a onclick="pfdSelectAll($(this));"><?php echo $text_select_all; ?></a> / <a onclick="pfdUnselectAll($(this));"><?php echo $text_unselect_all; ?></a>
            </div>
            <!-- // Shipping Method -->

            <!-- Payment Method -->
            <div class="pfd_dotted">
              <?php echo $entry_pfd_payment; ?><br />
              <div class="scrollbox">
                <?php $class = 'odd'; ?>
                <?php foreach ($payment_extensions as $extension) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (isset($pc_fee_discount_row['payments_selected']) && in_array($extension['filename'], $pc_fee_discount_row['payments_selected'])) { ?>
                      <input type="checkbox" name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][payments_selected][]" value="<?php echo $extension['filename']; ?>" checked="checked" />
                      <?php echo $extension['name']; ?>
                    <?php } else { ?>
                      <input type="checkbox" name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][payments_selected][]" value="<?php echo $extension['filename']; ?>" />
                      <?php echo $extension['name']; ?>
                    <?php } ?> 
                  </div>
                <?php } ?>
              </div>
              <a onclick="pfdSelectAll($(this));"><?php echo $text_select_all; ?></a> / <a onclick="pfdUnselectAll($(this));"><?php echo $text_unselect_all; ?></a>
            </div>
            <!-- // Payment Method -->

            <div class="pfd_dotted"></div>
            <p class="myIndex"><?php echo $pc_fee_discount_id + 1; ?></p>

          </td>
          <td>
            <!-- Customer group -->
            <div>
              <?php echo $entry_pfd_customer_group; ?><br />
              <div class="scrollbox">
                <?php $class = 'odd'; ?>
                <?php foreach ($customer_groups as $customer_group) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (isset($pc_fee_discount_row['groups_selected']) && in_array($customer_group['customer_group_id'], $pc_fee_discount_row['groups_selected'])) { ?>
                      <input type="checkbox" name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][groups_selected][]" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
                      <?php echo $customer_group['name']; ?>
                    <?php } else { ?>
                      <input type="checkbox" name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][groups_selected][]" value="<?php echo $customer_group['customer_group_id']; ?>" />
                      <?php echo $customer_group['name']; ?>
                    <?php } ?> 
                  </div>
                <?php } ?>
              </div>
              <a onclick="pfdSelectAll($(this));"><?php echo $text_select_all; ?></a> / <a onclick="pfdUnselectAll($(this));"><?php echo $text_unselect_all; ?></a>
            </div>
            <!-- // Customer group -->         
          </td>
          <td class="left">
            <!-- Geo Zone -->
            <div>
              <?php echo $entry_pfd_geo_zone; ?><br />
              <div class="scrollbox">
                <?php $class = 'odd'; ?>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (isset($pc_fee_discount_row['geo_zones_selected']) && in_array($geo_zone['geo_zone_id'], $pc_fee_discount_row['geo_zones_selected'])) { ?>

                      <input type="checkbox" name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][geo_zones_selected][]" value="<?php echo $geo_zone['geo_zone_id']; ?>" checked="checked" />
                      <?php echo $geo_zone['name']; ?>
                    <?php } else { ?>
                      <input type="checkbox" name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][geo_zones_selected][]" value="<?php echo $geo_zone['geo_zone_id']; ?>" />
                      <?php echo $geo_zone['name']; ?>
                    <?php } ?> 
                  </div>
                <?php } ?>
              </div>
              <a onclick="pfdSelectAll($(this));"><?php echo $text_select_all; ?></a> / <a onclick="pfdUnselectAll($(this));"><?php echo $text_unselect_all; ?></a>
            </div>
            <!-- // Geo Zone -->
            <!-- Shipping / Payment_address -->
            <div class="pfd_dotted">
              <?php echo $entry_pfd_cust_geo_zone; ?><br />
              <select name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][address]">
              <?php if ($pc_fee_discount_row['address']) { ?>
                <option value="0"><?php echo $text_pfd_shipping_address; ?></option>
                <option value="1" selected="selected"><?php echo $text_pfd_payment_address ; ?></option>
              <?php } else { ?>
                <option value="0" selected="selected"><?php echo $text_pfd_shipping_address; ?></option>
                <option value="1"><?php echo $text_pfd_payment_address; ?></option>
              <?php } ?>
              </select>
            </div>
            <!-- // Shipping / Payment address -->
            <!-- Enable Fee -->          
            <div class="pfd_dotted pfd_error">
              <?php echo $entry_pfd_enable_if; ?><br />
		          <select name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][enable_condition]">
              <?php if ($pc_fee_discount_row['enable_condition']) { ?>
                <option value="0"><?php echo $text_pfd_sub_total; ?></option>
                <option value="1" selected="selected"><?php echo $text_pfd_total; ?></option>
              <?php } else { ?>
                <option value="0" selected="selected"><?php echo $text_pfd_sub_total; ?></option>
                <option value="1"><?php echo $text_pfd_total; ?></option>
              <?php } ?>
              </select>
              <select name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][enable_more]">
              <?php if ($pc_fee_discount_row['enable_more']) { ?>
                <option value="0"><?php echo $text_pfd_enable_less; ?></option>
                <option value="1" selected="selected"><?php echo $text_pfd_enable_more; ?></option>
              <?php } else { ?>
                <option value="0" selected="selected"><?php echo $text_pfd_enable_less; ?></option>
                <option value="1"><?php echo $text_pfd_enable_more; ?></option>
              <?php } ?>
              </select>
			        <input type="text" name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][enable_amount]" value="<?php echo $pc_fee_discount_row['enable_amount']; ?>" size="5" <?php if (isset($error_enable_amount[$pc_fee_discount_id])) { ?> class='error_message' <?php ;} ?> /><?php if (isset($error_enable_amount[$pc_fee_discount_id])) { ?><img src="view/image/warning.png" alt="/ ! \" title="<?php echo $error_enable_amount[$pc_fee_discount_id]; ?>"/><?php } ?>
            </div>
            <!-- // Enable Fee -->
            <div class="pfd_dotted"></div>
          </td>
          <!-- // Conditions -->

          <!-- Fee / Discount -->
          <td class="left">
            <!-- Amount -->
            <div class="pfd_error">
              <?php echo $entry_pfd_amount; ?><br />
              <select name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][percentage]">
              <?php if ($pc_fee_discount_row['percentage']) { ?>
                <option value="0"><?php echo $text_pfd_fixed; ?></option>
                <option value="1" selected="selected"><?php echo $text_pfd_percentage; ?></option>
              <?php } else { ?>
                <option value="0" selected="selected"><?php echo $text_pfd_fixed; ?></option>
                <option value="1"><?php echo $text_pfd_percentage; ?></option>
              <?php } ?>
              </select>
              <input type="text" name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][fee]" value="<?php echo $pc_fee_discount_row['fee']; ?>" size="5" <?php if (isset($error_fee[$pc_fee_discount_id])) { ?> class='error_message' <?php ;} ?> /><?php if (isset($error_fee[$pc_fee_discount_id])) { ?><img src="view/image/warning.png" alt="/ ! \" title="<?php echo $error_fee[$pc_fee_discount_id]; ?>"/><?php } ?>
            </div>
            <!-- // Amount -->
            <!-- Compute -->
            <div class="pfd_dotted">
              <?php echo $entry_pfd_compute; ?><br />
              <select name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][serial]">
              <?php if ($pc_fee_discount_row['serial']) { ?>
                <option value="0"><?php echo $text_pfd_parallel; ?></option>
                <option value="1" selected="selected"><?php echo $text_pfd_serial ; ?></option>
              <?php } else { ?>
                <option value="0" selected="selected"><?php echo $text_pfd_parallel; ?></option>
                <option value="1"><?php echo $text_pfd_serial; ?></option>
              <?php } ?>
              </select>
            </div>
            <!-- // Compute -->
            <!-- Tax Class -->
            <div class="pfd_dotted">
              <?php echo $entry_pfd_tax_class; ?><br />
              <select name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][tax_class_id]">
                <option value="0"><?php echo $text_none; ?></option>
              <?php foreach ($tax_classes as $tax_class) { ?>
                <?php if ($tax_class['tax_class_id'] == $pc_fee_discount_row['tax_class_id']) { ?>
                <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                 <?php } ?>
              <?php } ?>
              </select>
            </div>
            <!-- // Tax Class -->
            <!-- Description -->
            <div class="pfd_dotted">
            <?php echo $entry_pfd_translations; ?><br />
              <div class="scrollbox description">
                <?php foreach ($languages as $language) { ?>
                <div><input type="text" name="pc_fee_discount_rows[<?php echo $pc_fee_discount_id; ?>][description][<?php echo $language['language_id']; ?>]" value="<?php echo $pc_fee_discount_row['description'][$language['language_id']]; ?>" />
                <img src="view/image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" />
                </div>
                <?php } ?>
              </div>
            </div>
            <!-- // Description -->
          </td>
          <!-- // Fee / Discount -->

          <!-- Controls -->
          <td class="pfd_controls">
            <table>
              <!-- One Step Up -->
              <tr>
                <td class="pfd_one_step_up">
                  <a onclick="pfdOneStepUp($(this));"><img src="view/image/peoplescode/pfd/pfd_one_step_up.png" alt="<?php echo $text_pfd_one_step_up; ?>" title="<?php echo $text_pfd_one_step_up; ?>"/></a>
                </td>
              </tr>
              <!-- Move Up -->
              <tr>
                <td class="pfd_up">
                  <a onmousedown="pfdMove();"><img src="view/image/peoplescode/pfd/pfd_up.png" alt="<?php echo $text_pfd_up; ?>" title="<?php echo $text_pfd_up; ?>"/></a>
                </td>
              </tr>
              <!-- Remove Row -->
              <tr>
                <td class="pfd_remove">
                  <a onclick="pfdRemove($(this));"><img src="view/image/peoplescode/pfd/pfd_remove.png" alt="<?php echo $text_pfd_remove; ?>" title="<?php echo $text_pfd_remove; ?>"/></a>    
                </td>
              </tr>
              <!-- Move Down -->
              <tr>
                <td class="pfd_down">
                  <a onmousedown="pfdMove();"><img src="view/image/peoplescode/pfd/pfd_down.png" alt="<?php echo $text_pfd_down; ?>" title="<?php echo $text_pfd_down; ?>"/></a>
                </td>
	            </tr>
              <!-- One Step Down -->
              <tr>
                <td class="pfd_one_step_down">
                  <a onclick="pfdOneStepDown($(this));"><img src="view/image/peoplescode/pfd/pfd_one_step_down.png" alt="<?php echo $text_pfd_one_step_down; ?>" title="<?php echo $text_pfd_one_step_down; ?>"/></a>
                </td>
              </tr>
            </table>
          </td>
          <!-- // Controls -->

	      </tr>
      </tbody>

      <?php $pc_fee_discount_id++; ?>
    <?php } ?>

      <tfoot>
	      <tr>
          <td colspan="4"></td>
          <td class="pfd_add">
            <!--Add Row -->
              <a onclick="pfdAddPaymentFee();"><img src="view/image/peoplescode/pfd/pfd_add.png" alt="<?php echo $text_pfd_add; ?>" title="<?php echo $text_pfd_add; ?>"/></a>
          </td>
	      </tr>
      </tfoot>
      </table>

      <table class="form">
	      <tr>
          <td><?php echo $entry_style; ?></td>
          <td><select name="pc_fee_discount_style">
              <?php if (isset($pc_fee_discount_style) && $pc_fee_discount_style) { ?>
                <option value="0"><?php echo $text_pfd_default; ?></option>
                <option value="1" selected="selected"><?php echo $text_pfd_light; ?></option>
              <?php } else { ?>
                <option value="0" selected="selected"><?php echo $text_pfd_default; ?></option>
                <option value="1"><?php echo $text_pfd_light; ?></option>
              <?php } ?>
              </select>
          </td>
	      </tr>
	      <tr>
          <td><?php echo $entry_status; ?></td>
          <td><select name="pc_fee_discount_status">
              <?php if (isset($pc_fee_discount_status) && $pc_fee_discount_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
              </select>
          </td>
	      </tr>
	      <tr>
          <td><?php echo $entry_sort_order; ?></td>
          <td><input type="text" name="pc_fee_discount_sort_order" value="<?php echo $pc_fee_discount_sort_order; ?>" size="1" /></td>
        </tr>
      </table> 

    </form>

    <div class="pfd_copy"><p><?php echo $heading_title; ?> - Version 1.2<br />Copyright &copy; 2013 <a href="mailto:info.peoplescode@gmail.com?Subject=Payment%20Fee/Discount" title="Support Email: info.peoplescode@gmail.com">People's Code</a>. All Rights Reserved.</p><p><a href="mailto:info.peoplescode@gmail.com?Subject=Payment%20Fee/Discount" title="Support Email: info.peoplescode@gmail.com" class="pfd_logo">People's<span>Code</span></a></p>
    </div>

    </div><!-- // .content -->

  </div><!-- // .box -->
</div><!-- // #content -->

<script type="text/javascript">
// Add Payment Fee
var pc_fee_discount_id = <?php echo $pc_fee_discount_id; ?>;

function pfdAddPaymentFee() {

  html  = '<tbody id="pc_fee_discount_id_' + pc_fee_discount_id + '">';
  html += '  <tr>';
  
  html += '    <!-- Conditions -->';
  html += '    <td class="left">';

  html += '      <!-- Shipping Method -->';
  html += '      <div>';
  html += '        <?php echo $entry_pfd_shipping; ?><br />';
  html += '        <div class="scrollbox">';
                     <?php $class = 'odd'; ?>
                     <?php foreach ($shipping_extensions as $extension) { ?>
                       <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
  html += '            <div class="<?php echo $class; ?>">';
  html += '              <input type="checkbox" name="pc_fee_discount_rows[' + pc_fee_discount_id + '][shippings_selected][]" value="<?php echo $extension['filename']; ?>" />';
  html += '              <?php echo addslashes($extension['name']); ?>';
  html += '            </div>';
                     <?php } ?>
  html += '        </div>';
  html += '        <a onclick="pfdSelectAll($(this));"><?php echo $text_select_all; ?></a> / <a onclick="pfdUnselectAll($(this));"><?php echo $text_unselect_all; ?></a>';
  html += '      </div>';
  html += '      <!-- // Shipping Method -->';

  html += '      <!-- Payment Method -->';
  html += '      <div>';
  html += '        <?php echo $entry_pfd_payment; ?><br />';
  html += '        <div class="scrollbox">';
                     <?php $class = 'odd'; ?>
                     <?php foreach ($payment_extensions as $extension) { ?>
                       <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
  html += '            <div class="<?php echo $class; ?>">';
  html += '              <input type="checkbox" name="pc_fee_discount_rows[' + pc_fee_discount_id + '][payments_selected][]" value="<?php echo $extension['filename']; ?>" />';
  html += '              <?php echo addslashes($extension['name']); ?>';
  html += '            </div>';
                     <?php } ?>
  html += '        </div>';
  html += '        <a onclick="pfdSelectAll($(this));"><?php echo $text_select_all; ?></a> / <a onclick="pfdUnselectAll($(this));"><?php echo $text_unselect_all; ?></a>';
  html += '      </div>';
  html += '      <!-- // Payment Method -->';

  html += '      <div class="pfd_dotted"></div>';
  html += '      <p class="myIndex"></p>';

  html += '    </td>';

  html += '    <td class="left">';

  html += '      <!-- Customer group -->';
  html += '      <div>';
  html += '        <?php echo $entry_pfd_customer_group; ?><br />';
  html += '        <div class="scrollbox">';
                     <?php $class = 'odd'; ?>
                     <?php foreach ($customer_groups as $customer_group) { ?>
                       <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
  html += '            <div class="<?php echo $class; ?>">';
  html += '              <input type="checkbox" name="pc_fee_discount_rows[' + pc_fee_discount_id + '][groups_selected][]" value="<?php echo $customer_group['customer_group_id']; ?>" />';
  html += '              <?php echo addslashes($customer_group['name']); ?>';
  html += '            </div>';
                     <?php } ?>
  html += '        </div>';
  html += '        <a onclick="pfdSelectAll($(this));"><?php echo $text_select_all; ?></a> / <a onclick="pfdUnselectAll($(this));"><?php echo $text_unselect_all; ?></a>';
  html += '      </div>';
  html += '      <!-- // Customer group -->';

  html += '    </td>';

  html += '    <td class="left">';

  html += '      <!-- Geo Zone -->';
  html += '      <div>';
  html += '        <?php echo $entry_pfd_geo_zone; ?><br />';

  html += '        <div class="scrollbox">';
                     <?php $class = 'odd'; ?>
                     <?php foreach ($geo_zones as $geo_zone) { ?>
                       <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
  html += '            <div class="<?php echo $class; ?>">';
  html += '              <input type="checkbox" name="pc_fee_discount_rows[' + pc_fee_discount_id + '][geo_zones_selected][]" value="<?php echo $geo_zone['geo_zone_id']; ?>" />';
  html += '              <?php echo addslashes($geo_zone['name']); ?>';
  html += '            </div>';
                     <?php } ?>
  html += '        </div>';
  html += '        <a onclick="pfdSelectAll($(this));"><?php echo $text_select_all; ?></a> / <a onclick="pfdUnselectAll($(this));"><?php echo $text_unselect_all; ?></a>';
  html += '      </div>';
  html += '      <!-- // Geo Zone -->';

  html += '      <!-- Shipping / Payment_address -->';
  html += '      <div class="pfd_dotted">';
  html += '        <?php echo $entry_pfd_cust_geo_zone; ?><br />';
  html += '        <select name="pc_fee_discount_rows[' + pc_fee_discount_id + '][address]">';
  html += '          <option value="0"><?php echo $text_pfd_shipping_address; ?></option>';
  html += '          <option value="1"><?php echo $text_pfd_payment_address; ?></option>';
  html += '        </select>';
  html += '      </div>';
  html += '      <!-- // Shipping / Payment address -->';

  html += '      <!-- Enable Fee -->';
  html += '      <div class="pfd_dotted pfd_error">';
  html += '        <?php echo $entry_pfd_enable_if; ?><br />';
  html += '        <select name="pc_fee_discount_rows[' + pc_fee_discount_id + '][enable_condition]">';
  html += '          <option value="0"><?php echo $text_pfd_sub_total; ?></option>';
  html += '          <option value="1"><?php echo $text_pfd_total; ?></option>';
  html += '        </select>';
  html += '		     <select name="pc_fee_discount_rows[' + pc_fee_discount_id + '][enable_more]">';
  html += '          <option value="0"><?php echo $text_pfd_enable_less; ?></option>';
  html += '          <option value="1"><?php echo $text_pfd_enable_more; ?></option>';
  html += '		     </select>';
  html += '		     <input type="text" name="pc_fee_discount_rows[' + pc_fee_discount_id + '][enable_amount]" value="" size="5" />';
  html += '      </div>';
  html += '      <!-- // Enable Fee -->';

  html += '      <div class="pfd_dotted"></div>';

  html += '    </td>';
  html += '    <!-- // Conditions -->';

  html += '    <!-- Fee / Discount -->';
  html += '    <td class="left">';

  html += '      <!-- Amount -->';
  html += '      <div class="pfd_error">';
  html += '        <?php echo $entry_pfd_amount; ?><br />';
  html += '        <select name="pc_fee_discount_rows[' + pc_fee_discount_id + '][percentage]">';
  html += '          <option value="0"><?php echo $text_pfd_fixed; ?></option>';
  html += '          <option value="1"><?php echo $text_pfd_percentage; ?></option>';
  html += '        </select>';
  html += '		     <input type="text" name="pc_fee_discount_rows[' + pc_fee_discount_id + '][fee]" value="" size="5" />';
  html += '      </div>';
  html += '      <!-- // Amount -->';

  html += '      <!-- Compute -->';
  html += '      <div class="pfd_dotted">';
  html += '        <?php echo $entry_pfd_compute; ?><br />';
  html += '        <select name="pc_fee_discount_rows[' + pc_fee_discount_id + '][serial]">';
  html += '          <option value="0"><?php echo $text_pfd_parallel; ?></option>';
  html += '          <option value="1"><?php echo $text_pfd_serial; ?></option>';
  html += '        </select>';
  html += '      </div>';
  html += '      <!-- // Compute -->';

  html += '      <!-- Tax Class -->';
  html += '      <div class="pfd_dotted">';
  html += '        <?php echo $entry_pfd_tax_class; ?><br />';
  html += '        <select name="pc_fee_discount_rows[' + pc_fee_discount_id + '][tax_class_id]">';
  html += '          <option value="0"><?php echo $text_none; ?></option>';
                   <?php foreach ($tax_classes as $tax_class) { ?>
  html += '          <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo addslashes($tax_class['title']); ?></option>';
                   <?php } ?>
  html += '        </select>';
  html += '      </div>';
  html += '      <!-- // Tax Class -->';

  html += '      <!-- Description -->';
  html += '      <div class="pfd_dotted">';
  html += '        <?php echo $entry_pfd_translations; ?><br />';
  html += '        <div class="scrollbox description">';
                   <?php foreach ($languages as $language) { ?>
  html += '          <div><input type="text" name="pc_fee_discount_rows[' + pc_fee_discount_id + '][description][<?php echo $language['language_id']; ?>]" value="" />';
  html += '            <img src="view/image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>"/>';
   html += '         </div>';
                   <?php } ?>
  html += '        </div>';
  html += '      </div>';
  html += '      <!-- // Description -->';

  html += '    </td>';
  html += '    <!-- // Fee / Discount -->';

  html += '    <!-- Controls -->';
  html += '    <td class="pfd_controls">';

  html += '      <table>';

  html += '        <!-- One Step Up -->';
  html += '        <tr>';
  html += '          <td class="pfd_one_step_up">';
  html += '            <a onclick="pfdOneStepUp($(this));"><img src="view/image/peoplescode/pfd/pfd_one_step_up.png" alt="<?php echo $text_pfd_one_step_up; ?>" title="<?php echo $text_pfd_one_step_up; ?>"/></a>';
  html += '          </td>';
  html += '        </tr>';
  html += '        <!-- // One Step Up-->';

  html += '        <!-- Move UP -->';
  html += '        <tr>';
  html += '          <td class="pfd_up">';
  html += '            <a onmousedown="pfdMove();"><img src="view/image/peoplescode/pfd/pfd_up.png" alt="<?php echo $text_pfd_up; ?>" title="<?php echo $text_pfd_up; ?>"/></a>';
  html += '          </td>';
  html += '        </tr>';
  html += '        <!-- // Move UP -->';

  html += '        <!-- Remove Row -->';
  html += '        <tr>';
  html += '          <td class="pfd_remove">';
  html += '            <a onclick="pfdRemove($(this));"><img src="view/image/peoplescode/pfd/pfd_remove.png" alt="<?php echo $text_pfd_remove; ?>" title="<?php echo $text_pfd_remove; ?>"/></a>';
  html += '          </td>';
  html += '        </tr>';
  html += '        <!-- // Remove Row -->';

  html += '        <!-- Move Down -->';
  html += '        <tr>';
  html += '          <td class="pfd_down">';
  html += '            <a onmousedown="pfdMove();"><img src="view/image/peoplescode/pfd/pfd_down.png" alt="<?php echo $text_pfd_down; ?>" title="<?php echo $text_pfd_down; ?>"/></a>';
  html += '          </td>';
  html += '        </tr>';
  html += '        <!-- // Move Down -->';

  html += '        <!-- One Step Down -->';
  html += '        <tr>';
  html += '          <td class="pfd_one_step_down">';
  html += '            <a onclick="pfdOneStepDown($(this));"><img src="view/image/peoplescode/pfd/pfd_one_step_down.png" alt="<?php echo $text_pfd_one_step_down; ?>" title="<?php echo $text_pfd_one_step_down; ?>"/></a>';
  html += '          </td>';
  html += '        </tr>';
  html += '        <!-- // One Step Down -->';

  html += '      </table>';

  html += '    </td>';
  html += '    <!-- // Controls -->';

  html += '  </tr>';

  html += '</tbody>';
  
  pc_fee_discount_id++;

  // Add Row Autoscroll
  $('#pfd_rows tfoot').before(html).prev().css({'background-color': '#B2D6F7'}).animate({'backgroundColor':'#fff'}, 1200);
  $('html, body').animate({scrollTop: $('#pfd_rows tfoot').prev().offset().top-50}, 1200);
  // END Add Row Autoscroll

  // Expand/Colapse checkboxes
  if (checkbox_state !== null) {
    if (checkbox_state > 0) {
      $('.scrollbox').addClass('pfd_expanded');
    } else {
      $('.scrollbox').removeClass('pfd_expanded');
    }
  } 
  // End Expand/Colapse checkboxes

  createIndex();
}
// END Add Payment Fee


  // Remove
  function pfdRemove(thisObj) {
    if (confirm('<?php echo $text_pfd_confirm; ?>')) {
      thisObj.parents('tbody').last().remove();
      createIndex();
     }
  }
  // END Remove


  // Enumerate Rows' Index
  function createIndex() {
    var i = 1;
    $('#pfd_rows').find('.myIndex').each(function(i) {
      $(this).replaceWith('<p class="myIndex">' + (i++ +1) + '</p>');
    });

    $('.pfd_one_step_up a, .pfd_one_step_down a, .pfd_up a, .pfd_down a').css('visibility', 'visible');
    $('#pfd_rows table').first().find('.pfd_one_step_up a, .pfd_up a').css('visibility', 'hidden');
    $('#pfd_rows table').last().find('.pfd_one_step_down a, .pfd_down a').css('visibility', 'hidden');
  }
  // END Enumerate Rows' Index


  // Expand/Colapse checkboxes
  var checkbox_state = null;

  function pfdExpand(thisObj) {
    $('.scrollbox').addClass('pfd_expanded');
    thisObj.replaceWith('<a onclick="pfdCollapse($(this));"><img src="view/image/peoplescode/pfd/pfd_collapse.png" alt="<?php echo $text_pfd_collapse; ?>" title="<?php echo $text_pfd_collapse; ?>"/></a>');
    checkbox_state = 1;
  }

  function pfdCollapse(thisObj) {
    $('.scrollbox').removeClass('pfd_expanded');
    thisObj.replaceWith('<a onclick="pfdExpand($(this));"><img src="view/image/peoplescode/pfd/pfd_expand.png" alt="<?php echo $text_pfd_expand; ?>" title="<?php echo $text_pfd_expand; ?>"/></a>');
    checkbox_state = 0;
  }
  // END Expand/Colapse checkboxes


  // Show/Hide Help
  $(function() {
    $('.hidden').hide();
    $('.toggle_info').click(function() {
      $('#pfd_info .hidden').eq($(this).index('.toggle_info')).slideToggle(500).siblings().slideUp(500);
    });
  });
  // END Show/Hide Help


  // UI Sortable
  $(function() {
    $('#pfd_rows table').first().find('.pfd_one_step_up a, .pfd_up a').css('visibility', 'hidden');
    $('#pfd_rows table').last().find('.pfd_one_step_down a, .pfd_down a').css('visibility', 'hidden');
  });

  function pfdMove() {
    // Retain same <td> Width when dragging
    var sameWidth = function(e, tbody) {
      // Allow sorting if more than one row exist
      var countRows = $("#pfd_rows tbody").length;

      if (countRows > 1) {
        var $originalState = tbody.find('td');
        tbody.find('td').each(function(index){$(this).width($originalState.eq(index).width())});
        return tbody;
      }
    }

    $('#pfd_rows').sortable({
      items: '> tbody',
      forcePlaceholderSize: true,
      placeholder: 'ui-state-highlight',
      opacity: 0.7,
      containment: 'parent',
      helper: sameWidth,
      out: function() {createIndex(); $('#pfd_rows').sortable('destroy');}
    });
  }
  // END UI Sortable


  // One Step Up/Down
  function pfdOneStepUp(thisObj) {
    var pfdMovable = thisObj.parents('tbody').last();
    pfdMovable.prev().before(pfdMovable.css({'background-color': '#B2D6F7'}).animate({'backgroundColor':'#fff'}, 1200));
    $('html, body').animate({scrollTop: $(pfdMovable).offset().top-50}, 1200);
    createIndex();
  }

  function pfdOneStepDown(thisObj) {
    var pfdMovable = thisObj.parents('tbody').last();
    pfdMovable.next().after(pfdMovable.css({'background-color': '#B2D6F7'}).animate({'backgroundColor':'#fff'}, 1200));
    $('html, body').animate({scrollTop: $(pfdMovable).offset().top-50}, 1200);
    createIndex();
  }
  // END One Step Up/Down


  // Select/Unselect Checkboxes
  function pfdSelectAll(thisObj) {
    thisObj.parent().find(':checkbox').attr('checked', true);
  }
  function pfdUnselectAll(thisObj) {
    thisObj.parent().find(':checkbox').attr('checked', false);
  }
  // END Select/Unselect Checkboxes

</script>

<?php echo $footer; ?>
