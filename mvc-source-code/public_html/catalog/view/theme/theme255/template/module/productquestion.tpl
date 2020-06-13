<div class="tabs">
    <div class="tab-heading">Dúvidas e questões dos nossos clientes</div>
    <?php if (!empty($pqQuestions)) {
        foreach ($pqQuestions as $q) {
            ?>
            <div class="content">

                <div class="question">
                    <strong><?php echo $q['name'] ?></strong>
                    <p><?php echo htmlspecialchars($q['question_text']); ?></p>
                    <span class="answer"><?php echo ($q['answer_text']); ?></span>
                </div>
                <hr>
        <?php } ?>
        <div class="pagination"><?php echo $pagination; ?></div>
    <?php } else { ?>
        <div class="content empty"><?php echo $pq_no_questions_added; ?></div>
<?php } ?>

    <h2 id="question-title">Dúvidas? Deixe sua pergunta abaixo!</h2>
    <div class="form-horizontal">
       <div class="control-group">
            <label for="pqName" class="col-sm-2 control-label"><?php echo $pq_name; ?></label>
            <div class="controls"><input type="text" name="pqName" value="" id="pqName" class="form-control" /></div>
        </div>
        <div class="control-group">
            <label for="pqEmail" class="col-sm-2 control-label"><?php echo $pq_email; ?></label>
            <div class="controls"><input type="text" name="pqEmail" value="" id="pqEmail" class="form-control" /></div>
        </div>
        <div class="control-group" >
            <label for="pqText" class="col-sm-2 control-label"><?php echo $pq_question; ?></label>
            <div class="controls"><textarea name="pqText" id="pqText" cols="40" style="width:80%;" rows="8" class="form-control" <?php if ($productquestion_conf_maxlen > 0) echo "maxlength='$productquestion_conf_maxlen'" ?>></textarea></div>

        </div>

        <?php if ($pq_note): ?>
            <div class="control-group">
                <small><?php echo $pq_note; ?></small>
            </div>
        <?php endif ?>

        <div class="control-group">
            <div class="control-label link"><a id="pqSubmitBtn" class="button"><span><?php echo $button_continue; ?></span></a></div>

        </div>
    </div>

</div>

<script type="text/javascript">
    var pq_product_id = <?php echo $product_id; ?>;
    var pq_wait = '<?php echo $pq_wait; ?>';
</script>