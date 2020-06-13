<?php
class ControllerProductAllReviews extends Controller {
	public function index() {
		$data['objConfig'] = $this->config;

    	$this->language->load('module/review_box');

		if ($this->config->get('product_reviews_colorbox_status')) {
			if (file_exists('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js')) {
				$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
				$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');
			} elseif (file_exists('catalog/view/javascript/jquery/colorbox/jquery.colorbox.js')) {
				$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox.js');
				$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');
			} else {
				$this->document->addScript('catalog/view/javascript/AdvancedProductReviews/colorbox/jquery.colorbox.js');
				$this->document->addStyle('catalog/view/javascript/AdvancedProductReviews/colorbox/colorbox.css');
			}
		}

		$this->load->model('catalog/review');

		if (isset($this->request->get['review_id'])) {
			$review_id = (int)$this->request->get['review_id'];
		} else {
			$review_id = 0;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'r.date_added';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

  		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
      		'separator' => false
   		);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('product/allreviews', $url),
      		'separator' => $this->language->get('text_separator')
   		);

    	$data['heading_title'] = $this->language->get('heading_title');

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_on'] = $this->language->get('text_on');
		$data['text_purchase'] = $this->language->get('text_purchase');
		$data['text_average_review'] = $this->language->get('text_average_review');
		$data['text_pros'] = $this->language->get('text_pros');
		$data['text_cons'] = $this->language->get('text_cons');
		$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		$data['text_display'] = $this->language->get('text_display');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_grid'] = $this->language->get('text_grid');
		$data['text_sort'] = $this->language->get('text_sort');
		$data['text_limit'] = $this->language->get('text_limit');

		$data['reviews'] = array();

		$this->load->model('tool/image');

		$filter_data = array(
			'review_id'   => $review_id,
			'language_id' => ($this->config->get('product_reviews_status') && $this->config->get('product_reviews_language_status')) ? (int)$this->config->get('config_language_id') : false,
			'sort'        => $sort,
			'order'       => $order,
			'start'       => ($page - 1) * $limit,
			'limit'       => $limit
		);

		$review_total = $this->model_catalog_review->getTotalAllReviews($filter_data);

		if (!$review_total) {
			$filter_data['language_id'] = false;

			$review_total = $this->model_catalog_review->getTotalAllReviews($filter_data);
		}

		$results = $this->model_catalog_review->getAllReviews($filter_data);

		foreach ($results as $result) {
			$pros = $this->model_catalog_review->getProsByReviewId($result['review_id']);
			$cons = $this->model_catalog_review->getConsByReviewId($result['review_id']);

			$review_images = array();

			if ($this->config->get('product_reviews_image_status')) {
				foreach ($this->model_catalog_review->getReviewImages($result['review_id']) as $image) {
					if ($image['image'] && file_exists(DIR_IMAGE . 'product_review/review/' . $image['image'])) {
						$review_images[] = array(
							'thumb' => $this->model_tool_image->resize('product_review/review/' . $image['image'], $this->config->get('product_reviews_image_thumb_width'), $this->config->get('product_reviews_image_thumb_height')),
							'popup' => $this->model_tool_image->resize('product_review/review/' . $image['image'], $this->config->get('product_reviews_image_popup_width'), $this->config->get('product_reviews_image_popup_height'))
						);
					}
				}
			}

			$data['reviews'][] = array(
				'review_id'    => $result['review_id'],
				'review_title' => $result['title'],
				'text'         => nl2br($result['text']),
				'author'       => $result['author'],
				'date'         => sprintf($this->language->get('text_date'), date($this->language->get('date_format_short'), strtotime($result['date_added']))),
				'product'      => $result['product'],
				'images'       => $review_images,
				'product_pros' => ($pros) ? $pros : array(),
				'product_cons' => ($cons) ? $cons : array(),
				'rating'       => $result['rating'],
				'ratings'      => $this->model_catalog_review->getRatingsByReviewId($result['review_id']),
				'share_url'    => $this->url->link('product/allreviews', 'review_id=' . (int)$result['review_id']),
				'share_title'  => str_replace('"', '', sprintf($this->language->get('text_share_title'), $result['author'], $result['product'])),
				'href'         => $this->url->link('product/product', 'product_id=' . $result['product_id'])
			);
		}

