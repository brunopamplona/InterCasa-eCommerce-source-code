<!DOCTYPE html>
<!--[if lt IE 7]>      <html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="no-js"> <!--<![endif]-->
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="google-site-verification" content="sLB-LI-dx3DypQCSy63_LkKN6DXcvZusQelGdxtIu0g" />    
    

<title><?php echo $title; ?> - InterCasa Móveis Online</title>
<base href="<?php echo $base; ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Cache-Control" content="max-age=1209600">
<meta name="google-site-verification" content="75P4pkEOOhfw9aPB-QrKeWvLJvzkJ9SBEO2wAEzpqLM" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>

<!-- Facebook Open Graph Tags -->
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:site_name" content="<?php echo $store; ?>" />
<meta property="og:description" content="<?php echo $description; ?>" />
<?php  
$og_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$og_url = str_replace("%2F", "/", $og_url);
$og_url = str_replace("%3B", ";", $og_url);
$og_url = str_replace("&amp;", "&", $og_url);
?>
<meta property="og:url" content="<?php echo $og_url; ?>" />
<?php
if(isset($og_images)):
foreach($og_images as $im): ?>
<meta property="og:image" content="<?php echo $im; ?>" />
<link rel="image_src" href="<?php echo $im; ?>" />
<?php endforeach; endif; ?>
<?php if ( isset($image['thumb']) ) { // zobrazi nahled produktu, pokud je otevrena stranka s produktem ?>
<meta property="og:type" content="product" />
<meta property="og:image" content="<?php echo HTTP_SERVER . $image['thumb']; ?>" />
<link rel="image_src" href="<?php echo HTTP_SERVER . $image['thumb']; ?>" />
<?php } ?>

<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<!--<meta property="fb:admins" content="{YOUR_FACEBOOK_USER_ID}"/>-->

<script>
    if (navigator.userAgent.match(/Android/i)) {
        var viewport = document.querySelector("meta[name=viewport]");
        
    }
 if(navigator.userAgent.match(/Android/i)){
    window.scrollTo(0,1);
 }
</script>

<meta property="fb:app_id" content="225164554355533"/>






<!-- Custom 12-09-2017 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/custom-12-09-2017.css" rel="stylesheet" type="text/css" />





<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-568BZZC');</script>
<!-- End Google Tag Manager -->






<script src="//seal.globessl.com/seal.js"></script>
<link href="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/stylesheet/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template'); ?>/stylesheet/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/cloud-zoom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/stylesheet.css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/superfish.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/font-awesome.css" rel="stylesheet" type="text/css" />


<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/slideshow.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/jquery.prettyPhoto.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/camera.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/responsive.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/photoswipe.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/jquery.bxslider.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/modal.css" rel="stylesheet" type="text/css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.cycle.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
<!--[if IE]>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fancybox/jquery.fancybox-1.3.4-iefix.js"></script>
<![endif]-->
<!--[if IE]>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/html5.js"></script>
<![endif]-->
<!--[if lt IE 8]><div style='clear:both;height:59px;padding:0 15px 0 15px;position:relative;z-index:10000;text-align:center;'><a href="https://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="https://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div><![endif]-->
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/bootstrap/bootstrap.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/common.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/jQuery.equalHeights.js"></script>
<script type="text/JavaScript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/cloud-zoom.1.0.2.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/jscript_zjquery.anythingslider.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/superfish.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/script.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/nivo-slider/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/jquery.mobile-events.js"></script>
<!--[if !IE]>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js//sl/jquery.mobile.customized.min.js"></script>
<![endif]-->
<!--[if IE]>
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js//sl/jscript_zjquery.anythingslider.js"></script>
<![endif]-->
<script type="text/javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/sl/camera.js"></script>
<!-- include jQuery + carouFredSel plugin -->
<!--<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fredsel/jquery.carouFredSel-6.2.1.js"></script>-->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<!-- optionally include helper plugins -->
<!--<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fredsel/helper-plugins/jquery.mousewheel.min.js"></script>
<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fredsel/helper-plugins/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fredsel/helper-plugins/jquery.transit.min.js"></script>
<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/fredsel/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>-->
<!-- ---------------bx-slider---------------------->
<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/bxslider/jquery.bxslider.js"></script>
<!-- ---------------photo swipe---------------------->
<!--<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/photo-swipe/code.photoswipe-3.0.5.min.js"></script>-->
<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/photo-swipe/klass.min.js"></script>
<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/photo-swipe/code.photoswipe.jquery-3.0.5.js"></script>
<script type="text/javascript" language="javascript" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/js/plugins.min.js"></script>
















