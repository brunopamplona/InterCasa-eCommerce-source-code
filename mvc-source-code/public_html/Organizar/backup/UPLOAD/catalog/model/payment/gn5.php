<?php 
class ModelPaymentGN5 extends Model {
	public function getMethod($address, $total) {
		$this->language->load('payment/cod');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('gn5_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if ($this->config->get('gn5_total') > 0 && $this->config->get('gn5_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('gn5_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}	

		$method_data = array();
		
		$mod = $this->config->get('gn5_cartao');
		if(!$mod){
			$status = false;
		}

		if ($status) {  
			$method_data = array(
				'code'       => 'gn5',
				'terms'      => '',
				'title'      => $this->config->get('gn5_titulo'),
				'sort_order' => $this->config->get('gn5_sort_order')
			);
		}

		return $method_data;
	}
}
?>