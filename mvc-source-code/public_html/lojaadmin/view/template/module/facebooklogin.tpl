<?php echo $header; ?>
<div id="content" class="iModuleContent">
  <!-- START BREADCRUMB -->
  <?php require_once(DIR_APPLICATION.'view/template/module/facebooklogin/breadcrumb.php'); ?>
  <!-- END BREADCRUMB -->
  <!-- START FLASHMESSAGE -->
  <?php require_once(DIR_APPLICATION.'view/template/module/facebooklogin/flashmessage.php'); ?>
  <!-- END FLASHMESSAGE -->
  <div class="box">
    <div class="heading">
    <h1><img src="view/image/facebooklogin_icon.png" style="margin-top: -3px;" alt="" /> <span class="iModulesTitle"><?php echo $heading_title; ?></span>
      <?php 
        $dirname =  DIR_APPLICATION.'view/template/module/facebooklogin/';
      	$tab_files = scandir($dirname); 
        $tabs = array();
        foreach ($tab_files as $key => $file) {
        	if (strpos($file,'tab_') !== false) {
                $tabs[] = array(
                	'file' => $dirname.$file,
                	'name' => ucwords(str_replace('.php','',str_replace('_',' ',str_replace('tab_','',$file))))
                );
            } 
        }
        
      ?>
    <ul class="iModuleAdminSuperMenu">
	  <?php foreach($tabs as $tab): ?>
      	<li><?php echo $tab['name']; ?></li>
	  <?php endforeach; ?>
    </ul>
    </h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button submitButton"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <!-- START NOT ACTIVATED CHECK -->
    <?php require_once(DIR_APPLICATION.'view/template/module/facebooklogin/notactivated.php'); ?>
    <!-- END NOT ACTIVATED CHECK -->
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <ul class="iModuleAdminSuperWrappers">
	  <?php foreach($tabs as $tab): ?>
      	<li>
        	<?php require_once($tab['file']); ?>
      	</li>
	  <?php endforeach; ?>
      </ul>
      <input type="hidden" name="FacebookLogin[Activated]" value="Yes" />
	  <input type="hidden" class="selectedTab" name="selectedTab" value="<?php echo (empty($this->request->get['tab'])) ? 0 : $this->request->get['tab'] ?>" />
      <input type="hidden" class="selectedStore" name="selectedStore" value="<?php echo (empty($this->request->get['store'])) ? 0 : $this->request->get['store'] ?>" />
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
var selectedTab = $('.selectedTab').val();
$('.iModuleAdminSuperMenu li').removeClass('selected').eq(selectedTab).addClass('selected');
$('.iModuleAdminSuperWrappers > li').hide().eq(selectedTab).show();

$('.iModuleAdminMenu li').click(function() {
	$('.iModuleAdminMenu li',$(this).parents('li')).removeClass('selected');
	$(this).addClass('selected');
	$($('.iModuleAdminWrappers li',$(this).parents('li')).hide().get($(this).index())).fadeIn(200);
});

$('.iModuleAdminSuperMenu li').click(function() {
	$('.iModuleAdminSuperMenu > li',$(this).parents('h1')).removeClass('selected');
	$(this).addClass('selected');
	$($('.iModuleAdminSuperWrappers > li',$(this).parents('#content')).hide().get($(this).index())).fadeIn(200);
	$('.selectedTab').val($(this).index());
});
</script>
<?php echo $footer; ?>