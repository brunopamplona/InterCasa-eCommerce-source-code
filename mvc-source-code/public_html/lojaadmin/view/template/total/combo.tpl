<?php
//OpenCart Extension
//Project Name: OpenCart Combo/Bundle
//Author: Fanha Giang a.k.a fanha99
//Email (PayPal Account): fanha99@gmail.com
//License: Commercial
?>
<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/total.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="combo_status">
                <?php if ($combo_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="combo_sort_order" value="<?php echo $combo_sort_order; ?>" size="1" /></td>
          </tr>
		  <tr style="background: #EFEFEF; border: 1px solid #DDDDDD;">
			  <td colspan="2"><?php echo $text_for_product_page; ?></td>
		  </tr>
        <tr>
          <td><?php echo $entry_product_page_image; ?></td>
          <td>
			<?php echo $entry_width; ?><input type="text" name="combo_image_product_width" value="<?php echo $combo_image_product_width; ?>" size="3" /> x <?php echo $entry_height; ?><input type="text" name="combo_image_product_height" value="<?php echo $combo_image_product_height; ?>" size="3" />
		  </td>
        </tr>
          <tr>
            <td><?php echo $entry_only_key; ?></td>
			<td><input type="checkbox" name="combo_only_key" value="1" <?php if($combo_only_key) echo 'checked="checked"'; ?> /></td>
          </tr>
		  <tr style="background: #EFEFEF; border: 1px solid #DDDDDD;">
			  <td colspan="2"><?php echo $text_for_combo_page; ?></td>
		  </tr>
        <tr>
          <td><?php echo $entry_product_page_image; ?></td>
          <td>
			<?php echo $entry_width; ?><input type="text" name="combo_image_combo_width" value="<?php echo $combo_image_combo_width; ?>" size="3" /> x <?php echo $entry_height; ?><input type="text" name="combo_image_combo_height" value="<?php echo $combo_image_combo_height; ?>" size="3" />
		  </td>
        </tr>
		<tr style="background: #EFEFEF; border: 1px solid #DDDDDD;">
		  <td colspan="2"><?php echo $text_for_combos_page; ?></td>
		</tr>
          <tr>
            <td><?php echo $entry_stick_to_top; ?></td>
			<td><input type="checkbox" name="combo_stick_to_top" value="1" <?php if($combo_stick_to_top) echo 'checked="checked"'; ?> /></td>
          </tr>
          <tr>
            <td><?php echo $entry_append_category; ?></td>
			<td><input type="checkbox" name="combo_append_category" value="1" <?php if($combo_append_category) echo 'checked="checked"'; ?> /></td>
          </tr>
        </table>
	  <div id="combos-languages" class="htabs">
		<?php foreach ($languages as $language) { ?>
		<a href="#combos-language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
		<?php } ?>
	  </div>
	  <?php foreach ($languages as $language) { ?>
	  <div id="combos-language<?php echo $language['language_id']; ?>">
	  <table class="form">
		<tr>
		  <td><?php echo $entry_meta_keyword; ?></td>
          <td>
			<textarea name="combo_meta_keyword[<?php echo $language['language_id']; ?>]" cols="40" rows="5"><?php echo isset($combo_meta_keyword[$language['language_id']]) ? $combo_meta_keyword[$language['language_id']] : ''; ?></textarea>
		  </td>
		</tr>
		<tr>
		  <td><?php echo $entry_meta_description; ?></td>
          <td>
			<textarea name="combo_meta_description[<?php echo $language['language_id']; ?>]" cols="40" rows="5"><?php echo isset($combo_meta_description[$language['language_id']]) ? $combo_meta_description[$language['language_id']] : ''; ?></textarea>
		  </td>
		</tr>
	  </table>
	  </div>
	  <?php } ?>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#combos-languages a').tabs();
//--></script> 
<?php echo $footer; ?>