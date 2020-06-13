<script>
	jQuery(function(){
		jQuery('#camera_wrap_<?php echo $module; ?>').camera({
			fx: 'stampede',
			navigation: true,
			playPause: false,
			thumbnails: true,
			barPosition: 'top',
			loader: true,
			time: 3000,
			transPeriod:800,
			alignment: 'center',
			autoAdvance: true,
			mobileAutoAdvance: true,
			barDirection: 'leftToRight', 
			barPosition: 'bottom',
			easing: 'easeInOutExpo',
			fx: 'simpleFade',
			//height: '600px',
			width:'100px',
			minHeight: '90px',
			hover: true,
			pagination: true,
			loaderColor			: '#1f1f1f', 
			loaderBgColor		: 'transparent',
			loaderOpacity		: 1,
			loaderPadding		: 0,
			loaderStroke		: 3
			});
	});
</script>
<div class="slide-top clearfix" >
	<div class="fluid_container" >
		<div id="camera_wrap_<?php echo $module; ?>">
		<?php foreach ($banners as $banner) { ?>
			<div title="<?php echo $banner['title']; ?>" data-thumb="<?php echo $banner['image']; ?>" <?php if ($banner['link']) { ?> data-link="<?php echo $banner['link']; ?>"<?php } ?> data-src="<?php echo $banner['image']; ?>">
				<?php if ($banner['description']) { ?>
				<div class="camera_caption fadeIn">
					<?php echo $banner['description']; ?>
				</div>
				<?php } ?>
			</div>
		<?php } ?>
		</div>
		<div class="divisor-small"></div>
	</div>
</div>