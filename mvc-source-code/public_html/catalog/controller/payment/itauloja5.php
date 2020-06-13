<?php
class ControllerPaymentItauLoja5 extends Controller {
	protected function index() {
    	$this->data['button_confirm'] = $this->language->get('button_confirm');
		$this->data['continue'] = $this->url->link('checkout/success');
		$this->data['pedido'] = $this->session->data['order_id'];
		$this->data['url_boleto'] = $this->url->link('payment/itauloja5/gerarboleto&pedido='.$this->session->data['order_id'].'');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/itauloja5.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/itauloja5.tpl';
		} else {
			$this->template = 'default/template/payment/itauloja5.tpl';
		}	
		
		$this->render();
	}
	
	public function gerarboleto(){
	
	//pega o pedido de acordo o ped
	if(isset($_GET['pedido']) && $_GET['pedido']>0){
	$numero_do_pedido = (int)$_GET['pedido'];
	}else{
	echo "Ops, pedido n&atilde;o encontrado ou invalido!";
	exit;
	}
	$this->load->model('account/customer');
	if (!$this->customer->isLogged()) {  
      		$this->redirect($this->url->link('account/login', '', 'SSL'));
    }
	
	//pega os dados do cliente
	$this->load->model('checkout/order');
	$pedido = $this->model_checkout_order->getOrder($numero_do_pedido);
	$pedidoId = $pedido['order_id'];
	
	// DADOS DO BOLETO PARA O SEU CLIENTE
	$dias_de_prazo_para_pagamento = (int)$this->config->get('itauloja5_dias');
	$taxa_boleto = (float)$this->config->get('itauloja5_taxa');
	$data_venc = date("d/m/Y", strtotime($pedido['date_added']) + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
	$valor_cobrado = $pedido['total']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
	$valor_cobrado = str_replace(",", ".",$valor_cobrado);
	$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

	$dadosboleto["nosso_numero"] = str_pad($pedidoId, 8, "0", STR_PAD_LEFT);  // Nosso numero sem o DV - REGRA: Máximo de 11 caracteres!
	$dadosboleto["numero_documento"] = $dadosboleto["nosso_numero"];	// Num do pedido ou do documento = Nosso numero
	$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
	$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
	$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
	$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

	// DADOS DO SEU CLIENTE
	$dadosboleto["sacado"] = $pedido['payment_firstname']." ".$pedido['payment_lastname'];
	$dadosboleto["endereco1"] = $pedido['payment_address_1'];
	$dadosboleto["endereco2"] = "".$pedido['payment_city']." | ".$pedido['payment_zone']." -  CEP: ".$pedido['payment_postcode']."";

	// INFORMACOES PARA O CLIENTE
	$dadosboleto["demonstrativo1"] = $this->config->get('itauloja5_demo1');
	$dadosboleto["demonstrativo2"] = $this->config->get('itauloja5_demo2');
	$dadosboleto["demonstrativo3"] = $this->config->get('itauloja5_demo3');
	$dadosboleto["instrucoes1"] = $this->config->get('itauloja5_ins1');
	$dadosboleto["instrucoes2"] = $this->config->get('itauloja5_ins2');
	$dadosboleto["instrucoes3"] = $this->config->get('itauloja5_ins3');
	$dadosboleto["instrucoes4"] = $this->config->get('itauloja5_ins4');

	// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
	$dadosboleto["quantidade"] = "";
	$dadosboleto["valor_unitario"] = "";
	$dadosboleto["aceite"] = "";		
	$dadosboleto["especie"] = "R$";
	$dadosboleto["especie_doc"] = "";


	// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


	// DADOS DA SUA CONTA
	$dadosboleto["agencia"] = $this->config->get('itauloja5_agencia'); // Num da agencia, sem digito
	$dadosboleto["conta"] = $this->config->get('itauloja5_conta'); 	// Num da conta, sem digito
	$dadosboleto["conta_dv"] = $this->config->get('itauloja5_contadg'); 	// Digito do Num da conta

	// DADOS PERSONALIZADOS3
	$dadosboleto["carteira"] = str_pad($this->config->get('itauloja5_carteira'), 3, "0", STR_PAD_LEFT);

	// SEUS DADOS
	$dadosboleto["identificacao"] = "Boleto Online";
	$dadosboleto["cpf_cnpj"] = $this->config->get('itauloja5_cpfcnpj');
	$dadosboleto["endereco"] = $this->config->get('itauloja5_endereco');
	$dadosboleto["cidade_uf"] = "";
	$dadosboleto["cedente"] = $this->config->get('itauloja5_cedente');

	// NÃO ALTERAR!
	include("app/itau/include/funcoes_itau.php"); 
	include("app/itau/include/layout_itau.php");
	}
	
	public function confirm() {
		$this->load->model('checkout/order');
		$link = $this->url->link('payment/itauloja5/gerarboleto&pedido='.$this->session->data['order_id'].'');
		$msg = "Segunda via do Boleto: <a href='".$link."' target='_blank'>CLIQUE AQUI!</a>";
		$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('itauloja5_order_status_id'),$msg,true);
	}
}
?>