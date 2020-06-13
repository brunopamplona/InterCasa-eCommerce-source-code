<?php
class ModelCatalogProductReview extends Model {
	/* Review */
	public function getRatingsByReviewId($review_id) {
		$sql = "SELECT rr.rating_id, rr.rating, rd.name FROM " . DB_PREFIX . "pr_rating_review rr LEFT JOIN " . DB_PREFIX . "pr_rating_description rd ON (rr.rating_id = rd.rating_id) WHERE rd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND rr.review_id = '" . (int)$review_id . "' ORDER BY rd.name";

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function deleteRatingByReviewId($review_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_rating_review WHERE review_id = '" . (int)$review_id . "'");
	}

	public function deleteAttributeByReviewId($review_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_attribute WHERE review_id = '" . (int)$review_id . "'");
	}

	public function deleteReportByReviewId($review_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_report WHERE review_id = '" . (int)$review_id . "'");
	}

	public function getProsByReviewId($review_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_attribute WHERE review_id = '" . (int)$review_id . "' AND type = '1'");

		return $query->rows;
	}

	public function getConsByReviewId($review_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_attribute WHERE review_id = '" . (int)$review_id . "' AND type = '0'");

		return $query->rows;
	}

	public function changeStatus($review_id, $status) {
		$this->db->query("UPDATE " . DB_PREFIX . "review SET status = '" . (int)$status . "', date_modified = NOW() WHERE review_id = '" . (int)$review_id . "'");
	}

	public function deleteVote($review_id, $vote) {
		if ($vote == 'yes') {
			$this->db->query("UPDATE " . DB_PREFIX . "review SET vote_yes = '0' WHERE review_id = '" . (int)$review_id . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "review SET vote_no = '0' WHERE review_id = '" . (int)$review_id . "'");
		}
	}

	public function getReviewCommentImages($review_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_comment_image WHERE review_id = '" . (int)$review_id . "' ORDER BY comment_image_id ASC");

		return $query->rows;
	}

	public function getReviewImages($review_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_review_image WHERE review_id = '" . (int)$review_id . "' ORDER BY review_image_id ASC");

		return $query->rows;
	}

	public function deleteImage($review_image_id) {
		$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "pr_review_image WHERE review_image_id = '" . (int)$review_image_id . "'");

		if ($query->row) {
			if (file_exists(DIR_IMAGE . 'product_review/review/' . $query->row['image'])) {
				unlink(DIR_IMAGE . 'product_review/review/' . $query->row['image']);
			}

			$this->db->query("DELETE FROM " . DB_PREFIX . "pr_review_image WHERE review_image_id = '" . (int)$review_image_id . "'");
		}
	}

	public function addComment($review_id, $data) {
		if (!$this->db->query("SELECT comment FROM " . DB_PREFIX . "review WHERE review_id = '" . (int)$review_id . "'")->row['comment']) {
			$this->db->query("UPDATE " . DB_PREFIX . "review SET comment = '" . $this->db->escape($data['comment']) . "', comment_date_added = NOW() WHERE review_id = '" . (int)$review_id . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "review SET comment = '" . $this->db->escape($data['comment']) . "' WHERE review_id = '" . (int)$review_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_comment_image WHERE review_id = '" . (int)$review_id . "'");

		if (isset($data['comment_images'])) {
			foreach ($data['comment_images'] as $image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_comment_image SET image = '" . $this->db->escape($image) . "', review_id = '" . (int)$review_id . "'");
			}
		}
	}

	public function addReviewEvent($review_id, $data) {
		if ($this->config->get('product_reviews_status')) {
			$this->db->query("UPDATE " . DB_PREFIX . "review SET title = '" . $this->db->escape($data['review_title']) . "', recommend = '" . $this->db->escape($data['recommend']) . "', date_added = '" . $this->db->escape($data['date_added']) . "', language_id = '" . (int)$data['language_id'] . "' WHERE review_id = '" . (int)$review_id . "'");

			if (isset($data['images'])) {
				foreach ($data['images'] as $image) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "pr_review_image SET image = '" . $this->db->escape($image) . "', review_id = '" . (int)$review_id . "'");
				}
			}

			if (isset($data['product_rating'])) {
				foreach ($data['product_rating'] as $key => $rating) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "pr_rating_review SET review_id = '" . (int)$review_id . "', rating_id = '" . (int)$key . "', rating = '" . (int)$rating . "'");
				}

				$avg = round(array_sum($data['product_rating']) / count($data['product_rating']));

				$this->db->query("UPDATE " . DB_PREFIX . "review SET rating = '" . $avg . "' WHERE review_id = '" . (int)$review_id . "'");
			}

