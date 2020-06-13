<?php 
class ModelShippingfaixadeceploja5peso extends Model {    
  	public function getQuote($address) {
		$this->load->language('shipping/faixadeceploja5peso');
		
		$total_pedido = $this->cart->getWeight();
        $faixas = $this->config->get('faixadeceploja5peso');
		
		$quote_data = array();
		
		if(is_array($faixas)){

        $postcode = str_replace(' ', '', $address['postcode']);
        $postcode = str_replace('-', '', $postcode);
        $postcode = str_replace('.', '', $postcode);
		
		$regras = array (
				'de' => array(),
				'para' => array(),
				'total' => array(),
				'frete' => array(),
		);
		
		foreach($faixas AS $key=>$val){
		$regras['de'][$key] = $val['de'];
		$regras['para'][$key] = $val['para'];
		$regras['total'][$key] = $val['total'];
		$regras['frete'][$key] = $val['frete'];
		}
		
		$keys = array_keys($regras);
		
		for ($i = 0; $i < count($faixas); $i++) {
				if ($postcode>=$regras['de'][$i] && $postcode<=$regras['para'][$i] && $total_pedido <= $regras['total'][$i]) {
					$quote_data[$i] = array(
						'code'         => 'faixadeceploja5peso.'.$i.'',
						'title'        => $this->config->get('faixadeceploja5peso_nome'),
						'cost'         => $regras['frete'][$i],
						'tax_class_id' => 0,
						'text'         => $this->currency->format($this->tax->calculate($regras['frete'][$i], 0, $this->config->get('config_tax')))
		            );
					break;
				}
		}
		
		$method_data = array();
	
	    if($quote_data){
		$method_data = array(
        		'code'       => 'faixadeceploja5peso',
        		'title'      => $this->config->get('faixadeceploja5peso_nome'),
        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('faixadeceploja5peso_sort_order'),
        		'error'      => false
      	);
		}
	
		return $method_data;
		}
  	}

}
?>