<!--Scroll bar -->
<script type="text/javascript"> 

//$(window).scroll(function(){$(".flutuant-nav").css("opacity", 100 - $(window).scrollTop() / 0);}); 


 var scroll_transparency = false;

 $(window).scroll(function() {

    // $('div.navbar-main-top').hide(500);

    if ($(window).scrollTop() == 0) {
        scroll_transparency = false;
        $('div.flutuant-nav').fadeTo( "fast", 0 );
        $('div.flutuant-nav').css('display','none');

    } else {
        if (scroll_transparency == false) {
            $('div.flutuant-nav').fadeTo( "fast", 1 );
            scroll_transparency = true;
        }
    }
});

</script>







<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if  IE 8]>
	<style>
		.success, #header #cart .content  { border:1px solid #000080;}
		#search{ display: none;}
	</style>
<![endif]-->
<!--[if  IE 8]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $this->config->get('config_template');?>/stylesheet/livesearch.css"/>
<?php if ($stores) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
<?php foreach($stores as $store){ ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
});
//--></script>
<?php } ?>
<?php echo $google_analytics; ?>

	<!--[if lt IE 9]>
	<style>
		#search{ display: none !important;}
	</style>
	<![endif]-->
	
	
	

	
<script>
    
     
			$(document).ready(function() {
				//responsive menu toggle
				$("#menutoggle").click(function() {
					$('.xs-menu').toggleClass('displaynone');

					});
				//add active class on menu
				$('ul li').click(function(e) {
					e.click();
					$('li').removeClass('active');
					$(this).addClass('active');
				});
			
			        //drop down menu
			        
					$(".drop-down").hover(function() {
						$('.mega-menu').addClass('display-on');
					});
					$(".drop-down").mouseleave(function() {
						$('.mega-menu').removeClass('display-on');
					});
					
					
					
					
					
					$(".drop-downfirst").hover(function() {
					$('.mega-menufirst').addClass('display-on');
					});
					
					$(".drop-downfirst").mouseleave(function() {
						$('.mega-menufirst').removeClass('display-on');
					});
					
					
					
					
					
					$(".drop-downtwo").hover(function() {
						$('.mega-menutwo').addClass('display-on');
					});
					$(".drop-downtwo").mouseleave(function() {
						$('.mega-menutwo').removeClass('display-on');
					});
					
					
					$(".drop-downthree").hover(function() {
						$('.mega-menuthree').addClass('display-on');
					});
					$(".drop-downthree").mouseleave(function() {
						$('.mega-menuthree').removeClass('display-on');
					});
					
					
					
					
					$(".drop-downfor").hover(function() {
						$('.mega-menufor').addClass('display-on');
					});
					$(".drop-downfor").mouseleave(function() {
						$('.mega-menufor').removeClass('display-on');
					});
					 //drop down menu
					
					
					
					
					
					
					
					$(".two").hover(function() {
						$('.mega-menu-search').addClass('display-on');
					});
					
					
					$(" .two").mouseleave(function() {
						$('.mega-menu-search').removeClass('display-on');
					});
					
					
			
			});

	 
    
    
    
</script>	
	
	
	
	
	
	
	<link rel="stylesheet" href="https://fontawesome.io/assets/font-awesome/css/font-awesome.css">
	<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/36d78fbb22885a453667c8257/6ce742ba82d25e71d72d50710.js");</script>
	
