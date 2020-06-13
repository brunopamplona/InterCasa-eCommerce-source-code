<?php
/*
  Review Booster
  Premium Extension
  
  Copyright (c) 2013 - 2019 Adikon.eu
  http://www.adikon.eu/
  
  You may not copy or reuse code within this file without written permission.
*/
class ModelModuleReviewBooster extends Model {
	protected $compatibility = null;

	/*
	  Set compatibility for all versions of Opencart
	*/
	public function __construct($registry) {
		parent::__construct($registry);

		include_once DIR_SYSTEM . 'library/vendors/review_booster/compatibility.php';

		$this->compatibility = new OVCompatibility_13($registry);
		$this->compatibility->setApp('front');
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
	public function addReminder($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "rb_email SET `hash` = '" . $this->db->escape($data['hash']) . "', `code` = '" . $this->db->escape($data['code']) . "', email = '" . $this->db->escape($data['email']) . "', order_id = '" . (int)$data['order_id'] . "', store_id = '" . (int)$data['store_id'] . "', product_id = '" . (int)$data['product_id'] . "', product_limit = '" . (int)$data['product_limit'] . "', test = '" . (int)$data['test'] . "', date_added = NOW()");

		return $this->db->getLastId();
	}

	public function updateReminder($reminder_id, $noticed, $coupon_id, $review_ids, $gdpr) {
		$review_data = '';

		foreach ($review_ids as $review_id) {
			$review_data .= '[' . $review_id . ']';
		}

		$query = $this->db->query("SELECT date_added FROM " . DB_PREFIX . "review WHERE review_id = '" . (int)$review_id . "'");

		if ($query->num_rows) {
			$date_review = $query->row['date_added'];
		} else {
			$date_review = '0000-00-00 00:00:00';
		}

		$this->db->query("UPDATE " . DB_PREFIX . "rb_email SET noticed = '" . $this->db->escape($noticed) . "', coupon_id = '" . (int)$coupon_id . "', review_id = '" . $this->db->escape($review_data) . "', gdpr = '" . (int)$gdpr . "', ip = '" . $this->db->escape($this->getIp()) . "', date_review = '" . $this->db->escape($date_review) . "' WHERE email_id = '" . (int)$reminder_id . "'");
	}

