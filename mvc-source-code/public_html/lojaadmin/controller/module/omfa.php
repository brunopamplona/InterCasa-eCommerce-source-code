<?php
class ControllerModuleOmfa extends Controller {
	private $error = array();

	private $patches = array(
		'shoppica1' 		=> array(
					'name' 				=> 'Shoppica v.1.x',
					'lines'	=> array('<!-- SHPPC1: REMOVE ME//scroll down for more', 'SHPPC1: REMOVE ME, TOO. -->')
				),
		'shoppica2' 		=> array(
					'name' 				=> 'Shoppica v.2.x',
				   'lines'	=> array('<!-- SHPPC2: REMOVE ME//scroll down for more', 'SHPPC2: REMOVE ME, TOO. -->')
				),
		'plugsminifier' 	=> array(
					'name' 				=> 'OCPlugs\'s Minifier',
					'lines'	=> array('<!-- OCPlugs Minifier: REMOVE ME', 'OCPlugs Minifier: REMOVE ME, too -->')
				),
		'tcalppagespeed'	=> array(
					'name' 				=> '"Increase Page Speed For Open Cart" by Tcalp',
					'lines'	=> array('<!-- IPSOC: REMOVE ME', 'IPSOC: REMOVE ME, too -->')
				),
		'securetrading'	=> array(
					'name' 				=> 'SecureTrading',
					'lines'	=> array('<!-- SecureTrading fix', '/SecureTrading fix -->')
				),
		'ajaxshoppingcart'	=> array(
					'name' 				=> 'Ajax Shopping Cart',
					'lines'	=> array('<!-- Ajax Shopping Cart: REMOVE ME', 'Ajax Shopping Cart: REMOVE ME, TOO. -->')
				),
		'paypalexpresscheckout'	=> array(
					'name' 				=> 'PayPal Express Checkout',
					'lines'	=> array('<!-- PayPal Express Checkout: REMOVE ME', 'PayPal Express Checkout: REMOVE ME, TOO. -->')
				),
		'paypalexpress'	=> array(
					'name' 				=> 'PayPal Express by Integrio',
					'lines'	=> array('<!-- PayPal Express: REMOVE ME', 'PayPal Express: REMOVE ME, TOO. -->')
				),
		'icustomfooter'	=> array(
					'name' 				=> 'iCustomFooter',
					'lines'	=> array('<!-- iCustomFooter: REMOVE ME', 'iCustomFooter: REMOVE ME, TOO. -->')
				),
		'cachingmod' 		=> array(
					'name' 				=> 'Caching mod by Jay Gilford',
					'lines'	=> array('<!-- Caching:REMOVE ME//scroll down for more', 'Caching:REMOVE ME, TOO. -->')
				),
		'newcachingmod' 		=> array(
					'name' 				=> 'Caching mod 1.4.2 by Jay Gilford',
					'lines'	=> array('<!-- Caching 1.4.2:REMOVE ME//scroll down for more', 'Caching 1.4.2:REMOVE ME, TOO. -->')
				),
	);

