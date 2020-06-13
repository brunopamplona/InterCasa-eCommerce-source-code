<?php
class ModelCatalogReview extends Model {		

			public function productPurchasedByCustomer($product_id, $customer_id) {
				$query = $this->db->query("SELECT o.order_id FROM `" . DB_PREFIX . "order` o LEFT JOIN `" . DB_PREFIX . "order_product` op ON (o.order_id = op.order_id) WHERE op.product_id = '" . (int)$product_id . "' AND o.customer_id = '" . (int)$customer_id . "'");

				return ($query->row) ? true : false;
			}

			public function alreadyWrittenByCustomer($product_id, $customer_id) {
				$query = $this->db->query("SELECT review_id FROM `" . DB_PREFIX . "review` WHERE product_id = '" . (int)$product_id . "' AND customer_id = '" . (int)$customer_id . "'");

				return ($query->row) ? true : false;
			}

			public function getReviewCommentImages($review_id) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_comment_image WHERE review_id = '" . (int)$review_id . "' ORDER BY comment_image_id ASC");

				return $query->rows;
			}

			public function getReviewImages($review_id) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_review_image WHERE review_id = '" . (int)$review_id . "' ORDER BY review_image_id ASC");

				return $query->rows;
			}

			public function getRatings() {
				$sql = "SELECT r.*, rd.name FROM " . DB_PREFIX . "pr_rating r LEFT JOIN " . DB_PREFIX . "pr_rating_description rd ON (r.rating_id = rd.rating_id) LEFT JOIN " . DB_PREFIX . "pr_rating_to_store r2s ON (r.rating_id = r2s.rating_id) WHERE rd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND r2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND r.status = '1' GROUP BY r.rating_id ORDER BY r.sort_order ASC";

				$query = $this->db->query($sql);

				return $query->rows;
			}

			public function getProsByReviewId($review_id) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_attribute WHERE review_id = '" . (int)$review_id . "' AND type = '1' AND status = '1' ORDER BY attribute_id ASC");

				return $query->rows;
			}

			public function getRatingsByProductId($product_id) {
				$sql = '';

				if ($this->config->get('product_reviews_multistore_status')) {
					$sql .= " AND rev.store_id = '" . (int)$this->config->get('config_store_id') . "'";
				}

				$sql = "SELECT SUM(rr.rating) as sum_rating, COUNT(rr.rating) as total, rd.name FROM " . DB_PREFIX . "review rev LEFT JOIN " . DB_PREFIX . "pr_rating_review rr ON (rev.review_id = rr.review_id) LEFT JOIN " . DB_PREFIX . "pr_rating r ON (rr.rating_id = r.rating_id) LEFT JOIN " . DB_PREFIX . "pr_rating_description rd ON (rr.rating_id = rd.rating_id) WHERE rev.status = '1' AND rev.product_id = '" . (int)$product_id . "' AND rd.language_id = '" . (int)$this->config->get('config_language_id') . "' " . $sql . " GROUP BY r.rating_id ORDER BY r.sort_order ASC";

				$query = $this->db->query($sql);

				return $query->rows;
			}

			public function getPredefinedProsCons($data = array()) {
				$sql = "SELECT * FROM " . DB_PREFIX . "pr_attribute WHERE added_by = 'a' AND status = '1'";

				if (isset($data['filter_type']) && !is_null($data['filter_type'])) {
					$sql .= " AND type = '" . $this->db->escape($data['filter_type']) . "'";
				}

				$sql .= " ORDER BY name ASC";

				$query = $this->db->query($sql);

				return $query->rows;
			}

			public function getConsByReviewId($review_id) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_attribute WHERE review_id = '" . (int)$review_id . "' AND type = '0' AND status = '1' ORDER BY attribute_id ASC");

				return $query->rows;
			}

			public function getRatingsByReviewId($review_id) {
				$sql = "SELECT rr.rating_id, rr.rating, rd.name FROM " . DB_PREFIX . "pr_rating_review rr LEFT JOIN " . DB_PREFIX . "pr_rating r ON (rr.rating_id = r.rating_id) LEFT JOIN " . DB_PREFIX . "pr_rating_description rd ON (rr.rating_id = rd.rating_id) WHERE rd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND rr.review_id = '" . (int)$review_id . "' ORDER BY r.sort_order ASC";

				$query = $this->db->query($sql);

				return $query->rows;
			}

			public function getReviewByReviewId($review_id) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "review WHERE review_id = '" . (int)$review_id . "' AND status = '1'");

				return $query->row;
			}

			public function addVoteReview($product_id, $data = array()) {
				if ($data['vote'] == '1') {
					$this->db->query("UPDATE " . DB_PREFIX . "review SET vote_yes = vote_yes + 1 WHERE product_id = '" . (int)$product_id . "' AND review_id = '" . (int)$data['review_id'] . "'");
				} elseif ($data['vote'] == '0') {
					$this->db->query("UPDATE " . DB_PREFIX . "review SET vote_no = vote_no + 1 WHERE product_id = '" . (int)$product_id . "' AND review_id = '" . (int)$data['review_id'] . "'");
				}
			}

			public function addReportAbuse($review_id, $data = array()) {
				if ($data['reason_id'] > 0) {
					$reason_info = $this->getReasonByReasonId($data['reason_id']);

					$title = $reason_info['name'];
				} else {
					$title = $data['def'];
				}

				if ($this->customer->isLogged()) {
					$customer_id = $this->customer->getId();
					$reported = $this->customer->getFirstName() . ' ' . $this->customer->getLastName();
				} else {
					$customer_id = 0;
					$reported = '';
				}

				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_report SET title = '" . $title . "', reported = '" . $this->db->escape($reported) . "', review_id = '" . (int)$review_id . "', customer_id = '" . (int)$customer_id . "', store_id = '" . (int)$this->config->get('config_store_id') . "', date_added = NOW()");
			}

			public function getReasonsTitle() {
				$query = $this->db->query("SELECT r.reason_id, rd.name FROM " . DB_PREFIX . "pr_reason r LEFT JOIN " . DB_PREFIX . "pr_reason_description rd ON (r.reason_id = rd.reason_id) LEFT JOIN " . DB_PREFIX . "pr_reason_to_store r2s ON (r.reason_id = r2s.reason_id) WHERE rd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND r2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND r.status = '1'");

				return $query->rows;
			}

			public function getReasonByReasonId($reason_id) {
				$query = $this->db->query("SELECT name FROM " . DB_PREFIX . "pr_reason_description WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' AND reason_id = '" . (int)$reason_id . "'");

				return $query->row;
			}

			public function getRecommendProductId($product_id) {
				$sql = '';

				if ($this->config->get('product_reviews_multistore_status')) {
					$sql .= " AND store_id = '" . (int)$this->config->get('config_store_id') . "'";
				}

				$query = $this->db->query("SELECT COUNT(product_id) as yes, (SELECT COUNT(product_id) FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$product_id . "' AND status = '1' AND (recommend = 'y' OR recommend = 'n') " . $sql . ") as total FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$product_id . "' AND recommend = 'y' AND status = '1'" . $sql);

				return $query->row;
			}

			public function getAllReviews($data = array()) {
				$sql = "SELECT r.*, p.product_id, pd.name AS product, ROUND((r.vote_yes / (r.vote_no + r.vote_yes)) * 100) as vote FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE r.status = '1' AND p.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

				if ($this->config->get('product_reviews_multistore_status')) {
					$sql .= " AND r.store_id = '" . (int)$this->config->get('config_store_id') . "'";
				}

				if ($data['language_id']) {
					$sql .= " AND (r.language_id = '" . (int)$data['language_id'] . "' OR r.language_id = '0')";
				}

				$sql .= " GROUP BY r.review_id";

				$sort_data = array(
					'r.date_added',
					'rating',
					'vote'
				);

				if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
					if (isset($data['review_id']) && $data['review_id']) {
						$sql .= " ORDER BY r.review_id = '" . (int)$data['review_id'] . "' DESC, " . $data['sort'];
					} else {
						$sql .= " ORDER BY " . $data['sort'];
					}
				} elseif (isset($data['type']) && $data['type'] == 'random') {
					$sql .= " ORDER BY RAND()";
				} else {
					$sql .= " ORDER BY r.date_added";
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

				$query = $this->db->query($sql);

				return $query->rows;
			}

			public function getTotalAllReviews($data = array()) {
				$sql = '';

				if ($this->config->get('product_reviews_multistore_status')) {
					$sql = " AND r.store_id = '" . (int)$this->config->get('config_store_id') . "'";
				}

				if ($data['language_id']) {
					$sql .= " AND (r.language_id = '" . (int)$data['language_id'] . "' OR r.language_id = '0')";
				}

				$query = $this->db->query("SELECT COUNT(r.review_id) AS total FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE r.status = '1' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'" . $sql);

				if (isset($query->row['total'])) {
					return $query->row['total'];
				} else {
					return 0;
				}
			}
			
	public function addReview($product_id, $data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "review SET author = '" . $this->db->escape($data['name']) . "', customer_id = '" . (int)$this->customer->getId() . "', product_id = '" . (int)$product_id . "', text = '" . $this->db->escape($data['text']) . "', rating = '" . (int)$data['rating'] . "', date_added = NOW()");

			if ($this->config->get('product_reviews_status') && is_array($data['rating'])) {
				$review_id = $this->db->getLastId();

				$_tmp_ratings = array();

				foreach ($data['rating'] as $key => $rating) {
					$rating = (int)$rating;

					if ($rating < 1 || $rating > 5) {
						$rating = 5;
					}

					$_tmp_ratings[$key] = $rating;

					$this->db->query("INSERT INTO " . DB_PREFIX . "pr_rating_review SET review_id = '" . (int)$review_id . "', rating_id = '" . (int)$key . "', rating = '" . (int)$rating . "'");
				}

				$this->request->post['rating'] = $_tmp_ratings;

				if ($this->config->get('product_reviews_predefined_pros_cons_status')) {
					if (isset($data['predefined_pros']) && $data['predefined_pros']) {
						foreach ($data['predefined_pros'] as $pros) {
							$pros = base64_decode($pros);

							if ($pros) {
								$this->db->query("INSERT INTO " . DB_PREFIX . "pr_attribute SET name = '" . $this->db->escape($pros) . "', type = '1', added_by = 'u', predefined = '1', review_id = '" . (int)$review_id . "', status = '1'");
							}
						}
					}

					if (isset($data['predefined_cons']) && $data['predefined_cons']) {
						foreach ($data['predefined_cons'] as $cons) {
							$cons = base64_decode($cons);

							if ($cons) {
								$this->db->query("INSERT INTO " . DB_PREFIX . "pr_attribute SET name = '" . $this->db->escape($cons) . "', type = '0', added_by = 'u', predefined = '1', review_id = '" . (int)$review_id . "', status = '1'");
							}
						}
					}
				}

				if (isset($data['review_pros'])) {
					foreach ($data['review_pros'] as $pros) {
						$pros = trim($pros);

						if (!empty($pros)) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "pr_attribute SET name = '" . $this->db->escape($pros) . "', type = '1', review_id = '" . (int)$review_id . "', status = '1'");
						}
					}
				}

				if (isset($data['review_cons'])) {
					foreach ($data['review_cons'] as $cons) {
						$cons = trim($cons);

						if (!empty($cons)) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "pr_attribute SET name = '" . $this->db->escape($cons) . "', type = '0', review_id = '" . (int)$review_id . "', status = '1'");
						}
					}
				}

				$avg = $data['rating'] = round(array_sum($this->request->post['rating']) / count($this->request->post['rating']));

				$this->db->query("UPDATE " . DB_PREFIX . "review SET rating = '" . $avg . "', store_id = '" . (int)$this->config->get('config_store_id') . "', title = '" . ((isset($data['review_title'])) ? $this->db->escape($data['review_title']) : '') . "', language_id = '" . (int)$this->config->get('config_language_id') . "', recommend = '" . ((isset($data['recommend'])) ? $this->db->escape($data['recommend']) : '') . "' WHERE review_id = '" . (int)$review_id . "'");

				if (isset($data['review_images'])) {
					$k = 0;

					foreach ($data['review_images'] as $image) {
						if ($k >= (int)$this->config->get('product_reviews_image_limit')) break;

						$this->db->query("INSERT INTO " . DB_PREFIX . "pr_review_image SET image = '" . $this->db->escape($image) . "', review_id = '" . (int)$review_id . "'");

						$k++;
					}
				}

				if ($this->config->get('product_reviews_autoapprove')) {
					if (($this->config->get('product_reviews_autoapprove') == 2) || ($this->config->get('product_reviews_autoapprove') == 1 && $this->customer->isLogged())) {
						if ($avg >= $this->config->get('product_reviews_autoapprove_rating')) {
							$this->db->query("UPDATE " . DB_PREFIX . "review SET status = '1' WHERE review_id = '" . (int)$review_id . "'");
						}
					}
				}

				if ($this->config->get('product_reviews_point_status') && $this->customer->isLogged()) {
					if ($this->config->get('product_reviews_reward_point')) {
						$description = $this->config->get('product_reviews_description_point');

						if (isset($description[$this->config->get('config_language_id')])) {
							$description = $description[$this->config->get('config_language_id')];
						} else {
							$description = 'Points for writing a review.';
						}

						$this->db->query("INSERT INTO " . DB_PREFIX . "customer_reward SET customer_id = '" . (int)$this->customer->getId() . "', order_id = '0', points = '" . (int)$this->config->get('product_reviews_reward_point') . "', description = '" . $this->db->escape($description) . "', date_added = NOW()");
					}
				}

				if ($this->config->get('product_reviews_notify_status') && $this->config->get('product_reviews_notify_email') && $this->config->get('product_reviews_notification')) {
					$this->load->model('catalog/product');

					$product_info = $this->model_catalog_product->getProduct($product_id);
					$product = '<a href="' . $this->url->link('product/product', 'product_id=' . $product_id) . '">' . $product_info['name'] . '</a>';

					$data['text'] = strip_tags(html_entity_decode($data['text'], ENT_QUOTES, 'UTF-8'));
					$message = str_replace(array('{product}', '{avg}', '{review}'), array($product, $avg, $data['text']), $this->config->get('product_reviews_notification'));

					if (version_compare(VERSION, '2.0') < 0) {
						$reviewMail = new Mail();
						$reviewMail->protocol = $this->config->get('config_mail_protocol');
						$reviewMail->parameter = $this->config->get('config_mail_parameter');
						$reviewMail->hostname = $this->config->get('config_smtp_host');
						$reviewMail->username = $this->config->get('config_smtp_username');
						$reviewMail->password = html_entity_decode($this->config->get('config_smtp_password'), ENT_QUOTES, 'UTF-8');
						$reviewMail->port = $this->config->get('config_smtp_port');
						$reviewMail->timeout = $this->config->get('config_smtp_timeout');
					} elseif (version_compare(VERSION, '2.0.2') < 0) {
						$reviewMail = new Mail($this->config->get('config_mail'));
					} else {
						$reviewMail = new Mail();
						$reviewMail->protocol = $this->config->get('config_mail_protocol');
						$reviewMail->parameter = $this->config->get('config_mail_parameter');
						$reviewMail->smtp_hostname = $this->config->get('config_mail_smtp_host') !== null ? $this->config->get('config_mail_smtp_host') : $this->config->get('config_mail_smtp_hostname');
						$reviewMail->smtp_username = $this->config->get('config_mail_smtp_username');
						$reviewMail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
						$reviewMail->smtp_port = $this->config->get('config_mail_smtp_port');
						$reviewMail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
					}

					$reviewMail->setTo($this->config->get('product_reviews_notify_email'));
					$reviewMail->setFrom($this->config->get('config_email'));
					$reviewMail->setSender($this->config->get('config_name'));
					$reviewMail->setSubject('New product review');
					$reviewMail->setHtml($message);
					$reviewMail->send();
				}
			}
			
	}
		
	public function getReviewsByProductId($product_id, $start = 0, $limit = 20, $language_id = '', $sort = 'r.date_added-DESC') {

			$sql = "";

			if ($this->config->get('product_reviews_status') && $this->config->get('product_reviews_multistore_status')) {
				$sql .= " AND r.store_id = '" . (int)$this->config->get('config_store_id') . "'";
			}

			if ($language_id) {
				$sql .= " AND (r.language_id = '" . (int)$language_id . "' OR r.language_id = '0')";
			}

			$sort = explode("-", $sort);

			$sort_data = array(
				'r.date_added',
				'rating',
				'vote'
			);

			if (isset($sort[1]) && in_array($sort[0], $sort_data)) {
				$sql .= " ORDER BY " . $sort[0] . ' ' . $sort[1];
			} else {
				$sql .= " ORDER BY r.date_added DESC";
			}
			
		if ($start < 0) {
			$start = 0;
		}
		
		if ($limit < 1) {
			$limit = 20;
		}		
		
		$query = $this->db->query("SELECT r.review_id, r.title, r.author, r.vote_yes, r.vote_no, r.comment, r.comment_date_added, IFNULL((SELECT AVG(t.rating) as total FROM " . DB_PREFIX . "pr_rating_review t WHERE t.review_id = r.review_id), r.rating) as rating, ROUND((r.vote_yes / (r.vote_no + r.vote_yes)) * 100) as vote, r.text, p.product_id, pd.name, p.price, p.image, r.date_added FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' " . $sql . " LIMIT " . (int)$start . "," . (int)$limit);
			
		return $query->rows;
	}

	public function getTotalReviewsByProductId($product_id, $language_id = '') {

			$sql = "";

			if ($this->config->get('product_reviews_status') && $this->config->get('product_reviews_multistore_status')) {
				$sql .= " AND r.store_id = '" . (int)$this->config->get('config_store_id') . "'";
			}

			if ($language_id) {
				$sql .= " AND (r.language_id = '" . (int)$language_id . "' OR r.language_id = '0')";
			}
			
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' " . $sql . " AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row['total'];
	}
}
?>