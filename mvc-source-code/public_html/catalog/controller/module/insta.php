<?php
class ControllerModuleInsta extends Controller {
	protected function index($setting) {
		static $module = 0;
		
		$this->load->model('setting/setting');
		
			
		
                        
		$this->language->load('module/insta');
		
      	$this->data['heading_title'] = $this->language->get('heading_title');
		
		
				
		
		
		$this->data['setting'] = $setting;
		
		

		
		
		$this->data['module'] = $module++;
                 $this->data['instansive']="";
                 $this->data['instansive']= html_entity_decode($this->config->get('instansive'));
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/insta.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/insta.tpl';
		} else {
			$this->template = 'default/template/module/insta.tpl';
		}

		$this->render(); 
	}
}
?>