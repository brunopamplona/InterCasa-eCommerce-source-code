<?php
class ControllerProductReviewReport extends Controller {
	private $error = array();

  	public function index() {
		$this->language->load('product_review/report');

		$this->document->setTitle($this->language->get('heading_title')); 

		$this->load->model('catalog/product_review');

		$this->getList();
  	}

  	public function add() {
    	$this->language->load('product_review/report');

    	$this->document->setTitle($this->language->get('heading_title_reason'));

		$this->load->model('catalog/product_review');

    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateReasonForm()) {
			$this->model_catalog_product_review->addReason($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success_reason');

			$url = '';

			if (isset($this->request->get['filter_store_id'])) {
				$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->redirectTo('product_review/report/reason', $url);
    	}

    	$this->getForm();
  	}

  	public function edit() {
    	$this->language->load('product_review/report');

    	$this->document->setTitle($this->language->get('heading_title_reason'));

		$this->load->model('catalog/product_review');

    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateReasonForm()) {
			$this->model_catalog_product_review->editReason($this->request->get['reason_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success_reason');

			$url = '';

			if (isset($this->request->get['filter_store_id'])) {
				$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->redirectTo('product_review/report/reason', $url);
		}

    	$this->getForm();
  	}

  	public function deleteReport() {
    	$this->language->load('product_review/report');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_review');

		if ((isset($this->request->post['selected']) || isset($this->request->get['report_id'])) && $this->validateDelete()) {
			if (isset($this->request->post['selected'])) {
				foreach ($this->request->post['selected'] as $report_id) {
					$this->model_catalog_product_review->deleteReport($report_id);
				}
			} elseif (isset($this->request->get['report_id']) && preg_match('/^\d+$/', $this->request->get['report_id'])) {
				$review_id = false;

				if (isset($this->request->get['review_id'])) {
					$review_id = $this->request->get['review_id'];
				}

				$this->model_catalog_product_review->deleteReport($this->request->get['report_id'], $review_id);
			}

			$this->session->data['success'] = $this->language->get('text_success_report');

			$url = '';

			if (isset($this->request->get['filter_store_id'])) {
				$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
			}

			if (isset($this->request->get['filter_date_added_start'])) {
				$url .= '&filter_date_added_start=' . $this->request->get['filter_date_added_start'];
			}

			if (isset($this->request->get['filter_date_added_stop'])) {
				$url .= '&filter_date_added_stop=' . $this->request->get['filter_date_added_stop'];
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

			$this->redirectTo('product_review/report', $url);
		}

    	$this->getList();
  	}

	public function deleteReason() {
    	$this->language->load('product_review/report');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_review');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $reason_id) {
				$this->model_catalog_product_review->deleteReason($reason_id);
			}

			$this->session->data['success'] = $this->language->get('text_success_reason');

			$url = '';

			if (isset($this->request->get['filter_store_id'])) {
				$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->redirectTo('product_review/report/reason', $url);
		}

    	$this->reason();
  	}

  	protected function getList() {				
		$data = array_merge(array(), $this->language->load('product_review/report'));

		if (version_compare(VERSION, '2.0') < 0) {
			$this->document->addStyle('view/javascript/AdvancedProductReviews/font-awesome/css/font-awesome.min.css');
			$this->document->addScript('view/javascript/AdvancedProductReviews/bootstrap/js/bootstrap.min.js');
			$this->document->addScript('view/javascript/AdvancedProductReviews/compatibility.js');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/bootstrap/css/bootstrap.css');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/compatibility.css');
		}

		$this->document->addStyle('view/javascript/AdvancedProductReviews/module.css');

		if (isset($this->request->get['filter_store_id'])) {
			$filter_store_id = $this->request->get['filter_store_id'];
		} else {
			$filter_store_id = null;
		}

		if (isset($this->request->get['filter_date_added_start'])) {
			$filter_date_added_start = $this->request->get['filter_date_added_start'];
		} else {
			$filter_date_added_start = null;
		}

		if (isset($this->request->get['filter_date_added_stop'])) {
			$filter_date_added_stop = $this->request->get['filter_date_added_stop'];
		} else {
			$filter_date_added_stop = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'ar.date_added';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_store_id'])) {
			$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
		}

		if (isset($this->request->get['filter_date_added_start'])) {
			$url .= '&filter_date_added_start=' . $this->request->get['filter_date_added_start'];
		}

		if (isset($this->request->get['filter_date_added_stop'])) {
			$url .= '&filter_date_added_stop=' . $this->request->get['filter_date_added_stop'];
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

		$data['reason'] = $this->url->link('product_review/report/reason', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('product_review/report/deleteReport', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['reports'] = array();

		$filter_data = array(
			'filter_store_id'	        => $filter_store_id,
			'filter_date_added_start'   => $filter_date_added_start,
			'filter_date_added_stop'    => $filter_date_added_stop,
			'sort'                      => $sort,
			'order'                     => $order,
			'start'                     => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                     => $this->config->get('config_admin_limit')
		);

		$report_total = $this->model_catalog_product_review->getTotalReports($filter_data);

		$results = array();

		if ($report_total) {
			$results = $this->model_catalog_product_review->getReports($filter_data);
		}

		foreach ($results as $result) {
			$data['reports'][] = array(
				'report_id'     => $result['report_id'],
				'review'        => '<a href="' . $this->url->link('product_review/review/edit', 'token=' . $this->session->data['token'] . '&review_id=' . $result['review_id'], 'SSL') . '">' . utf8_substr(strip_tags(html_entity_decode($result['text'], ENT_QUOTES, 'UTF-8')), 0, 190) . '..' . '</a>',
				'title'         => $result['title'],
				'store'         => $result['store_id'],
				'reported'      => ($result['customer_id']) ? '<a href="' . $this->url->link('sale/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'], 'SSL') . '">' . $result['reported'] . '</a>' : $result['reported'],
				'date_added'    => date($this->language->get('date_format_long'), strtotime($result['date_added'])),
				'selected'      => isset($this->request->post['selected']) && in_array($result['report_id'], $this->request->post['selected']),
				'delete'        => $this->url->link('product_review/report/deleteReport', 'token=' . $this->session->data['token'] . '&report_id=' . $result['report_id'] . $url, 'SSL'),
				'delete_review' => $this->url->link('product_review/report/deleteReport', 'token=' . $this->session->data['token'] . '&report_id=' . $result['report_id'] . '&review_id=' . $result['review_id'] . $url, 'SSL')
			);
    	}

		$data['stores'] = array();
		$data['stores'][] = array('store_id' => '0', 'name' => $this->language->get('text_default'));

		$this->load->model('setting/store');

		$stores = $this->model_setting_store->getStores();

		foreach ($stores as $store) {
			$data['stores'][$store['store_id']] = array(
				'store_id' => $store['store_id'],
				'name'     => $store['name']
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

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_store_id'])) {
			$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
		}

		if (isset($this->request->get['filter_date_added_start'])) {
			$url .= '&filter_date_added_start=' . $this->request->get['filter_date_added_start'];
		}

		if (isset($this->request->get['filter_date_added_stop'])) {
			$url .= '&filter_date_added_stop=' . $this->request->get['filter_date_added_stop'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_store_id'] = $this->url->link('product_review/report', 'token=' . $this->session->data['token'] . '&sort=ar.store_id' . $url, 'SSL');
		$data['sort_reported'] = $this->url->link('product_review/report', 'token=' . $this->session->data['token'] . '&sort=ar.reported' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('product_review/report', 'token=' . $this->session->data['token'] . '&sort=ar.date_added' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_store_id'])) {
			$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
		}

		if (isset($this->request->get['filter_date_added_start'])) {
			$url .= '&filter_date_added_start=' . $this->request->get['filter_date_added_start'];
		}

		if (isset($this->request->get['filter_date_added_stop'])) {
			$url .= '&filter_date_added_stop=' . $this->request->get['filter_date_added_stop'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination_limit = ($this->config->get('config_admin_limit')) ? $this->config->get('config_admin_limit') : (($this->config->get('config_limit_admin')) ? $this->config->get('config_limit_admin') : 20);

		$pagination = new Pagination();
		$pagination->total = $report_total;
		$pagination->page = $page;
		$pagination->limit = $pagination_limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product_review/report', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = (version_compare(VERSION, '2.0') < 0) ? '' : sprintf($this->language->get('text_pagination'), ($report_total) ? (($page - 1) * $pagination_limit) + 1 : 0, ((($page - 1) * $pagination_limit) > ($report_total - $pagination_limit)) ? $report_total : ((($page - 1) * $pagination_limit) + $pagination_limit), $report_total, ceil($report_total / $pagination_limit));

		$data['filter_store_id'] = $filter_store_id;
		$data['filter_date_added_start'] = $filter_date_added_start;
		$data['filter_date_added_stop'] = $filter_date_added_stop;

		$data['sort'] = $sort;
		$data['order'] = $order;

		if (version_compare(VERSION, '2.0') < 0) {
			$data['column_left'] = '';
			$this->data = $data;

			$this->template = 'product_review/report_list.tpl';

			$this->children = array(
				'common/header',
				'common/footer',
			);

			$this->response->setOutput($this->render());
		} else {
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('product_review/report_list.tpl', $data));
		}
  	}

	public function reason() {
		$data = array_merge(array(), $this->language->load('product_review/report'));

		if (version_compare(VERSION, '2.0') < 0) {
			$this->document->addStyle('view/javascript/AdvancedProductReviews/font-awesome/css/font-awesome.min.css');
			$this->document->addScript('view/javascript/AdvancedProductReviews/bootstrap/js/bootstrap.min.js');
			$this->document->addScript('view/javascript/AdvancedProductReviews/compatibility.js');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/bootstrap/css/bootstrap.css');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/compatibility.css');
		}

		$this->document->addStyle('view/javascript/AdvancedProductReviews/module.css');

		$this->document->setTitle($this->language->get('heading_title_reason'));
		$data['heading_title'] = $this->language->get('heading_title_reason');

		$this->load->model('catalog/product_review');

		if (isset($this->request->get['filter_store_id'])) {
			$filter_store_id = $this->request->get['filter_store_id'];
		} else {
			$filter_store_id = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'rd.name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_store_id'])) {
			$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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

		$data['add'] = $this->url->link('product_review/report/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('product_review/report/deleteReason', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['reasons'] = array();

		$filter_data = array(
			'filter_store_id' => $filter_store_id,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);

		$reason_total = $this->model_catalog_product_review->getTotalReasons($filter_data);

		$results = array();

		if ($reason_total) {
			$results = $this->model_catalog_product_review->getReasons($filter_data);
		}

		foreach ($results as $result) {
			$data['reasons'][] = array(
				'reason_id' => $result['reason_id'],
				'name'      => $result['name'],
				'stores'    => $this->model_catalog_product_review->getReasonStores($result['reason_id']),
				'status'    => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'  => isset($this->request->post['selected']) && in_array($result['reason_id'], $this->request->post['selected']),
				'edit'      => $this->url->link('product_review/report/edit', 'token=' . $this->session->data['token'] . '&reason_id=' . $result['reason_id'] . $url, 'SSL')
			);
    	}

		$data['stores'] = array();
		$data['stores'][] = array('store_id' => '0', 'name' => $this->language->get('text_default'));

		$this->load->model('setting/store');

		$stores = $this->model_setting_store->getStores();

		foreach ($stores as $store) {
			$data['stores'][$store['store_id']] = array(
				'store_id' => $store['store_id'],
				'name'     => $store['name']
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

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_store_id'])) {
			$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('product_review/report/reason', 'token=' . $this->session->data['token'] . '&sort=rd.name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('product_review/report/reason', 'token=' . $this->session->data['token'] . '&sort=r.status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_store_id'])) {
			$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination_limit = ($this->config->get('config_admin_limit')) ? $this->config->get('config_admin_limit') : (($this->config->get('config_limit_admin')) ? $this->config->get('config_limit_admin') : 20);

		$pagination = new Pagination();
		$pagination->total = $reason_total;
		$pagination->page = $page;
		$pagination->limit = $pagination_limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product_review/report/reason', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = (version_compare(VERSION, '2.0') < 0) ? '' : sprintf($this->language->get('text_pagination'), ($reason_total) ? (($page - 1) * $pagination_limit) + 1 : 0, ((($page - 1) * $pagination_limit) > ($reason_total - $pagination_limit)) ? $reason_total : ((($page - 1) * $pagination_limit) + $pagination_limit), $reason_total, ceil($reason_total / $pagination_limit));

		$data['filter_store_id'] = $filter_store_id;
		$data['filter_status'] = $filter_status;

		$data['sort'] = $sort;
		$data['order'] = $order;

		if (version_compare(VERSION, '2.0') < 0) {
			$data['column_left'] = '';
			$this->data = $data;

			$this->template = 'product_review/reason_list.tpl';

			$this->children = array(
				'common/header',
				'common/footer',
			);

			$this->response->setOutput($this->render());
		} else {
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('product_review/reason_list.tpl', $data));
		}
	}

  	protected function getForm() {
    	$data = array_merge(array(), $this->language->load('product_review/report'));

		if (version_compare(VERSION, '2.0') < 0) {
			$this->document->addStyle('view/javascript/AdvancedProductReviews/font-awesome/css/font-awesome.min.css');
			$this->document->addScript('view/javascript/AdvancedProductReviews/bootstrap/js/bootstrap.min.js');
			$this->document->addScript('view/javascript/AdvancedProductReviews/compatibility.js');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/bootstrap/css/bootstrap.css');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/compatibility.css');
		}

		$this->document->addStyle('view/javascript/AdvancedProductReviews/module.css');

		$data['heading_title'] = $this->language->get('heading_title_reason');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_store_id'])) {
			$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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

		if (!isset($this->request->get['reason_id'])) {
			$data['action'] = $this->url->link('product_review/report/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('product_review/report/edit', 'token=' . $this->session->data['token'] . '&reason_id=' . $this->request->get['reason_id'] . $url, 'SSL');
		}

		$data['text_form'] = !isset($this->request->get['reason_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['cancel'] = $this->url->link('product_review/report/reason', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['reason_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$reason_info = $this->model_catalog_product_review->getReason($this->request->get['reason_id']);
    	}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (isset($this->request->get['reason_id'])) {
			$data['name'] = $this->model_catalog_product_review->getReasonDescriptions($this->request->get['reason_id']);
		} else {
			$data['name'] = array();
		}

		$data['stores'] = array();
		$data['stores'][] = array('store_id' => '0', 'name' => $this->language->get('text_default'));

		$this->load->model('setting/store');

		$stores = $this->model_setting_store->getStores();

		foreach ($stores as $store) {
			$data['stores'][$store['store_id']] = array(
				'store_id' => $store['store_id'],
				'name'     => $store['name']
			);
		}

		if (isset($this->request->post['reason_store'])) {
			$data['reason_store'] = $this->request->post['reason_store'];
		} elseif (isset($this->request->get['reason_id'])) {
			$data['reason_store'] = $this->model_catalog_product_review->getReasonStores($this->request->get['reason_id']);
		} else {
			$data['reason_store'] = array(0);
		}

		if (isset($this->request->post['status'])) {
      		$data['status'] = $this->request->post['status'];
    	} elseif (!empty($reason_info)) {
			$data['status'] = $reason_info['status'];
		} else {
      		$data['status'] = 1;
    	}

		if (version_compare(VERSION, '2.0') < 0) {
			$data['column_left'] = '';
			$this->data = $data;

			$this->template = 'product_review/reason_form.tpl';

			$this->children = array(
				'common/header',
				'common/footer',
			);

			$this->response->setOutput($this->render());
		} else {
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('product_review/reason_form.tpl', $data));
		}
  	}

  	protected function validateForm() {
    	if (!$this->user->hasPermission('modify', 'product_review/report')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	foreach ($this->request->post['name'] as $language_id => $value) {
      		if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 64)) {
        		$this->error['name'][$language_id] = $this->language->get('error_name');
      		}
    	}

    	if (!$this->error) {
			return true;
    	} else {
      		return false;
    	}
  	}

	protected function validateReasonForm() {
    	if (!$this->user->hasPermission('modify', 'product_review/report')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	foreach ($this->request->post['name'] as $language_id => $value) {
      		if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
        		$this->error['name'][$language_id] = $this->language->get('error_name');
      		}
    	}

    	if (!$this->error) {
			return true;
    	} else {
      		return false;
    	}
  	}

  	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'product_review/report')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/product_review');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			$data = array(
				'filter_name' => $filter_name,
				'start'       => 0,
				'limit'       => 20
			);

			$results = $this->model_catalog_product_review->getRatings($data);

			foreach ($results as $result) {
				$json[] = array(
					'rating_id' => $result['rating_id'],
					'name'      => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
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