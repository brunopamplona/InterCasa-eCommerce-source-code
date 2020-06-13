<?php
class ControllerProductReviewRating extends Controller {
	private $error = array();

  	public function index() {
		$this->language->load('product_review/rating');

		$this->document->setTitle($this->language->get('heading_title')); 

		$this->load->model('catalog/product_review');

		$this->getList();
  	}

  	public function add() {
    	$this->language->load('product_review/rating');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_review');

    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product_review->addRating($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_store_id'])) {
				$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
			}

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
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

			$this->redirectTo('product_review/rating', $url);
    	}

    	$this->getForm();
  	}

  	public function edit() {
    	$this->language->load('product_review/rating');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_review');

    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product_review->editRating($this->request->get['rating_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_store_id'])) {
				$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
			}

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
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

			$this->redirectTo('product_review/rating', $url);
		}

    	$this->getForm();
  	}

  	public function delete() {
    	$this->language->load('product_review/rating');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_review');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $rating_id) {
				$this->model_catalog_product_review->deleteRating($rating_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_store_id'])) {
				$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
			}

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
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

			$this->redirectTo('product_review/rating', $url);
		}

    	$this->getList();
  	}
	
  	protected function getList() {				
		$data = array_merge(array(), $this->language->load('product_review/rating'));

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

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
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

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
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

		$data['add'] = $this->url->link('product_review/rating/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('product_review/rating/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['ratings'] = array();

		$filter_data = array(
			'filter_store_id'	        => $filter_store_id,
			'filter_name'	            => $filter_name,
			'filter_status'             => $filter_status,
			'sort'                      => $sort,
			'order'                     => $order,
			'start'                     => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                     => $this->config->get('config_admin_limit')
		);

		$rating_total = $this->model_catalog_product_review->getTotalRatings($filter_data);

		$results = array();

		if ($rating_total) {
			$results = $this->model_catalog_product_review->getRatings($filter_data);
		}

		foreach ($results as $result) {
			$stores = explode('#', $result['stores']);

			$data['ratings'][] = array(
				'rating_id'  => $result['rating_id'],
				'name'       => $result['name'],
				'stores'     => $stores,
				'sort_order' => $result['sort_order'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'   => isset($this->request->post['selected']) && in_array($result['rating_id'], $this->request->post['selected']),
				'edit'       => $this->url->link('product_review/rating/edit', 'token=' . $this->session->data['token'] . '&rating_id=' . $result['rating_id'] . $url, 'SSL')
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

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
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

		$data['sort_name'] = $this->url->link('product_review/rating', 'token=' . $this->session->data['token'] . '&sort=rd.name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('product_review/rating', 'token=' . $this->session->data['token'] . '&sort=r.sort_order' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('product_review/rating', 'token=' . $this->session->data['token'] . '&sort=r.status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_store_id'])) {
			$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
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
		$pagination->total = $rating_total;
		$pagination->page = $page;
		$pagination->limit = $pagination_limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product_review/rating', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = (version_compare(VERSION, '2.0') < 0) ? '' : sprintf($this->language->get('text_pagination'), ($rating_total) ? (($page - 1) * $pagination_limit) + 1 : 0, ((($page - 1) * $pagination_limit) > ($rating_total - $pagination_limit)) ? $rating_total : ((($page - 1) * $pagination_limit) + $pagination_limit), $rating_total, ceil($rating_total / $pagination_limit));

		$data['filter_store_id'] = $filter_store_id;
		$data['filter_name'] = $filter_name;
		$data['filter_status'] = $filter_status;

		$data['sort'] = $sort;
		$data['order'] = $order;

		if (version_compare(VERSION, '2.0') < 0) {
			$data['column_left'] = '';
			$this->data = $data;

			$this->template = 'product_review/rating_list.tpl';

			$this->children = array(
				'common/header',
				'common/footer',
			);

			$this->response->setOutput($this->render());
		} else {
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('product_review/rating_list.tpl', $data));
		}
  	}

  	protected function getForm() {
    	$data = array_merge(array(), $this->language->load('product_review/rating'));

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

 		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_store_id'])) {
			$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
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

		if (!isset($this->request->get['rating_id'])) {
			$data['action'] = $this->url->link('product_review/rating/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('product_review/rating/edit', 'token=' . $this->session->data['token'] . '&rating_id=' . $this->request->get['rating_id'] . $url, 'SSL');
		}

		$data['text_form'] = !isset($this->request->get['rating_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['cancel'] = $this->url->link('product_review/rating', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['rating_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$rating_info = $this->model_catalog_product_review->getRating($this->request->get['rating_id']);
    	}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (isset($this->request->get['rating_id'])) {
			$data['name'] = $this->model_catalog_product_review->getRatingDescriptions($this->request->get['rating_id']);
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

		if (isset($this->request->post['rating_store'])) {
			$data['rating_store'] = $this->request->post['rating_store'];
		} elseif (isset($this->request->get['rating_id'])) {
			$data['rating_store'] = $this->model_catalog_product_review->getRatingStores($this->request->get['rating_id']);
		} else {
			$data['rating_store'] = array(0);
		}

		if (isset($this->request->post['sort_order'])) {
      		$data['sort_order'] = $this->request->post['sort_order'];
    	} elseif (!empty($rating_info)) {
      		$data['sort_order'] = $rating_info['sort_order'];
    	} else {
			$data['sort_order'] = 1;
		}

		if (isset($this->request->post['status'])) {
      		$data['status'] = $this->request->post['status'];
    	} elseif (!empty($rating_info)) {
			$data['status'] = $rating_info['status'];
		} else {
      		$data['status'] = 1;
    	}

		if (version_compare(VERSION, '2.0') < 0) {
			$data['column_left'] = '';
			$this->data = $data;

			$this->template = 'product_review/rating_form.tpl';

			$this->children = array(
				'common/header',
				'common/footer',
			);

			$this->response->setOutput($this->render());
		} else {
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('product_review/rating_form.tpl', $data));
		}
  	}

  	protected function validateForm() {
    	if (!$this->user->hasPermission('modify', 'product_review/rating')) {
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

  	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'product_review/rating')) {
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