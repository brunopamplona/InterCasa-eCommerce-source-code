<?php
//OpenCart Extension
//Project Name: OpenCart Combo/Bundle
//Author: Fanha Giang a.k.a fanha99
//Email (PayPal Account): fanha99@gmail.com
//License: Commercial
?>
<?php
class ControllerCatalogCombo extends Controller {
	private $error = array(); 
	 
  	public function index() {
		$this->language->load('catalog/combo');
		
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('catalog/combo');
		
		$this->getList();
  	}
  
  	public function insert() {
		$this->language->load('catalog/combo');

		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('catalog/combo');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_combo->addCombo($this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
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
			
			$this->redirect($this->url->link('catalog/combo', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getForm();
  	}

  	public function update() {
		$this->language->load('catalog/combo');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/combo');
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_combo->editcombo($this->request->get['combo_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		
			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
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
			
			$this->redirect($this->url->link('catalog/combo', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
  	}

  	public function delete() {
		$this->language->load('catalog/combo');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/combo');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $combo_id) {
				$this->model_catalog_combo->deletecombo($combo_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		
			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
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
			
			$this->redirect($this->url->link('catalog/combo', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
  	}

  	public function copy() {
		$this->language->load('catalog/combo');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/combo');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $combo_id) {
				$this->model_catalog_combo->copycombo($combo_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		  
			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
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
			
			$this->redirect($this->url->link('catalog/combo', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
  	}
	
  	private function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_product'])) {
			$filter_product = $this->request->get['filter_product'];
		} else {
			$filter_product = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
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
			
		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
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

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
	   		'text'	  => $this->language->get('text_home'),
			'href'	  => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
	  		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
	   		'text'	  => $this->language->get('heading_title'),
			'href'	  => $this->url->link('catalog/combo', 'token=' . $this->session->data['token'] . $url, 'SSL'),	   		
	  		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('catalog/combo/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('catalog/combo/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('catalog/combo/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$this->data['combos'] = array();

		$data = array(
			'filter_name'	  => $filter_name, 
			'filter_product'   => $filter_product,
			'sort'			=> $sort,
			'order'		   => $order,
			'start'		   => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'		   => $this->config->get('config_admin_limit')
		);
		
		$this->load->model('tool/image');
		
		$combo_total = $this->model_catalog_combo->getTotalCombo($data);
			
		$results = $this->model_catalog_combo->getCombos($data);
						
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/combo/update', 'token=' . $this->session->data['token'] . '&combo_id=' . $result['combo_id'] . $url, 'SSL'),
				'text_view' => $this->language->get('text_view'),
				'href_view' => HTTP_CATALOG . 'index.php?route=product/combo&combo_id=' . $result['combo_id'],
			);
			
			$products = $this->model_catalog_combo->getComboProducts($result['combo_id']);
			$productsID = $this->model_catalog_combo->getComboProductsID($products);
			$products_info = $this->model_catalog_combo->getProductsInfo($productsID);			
			
			foreach ($products as &$product) {
				$product = array_merge($product, $products_info[$product['product_id']]);
				if ($product['image'] && file_exists(DIR_IMAGE . $product['image'])) {
					$product['image'] = $this->model_tool_image->resize($product['image'], 40, 40);
				} else {
					$product['image'] = $this->model_tool_image->resize('no_image.jpg', 40, 40);
				}			
			}
	
	  		$this->data['combos'][] = array(
				'combo_id' => $result['combo_id'],
				'name'	   => $result['name'],
				'status'	 => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
				'action'	 => $action,
				'products'	 => $products,
			);
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		$this->data['text_enabled'] = $this->language->get('text_enabled');		
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');		
			
		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_product_list'] = $this->language->get('column_product_list');		
		$this->data['column_discount'] = $this->language->get('column_discount');		
		$this->data['column_status'] = $this->language->get('column_status');		
		$this->data['column_action'] = $this->language->get('column_action');		
				
		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
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
					
		$this->data['sort_name'] = $this->url->link('catalog/combo', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/combo', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/combo', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
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
				
		$pagination = new Pagination();
		$pagination->total = $combo_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/combo', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_name'] = $filter_name;
		$this->data['filter_product'] = $filter_product;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/combo_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}

  	private function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');
 
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_select_all'] = $this->language->get('text_select_all');
		$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');

		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_discount'] = $this->language->get('entry_discount');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_related'] = $this->language->get('entry_related');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_priority'] = $this->language->get('entry_priority');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_reward'] = $this->language->get('entry_reward');

		$this->data['column_key_product'] = $this->language->get('column_key_product');
		$this->data['column_product_name'] = $this->language->get('column_product_name');
		$this->data['column_quantity'] = $this->language->get('column_quantity');
		$this->data['column_action'] = $this->language->get('column_action');
				
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_attribute'] = $this->language->get('button_add_attribute');
		$this->data['button_add_option'] = $this->language->get('button_add_option');
		$this->data['button_add_option_value'] = $this->language->get('button_add_option_value');
		$this->data['button_add_discount'] = $this->language->get('button_add_discount');
		$this->data['button_add_special'] = $this->language->get('button_add_special');
		$this->data['button_add_image'] = $this->language->get('button_add_image');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_special'] = $this->language->get('tab_special');
		$this->data['tab_links'] = $this->language->get('tab_links');
		 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}
   
   		if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = array();
		}	
		
   		if (isset($this->error['model'])) {
			$this->data['error_model'] = $this->error['model'];
		} else {
			$this->data['error_model'] = '';
		}		
	 	
		if (isset($this->error['date_available'])) {
			$this->data['error_date_available'] = $this->error['date_available'];
		} else {
			$this->data['error_date_available'] = '';
		}	

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
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

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
	   		'text'	  => $this->language->get('text_home'),
			'href'	  => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
	   		'text'	  => $this->language->get('heading_title'),
			'href'	  => $this->url->link('catalog/combo', 'token=' . $this->session->data['token'] . $url, 'SSL'),
	  		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['combo_id'])) {
			$this->data['action'] = $this->url->link('catalog/combo/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/combo/update', 'token=' . $this->session->data['token'] . '&combo_id=' . $this->request->get['combo_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('catalog/combo', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['combo_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$combo_info = $this->model_catalog_combo->getCombo($this->request->get['combo_id']);
			$this->data['status'] = $combo_info['status'];
		}	
		
		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		}
		
		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['combo_description'])) {
			$this->data['combo_description'] = $this->request->post['combo_description'];
		} elseif (isset($this->request->get['combo_id'])) {
			$this->data['combo_description'] = $this->model_catalog_combo->getComboDescriptions($this->request->get['combo_id']);
		} else {
			$this->data['combo_description'] = array();
		}		

		$this->load->model('setting/store');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
		
		if (isset($this->request->post['combo_store'])) {
			$this->data['combo_store'] = $this->request->post['combo_store'];
		} elseif (isset($this->request->get['combo_id'])) {
			$this->data['combo_store'] = $this->model_catalog_combo->getComboStores($this->request->get['combo_id']);
		} else {
			$this->data['combo_store'] = array(0);
		}
		
		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($combo_info)) {
			$this->data['keyword'] = $combo_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}
		
		
		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($combo_info)) {
			$this->data['image'] = $combo_info['image'];
		} else {
			$this->data['image'] = '';
		}
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($combo_info) && $combo_info['image'] && file_exists(DIR_IMAGE . $combo_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($combo_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
	
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
				
		$this->load->model('sale/customer_group');
		
		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		
		if (isset($this->request->post['combo_special'])) {
			$this->data['combo_specials'] = $this->request->post['combo_special'];
		} elseif (isset($this->request->get['combo_id'])) {
			$this->data['combo_specials'] = $this->model_catalog_combo->getComboSpecials($this->request->get['combo_id']);
		} else {
			$this->data['combo_specials'] = array();
		}
		
		if (isset($this->request->post['combo_products'])) {
			$this->data['combo_products'] = $this->request->post['combo_products'];
		} else if (isset($this->request->get['combo_id'])) {
			$products = $this->model_catalog_combo->getComboProducts($this->request->get['combo_id']);
			$productsID = $this->model_catalog_combo->getComboProductsID($products);
			$products_info = $this->model_catalog_combo->getProductsInfo($productsID);		
			$this->data['combo_products'] = array();
			foreach($products as $product) {
				$this->data['combo_products'][] = $product + $products_info[$product['product_id']];
			}
		} else {
			$this->data['combo_products'] = array();
		}
						
		$this->template = 'catalog/combo_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	private function validateForm() { 
		if (!$this->user->hasPermission('modify', 'catalog/combo')) {
	  		$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['combo_description'] as $language_id => $value) {
	  		if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
	  		}
		}
		
		if (empty($this->request->post['combo_products']) || count($this->request->post['combo_products']) < 2) {
			$this->error['warning'] = $this->language->get('error_product');
		}
		
		foreach ($this->request->post['combo_products'] as $p) {
			if ($p['quantity'] <= 0) {
				$this->error['warning'] = $this->language->get('error_product_quantity');	
			}
		}
			
		$pid = $this->model_catalog_combo->getComboProductsID($this->request->post['combo_products']);
		$pkey = $this->model_catalog_combo->getComboProductsKey($this->request->post['combo_products']);
		
		$ps = $this->model_catalog_combo->RequiredOption($pid);
			
		if (empty($pkey) || count($pkey) < 1) {
			$this->error['warning'] = $this->language->get('error_product_key');
		}
		
		foreach ($ps as $p) {
			if (!empty($pkey) && !in_array($p['product_id'], $pkey)) {
				$this->error['warning'] = $this->language->get('error_option_product_key');		
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
					
		if (!$this->error) {
			return true;
		} else {
	  		return false;
		}
  	}
	
  	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/combo')) {
	  		$this->error['warning'] = $this->language->get('error_permission');  
		}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	private function validateCopy() {
		if (!$this->user->hasPermission('modify', 'catalog/combo')) {
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
			$this->load->model('catalog/combo');
			
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}
			
			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 20;	
			}			
						
			$data = array(
				'filter_name'		 => $filter_name,
				'start'			   => 0,
				'limit'			   => $limit
			);
			
			$results = $this->model_catalog_combo->getCombos($data);
			
			foreach ($results as $result) {
					
				$json[] = array(
					'combo_id' => $result['combo_id'],
					'name'	   => html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'),	
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}
}
?>