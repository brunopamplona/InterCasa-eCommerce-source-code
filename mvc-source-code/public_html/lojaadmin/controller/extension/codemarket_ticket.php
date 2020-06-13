<?php
//PROIBIDO MODIFICAR ESTE ARQUIVO
class ControllerExtensionCodemarketTicket extends Controller {
	public function index() {				
        $this->load->library('codemarketVal');
        $this->load->model('setting/setting');
        
        $this->data['codemarket_module'] = $this->url->link('extension/codemarket_module&token=' . $this->session->data['token'],'', 'SSL');

        $codemarket = new CodemarketVal();                    
        $conf = $this->model_setting_setting->getSetting('codemarket_val');
        if(!empty($conf)) {
            $email = $conf['codemarket_val_email'];
            $token = $conf['codemarket_val_token'];
            $this->data['dom'] = HTTP_CATALOG;
            $this->data['cliente'] = $token;
            $this->data['email'] = $email;
        }
        
        $this->data['ticketListar'] = 'https://www.codemarket.com.br/api/ticket/listar';

        $this->document->setTitle('Code Market - Tickets'); 

        $this->template = 'extension/codemarket_ticket.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
}