<?php
class ControllerProductReviewAttribute extends Controller {
	private $error = array();

  	public function index() {
		$this->language->load('product_review/attribute');

		$this->document->setTitle($this->language->get('heading_title')); 

		$this->load->model('catalog/product_review');

		$this->getList();
  	}

	public function add() {
		$this->language->load('product_review/attribute');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_review');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product_review->addAttribute($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_review_id'])) {
				$url .= '&filter_review_id=' . $this->request->get['filter_review_id'];
			}

			if (isset($this->request->get['filter_type'])) {
				$url .= '&filter_type=' . $this->request->get['filter_type'];
			}

			if (isset($this->request->get['filter_author'])) {
				$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_added_by'])) {
				$url .= '&filter_added_by=' . urlencode(html_entity_decode($this->request->get['filter_added_by'], ENT_QUOTES, 'UTF-8'));
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

			$this->redirectTo('product_review/attribute', $url);
		}

		$this->getForm();
	}

	public function edit() {
    	$this->language->load('product_review/attribute');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_review');

    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product_review->editAttribute($this->request->get['attribute_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_review_id'])) {
				$url .= '&filter_review_id=' . $this->request->get['filter_review_id'];
			}

			if (isset($this->request->get['filter_type'])) {
				$url .= '&filter_type=' . $this->request->get['filter_type'];
			}

			if (isset($this->request->get['filter_author'])) {
				$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_added_by'])) {
				$url .= '&filter_added_by=' . urlencode(html_entity_decode($this->request->get['filter_added_by'], ENT_QUOTES, 'UTF-8'));
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

			$this->redirectTo('product_review/attribute', $url);
		}

    	$this->getForm();
  	}

  	public function delete() {
    	$this->language->load('product_review/attribute');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_review');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $attribute_id) {
				$this->model_catalog_product_review->deleteAttribute($attribute_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_review_id'])) {
				$url .= '&filter_review_id=' . $this->request->get['filter_review_id'];
			}

			if (isset($this->request->get['filter_type'])) {
				$url .= '&filter_type=' . $this->request->get['filter_type'];
			}

			if (isset($this->request->get['filter_author'])) {
				$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_added_by'])) {
				$url .= '&filter_added_by=' . urlencode(html_entity_decode($this->request->get['filter_added_by'], ENT_QUOTES, 'UTF-8'));
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

			$this->redirectTo('product_review/attribute', $url);
		}

    	$this->getList();
  	}
	
  	protected function getList() {
		$data = array_merge(array(), $this->language->load('product_review/attribute'));

		if (version_compare(VERSION, '2.0') < 0) {
			$this->document->addStyle('view/javascript/AdvancedProductReviews/font-awesome/css/font-awesome.min.css');
			$this->document->addScript('view/javascript/AdvancedProductReviews/bootstrap/js/bootstrap.min.js');
			$this->document->addScript('view/javascript/AdvancedProductReviews/compatibility.js');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/bootstrap/css/bootstrap.css');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/compatibility.css');
		}

		$this->document->addStyle('view/javascript/AdvancedProductReviews/module.css');

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_review_id'])) {
			$filter_review_id = $this->request->get['filter_review_id'];
		} else {
			$filter_review_id = null;
		}

		if (isset($this->request->get['filter_type'])) {
			$filter_type = $this->request->get['filter_type'];
		} else {
			$filter_type = null;
		}

		if (isset($this->request->get['filter_author'])) {
			$filter_author = $this->request->get['filter_author'];
		} else {
			$filter_author = null;
		}

		if (isset($this->request->get['filter_added_by'])) {
			$filter_added_by = $this->request->get['filter_added_by'];
		} else {
			$filter_added_by = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'a.added_by';
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

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_review_id'])) {
			$url .= '&filter_review_id=' . $this->request->get['filter_review_id'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_added_by'])) {
			$url .= '&filter_added_by=' . urlencode(html_entity_decode($this->request->get['filter_added_by'], ENT_QUOTES, 'UTF-8'));
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

		$data['add'] = $this->url->link('product_review/attribute/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('product_review/attribute/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['attributes'] = array();

		$filter_data = array(
			'filter_name'	   => $filter_name,
			'filter_review_id' => $filter_review_id,
			'filter_type'      => $filter_type,
			'filter_author'    => $filter_author,
			'filter_added_by'  => $filter_added_by,
			'filter_status'    => $filter_status,
			'sort'             => $sort,
			'order'            => $order,
			'start'            => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'            => $this->config->get('config_admin_limit')
		);

		$attribute_total = $this->model_catalog_product_review->getTotalAttributes($filter_data);

		$results = array();

		if ($attribute_total) {
			$results = $this->model_catalog_product_review->getAttributes($filter_data);
		}

		foreach ($results as $result) {
			$data['attributes'][] = array(
				'attribute_id' => $result['attribute_id'],
				'review_id'    => ($result['review_id']) ? $result['review_id'] : '',
				'review_href'  => $this->url->link('product_review/review/edit', 'token=' . $this->session->data['token'] . '&review_id=' . $result['review_id'], 'SSL'),
				'name'         => $result['name'],
				'type'         => ($result['type'] ? $this->language->get('text_pros') : $this->language->get('text_cons')),
				'image'        => $result['type'],
				'author'       => $result['author'],
				'status'       => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'     => isset($this->request->post['selected']) && in_array($result['attribute_id'], $this->request->post['selected']),
				'edit'         => $this->url->link('product_review/attribute/edit', 'token=' . $this->session->data['token'] . '&attribute_id=' . $result['attribute_id'] . $url, 'SSL')
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

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_review_id'])) {
			$url .= '&filter_review_id=' . $this->request->get['filter_review_id'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_added_by'])) {
			$url .= '&filter_added_by=' . urlencode(html_entity_decode($this->request->get['filter_added_by'], ENT_QUOTES, 'UTF-8'));
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

		$data['sort_name'] = $this->url->link('product_review/attribute', 'token=' . $this->session->data['token'] . '&sort=a.name' . $url, 'SSL');
		$data['sort_review'] = $this->url->link('product_review/attribute', 'token=' . $this->session->data['token'] . '&sort=r.review_id' . $url, 'SSL');
		$data['sort_type'] = $this->url->link('product_review/attribute', 'token=' . $this->session->data['token'] . '&sort=a.type' . $url, 'SSL');
		$data['sort_author'] = $this->url->link('product_review/attribute', 'token=' . $this->session->data['token'] . '&sort=r.author' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('product_review/attribute', 'token=' . $this->session->data['token'] . '&sort=a.status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_review_id'])) {
			$url .= '&filter_review_id=' . $this->request->get['filter_review_id'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_added_by'])) {
			$url .= '&filter_added_by=' . urlencode(html_entity_decode($this->request->get['filter_added_by'], ENT_QUOTES, 'UTF-8'));
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
		$pagination->total = $attribute_total;
		$pagination->page = $page;
		$pagination->limit = $pagination_limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product_review/attribute', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = (version_compare(VERSION, '2.0') < 0) ? '' : sprintf($this->language->get('text_pagination'), ($attribute_total) ? (($page - 1) * $pagination_limit) + 1 : 0, ((($page - 1) * $pagination_limit) > ($attribute_total - $pagination_limit)) ? $attribute_total : ((($page - 1) * $pagination_limit) + $pagination_limit), $attribute_total, ceil($attribute_total / $pagination_limit));

		$data['filter_name'] = $filter_name;
		$data['filter_type'] = $filter_type;
		$data['filter_review_id'] = $filter_review_id;
		$data['filter_author'] = $filter_author;
		$data['filter_added_by'] = $filter_added_by;
		$data['filter_status'] = $filter_status;

		$data['sort'] = $sort;
		$data['order'] = $order;

		if (version_compare(VERSION, '2.0') < 0) {
			$data['column_left'] = '';
			$this->data = $data;

			$this->template = 'product_review/attribute_list.tpl';

			$this->children = array(
				'common/header',
				'common/footer',
			);

			$this->response->setOutput($this->render());
		} else {
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('product_review/attribute_list.tpl', $data));
		}
  	}

  	protected function getForm() {
    	$data = array_merge(array(), $this->language->load('product_review/attribute'));

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
			$data['error_name'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_review_id'])) {
			$url .= '&filter_review_id=' . $this->request->get['filter_review_id'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_added_by'])) {
			$url .= '&filter_added_by=' . urlencode(html_entity_decode($this->request->get['filter_added_by'], ENT_QUOTES, 'UTF-8'));
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

		if (!isset($this->request->get['attribute_id'])) {
			$data['action'] = $this->url->link('product_review/attribute/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('product_review/attribute/edit', 'token=' . $this->session->data['token'] . '&attribute_id=' . $this->request->get['attribute_id'] . $url, 'SSL');
		}

		$data['text_form'] = $this->language->get('text_edit');

		$data['cancel'] = $this->url->link('product_review/attribute', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['attribute_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$attribute_info = $this->model_catalog_product_review->getAttribute($this->request->get['attribute_id']);
    	}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($attribute_info)) {
			$data['name'] = $attribute_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['type'])) {
      		$data['type'] = $this->request->post['type'];
    	} elseif (!empty($attribute_info)) {
			$data['type'] = $attribute_info['type'];
		} else {
      		$data['type'] = 1;
    	}

		if (isset($this->request->post['added_by'])) {
      		$data['added_by'] = $this->request->post['added_by'];
    	} elseif (!empty($attribute_info)) {
			$data['added_by'] = $attribute_info['added_by'];
		} else {
      		$data['added_by'] = '';
    	}

		if (isset($this->request->post['status'])) {
      		$data['status'] = $this->request->post['status'];
    	} elseif (!empty($attribute_info)) {
			$data['status'] = $attribute_info['status'];
		} else {
      		$data['status'] = 1;
    	}

		if (version_compare(VERSION, '2.0') < 0) {
			$data['column_left'] = '';
			$this->data = $data;

			$this->template = 'product_review/attribute_form.tpl';

			$this->children = array(
				'common/header',
				'common/footer',
			);

			$this->response->setOutput($this->render());
		} else {
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('product_review/attribute_form.tpl', $data));
		}
  	}

  	protected function validateForm() {
    	if (!$this->user->hasPermission('modify', 'product_review/attribute')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 255)) {
        	$this->error['name'] = $this->language->get('error_name');
    	}

    	if (!$this->error) {
			return true;
    	} else {
      		return false;
    	}
  	}

  	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'product_review/attribute')) {
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
				'filter_name'   => $filter_name,
				'start'         => 0,
				'limit'         => 20
			);

			$results = $this->model_catalog_product_review->getAttributes($data);

			foreach ($results as $result) {
				$json[] = array(
					'attribute_id' => $result['attribute_id'],
					'name'         => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function autocompleteauthor() {
		$json = array();

		if (isset($this->request->get['filter_author'])) {
			$this->load->model('catalog/product_review');

			if (isset($this->request->get['filter_author'])) {
				$filter_author = $this->request->get['filter_author'];
			} else {
				$filter_author = '';
			}

			$data = array(
				'filter_author' => $filter_author
			);

			$results = $this->model_catalog_product_review->getAuthors($data);

			foreach ($results as $result) {
				$json[] = array(
					'attribute_id' => 1,
					'author'       => strip_tags(html_entity_decode($result['author'], ENT_QUOTES, 'UTF-8'))
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