	public function getReminder($hash, $code) {
		$query = $this->db->query("SELECT e.*, o.customer_id, CONCAT(o.firstname, ' ', o.lastname) AS customer FROM " . DB_PREFIX . "rb_email e LEFT JOIN `" . DB_PREFIX . "order` o ON (e.order_id = o.order_id) WHERE e.hash = '" . $this->db->escape($hash) . "' AND e.code = '" . $this->db->escape($code) . "' AND e.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		return $query->row;
	}

	/*
	  Orders
	*/
	public function getOrders($data) {
		$sql = "SELECT o.email, o.date_added, o.firstname, o.lastname, o.language_id, o.order_id, o.store_id, o.store_name, o.store_url, (SELECT s.value FROM " . DB_PREFIX . "setting s WHERE s.key = 'config_email' AND s.store_id = o.store_id LIMIT 1) AS owner_email FROM `" . DB_PREFIX . "order` o";

		if (isset($data['filter_order_status'])) {
			$implode = array();

			foreach ($data['filter_order_status'] as $order_status_id) {
				$implode[] = "o.order_status_id = '" . (int)$order_status_id . "'";
			}

			if ($implode) {
				$sql .= " WHERE (" . implode(" OR ", $implode) . ")";
			}
		} else {
			$sql .= " WHERE o.order_status_id > '0'";
		}

		if (isset($data['filter_customer_group_exclude'])) {
			$implode = array();

			foreach ($data['filter_customer_group_exclude'] as $customer_group_id) {
				$implode[] = "o.customer_group_id != '" . (int)$customer_group_id . "'";
			}

			if ($implode) {
				$sql .= " AND (" . implode(" AND ", $implode) . ")";
			}
		}

		if (!empty($data['filter_to'])) {
			if ($data['filter_to'] == 'customer') {
				$sql .= " AND o.customer_id = '1'";
			} elseif ($data['filter_to'] == 'guest') {
				$sql .= " AND o.customer_id = '0'";
			} else {
				// all
			}
		}

		if (isset($data['filter_store_id']) && $data['filter_store_id'] !== '') {
			$sql .= " AND o.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if (isset($data['filter_after_day']) && $data['filter_after_day'] !== '') {
			if (isset($data['filter_previous']) && $data['filter_previous'] !== '') {
				if ($data['filter_previous'] == 1) {
					$sql .= " AND DATE(o.date_modified) <= (CURDATE() - INTERVAL " . (int)$data['filter_after_day'] . " DAY)";
				} else {
					$sql .= " AND DATE(o.date_modified) = (CURDATE() - INTERVAL " . (int)$data['filter_after_day'] . " DAY)";
				}
			} else {
				$sql .= " AND DATE(o.date_modified) = (CURDATE() - INTERVAL " . (int)$data['filter_after_day'] . " DAY)";
			}
		}

		if (isset($data['filter_order_id']) && $data['filter_order_id'] !== '') {
			$sql .= " AND o.order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (empty($data['filter_order_id']) && (isset($data['filter_after_day']) && $data['filter_after_day'] !== '')) {
			$sql .= " AND NOT EXISTS (SELECT 1 FROM " . DB_PREFIX . "rb_email e WHERE o.order_id = e.order_id AND e.test = '0')";
		}

		$sql .= " AND EXISTS (SELECT 1 FROM " . DB_PREFIX . "order_product op WHERE o.order_id = op.order_id AND op.product_id != '0') HAVING owner_email <> '' LIMIT " . (int)$data['limit'];

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getOrderProducts($order_id, $product_id = 0, $limit = 0) {
		$sql = "SELECT *, (SELECT p.image FROM " . DB_PREFIX . "product p WHERE p.product_id = op.product_id) AS image FROM " . DB_PREFIX . "order_product op WHERE op.order_id = '" . (int)$order_id . "'";

		if ($product_id) {
			$sql .= " AND op.product_id = '" . (int)$product_id . "'";
		}

		if ($limit) {
			$sql .= " LIMIT " . (int)$limit;
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	/*
	  Coupons
	*/
	public function addCoupon($data) {
		$code = strtoupper(substr(md5(uniqid(time(), true)), 0, 8));

		$this->db->query("INSERT INTO " . DB_PREFIX . "coupon SET name = '" . $this->db->escape($data['name']) . "', code = '" . $this->db->escape($code) . "', discount = '" . (float)$data['discount'] . "', type = '" . $this->db->escape($data['type']) . "', total = '0.1', logged = '0', shipping = '0', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', uses_total = '1', uses_customer = '1', status = '1', date_added = NOW()");

		return $this->db->getLastId();
	}

	public function getCoupon($coupon_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "coupon WHERE coupon_id = '" . (int)$coupon_id . "' AND status = '1'");

		return $query->row;
	}

	/*
	  Other
	*/
	public function editNewsletterStatus($newsletter, $customer_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET newsletter = '" . (int)$newsletter . "' WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function editReviewStatus($status, $review_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "review SET status = '" . (int)$status . "' WHERE review_id = '" . (int)$review_id . "'");
	}

	public function addReview($product_id, $data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "review SET author = '" . $this->db->escape($data['author']) . "', customer_id = '" . (int)$data['customer_id'] . "', product_id = '" . (int)$product_id . "', text = '" . $this->db->escape($data['text']) . "', rating = '" . (int)round(array_sum($data['rating']) / count($data['rating'])) . "', status = '0', date_added = NOW()");

		$review_id = $this->db->getLastId();

		foreach ($data['rating'] as $rating_id => $value) {
			if ($rating_id) {
				if ($this->db->query("SHOW TABLES FROM `" . DB_DATABASE . "` LIKE '" . DB_PREFIX . "pr_review_rating'")->row) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "pr_review_rating SET review_id = '" . (int)$review_id . "', rating_id = '" . (int)$rating_id . "', rating = '" . (int)$value . "'");
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "pr_rating_review SET review_id = '" . (int)$review_id . "', rating_id = '" . (int)$rating_id . "', rating = '" . (int)$value . "'");
				}
			}
		}

		foreach ($data['images'] as $image) {
			if ($this->db->query("SHOW TABLES FROM `" . DB_DATABASE . "` LIKE '" . DB_PREFIX . "pr_image'")->row) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_image SET review_id = '" . (int)$review_id . "', name = '" . $this->db->escape(basename($image)) . "', image = '" . $this->db->escape($image) . "', title = '', alt = '', sort_order = '0', status = '1', date_added = NOW()");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_review_image SET image = '" . $this->db->escape($image) . "', review_id = '" . (int)$review_id . "'");
			}
		}

		if ($this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "review LIKE 'store_id'")->row) {
			$this->db->query("UPDATE " . DB_PREFIX . "review SET store_id = '" . (int)$data['store_id'] . "' WHERE review_id = '" . (int)$review_id . "'");
		}

		if ($this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "review LIKE 'language_id'")->row) {
			$this->db->query("UPDATE " . DB_PREFIX . "review SET language_id = '" . (int)$this->config->get('config_language_id') . "' WHERE review_id = '" . (int)$review_id . "'");
		}

		return $review_id;
	}

	public function getIp() {
		$ip_address = '';

		if (getenv('HTTP_CLIENT_IP'))
			$ip_address = getenv('HTTP_CLIENT_IP');
		elseif (getenv('HTTP_X_FORWARDED_FOR'))
			$ip_address = getenv('HTTP_X_FORWARDED_FOR');
		elseif (getenv('HTTP_X_FORWARDED'))
			$ip_address = getenv('HTTP_X_FORWARDED');
		elseif (getenv('HTTP_FORWARDED_FOR'))
			$ip_address = getenv('HTTP_FORWARDED_FOR');
		elseif (getenv('HTTP_FORWARDED'))
			$ip_address = getenv('HTTP_FORWARDED');
		elseif (getenv('REMOTE_ADDR'))
			$ip_address = getenv('REMOTE_ADDR');
		else
			$ip_address = '';

		return $ip_address;
	}
}