<!--MRS_PLACEHOLDER-->
</head>
<body class="<?php echo empty($this->request->get['route']) ? 'common-home' : str_replace('/', '-', $this->request->get['route']); ?>"><a id="hidden" href="<?php echo $base; ?>"></a>
   
   
   
   <?php  $teste = isset($_GET['teste'])?$_GET['teste']:0; ?>
  <div class="top-blue">
    <!-- MENU -->
    <div class="container">
    <div class="row">
        
        <div class="span12">
            
            <div class="cont-top">
                
                <div class="box-cont">
                    <div class="box-top-tel"><span><img width="23" height="23" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/blue-business-phone-mobile-01.jpg"> <img width="23" height="20" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/whats-mobile-01.jpg"></span>
                    </div>
                </div>
                   
                    
                <div class="box-cont">
                    <div class="logo"><a href="https://intercasamoveis.com.br"><img width="184" height="85" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/INTERLOGO-HD5.jpg" align="middle"></a>
                    </div>
                </div>
            
                <div class="box-cont">
                    <div class="box-phone">
                
                        <span><img width="23" height="23" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/blue-business-phone-solid-icon-26.jpg"><font color="#FFFFFF" size="2">  | <i class="fa fa-whatsapp"></i> <img width="23" height="23" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/whats.jpg"></font></span>
                
                    </div>
                </div>
        
            </div>
        </div>
        
        <div class="span12">
            
            <div class="container">
			
			<div class="xs-menu-cont">
			    
			<a id="menutoggle"><i class="fa fa-align-justify"></i> </a>
			<div class="box-icons-menu">
			    <div class="btn-yellow" href="#myModal" role="button" data-toggle="modal"><i class="fa fa-envelope"></i></div>
			    <a href="https://intercasamoveis.com.br/index.php?route=checkout/checkout"><div class="btn-blue"><i class="fa fa-shopping-cart"></i></div></a>
			    <a href="https://intercasamoveis.com.br/index.php?route=account/login"><div class="btn-blue"><i class="fa fa-user"></i></div></a>
			</div>
			
				<nav class="xs-menu displaynone">
					<ul>
					    <?php foreach($categories as $category):?>
					    
						<li class="active">
							<a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
						</li>
						<?php endforeach;?>

					</ul>
				</nav>
			</div>
			<nav class="menu">
			    <!--div class="logo-top"><img src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/logo-bar.png"/></--> 
				<ul>
				    
				    
				    
				    
				    
				    
				    
				    <!-- Menu -->
				    <?php $cv = 1;?>
				    <?php $position = 1; foreach($categories as $category):?>
				    
				    <?php $num = $position++ ?>
				    <?php if($category['category_id']): ?>
				    <?php $cv++ ?>
                    
				    
				    <li class="<?php switch($num){ 
				     case 1: echo 'drop-downfirst'; 
				     break;
				     case 2: echo 'drop-downtwo'; 
				    break;
				     case 3: echo 'drop-downthree'; 
				     break;
				     case 4: echo 'drop-downfor'; 
				     break;
				     } ?>">
				        <a href="#"><font size="2"><?php echo $category['name']; ?></font></a>
				        <div class="
				        
				        <?php 
				    switch($num){
				     case 1: 
				        echo 'mega-menufirst';
				     break;
				     case 2: 
				        echo 'mega-menutwo'; 
				     break;
				     case 3: 
				        echo 'mega-menuthree'; 
				     break;
				     case 4: 
				        echo 'mega-menufor'; 
				     
				     
				    } 
				    
				    ?>
				        
				        
				        fadeIn animated">
				        <div class="row">
				            <div class="container">
				            <div class="span4">
				                
				                
				                
				                
							        <div class="category-cont">
							         <a href="<?php echo $category['href']; ?>"> <img width="280" height="280" src="<?php echo $category['thumb'] ?>"></a>
							            <h4>  <?php echo $category['name']; ?></h4>
							       </div>
							    
				                
				                
				                
				                
				                
				            </div>
				            <div class="span6">
				                
				                
				                
				                
				        

						
						
						
						<div class="span12">
							<span class="categories-list-small">
						        <ul>
						
						
						
						<?php if ($category['category_id'] == $category_id) { ?>
						<li class="active cat_<?php echo $cv ?>">
						<?php } else { ?>
						<li class="cat_<?php echo $cv ?>">
						<?php } ?>
						<a href="<?php echo $category['href']; ?>"><span><font size="4"><?php echo $category['name']; ?></font></span></a>
						<?php if ($category['children']) { ?>
					
								<?php for ($i = 0; $i < count($category['children']);) { ?>
								<ul>
								<?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
								<?php for (; $i < $j; $i++) { ?>
								<?php if (isset($category['children'][$i])) { ?>
								<?php $id=$category['children'][$i]['category_id'];?>
								<?php if ( $id == $child_id) { ?>
								<li class="active">
									<?php } else { ?>
								<li>
									<?php } ?>
									<?php if ($category['children'][$i]['children3']) {?>
									<a class="screenshot1"  href="<?php echo $category['children'][$i]['href']; ?>"><font size="4"><?php echo $category['children'][$i]['name'];?></font></a>
									<ul>
									<?php foreach ($category['children'][$i]['children3'] as $ch3) { ?>
									<li>
										<?php if ($ch3['category_id'] == $ch3_id) { ?>
										<a href="<?php echo $ch3['href']; ?>" class="active"><font size="4"><?php echo $ch3['name']; ?></font></a>
										<?php } else { ?>
										<a href="<?php echo $ch3['href']; ?>"><?php echo $ch3['name']; ?></a>
										<?php } ?>
									</li>
									<?php } ?>
									</ul>
									<?php } else {?>
									<a class="screenshot1"  href="<?php echo $category['children'][$i]['href']; ?>"><img width="9" height="9" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/icone-menu.jpg"><font size="2"><?php echo $category['children'][$i]['name'];?></font></a>
								<?php }?>
								</li>
								<?php } ?>
								<?php } ?>
								</ul>
								<?php } ?>
						<?php } ?>
						</li>
						
						
							</ul>
						</span>	
						</div>
						
                        						
						
				                
				                
				                
				                
				                
				                
				                
				                
				                
				            </div>    
				            </div>
				            
				        </div>
				        
				        </div>
				        
				        </li>
				        <?php endif;?>
				        <?php endforeach;?>
				    
				    
				     <!-- Menu -->
				    
				    
				    
				   
				    
				    
					
					<!--li class="drop-down">
						<a href="#">Categorias</a>
					 
						<div class="mega-menu fadeIn animated">
						    <div class="row">
						        <div class="container">
							
							
							
							
							<?php $cv=0;?>
						<?php foreach ($categories as $category) { $cv++; ?>
						<div class="mm-3column">
							<span class="categories-list">
						        <ul>
						
						
						
						<?php if ($category['category_id'] == $category_id) { ?>
						<li class="active cat_<?php echo $cv ?>">
						<?php } else { ?>
						<li class="cat_<?php echo $cv ?>">
						<?php } ?>
						<a href="<?php echo $category['href']; ?>"><span><?php echo $category['name']; ?></span></a>
						<?php if ($category['children']) { ?>
					
								<?php for ($i = 0; $i < count($category['children']);) { ?>
								<ul>
								<?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
								<?php for (; $i < $j; $i++) { ?>
								<?php if (isset($category['children'][$i])) { ?>
								<?php $id=$category['children'][$i]['category_id'];?>
								<?php if ( $id == $child_id) { ?>
								<li class="active">
									<?php } else { ?>
								<li>
									<?php } ?>
									<?php if ($category['children'][$i]['children3']) {?>
									<a class="screenshot1"  href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name'];?></a>
									<ul>
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
									<a class="screenshot1"  href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name'];?></a>
								<?php }?>
								</li>
								<?php } ?>
								<?php } ?>
								</ul>
								<?php } ?>
						<?php } ?>
						</li>
						
						
							</ul>
						</span>	
						</div>
						
						
						<?php } ?>
							
							
							
							
						</div>
						</div>
					</div>
			 
					</li-->
					
					

					
                 
                  
                  
                  
                  <li style="float:right;" class="two">
                   <a href=""><i class="fa fa-search"></i></a>
                   <div class="mega-menu-search fadeIn animated">
                       <div class="row">
                           <div class="container">
                               <form action="#" method="get">
                               <div class="search-box-mega">
                                   <input type="hidden" name="route" value="<?php echo $this->request->get['route'] = 'product/search' ?>">
                                   <input type="text" name="search" placeholder="Pesquisar..." />
                               </div>
                               </form>
                           </div>
                           
                       </div>
                  </div>
                   
                  </li>
                  
                  <li style="float:right;"><a href="https://intercasamoveis.com.br/blog"><i class="fa fa-wordpress"></i><font size="2">&nbsp;&nbsp;&nbsp;Inspira Blog</font></a></li>
                  <li style="float:right;">
                      <a href="https://intercasamoveis.com.br/index.php?route=checkout/cart"><i class="fa fa-shopping-cart"></i><font size="2">&nbsp;&nbsp;&nbsp;Seu Carrinho</font></a>
                      
                  </li>
                  
                  <li style="float:right;">
                      <a href="https://intercasamoveis.com.br/index.php?route=account/login"><i class="fa fa-user"></i><font size="2">&nbsp;&nbsp;&nbsp;Sua Conta</font></a>
                      
                  </li>
                  
                  

				</ul>
			</nav>
		</div>
		
		<!--- MENU -->
            
            
            
        </div>
        
    </div>
    </div>
    
