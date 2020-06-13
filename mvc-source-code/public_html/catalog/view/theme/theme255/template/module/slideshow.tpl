<?php if (!empty($banners)) : ?>
    <div class="slideshow hide-mobile">
        <div id="slideshow<?php echo $module; ?>" class="nivoSlider"
             style="width: <?php echo '100%'//$width; ?>; height: <?php echo $height; ?>px;">
            <?php foreach ($banners as $banner) { ?>
                <?php if ($banner['link']) { ?>
                    <a title="<?php echo $banner['title']; ?>" href="<?php echo $banner['link']; ?>"><img
                            title="<?php echo $banner['description']; ?>" src="<?php echo $banner['image']; ?>"
                            alt="<?php echo $banner['title']; ?>"/></a>
                <?php } else { ?>
                    <img title="<?php echo $banner['description']; ?>" src="<?php echo $banner['image']; ?>"
                         alt="<?php echo $banner['title']; ?>"/>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#slideshow<?php echo $module; ?>').nivoSlider({
                effect: 'fade',
                animSpeed: 500,
                pauseTime: 5000,
                slices: 20,
                captionOpacity: 1,
                controlNavThumbs: false,
                controlNavThumbsFromRel: false,
                controlNavThumbsSearch: '.jpg',
                controlNavThumbsReplace: '_thumb.jpg',
                directionNav: false,
                controlNav: false,
                prevText: false,
                nextText: false
            });
            $('.nivo-controlNav a').eq(0).addClass('first');
            $('.nivo-controlNav a').eq(1).addClass('second');
            $('.nivo-controlNav a').eq(2).addClass('third');
            $('.nivo-controlNav a').eq(3).addClass('four');

	        setTimeout(function(){
		        $('#slideshow<?php echo $module; ?>').width('100%');
		        $('.slideshow .nivoSlider').css('background-size','100%');
	        }, 2000);
        });

    </script>

<?php endif; ?>