	private $omfa_options = array(
			'config_mobile_theme' => array(
				'name' => 'config_mobile_theme',
				'default' => 'omf2',
				'type'	=> ''
				),			
			'config_mobile_tablets' => array(
				'name' => 'config_mobile_tablets',
				'default' => '',
				'type'	=> 'checkbox'
				),
			'config_wishlist_disabled' => array(
				'name' => 'config_wishlist_disabled',
				'default' => '0',
				'type'	=> 'checkbox'
				),
			'config_mobile_front_page_cat_list' => array(
				'name' => 'config_mobile_front_page_cat_list',
				'default' => '',
				'type'	=> ''
				),
			'config_mobile_display_top_cats' => array(
				'name' => 'config_mobile_display_top_cats',
				'default' => '',
				'type'	=> 'checkbox'
				),
			'config_mobile_logo' => array(
				'name' => 'config_mobile_logo',
				'default' => '',
				'type'	=> ''
				),
			'config_mobile_logo_size' => array(
				'name' => 'config_mobile_logo_size',
				'default' => '40',
				'type'	=> ''
				),
			'config_mobile_custom_product_listing' => array(
				'name' => 'config_mobile_custom_product_listing',
				'default' => '',
				'type'	=> ''
				),
			'config_mobile_custom_category_description' => array(
				'name' => 'config_mobile_custom_category_description',
				'default' => '',
				'type'	=> ''
				),
			'config_mobile_custom_styles' => array(
				'name' => 'config_mobile_custom_styles',
				'default' => '/*
	This is a custom mobile stylesheet where you can add your styles
*/',
				'type'	=> ''
				),
			'config_mobile_colors_body_background' => array(
				'name' => 'config_mobile_colors_body_background',
				'default' => 'FFFFFF',
				'type'	=> ''
				),
			'config_mobile_colors_body_text' => array(
				'name' => 'config_mobile_colors_body_text',
				'default' => '000000',
				'type'	=> ''
				),
			'config_mobile_colors_link_unvisited' => array(
				'name' => 'config_mobile_colors_link_unvisited',
				'default' => '0000EE',
				'type'	=> ''
				),
			'config_mobile_colors_link_visited' => array(
				'name' => 'config_mobile_colors_link_visited',
				'default' => '551A8B',
				'type'	=> ''
				),
			'config_mobile_colors_link_hover' => array(
				'name' => 'config_mobile_colors_link_hover',
				'default' => '0000EE',
				'type'	=> ''
				),
			'config_mobile_colors_link_selected' => array(
				'name' => 'config_mobile_colors_link_selected',
				'default' => 'EE0000',
				'type'	=> ''
				),
			'config_mobile_colors_header_background' => array(
				'name' => 'config_mobile_colors_header_background',
				'default' => '003366',
				'type'	=> ''
				),
			'config_mobile_colors_header_text' => array(
				'name' => 'config_mobile_colors_header_text',
				'default' => 'FFFFFF',
				'type'	=> ''
				),
			'config_mobile_colors_primary_nav_background' => array(
				'name' => 'config_mobile_colors_primary_nav_background',
				'default' => '144169',
				'type'	=> ''
				),
			'config_mobile_colors_primary_nav_text' => array(
				'name' => 'config_mobile_colors_primary_nav_text',
				'default' => 'FFFFFF',
				'type'	=> ''
				),
			'config_mobile_colors_secondary_nav_background' => array(
				'name' => 'config_mobile_colors_secondary_nav_background',
				'default' => '6298C7',
				'type'	=> ''
				),
			'config_mobile_colors_secondary_nav_text' => array(
				'name' => 'config_mobile_colors_secondary_nav_text',
				'default' => 'EEEEEE',
				'type'	=> ''
				),
			'config_mobile_colors_button_background' => array(
				'name' => 'config_mobile_colors_button_background',
				'default' => '003366',
				'type'	=> ''
				),
			'config_mobile_colors_button_text' => array(
				'name' => 'config_mobile_colors_button_text',
				'default' => 'FFFFFF',
				'type'	=> ''
				),
			'config_mobile_colors_input_background' => array(
				'name' => 'config_mobile_colors_input_background',
				'default' => 'FFFFFF',
				'type'	=> ''
				),
			'config_disable_addtocart_outofstock' => array(
				'name' => 'config_disable_addtocart_outofstock',
				'default' => '1',
				'type'	=> 'checkbox'
				),
			'config_mobile_custom_gradients' => array(
				'name' => 'config_mobile_custom_gradients',
				'default' => '1',
				'type'	=> ''
				),
			'config_mobile_ic' => array(
				'name' => 'config_mobile_ic',
				'default' => '1',
				'type' => 'checkbox'
				),
		);

	private $inactive_modules = array("omfa", "slideshow", "carousel", "google_talk");

	private $xml_files = array("zzz_omf_catalog.xml", "zzz_omf_system.xml");

