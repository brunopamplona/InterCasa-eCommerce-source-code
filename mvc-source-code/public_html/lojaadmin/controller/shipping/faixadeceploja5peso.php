<?php
class ControllerShippingfaixadeceploja5peso extends Controller {
	private $error = array(); 
	
	public function index() {
	
		$this->load->language('shipping/faixadeceploja5peso');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('faixadeceploja5peso', $this->request->post);		
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		
		$this->data['button_save'] = "Salvar";
		$this->data['button_cancel'] = "Cancelar";
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => "Inicio",
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => "Meios de Envio",
			'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('shipping/faixadeceploja5peso', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('shipping/faixadeceploja5peso', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['faixadeceploja5peso'])) {
			$this->data['modules'] = $this->request->post['faixadeceploja5peso'];
		} elseif ($this->config->get('faixadeceploja5peso')) { 
			$this->data['modules'] = $this->config->get('faixadeceploja5peso');
		}

        if (isset($this->request->post['faixadeceploja5peso_sort_order'])) {
			$this->data['faixadeceploja5peso_sort_order'] = $this->request->post['faixadeceploja5peso_sort_order'];
		} else {
			$this->data['faixadeceploja5peso_sort_order'] = $this->config->get('faixadeceploja5peso_sort_order');
		}
		
		if (isset($this->request->post['faixadeceploja5peso_status'])) {
			$this->data['faixadeceploja5peso_status'] = $this->request->post['faixadeceploja5peso_status'];
		} else {
			$this->data['faixadeceploja5peso_status'] = $this->config->get('faixadeceploja5peso_status');
		}
		
		if (isset($this->request->post['faixadeceploja5peso_nome'])) {
			$this->data['faixadeceploja5peso_nome'] = $this->request->post['faixadeceploja5peso_nome'];
		} else {
			$this->data['faixadeceploja5peso_nome'] = $this->config->get('faixadeceploja5peso_nome');
		}	
						
		$this->template = 'shipping/faixadeceploja5peso.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		return true;
	}
}
?>