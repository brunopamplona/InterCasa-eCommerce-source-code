<?php if (!empty($this->session->data['success'])) { ?>
<div class="success autoSlideUp"><?php echo $this->session->data['success']; ?></div>
<script type="text/javascript">
	$('.autoSlideUp').delay(3000).fadeOut(600, function(){ $(this).show().css({'visibility':'hidden'}); }).slideUp(600);
</script>
<?php unset($this->session->data['success']); } ?>
<?php if (!empty($this->session->data['error'])) { ?>
<div class="warning"><?php echo $this->session->data['error'];
unset($this->session->data['error']); ?></div>
<?php } ?>
