<?php
if(isset($_GET['confirm'])){
	
	$options = getopt('p:');
	$prefix = empty($options['p'])
	    ? realpath('.')
	    : realpath($options['p']);
	
	if (empty($prefix)) {
	    die("Bad prefix. Try again.\n");
	}
	
	require $prefix . '/lojaadmin/config.php';
	require $prefix . '/system/database/' . DB_DRIVER . '.php';
	require $prefix . '/system/library/db.php';
	
	$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	$tables = array(
	    'address',
		'affiliate',
		'affiliate_transaction',
//		'attribute',
//		'attribute_description',
//		'attribute_group',
//		'attribute_group_description',
//		'banner',
//		'banner_image',
//		'banner_image_description',
//		'category',
//		'category_description',
//		'category_to_layout',
//		'category_to_store',
		'coupon',
		'coupon_history',
		'coupon_product',
		'customer',
		'customer_ip',
		'customer_reward',
		'customer_transaction',
//		'download',
//		'download_description',
//		'manufacturer',
//		'manufacturer_to_store',
		'order',
		'order_download',
		'order_history',
		'order_option',
		'order_product',
//		'product',
//		'product_attribute',
//		'product_description',
//		'product_discount',
//		'product_image',
//		'product_option',
//		'product_option_value',
//		'product_related',
//		'product_reward',
//		'product_special',
//		'product_tag',
//		'product_to_category',
//		'product_to_download',
//		'product_to_layout',
//		'product_to_store',
		'return',
		'return_history',
		'return_product',
		'review',
//		'store',
//		'url_alias',
//		'voucher',
//		'voucher_history',
//		'voucher_theme',
//		'voucher_theme_description'
	);
	
	foreach ($tables as $table) {
	    $sql = sprintf('TRUNCATE TABLE `%s%s`', DB_PREFIX, $table);
	    printf('%s %s ', $sql, str_repeat('.', 65 - strlen($sql)));
	    $db->query($sql);
	    echo "Done!<br />";
	}
	
	function delete_folder($tmp_path){
		if(is_dir($tmp_path)){
			$handle = opendir($tmp_path);
		  	
			while($tmp=readdir($handle)){
		    
				if($tmp!='..' && $tmp!='.' && $tmp!=''){
		        	
					if(is_writeable($tmp_path.DIRECTORY_SEPARATOR.$tmp) && is_file($tmp_path.DIRECTORY_SEPARATOR.$tmp)){
		                 unlink($tmp_path.DIRECTORY_SEPARATOR.$tmp);
		         	}
		    	}
		  	}
		  	closedir($handle);
		}
	} 
	
	delete_folder(DIR_CACHE);
	delete_folder(DIR_DOWNLOAD);
	delete_folder(DIR_IMAGE.'cache/');
	delete_folder(DIR_IMAGE.'data/');

}else{
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
	<label for="fresh">Are you sure you want to delete all of the data and images?</label>
	<input type="submit" name="confirm" value="Yes" />
</form>
<?php } ?>