<div class="box" id="pqsBlockLeft">
	<div class="box-heading"><?php echo $pqs_ask; ?></div>
	<div class="box-content">
		<form method="post" action="" id="qForm">
			<label for="pqsName"><?php echo $pqs_name; ?></label>
			<input type="text" id="pqsName" name="pqsName" maxlength="32" value="<?php echo $pqsName; ?>" />

			<label for="pqsEmail"><?php echo $pqs_email; ?></label>
			<input type="text" id="pqsEmail" name="pqsEmail" maxlength="128" value="<?php echo $pqsEmail; ?>"/>
			
			<textarea id="pqsText" name="pqsText" <?php if ($productquestion_conf_maxlen > 0) echo "maxlength='$productquestion_conf_maxlen'"?>><?php echo $pqs_your_question_here; ?></textarea>

			<input type="hidden" name="pqsSubmit" value="pqsSubmit" id="pqsSubmit"/>
			
			<p class="warning" id="pqsError" style="display: none"></p>
			<p class="cont"><a class="button" id="pqsSubmitBtn"><span><?php echo $pqs_ask_button; ?></span></a></p>
			<p class="cont"><a id="pqsView" href="index.php?route=module/productquestion/questions"><?php echo $pqs_read_questions; ?></a></p>
		</form>
	</div>
</div>

<script type="text/javascript">
	var pq_wait = '<?php echo $pq_wait; ?>';
</script>