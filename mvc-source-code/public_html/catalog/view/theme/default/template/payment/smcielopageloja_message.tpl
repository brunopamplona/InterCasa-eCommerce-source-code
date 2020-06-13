<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div style='max-width: 800px; margin: 0 auto; text-align: center;'>
    <h1><?php echo $heading_title; ?></h1>
    <?php echo $text_message; ?>

    <?php if($retornocielo){ ?>
    <fieldset>
      <legend>Resposta:</legend>
      <?php echo $retornocielo; ?>
    </fieldset>
    <?php } ?>
  </div>
  <div class="buttons" style='text-align: center;'>
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
  <script charset="utf-8">
      /* <![CDATA[ */
        var google_conversion_id = 1066018175;
        var google_conversion_language = "en";
        var google_conversion_format = "2";
        var google_conversion_color = "ffffff";
        var google_conversion_label = "RVgaCLqVmlYQ_8qo_AM";
        var google_remarketing_only = false;
    /* ]]> */
  </script>
<?php echo $footer; ?>
