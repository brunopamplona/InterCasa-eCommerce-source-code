<?php echo $header; ?>

<style type='text/css'>
table.form > tbody > tr > td:first-child {
	width: 300px;
}

.q-heading {
    margin-bottom: 10px;
    padding: 10px 10px 10px 33px;
    color: #555555;
    cursor: pointer;
}

.q-heading.red {
	border: 1px solid #F8ACAC;
	background-color: #FFD1D1;
}

.q-heading.green {
   background-color: #EAF7D9;
   border: 1px solid #BBDF8D;
}

.q-heading.loading {
	background-image: url(view/image/loading.gif);
	background-position: center;
	background-repeat: no-repeat;
}

.q-heading .lt {
	text-align: left;
	display: inline-block;
	width: 60%;
}

.q-heading .rt {
	text-align: right;
	display: inline-block;	
	width: 40%;
}

.q-content {
	margin-bottom: 5px;
	padding: 10px;
	display: none;
}

.q-content.red {
	border: 1px solid #F8ACAC;
}

.q-content.green {
	border: 1px solid #BBDF8D;
}

table.form > tbody > tr {
    border-bottom: 1px dotted #CCCCCC;
    color: #000000;
    padding: 10px;
}

table.form > tbody > tr > td:first-child {
    width: 200px;
}

table.form {
	width: 100%;
	text-align: left;
}

.htabs .buttons .button {
    background: none repeat scroll 0 0 #003A88;
    border-radius: 10px 10px 10px 10px;
    color: #FFFFFF;
    display: inline-block;
    padding: 5px 15px;
    text-decoration: none;
    font-weight: normal;
}

.pagination {
	border-top: none;
}

tr.ffSample {
        display: none;
}
</style>

