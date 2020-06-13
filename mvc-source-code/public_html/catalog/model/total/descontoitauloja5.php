<?php
class ModelTotalDescontoItauLoja5 extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {

		if ($this->config->get('descontoitauloja5_status') && isset($this->session->data['payment_method']['code']) && $this->session->data['payment_method']['code']=='itauloja5') {
			$this->language->load('total/credit');
		 
			$total_pedido = $this->cart->getSubTotal();
			$desconto = (float)$this->config->get('descontoitauloja5_desconto');
			
			if ((float)$total_pedido && $desconto>0) {
				
				$credit = ($total_pedido/100)*$desconto;
				
				if ($credit > 0) {
					$total_data[] = array(
						'code'       => 'descontoitauloja5',
						'title'      => "Desconto ".$desconto."% no Boleto",
						'text'       => $this->currency->format(-$credit),
						'value'      => -$credit,
						'sort_order' => $this->config->get('descontoitauloja5_sort_order')
					);
					
					$total -= $credit;
				}
			}
		}
	}
	
	public function confirm($order_info, $order_total) {
		return true;
	}	
}
?>