</div>
<div class="top-info-bar">
    <div class="row">
    
        <div class="container">
            <div class="ico-box">
        
                <div class="box-left">
                    <i class="fa fa-wrench"></i>
                </div>
                <div class="box-right">
                    <a href="https://intercasamoveis.com.br/montagem"><h3>MONTAGEM GRÁTIS</h3></a>
                    <small><a href="https://intercasamoveis.com.br/entregas_e_fretes">*  Rio e Sampa Capital</a></small>
                </div>
        
            </div>
    
    
        <div class="ico-box">
        
      <div class="box-left">
          <i class="fa fa-truck"></i>
      </div>
      <div class="box-right">
          <a href="https://intercasamoveis.com.br/entregas_e_fretes"><h3>FRETE REDUZIDO</h3></a>
          <small><a href="https://intercasamoveis.com.br/entregas_e_fretes">*  Rio e Sampa Capital</a></small>
      </div>
        
    </div>
    
    
    
        <div class="ico-box">
        
      <div class="box-left">
          <i class="fa fa-phone"></i>
      </div>
      <div class="box-right">
          <a href="https://intercasamoveis.com.br/index.php?route=information/contact"><h3>ORÇAMENTOS</h3></a>
          <small><a href="mailto:atendimento@intercasamoveis.com.br">Peça Aqui!</small></a>
      </div>
        
    </div>
    
    <div class="ico-box">
        
      <div class="box-left">
          <i class="fa fa-home"></i>
      </div>
      <div class="box-right">
          <a href="https://intercasamoveis.com.br/showrooms"><h3>SHOWROOMS</h3></a>
          <small><a href="https://intercasamoveis.com.br/showrooms">Conheça aqui!</a></small>
      </div>
        
    </div>
   
    
    </div>
    </div>
