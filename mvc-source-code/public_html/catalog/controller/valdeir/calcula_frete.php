<?php

Class ControllerValdeirCalculaFrete extends Controller{
	
	public function index(){
		//Carrega o arquivo responsável por calcular o frete
		require_once 'catalog/controller/checkout/cart.php';
		
		//Instancia a classe do arquivo acima
		$class = 'ControllerCheckoutCart';
		$ControllerCheckoutCart = new $class($this->registry);
		
		//Captura todos os produtos do carrinho
		$products = $this->cart->getProducts();
		
		if ($products):
			//Limpa o carrinho
			$this->cart->clear();
			
			foreach($products as $key => $value):
				//Captura o id do produto
				$product_id = explode(':',$value['product_id']);
				$product[$key]['product_id'] = $product_id[0];
				
				//Captura a quantidade do produto
				$product[$key]['quantity'] = $value['quantity'];
				
				//Zera as opções do produto
				$product[$key]['option'] = null;
				
				//Verifica e captura as opções definidas do produto
				foreach($value['option'] as $option):
					
					//Captura o valor das opções caso o tipo seja diferente de Select, Radio ou Checkox
					if (empty($option['product_option_value_id'])):
						$product[$key]['option'][$option['product_option_id']] = $option['option_value'];
					else:
						//Verifica se a opção é checkbox
						if ($option['type'] != 'checkbox'):
							$product[$key]['option'][$option['product_option_id']] = $option['product_option_value_id'];
						else:
							$product[$key]['option'][$option['product_option_id']][] = $option['product_option_value_id'];
						endif;
					endif;
				endforeach;
			endforeach;
		endif;
		
		//Adiciona o produto selecionado ao carrinho para o calculo do frete
		$ControllerCheckoutCart->add();
		
		//Define um país
		$this->request->post['country_id'] = isset($this->session->data['shipping_address']['country_id']) ? $this->session->data['shipping_address']['country_id'] : 1;
		
		//Define um estado
		$this->request->post['zone_id'] = isset($this->session->data['shipping_address']['zone_id']) ? $this->session->data['shipping_address']['zone_id'] : 1;
		
		//var_dump($this->cart->getProducts());
		
		//Cálcula o valor do frete
		$ControllerCheckoutCart->quote();
		
		//Limpa o carrinho
		$this->cart->clear();
		
		//Re-adiciona os produtos no carrinho
		if ($products):
			foreach($product as $key):
				$this->cart->add($key['product_id'], $key['quantity'], $key['option']);
			endforeach;
		endif;
	}
	
}