<div id="content">
	<div class="breadcrumb">
	  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
	  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
	  <?php } ?>
	</div>
	
	<?php if ($success) { ?>
	<div class="success"><?php echo $success; ?></div>
	<?php } ?>
	
	<div class="warning" id="error" style="display: none"></div>
	
	<div class="box">
		<div class="heading">
	    	<h1><img src="view/image/module.png"/><?php echo $heading_title; ?></h1>
			<div class="buttons">
				<a class="button" id="saveSettings"><?php echo $button_save; ?></a>
				<a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a>
			</div>
	  	</div>
	  	<div class="content">
	     	<div id="tabs" class="htabs">
	     		<a href="#tab-questions"><?php echo $pq_questions; ?></a>
	     		<a href="#tab-settings"><?php echo $pq_settings; ?></a>
	     		<a href="#tab-sidebar"><?php echo $pq_sidebar; ?></a>
	     	</div>
	     	
	     	<!-- BEGIN QUESTIONS TAB -->
	     	<div id="tab-questions">
				<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
				
				<?php if (!empty($pqQuestions)) {
			        foreach($pqQuestions as $q) {
			        	$i = 0;	reset($q); $key = key($q); $qId = $q[$key]['question_id']; $pId = (isset($q[$key]['product_id']) ? $q[$key]['product_id'] : 0);
						if (strlen($q[$key]['question_text']) > 80) $theQuestion = substr(strip_tags($q[$key]['question_text']), 0, 80) . "..."; else $theQuestion = strip_tags($q[$key]['question_text']); ?>
			                <div>
			                <form action="index.php?route=module/productquestion/editquestion&token=<?php echo $token; ?>" method="post" enctype="multipart/form-data" id="pqForm<?php echo $qId; ?>">
							<div class="q-heading <?php echo (empty($q[$key]['answer_text']) ? 'red' : 'green'); ?>"><span class="lt"><?php echo '<b>' . $qId . '. ' . (isset($q[$key]['product_name']) ? $q[$key]['product_name'] . '.' : '') . '</b> ' . $theQuestion; ?></span><span class="rt"><?php echo $q[$key]['name'] . ' &lt;' . $q[$key]['email'] . '&gt; ' . date('d-m-Y, H:i:s', $q[$key]['create_time']); ?></span></div>
			                <div class="q-content <?php echo (empty($q[$key]['answer_text']) ? 'red' : 'green'); ?>">
								<input type='hidden' name='pq[<?php echo $i; ?>][product_id]' value='<?php echo $pId; ?>' id="pq<?php echo $qId; ?>pid"/>
								<input type='hidden' name='pq[<?php echo $i; ?>][question_id]' value='<?php echo $qId; ?>'/>						
								<div class="htabs" id="htabs<?php echo $qId; ?>">
									<?php foreach ($languages as $language) { ?>
									<a class="lang" href="#q<?php echo $qId; ?>language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
									<?php } ?>
									<div class="buttons" style="float: right"><a onclick="saveQuestion(<?php echo $qId; ?>)" class="button"><?php echo $text_save; ?></a><a onclick="deleteQuestion(<?php echo $qId; ?>)" class="button"><?php echo $text_delete; ?></a></div>
								</div>
								<?php
								foreach ($languages as $language) {
								$langId = $language['language_id'];
								$checked = (isset($q[$langId]) && $q[$langId]['display']) ? "checked = 'checked'" : '';
								?>
								<div id="q<?php echo $qId; ?>language<?php echo $langId; ?>">
								<input type="hidden" name='pq[<?php echo $i; ?>][language_id]' value="<?php echo $langId; ?>" />
				                <table class="form">
		
								<tr>					
			                        <td><?php echo $text_display; ?></td>
									<td><input type='checkbox' name='pq[<?php echo $i; ?>][display]' <?php echo $checked; ?> /></td>
								</tr>
		
				                <?php if ($i == 0) { ?>
								<tr>					
			                        <td><?php echo $text_product; ?></td>
									<td><input type="text" name='product' value="<?php echo isset($q[$langId]['product_name']) ? $q[$langId]['product_name'] : ''; ?>" id="pq<?php echo $qId; ?>" /></td>
							            <?php if (isset($error_product)) { ?>
							            	<span class="error"><?php echo $error_product; ?></span>
							            <?php } ?>						
								</tr>
								<?php } ?>
								
			                    <tr>
			                        <td><?php echo $text_question; ?></td>
									<td><textarea rows="5" cols="80" name='pq[<?php echo $i; ?>][question_text]'><?php echo isset($q[$langId]) ? htmlspecialchars($q[$langId]['question_text']) : ''; ?></textarea></td>
								</tr>
		
			                    <tr>
			                        <td><?php echo $text_answer; ?></td>
									<td><textarea class="ckeditor" name='pq[<?php echo $i; ?>][answer_text]' id='pq[<?php echo $qId; ?>][<?php echo $i; ?>][answer_text]'><?php echo isset($q[$langId]) ? htmlspecialchars($q[$langId]['answer_text']) : ''; ?></textarea></td>	                        
								</tr>
			                    </table>
			                	</div>
			               		<?php $i++;	} ?>	                    
			                </div>
			                </form>
							</div>
							<script type="text/javascript">
								CKEDITOR.replaceClass = 'ckeditor';
								$('#htabs<?php echo $qId; ?> a.lang').tabs();
							</script>
			        <?php } ?>
				<?php } else {
					echo "$text_no_questions_added</fieldset>";
				} ?>
				<div class="pagination"><?php echo $pagination; ?></div>
			</div>
			<!-- END QUESTIONS TAB -->
			
	     	<!-- BEGIN SETTINGS TAB -->
	     	<div id="tab-settings">
	     		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-settings">
				<table class="form">
					<tr>
						<td>
							<span><?php echo $text_questions_per_page; ?></span>
							<span class="help"><?php echo $text_questions_per_page_desc; ?></span>
						</td>
						<td>
							<input size="2" type="text" name="productquestion_conf_qpp" value="<?php echo $productquestion_conf_qpp; ?>" />
						</td>
					</tr>
	
					<tr>
						<td>
							<span><?php echo $text_max_question_length; ?></span>
							<span class="help"><?php echo $text_max_question_length_desc; ?></span>
						</td>
						<td>
							<input size="2" type="text" name="productquestion_conf_maxlen" value="<?php echo $productquestion_conf_maxlen; ?>" />
						</td>
					</tr>
	
					<tr>
						<td>
							<span><?php echo $text_email_for_notices; ?></span>
							<span class="help"><?php echo $text_email_for_notices_desc; ?></span>
						</td>
						<td>
							<input size="20" type="text" name="productquestion_conf_email" value="<?php echo $productquestion_conf_email; ?>" />
						</td>
					</tr>
				</table>
				</form>
			</div>
			<!-- END SETTINGS TAB -->
			
	     	<!-- BEGIN SIDEBAR TAB -->
	     	<div id="tab-sidebar">
	     		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-sidebar">
				<table id="module" class="list">
				<thead>
				<tr>
					<td class="left"><?php echo $pq_layout; ?></td>
					<td class="left"><?php echo $pq_position; ?></td>
					<td class="left"><?php echo $pq_status; ?></td>
					<td class="right"><?php echo $pq_sort_order; ?></td>
					<td></td>
				</tr>
				</thead>
				
				<tbody id="module-row">
					<!-- sample row -->
					<tr class="ffSample">
					<td class="left">
						<select name="productquestion_module[0][layout_id]">
							<?php foreach ($layouts as $layout) { ?>
							<option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
							<?php } ?>
						</select>
					</td>
					
					<td class="left"><select name="productquestion_module[0][position]">
						<?php /* ?>
						<option value="content_top"><?php echo $pq_content_top; ?></option>
						<option value="content_bottom"><?php echo $pq_content_bottom; ?></option>						
						<?php */ ?>
						<option value="column_left"><?php echo $pq_column_left; ?></option>
						<option value="column_right"><?php echo $pq_column_right; ?></option>
						</select>
					</td>
					 
					<td class="left">
						<select name="productquestion_module[0][status]">
							<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
							<option value="0"><?php echo $text_disabled; ?></option>
						</select>
					</td>
					
					<td class="right"><input type="text" name="productquestion_module[0][sort_order]" value="0" size="3" /></td>
					<td class="left"><a class="button ffRemove"><span><?php echo $button_remove; ?></span></a></td>
					</tr>
					<!-- end sample row -->
					
			        <?php $row = 1; ?>
			        <?php if (isset($modules) && is_array($modules)) { ?>
			        <?php foreach ($modules as $module) { ?>
					<tr>
					<td class="left">
						<select name="productquestion_module[<?php echo $row; ?>][layout_id]">
							<?php foreach ($layouts as $layout) { ?>
							<option value="<?php echo $layout['layout_id']; ?>" <?php if ($layout['layout_id'] == $module['layout_id']) { ?>selected="selected"<?php } ?>><?php echo $layout['name']; ?></option>
							<?php } ?>
						</select>
					</td>
					
					<td class="left"><select name="productquestion_module[<?php echo $row; ?>][position]">
						<?php /* ?>
						<option value="content_top" <?php if ($module['position'] == 'content_top') { ?> selected="selected"<?php } ?>><?php echo $pq_content_top; ?></option>
						<option value="content_bottom" <?php if ($module['position'] == 'content_bottom') { ?> selected="selected"<?php } ?>><?php echo $pq_content_bottom; ?></option>						
						<?php */ ?>
						<option value="column_left" <?php if ($module['position'] == 'column_left') { ?> selected="selected"<?php } ?>><?php echo $pq_column_left; ?></option>
						<option value="column_right" <?php if ($module['position'] == 'column_right') { ?> selected="selected"<?php } ?>><?php echo $pq_column_right; ?></option>
						</select>
					</td>
					 
					<td class="left">
						<select name="productquestion_module[<?php echo $row; ?>][status]">
							<option value="1" <?php if ($module['status']) { ?>selected="selected"<?php } ?>><?php echo $text_enabled; ?></option>
							<option value="0" <?php if (!$module['status']) { ?>selected="selected"<?php } ?>><?php echo $text_disabled; ?></option>
						</select>
					</td>
					
					<td class="right"><input type="text" name="productquestion_module[<?php echo $row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
					<td class="left"><a class="button ffRemove"><span><?php echo $button_remove; ?></span></a></td>
					</tr>
					<?php $row++; ?>
					<?php } ?>
					<?php } ?>
				</tbody>
				
				<tfoot>
				<tr>
					<td colspan="4" style="text-align: center"></td>
					<td class="left"><a class="button ffClone"><span><?php echo $button_add_module; ?></span></a></td>
				</tr>
				</tfoot>
				</table>
				</form>
	     	</div>
	     	<!-- END SIDEBAR TAB -->
	</div>
	
  </div>
