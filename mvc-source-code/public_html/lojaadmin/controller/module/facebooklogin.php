<?php
class ControllerModuleFacebooklogin extends Controller {
	public function index() { 
		$this->language->load('module/facebooklogin');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addStyle('view/stylesheet/facebooklogin.css');
		$this->load->model('module/facebooklogin');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if (!$this->user->hasPermission('modify', 'module/facebooklogin')) {
				$this->session->data['error'] = $this->language->get('error_permission');
				$this->redirect($this->url->link('module/facebooklogin', 'token=' . $this->session->data['token'], 'SSL'));
			}

			$this->model_module_facebooklogin->editSetting('FacebookLogin', $this->request->post);		
			$this->session->data['success'] = $this->language->get('text_success');
			
			if (!empty($this->request->get['activate'])) {
				$this->session->data['success'] = $this->language->get('text_success_activation');
			}
			
			$selectedTab = (empty($this->request->post['selectedTab'])) ? 0 : $this->request->post['selectedTab'];
			$selectedStore = (empty($this->request->post['selectedStore'])) ? 0 : $this->request->post['selectedStore'];
			$this->redirect($this->url->link('module/facebooklogin', 'token=' . $this->session->data['token'] . '&tab='.$selectedTab . '&store='.$selectedStore, 'SSL'));
		}
			
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_load_in_selector'] = $this->language->get('text_load_in_selector');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_layout_options'] = $this->language->get('entry_layout_options');
		$this->data['entry_position_options'] = $this->language->get('entry_position_options');
		$this->data['entry_enable_disable']	= $this->language->get('entry_enable_disable');
		$this->data['entry_api'] = $this->language->get('entry_api');
		$this->data['entry_secret'] = $this->language->get('entry_secret');
		$this->data['entry_preview'] = $this->language->get('entry_preview');
		$this->data['entry_design']	= $this->language->get('entry_design');
		$this->data['entry_no_design'] = $this->language->get('entry_no_design');
		$this->data['entry_wrap_into_widget'] = $this->language->get('entry_wrap_into_widget');
		$this->data['entry_yes'] = $this->language->get('entry_yes');
		$this->data['entry_no'] = $this->language->get('entry_no');
		$this->data['entry_wrapper_title'] = $this->language->get('entry_wrapper_title');
		$this->data['entry_button_name'] = $this->language->get('entry_button_name');
		$this->data['entry_use_oc_settings'] = $this->language->get('entry_use_oc_settings');
		$this->data['entry_assign_to_cg'] = $this->language->get('entry_assign_to_cg');
		$this->data['entry_new_user_details'] = $this->language->get('entry_new_user_details');
		$this->data['entry_custom_css'] = $this->language->get('entry_custom_css');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		$this->load->model('localisation/language');
		
		$languages = $this->model_localisation_language->getLanguages();;
		$this->data['languages'] = $languages;
		$firstLanguage = array_shift($languages);
		$this->data['firstLanguageCode'] = $firstLanguage['code'];
		
		$this->data['has_customer_group'] = false;
		if (defined('VERSION')) {
			if (strcmp(VERSION, '1.5.3') >= 0) {
				$this->data['has_customer_group'] = true;
			}
		}
		
		$this->load->model('sale/customer_group');
		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		
		$this->data['more_user_details'] = array(
			array(
				'name' => 'ExtraTelephone',
				'default_checked' => false,
				'text' => $this->language->get('extra_telephone')
			),
			array(
				'name' => 'ExtraFax',
				'default_checked' => false,
				'text' => $this->language->get('extra_fax')
			),
			array(
				'name' => 'ExtraCompany',
				'default_checked' => false,
				'text' => $this->language->get('extra_company')
			),
			array(
				'name' => 'ExtraAddress',
				'default_checked' => false,
				'text' => $this->language->get('extra_address')
			),
			array(
				'name' => 'ExtraCountry',
				'default_checked' => false,
				'text' => $this->language->get('extra_country')
			),
			array(
				'name' => 'ExtraRegion',
				'default_checked' => false,
				'text' => $this->language->get('extra_region')
			),
			array(
				'name' => 'ExtraCity',
				'default_checked' => false,
				'text' => $this->language->get('extra_city')
			),
			array(
				'name' => 'ExtraPostcode',
				'default_checked' => false,
				'text' => $this->language->get('extra_postcode')
			),
			array(
				'name' => 'ExtraNewsletter',
				'default_checked' => false,
				'text' => $this->language->get('extra_newsletter')
			),
			array(
				'name' => 'ExtraPrivacy',
				'default_checked' => false,
				'text' => $this->language->get('extra_privacy')
			)
		);
		
		if (defined('VERSION')) {
			if (strcmp(VERSION, '1.5.3') >= 0) {
				$this->load->model('sale/customer_group');
				
				$this->data['more_user_details'][] = array(
					'name' => 'ExtraCompanyId',
					'default_checked' => false,
					'text' => $this->language->get('extra_company_id')
				);
				
				$this->data['more_user_details'][] = array(
					'name' => 'ExtraTaxId',
					'default_checked' => false,
					'text' => $this->language->get('extra_tax_id')
				);
			}
		}
		
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
			'href'      => $this->url->link('module/facebooklogin', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/facebooklogin', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['data']['FacebookLogin'] = $this->config->get('FacebookLogin');

		$this->data['modules'] = array();
		
		if ($this->config->get('facebooklogin_module')) { 
			$this->data['modules'] = $this->config->get('facebooklogin_module');
		}
				
		$this->load->model('design/layout');
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->load->model('setting/store');
		$this->data['stores'] = array_merge(array(0 => array('store_id' => '0', 'name' => $this->config->get('config_name') . ' (' .$this->data['text_default'] . ')', 'url' => NULL, 'ssl' => NULL)), $this->model_setting_store->getStores());
		
		$this->template = 'module/facebooklogin.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	public function uninstall() {
		if (!$this->user->hasPermission('modify', 'module/facebooklogin')) {
			$this->language->load('module/facebooklogin');
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('module/facebooklogin', 'token=' . $this->session->data['token'], 'SSL'));
		} else {
			$this->load->model('module/facebooklogin');
			$this->model_module_facebooklogin->deleteSetting('FacebookLogin');	
		}
	}
}
?>