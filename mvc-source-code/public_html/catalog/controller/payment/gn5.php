<?php
include("app/gn5/api.php");
//use Gerencianet\Exception\GerencianetException;
//use Gerencianet\Gerencianet;

class ControllerPaymentGN5 extends Controller {
	public function index() {	
		$this->load->model('checkout/order');
		$this->language->load('payment/cod');
		
		//meios
		$this->data['ca'] = false;
		$this->data['bo'] = false;
		$this->data['cc'] = $this->config->get('gn5_cartao');
		
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
	
	public function criar() {
		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
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
		
		$params = ['id' => (int)$_POST['orderid']];
		
		if($_POST['meio']=='boleto'){

		//boleto
		$log = 'Boleto - Transação '.$_POST['orderid'].' ';
		$add_days = 4;
		$data = strtotime($order_info['date_added']);
		$data_vencimento = date('Y-m-d',$data + (24*3600*$add_days));
        $fiscal = preg_replace('/\D/', '', $_POST['fiscal']);
        
        if(strlen($fiscal)==11){
            $customer = [
                'name' => utf8_encode(preg_replace('/\s+/', ' ',trim($order_info['firstname']).' '.trim($order_info['lastname']))),
                'cpf' => $fiscal,
                'phone_number' => preg_replace('/\D/', '', $_POST['telefone'])
            ];
        }else{
            $juridical_data = array(
              'corporate_name' => utf8_encode(preg_replace('/\s+/', ' ',trim($order_info['firstname']).' '.trim($order_info['lastname']))),
              'cnpj' => $fiscal
            );
            $customer = [
                'name' => utf8_encode(preg_replace('/\s+/', ' ',trim($order_info['firstname']).' '.trim($order_info['lastname']))),
                'juridical_person' => $juridical_data,
                'phone_number' => preg_replace('/\D/', '', $_POST['telefone'])
            ];
        }
        
		$body = [
			'payment' => [
				'banking_billet' => [
					'expire_at' => $data_vencimento,
					'customer' => $customer
				]
			]
		];
		
		}else{

		//endereco
		$log = 'Cartão - Transação '.$_POST['orderid'].' em '.(int)$_POST['parcelas'].'x';
		$numero = $this->config->get('gn5_numero');
		$numero_logradouro = (isset($order_info[$numero]))?$order_info[$numero]:preg_replace('/\D/', '', $order_info['payment_address_1']);
		$logradouro = utf8_encode(trim(str_replace(',','',preg_replace('/\d+/','',$order_info['payment_address_1']))));
		$bairro = utf8_encode((empty($order_info['payment_address_2'])?'Bairro':$order_info['payment_address_2']));
		$cep = $order_info['payment_postcode'];
		$cidade = utf8_encode($order_info['payment_city']);
		$estado = $order_info['payment_zone_code'];	
			
		//cartao de credito
		$paymentToken = $_POST['token_cartao'];
        
        $fiscal = preg_replace('/\D/', '', $_POST['fiscal']);
        if(strlen($fiscal)==11){
            $customer = [
                'name' => utf8_encode(preg_replace('/\s+/', ' ',trim($order_info['firstname']).' '.trim($order_info['lastname']))),
                'cpf' => $fiscal,
                'phone_number' => preg_replace('/\D/', '', $_POST['telefone']),
                'email' => $order_info['email'],
                'birth' => $this->converte_data($_POST['data'])
            ];
        }else{
            $juridical_data = array(
              'corporate_name' => utf8_encode(preg_replace('/\s+/', ' ',trim($order_info['firstname']).' '.trim($order_info['lastname']))),
              'cnpj' => $fiscal
            );
            $customer = [
                'name' => utf8_encode(preg_replace('/\s+/', ' ',trim($order_info['firstname']).' '.trim($order_info['lastname']))),
                'juridical_person' => $juridical_data,
                'phone_number' => preg_replace('/\D/', '', $_POST['telefone']),
                'email' => $order_info['email'],
                'birth' => $this->converte_data($_POST['data'])
            ];
        }
        
		$billingAddress = [
			'street' => $logradouro,
			'number' => (!empty($numero_logradouro)?$numero_logradouro:'*'),
			'neighborhood' => (!empty($bairro)?$bairro:'*'),
			'zipcode' => preg_replace('/\D/', '', $cep),
			'city' => $cidade,
			'state' => $estado,
		];
		$body = [
			'payment' => [
				'credit_card' => [
					'installments' => (int)($_POST['parcelas']),
					'billing_address' => $billingAddress,
					'payment_token' => $paymentToken,
					'customer' => $customer
				]
			]
		];
			
		}

		$this->data['continue'] = $this->url->link('checkout/checkout','','SSL');
		
		try {
			$api = new Gerencianet($options);
			$charge = $api->payCharge($params, $body);

			$status_id = $this->status($charge['data']['status']);
		
			//se boleto segunda via
			if(isset($charge['data']['barcode'])){
				$log .= '<a href="'.$charge['data']['link'].'" target="_blank">[segunda via]</a>';
			}
			
			$this->model_checkout_order->confirm($this->session->data['order_id'],$status_id,$log,true);
			
			$ret = $this->url->link('payment/gn5/cupom&id='.$_POST['orderid'].'&venda='.$this->session->data['order_id'].'','','SSL');
			$this->redirect($ret);
			
		} catch (GerencianetException $e) {
		
		$this->document->setTitle('Erro na Transa&ccedil;&atilde;o');
		$this->document->setDescription('');
		$this->document->setKeywords('');
		$this->data['erro'] = $this->erro_exception($e->errorDescription);
		$this->template = 'default/template/payment/gn5_erro.tpl';
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);

		$this->response->setOutput($this->render());
			
		} catch (Exception $e) {
			
		$this->document->setTitle('Erro na Transa&ccedil;&atilde;o');
		$this->document->setDescription('');
		$this->document->setKeywords('');
        $erro = '';
        if(isset($e->errorDescription)){
            $erro = $e->errorDescription;
        }else{
            $erro = print_r($e,true);
        }
		$this->data['erro'] = $this->erro_exception($erro);
		$this->template = 'default/template/payment/gn5_erro.tpl';
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
	
	public function status($status){
		switch($status){
			case 'waiting':
			case 'new':
			return $this->config->get('gn5_in');
			break;
			case 'paid':
			return $this->config->get('gn5_pg');
			break;
			case 'canceled':
			return $this->config->get('gn5_ca');
			break;
			case 'unpaid':
			return $this->config->get('gn5_ne');
			break;
			case 'contested':
			return $this->config->get('gn5_di');
			break;
			case 'refunded':
			return $this->config->get('gn5_de');
			break;
		}
	}
	
	public function cupom(){
		$this->load->model('checkout/order');
		$this->document->setTitle('Resultado da Transa&ccedil;&atilde;o');
		$this->document->setDescription('');
		$this->document->setKeywords('');
		
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
		
		$params = ['id' => (int)$_GET['id']];
		try {
			
			$api = new Gerencianet($options);
			$charge = $api->detailCharge($params, []);
			$order_info = $this->model_checkout_order->getOrder($charge['data']['custom_id']);
			
			$this->data['erro'] = false;
			$this->data['iframe'] = $this->url->link('checkout/success','','SSL');
			$this->data['dados'] = $charge;
			$this->data['order'] = $order_info;
			$this->data['pedido'] = $order_info['order_id'];
			$this->data['status'] = $this->getStatusPagamento($charge['data']['status']);

		} catch (GerencianetException $e) {
			$this->data['erro'] = true;
			$this->data['msg'] = $e->errorDescription;
		} catch (Exception $e) {
			$this->data['erro'] = true;
			$this->data['msg'] = $e->getMessage();
		}
		
		$this->template = 'default/template/payment/gn5_recibo.tpl';
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
	
	public function ipn(){
		$this->load->model('checkout/order');

		if(isset($_POST['notification'])){
			
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
		$token = $_POST['notification'];
		$params = [
		  'token' => $token
		];
		try {
			$api = new Gerencianet($options);
			$notification = $api->getNotification($params, []);
			
			//pega a ultima interacao do sistema
			$detalhes = end($notification['data']);
			if(isset($detalhes['custom_id'])){
				$order = $this->model_checkout_order->getOrder($detalhes['custom_id']);
				$status_gerencianet = $this->status($detalhes['status']['current']);
				if($order['order_status_id']!=$status_gerencianet){
					$this->model_checkout_order->update($detalhes['custom_id'],$status_gerencianet,'',true);
				}
			}
			print_r($notification);
		} catch (GerencianetException $e) {
			print_r($e->code);
			print_r($e->error);
			print_r($e->errorDescription);
		} catch (Exception $e) {
			print_r($e->getMessage());
		}
		}
    }
	
	private function getStatusPagamento($status) {
		switch($status){
			case 'waiting':
			case 'new':
			return 'Aguardando Pagamento';
			break;
			case 'paid':
			return 'Pago';
			break;
			case 'canceled':
			return 'Cancelado';
			break;
			case 'unpaid':
			return 'N&atilde;o Pago';
			break;
			case 'contested':
			return 'Contestada';
			break;
			case 'refunded':
			return 'Devolvido';
			break;
		}
	}
}
?>