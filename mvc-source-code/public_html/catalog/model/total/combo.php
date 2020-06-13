<?php
//OpenCart Extension
//Project Name: OpenCart Combo/Bundle
//Author: Fanha Giang a.k.a fanha99
//Email (PayPal Account): fanha99@gmail.com
//License: Commercial
?>
<?php
class ModelTotalCombo extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		$this->language->load('total/combo');

		$discount_total = 0;
		
		$products = array();
		
		foreach ($this->cart->getProducts() as $product) {
			$ps_id = explode(':', $product['key'], 2);
			if (isset($products[$ps_id[0]])) {
				$products[$ps_id[0]] += $product['quantity'];
			} else {
				$products[$ps_id[0]] = $product['quantity'];
			}
		}
	
		$this->load->model('catalog/combo');
		$combos = $this->model_catalog_combo->getActiveCombos();

		foreach ($combos as $combo) {			
			$ps = $this->model_catalog_combo->getComboProducts($combo['combo_id']);
			$testdiff = array_diff_key($ps, $products);
			if (empty($testdiff)) {			
				$times = (int)1000000;
				
				foreach ($ps as $p) {
					$t = (int)($products[$p['product_id']] / $p['quantity']);
					if ($t < $times) $times = $t;
				}
				
				$discount_total += $times * $combo['discount'];
				
				foreach ($ps as $p) {
					$products[$p['product_id']] -= ($times * $p['quantity']);
					if ($products[$p['product_id']] == 0) {
						unset($products[$p['product_id']]);
					}
				}
			}
		}
		
		if ($discount_total != 0) {			
			$total_data[] = array( 
				'code'       => 'combo',
				'title'      => $this->language->get('text_combo_discount'),
				'text'       => '-' . $this->currency->format($discount_total),
				'value'      => -$discount_total,
				'sort_order' => $this->config->get('combo_sort_order')
			);
		}
		$total -= $discount_total;
					
	}
}
?>