	public function index()
	{
		$this->data = $this->language->load('module/omfa');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['success_gen'] = $this->language->get('text_success_gen');

		$this->data['token'] = $this->session->data['token'];

		$this->load->model('tool/image');

		$this->data['store_id'] = 0;
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		$this->data['mobile_logo'] = $this->data['no_image'];
		$this->data['store_url'] = $this->config->get('config_url') ? $this->config->get('config_url') : '';

		// set defaults
		foreach ($this->omfa_options as $option)
		{
			$this->data[$option['name']] = $option['default'];
		}

		$custom_mobile = "../catalog/view/theme/" . $this->data['config_mobile_theme'] . "/stylesheet/custom_mobile.scss";
		$this->data['config_mobile_custom_styles'] = file_get_contents($custom_mobile);

		$colors = "../catalog/view/theme/" . $this->data['config_mobile_theme'] . "/stylesheet/colors.scss";
		if ($colors_str = file_get_contents($colors))
		{
			if (preg_match_all('/#([a-fA-F0-9]){3,6}/', $colors_str, $matches))
			{
				$colors_values = $matches[0];
				$this->data['config_mobile_colors_body_background'] = substr($colors_values[0], 1);
				$this->data['config_mobile_colors_body_text'] = substr($colors_values[1], 1);
				$this->data['config_mobile_colors_link_unvisited'] = substr($colors_values[2], 1);
				$this->data['config_mobile_colors_link_visited'] = substr($colors_values[3], 1);
				$this->data['config_mobile_colors_link_hover'] = substr($colors_values[4], 1);
				$this->data['config_mobile_colors_link_selected'] = substr($colors_values[5], 1);
				$this->data['config_mobile_colors_header_background'] = substr($colors_values[6], 1);
				$this->data['config_mobile_colors_header_text'] = substr($colors_values[7], 1);
				$this->data['config_mobile_colors_primary_nav_background'] = substr($colors_values[8], 1);
				$this->data['config_mobile_colors_primary_nav_text'] = substr($colors_values[9], 1);
				$this->data['config_mobile_colors_secondary_nav_background'] = substr($colors_values[10], 1);
				$this->data['config_mobile_colors_secondary_nav_text'] = substr($colors_values[11], 1);
				$this->data['config_mobile_colors_button_background'] = substr($colors_values[12], 1);
				$this->data['config_mobile_colors_button_text'] = substr($colors_values[13], 1);
				$this->data['config_mobile_colors_input_background'] = substr($colors_values[14], 1);
			}
		}

	if (defined('VERSION') && (version_compare(VERSION, '1.5.5', '>=') == true))
	{
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			if (isset($this->request->post['config_mobile_disable_omf'])) {
				$this->disableOmf();
				unset($this->request->post['config_mobile_disable_omf']);
			} else {
				$this->enableOmf();
			}

			$this->model_setting_setting->editSetting('omfa', $this->request->post);

			if (isset($this->request->post['config_mobile_theme'])) {
				$config_mobile_theme = $this->request->post['config_mobile_theme'];
			} else {
				$config_mobile_theme = $this->omfa_options['config_mobile_theme']['default'];
			}

			$settings = "../catalog/view/theme/" . $config_mobile_theme . "/stylesheet/settings.scss";
			$settings_str = '$mobilelogosize: ' . $this->request->post['config_mobile_logo_size'] . "%;";

			if (isset($this->request->post['config_wishlist_disabled']) && $this->request->post['config_wishlist_disabled'] !== '') {
				$settings_str = $settings_str . "\n\$wishlist: disabled;";
			}

			if (isset($this->request->post['config_mobile_custom_product_listing'])) {
				$settings_str = $settings_str . "\n\$productlisttype: full-width;\n";
			}

			if (isset($this->request->post['config_mobile_custom_category_description'])) {
				$settings_str = $settings_str . "\n\$categoryinfotype: full-width;";
			}

			if (isset($this->request->post['config_mobile_custom_gradients'])) {
				$settings_str = $settings_str . "\n\$gradients: enabled;";
			}

			$this->writeToFile($settings, $settings_str);

			if (isset($this->error['json']))
			{
				$this->session->data['error'] = implode('<br />', (array)$this->error['json']);
			}
			else
			{
				$this->session->data['success'] = $this->language->get('text_success');
			}

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}

		$this->data['mobile_themes'] = array();

		$directories = glob(DIR_CATALOG . 'view/theme/*', GLOB_ONLYDIR);
		foreach ($directories as $directory)
		{
			if (file_exists($directory.'/stylesheet/mobile2.scss'))
			{
				$this->data['mobile_themes'][] = basename($directory);
			}
		}

		if (defined('HTTPS_CATALOG')) {
			$this->data['https'] =  HTTPS_CATALOG;
		} else {
			$this->data['https'] =  HTTP_CATALOG;

			if (strpos(HTTP_CATALOG, 'https') === false && strpos(HTTP_CATALOG, 'http') !== false) {
				$this->data['https'] = substr_replace($this->data['https'], 's', 4, 0);
			}
		}

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$this->data['error_gen'] = $this->language->get('error_gen');
		$this->data['text_gen_instruction'] = $this->language->get('text_gen_instruction');

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/omfa', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		$this->data['action'] = $this->url->link('module/omfa', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		asort($this->patches);

		if (!$this->isOmfDisabled()) {
			$this->data['active_patches'] = $this->getActivatedPatches();
		} else {
			$this->data['active_patches'] = $this->getActivatedPatches("_disabled");
			$this->data['config_mobile_disable_omf'] = "1";
		}

		$this->data['patches'] = $this->patches;

		$this->data['modules'] = array();

		$this->load->model('setting/extension');

		$installed_modules = $this->model_setting_extension->getInstalled('module');

		$files = glob(DIR_APPLICATION . 'controller/module/*.php');
		
		if ($files) {
			foreach ($files as $file) {
				$module = basename($file, '.php');
				
				$this->language->load('module/' . $module);
	
				if (in_array($module, $installed_modules) && strpos($module, '_mobile') === false && !in_array($module, $this->inactive_modules)) {				
					$this->data['modules'][$module]['name'] = $this->language->get('heading_title');
				}
			}
		}
		
		$this->template = 'module/omfa.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	public function load() {
		$this->load->model('setting/setting');
		$this->load->model('setting/store');

		$json = array();

		$store_id = isset($this->request->get['store_id']) ? $this->request->get['store_id'] : 0;

		$store_info = $this->model_setting_setting->getSetting('omfa', $store_id);

		if ($store_id != 0) {
			$store = $this->model_setting_store->getStore($store_id);
			$store_url = $store['url'];
		} else {
			$store_url = $this->config->get('config_url') ? $this->config->get('config_url') : '';
		}
		
		$json['store_id'] = $store_id;
		$json['store_url'] = $store_url;

		$this->load->model('tool/image');

		if ($store_info)
		{
			foreach ($this->omfa_options as $option)
			{
				$option_name = $option['name'];
				if (isset($store_info[$option_name]) && ($option['type'] !== "checkbox" || ($option['type'] === "checkbox" && $store_info[$option_name] !== "")))
				{
					$json[$option_name] = $store_info[$option_name];
				}
			}

			$custom_mobile = "../catalog/view/theme/" . $store_info['config_mobile_theme'] . "/stylesheet/custom_mobile.scss";
			if ( ! $json['config_mobile_custom_styles'] = file_get_contents($custom_mobile))
			{
				$json['error'] = sprintf($this->language->get('error_file_permissions'), $custom_mobile);
			}

			$colors = "../catalog/view/theme/" . $store_info['config_mobile_theme'] . "/stylesheet/colors.scss";
			if ($colors_str = file_get_contents($colors))
			{
				if (preg_match_all('/#([a-fA-F0-9]){3,6}/', $colors_str, $matches))
				{
					$colors_values = $matches[0];
					$json['config_mobile_colors_body_background'] = substr($colors_values[0], 1);
					$json['config_mobile_colors_body_text'] = substr($colors_values[1], 1);
					$json['config_mobile_colors_link_unvisited'] = substr($colors_values[2], 1);
					$json['config_mobile_colors_link_visited'] = substr($colors_values[3], 1);
					$json['config_mobile_colors_link_hover'] = substr($colors_values[4], 1);
					$json['config_mobile_colors_link_selected'] = substr($colors_values[5], 1);
					$json['config_mobile_colors_header_background'] = substr($colors_values[6], 1);
					$json['config_mobile_colors_header_text'] = substr($colors_values[7], 1);
					$json['config_mobile_colors_primary_nav_background'] = substr($colors_values[8], 1);
					$json['config_mobile_colors_primary_nav_text'] = substr($colors_values[9], 1);
					$json['config_mobile_colors_secondary_nav_background'] = substr($colors_values[10], 1);
					$json['config_mobile_colors_secondary_nav_text'] = substr($colors_values[11], 1);
					$json['config_mobile_colors_button_background'] = substr($colors_values[12], 1);
					$json['config_mobile_colors_button_text'] = substr($colors_values[13], 1);
					$json['config_mobile_colors_input_background'] = substr($colors_values[14], 1);
				}
			}
			else
			{
				$json['error'] = sprintf($this->language->get('error_file_permissions'), $colors);
			}

			if (isset($store_info['config_mobile_logo']) && file_exists(DIR_IMAGE . $store_info['config_mobile_logo']) && is_file(DIR_IMAGE . $store_info['config_mobile_logo']))
			{
				$json['mobile_logo'] = $this->model_tool_image->resize($store_info['config_mobile_logo'], 100, 100);
			}
			else
			{
				$json['mobile_logo'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			}

			$this->load->model('setting/extension');

			$installed_modules = $this->model_setting_extension->getInstalled('module');

			$files = glob(DIR_APPLICATION . 'controller/module/*.php');
			
			if ($files) {
				foreach ($files as $file) {
					$module = basename($file, '.php');
	
					if (in_array($module, $installed_modules) && strpos($module, '_mobile') === false && !in_array($module, $this->inactive_modules)) {
						$option_name = 'config_modules_' . $module . '_smartphones';
						if (isset($store_info[$option_name . $store_id])) {
							$json[$option_name] = $store_info[$option_name  . $store_id];
						}
						$option_name = 'config_modules_' . $module . '_tablets';
						if (isset($store_info[$option_name . $store_id])) {
							$json[$option_name] = $store_info[$option_name . $store_id];
						}
					}
				}
			}
		}
		else // new store
		{
			// set defaults
			foreach ($this->omfa_options as $option)
			{
				$json[$option['name']] = $option['default'];
			}

			$json['new_store'] = true;
			$json['mobile_logo'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

			if ( ! $default_store_settings = $this->model_setting_setting->getSetting('omfa', 0)) {
				//save defaults to db
				$this->model_setting_setting->editSetting('omfa', $json, 0);

				$d = array();
				$d['omf_ic'] = 0;
				$d['omf_installed'] = 1;

				$this->model_setting_setting->editSetting('omf', $d, 0);
			}

			$default_theme = $this->omfa_options['config_mobile_theme']['default'];

			$json['config_mobile_theme'] = $default_theme;

			// copy active theme and set it for this store
			
			$this->load->model('setting/store');
			if ($store_details = $this->model_setting_store->getStore($store_id) )
			{
				$new_theme_name = $default_theme ."_". utf8_substr($store_details['name'], 0, 5);
				if ( ! file_exists("../catalog/view/theme/" . $new_theme_name))
				{
					if (@mkdir("../catalog/view/theme/" . $new_theme_name) )
					{
						if (file_exists("../catalog/view/theme/" .$default_theme ."/stylesheet"))
						{
							rcopy("../catalog/view/theme/" .$default_theme ."/stylesheet", "../catalog/view/theme/" . $new_theme_name ."/stylesheet");
						}
						if (file_exists("../catalog/view/theme/" .$default_theme ."/images"))
						{
							rcopy("../catalog/view/theme/" .$default_theme ."/images", "../catalog/view/theme/" . $new_theme_name ."/images");
						}
						@copy("../catalog/view/theme/" .$default_theme ."/s.php", "../catalog/view/theme/" . $new_theme_name ."/s.php");
						@copy("../catalog/view/theme/" .$default_theme ."/scss.inc.php", "../catalog/view/theme/" . $new_theme_name ."/scss.inc.php");
					}
					$json['config_mobile_theme'] = $new_theme_name;
				}
			}
		}

		$this->response->setOutput(json_encode($json));
	}

	public function loadTheme() {
		$json = array();

		$settings = "../catalog/view/theme/" . $this->request->get['theme'] . "/stylesheet/settings.scss";
		if ($settings_str = file_get_contents($settings))
		{
			if (preg_match('/\$mobilelogosize: ([0-9]){1,3}/', $settings_str, $matches))
				$json['config_mobile_logo_size'] = substr($matches[0], 17, 3);
			/*if (strpos($settings_str, '$wishlist: disabled;') !== false) 
				$json['config_wishlist_disabled'] = "1";*/
			if (strpos($settings_str, '$productlisttype: full-width;') !== false) 
				$json['config_mobile_custom_product_listing'] = "1";
			if (strpos($settings_str, '$categoryinfotype: full-width;') !== false) 
				$json['config_mobile_custom_category_description'] = "1";
			if (strpos($settings_str, '$gradients: enabled;') !== false) 
				$json['config_mobile_custom_gradients'] = "1";
		}
		else
		{
			$json['error'] = sprintf($this->language->get('error_file_permissions'), $settings);
		}

		$colors = "../catalog/view/theme/" . $this->request->get['theme'] . "/stylesheet/colors.scss";
		if ($colors_str = file_get_contents($colors))
		{
			if (preg_match_all('/#([a-fA-F0-9]){3,6}/', $colors_str, $matches))
			{
				$colors_values = $matches[0];
				$json['config_mobile_colors_body_background'] = substr($colors_values[0], 1);
				$json['config_mobile_colors_body_text'] = substr($colors_values[1], 1);
				$json['config_mobile_colors_link_unvisited'] = substr($colors_values[2], 1);
				$json['config_mobile_colors_link_visited'] = substr($colors_values[3], 1);
				$json['config_mobile_colors_link_hover'] = substr($colors_values[4], 1);
				$json['config_mobile_colors_link_selected'] = substr($colors_values[5], 1);
				$json['config_mobile_colors_header_background'] = substr($colors_values[6], 1);
				$json['config_mobile_colors_header_text'] = substr($colors_values[7], 1);
				$json['config_mobile_colors_primary_nav_background'] = substr($colors_values[8], 1);
				$json['config_mobile_colors_primary_nav_text'] = substr($colors_values[9], 1);
				$json['config_mobile_colors_secondary_nav_background'] = substr($colors_values[10], 1);
				$json['config_mobile_colors_secondary_nav_text'] = substr($colors_values[11], 1);
				$json['config_mobile_colors_button_background'] = substr($colors_values[12], 1);
				$json['config_mobile_colors_button_text'] = substr($colors_values[13], 1);
				$json['config_mobile_colors_input_background'] = substr($colors_values[14], 1);
			}
		}
		else
		{
			$json['error'] = sprintf($this->language->get('error_file_permissions'), $colors);
		}

		$custom_mobile = "../catalog/view/theme/" . $this->request->get['theme'] . "/stylesheet/custom_mobile.scss";
		if ( ! $json['config_mobile_custom_styles'] = file_get_contents($custom_mobile))
		{
			$json['error'] = sprintf($this->language->get('error_file_permissions'), $custom_mobile);
		}

		$this->response->setOutput(json_encode($json));
	}

	public function save()
	{
		$this->language->load('module/omfa');
		$this->load->model('setting/setting');

		$json = array();

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			if (isset($this->request->post['config_mobile_disable_omf'])) {	
				$this->disableOmf();
				unset($this->request->post['config_mobile_disable_omf']);
			} else {
				$this->enableOmf();
			}

			$this->request->post['config_mobile_custom_styles'] = html_entity_decode($this->request->post['config_mobile_custom_styles'], ENT_QUOTES, "UTF-8");

			foreach ($this->omfa_options as $option) {
				if ($option['type'] === "checkbox") {
					$option_name = $option['name'];
					if (!isset($this->request->post[$option_name])) {
						$this->request->post[$option_name] = "";
					}
				}
			}

			$this->load->model('setting/extension');

			$installed_modules = $this->model_setting_extension->getInstalled('module');

			$files = glob(DIR_APPLICATION . 'controller/module/*.php');
			
			if ($files) {
				foreach ($files as $file) {
					$module = basename($file, '.php');
	
					if (in_array($module, $installed_modules) && strpos($module, '_mobile') === false && !in_array($module, $this->inactive_modules)) {
						$option_name = 'config_modules_' . $module . '_smartphones';
						if (isset($this->request->post[$option_name])) {
							//$this->request->post[$option_name] = "";
							$this->request->post[$option_name . $this->request->post['store_id']] = $this->request->post[$option_name];
						}

						

						$option_name = 'config_modules_' . $module . '_tablets';
						if (isset($this->request->post[$option_name])) {
							//$this->request->post[$option_name] = "";
							$this->request->post[$option_name . $this->request->post['store_id']] = $this->request->post[$option_name];
						}

					}
				}
			}

			$this->model_setting_setting->editSetting('omfa', $this->request->post, $this->request->post['store_id']);

			$config_mobile_theme = ( isset($this->request->post['config_mobile_theme']) ? $this->request->post['config_mobile_theme']: "omf2" );

			$custom_mobile = "../catalog/view/theme/" . $config_mobile_theme . "/stylesheet/custom_mobile.scss";
			$this->writeToFile($custom_mobile, $this->request->post['config_mobile_custom_styles']);

			$settings = "../catalog/view/theme/" . $config_mobile_theme . "/stylesheet/settings.scss";
			$settings_str = '$mobilelogosize: ' . $this->request->post['config_mobile_logo_size'] . "%;";

			if (isset($this->request->post['config_wishlist_disabled']) && $this->request->post['config_wishlist_disabled'] !== '') {
				$settings_str = $settings_str . "\n\$wishlist: disabled;";
			}

			if (isset($this->request->post['config_mobile_custom_product_listing'])) {
				$settings_str = $settings_str . "\n\$productlisttype: full-width;";
			}

			if (isset($this->request->post['config_mobile_custom_category_description'])) {
				$settings_str = $settings_str . "\n\$categoryinfotype: full-width;";
			}

			if (isset($this->request->post['config_mobile_custom_gradients'])) {
				$settings_str = $settings_str . "\n\$gradients: enabled;";
			}

			$this->writeToFile($settings, $settings_str);

			$colors = "../catalog/view/theme/" . $config_mobile_theme . "/stylesheet/colors.scss";
			$this->writeToFile($colors, '$body-bgcolor: #' . $this->request->post['config_mobile_colors_body_background'] . ';'
								  ."\n".'$body-text-color: #' . $this->request->post['config_mobile_colors_body_text'] . ';'
								  ."\n".'$link-color: #' . $this->request->post['config_mobile_colors_link_unvisited'] . ';'
								  ."\n".'$link-visited-color: #' . $this->request->post['config_mobile_colors_link_visited'] . ';'
								  ."\n".'$link-hover-color: #' . $this->request->post['config_mobile_colors_link_hover'] . ';'
								  ."\n".'$link-active-color: #' . $this->request->post['config_mobile_colors_link_selected'] . ';'
								  ."\n\n".'$header-bgcolor: #' . $this->request->post['config_mobile_colors_header_background'] . ';'
								  ."\n".'$header-text-color: #' . $this->request->post['config_mobile_colors_header_text'] . ';'
								  ."\n\n".'$primary-nav-bgcolor: #' . $this->request->post['config_mobile_colors_primary_nav_background'] . ';'
								  ."\n".'$primary-nav-link-color: #' . $this->request->post['config_mobile_colors_primary_nav_text'] . ';'
								  ."\n\n".'$secondary-nav-item-bgcolor: #' . $this->request->post['config_mobile_colors_secondary_nav_background'] . ';'
								  ."\n".'$secondary-nav-link-color: #' . $this->request->post['config_mobile_colors_secondary_nav_text'] . ';'
								  ."\n\n".''
								  ."\n".'$button-bgcolor: #' . $this->request->post['config_mobile_colors_button_background'] . ';'
								  ."\n".'$button-text-color: #' . $this->request->post['config_mobile_colors_button_text'] . ';'
								  ."\n".'$input-bgcolor: #' . $this->request->post['config_mobile_colors_input_background'] . ';');
		}

		if (isset($this->error['json'])) {
			$json['error'] = implode('<br />', (array)$this->error['json']);
		}

		if (isset($this->error['warning'])) {
			$json['error'] = $this->error['warning'];
		}

		if ( ! isset($json['error'])) {
			$json['success'] = $this->language->get('text_success');
		}

		$this->response->setOutput(json_encode($json));
	}

	public function getColor() {
		/* ColorPicker 0.9 - ColorPicking on images */

		$prefix = isset($_GET['prefix']) ? $_GET['prefix'] : '#';
 
		if (!$_GET['coords'] or !strpos($_GET['coords'],',')) die($prefix.'000000');
		$coords = explode(',',$_GET['coords']);
		 
		$img = $_GET['img'] ? $_GET['img'] : 'desktop-theme-screenshot.png';
		$ext = explode('.',$img);
		$ext = strtolower($ext[count($ext)-1]);
		if ($ext == 'jpg' or $ext == 'jpeg') $img = @imagecreatefromjpeg($img);
		else if ($ext == 'gif') $img = @imagecreatefromgif($img);
		else if ($ext == 'png') $img = @imagecreatefrompng($img);
		else die($prefix.'000000');
		if (!$img) die($prefix.'000000');
		$imgW = imagesx($img);
		$imgH = imagesy($img);
		 
		$range = $_GET['range'] ? (int) $_GET['range'] : 2;
		while(abs($range)%2 != 0) $range--;
		if ($range<0) $range = 0;
		$range /= 2;

		for ($n=-$range; $n<=$range; $n++) {
		  for ($m=-$range; $m<=$range; $m++) {
		    $x = $coords[0]+$m; $x = $x > $imgW ? $imgW : $x < 0 ? 0 : $x;
		    $y = $coords[1]+$n; $y = $y > $imgH ? $imgH : $y < 0 ? 0 : $y;
		    $rgb = imagecolorat($img, $x, $y);
		    $rgb = imagecolorsforindex($img, $rgb);
		    $r = 0;
		    $g = 0;
		    $b = 0;
		    $r += $rgb['red'] & 0xFF;
		    $g += $rgb['green'] & 0xFF;
		    $b += $rgb['blue'] & 0xFF;
		  }
		}
		imagedestroy($img);

		$r = dechex($r/pow($range*2+1,2));
		$g = dechex($g/pow($range*2+1,2));
		$b = dechex($b/pow($range*2+1,2));

		echo $prefix.((strlen($r)<2)?'0'.$r:$r).
		             ((strlen($g)<2)?'0'.$g:$g).
		             ((strlen($b)<2)?'0'.$b:$b);
	}

	public function getScreenShot() {
		$this->language->load('module/omfa');

		$button_generate = $this->language->get('button_generate');
		$text_gen_instruction = $this->language->get('text_gen_instruction');

		$store_id = $this->request->get['store'];
		
		if ($store_id != 0) {
			$this->load->model("setting/store");

			$store = $this->model_setting_store->getStore($store_id);
			$store_url = $store['url'];
		}

		$image = 'view/image/omfa/desktop-theme-screenshot' . $store_id . '.png';

		if (file_exists($image)) {
			$image = HTTPS_SERVER . $image;
			$output = '<img src="' . $image . '" alt="" title="" alt="" />';
		} else if (file_exists(DIR_IMAGE . 'no_image.jpg')) {
			$cat = defined('HTTPS_CATALOG') ? HTTPS_CATALOG : HTTP_CATALOG;
			$image = $cat . 'image/no_image.jpg';

			if ($store_id == 0) {
				$output = '<img src="' . $image . '" alt="" title="" alt="" /><div><a class="button button-gen">' . $button_generate . '</a>' . ' ' . $text_gen_instruction . '</div>';
			} else {
				$output = '<img src="' . $image . '" alt="" title="" alt="" /><div><a class="button btn-gen" href="' . $store_url . 'index.php?view=desktop" target="_blank">' . $button_generate . '</a>' . ' ' . $text_gen_instruction . '</div>';
			}		
		} else {
			$image = '';
			if ($store_id == 0) {
				$output = '<img src="' . $image . '" alt="" title="" alt="" />';
			} else {
				$output = '<img src="' . $image . '" alt="" title="" alt="" />';
			}
			
		}
		
		$this->response->setOutput($output);
	}	

	public function saveScreenShot() {
		$this->language->load('module/omfa');
		
		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == "POST" && isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
			/*if (!file_exists("view/image/omfa/"))	{
				@mkdir("view/image/omfa/");
			}*/
			$imageData = $GLOBALS["HTTP_RAW_POST_DATA"];
			$filteredData = substr($imageData, strpos($imageData, ",") + 1);
	        $unencodedData = base64_decode($filteredData);
	        $store_id = isset($this->request->get['store']) ? $this->request->get['store'] : 0;
			if (!file_put_contents('view/image/omfa/desktop-theme-screenshot' . $store_id . '.png', $unencodedData)) {
				$json['error'] = $this->language->get('error_gen');
			}
		}

		if (!isset($json['error'])) {
			$json['success'] = $this->language->get('text_success_gen');
		}

		$this->response->setOutput(json_encode($json));
	}