</div>

<script type="text/javascript">
$('input[name=\'product\']').autocomplete({
	delay: 0,
	source: function(request, response) {
        var id = this.element.attr("id");
		$.ajax({
			<?php if (strcmp(VERSION,'1.5.1.3') >= 0) { ?>
				url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
	        <?php } else { ?>
				url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>',
				type: 'POST',
				data: 'filter_name=' +  encodeURIComponent(request.term),
	        <?php } ?>		
			dataType: 'json',
			success: function(data) {		
				response($.map(data, function(item) {
					return {
						id: id,
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
		
	},
	select: function(event, ui) {
		var id = ui.item.id;
		$('#'+id).val(ui.item.label);
		$('#'+id+'pid').val(ui.item.value);
		return false;
	}
});

function saveQuestion(qId) {
	$("#pqForm" + qId + ' textarea.ckeditor').each(function () {
		$(this).val(CKEDITOR.instances[$(this).attr('id')].getData());   
	});

    $.ajax({
    	type: "POST",
      	url: 'index.php?route=module/productquestion/editquestion&token=<?php echo $token; ?>',
      	data: $("#pqForm"+qId).serialize(),
      	dataType: 'json',
      	beforeSend: function() {
	      	$("#pqForm" + qId).find('.q-content').slideToggle('fast');
	      	$("#pqForm" + qId).find('.q-heading').addClass("loading");
      	},
      	complete: function() {
      		$("#pqForm" + qId).find('.q-heading').removeClass("loading").removeClass("red").addClass("green");
      		$("#pqForm" + qId).find('.q-content').removeClass("red").addClass("green");
      		$("#pqForm" + qId).find('.q-heading').effect("highlight", {color: '#BBDF8D'}, 2000);
      	},
      	success: function(json) {
      	}
    });
}

function deleteQuestion(qId) {
    $.ajax({
    	type: "GET",
      	url: 'index.php?route=module/productquestion/deletequestion&question_id='+ qId +'&token=<?php echo $token; ?>',
      	beforeSend: function() {
	      	$("#pqForm" + qId).find('.q-content').slideToggle('fast');
	      	$("#pqForm" + qId).find('.q-heading').addClass("loading");
      	},
      	complete: function() {
      		$("#pqForm" + qId).parent().fadeOut(500, function() { $("#pqForm" + qId).parent().remove(); });
      		//$("#pqForm" + qId).find('.q-heading').removeClass("loading");
      		//$("#pqForm" + qId).find('.q-heading').effect("highlight", {color: '#BBDF8D'}, 2000);
      	},
      	success: function(json) {
      	}
    });
}

$('.q-heading').bind('click', function() {
	if ($(this).hasClass('active')) {
		$(this).removeClass('active');
	} else {
		$(this).addClass('active');
	}
	
	$(this).parent().find('.q-content').slideToggle('slow');
	
});

$('body').delegate("a.ffRemove", "click", function() {
	$(this).parents('tr').remove();
});

$('body').delegate("a.ffClone", "click", function() {
	var lastRow = $(this).parents('table').find('tbody tr:last input:last').attr('name');
	if (typeof lastRow == "undefined") {
		var newRowNum = 1;
	} else {
		var newRowNum = parseInt(lastRow.match(/[0-9]+/)) + 1;
	}
	var newRow = $(this).parents('table').find('tbody tr.ffSample').clone();
	newRow.find('input,select').attr('name', function(i,name) {
		return name.replace('[0]','[' + newRowNum + ']');
	});
	
	$(this).parents('table').find('tbody').append(newRow.removeAttr('class'));
});

$('#tabs a').tabs();

$(function() {
	$("#saveSettings").click(function() {
		$("#error").html('').hide();
	    $.ajax({
			type: "POST",
			dataType: "json",
			url: 'index.php?route=module/productquestion/savesettings&token=<?php echo $token; ?>',
			data: $('#form-settings,#form-sidebar').serialize(),
			success: function(jsonData) {
				if (!$.isEmptyObject(jsonData.errors)) {
					jQuery.each(jsonData.errors, function(index, item) {
					    $("#error").append('<p>'+jsonData.errors[error]+'</p>').show();
					});
				} else {
					window.location.reload();
				}			
	       	}
		});
	});
});
</script> 

<?php echo $footer; ?>	
</div>
