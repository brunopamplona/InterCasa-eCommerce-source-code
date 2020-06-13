<?php
class ControllerPaymentGN5Boleto extends Controller {
	
	public function index() {
		$this->redirect($this->url->link('payment/gn5', 'token=' . $this->session->data['token'], 'SSL'));
	}

	protected function validate() {
		return true;	
	}
}
?>