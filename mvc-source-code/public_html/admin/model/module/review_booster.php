<?php
/*
  Review Booster
  Premium Extension
  
  Copyright (c) 2013 - 2019 Adikon.eu
  http://www.adikon.eu/
  
  You may not copy or reuse code within this file without written permission.
*/
class ModelModuleReviewBooster extends Model {
	private $compatibility = null;

	/*
	  Set compatibility for all versions of Opencart
	*/
	public function __construct($registry) {
		parent::__construct($registry);

		include_once DIR_SYSTEM . 'library/vendors/review_booster/compatibility.php';

		$this->compatibility = new OVCompatibility_13($registry);
		$this->compatibility->setApp('admin');
	}

	/*
	  Return compatibility instance
	*/
	public function compatibility() {
		return $this->compatibility;
	}

	/*
	  Reminders
	*/
	public function deleteReminder($email_id) {
		$query = $this->db->query("SELECT coupon_id FROM " . DB_PREFIX . "rb_email WHERE email_id = '" . (int)$email_id . "'");

		if ($query->row) {
			$this->deleteCoupon($query->row['coupon_id']);
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "rb_email WHERE email_id = '" . (int)$email_id . "'");
	}

	public function getReminders($data = array()) {
		$sql = "SELECT e.*, (SELECT CONCAT (o.firstname, ' ', o.lastname) FROM `" . DB_PREFIX . "order` o WHERE o.order_id = e.order_id) AS customer, (SELECT c.code FROM " . DB_PREFIX . "coupon c WHERE c.coupon_id = e.coupon_id) AS coupon FROM " . DB_PREFIX . "rb_email e WHERE 1=1";

		if (!empty($data['filter_email'])) {
			$sql .= " AND e.email = '" . $this->db->escape($data['filter_email']) . "'";
		}

		if (!empty($data['filter_order_id'])) {
			$sql .= " AND e.order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_coupon'])) {
			$sql .= " AND e.coupon_id IN (SELECT c.coupon_id FROM " . DB_PREFIX . "coupon c WHERE c.code = '" . $this->db->escape($data['filter_coupon']) . "')";
		}

		if (isset($data['filter_store_id']) && $data['filter_store_id'] !== '') {
			$sql .= " AND e.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if (!empty($data['filter_date_review'])) {
			$sql .= " AND DATE(e.date_review) = DATE('" . $this->db->escape($data['filter_date_review']) . "')";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(e.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$sql .= " ORDER BY e.date_added DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalReminders($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "rb_email e WHERE 1=1";

		if (!empty($data['filter_email'])) {
			$sql .= " AND e.email = '" . $this->db->escape($data['filter_email']) . "'";
		}

		if (!empty($data['filter_order_id'])) {
			$sql .= " AND e.order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_coupon'])) {
			$sql .= " AND e.coupon_id IN (SELECT c.coupon_id FROM " . DB_PREFIX . "coupon c WHERE c.code = '" . $this->db->escape($data['filter_coupon']) . "')";
		}

		if (isset($data['filter_store_id']) && $data['filter_store_id'] !== '') {
			$sql .= " AND e.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if (!empty($data['filter_date_review'])) {
			$sql .= " AND DATE(e.date_review) = DATE('" . $this->db->escape($data['filter_date_review']) . "')";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(e.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	/*
	  Coupons
	*/
	public function deleteCoupon($coupon_id) {
		if (version_compare(VERSION, '2.0', '<')) {
			$this->load->model('sale/coupon');

			$this->model_sale_coupon->deleteCoupon($coupon_id);
		} else {
			$this->load->model('marketing/coupon');

			$this->model_marketing_coupon->deleteCoupon($coupon_id);
		}
	}

	public function deleteExpiredCoupons() {
		$query = $this->db->query("SELECT coupon_id FROM " . DB_PREFIX . "coupon WHERE name LIKE '%Review Booster%' AND date_end <= '" . $this->db->escape(date('Y-m-d', time() - 60 * 60 * 24)) . "'");

		foreach ($query->rows as $row) {
			$this->deleteCoupon($coupon_id);
		}
	}

	public function getCoupons($data = array()) {
		$sql = "SELECT c.*, ch.order_id AS coupon_order_id, ch.date_added AS date_used FROM " . DB_PREFIX . "rb_email e INNER JOIN " . DB_PREFIX . "coupon c ON (e.coupon_id = c.coupon_id) LEFT JOIN " . DB_PREFIX . "coupon_history ch ON (c.coupon_id = ch.coupon_id) WHERE 1=1";

		if (!empty($data['filter_name'])) {
			$sql .= " AND c.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_code'])) {
			$sql .= " AND c.code = '" . $this->db->escape($data['filter_code']) . "'";
		}

		if (isset($data['filter_used']) && $data['filter_used'] !== '') {
			if ($data['filter_used'] == '1') {
				$sql .= " AND ch.date_added IS NOT NULL";
			} elseif ($data['filter_used'] == '0') {
				$sql .= " AND ch.date_added IS NULL";
			}
		}

		if (isset($data['filter_store_id']) && $data['filter_store_id'] !== '') {
			$sql .= " AND e.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND c.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$sql .= " ORDER BY c.date_added DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalCoupons($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "rb_email e INNER JOIN " . DB_PREFIX . "coupon c ON (e.coupon_id = c.coupon_id) LEFT JOIN " . DB_PREFIX . "coupon_history ch ON (c.coupon_id = ch.coupon_id) WHERE 1=1";

		if (!empty($data['filter_name'])) {
			$sql .= " AND c.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_code'])) {
			$sql .= " AND c.code = '" . $this->db->escape($data['filter_code']) . "'";
		}

		if (isset($data['filter_used']) && $data['filter_used'] !== '') {
			if ($data['filter_used'] == '1') {
				$sql .= " AND ch.date_added IS NOT NULL";
			} elseif ($data['filter_used'] == '0') {
				$sql .= " AND ch.date_added IS NULL";
			}
		}

		if (isset($data['filter_store_id']) && $data['filter_store_id'] !== '') {
			$sql .= " AND e.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND c.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	/*
	  Other
	*/
	public function getCustomerGroups($data = array()) {
		$customer_groups = array();

		if (version_compare(VERSION, '2.1', '<')) {
			$this->load->model('sale/customer_group');

			$customer_groups = $this->model_sale_customer_group->getCustomerGroups($data);
		} else {
			$this->load->model('customer/customer_group');

			$customer_groups = $this->model_customer_customer_group->getCustomerGroups($data);
		}

		return (array)$customer_groups;
	}

	public function getOrderProducts($order_id, $product_id = 0) {
		$sql = "SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'";

		if ($product_id) {
			$sql .= " AND product_id = '" . (int)$product_id . "'";
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	/*
	  Installation & Update
	  Table structure for the module
	*/
	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "rb_email (
			`email_id` int(11) NOT NULL AUTO_INCREMENT,
			`hash` varchar(32) NOT NULL,
			`code` varchar(10) NOT NULL,
			`email` varchar(96) NOT NULL,
			`noticed` varchar(96) NOT NULL,
			`coupon_id` int(11) NOT NULL DEFAULT '0',
			`order_id` int(11) NOT NULL,
			`store_id` int(11) NOT NULL,
			`review_id` varchar(255) NOT NULL,
			`product_id` int(11) NOT NULL,
			`product_limit` int(11) NOT NULL DEFAULT '0',
			`verified_buyer` tinyint(1) NOT NULL DEFAULT '1',
			`gdpr` tinyint(1) NOT NULL DEFAULT '0',
			`test` tinyint(1) NOT NULL DEFAULT '0',
			`ip` varchar(40) NOT NULL,
			`date_review` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			`date_added` datetime NOT NULL,
			PRIMARY KEY (`email_id`),
			KEY `order_id` (`order_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");

		if ($this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "order` LIKE 'review_alert'")->row) {
			$query = $this->db->query("SELECT order_id, store_id, email FROM `" . DB_PREFIX . "order` WHERE review_alert = '1'");

			foreach ($query->rows as $row) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "rb_email SET email = '" . $this->db->escape($row['email']) . "', order_id = '" . (int)$row['order_id'] . "', store_id = '" . (int)$row['store_id'] . "'");
			}

			$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` DROP COLUMN review_alert");
		}

		if (!$this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "rb_email LIKE 'test'")->row) {
			$this->db->query("ALTER TABLE " . DB_PREFIX . "rb_email ADD `test` tinyint(1) NOT NULL DEFAULT '0'");
			$this->db->query("ALTER TABLE " . DB_PREFIX . "rb_email ADD `noticed` varchar(96) NOT NULL");
		}

		if (!$this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "rb_email LIKE 'product_limit'")->row) {
			$this->db->query("ALTER TABLE " . DB_PREFIX . "rb_email ADD `product_limit` int(11) NOT NULL DEFAULT '0'");
		}

		if (!$this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "rb_email LIKE 'gdpr'")->row) {
			$this->db->query("ALTER TABLE " . DB_PREFIX . "rb_email ADD `verified_buyer` tinyint(1) NOT NULL DEFAULT '1'");
			$this->db->query("ALTER TABLE " . DB_PREFIX . "rb_email ADD `gdpr` tinyint(1) NOT NULL DEFAULT '0'");
			$this->db->query("ALTER TABLE " . DB_PREFIX . "rb_email ADD `review_id` varchar(255) NOT NULL");
			$this->db->query("ALTER TABLE " . DB_PREFIX . "rb_email ADD `ip` varchar(40) NOT NULL");
		}
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "rb_email");
	}
}
?>