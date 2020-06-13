<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <div style="margin-bottom: 20px; overflow: auto;">
    <div style="float: left; width: 48%;">
      <div id="comprovante">
        <?php echo nl2br($text_comprovante); ?>
      </div>
      <div>&nbsp;</div>
      <div class="left">
        <a href="<?php echo $print; ?>" target="_blank" class="button"><?php echo $button_imprimir; ?></a>
      </div>
    </div>
    <div style="float: right; width: 48%">
      <?php echo $text_importante; ?>
    </div>
  </div>
  <?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>