			if (isset($data['pros'])) {
				foreach ($data['pros'] as $pros) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "pr_attribute SET name = '" . $this->db->escape($pros['name']) . "', type = '1', review_id = '" . (int)$review_id . "', status = '1'");
				}
			}

			if (isset($data['cons'])) {
				foreach ($data['cons'] as $cons) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "pr_attribute SET name = '" . $this->db->escape($cons['name']) . "', type = '0', review_id = '" . (int)$review_id . "', status = '1'");
				}
			}
		}
	}

	public function editReviewEvent($review_id, $data) {
		if (!$this->db->query("SELECT comment FROM " . DB_PREFIX . "review WHERE review_id = '" . (int)$review_id . "'")->row['comment']) {
			$sql = ", comment_date_added = NOW()";
		} else {
			$sql = '';
		}

		$this->db->query("UPDATE " . DB_PREFIX . "review SET title = '" . $this->db->escape($data['review_title']) . "', recommend = '" . $this->db->escape($data['recommend']) . "', store_id = '" . (int)$data['store_id'] . "', comment = '" . $this->db->escape($data['comment']) . "', date_added = '" . $this->db->escape($data['date_added']) . "', language_id = '" . (int)$data['language_id'] . "' " . $sql . " WHERE review_id = '" . (int)$review_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_review_image WHERE review_id = '" . (int)$review_id . "'");

		if (isset($data['images'])) {
			foreach ($data['images'] as $image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_review_image SET image = '" . $this->db->escape($image) . "', review_id = '" . (int)$review_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_rating_review WHERE review_id = '" . (int)$review_id . "'");

		if (isset($data['product_rating'])) {
			foreach ($data['product_rating'] as $key => $rating) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_rating_review SET review_id = '" . (int)$review_id . "', rating_id = '" . (int)$key . "', rating = '" . (int)$rating . "'");
			}

			$avg = round(array_sum($data['product_rating']) / count($data['product_rating']));

			$this->db->query("UPDATE " . DB_PREFIX . "review SET rating = '" . $avg . "' WHERE review_id = '" . (int)$review_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_attribute WHERE review_id = '" . (int)$review_id . "' AND type = '1'");

		if (isset($data['pros'])) {
			foreach ($data['pros'] as $pros) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_attribute SET name = '" . $this->db->escape($pros['name']) . "', type = '1', review_id = '" . (int)$review_id . "', status = '1'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_attribute WHERE review_id = '" . (int)$review_id . "' AND type = '0'");

		if (isset($data['cons'])) {
			foreach ($data['cons'] as $cons) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_attribute SET name = '" . $this->db->escape($cons['name']) . "', type = '0', review_id = '" . (int)$review_id . "', status = '1'");
			}
		}
	}

	/* Rating */
	public function addRating($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "pr_rating SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "'");

		$rating_id = $this->db->getLastId();

		foreach ($data['name'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "pr_rating_description SET rating_id = '" . (int)$rating_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		if (isset($data['rating_store'])) {
			foreach ($data['rating_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_rating_to_store SET rating_id = '" . (int)$rating_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
	}

	public function editRating($rating_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "pr_rating SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "' WHERE rating_id = '" . (int)$rating_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_rating_description WHERE rating_id = '" . (int)$rating_id . "'");

		foreach ($data['name'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "pr_rating_description SET rating_id = '" . (int)$rating_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_rating_to_store WHERE rating_id = '" . (int)$rating_id . "'");

		if (isset($data['rating_store'])) {
			foreach ($data['rating_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_rating_to_store SET rating_id = '" . (int)$rating_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
	}

	public function deleteRating($rating_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_rating WHERE rating_id = '" . (int)$rating_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_rating_description WHERE rating_id = '" . (int)$rating_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_rating_to_store WHERE rating_id = '" . (int)$rating_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_rating_review WHERE rating_id = '" . (int)$rating_id . "'");
	}

	public function getRating($rating_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "pr_rating WHERE rating_id = '" . (int)$rating_id . "'");

		return $query->row;
	}

	public function getRatings($data = array()) {																																					  
		$sql = "SELECT r.*, rd.name, (SELECT GROUP_CONCAT(r2s.store_id SEPARATOR '#') FROM " . DB_PREFIX . "pr_rating_to_store r2s WHERE r2s.rating_id = r.rating_id GROUP BY r2s.rating_id) AS stores FROM " . DB_PREFIX . "pr_rating r LEFT JOIN " . DB_PREFIX . "pr_rating_description rd ON (r.rating_id = rd.rating_id) LEFT JOIN " . DB_PREFIX . "pr_rating_to_store r2s ON (r.rating_id = r2s.rating_id) WHERE rd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_store_id'])) {
			$sql .= " AND r2s.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " AND rd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND r.status = '" . (int)$this->db->escape($data['filter_status']) . "'";
		}

		$sql .= " GROUP BY r.rating_id";

		$sort_data = array(
			'rd.name',
			'r.status',
			'r.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY rd.name";
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

	public function getTotalRatings($data = array()) {
		$sql = "SELECT COUNT(DISTINCT r.rating_id) AS total FROM " . DB_PREFIX . "pr_rating r LEFT JOIN " . DB_PREFIX . "pr_rating_description rd ON (r.rating_id = rd.rating_id) LEFT JOIN " . DB_PREFIX . "pr_rating_to_store r2s ON (r.rating_id = r2s.rating_id) WHERE rd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_store_id'])) {
			$sql .= " AND r2s.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " AND rd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND r.status = '" . (int)$this->db->escape($data['filter_status']) . "'";
		}

		$sql .= " GROUP BY r.rating_id";

		$query = $this->db->query($sql);

		return ($query->num_rows) ? $query->row['total'] : 0;
	}

	public function getRatingDescriptions($rating_id) {
		$rating_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_rating_description WHERE rating_id = '" . (int)$rating_id . "'");

		foreach ($query->rows as $result) {
			$rating_description_data[$result['language_id']] = array(
				'name' => $result['name']
			);
		}

		return $rating_description_data;
	}

	public function getRatingStores($rating_id) {
		$rating_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_rating_to_store WHERE rating_id = '" . (int)$rating_id . "'");

		foreach ($query->rows as $result) {
			$rating_store_data[] = $result['store_id'];
		}

		return $rating_store_data;
	}

	/* Attribute */
	public function addAttribute($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "pr_attribute SET name = '" . $this->db->escape($data['name']) . "', type = '" . (int)$data['type'] . "', added_by = '" . $this->db->escape($data['added_by']) . "', review_id = '0', status = '" . (int)$data['status'] . "'");
	}

	public function editAttribute($attribute_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "pr_attribute SET name = '" . $this->db->escape($data['name']) . "', type = '" . (int)$data['type'] . "', added_by = '" . $this->db->escape($data['added_by']) . "', status = '" . (int)$data['status'] . "' WHERE attribute_id = '" . (int)$attribute_id . "'");
	}

	public function deleteAttribute($attribute_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");
	}

	public function getAttribute($attribute_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "pr_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

		return $query->row;
	}

	public function getAttributes($data = array()) {																																					  
		$sql = "SELECT r.author, a.* FROM " . DB_PREFIX . "pr_attribute a LEFT JOIN " . DB_PREFIX . "review r ON (r.review_id = a.review_id) WHERE 1=1";

		if (!empty($data['filter_name'])) {
			$sql .= " AND a.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (isset($data['filter_review_id']) && !is_null($data['filter_review_id'])) {
			$sql .= " AND a.review_id = '" . (int)$this->db->escape($data['filter_review_id']) . "'";
		}

		if (isset($data['filter_type']) && !is_null($data['filter_type'])) {
			$sql .= " AND a.type = '" . (int)$this->db->escape($data['filter_type']) . "'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (!empty($data['filter_added_by'])) {
			$sql .= " AND a.added_by = '" . $this->db->escape($data['filter_added_by']) . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND a.status = '" . (int)$this->db->escape($data['filter_status']) . "'";
		}

		$sql .= " GROUP BY a.attribute_id";

		$sort_data = array(
			'a.name',
			'r.review_id',
			'a.type',
			'r.author',
			'a.status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY a.added_by";
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

	public function getAuthors($data = array()) {
		$query = $this->db->query("SELECT DISTINCT(r.author) FROM " . DB_PREFIX . "review r INNER JOIN " . DB_PREFIX . "pr_attribute a ON (r.review_id = a.review_id) WHERE r.author LIKE '" . $this->db->escape($data['filter_author']) . "%' GROUP BY r.author ORDER BY r.author ASC LIMIT 0,20");

		return $query->rows;
	}

	public function getTotalAttributes($data = array()) {
		$sql = "SELECT COUNT(DISTINCT a.attribute_id) AS total FROM " . DB_PREFIX . "pr_attribute a LEFT JOIN " . DB_PREFIX . "review r ON (r.review_id = a.review_id) WHERE 1=1";

		if (!empty($data['filter_name'])) {
			$sql .= " AND a.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (isset($data['filter_review_id']) && !is_null($data['filter_review_id'])) {
			$sql .= " AND a.review_id = '" . (int)$this->db->escape($data['filter_review_id']) . "'";
		}

		if (isset($data['filter_type']) && !is_null($data['filter_type'])) {
			$sql .= " AND a.type = '" . (int)$this->db->escape($data['filter_type']) . "'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (!empty($data['filter_added_by'])) {
			$sql .= " AND a.added_by = '" . $this->db->escape($data['filter_added_by']) . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND a.status = '" . (int)$this->db->escape($data['filter_status']) . "'";
		}

		$query = $this->db->query($sql);

		return ($query->num_rows) ? $query->row['total'] : 0;
	}

	/* Abuse report */
	public function deleteReport($report_id, $review_id = false) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_report WHERE report_id = '" . (int)$report_id . "'");

		if ($review_id) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE review_id = '" . (int)$review_id . "'");
		}
	}

	public function getReports($data = array()) {																																					  
		$sql = "SELECT r.text, ar.* FROM " . DB_PREFIX . "pr_report ar LEFT JOIN " . DB_PREFIX . "review r ON (r.review_id = ar.review_id) WHERE 1=1";

		if (!empty($data['filter_store_id'])) {
			$sql .= " AND ar.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if (!empty($data['filter_date_added_start'])) {
			$sql .= " AND DATE(ar.date_added) >= '" . $this->db->escape($data['filter_date_added_start']) . "'";
		}

		if (!empty($data['filter_date_added_stop'])) {
			$sql .= " AND DATE(ar.date_added) <= '" . $this->db->escape($data['filter_date_added_stop']) . "'";
		}

		$sql .= " GROUP BY ar.report_id";

		$sort_data = array(
			'ar.store_id',
			'ar.reported',
			'ar.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY ar.date_added";
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

	public function getTotalReports($data = array()) {
		$sql = "SELECT COUNT(ar.report_id) AS total FROM " . DB_PREFIX . "pr_report ar WHERE 1=1";

		if (!empty($data['filter_store_id'])) {
			$sql .= " AND ar.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if (!empty($data['filter_date_added_start'])) {
			$sql .= " AND DATE(ar.date_added) >= '" . $this->db->escape($data['filter_date_added_start']) . "'";
		}

		if (!empty($data['filter_date_added_stop'])) {
			$sql .= " AND DATE(ar.date_added) <= '" . $this->db->escape($data['filter_date_added_stop']) . "'";
		}

		$query = $this->db->query($sql);

		return ($query->num_rows) ? $query->row['total'] : 0;
	}

	public function addReason($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "pr_reason SET status = '" . (int)$data['status'] . "'");

		$reason_id = $this->db->getLastId();

		foreach ($data['name'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "pr_reason_description SET reason_id = '" . (int)$reason_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		if (isset($data['reason_store'])) {
			foreach ($data['reason_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_reason_to_store SET reason_id = '" . (int)$reason_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
	}

	public function editReason($reason_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "pr_reason SET status = '" . (int)$data['status'] . "' WHERE reason_id = '" . (int)$reason_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_reason_description WHERE reason_id = '" . (int)$reason_id . "'");

		foreach ($data['name'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "pr_reason_description SET reason_id = '" . (int)$reason_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_reason_to_store WHERE reason_id = '" . (int)$reason_id . "'");

		if (isset($data['reason_store'])) {
			foreach ($data['reason_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "pr_reason_to_store SET reason_id = '" . (int)$reason_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
	}

	public function deleteReason($reason_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_reason WHERE reason_id = '" . (int)$reason_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_reason_description WHERE reason_id = '" . (int)$reason_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "pr_reason_to_store WHERE reason_id = '" . (int)$reason_id . "'");
	}

	public function getReason($reason_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "pr_reason WHERE reason_id = '" . (int)$reason_id . "'");

		return $query->row;
	}

	public function getReasons($data = array()) {																																					  
		$sql = "SELECT r.*, rd.name FROM " . DB_PREFIX . "pr_reason r LEFT JOIN " . DB_PREFIX . "pr_reason_description rd ON (r.reason_id = rd.reason_id) LEFT JOIN " . DB_PREFIX . "pr_reason_to_store r2s ON (r.reason_id = r2s.reason_id) WHERE rd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (isset($data['filter_store_id']) && !is_null($data['filter_store_id'])) {
			$sql .= " AND r2s.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND r.status = '" . (int)$this->db->escape($data['filter_status']) . "'";
		}

		$sql .= " GROUP BY r.reason_id";

		$sort_data = array(
			'rd.name',
			'r.status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY rd.name";
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

	public function getTotalReasons($data = array()) {
		$sql = "SELECT COUNT(r.reason_id) AS total FROM " . DB_PREFIX . "pr_reason r LEFT JOIN " . DB_PREFIX . "pr_reason_to_store r2s ON (r.reason_id = r2s.reason_id) WHERE 1=1";

		if (isset($data['filter_store_id']) && !is_null($data['filter_store_id'])) {
			$sql .= " AND r2s.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND r.status = '" . (int)$this->db->escape($data['filter_status']) . "'";
		}

		$query = $this->db->query($sql);

		return ($query->num_rows) ? $query->row['total'] : 0;
	}

	public function getReasonStores($reason_id) {
		$rating_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_reason_to_store WHERE reason_id = '" . (int)$reason_id . "'");

		foreach ($query->rows as $result) {
			$rating_store_data[] = $result['store_id'];
		}

		return $rating_store_data;
	}

	public function getReasonDescriptions($reason_id) {
		$reason_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pr_reason_description WHERE reason_id = '" . (int)$reason_id . "'");

		foreach ($query->rows as $result) {
			$reason_description_data[$result['language_id']] = array(
				'name' => $result['name']
			);
		}

		return $reason_description_data;
	}

	/* Optimize */
	public function optimizeTable() {
		$this->db->query("OPTIMIZE table " . DB_PREFIX . "review");
		$this->db->query("OPTIMIZE table " . DB_PREFIX . "pr_attribute");
		$this->db->query("OPTIMIZE table " . DB_PREFIX . "pr_rating");
		$this->db->query("OPTIMIZE table " . DB_PREFIX . "pr_rating_description");
		$this->db->query("OPTIMIZE table " . DB_PREFIX . "pr_rating_review");
		$this->db->query("OPTIMIZE table " . DB_PREFIX . "pr_rating_to_store");
		$this->db->query("OPTIMIZE table " . DB_PREFIX . "pr_reason");
		$this->db->query("OPTIMIZE table " . DB_PREFIX . "pr_reason_description");
		$this->db->query("OPTIMIZE table " . DB_PREFIX . "pr_reason_to_store");
		$this->db->query("OPTIMIZE table " . DB_PREFIX . "pr_report");
	}

	/* Setting */
	public function getSetting($group, $store_id = 0) {
		$data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `" . (version_compare(VERSION, '2.0.1') < 0 ? 'group' : 'code') . "` = '" . $this->db->escape($group) . "'");

		foreach ($query->rows as $result) {
			$result['key'] = str_replace($group . '_', '', $result['key']);

			if (!$result['serialized']) {
				$data[$result['key']] = $result['value'];
			} else {
				$data[$result['key']] = unserialize($result['value']);
			}
		}

		return $data;
	}

	public function editSetting($group, $data, $store_id = 0) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `" . (version_compare(VERSION, '2.0.1') < 0 ? 'group' : 'code') . "` = '" . $this->db->escape($group) . "'");

		foreach ($data as $key => $value) {
			if (!is_array($value)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `" . (version_compare(VERSION, '2.0.1') < 0 ? 'group' : 'code') . "` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($group . '_' . $key) . "', `value` = '" . $this->db->escape($value) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `" . (version_compare(VERSION, '2.0.1') < 0 ? 'group' : 'code') . "` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($group . '_' . $key) . "', `value` = '" . $this->db->escape(serialize($value)) . "', serialized = '1'");
			}
		}
	}

	public function getUrlAlias($keyword) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($keyword) . "'");

		return $query->row;
	}
}
?>