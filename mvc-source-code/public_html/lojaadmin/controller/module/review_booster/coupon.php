<?php
/*
  Review Booster
  Premium Extension
  
  Copyright (c) 2013 - 2019 Adikon.eu
  http://www.adikon.eu/
  
  You may not copy or reuse code within this file without written permission.
*/
class ControllerModuleReviewBoosterCoupon extends Controller {
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

		$this->language_data = $this->language->load($this->module_path . '/coupon');

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
				foreach ($this->request->post['selected'] as $coupon_id) {
					$this->module_model->deleteCoupon($coupon_id);
				}

				$this->session->data['success'] = $this->language->get('text_success');
			}

			$url = $this->compatibility->getParams($this->request->get, array('filter_name', 'filter_code', 'filter_used', 'filter_store_id', 'filter_status', 'filter_date_added'));

			$this->compatibility->redirect($this->compatibility->link($this->module_path . '/coupon', $this->token . $url));
		}

		$this->getList();
	}

	protected function getList() {
		$this->compatibility->loadStyles(str_replace($this->module_type . '_', '', $this->module_name));

		$data = array_merge(array(), $this->language_data);

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = '';
		}

		if (isset($this->request->get['filter_code'])) {
			$filter_code = $this->request->get['filter_code'];
		} else {
			$filter_code = '';
		}

		if (isset($this->request->get['filter_used'])) {
			$filter_used = (int)$this->request->get['filter_used'];
		} else {
			$filter_used = '';
		}

		if (isset($this->request->get['filter_store_id'])) {
			$filter_store_id = (int)$this->request->get['filter_store_id'];
		} else {
			$filter_store_id = '';
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = (int)$this->request->get['filter_status'];
		} else {
			$filter_status = '';
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

		$url = $this->compatibility->getParams($this->request->get, array('filter_name', 'filter_code', 'filter_used', 'filter_store_id', 'filter_status', 'filter_date_added', 'page'));

		$data['expire'] = $this->compatibility->link($this->module_path . '/coupon/expire', $this->token . $url);
		$data['delete'] = $this->compatibility->link($this->module_path . '/coupon/delete', $this->token . $url);

		$limit = $this->compatibility->paginationLimit(20);

		$data['coupons'] = array();

		$filter_data = array(
			'filter_name'       => $filter_name,
			'filter_code'       => $filter_code,
			'filter_used'       => $filter_used,
			'filter_store_id'   => $filter_store_id,
			'filter_status'     => $filter_status,
			'filter_date_added' => $filter_date_added,
			'start'             => ($page - 1) * $limit,
			'limit'             => $limit
		);

		$coupon_total = $this->module_model->getTotalCoupons($filter_data);

		$results = $this->module_model->getCoupons($filter_data);

		foreach ($results as $result) {
			if ($result['date_used']) {
				$used = sprintf($this->language->get('text_coupon'), $result['coupon_order_id'], date($this->language->get('date_format_short'), strtotime($result['date_used'])));
			} else {
				$used = $this->language->get('text_no');
			}

			$data['coupons'][] = array(
				'coupon_id'  => $result['coupon_id'],
				'name'       => $result['name'],
				'code'       => $result['code'],
				'discount'   => number_format($result['discount']) . ($result['type'] == 'P' ? '%' : ''),
				'date_start' => date($this->language->get('date_format_short'), strtotime($result['date_start'])),
				'date_end'   => date($this->language->get('date_format_short'), strtotime($result['date_end'])),
				'used'       => $used,
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'status'     => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')
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

		$url = $this->compatibility->getParams($this->request->get, array('filter_name', 'filter_code', 'filter_used', 'filter_store_id', 'filter_status', 'filter_date_added'));

		$data['pagination'] = $this->compatibility->pagination(
			$coupon_total,
			$page,
			$limit,
			$this->compatibility->link($this->module_path . '/coupon', $this->token . $url . '&page={page}')
		);

		$data['results'] = $this->compatibility->paginationText($page, $limit, $coupon_total);

		$data['filter_name'] = $filter_name;
		$data['filter_code'] = $filter_code;
		$data['filter_used'] = $filter_used;
		$data['filter_store_id'] = $filter_store_id;
		$data['filter_status'] = $filter_status;
		$data['filter_date_added'] = $filter_date_added;

		$data['stores'] = $this->compatibility->getStores();

		$data['links'] = $this->getManageLinks();

		$data['module_path'] = $this->module_path;

		$data['token'] = $this->token;

		foreach ($this->compatibility->getChildren() as $key => $child) {
			$data[$key] = ($key == 'header') ? $this->compatibility->jquery($child) : $child;
		}

		$this->response->setOutput($this->compatibility->view($this->module_path . '/coupon_list', $data));
	}

	public function expire() {
		if ($this->validateDelete()) {
			$this->module_model->deleteExpiredCoupons();

			$this->session->data['success'] = $this->language->get('text_coupon_removed');
		}

		$url = $this->compatibility->getParams($this->request->get, array('filter_name', 'filter_code', 'filter_used', 'filter_store_id', 'filter_status', 'filter_date_added'));

		$this->compatibility->redirect($this->compatibility->link($this->module_path . '/coupon', $this->token . $url));
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