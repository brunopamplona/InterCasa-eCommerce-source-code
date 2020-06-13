<?php
//OpenCart Extension
//Project Name: OpenCart Combo/Bundle
//Author: Fanha Giang a.k.a fanha99
//Email (PayPal Account): fanha99@gmail.com
//License: Commercial
?>
<?php
class ControllerProductCombos extends Controller { 	
	public function index() { 
    	$this->language->load('product/combo');
		
		$this->load->model('catalog/product');
		
		$this->load->model('tool/image');
			 
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

		$keywords = $this->config->get('combo_meta_keyword');
		$keyword = $keywords[$this->config->get('config_language_id')];

		$descriptions = $this->config->get('combo_meta_description');
		$description = $descriptions[$this->config->get('config_language_id')];
		
		$this->document->setDescription($description);
		$this->document->setKeywords($keyword);
		$this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
      		'separator' => false
   		);

		$url = '';
				
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}	
		
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
					
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('product/combos', $url),
      		'separator' => $this->language->get('text_separator')
   		);
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
   
		$this->data['text_list'] = $this->language->get('text_list');
		$this->data['text_grid'] = $this->language->get('text_grid');
		$this->data['text_empty'] = $this->language->get('text_empty');
		$this->data['text_sort'] = $this->language->get('text_sort');
		$this->data['text_limit'] = $this->language->get('text_limit');
		$this->data['text_display'] = $this->language->get('text_display');
		$this->data['text_tax'] = $this->language->get('text_tax');

		$this->language->load('product/combo');
		$this->data['button_combo_cart'] = $this->language->get('button_combo_cart');
		$this->data['this_item'] = $this->language->get('this_item');
		$this->data['save_percent'] = $this->language->get('save_percent');
		$this->data['button_continue'] = $this->language->get('button_continue');
		
		$this->data['continue'] = $this->url->link('common/home');
		
		$this->data['combos'] = array();

		$data = array(
			//'sort'  => $sort,
			//'order' => $order,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);	
		
		$this->load->model('catalog/combo');
		
		$combos_total = $this->model_catalog_combo->countActiveCombos();
		$combos = $this->model_catalog_combo->getActiveCombos($data); // edit for data later
		
		
		foreach ($combos as $combo) {
			
			$ps = $this->model_catalog_combo->getComboProducts($combo['combo_id']);			
					
			$products = array();
			$sum = 0.0;
			$sum_no_tax = 0.0;
			
			foreach($ps as $p) {
				$result = $this->model_catalog_product->getProduct($p['product_id']);
				
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				} else {
					$image = false;
				}
				
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
				
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));					
					$sum += ($p['quantity'] * $this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
					$sum_no_tax += ($p['quantity'] * $result['special']);
				} else {
					$special = false;
					$sum += ($p['quantity'] * $this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					$sum_no_tax += ($p['quantity'] * $result['price']);
				}
				
				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}
								
				$products[] = array(
					'product_id' => $result['product_id'],
					'quantity'	 => $p['quantity'],
					'thumb'   	 => $image,
					'name'    	 => $result['name'],
					'price'   	 => $price,
					'special' 	 => $special,
					'rating'     => $rating,
					'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
					'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),
					'attribute_group' => $this->model_catalog_product->getProductAttributes($result['product_id']),
				);
			}

			$discount = $combo['discount'];
			
			if ($combo['image']) {
				$image = $this->model_tool_image->resize($combo['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
			} else {
				$image = false;
			}

			if ($this->config->get('config_tax')) {
				$tax = $this->currency->format((float)$sum_no_tax - $discount);
			} else {
				$tax = false;
			}
			
			$this->data['combos'][] = array(
				'combo_id' => $combo['combo_id'],
				'thumb'       => $image,
				'name' => $combo['name'],
				'href'   => $this->url->link('product/combo', 'combo_id=' . $combo['combo_id']),
				'discount' => ($discount != 0) ? $this->currency->format($sum - $discount) : 0,
				'total' => $this->currency->format($sum),
				'products' => $products,
				'percent' => $discount * 100 / $sum,
				'save' => $this->currency->format($discount),
				'tax' => $tax,
			);
		}
					
		$url = '';

		$this->data['limits'] = array();
		
		$this->data['limits'][] = array(
			'text'  => $this->config->get('config_catalog_limit'),
			'value' => $this->config->get('config_catalog_limit'),
			'href'  => $this->url->link('product/combos', $url . '&limit=' . $this->config->get('config_catalog_limit'))
		);
					
		$this->data['limits'][] = array(
			'text'  => 25,
			'value' => 25,
			'href'  => $this->url->link('product/combos', $url . '&limit=25')
		);
		
		$this->data['limits'][] = array(
			'text'  => 50,
			'value' => 50,
			'href'  => $this->url->link('product/combos', $url . '&limit=50')
		);

		$this->data['limits'][] = array(
			'text'  => 75,
			'value' => 75,
			'href'  => $this->url->link('product/combos', $url . '&limit=75')
		);
		
		$this->data['limits'][] = array(
			'text'  => 100,
			'value' => 100,
			'href'  => $this->url->link('product/combos', $url . '&limit=100')
		);

		$url = '';
	
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
						
		$pagination = new Pagination();
		$pagination->total = $combos_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product/combos', $url . '&page={page}');
			
		$this->data['pagination'] = $pagination->render();
			
		$this->data['limit'] = $limit;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/combos.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/product/combos.tpl';
		} else {
			$this->template = 'default/template/product/combos.tpl';
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
  	}
}
?>