</div>





<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-545b7a830e463b8d" async="async"></script>

<div class="swipe-left"></div>
<div id="body">
    
    
    
 
<div class="row display-none">
    <div class="flutuant-nav">
        
        
        
        
        
        
        
        
   <!--Google -Fonts-->
		<link href='https://fonts.googleapis.com/css?family=Sintony:400,700&subset=latin-ext' rel='stylesheet' type='text/css'>
		
<!--Font-awsome-->
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">




<div class="container">
		
				
			
			
			<div class="xs-menu-cont">
			    
			<a id="menutoggle"><i class="fa fa-align-justify"></i> </a>
				<nav class="xs-menu displaynone">
					<ul>
						<!-- lista -->
				    <?php foreach($categories as $category):?>
					    
						<li class="active">
							<a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?> </a>
						</li> 
						<?php endforeach;?>
				    <!-- lista -->

					</ul>
				</nav>
			</div>
			<nav class="menu">
			    <div class="logo-top"><img src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/logo-bar.png"/></div> 
				<ul>
				
					<li class="drop-down">
						<a href="#">Categorias</a>
					 
						<div class="mega-menu fadeIn animated">
							<div class="mm-6column">
							
							<div class="row">
							    
							    
							    
							    <?php foreach ($categories as $category) {  ?>
							    
							    
							    
							    
							    
							    <div class="span2">
							        <div class="category-cont">
							       <a href="<?php echo $category['href']; ?>"> <img width="280" height="280" src="<?php echo $category['thumb'] ?>"></a>
							       <h4> <?php echo $category['name']; ?> </h4>
							       </div>
							    </div>
							    
							    
							    
							    
							    <?php } ?>
							    
							    
							    
							    
							    
							</div>
								
							
							</div>
							
							
								
								
							
							 
								
							
							
							
							
							
						
								
								
								
								
								
								<?php $cv=0;?>
						<?php foreach ($categories as $category) { $cv++; ?>
						<div class="mm-3column">
							<span class="categories-list">
						        <ul>
						
						
						
						<?php if ($category['category_id'] == $category_id) { ?>
						<li class="active cat_<?php echo $cv ?>">
						<?php } else { ?>
						<li class="cat_<?php echo $cv ?>">
						<?php } ?>
						<a href="<?php echo $category['href']; ?>"><span><?php echo $category['name']; ?></span></a>
						<?php if ($category['children']) { ?>
					
								<?php for ($i = 0; $i < count($category['children']);) { ?>
								<ul>
								<?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
								<?php for (; $i < $j; $i++) { ?>
								<?php if (isset($category['children'][$i])) { ?>
								<?php $id=$category['children'][$i]['category_id'];?>
								<?php if ( $id == $child_id) { ?>
								<li class="active">
									<?php } else { ?>
								<li>
									<?php } ?>
									<?php if ($category['children'][$i]['children3']) {?>
									<a class="screenshot1"  href="<?php echo $category['children'][$i]['href']; ?>"><font size="4"></font><?php echo $category['children'][$i]['name'];?></font></a>
									<ul>
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
									<a class="screenshot1"  href="<?php echo $category['children'][$i]['href']; ?>"><img width="9" height="9" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/icone-menu.jpg"><?php echo $category['children'][$i]['name'];?></a>
								<?php }?>
								</li>
								<?php } ?>
								<?php } ?>
								</ul>
								<?php } ?>
						<?php } ?>
						</li>
						
						
							</ul>
						</span>	
						</div>
						
						
						<?php } ?>
						
                  
								
								
								
								
							
								
								
								
							
							    <!-- Menu -->
				    
				    <?php $position = 1; foreach($categories as $category):?>
				    <?php $num = $position++ ?>
				    <?php if($category['category_id']): ?>
				    
                    
				    
				    <li class="<?php switch($num){ 
				     case 1: echo 'drop-downfirst'; 
				     break;
				     case 2: echo 'drop-downtwo'; 
				    break;
				     case 3: echo 'drop-downthree'; 
				     break;
				     case 4: echo 'drop-downfor'; 
				     break;
				     } ?>">
				        <a href="$$$"><font size="2"><?php echo $category['name']; ?></font></a>
				        <div class="
				        
				        <?php 
				    switch($num){
				     case 1: 
				        echo 'mega-menufirst';
				     break;
				     case 2: 
				        echo 'mega-menutwo'; 
				     break;
				     case 3: 
				        echo 'mega-menuthree'; 
				     break;
				     case 4: 
				        echo 'mega-menufor'; 
				     
				     
				    } 
				    
				    ?>
				        
				        
				        fadeIn animated">
				        <div class="row">
				            <div class="container">
				            <div class="span4">
				                
				                
				                
				                
							        <div class="category-cont">
							         <a href="<?php echo $category['href']; ?>"> <img width="280" height="280" src="<?php echo $category['thumb'] ?>"></a>
							            <h4>  <?php echo $category['name']; ?></h4>
							       </div>
							    
				                
				                
				                
				                
				                
				            </div>
				            <div class="span6">
				                
				                
				                
				                
				        

						
						
						
						<div class="span12">
							<span class="categories-list-small">
						        <ul>
						
						
						
						<?php if ($category['category_id'] == $category_id) { ?>
						<li class="active cat_<?php echo $cv ?>">
						<?php } else { ?>
						<li class="cat_<?php echo $cv ?>">
						<?php } ?>
						<a href="<?php echo $category['href']; ?>"><span><font size="4"><?php echo $category['name']; ?></span></font></a>
						<?php if ($category['children']) { ?>
					
								<?php for ($i = 0; $i < count($category['children']);) { ?>
								<ul>
								<?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
								<?php for (; $i < $j; $i++) { ?>
								<?php if (isset($category['children'][$i])) { ?>
								<?php $id=$category['children'][$i]['category_id'];?>
								<?php if ( $id == $child_id) { ?>
								<li class="active">
									<?php } else { ?>
								<li>
									<?php } ?>
									<?php if ($category['children'][$i]['children3']) {?>
									<a class="screenshot1"  href="<?php echo $category['children'][$i]['href']; ?>"><font size="4"><?php echo $category['children'][$i]['name'];?></font></a>
									<ul>
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
									<a class="screenshot1"  href="<?php echo $category['children'][$i]['href']; ?>"><font size="2"><img width="9" height="9" src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/icone-menu.jpg"><?php echo $category['children'][$i]['name'];?></font></a>
								<?php }?>
								</li>
								<?php } ?>
								<?php } ?>
								</ul>
								<?php } ?>
						<?php } ?>
						</li>
						
						
							</ul>
						</span>	
						</div>
						
                        						
						
				                
				                
				                
				                
				                
				                
				                
				                
				                
				            </div>    
				            </div>
				            
				        </div>
				        
				        </div>
				        
				        </li>
				        <?php endif;?>
				        <?php endforeach;?>
				    
				    
				     <!-- Menu -->
					
					
					
					
					
					
					
					
				
                    <li><a href="http://site.intercasamoveis.com.br"><font size="2">Site Institucional</font></a></li>
					
					
					
					
					
					
					
                 <li style="float:right;" class="two">
                   <a href=""><font size="2"><i class="fa fa-search"></i></font></a>
                   <div class="mega-menu-search fadeIn animated">
                       <div class="row">
                           <div class="container">
                               <form action="#" method="get">
                               <div class="search-box-mega">
                                   <input type="hidden" name="route" value="<?php echo $this->request->get['route'] = 'product/search' ?>">
                                   <input type="text" name="search"/>
                               </div>
                               </form>
                           </div>
                           
                       </div>
                  </div>
                   
                  </li>
                  
                  <li><a href="https://intercasamoveis.com.br/blog"><i class="fa fa-wordpress"></i><font size="2">&nbsp;&nbsp;Inspira Blog</font></a></li>
                  
                  <li style="float:right;">
                      <a href=""><i class="fa fa-cart"></i></a>
                      
                  </li>


                    </div>
			 
					</li>
					</a>




				</ul>
			</nav>
		</div>
     
  
  
  
        
        
        
