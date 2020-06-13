<?php
class ControllerProductReviewReview extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('product_review/review');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/review');

		$this->getList();
	}

	public function add() {
		$this->language->load('product_review/review');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/review');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_review->addReview($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_author'])) {
				$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_average'])) {
				$url .= '&filter_average=' . $this->request->get['filter_average'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_store'])) {
				$url .= '&filter_store=' . $this->request->get['filter_store'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirectTo('product_review/review', $url);
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('product_review/review');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/review');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_review->editReview($this->request->get['review_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_author'])) {
				$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_average'])) {
				$url .= '&filter_average=' . $this->request->get['filter_average'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_store'])) {
				$url .= '&filter_store=' . $this->request->get['filter_store'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirectTo('product_review/review', $url);
		}

		$this->getForm();
	}

	public function save() {
		$this->language->load('product_review/review');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_review');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (isset($this->request->post['status'])) {
				foreach ($this->request->post['status'] as $review_id => $status) {
					$this->model_catalog_product_review->changeStatus($review_id, $status);
				}
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_author'])) {
				$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_average'])) {
				$url .= '&filter_average=' . $this->request->get['filter_average'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_store'])) {
				$url .= '&filter_store=' . $this->request->get['filter_store'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirectTo('product_review/review', $url);
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('product_review/review');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/review');
		$this->load->model('catalog/product_review');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $review_id) {
				$this->model_catalog_review->deleteReview($review_id);
				$this->model_catalog_product_review->deleteRatingByReviewId($review_id);
				$this->model_catalog_product_review->deleteAttributeByReviewId($review_id);
				$this->model_catalog_product_review->deleteReportByReviewId($review_id);

				foreach ($this->model_catalog_product_review->getReviewImages($review_id) as $image) {
					$this->model_catalog_product_review->deleteImage($image['review_image_id']);
				}
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_author'])) {
				$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_average'])) {
				$url .= '&filter_average=' . $this->request->get['filter_average'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_store'])) {
				$url .= '&filter_store=' . $this->request->get['filter_store'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirectTo('product_review/review', $url);
		}

		$this->getList();
	}

	public function deletevote() {
		$this->language->load('product_review/review');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_review');

		if (isset($this->request->get['review_id']) && $this->validateDeleteVote()) {
			$this->model_catalog_product_review->deleteVote($this->request->get['review_id'], $this->request->get['vote']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_author'])) {
				$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_average'])) {
				$url .= '&filter_average=' . $this->request->get['filter_average'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_store'])) {
				$url .= '&filter_store=' . $this->request->get['filter_store'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirectTo('product_review/review', $url);
		}

		$this->getList();
	}

	public function deleteimage() {
		$this->language->load('product_review/review');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && isset($this->request->post['review_image_id'])) {
			if (!preg_match('/^[0-9]+$/', $this->request->post['review_image_id'])) {
				$json['error'] = $this->language->get('error_review_image_id');
			}

			if (!isset($json['error'])) {
				$this->load->model('catalog/product_review');

				$this->model_catalog_product_review->deleteImage($this->request->post['review_image_id']);

				$json['success'] = $this->language->get('text_success_image');
			}
		}

		$this->response->setOutput(json_encode($json));
	}

	protected function getList() {
		$data = array_merge(array(), $this->language->load('product_review/review'));

		if (version_compare(VERSION, '2.0') < 0) {
			$this->document->addStyle('view/javascript/AdvancedProductReviews/font-awesome/css/font-awesome.min.css');
			$this->document->addScript('view/javascript/AdvancedProductReviews/bootstrap/js/bootstrap.min.js');
			$this->document->addScript('view/javascript/AdvancedProductReviews/compatibility.js');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/bootstrap/css/bootstrap.css');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/compatibility.css');
		}

		$this->document->addStyle('view/javascript/AdvancedProductReviews/module.css');

		if (isset($this->request->get['filter_product'])) {
			$filter_product = $this->request->get['filter_product'];
		} else {
			$filter_product = null;
		}

		if (isset($this->request->get['filter_author'])) {
			$filter_author = $this->request->get['filter_author'];
		} else {
			$filter_author = null;
		}

		if (isset($this->request->get['filter_average'])) {
			$filter_average = $this->request->get['filter_average'];
		} else {
			$filter_average = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_store'])) {
			$filter_store = $this->request->get['filter_store'];
		} else {
			$filter_store = null;
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
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

		$url = '';

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_average'])) {
			$url .= '&filter_average=' . $this->request->get['filter_average'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . $this->request->get['filter_store'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$data['breadcrumbs'] = array();

		$data['save'] = $this->url->link('product_review/review/save', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['add'] = $this->url->link('product_review/review/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('product_review/review/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$stores = array();

		$stores[0] = strip_tags($this->language->get('text_default'));

		$this->load->model('setting/store');

		foreach ($this->model_setting_store->getStores() as $store) {
			$stores[$store['store_id']] = $store['name'];
		}

		$data['stores'] = $stores;

		$this->load->model('catalog/product_review');
		$this->load->model('tool/image');

		$pagination_limit = ($this->config->get('config_admin_limit')) ? $this->config->get('config_admin_limit') : (($this->config->get('config_limit_admin')) ? $this->config->get('config_limit_admin') : 20);

		$data['reviews'] = array();

		$filter_data = array(
			'filter_product'    => $filter_product,
			'filter_author'     => $filter_author,
			'filter_average'    => $filter_average,
			'filter_status'     => $filter_status,
			'filter_store'      => $filter_store,
			'filter_date_added' => $filter_date_added,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $pagination_limit,
			'limit' => $pagination_limit
		);

		$review_total = $this->model_catalog_review->getTotalReviews();

		$results = $this->model_catalog_review->getReviews($filter_data);

    	foreach ($results as $result) {
			$review_images = $this->model_catalog_product_review->getReviewImages($result['review_id']);

			$images = array();

			foreach ($review_images as $image) {
				if ($image['image'] && file_exists(DIR_IMAGE . 'product_review/review/' . $image['image'])) {
					$thumb = $this->model_tool_image->resize('product_review/review/' . $image['image'], 40, 40);
					$popup = $this->model_tool_image->resize('product_review/review/' . $image['image'], 600, 600);

					$images[] = array(
						'review_image_id' => $image['review_image_id'],
						'thumb'           => $thumb,
						'popup'           => $popup					
					);
				}
			}

			

			$data['reviews'][] = array(
				'review_id'  => $result['review_id'],
				'images'     => $images,
				'name'       => $result['name'],
				'author'     => $result['author'],
				'ratings'    => $this->model_catalog_product_review->getRatingsByReviewId($result['review_id']),
				'rating_avg' => $result['rating'],
				'pros'       => (int)$result['pros'],
				'cons'       => (int)$result['cons'],
				'href_pros'  => $this->url->link('product_review/attribute', 'token=' . $this->session->data['token'] . '&filter_review_id=' . $result['review_id'] . '&filter_type=1', 'SSL'),
				'href_cons'  => $this->url->link('product_review/attribute', 'token=' . $this->session->data['token'] . '&filter_review_id=' . $result['review_id'] . '&filter_type=0', 'SSL'),
				'vote_yes'   => $result['vote_yes'],
				'vote_no'    => $result['vote_no'],
				'href_vote_yes' => $this->url->link('product_review/review/deletevote', 'token=' . $this->session->data['token'] . '&review_id=' . $result['review_id'] . '&vote=yes', 'SSL'),
				'href_vote_no'  => $this->url->link('product_review/review/deletevote', 'token=' . $this->session->data['token'] . '&review_id=' . $result['review_id'] . '&vote=no', 'SSL'),
				'store'      => (isset($stores[$result['store_id']])) ? $stores[$result['store_id']] : 'N/A',
				'status'     => $result['status'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'view'       => $this->url->link('product_review/review/info', 'token=' . $this->session->data['token'] . '&review_id=' . $result['review_id'] . $url, 'SSL'),
				'edit'       => $this->url->link('product_review/review/edit', 'token=' . $this->session->data['token'] . '&review_id=' . $result['review_id'] . $url, 'SSL')
			);
		}

		$data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (!$this->model_catalog_product_review->getTotalRatings(array('start' => 0, 'limit' => 2))) {
			$data['error_rating'] = sprintf($this->language->get('error_empty_rating'), $this->url->link('product_review/rating', 'token=' . $this->session->data['token'], 'SSL'));
		} else {
			$data['error_rating'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_average'])) {
			$url .= '&filter_average=' . $this->request->get['filter_average'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . $this->request->get['filter_store'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_product'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$data['sort_author'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . '&sort=r.author' . $url, 'SSL');
		$data['sort_avg'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . '&sort=rating_avg' . $url, 'SSL');
		$data['sort_pros'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . '&sort=pros' . $url, 'SSL');
		$data['sort_cons'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . '&sort=cons' . $url, 'SSL');
		$data['sort_vote_yes'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . '&sort=r.vote_yes' . $url, 'SSL');
		$data['sort_vote_no'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . '&sort=r.vote_no' . $url, 'SSL');
		$data['sort_store_id'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . '&sort=r.store_id' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . '&sort=r.status' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . '&sort=r.date_added' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_average'])) {
			$url .= '&filter_average=' . $this->request->get['filter_average'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . $this->request->get['filter_store'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = $pagination_limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = (version_compare(VERSION, '2.0') < 0) ? '' : sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * $pagination_limit) + 1 : 0, ((($page - 1) * $pagination_limit) > ($review_total - $pagination_limit)) ? $review_total : ((($page - 1) * $pagination_limit) + $pagination_limit), $review_total, ceil($review_total / $pagination_limit));

		$data['filter_product'] = $filter_product;
		$data['filter_author'] = $filter_author;
		$data['filter_average'] = $filter_average;
		$data['filter_status'] = $filter_status;
		$data['filter_store'] = $filter_store;
		$data['filter_date_added'] = $filter_date_added;

		$data['sort'] = $sort;
		$data['order'] = $order;

		if (version_compare(VERSION, '2.0') < 0) {
			$data['column_left'] = '';
			$this->data = $data;

			$this->template = 'product_review/review_list.tpl';

			$this->children = array(
				'common/header',
				'common/footer',
			);

			$this->response->setOutput($this->render());
		} else {
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('product_review/review_list.tpl', $data));
		}
		
	}

	protected function getForm() {
		$data = array_merge(array(), $this->language->load('product_review/review'));

		if (version_compare(VERSION, '2.0') < 0) {
			$this->document->addStyle('view/javascript/AdvancedProductReviews/font-awesome/css/font-awesome.min.css');
			$this->document->addScript('view/javascript/AdvancedProductReviews/bootstrap/js/bootstrap.min.js');
			$this->document->addScript('view/javascript/AdvancedProductReviews/compatibility.js');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/bootstrap/css/bootstrap.css');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/compatibility.css');
		}

		$this->document->addStyle('view/javascript/AdvancedProductReviews/module.css');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['product'])) {
			$data['error_product'] = $this->error['product'];
		} else {
			$data['error_product'] = '';
		}

 		if (isset($this->error['author'])) {
			$data['error_author'] = $this->error['author'];
		} else {
			$data['error_author'] = '';
		}

 		if (isset($this->error['text'])) {
			$data['error_text'] = $this->error['text'];
		} else {
			$data['error_text'] = '';
		}

 		if (isset($this->error['rating'])) {
			$data['error_rating'] = $this->error['rating'];
		} else {
			$data['error_rating'] = '';
		}

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

   		$data['breadcrumbs'] = array();

		if (!isset($this->request->get['review_id'])) {
			$data['action'] = $this->url->link('product_review/review/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('product_review/review/edit', 'token=' . $this->session->data['token'] . '&review_id=' . $this->request->get['review_id'] . $url, 'SSL');
		}

		$data['text_form'] = !isset($this->request->get['review_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['cancel'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['review_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$review_info = $this->model_catalog_review->getReview($this->request->get['review_id']);
		}

		$data['help_image'] = sprintf($this->language->get('help_image'), $this->config->get('product_reviews_image_limit'));

		$data['token'] = $this->session->data['token'];

		$this->load->model('catalog/product_review');

		if (isset($this->request->post['product_id'])) {
			$data['product_id'] = $this->request->post['product_id'];
		} elseif (!empty($review_info)) {
			$data['product_id'] = $review_info['product_id'];
		} else {
			$data['product_id'] = '';
		}

		if (isset($this->request->post['product'])) {
			$data['product'] = $this->request->post['product'];
		} elseif (!empty($review_info)) {
			$data['product'] = $review_info['product'];
		} else {
			$data['product'] = '';
		}

		if (isset($this->request->post['author'])) {
			$data['author'] = $this->request->post['author'];
		} elseif (!empty($review_info)) {
			$data['author'] = $review_info['author'];
		} else {
			$data['author'] = '';
		}

		if (isset($this->request->post['review_title'])) {
			$data['review_title'] = $this->request->post['review_title'];
		} elseif (!empty($review_info)) {
			$data['review_title'] = $review_info['title'];
		} else {
			$data['review_title'] = '';
		}

		if (isset($this->request->post['text'])) {
			$data['text'] = $this->request->post['text'];
		} elseif (!empty($review_info)) {
			$data['text'] = $review_info['text'];
		} else {
			$data['text'] = '';
		}

		if (isset($this->request->post['product_rating'])) {
			$data['product_rating'] = base64_encode(serialize($this->request->post['product_rating']));
		} elseif (!empty($review_info) && $this->model_catalog_product_review->getRatingsByReviewId($review_info['review_id'])) {
			$_product_rating = array();

			foreach ($this->model_catalog_product_review->getRatingsByReviewId($review_info['review_id']) as $rating) {
				$_product_rating[$rating['rating_id']] = $rating['rating'];	
			}

			$data['product_rating'] = base64_encode(serialize($_product_rating));
		} else {
			$data['product_rating'] = '';

			if (isset($this->request->post['rating'])) {
				$data['product_rating'] = base64_encode(serialize($this->request->post['rating']));
			} elseif (!empty($review_info)) {
				$data['product_rating'] = base64_encode(serialize($review_info['rating']));
			} else {
				$data['product_rating'] = '';
			}
		}

		if (isset($this->request->post['comment'])) {
			$data['comment'] = $this->request->post['comment'];
		} elseif (!empty($review_info)) {
			$data['comment'] = $review_info['comment'];
		} else {
			$data['comment'] = '';
		}

		if (isset($this->request->post['store_id'])) {
			$data['store_id'] = $this->request->post['store_id'];
		} elseif (!empty($review_info)) {
			$data['store_id'] = $review_info['store_id'];
		} else {
			$data['store_id'] = 0;
		}

		if (isset($this->request->post['pros'])) {
			$data['pros'] = $this->request->post['pros'];
		} elseif (!empty($review_info)) {
			$data['pros'] = $this->model_catalog_product_review->getProsByReviewId($review_info['review_id']);
		} else {
			$data['pros'] = array();
		}

		if (isset($this->request->post['cons'])) {
			$data['cons'] = $this->request->post['cons'];
		} elseif (!empty($review_info)) {
			$data['cons'] = $this->model_catalog_product_review->getConsByReviewId($review_info['review_id']);
		} else {
			$data['cons'] = array();
		}

		if (isset($this->request->post['images'])) {
			$images = $this->request->post['images'];
		} elseif (!empty($review_info)) {
			$images = $this->model_catalog_product_review->getReviewImages($review_info['review_id']);
		} else {
			$images = array();
		}

		$this->load->model('tool/image');

		$data['images'] = array();

		foreach ($images as $image) {
			if ($image['image'] && file_exists(DIR_IMAGE . 'product_review/review/' . $image['image'])) {
				$data['images'][] = array(
					'review_image_id' => $image['review_image_id'],
					'thumb'           => $this->model_tool_image->resize('product_review/review/' . $image['image'], 40, 40),
					'image'           => $image['image']				
				);
			}
		}

		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		if (isset($this->request->post['date_added'])) {
			$data['date_added'] = $this->request->post['date_added'];
		} elseif (!empty($review_info)) {
			$data['date_added'] = date("Y-m-d", strtotime($review_info['date_added']));
		} else {
			$data['date_added'] = date("Y-m-d");
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($review_info)) {
			$data['status'] = $review_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['stores'] = array();

		$data['stores'][] = array('store_id' => '0', 'name' => strip_tags($this->language->get('text_default')));

		$this->load->model('setting/store');

		$stores = $this->model_setting_store->getStores();

		foreach ($stores as $store) {
			$data['stores'][] = array(
				'store_id' => $store['store_id'],
				'name'     => $store['name']
			);
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['language_id'])) {
			$data['language_id'] = $this->request->post['language_id'];
		} elseif (!empty($review_info)) {
			$data['language_id'] = $review_info['language_id'];
		} else {
			$data['language_id'] = '';
		}

		if (isset($this->request->post['recommend'])) {
			$data['recommend'] = $this->request->post['recommend'];
		} elseif (!empty($review_info)) {
			$data['recommend'] = $review_info['recommend'];
		} else {
			$data['recommend'] = '';
		}

		if (version_compare(VERSION, '2.0') < 0) {
			$data['column_left'] = '';
			$this->data = $data;

			$this->template = 'product_review/review_form.tpl';

			$this->children = array(
				'common/header',
				'common/footer',
			);

			$this->response->setOutput($this->render());
		} else {
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('product_review/review_form.tpl', $data));
		}
	}

	public function info() {
		$data = array_merge(array(), $this->language->load('product_review/review'));

		if (version_compare(VERSION, '2.0') < 0) {
			$this->document->addStyle('view/javascript/AdvancedProductReviews/font-awesome/css/font-awesome.min.css');
			$this->document->addScript('view/javascript/AdvancedProductReviews/bootstrap/js/bootstrap.min.js');
			$this->document->addScript('view/javascript/AdvancedProductReviews/compatibility.js');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/bootstrap/css/bootstrap.css');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/compatibility.css');
		}

		$this->document->addStyle('view/javascript/AdvancedProductReviews/module.css');

		if (isset($this->request->get['review_id'])) {
			$review_id = $this->request->get['review_id'];
		} else {
			$review_id = 0;
		}

		$this->load->model('catalog/review');

		$review_info = $this->model_catalog_review->getReview($review_id);

		if ($review_info) {
			$this->load->model('catalog/product_review');
			$this->load->model('tool/image');

			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
				$this->model_catalog_product_review->addComment($review_id, $this->request->post);

				$this->session->data['success'] = $this->language->get('text_success');

				$this->redirectTo('product_review/review', '');
			}

			$this->document->setTitle($this->language->get('text_review'));

			$data['breadcrumbs'] = array();

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

			if (isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];

				unset($this->session->data['success']);
			} else {
				$data['success'] = '';
			}

			$data['review_id'] = $this->request->get['review_id'];
			$data['date_added'] = date($this->language->get('date_format_short'), strtotime($review_info['date_added']));
			$data['review_title'] = ($review_info['title']) ? $review_info['title'] : 'N/A';
			$data['author'] = $review_info['author'];
			$data['product'] = $review_info['product'];
			$data['text'] = nl2br($review_info['text']);
			$data['ratings'] = $this->model_catalog_product_review->getRatingsByReviewId($review_id);
			$data['rating_avg'] = $review_info['rating'];
			$data['comment'] = $review_info['comment'];
			$data['date_reply'] = ($review_info['comment_date_added'] != '0000-00-00 00:00:00' && $review_info['comment']) ? date($this->language->get('date_format_short'), strtotime($review_info['comment_date_added'])) : '';
			$data['pros'] = $this->model_catalog_product_review->getProsByReviewId($review_id);
			$data['cons'] = $this->model_catalog_product_review->getConsByReviewId($review_id);
			$data['status'] = ($review_info['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled');

			$images = $this->model_catalog_product_review->getReviewImages($review_info['review_id']);

			$data['images'] = array();

			foreach ($images as $image) {
				if ($image['image'] && file_exists(DIR_IMAGE . 'product_review/review/' . $image['image'])) {
					$thumb = $this->model_tool_image->resize('product_review/review/' . $image['image'], 40, 40);
					$popup = $this->model_tool_image->resize('product_review/review/' . $image['image'], 600, 600);

					$data['images'][] = array(
						'review_image_id' => $image['review_image_id'],
						'thumb'           => $thumb,
						'popup'           => $popup					
					);
				}
			}

			if (isset($this->request->post['comment_images'])) {
				$comment_images = $this->request->post['comment_images'];
			} elseif (!empty($review_info)) {
				$comment_images = $this->model_catalog_product_review->getReviewCommentImages($review_info['review_id']);
			} else {
				$comment_images = array();
			}

			$data['comment_images'] = array();

			foreach ($comment_images as $image) {
				if ($image['image'] && file_exists(DIR_IMAGE . 'product_review/review/' . $image['image'])) {
					$data['comment_images'][] = array(
						'comment_image_id' => $image['comment_image_id'],
						'thumb'            => $this->model_tool_image->resize('product_review/review/' . $image['image'], 40, 40),
						'image'            => $image['image']				
					);
				}
			}

			$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 40, 40);

			$stores = array();

			$stores[0] = strip_tags($this->language->get('text_default'));

			$this->load->model('setting/store');

			foreach ($this->model_setting_store->getStores() as $store) {
				$stores[$store['store_id']] = $store['name'];
			}

			$data['store'] = (isset($stores[$review_info['store_id']])) ? $stores[$review_info['store_id']] : 'N/A';

			$this->load->model('localisation/language');

			$language = $this->model_localisation_language->getLanguage($review_info['language_id']);
			$data['language'] = ($language) ? $language['name'] : 'N/A';

			if ($review_info['recommend'] == 'y') {
				$data['recommend'] = $this->language->get('text_yes');
			} elseif ($review_info['recommend'] == 'n') {
				$data['recommend'] = $this->language->get('text_no') ;
			} else {
				$data['recommend'] = 'N/A';
			}

			$data['cancel'] = $this->url->link('product_review/review', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$data['action'] = $this->url->link('product_review/review/info', 'token=' . $this->session->data['token'] . '&review_id=' . $review_id . $url, 'SSL');

			$data['token'] = $this->session->data['token'];

			if (version_compare(VERSION, '2.0') < 0) {
				$data['column_left'] = '';
				$this->data = $data;

				$this->template = 'product_review/review_info.tpl';

				$this->children = array(
					'common/header',
					'common/footer',
				);

				$this->response->setOutput($this->render());
			} else {
				$data['header'] = $this->load->controller('common/header');
				$data['column_left'] = $this->load->controller('common/column_left');
				$data['footer'] = $this->load->controller('common/footer');

				$this->response->setOutput($this->load->view('product_review/review_info.tpl', $data));
			}
		} else {
			$this->redirectTo('product_review/review');
		}
	}

	public function rating() {
		$this->language->load('product_review/review');

		$this->load->model('catalog/product_review');
		$this->load->model('catalog/product');

		if ((isset($this->request->get['product_id']) && preg_match('/^[0-9]+$/', $this->request->get['product_id'])) && (isset($this->request->get['review_id']) && preg_match('/^[0-9]+$/', $this->request->get['review_id'])) && isset($this->request->post['prc'])) {
			if ($this->request->get['product_id'] > 0) {
				$this->response->setOutput($this->prepareTpl($this->request->post['prc'], $this->request->get['product_id'], ($this->request->get['review_id'] ? 'edit' : 'new')));
			} else {
				$this->response->setOutput('<div class="warning">' . $this->language->get('error_loading') . '</div>');
			}
		} else {
			$this->response->setOutput('<div class="warning">' . $this->language->get('error_loading') . '</div>');
		}
	}

	private function prepareTpl($data, $product_id, $key) {
		$ratings = $this->model_catalog_product_review->getRatings(array('sort'  => 'r.date_added', 'order' => 'ASC', 'start' => 0, 'limit' => 999));

		$product_store = $this->model_catalog_product->getProductStores($product_id);

		if (!$product_store) {
			return'<div class="warning">' . $this->language->get('error_product_store') . '</div>';
		}

		$data = unserialize(stripslashes(base64_decode($data)));

		if ((!$data || (!is_array($data) && preg_match('/^[1-5]$/', $data))) && $key == 'edit') {
			$default = '';
			for ($i = 1; $i <= 5; $i++) {
				$default.=  '<td class="text-center">';
				if ($data == $i) {
					$default .= '<input type="radio" name="rating" value="' . $i . '" checked />';
				} else {
					$default .= '<input type="radio" name="rating" value="' . $i . '" />';
				}

				$default.=  '</td>';
			}
		} else {
			$default = '';
		}

		$html = '<table class="rating">
			      <tr><td><b class="rating">' . $this->language->get('entry_bad') . '</b></td>';
		for ($i = 1; $i <= 5; $i++) { $html .= '<td class="text-center">' . $i . '</td>'; }
		$html .= '<td><b class="rating">' . $this->language->get('entry_good') . '</b></td></tr>' . (($default) ? '<tr>' . $default . '</tr>' : '') . '
				  <tbody>';

		foreach ($ratings as $row) {
			if (array_intersect(explode("#", $row['stores']), $product_store)) {
				if (($key == 'edit' && isset($data[$row['rating_id']])) || ($key == 'new' && $row['status'])) {
					$html .= '<tr><td>' . $row['name'] . '</td>';

					for ($i = 1; $i <= 5; $i++) {
						$html .=  '<td class="text-center">';

						if (isset($data[$row['rating_id']]) && $data[$row['rating_id']] == $i) {
							$html .= '<input type="radio" name="product_rating[' . $row['rating_id'] . ']" value="' . $i . '" checked />';
						} else {
							$html .= '<input type="radio" name="product_rating[' . $row['rating_id'] . ']" value="' . $i . '" />';
						}

						$html .=  '</td>';
					}

					$html .= '</tr>';
				}
			}
		}

		$html .= '</tbody></table>';

		return $html;
	}

	public function upload() {
		$this->language->load('product_review/review');

		$json = array();

		if (!$this->user->hasPermission('modify', 'product_review/review')) {
      		$json['error'] = $this->language->get('error_permission');
    	}

		if (!isset($json['error'])) {
			if (!empty($this->request->files['file']['name'])) {
				$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));

				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
					$json['error'] = $this->language->get('error_filename');
				}

				$allowed = array('jpeg', 'jpg', 'jpe', 'gif', 'png', 'bmp');

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
		}

		if (!$json && is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
			$file = basename(md5($filename . time())) . basename($filename);

			$json['file'] = $file;

			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_IMAGE . 'product_review/review/' . $file);

			$this->load->model('tool/image');

			$json['thumb'] = $this->model_tool_image->resize('product_review/review/' . $file, 40, 40);

			$json['success'] = $this->language->get('text_upload');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'product_review/review')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['product_id']) {
			$this->error['product'] = $this->language->get('error_product');
		}

		if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 64)) {
			$this->error['author'] = $this->language->get('error_author');
		}

		if (utf8_strlen($this->request->post['text']) < 1) {
			$this->error['text'] = $this->language->get('error_text');
		}

		if (!isset($this->request->post['product_rating']) && !isset($this->request->post['rating'])) {
			$this->error['rating'] = $this->language->get('error_rating');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'product_review/review')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDeleteVote() {
		if (!$this->user->hasPermission('modify', 'product_review/review')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			if ((!isset($this->request->get['review_id']) || !isset($this->request->get['vote'])) || !preg_match('/yes|no/i', $this->request->get['vote'])) {
				$this->error = true;
			}
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'product_review/review')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function optimize() {
		if ($this->validate()) {
			$this->load->language('product_review/review');

			$this->load->model('catalog/product_review');

			$this->model_catalog_product_review->optimizeTable();

			$this->session->data['success'] = $this->language->get('text_success_optimize');

			$this->redirectTo('product_review/review');
		}
	}

	private function redirectTo($route, $params = '') {
		if (!$route) {
			$route = 'common/home';
		}

		if (version_compare(VERSION, '2.0') < 0) {
			$this->redirect($this->url->link($route, 'token=' . $this->session->data['token'] . $params, 'SSL'));
		} else {
			$this->response->redirect($this->url->link($route, 'token=' . $this->session->data['token'] . $params, 'SSL'));
		}
	}
}
?>