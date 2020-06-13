<?php
//OpenCart Extension
//Project Name: OpenCart Combo/Bundle
//Author: Fanha Giang a.k.a fanha99
//Email (PayPal Account): fanha99@gmail.com
//License: Commercial
?>
<?php
class ModelCatalogCombo extends Model {

	public function getTotalCombo($data = array()) {
		$sql = "SELECT COUNT(DISTINCT n.combo_id) AS total " . $this->Combo($data);
		//echo $sql;
		$query = $this->db->query($sql);
		$result = $query->row;		
		return $result['total'];
	}	
	
	public function getCombos($data = array()) {
		$sql = "SELECT DISTINCT n.* , nd.* " . $this->Combo($data);
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	private function Combo($data = array()) {
		$sql = " FROM " . DB_PREFIX . "fanha_combo n LEFT JOIN " . DB_PREFIX . "fanha_combo_description nd ON (n.combo_id = nd.combo_id) ";	
			
		$sql .= " WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (isset($data['filter_status'])) { $sql .= " AND n.status = '". (int)$data['filter_status'] . "'"; }
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND (";
										
			if (!empty($data['filter_name'])) {
				$implode = array();
				
				$words = explode(' ', $data['filter_name']);
				
				foreach ($words as $word) {
					$implode[] = "LCASE(nd.name) LIKE '%" . $this->db->escape(utf8_strtolower($word)) . "%'";
				}
				
				if ($implode) {
					$sql .= " " . implode(" OR ", $implode) . "";
				}
			}
				
			$sql .= ")";
		}
	
		$sort_data = array(
			//'n.sort_order',
			'nd.name',
		);		
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY nd.name";	
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}		

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		return $sql;
	}