</div>
   </div> 
<div class="swipe">
	<div class="swipe-menu">
		<ul class="links">
			<?php if (!isset($this->request->get['route'])) { $route='active'; }  else {$route='';}?> <li class="first"><a class="<?php echo $route; if (isset($this->request->get['route']) && $this->request->get['route']=="common/home") {echo "active";} ?>" href="<?php echo $home; ?>"><i class="icon-home"></i><?php echo $text_home; ?></a></li>
            <li><a href="https://intercasamoveis.com.br/blog" target="_blank">BLOG</a></li>
			<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="account/wishlist") {echo "active";} ?>" href="<?php echo $wishlist; ?>" id="wishlist-total"><i class="icon-star"></i><?php echo $text_wishlist; ?></a></li>
			<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="account/account") {echo "active";} ?>" href="<?php echo $account; ?>"><i class="icon-user"></i><?php echo $text_account; ?></a></li>
			<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="checkout/cart") {echo "active";} ?>" href="<?php echo $shopping_cart; ?>"><i class="icon-shopping-cart"></i><?php echo $text_shopcart; ?></a></li>
			<li><a class="<?php if (isset($this->request->get['route']) && $this->request->get['route']=="checkout/checkout") {echo "active";} ?>" href="<?php echo $checkout; ?>"><i class="icon-check"></i><?php echo $text_checkout; ?></a></li>
			
		</ul>
		<?php echo $language; ?>
		<?php echo $currency; ?>
		<?php if ($informations) { ?>
		<ul class="foot">
			<?php foreach ($informations as $information) { ?>
			<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
			<?php } ?>

        </ul>
		<?php } ?>
		<ul class="foot foot-1">
			<li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
			<li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
			<li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
		</ul>
		<ul class="foot foot-2">
			<li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
			<li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
			<li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
			<li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
		</ul>
		<ul class="foot foot-3">
			<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
			<li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
		</ul>
	</div>
