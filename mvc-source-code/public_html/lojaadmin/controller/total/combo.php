<?php
//OpenCart Extension
//Project Name: Fanha Combo
//Author: Fanha Giang a.k.a fanha99
//Email (PayPal Account): fanha99@gmail.com
//License: Commercial
?>
<?php
class ControllerTotalCombo extends Controller {
	private $error = array(); 
	 
	public function index() { 
		$this->language->load('total/combo');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('combo', $this->request->post);
		
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title') . ' ' . $this->getVersion();

		$this->data['text_for_product_page'] = $this->language->get('text_for_product_page');
		$this->data['text_for_combo_page'] = $this->language->get('text_for_combo_page');
		$this->data['text_for_combos_page'] = $this->language->get('text_for_combos_page');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_product_page_image'] = $this->language->get('entry_product_page_image');
		$this->data['entry_width'] = $this->language->get('entry_width');
		$this->data['entry_height'] = $this->language->get('entry_height');
		$this->data['entry_only_key'] = $this->language->get('entry_only_key');
		$this->data['entry_stick_to_top'] = $this->language->get('entry_stick_to_top');
		$this->data['entry_append_category'] = $this->language->get('entry_append_category');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
					
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_total'),
			'href'      => $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('total/combo', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('total/combo', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['combo_status'])) {
			$this->data['combo_status'] = $this->request->post['combo_status'];
		} else {
			$this->data['combo_status'] = $this->config->get('combo_status');
		}

		if (isset($this->request->post['combo_sort_order'])) {
			$this->data['combo_sort_order'] = $this->request->post['combo_sort_order'];
		} else {
			$this->data['combo_sort_order'] = $this->config->get('combo_sort_order');
		}

		if (isset($this->request->post['combo_only_key'])) {
			$this->data['combo_only_key'] = $this->request->post['combo_only_key'];
		} else {
			$this->data['combo_only_key'] = $this->config->get('combo_only_key');
		}
		
		if (isset($this->request->post['combo_append_category'])) {
			$this->data['combo_append_category'] = $this->request->post['combo_append_category'];
		} else {
			$this->data['combo_append_category'] = $this->config->get('combo_append_category');
		}
		
		if (isset($this->request->post['combo_stick_to_top'])) {
			$this->data['combo_stick_to_top'] = $this->request->post['combo_stick_to_top'];
		} else {
			$this->data['combo_stick_to_top'] = $this->config->get('combo_stick_to_top');
		}
		
		if (isset($this->request->post['combo_image_product_width'])) {
			$this->data['combo_image_product_width'] = $this->request->post['combo_image_product_width'];
		} else {
			$this->data['combo_image_product_width'] = $this->config->get('combo_image_product_width');
		}
		
		if (isset($this->request->post['combo_image_product_height'])) {
			$this->data['combo_image_product_height'] = $this->request->post['combo_image_product_height'];
		} else {
			$this->data['combo_image_product_height'] = $this->config->get('combo_image_product_height');
		}
		
		if (isset($this->request->post['combo_image_combo_width'])) {
			$this->data['combo_image_combo_width'] = $this->request->post['combo_image_combo_width'];
		} else {
			$this->data['combo_image_combo_width'] = $this->config->get('combo_image_combo_width');
		}
		
		if (isset($this->request->post['combo_image_combo_height'])) {
			$this->data['combo_image_combo_height'] = $this->request->post['combo_image_combo_height'];
		} else {
			$this->data['combo_image_combo_height'] = $this->config->get('combo_image_combo_height');
		}
		
		if (isset($this->request->post['combo_meta_keyword'])) {
			$this->data['combo_meta_keyword'] = $this->request->post['combo_meta_keyword'];
		} else {
			$this->data['combo_meta_keyword'] = $this->config->get('combo_meta_keyword');
		}
		
		if (isset($this->request->post['combo_meta_description'])) {
			$this->data['combo_meta_description'] = $this->request->post['combo_meta_description'];
		} else {
			$this->data['combo_meta_description'] = $this->config->get('combo_meta_description');
		}
		
		$this->load->model('localisation/language');	
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		$this->template = 'total/combo.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'total/combo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	public function getVersion() {
		return 'v1.1.7';
	}
}
?>