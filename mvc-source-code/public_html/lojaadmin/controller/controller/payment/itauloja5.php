<?php 
class ControllerPaymentItauLoja5 extends Controller {
	private $error = array(); 
	 
	public function index() { 
		$this->language->load('payment/itauloja5');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('itauloja5', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
				
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');		
		$this->data['entry_total'] = $this->language->get('entry_total');	
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
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
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/itauloja5', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('payment/itauloja5', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');	
		
		if (isset($this->request->post['itauloja5_nome'])) {
			$this->data['itauloja5_nome'] = $this->request->post['itauloja5_nome'];
		} else {
			$this->data['itauloja5_nome'] = $this->config->get('itauloja5_nome'); 
		}
		
		if (isset($this->request->post['itauloja5_cedente'])) {
			$this->data['itauloja5_cedente'] = $this->request->post['itauloja5_cedente'];
		} else {
			$this->data['itauloja5_cedente'] = $this->config->get('itauloja5_cedente'); 
		}
		
		if (isset($this->request->post['itauloja5_cpfcnpj'])) {
			$this->data['itauloja5_cpfcnpj'] = $this->request->post['itauloja5_cpfcnpj'];
		} else {
			$this->data['itauloja5_cpfcnpj'] = $this->config->get('itauloja5_cpfcnpj'); 
		}
		
		if (isset($this->request->post['itauloja5_endereco'])) {
			$this->data['itauloja5_endereco'] = $this->request->post['itauloja5_endereco'];
		} else {
			$this->data['itauloja5_endereco'] = $this->config->get('itauloja5_endereco'); 
		}
		
		if (isset($this->request->post['itauloja5_conta'])) {
			$this->data['itauloja5_conta'] = $this->request->post['itauloja5_conta'];
		} else {
			$this->data['itauloja5_conta'] = $this->config->get('itauloja5_conta'); 
		}
		
		if (isset($this->request->post['itauloja5_contadg'])) {
			$this->data['itauloja5_contadg'] = $this->request->post['itauloja5_contadg'];
		} else {
			$this->data['itauloja5_contadg'] = $this->config->get('itauloja5_contadg'); 
		}
		
		if (isset($this->request->post['itauloja5_agencia'])) {
			$this->data['itauloja5_agencia'] = $this->request->post['itauloja5_agencia'];
		} else {
			$this->data['itauloja5_agencia'] = $this->config->get('itauloja5_agencia'); 
		}
		
		if (isset($this->request->post['itauloja5_agenciadg'])) {
			$this->data['itauloja5_agenciadg'] = $this->request->post['itauloja5_agenciadg'];
		} else {
			$this->data['itauloja5_agenciadg'] = $this->config->get('itauloja5_agenciadg'); 
		}
		
		if (isset($this->request->post['itauloja5_carteira'])) {
			$this->data['itauloja5_carteira'] = $this->request->post['itauloja5_carteira'];
		} else {
			$this->data['itauloja5_carteira'] = $this->config->get('itauloja5_carteira'); 
		}
		
		if (isset($this->request->post['itauloja5_taxa'])) {
			$this->data['itauloja5_taxa'] = $this->request->post['itauloja5_taxa'];
		} else {
			$this->data['itauloja5_taxa'] = $this->config->get('itauloja5_taxa'); 
		}
		
		if (isset($this->request->post['itauloja5_dias'])) {
			$this->data['itauloja5_dias'] = $this->request->post['itauloja5_dias'];
		} else {
			$this->data['itauloja5_dias'] = $this->config->get('itauloja5_dias'); 
		}
		
		if (isset($this->request->post['itauloja5_demo1'])) {
			$this->data['itauloja5_demo1'] = $this->request->post['itauloja5_demo1'];
		} else {
			$this->data['itauloja5_demo1'] = $this->config->get('itauloja5_demo1'); 
		}
		
		if (isset($this->request->post['itauloja5_demo2'])) {
			$this->data['itauloja5_demo2'] = $this->request->post['itauloja5_demo2'];
		} else {
			$this->data['itauloja5_demo2'] = $this->config->get('itauloja5_demo2'); 
		}
		
		if (isset($this->request->post['itauloja5_demo3'])) {
			$this->data['itauloja5_demo3'] = $this->request->post['itauloja5_demo3'];
		} else {
			$this->data['itauloja5_demo3'] = $this->config->get('itauloja5_demo3'); 
		}
		
		if (isset($this->request->post['itauloja5_ins1'])) {
			$this->data['itauloja5_ins1'] = $this->request->post['itauloja5_ins1'];
		} else {
			$this->data['itauloja5_ins1'] = $this->config->get('itauloja5_ins1'); 
		}
		
		if (isset($this->request->post['itauloja5_ins2'])) {
			$this->data['itauloja5_ins2'] = $this->request->post['itauloja5_ins2'];
		} else {
			$this->data['itauloja5_ins2'] = $this->config->get('itauloja5_ins2'); 
		}
		
		if (isset($this->request->post['itauloja5_ins3'])) {
			$this->data['itauloja5_ins3'] = $this->request->post['itauloja5_ins3'];
		} else {
			$this->data['itauloja5_ins3'] = $this->config->get('itauloja5_ins3'); 
		}
		
		if (isset($this->request->post['itauloja5_ins4'])) {
			$this->data['itauloja5_ins4'] = $this->request->post['itauloja5_ins4'];
		} else {
			$this->data['itauloja5_ins4'] = $this->config->get('itauloja5_ins4'); 
		}
		
		if (isset($this->request->post['itauloja5_total'])) {
			$this->data['itauloja5_total'] = $this->request->post['itauloja5_total'];
		} else {
			$this->data['itauloja5_total'] = $this->config->get('itauloja5_total'); 
		}
				
		if (isset($this->request->post['itauloja5_order_status_id'])) {
			$this->data['itauloja5_order_status_id'] = $this->request->post['itauloja5_order_status_id'];
		} else {
			$this->data['itauloja5_order_status_id'] = $this->config->get('itauloja5_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['itauloja5_geo_zone_id'])) {
			$this->data['itauloja5_geo_zone_id'] = $this->request->post['itauloja5_geo_zone_id'];
		} else {
			$this->data['itauloja5_geo_zone_id'] = $this->config->get('itauloja5_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');						
		
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['itauloja5_status'])) {
			$this->data['itauloja5_status'] = $this->request->post['itauloja5_status'];
		} else {
			$this->data['itauloja5_status'] = $this->config->get('itauloja5_status');
		}
		
		if (isset($this->request->post['itauloja5_sort_order'])) {
			$this->data['itauloja5_sort_order'] = $this->request->post['itauloja5_sort_order'];
		} else {
			$this->data['itauloja5_sort_order'] = $this->config->get('itauloja5_sort_order');
		}

		$this->template = 'payment/itauloja5.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	protected function validate() {
		return true;	
	}
}
?>