	private function getActivatedPatches($disabled = '')
	{
		$patches_file = DIR_SYSTEM . '..'. DIRECTORY_SEPARATOR .'vqmod'. DIRECTORY_SEPARATOR .'xml'. DIRECTORY_SEPARATOR .'zzz_omf_system.xml' . $disabled;
		
		$activated_patches = array();

		if (file_exists($patches_file)) {
			$patches_file_content = file_get_contents($patches_file);
		
			foreach ($this->patches as $patch_sysname => $patch)
			{
				$start_line = $patch['lines'][0];
				$end_line 	= $patch['lines'][1];
				if (strpos($patches_file_content, $start_line.'-->') !== false && strpos($patches_file_content, '<!--'.$end_line) !== false)
				{
					$activated_patches[] = $patch_sysname;
				}
			}
		}

		return $activated_patches;
	}

	private function savePatches($activated_patches)
	{
		// Patch specific tasks
		if (in_array('cachingmod', $activated_patches))
		{
			$file_to_patch = DIR_SYSTEM . '..'. DIRECTORY_SEPARATOR .'pagecache'. DIRECTORY_SEPARATOR .'caching.php';

			if (is_writable($file_to_patch))
			{
				$file_contents = file_get_contents($file_to_patch);
				$file_contents = str_replace(
					array('if(PAGE_CACHING) {',
						  'ini_set(\'session.use_cookies\', \'On\');',
						  'ini_set(\'session.use_trans_sid\', \'Off\');'),
					array("require_once(\"system/library/categorizr.php\"); \nif(PAGE_CACHING && !isMobile()) {",
						  "//ini_set('session.use_cookies', 'On');",
						  "//ini_set('session.use_trans_sid', 'Off');"),
					$file_contents
				);

				file_put_contents($file_to_patch, $file_contents);
			}
			else
			{
				unset($activated_patches['cachingmod']);
				$this->error['json'][] = sprintf($this->language->get('error_file_permissions'), $file_to_patch);
			}
		}
		else
		{
			// revert changes ?
		}


		// ==============================

		$patches_file = DIR_SYSTEM . '..'. DIRECTORY_SEPARATOR .'vqmod'. DIRECTORY_SEPARATOR .'xml'. DIRECTORY_SEPARATOR .'zzz_omf_system.xml';
		if ( ! is_writable($patches_file))
		{
			$this->error['json'][] = sprintf($this->language->get('error_file_permissions'), $patches_file);
			return false;
		}
		$patches_file_content = file_get_contents($patches_file);

		foreach ($this->patches as $patch_sysname => $patch)
		{
			$start_line = $this->patches[$patch_sysname]['lines'][0];
			$end_line 	= $this->patches[$patch_sysname]['lines'][1];

			if (isset($activated_patches) and in_array($patch_sysname, $activated_patches))
			{
				// activate patch
				if (strpos($patches_file_content, $start_line) !== false && strpos($patches_file_content, $start_line.'-->') === false)
				{
					$patches_file_content = str_replace($start_line, $start_line.'-->', $patches_file_content);
				}
				if (strpos($patches_file_content, $end_line) !== false && strpos($patches_file_content, '<!--'.$end_line) === false)
				{
					$patches_file_content = str_replace($end_line, '<!--'.$end_line, $patches_file_content);
				}
			}
			else
			{
				//deactivate patch
				if (strpos($patches_file_content, $start_line.'-->') !== false)
				{
					$patches_file_content = str_replace($start_line.'-->', $start_line, $patches_file_content);
				}
				if (strpos($patches_file_content, '<!--'.$end_line) !== false)
				{
					$patches_file_content = str_replace('<!--'.$end_line, $end_line, $patches_file_content);
				}
			}
		}

		file_put_contents($patches_file, $patches_file_content);
	}