	public function getCombo($combo_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'combo_id=" . (int)$combo_id . "') AS keyword FROM " . DB_PREFIX . "fanha_combo WHERE combo_id = '" . (int)$combo_id . "'");
		return $query->row;
	}
	
	public function addCombo($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "fanha_combo SET status = '" . (int)$data['status'] . "'");
		
		$combo_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "fanha_combo SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE combo_id = '" . (int)$combo_id . "'");
		}
		
		foreach ($data['combo_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "fanha_combo_description SET combo_id = '" . (int)$combo_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		if (isset($data['combo_store'])) {
			foreach ($data['combo_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "fanha_combo_to_store SET combo_id = '" . (int)$combo_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['combo_special'])) {
			foreach ($data['combo_special'] as $combo_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "fanha_combo_special SET combo_id = '" . (int)$combo_id . "', customer_group_id = '" . (int)$combo_special['customer_group_id'] . "', priority = '" . (int)$combo_special['priority'] . "', discount = '" . (float)$combo_special['discount'] . "', date_start = '" . $this->db->escape($combo_special['date_start']) . "', date_end = '" . $this->db->escape($combo_special['date_end']) . "'");
			}
		}
			
		if (isset($data['combo_products'])) {
			foreach ($data['combo_products'] as $product) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "fanha_combo_product WHERE combo_id = '" . (int)$combo_id . "' AND product_id = '" . (int)$product['product_id'] . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "fanha_combo_product SET combo_id = '" . (int)$combo_id . "', product_id = '" . (int)$product['product_id'] . "', key_product = '" . (int)(isset($product['key_product']) && $product['key_product']) . "', quantity = '" . (int)$product['quantity'] . "'");
			}
		}
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'combo_id=" . (int)$combo_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	}

	public function editCombo($combo_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "fanha_combo SET status = '" . (int)$data['status'] . "' WHERE combo_id = '" . (int)$combo_id . "'");
	
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "fanha_combo SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE combo_id = '" . (int)$combo_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "fanha_combo_description WHERE combo_id = '" . (int)$combo_id . "'");
		
		foreach ($data['combo_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "fanha_combo_description SET combo_id = '" . (int)$combo_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "fanha_combo_to_store WHERE combo_id = '" . (int)$combo_id . "'");

		if (isset($data['combo_store'])) {
			foreach ($data['combo_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "fanha_combo_to_store SET combo_id = '" . (int)$combo_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
	
		$this->db->query("DELETE FROM " . DB_PREFIX . "fanha_combo_special WHERE combo_id = '" . (int)$combo_id . "'");
		
		if (isset($data['combo_special'])) {
			foreach ($data['combo_special'] as $combo_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "fanha_combo_special SET combo_id = '" . (int)$combo_id . "', customer_group_id = '" . (int)$combo_special['customer_group_id'] . "', priority = '" . (int)$combo_special['priority'] . "', discount = '" . (float)$combo_special['discount'] . "', date_start = '" . $this->db->escape($combo_special['date_start']) . "', date_end = '" . $this->db->escape($combo_special['date_end']) . "'");
			}
		}
				
		$this->db->query("DELETE FROM " . DB_PREFIX . "fanha_combo_product WHERE combo_id = '" . (int)$combo_id . "'");
		
		if (isset($data['combo_products'])) {
			foreach ($data['combo_products'] as $product) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "fanha_combo_product WHERE combo_id = '" . (int)$combo_id . "' AND product_id = '" . (int)$product['product_id'] . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "fanha_combo_product SET combo_id = '" . (int)$combo_id . "', product_id = '" . (int)$product['product_id'] . "', key_product = '" . (int)(isset($product['key_product']) && $product['key_product']) . "', quantity = '" . (int)$product['quantity'] . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'combo_id=" . (int)$combo_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'combo_id=" . (int)$combo_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	}
	
	public function copyCombo($combo_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "fanha_combo p LEFT JOIN " . DB_PREFIX . "fanha_combo_description pd ON (p.combo_id = pd.combo_id) WHERE p.combo_id = '" . (int)$combo_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
			
			$data['status'] = '0';
			$data['keyword'] = '';
						
			$data = array_merge($data, array('combo_description' => $this->getComboDescriptions($combo_id)));			
			$data = array_merge($data, array('combo_special' => $this->getComboSpecials($combo_id)));
			$data = array_merge($data, array('combo_store' => $this->getComboStores($combo_id)));
			$data = array_merge($data, array('combo_products' => $this->getComboProducts($combo_id)));
			
			$this->addCombo($data);
		}
	}
	
	public function deleteCombo($combo_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "fanha_combo WHERE combo_id = '" . (int)$combo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "fanha_combo_description WHERE combo_id = '" . (int)$combo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "fanha_combo_product WHERE combo_id = '" . (int)$combo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "fanha_combo_special WHERE combo_id = '" . (int)$combo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "fanha_combo_to_store WHERE combo_id = '" . (int)$combo_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'combo_id=" . (int)$combo_id . "'");
	}
	
	public function getComboProductsID($products) {
		$combo_products_data = array();
		
		foreach ($products as $result) {
			$combo_products_data[] = (int)$result['product_id'];
		}
		return $combo_products_data;
	}	
	
	public function getComboProductsKey($products) {
		$combo_products_data = array();
		
		foreach ($products as $result) {
			if (isset($result['key_product']) && $result['key_product']) $combo_products_data[] = (int)$result['product_id'];
		}
		return $combo_products_data;
	}
	
	public function getComboProducts($combo_id) {
		$combo_products_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fanha_combo_product WHERE combo_id = '" . (int)$combo_id . "'");
		
		return $query->rows;	
	}
	
	public function getProductsInfo($products_id) {		
		if (empty($products_id)) return array();
		
		$sql = "SELECT p.product_id, pd.name, p.image FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.product_id in (" . implode(",", $products_id) . ")" ;
		$query = $this->db->query($sql);
		
		$combo_products_data = array();
		
		foreach ($query->rows as $row)
		{
			$combo_products_data[$row['product_id']] = $row;
		}
		return $combo_products_data;
	}	
		
	public function getComboDescriptions($combo_id) {
		$product_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fanha_combo_description WHERE combo_id = '" . (int)$combo_id . "'");
		
		foreach ($query->rows as $result) {
			$product_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
			);
		}
		
		return $product_description_data;
	}
	
	public function getComboStores($combo_id) {
		$product_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fanha_combo_to_store WHERE combo_id = '" . (int)$combo_id . "'");

		foreach ($query->rows as $result) {
			$product_store_data[] = $result['store_id'];
		}
		
		return $product_store_data;
	}
	
	public function getComboSpecials($combo_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fanha_combo_special WHERE combo_id = '" . (int)$combo_id . "' ORDER BY priority, discount");
		
		return $query->rows;
	}
	
	public function RequiredOption($combo_products_data)
	{
		if (empty($combo_products_data)) return 0;
		$sql = "SELECT DISTINCT `product_id` FROM " . DB_PREFIX . "product_option WHERE product_id in (" . implode(",", $combo_products_data) . ")" ;
		// echo $sql;
		$query = $this->db->query($sql);
		return $query->rows;
	}
}
?>