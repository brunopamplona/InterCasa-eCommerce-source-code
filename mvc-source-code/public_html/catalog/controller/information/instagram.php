<?php 
       class ControllerInformationInstagram extends Controller {
	public function index() {

        $this->load->model('setting/setting');
        $this->language->load('information/instagram');
        $this->data['heading_title'] = $this->language->get('heading_title');
      
        $this->language->load('information/information');
        $this->language->load('information/instagram');

		

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
			'separator' => false
		);
                $this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('bread_title'),
				'href'      => $this->url->link('information/instagram'),      		
				'separator' => $this->language->get('text_separator')
			);
                $this->data['button_continue'] = $this->language->get('button_continue');
                 $this->data['instansive']= html_entity_decode($this->config->get('instansive'));
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/instagram.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/information/instagram.tpl';
			} else {
				$this->template = 'default/template/information/instagram.tpl';
			}
               $this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);

			$this->response->setOutput($this->render());         
    }

}
 ?>