	private function isOmfDisabled() {
		$vqmod_dir = "../vqmod/xml/";

		foreach ($this->xml_files as $filename) {
			$file = $vqmod_dir . $filename;
			if (!file_exists($file)) {
				return true;
			}
		}

		return false;
	}

	private function disableOmf() {
		$vqmod_dir = "../vqmod/xml/";
		foreach ($this->xml_files as $filename) {
			$file = $vqmod_dir . $filename;
			if (file_exists($file)) {
				rename($file, $file . "_disabled");
			}
		}
	}

	private function enableOmf() {
		$vqmod_dir = "../vqmod/xml/";

		foreach ($this->xml_files as $filename) {
			$file = $vqmod_dir . $filename;

			if (!file_exists($file)) {
				$file_disabled =  $file . "_disabled";

				if (file_exists($file_disabled)) {
					rename($file_disabled, $file);
				} else {
					$vqmod_files = glob($file . "*");

					if (file_exists($vqmod_files[0])) {
						rename($vqmod_files[0], $file);
					}
				}	
			}
		}

		if (!$this->isOmfDisabled()) {
			$patches = ( isset($this->request->post['patches']) ? $this->request->post['patches'] : array() );
			$this->savePatches($patches);
			unset($this->request->post['patches']);
		}
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/omfa')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->language('omf/common');

		if (!$this->request->post['config_mobile_logo_size']) {
      		$this->error['json']['mobile_logo_size'] = $this->language->get('error_mobile_logo_size');
    	}

    	foreach ($this->omfa_options as $option) {
    		if (substr($option['name'], 0, 21) === "config_mobile_colors_") {
    			if (!$this->request->post[$option['name']]) {
		      		$this->error['json']['mobile_colors'] = $this->language->get('error_mobile_colors');
		    	}
    		}
    	}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	private function writeToFile($filename, $new_content)
	{
		if ( is_writable($filename))
		{
			file_put_contents($filename, html_entity_decode($new_content, ENT_QUOTES, "UTF-8"));
		}
		else
		{
			(array)$this->error['json'][] = sprintf($this->language->get('error_file_permissions'), $filename);
		}
	}
}

// this should go in some helper file
function rcopy($src, $dst)
{
	$dir = opendir($src);
	@mkdir($dst);
	while(false !== ($file = readdir($dir)))
	{
		if (($file != '.' ) && ($file != '..'))
		{
			if (is_dir($src . '/' . $file))
			{
				rcopy($src . '/' . $file,$dst . '/' . $file);
			}
			else
			{
				copy($src . '/' . $file,$dst . '/' . $file);
			}
		}
	}
	closedir($dir);
}
?>