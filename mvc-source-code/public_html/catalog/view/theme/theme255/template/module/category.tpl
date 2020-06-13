<!--<script type="text/javascript">
$(document).ready(function() {
	$('li.cat-header ul').each(function(index) {
 $(this).prev().addClass('idCatSubcat')});
 $('li.cat-header a').after('<span></span>'); 
 $('li.cat-header ul').css('display','none');
 $('li.cat-header ul.active').css('display','block');
 $('li.cat-header ul').each(function(index) {
   $(this).prev().addClass('close').click(function() {
  if (
   $(this).next().css('display') == 'none') {
   $(this).next().slideDown(400, function () {
   $(this).prev().removeClass('collapsed').addClass('expanded');
    });
  }else {
    $(this).next().slideUp(400, function () {
   $(this).prev().removeClass('expanded').addClass('collapsed');
   $(this).find('ul').each(function() {
    $(this).hide().prev().removeClass('expanded').addClass('collapsed');
   });
    });
  }
  return false;
   });
});
 });
</script>-->
<div class="box category">
	<div class="box-heading"><?php echo $heading_title; ?>/div>
  <div class="box-content">
  
    <div class="box-category">
      <ul>
        <?php foreach ($categories as $category) { ?>
        <?php if ($category['category_id'] == $category_id) { ?>
        <li class="active cat-header <?php if ($category['children']) { ?>parent<?php } ?>">
        <?php } else { ?>
        <li class="cat-header <?php if ($category['children']) { ?>parent<?php } ?>">
        <?php } ?>
          <?php if ($category['category_id'] == $category_id) { ?>
          <a href="<?php echo $category['href']; ?>" class="active"><?php echo $category['name']; ?></a>
          <?php } else { ?>
          <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
          <?php } ?>
          <?php if ($category['children']) { ?>

            <?php for ($i = 0; $i < count($category['children']);) { ?>
            <?php if ($category['category_id'] == $category_id) { ?>
            <ul class="active">
            <?php } else { ?>
            <ul>
            <?php }?>
              <?php $j = $i + count($category['children']); ?>
              <?php for (; $i < $j; $i++) { ?>
              <?php if (isset($category['children'][$i])) { ?>
              <?php $id=$category['children'][$i]['category_id'];?>
              <?php if ( $id == $child_id) { ?>
              <li class="active <?php if ($category['children'][$i]['children3']) {?> parent<?php } ?>">
                <?php } else { ?>
              <li class="<?php if ($category['children'][$i]['children3']) {?> parent<?php } ?>">
                <?php } ?>
                <?php if ($category['children'][$i]['children3']) {?>
                <a  href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name'];?></a>
                <?php if ( $id == $child_id) { ?>
                <ul class="active">
               	<?php } else { ?>
                <ul>
                <?php }?>
                  <?php foreach ($category['children'][$i]['children3'] as $ch3) { ?>
                  <li>
                    <?php if ($ch3['category_id'] == $ch3_id) { ?>
                    <a href="<?php echo $ch3['href']; ?>" class="active"><?php echo $ch3['name']; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $ch3['href']; ?>"><?php echo $ch3['name']; ?></a> 
                    <?php } ?>
                  </li>
                  <?php } ?>
                </ul>
                <?php } else {?>
                <a  href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name'];?></a>
              <?php }?>
              </li>
              <?php } ?>
              <?php } ?>
            </ul>
            <?php } ?>
      <?php } ?>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
