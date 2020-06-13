<?php
include("app/gn5/api.php");
//use Gerencianet\Exception\GerencianetException;
//use Gerencianet\Gerencianet;

class ControllerPaymentGN5Boleto extends Controller {
	public function index() {	
		$this->load->model('checkout/order');
		$this->language->load('payment/cod');
		
		//meios
		$this->data['ca'] = false;
		$this->data['bo'] = $this->config->get('gn5_boleto');
		$this->data['cc'] = false;
		
		//modo
		$this->data['modo'] = $this->config->get('gn5_modo');
		
		//conta
		$this->data['conta'] = $this->config->get('gn5_conta');

		//opcoes gerencianet
		$options = array(
		"client_id"=>trim($this->config->get('gn5_id')),
		"client_secret"=>trim($this->config->get('gn5_sec')),
		"sandbox"=>(($this->data['modo']==0)?true:false),
		"debug"=>false
		);

		//retorno
		$this->data['url_criar'] = $this->url->link('payment/gn5/criar');
		
		//dados pedido
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		$this->data['pedido'] = $order_info;
		//print_r($order_info);
		
		//se ja vai com fiscal
		$fiscal = '';
		$custom_fiscal = $this->config->get('gn5_fiscal');
		if(isset($order_info[$custom_fiscal])){
		$fiscal = preg_replace('/\D/', '', $order_info[$custom_fiscal]);	
		}
		$this->data['fiscal'] = $fiscal;
		
		$items = [[
		'name' => 'Pedido #'.$order_info['order_id'].' em '.utf8_encode($order_info['store_name']).'',
		'amount' => 1,
		'value' => (float)number_format($order_info['total'], 2, '', '')
		]];
		
        //todos os itens  
		$body = [
		'items' => $items,
		'metadata' => [
			'custom_id' => (string)$order_info['order_id'],
			'notification_url' => $this->url->link('payment/gn5/ipn','','SSL'),
		]
		];
		
		try {
			
			$api = new Gerencianet($options);
			$this->data['charge'] = $api->createCharge([], $body);
			
			//totais
			$this->data['total_pedido'] = $this->currency->format($order_info['total']);
			
			//totais floatval
			$this->data['total_pedido_float'] = $order_info['total'];
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/gn5.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/gn5.tpl';
			} else {
				$this->template = 'default/template/payment/gn5.tpl';
			}
			$this->render();
			
		} catch (GerencianetException $e) {
			return $this->erro_exception($e->errorDescription);
		} catch (Exception $e) {
			return $this->erro_exception($e->getMessage());
		}
	}
	
	public function erro_exception($erro){
		return '<div class="alert alert-danger warning" role="alert"><i class="fa fa-exclamation-circle"></i> '.(is_array($erro)?$erro['message']:$erro).'</div>';
	}
	
	public function converte_data($data){
		$p = explode('/',$data);
		return @$p[2].'-'.@$p[1].'-'.@$p[0];
	}
}
?>