		$url = '';

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$data['sorts'] = array();

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_default'),
			'value' => 'r.date_added-DESC',
			'href'  => $this->url->link('product/allreviews', 'sort=r.date_added&order=DESC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_rating_desc'),
			'value' => 'rating-DESC',
			'href'  => $this->url->link('product/allreviews', 'sort=rating&order=DESC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_rating_asc'),
			'value' => 'rating-ASC',
			'href'  => $this->url->link('product/allreviews', 'sort=rating&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_helpfull_desc'),
			'value' => 'vote-DESC',
			'href'  => $this->url->link('product/allreviews', 'sort=vote&order=DESC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_helpfull_asc'),
			'value' => 'vote-ASC',
			'href'  => $this->url->link('product/allreviews', 'sort=vote&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_date_added_desc'),
			'value' => 'r.date_added-DESC',
			'href'  => $this->url->link('product/allreviews', 'sort=r.date_added&order=DESC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_date_added_asc'),
			'value' => 'r.date_added-ASC',
			'href'  => $this->url->link('product/allreviews', 'sort=r.date_added&order=ASC' . $url)
		);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['limits'] = array();

		$limits = array_unique(array($this->config->get('config_catalog_limit'), 25, 50, 75, 100));

		sort($limits);

		foreach($limits as $v){
			$data['limits'][] = array(
				'text'  => $v,
				'value' => $v,
				'href'  => $this->url->link('product/allreviews', $url . '&limit=' . $v)
			);
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product/allreviews', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		if (version_compare(VERSION, '2.0') < 0) {
			$this->data = $data;

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/allreviews.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/allreviews.tpl';
			} else {
				$this->template = 'default/template/product/allreviews.tpl';
			}

			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);

			$this->response->setOutput($this->render());
		} elseif (version_compare(VERSION, '2.2') < 0) {
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/allreviews.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/allreviews.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/product/allreviews.tpl', $data));
			}
		} else {
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('product/allreviews', $data));
		}
  	}

	public function reportabuse() {
		$this->language->load('product/product');

		$this->load->model('catalog/review');

		if (isset($this->request->get['review_id'])) {
			$review_id = (int)$this->request->get['review_id'];
		} else {
			$review_id = 0;
		}

		$review_info = $this->model_catalog_review->getReviewByReviewId($review_id);

		if ($review_info) {
			if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->config->get('product_reviews_report_abuse_status')) {
				$json = array();

				if (!isset($this->request->post['reason_id']) || !preg_match('/^[0-9]+$/i', $this->request->post['reason_id'])) {
					$json['error'] = $this->language->get('error_report_abuse');
				}

				if ((isset($this->request->post['reason_id']) && $this->request->post['reason_id'] == '0') && !preg_match('/\w+/i', $this->request->post['def'])) {
					$json['error'] = $this->language->get('error_def_report_abuse');
				}

				if ($this->config->get('product_reviews_report_abuse_guest') && !$this->customer->isLogged()) {
					$json['error'] = $this->language->get('error_logged_report_abuse');
				}

				if (!isset($json['error'])) {
					$this->model_catalog_review->addReportAbuse($review_id, $this->request->post);

					$json['success'] = $this->language->get('text_report_abuse_success');
				}

				$this->response->setOutput(json_encode($json));
			}
		}
	}

	public function vote() {
		$this->language->load('product/product');

		$this->load->model('catalog/review');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->config->get('product_reviews_helpfulness_status') && (isset($this->request->get['product_id']) && preg_match('/^[0-9]+$/i', $this->request->get['product_id']))) {
			if (!isset($this->request->post['vote']) || !preg_match('/^0|1$/i', $this->request->post['vote'])) {
				$json['error'] = $this->language->get('error_helpfull');
			}

			if (!isset($this->request->post['review_id']) || !preg_match('/^[0-9]+$/i', $this->request->post['review_id'])) {
				$json['error'] = $this->language->get('error_helpfull');
			}

			if ($this->config->get('product_reviews_helpfulness_guest') && !$this->customer->isLogged()) {
				$json['error'] = $this->language->get('error_logged_helpfull');
			}

			$name = 'APR_' . md5('ogladalemTOp' . $this->request->get['product_id'] . 'r' . $this->request->post['review_id']);

			if (isset($this->request->cookie[$name]) && $this->request->cookie[$name]) {
				$json['error'] = $this->language->get('error_already_helpfull');
			}

			if (!isset($json['error'])) {
				$this->model_catalog_review->addVoteReview($this->request->get['product_id'], $this->request->post);

				$review_info = $this->model_catalog_review->getReviewByReviewId($this->request->post['review_id']);

				if ($this->config->get('product_reviews_helpfulness_type') == 'numerically') {
					if ($this->request->post['vote'] == '1') {
						$json['success'] = sprintf($this->language->get('text_success_helpfull_numerically_yes'), (int)$review_info['vote_yes'], ((int)$review_info['vote_yes'] + (int)$review_info['vote_no']));
					} else {
						$json['success'] = sprintf($this->language->get('text_success_helpfull_numerically_no'),  (int)$review_info['vote_yes'], ((int)$review_info['vote_yes'] + (int)$review_info['vote_no']));
					}
				} else {
					if ($this->request->post['vote'] == '1') {
						$json['success'] = sprintf($this->language->get('text_success_helpfull_percentage_yes'), round($review_info['vote_yes'] / ($review_info['vote_yes'] + $review_info['vote_no']) * 100) . '%');
					} else {
						$json['success'] = sprintf($this->language->get('text_success_helpfull_percentage_no'), round($review_info['vote_yes'] / ($review_info['vote_yes'] + $review_info['vote_no']) * 100) . '%');
					}
				}

				setcookie($name, 'vote', time() + 7*24*60*60*1000);
			}
		}

		$this->response->setOutput(json_encode($json));
	}

	public function reviewimageupload() {
		$this->language->load('product/product');

		$json = array();

		if (!empty($this->request->files['file']['name'])) {
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));

			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
				$json['error'] = $this->language->get('error_filename');
			}

			$allowed = array('jpeg', 'jpg', 'gif', 'png', 'bmp');

			if (!in_array(substr(strrchr(utf8_strtolower($filename), '.'), 1), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}

			$allowed = array('image/jpeg', 'image/gif', 'image/png', 'image/bmp');

			if (!in_array(utf8_strtolower($this->request->files['file']['type']), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}

			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}

		if (!$json && is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
			$file = basename(md5($filename . time())) . basename($filename);

			$json['file'] = $file;

			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_IMAGE . 'product_review/review/' . $file);

			$this->load->model('tool/image');

			$json['thumb'] = $this->model_tool_image->resize('product_review/review/' . $file, 40, 40);

			$json['success'] = $this->language->get('text_upload');
		}

		$this->response->setOutput(json_encode($json));
	}
}
?>