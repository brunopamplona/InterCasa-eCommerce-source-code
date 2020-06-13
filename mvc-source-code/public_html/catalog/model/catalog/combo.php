<?php
//OpenCart Extension
//Project Name: OpenCart Combo/Bundle
//Author: Fanha Giang a.k.a fanha99
//Email (PayPal Account): fanha99@gmail.com
//License: Commercial
?>
<?php
class ModelCatalogCombo extends Model {
	public function getProductCombos($product_id) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$st = "SELECT co.*, name, discount FROM `" . DB_PREFIX . "fanha_combo` co LEFT JOIN `" . DB_PREFIX . "fanha_combo_product` cp ON ( co.combo_id = cp.combo_id ) LEFT JOIN `" . DB_PREFIX . "fanha_combo_description` cd ON ( co.combo_id = cd.combo_id ) LEFT JOIN `" . DB_PREFIX . "fanha_combo_to_store` cs ON ( co.combo_id = cs.combo_id ) LEFT JOIN `" . DB_PREFIX . "fanha_combo_special` cs2 ON ( co.combo_id = cs2.combo_id ) WHERE ";
		if ($this->config->get('combo_only_key')) {
			$st = $st . "cp.key_product = '1' AND ";
		}
		$st = $st . " co.status ='1' AND cp.product_id ='" . (int)$product_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cs.store_id = '" . (int)$this->config->get('config_store_id') . "' AND cs2.customer_group_id = '" . (int)$customer_group_id . "' AND ((cs2.date_start = '0000-00-00' OR cs2.date_start < NOW( )) AND (cs2.date_end = '0000-00-00'OR cs2.date_end > NOW( ))) ORDER BY cs2.priority ASC";
		$query = $this->db->query($st);
		return $query->rows;
	}
	
	public function countActiveCombos() {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}
		
		$query = $this->db->query("SELECT COUNT(DISTINCT co.combo_id) AS total FROM `" . DB_PREFIX . "fanha_combo` co LEFT JOIN `" . DB_PREFIX . "fanha_combo_description` cd ON ( co.combo_id = cd.combo_id ) LEFT JOIN `" . DB_PREFIX . "fanha_combo_to_store` cs ON ( co.combo_id = cs.combo_id ) LEFT JOIN `" . DB_PREFIX . "fanha_combo_special` cs2 ON ( co.combo_id = cs2.combo_id ) 
								WHERE co.status ='1' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cs.store_id = '" . (int)$this->config->get('config_store_id') . "' AND cs2.customer_group_id = '" . (int)$customer_group_id . "' AND ((cs2.date_start = '0000-00-00' OR cs2.date_start < NOW( )) AND (cs2.date_end = '0000-00-00'OR cs2.date_end > NOW( ))) ORDER BY cs2.priority ASC");
		if (isset($query->row['total'])) {
			return $query->row['total'];
		} else {
			return 0;	
		}		
	}

	public function getActiveCombos($data = array()) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}
		
		$limit = "";
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$limit = " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
				
		$query = $this->db->query("SELECT co.*, name, discount FROM `" . DB_PREFIX . "fanha_combo` co LEFT JOIN `" . DB_PREFIX . "fanha_combo_description` cd ON ( co.combo_id = cd.combo_id ) LEFT JOIN `" . DB_PREFIX . "fanha_combo_to_store` cs ON ( co.combo_id = cs.combo_id ) LEFT JOIN `" . DB_PREFIX . "fanha_combo_special` cs2 ON ( co.combo_id = cs2.combo_id ) 
								WHERE co.status ='1' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cs.store_id = '" . (int)$this->config->get('config_store_id') . "' AND cs2.customer_group_id = '" . (int)$customer_group_id . "' AND ((cs2.date_start = '0000-00-00' OR cs2.date_start < NOW( )) AND (cs2.date_end = '0000-00-00'OR cs2.date_end > NOW( ))) ORDER BY cs2.priority ASC" . $limit);
		return $query->rows;
	}
	
	public function getComboProducts($combo_id) {
		$products_id = array();
		$query = $this->db->query("SELECT product_id, quantity FROM `" . DB_PREFIX . "fanha_combo_product` WHERE combo_id='" . (int)$combo_id . "'");
		foreach ($query->rows as $result) { 
			$products_id[$result['product_id']] = $result;
		}
		return $products_id;
	}
	
	public function getComboInfo($combo_id) {		
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "fanha_combo` co LEFT JOIN `" . DB_PREFIX . "fanha_combo_description` cd ON ( co.combo_id = cd.combo_id ) LEFT JOIN `" . DB_PREFIX . "fanha_combo_to_store` cs ON ( co.combo_id = cs.combo_id ) LEFT JOIN `" . DB_PREFIX . "fanha_combo_special` cs2 ON ( co.combo_id = cs2.combo_id ) 
								WHERE co.combo_id = '" . $combo_id . "' AND co.status ='1' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cs.store_id = '" . (int)$this->config->get('config_store_id') . "' AND cs2.customer_group_id = '" . (int)$customer_group_id . "' AND ((cs2.date_start = '0000-00-00' OR cs2.date_start < NOW( )) AND (cs2.date_end = '0000-00-00'OR cs2.date_end > NOW( )))");
		return $query->row;
	}
}
?>