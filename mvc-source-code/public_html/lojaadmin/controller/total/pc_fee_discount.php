<?php
/***********************************************************************
  Extension: People's Code - Fee / Discount v1.2
  Copyright (C) 2013 People's Code
  Email: info.peoplescode@gmail.com
  Web: http://www.peoplescode.com
************************************************************************/
class ControllerTotalPcFeeDiscount extends Controller {
  private $error = array();
	 
  public function index() {
    $this->language->load('total/pc_fee_discount');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
		
			$this->model_setting_setting->editSetting('pc_fee_discount', $this->request->post);

			if (!isset($this->error['warning'])) {
				$this->session->data['success'] = $this->language->get('text_success');
			}
			
			$this->redirect($this->url->link('total/pc_fee_discount', 'token=' . $this->session->data['token'], 'SSL'));

		}

		// Heading
		$this->data['heading_title'] = $this->language->get('heading_title');
    // Text
		$this->data['text_pfd_help'] = $this->language->get('text_pfd_help');
		$this->data['text_pfd_shipping_address'] = $this->language->get('text_pfd_shipping_address');
		$this->data['text_pfd_payment_address'] = $this->language->get('text_pfd_payment_address');
		$this->data['text_pfd_sub_total'] = $this->language->get('text_pfd_sub_total');
		$this->data['text_pfd_total'] = $this->language->get('text_pfd_total');
		$this->data['text_pfd_enable_more'] = $this->language->get('text_pfd_enable_more');
		$this->data['text_pfd_enable_less'] = $this->language->get('text_pfd_enable_less');
		$this->data['text_pfd_fixed'] = $this->language->get('text_pfd_fixed');
		$this->data['text_pfd_percentage'] = $this->language->get('text_pfd_percentage');
		$this->data['text_pfd_serial'] = $this->language->get('text_pfd_serial');
		$this->data['text_pfd_parallel'] = $this->language->get('text_pfd_parallel');
		$this->data['text_pfd_expand'] = $this->language->get('text_pfd_expand');
		$this->data['text_pfd_collapse'] = $this->language->get('text_pfd_collapse');
		$this->data['text_pfd_one_step_up'] = $this->language->get('text_pfd_one_step_up');
		$this->data['text_pfd_one_step_down'] = $this->language->get('text_pfd_one_step_down');
		$this->data['text_pfd_up'] = $this->language->get('text_pfd_up');
		$this->data['text_pfd_down'] = $this->language->get('text_pfd_down');
		$this->data['text_pfd_add'] = $this->language->get('text_pfd_add');
		$this->data['text_pfd_remove'] = $this->language->get('text_pfd_remove');
		$this->data['text_pfd_confirm'] = $this->language->get('text_pfd_confirm');
		$this->data['text_pfd_default'] = $this->language->get('text_pfd_default');
		$this->data['text_pfd_light'] = $this->language->get('text_pfd_light');
    // Help
    $this->data['help_conditions_h'] = $this->language->get('help_conditions_h');
    $this->data['help_conditions'] = $this->language->get('help_conditions');
    $this->data['help_fee_discount_h'] = $this->language->get('help_fee_discount_h');
    $this->data['help_fee_discount'] = $this->language->get('help_fee_discount');
    // Column
		$this->data['text_pfd_conditions'] = $this->language->get('text_pfd_conditions');
		$this->data['text_pfd_fee'] = $this->language->get('text_pfd_fee');
		// Entry
		$this->data['entry_pfd_shipping'] = $this->language->get('entry_pfd_shipping');
		$this->data['entry_pfd_payment'] = $this->language->get('entry_pfd_payment');
		$this->data['entry_pfd_enable_if'] = $this->language->get('entry_pfd_enable_if');
		$this->data['entry_pfd_customer_group'] = $this->language->get('entry_pfd_customer_group');
		$this->data['entry_pfd_geo_zone'] = $this->language->get('entry_pfd_geo_zone');
		$this->data['entry_pfd_cust_geo_zone'] = $this->language->get('entry_pfd_cust_geo_zone');
		$this->data['entry_pfd_amount'] = $this->language->get('entry_pfd_amount');
		$this->data['entry_pfd_compute'] = $this->language->get('entry_pfd_compute');
		$this->data['entry_pfd_tax_class'] = $this->language->get('entry_pfd_tax_class');
		$this->data['entry_pfd_translations'] = $this->language->get('entry_pfd_translations');
		$this->data['entry_style'] = $this->language->get('entry_style');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
	  // Button		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
    // From main language file
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_select_all'] = $this->language->get('text_select_all');
		$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['enable_amount'])) {
			$this->data['error_enable_amount'] = $this->error['enable_amount'];
		} else {
			$this->data['error_enable_amount'] = array();
		}

		if (isset($this->error['fee'])) {
			$this->data['error_fee'] = $this->error['fee'];
		} else {
			$this->data['error_fee'] = array();
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
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
      'href'      => $this->url->link('total/pc_fee_discount', 'token=' . $this->session->data['token'], 'SSL'),
      'separator' => ' :: '
      );
		
		$this->data['action'] = $this->url->link('total/pc_fee_discount', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');


    // Get installed extensions
		$this->load->model('setting/extension');

		$shipping_extensions = $this->model_setting_extension->getInstalled('shipping');
		$this->data['shipping_extensions'] = array();
		$shipping_filepaths = glob(DIR_APPLICATION . 'controller/shipping/*.php');						

		// Shipping
		if ($shipping_filepaths) {
			foreach ($shipping_filepaths as $shipping_filepath) {
				$extension_name = basename($shipping_filepath, '.php');

				if (in_array($extension_name, $shipping_extensions)) {
				
					$this->language->load('shipping/' . $extension_name);
								
					$this->data['shipping_extensions'][] = array(
						'name'       => $this->language->get('heading_title'),
						'filename'   => $extension_name
					  );
				}
			}
		}

    // Payment
		$payment_extensions = $this->model_setting_extension->getInstalled('payment');
		$this->data['payment_extensions'] = array();
		$payment_filepaths = glob(DIR_APPLICATION . 'controller/payment/*.php');

		if ($payment_filepaths) {
			foreach ($payment_filepaths as $payment_filepath) {
				$extension_name = basename($payment_filepath, '.php');

				if (in_array($extension_name, $payment_extensions)) {
				
					$this->language->load('payment/' . $extension_name);
								
					$this->data['payment_extensions'][] = array(
						'name'       => $this->language->get('heading_title'),
						'filename'   => $extension_name
					  );
				}
			}
		}

    // END Get installed extensions

		$this->data['pc_fee_discount_rows'] = array();

		if (isset($this->request->post['pc_fee_discount_rows'])) {
			$this->data['pc_fee_discount_rows'] = $this->request->post['pc_fee_discount_rows'];
		} elseif ($this->config->get('pc_fee_discount_rows')) {
			$this->data['pc_fee_discount_rows'] = $this->config->get('pc_fee_discount_rows');
		}

    $this->load->model('sale/customer_group');
		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

    $this->load->model('localisation/geo_zone');
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		$this->load->model('localisation/tax_class');
		$this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['pc_fee_discount_style'])) {
			$this->data['pc_fee_discount_style'] = $this->request->post['pc_fee_discount_style'];
		} elseif ($this->config->get('pc_fee_discount_style')) {
			$this->data['pc_fee_discount_style'] = $this->config->get('pc_fee_discount_style');
		}

		if (isset($this->request->post['pc_fee_discount_status'])) {
			$this->data['pc_fee_discount_status'] = $this->request->post['pc_fee_discount_status'];
		} elseif ($this->config->get('pc_fee_discount_status')) {
			$this->data['pc_fee_discount_status'] = $this->config->get('pc_fee_discount_status');
		}

		if (isset($this->request->post['pc_fee_discount_sort_order'])) {
			$this->data['pc_fee_discount_sort_order'] = $this->request->post['pc_fee_discount_sort_order'];
		} else {
			$this->data['pc_fee_discount_sort_order'] = $this->config->get('pc_fee_discount_sort_order');
		}


		$this->template = 'total/pc_fee_discount.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		  );
				
		$this->response->setOutput($this->render());

	} // index


	protected function validate() {
		if (!$this->user->hasPermission('modify', 'total/pc_fee_discount')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (isset($this->request->post['pc_fee_discount_rows'])) {

      // Reindex "pc_fee_discount_rows" array before submit
      $this->request->post['pc_fee_discount_rows'] = array_values($this->request->post['pc_fee_discount_rows']);

      $payment_id = 0;
		  foreach ($this->request->post['pc_fee_discount_rows'] as $pc_fee_discount_row) {

        if ($pc_fee_discount_row['enable_amount'] != FALSE && ($pc_fee_discount_row['enable_amount'] < 0 || !is_numeric($pc_fee_discount_row['enable_amount']))) {
          $this->error['enable_amount'][$payment_id] = $this->language->get('error_enable_amount');
          $this->error['warning'] = $this->language->get('error_check_form');
        }

        if ($pc_fee_discount_row['fee'] == FALSE) {
          $this->error['fee'][$payment_id] = $this->language->get('error_blank');
          $this->error['warning'] = $this->language->get('error_check_form');
        } elseif (!is_numeric($pc_fee_discount_row['fee'])) {
          $this->error['fee'][$payment_id] = $this->language->get('error_fee');
          $this->error['warning'] = $this->language->get('error_check_form');
        }

        $payment_id++;

		  }
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	} // validate


	public function install() {
    // Load Settings
    $this->load->model('setting/setting');

    // Initially place Payment Fee after sub-total 
    $this->data['pc_fee_discount_sort_order'] = $this->config->get('sub_total_sort_order') + 1;
    $this->model_setting_setting->editSetting('pc_fee_discount', $this->data);
	} // install


}
?>