</div>
















<div id="page">
<div id="shadow">
<div class="shadow"></div>

<section class="row">
	
<!-- Modules 100% -->

<?php if ($modules) {?>
<div class="header-modules">
	<div class="row">
		
			
				<?php foreach ($modules as $module) { ?>
					<?php echo $module; ?>
				<?php } ?>
			
			<div class="clear"></div>
		
	</div>
</div>

<!-- Modules 100% -->




<?php }?>
<div id="container">
<p id="back-top"> <a href="#top"><span></span></a> </p>
<div class="container">
<div id="notification"> </div>
<div class="row">




<button class="btn-contato-footer" href="#myModal" role="button" data-toggle="modal"><i class="fa fa-send"></i></button>





<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="https://intercasamoveis.com.br/index.php?route=information/contact" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">��</button>
    <h3 id="myModalLabel">Contato</h3>
  </div>
  <div class="modal-body">
    <div class="row-fluid">
        
        <div class="span12">
            
        <div class="form-group">
            <input type="text" class="form-control span12" placeholder="Nome" name="name">
        </div>
        <div class="form-input">
            <input type="text" class="form-control span12" placeholder="E-mail" name="email">
        </div>
        <div class="form-group">
            <textarea type="text" class="form-control span12" placeholder="Assunto" name="enquiry" cols="2"></textarea>
        </div>
        <hr>
        <div class="form-group">
            <div class="captcha"><img src="index.php?route=information/contact/captcha" alt=""></div>
            
        </div>
        <div class="form-group">
            <label>Digite o Captcha:</label>
            <input type="text" class="form-control span12 capcha" name="captcha" value="">
        </div>
        
        
       
       
      
       
       
       
       
        
            
        
        </div>
        
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
    <button class="btn btn-warning">Enviar</button>
  </div>
  </form>
</div>




<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-568BZZC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->



                            