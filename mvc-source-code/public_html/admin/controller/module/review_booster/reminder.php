<?php
/*
  Review Booster
  Premium Extension
  
  Copyright (c) 2013 - 2019 Adikon.eu
  http://www.adikon.eu/
  
  You may not copy or reuse code within this file without written permission.
*/
class ControllerModuleReviewBoosterReminder extends Controller {
	private $module_type = '';
	private $module_name = '';
	private $module_path = '';
	private $module_model = '';

	private $compatibility = null;

	private $language_data = array();
	private $error = array();
	private $token = '';

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->config('review_booster');

		$this->module_type = $this->config->get('rb_module_type');
		$this->module_name = $this->config->get('rb_module_name');
		$this->module_path = $this->config->get('rb_module_path');

		$this->load->model($this->module_path);

		$this->module_model = $this->{$this->config->get('rb_module_model')};

		$this->compatibility = $this->module_model->compatibility();

		$this->language_data = $this->language->load($this->module_path . '/reminder');

		$token_name = $this->compatibility->getAdminTokenName();
		$this->token = $token_name . '=' . $this->compatibility->getSessionValue($token_name);
	}

	public function index() {
		$this->document->setTitle($this->language->get('heading_title'));

		$this->getList();
	}

	public function delete() {
		$this->document->setTitle($this->language->get('heading_title'));

		if ($this->validateDelete()) {
			if (isset($this->request->post['selected'])) {
				foreach ($this->request->post['selected'] as $email_id) {
					$this->module_model->deleteReminder($email_id);
				}

				$this->session->data['success'] = $this->language->get('text_success');
			}

			$url = $this->compatibility->getParams($this->request->get, array('filter_email', 'filter_order_id', 'filter_coupon', 'filter_store_id', 'filter_date_review', 'filter_date_added'));

			$this->compatibility->redirect($this->compatibility->link($this->module_path . '/reminder', $this->token . $url));
		}

		$this->getList();
	}

	protected function getList() {
		$this->compatibility->loadStyles(str_replace($this->module_type . '_', '', $this->module_name));

		$data = array_merge(array(), $this->language_data);

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
		} else {
			$filter_email = '';
		}

		if (isset($this->request->get['filter_order_id'])) {
			$filter_order_id = (int)$this->request->get['filter_order_id'];
		} else {
			$filter_order_id = '';
		}

		if (isset($this->request->get['filter_coupon'])) {
			$filter_coupon = $this->request->get['filter_coupon'];
		} else {
			$filter_coupon = '';
		}

		if (isset($this->request->get['filter_store_id'])) {
			$filter_store_id = (int)$this->request->get['filter_store_id'];
		} else {
			$filter_store_id = '';
		}

		if (isset($this->request->get['filter_date_review'])) {
			$filter_date_review = $this->request->get['filter_date_review'];
		} else {
			$filter_date_review = '';
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = '';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = $this->compatibility->getParams($this->request->get, array('filter_email', 'filter_order_id', 'filter_coupon', 'filter_store_id', 'filter_date_review', 'filter_date_added', 'page'));

		$data['delete'] = $this->compatibility->link($this->module_path . '/reminder/delete', $this->token . $url);

		$stores = $this->compatibility->getStores();

		$limit = $this->compatibility->paginationLimit(20);

		$data['reminders'] = array();

		$filter_data = array(
			'filter_email'       => $filter_email,
			'filter_order_id'    => $filter_order_id,
			'filter_coupon'      => $filter_coupon,
			'filter_store_id'    => $filter_store_id,
			'filter_date_review' => $filter_date_review,
			'filter_date_added'  => $filter_date_added,
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);

		$reminder_total = $this->module_model->getTotalReminders($filter_data);

		$results = $this->module_model->getReminders($filter_data);

		foreach ($results as $result) {
			if ($result['product_id']) {
				$products = $this->module_model->getOrderProducts($result['order_id'], $result['product_id']);
			} else {
				$products = $this->module_model->getOrderProducts($result['order_id']);
			}

			if ($result['date_review'] != '0000-00-00 00:00:00') {
				$gdpr = $result['gdpr'] ? $this->language->get('text_yes') : $this->language->get('text_no');
				$review = sprintf($this->language->get('text_review'), ($result['review_id'] ? $result['review_id'] : '-'), date($this->language->get('date_format_short'), strtotime($result['date_review'])), ($result['noticed'] ? $result['noticed'] : $this->language->get('text_not_provided')));
			} else {
				$gdpr = $this->language->get('text_not_provided');
				$review = $this->language->get('text_no_review');
			}

			if (isset($stores[$result['store_id']])) {
				$store = $stores[$result['store_id']]['url'];

				$view = $store . (substr($store, -1) == '/' ? '' : '/') . 'index.php?route=' . $this->module_path . '&hash=' . $result['hash']. '&code=' . $result['code'];
			} else {
				$view = HTTP_CATALOG . 'index.php?route=' . $this->module_path . '&hash=' . $result['hash']. '&code=' . $result['code'];
			}

			$data['reminders'][] = array(
				'email_id'    => $result['email_id'],
				'customer'    => $result['customer'] ? $result['customer'] : $result['email'],
				'test'        => $result['test'],
				'order_id'    => $result['order_id'],
				'product'     => $products,
				'coupon'      => $result['coupon'],
				'gdpr'        => $gdpr,
				'review'      => $review,
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'view'        => $view
			);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} elseif (isset($this->session->data['warning'])) {
			$data['error_warning'] = $this->session->data['warning'];

			unset($this->session->data['warning']);
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

		$url = $this->compatibility->getParams($this->request->get, array('filter_email', 'filter_order_id', 'filter_coupon', 'filter_store_id', 'filter_date_review', 'filter_date_added'));

		$data['pagination'] = $this->compatibility->pagination(
			$reminder_total,
			$page,
			$limit,
			$this->compatibility->link($this->module_path . '/reminder', $this->token . $url . '&page={page}')
		);

		$data['results'] = $this->compatibility->paginationText($page, $limit, $reminder_total);

		$data['filter_email'] = $filter_email;
		$data['filter_order_id'] = $filter_order_id;
		$data['filter_coupon'] = $filter_coupon;
		$data['filter_store_id'] = $filter_store_id;
		$data['filter_date_review'] = $filter_date_review;
		$data['filter_date_added'] = $filter_date_added;

		$data['stores'] = $stores;

		$data['links'] = $this->getManageLinks();

		$data['module_path'] = $this->module_path;

		$data['token'] = $this->token;

		foreach ($this->compatibility->getChildren() as $key => $child) {
			$data[$key] = ($key == 'header') ? $this->compatibility->jquery($child) : $child;
		}

		$this->response->setOutput($this->compatibility->view($this->module_path . '/reminder_list', $data));
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', $this->module_path)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return (!$this->error) ? true : false;
	}

	private function getManageLinks() {
		$links = array();

		foreach ((array)$this->config->get('rb_menu') as $menu) {
			$links[] = array(
				'name' => $menu['name'],
				'href' => $menu['action'] ? $this->compatibility->link($menu['action'], $this->token) : ''
			);
		}

		return $links;
	}
}
?>