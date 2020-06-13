<?php  
class ControllerProductProduct extends Controller {
	private $error = array(); 
	
	public function index() { 
		$this->language->load('product/product');
	
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),			
			'separator' => false
		);
		
		$this->load->model('catalog/category');	
		
		if (isset($this->request->get['path'])) {
			$path = '';
				
			$parts = explode('_', (string)$this->request->get['path']);
			
			$category_id = (int)array_pop($parts);
				
			foreach ($parts as $path_id) {
				if (!$path) {
					$path = $path_id;
				} else {
					$path .= '_' . $path_id;
				}
				
				$category_info = $this->model_catalog_category->getCategory($path_id);
				
				if ($category_info) {
					$this->data['breadcrumbs'][] = array(
						'text'      => $category_info['name'],
						'href'      => $this->url->link('product/category', 'path=' . $path),
						'separator' => $this->language->get('text_separator')
					);
				}
			}
			// Set the last category breadcrumb
			$category_info = $this->model_catalog_category->getCategory($category_id);
				
			if ($category_info) {			
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
										
				$this->data['breadcrumbs'][] = array(
					'text'      => $category_info['name'],
					'href'      => $this->url->link('product/category', 'path=' . $this->request->get['path']),
					'separator' => $this->language->get('text_separator')
				);
			}
		}
		
		$this->load->model('catalog/manufacturer');	
		
		if (isset($this->request->get['manufacturer_id'])) {
			$this->data['breadcrumbs'][] = array( 
				'text'      => $this->language->get('text_brand'),
				'href'      => $this->url->link('product/manufacturer'),
				'separator' => $this->language->get('text_separator')
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
			
			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

			if ($manufacturer_info) {	
				$this->data['breadcrumbs'][] = array(
					'text'	    => $manufacturer_info['name'],
					'href'	    => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url),					
					'separator' => $this->language->get('text_separator')
				);
			}
		}
		
		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';
			
			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}
						
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
						
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}
			
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}	

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
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
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
			
			
			
						
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_search'),
				'href'      => $this->url->link('product/search', $url),
				'separator' => $this->language->get('text_separator')
			); 	
		}
		
		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}
		
		$this->load->model('catalog/product');
		
		$product_info = $this->model_catalog_product->getProduct($product_id);

				if ($product_info['shipping']):
					$this->data['shipping'] = $product_info['shipping'];
					$this->data['calculaFrete_titulo'] = $this->language->get('calculaFrete_titulo');
					$this->data['calculaFrete_help']   = $this->language->get('calculaFrete_help');
					$this->data['calculaFrete_cep']    = $this->language->get('calculaFrete_cep');
					$this->data['calculaFrete_botao']  = $this->language->get('calculaFrete_botao');
					$this->data['calculaFrete_aviso']  = $this->language->get('calculaFrete_aviso');
				else:
					$this->data['shipping'] = 0;
				endif;
			
		
		$this->data['product_info'] = $product_info;
		
		if ($product_info) {

			if ($this->config->get('product_reviews_status') && $this->config->get('product_reviews_language_status')) {
				$this->load->model('catalog/review');

				$product_info['reviews'] = $this->model_catalog_review->getTotalReviewsByProductId($product_info['product_id'], $this->config->get('config_language_id'));

				if (!$product_info['reviews']) {
					$product_info['reviews'] = $this->model_catalog_review->getTotalReviewsByProductId($product_info['product_id'], false);
				}
			}
			
			$url = '';
			
			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}
			
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}
			
			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}			

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}
						
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
			
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}	
						
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}
			
			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
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
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
												
			$this->data['breadcrumbs'][] = array(
				'text'      => $product_info['name'],
				'href'      => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id']),
				'separator' => $this->language->get('text_separator')
			);			
			
			$this->document->setTitle($product_info['name']);
			$this->document->setDescription($product_info['meta_description']);
			$this->document->setKeywords($product_info['meta_keyword']);
			$this->document->addLink($this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), 'canonical');
			$this->document->addScript('catalog/view/javascript/jquery/tabs.js');
			$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');
			
			$this->data['heading_title'] = $product_info['name'];

			$this->data['text_accessories'] = $this->language->get('text_accessories');
			$this->data['text_total_accessories'] = $this->language->get('text_total_accessories');
			$this->data['text_total_geral'] = $this->language->get('text_total_geral');
			$this->data['text_accessory_required'] =  $this->language->get('text_accessory_required');
			
			
			$this->data['text_select'] = $this->language->get('text_select');
			$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$this->data['text_model'] = $this->language->get('text_model');
			$this->data['text_reward'] = $this->language->get('text_reward');
			$this->data['text_points'] = $this->language->get('text_points');	
			$this->data['text_discount'] = $this->language->get('text_discount');
			$this->data['text_stock'] = $this->language->get('text_stock');
			$this->data['text_price'] = $this->language->get('text_price');
			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['text_discount'] = $this->language->get('text_discount');
			$this->data['text_option'] = $this->language->get('text_option');
			$this->data['text_qty'] = $this->language->get('text_qty');
			$this->data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
			$this->data['text_or'] = $this->language->get('text_or');
			$this->data['text_write'] = $this->language->get('text_write');
			$this->data['text_note'] = $this->language->get('text_note');
			$this->data['text_share'] = $this->language->get('text_share');
			$this->data['text_wait'] = $this->language->get('text_wait');
			$this->data['text_tags'] = $this->language->get('text_tags');
			
			$this->data['entry_name'] = $this->language->get('entry_name');
			$this->data['entry_review'] = $this->language->get('entry_review');
			$this->data['entry_rating'] = $this->language->get('entry_rating');
			$this->data['entry_good'] = $this->language->get('entry_good');
			$this->data['entry_bad'] = $this->language->get('entry_bad');
			$this->data['entry_captcha'] = $this->language->get('entry_captcha');
			
			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_wishlist'] = $this->language->get('button_wishlist');
			$this->data['button_compare'] = $this->language->get('button_compare');			
			$this->data['button_upload'] = $this->language->get('button_upload');
			$this->data['button_continue'] = $this->language->get('button_continue');
			
			$this->load->model('catalog/review');

			$this->data['tab_description'] = $this->language->get('tab_description');
			$this->data['tab_attribute'] = $this->language->get('tab_attribute');
			$this->data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);

				$this->load->model('module/productquestion');
				$this->language->load('module/productquestion');
				$this->data['tab_questions'] = sprintf($this->language->get('tab_questions'), $this->model_module_productquestion->getQuestionCount(
					array(
						'language_id' => $this->model_module_productquestion->getLangIdByCode($this->customer->session->data['language']),
						'display' => 1,
						'product_id' => $this->request->get['product_id']
					)
				));

				$this->document->addScript('catalog/view/javascript/productquestion.js');
				if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/productquestion.css')) {
					$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/productquestion.css');
				} else {
					$this->document->addStyle('catalog/view/theme/default/stylesheet/productquestion.css');
				}
			
			$this->data['tab_related'] = $this->language->get('tab_related');
			
			$this->data['product_id'] = $this->request->get['product_id'];
			$this->data['manufacturer'] = $product_info['manufacturer'];
			$this->data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
			$this->data['model'] = $product_info['model'];
			$this->data['reward'] = $product_info['reward'];
			$this->data['points'] = $product_info['points'];

				//VALDEIR - CALCULA FRETE
				
				$this->load->model('account/address');
				$enderecoCliente = $this->model_account_address->getAddress($this->customer->getId());
				
				$this->data['zipcode'] = $enderecoCliente['postcode'];
				//FIM VALDEIR - CALCULA FRETE
			

			$this->data['stock_status'] = ($product_info['quantity'] > 0) ? TRUE : FALSE;

			if ($product_info['quantity'] <= 0) {
				$this->data['stock'] = $product_info['stock_status'];
			} elseif ($this->config->get('config_stock_display')) {
				$this->data['stock'] = $product_info['quantity'];
			} else {
				$this->data['stock'] = $this->language->get('text_instock');
			}
			
$this->data['stockStatus'] = $this->stockStatus($this->data['stock']);
			$this->load->model('tool/image');

			if ($product_info['image']) {
				$this->data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			} else {
				$this->data['popup'] = '';
			}
			
			if ($product_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			} else {
				$this->data['thumb'] = '';
			}
			
			$this->data['images'] = array();
			
			$results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);

            $og_images = array();
            if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
                $_prefix =  $this->config->get('config_ssl');
            } else {
                $_prefix = $this->config->get('config_url');
            }

			foreach ($results as $result) {
				$this->data['images'][] = array(
					'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
					'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height')),
					'small' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
				);

                $og_images[] = $_prefix.'image/'.$result['image'];
			}

            $this->document->setImages($og_images);
						
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$this->data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));

			$this->data['price_value'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), '', '', false);
			
			} else {
				$this->data['price'] = false;

			$this->data['price_value'] = false;
			
			}
						
			if ((float)$product_info['special']) {
				$this->data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));

			$this->data['special_value'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), '', '', false);
			
			} else {
				$this->data['special'] = false;

			$this->data['special_value'] = false;
			
			}
			

			  $this->data['priceISO'] = $this->tofloat($this->data['price']);
			  $this->data['specialISO'] = $this->tofloat($this->data['special']);
			  
			if ($this->config->get('config_tax')) {
				$this->data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
			} else {
				$this->data['tax'] = false;
			}
			
			$discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);
			
			$this->data['discounts'] = array(); 
			
			foreach ($discounts as $discount) {
				$this->data['discounts'][] = array(
					'quantity' => $discount['quantity'],
					'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')))
				);
			}
			
			$this->data['options'] = array();
			
			foreach ($this->model_catalog_product->getProductOptions($this->request->get['product_id']) as $option) { 
				if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') { 
					$option_value_data = array();
					
					foreach ($option['option_value'] as $option_value) {
						if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
							if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
								$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
							} else {
								$price = false;
							}
							
							$option_value_data[] = array(
								'product_option_value_id' => $option_value['product_option_value_id'],
								'option_value_id'         => $option_value['option_value_id'],
								'name'                    => $option_value['name'],
								'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
								'price'                   => $price,
								'price_prefix'            => $option_value['price_prefix']
							);
						}
					}
					
					$this->data['options'][] = array(
						'product_option_id' => $option['product_option_id'],
						'option_id'         => $option['option_id'],
						'name'              => $option['name'],
						'type'              => $option['type'],
						'option_value'      => $option_value_data,
						'required'          => $option['required']
					);					
				} elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
					$this->data['options'][] = array(
						'product_option_id' => $option['product_option_id'],
						'option_id'         => $option['option_id'],
						'name'              => $option['name'],
						'type'              => $option['type'],
						'option_value'      => $option['option_value'],
						'required'          => $option['required']
					);						
				}
			}
							

			$data['objConfig'] = $this->config;
			$data['objCustomer'] = $this->customer;
			$data['objRequest'] = $this->request;

			if ($this->config->get('product_reviews_status')) {
				$this->document->addScript('catalog/view/javascript/jRating-master/jquery/jRating.jquery.js');
				$this->document->addStyle('catalog/view/javascript/jRating-master/jquery/jRating.jquery.css');

				$data['entry_add_pros'] = $this->language->get('entry_add_pros');
				$data['entry_add_cons'] = $this->language->get('entry_add_cons');
				$data['entry_review_image'] = sprintf($this->language->get('entry_review_image'), $this->config->get('product_reviews_image_limit'));
				$data['entry_review_title'] = $this->language->get('entry_review_title');
				$data['entry_recommend_product'] = $this->language->get('entry_recommend_product');
				$data['text_product_review'] = sprintf($this->language->get('text_product_review'), $product_info['name']);
				$data['text_general_avarage'] = $this->language->get('text_general_avarage');

				if ($this->config->get('product_reviews_recommend_status')) {
					$recomend_info = $this->model_catalog_review->getRecommendProductId($product_info['product_id']);

					$recommend_yes = (int)$recomend_info['yes'];
					$recommend_total = (int)$recomend_info['total'];
					$recommend_percent = ($recommend_total > 0) ? round(($recommend_yes / $recommend_total) * 100) : 0;
				} else {
					$recommend_yes = 0;
					$recommend_total = 0;
					$recommend_percent = 0;
				}

				$data['text_count_recommend_product'] = sprintf($this->language->get('text_count_recommend_product'), $recommend_yes, $recommend_total, $recommend_percent . '%');
				$data['recommend_total'] = $recommend_total;
				$data['text_general_count_mark'] = sprintf($this->language->get('text_general_count_mark'), $product_info['reviews']);
				$data['text_please_wait'] = $this->language->get('text_please_wait');
				$data['text_report_abuse'] = $this->language->get('text_report_abuse');
				$data['text_other_reason'] = $this->language->get('text_other_reason');
				$data['text_sort'] = $this->language->get('text_sort');
				$data['text_yes'] = $this->language->get('text_yes');
				$data['text_no'] = $this->language->get('text_no');
				$data['error_logged_helpfull'] = $this->language->get('error_logged_helpfull');
				$data['error_logged_report_abuse'] = $this->language->get('error_logged_report_abuse');
				$data['button_write_review'] = $this->language->get('button_write_review');

				$data['href_report_abuse'] = $this->url->link('product/allreviews/reportabuse', '', 'SSL');

				$reasons = $this->model_catalog_review->getReasonsTitle();

				if ($reasons) {
					$data['reasons'] = $reasons;
				} else {
					$data['reasons'] = array();
				}

				$data['ratings'] = $this->model_catalog_review->getRatings();
				$data['total_ratings'] = $this->model_catalog_review->getRatingsByProductId($product_id);
				$data['predefined_pros'] = $this->model_catalog_review->getPredefinedProsCons(array('filter_type' => '1'));
				$data['predefined_cons'] = $this->model_catalog_review->getPredefinedProsCons(array('filter_type' => '0'));

				$data['product_review_sorts'] = array();

				$data['product_review_sorts'][] = array(
					'text'  => $this->language->get('text_default'),
					'value' => 'r.date_added-DESC'
				);

				$data['product_review_sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC'
				);

				$data['product_review_sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC'
				);

				$data['product_review_sorts'][] = array(
					'text'  => $this->language->get('text_helpfull_desc'),
					'value' => 'vote-DESC'
				);

				$data['product_review_sorts'][] = array(
					'text'  => $this->language->get('text_helpfull_asc'),
					'value' => 'vote-ASC'
				);

				$data['product_review_sorts'][] = array(
					'text'  => $this->language->get('text_date_added_desc'),
					'value' => 'r.date_added-DESC'
				);

				$data['product_review_sorts'][] = array(
					'text'  => $this->language->get('text_date_added_asc'),
					'value' => 'r.date_added-ASC'
				);

				if (version_compare(VERSION, '2.0') < 0) {
					$this->data = array_merge($this->data, $data);
				}
			}
			
			if ($product_info['minimum']) {
				$this->data['minimum'] = $product_info['minimum'];
			} else {
				$this->data['minimum'] = 1;
			}
			
			$this->data['review_status'] = $this->config->get('config_review_status');
			$this->data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
			$this->data['rating'] = (int)$product_info['rating'];
			$this->data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
			$this->data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
			

			$this->data['accessories'] = array();
			$this->data['accessories_ids'] = array();
			
			$results = $this->model_catalog_product->getProductAccessory($this->request->get['product_id']);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $result['image'];
				} else {
					$image = 'no_image.jpg';
				}
					
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					$price_value = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), '', '', false);
				} else {
					$price = false;
					$price_value = false;
				}
						
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
					$special_value = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), '', '', false);
				} else {
					$special = false;
					$special_value = false;
				}
				
				if ($result['minimum'] > 1) {
					$minimum = $result['minimum'];
				}
				else if ($result['required']){
					$minimum = 1;
				}
				else{
					$minimum = 0;
				}
				
				$discounts = $this->model_catalog_product->getProductDiscounts($result['product_id']);
				
				$discounts_accessory = array(); 
				
				foreach ($discounts as $discount) {
					$discounts_accessory[] = array(
						'quantity' => $discount['quantity'],
						'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax'))),
						'price_value'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), '', '', false)
					);
				}				
				
				$this->data['accessories'][] = array(
					'product_id'    => $result['product_id'],
					'name'    		=> $result['name'],
					'price'   		=> $price,
					'price_value'   => $price_value,
					'special' 		=> $special,
					'required' 		=> $result['required'],
					'special_value'	=> $special_value,
					'minimum'		=> $minimum,
					'discounts'		=> $discounts_accessory,
					'image'   		=> $this->model_tool_image->resize($image, 100, 100),
					'popup'   		=> $this->model_tool_image->resize($image, $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
					'href'    		=> $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			
				$this->data['accessories_ids'][] = $result['product_id'];
			}
			
			$this->data['products'] = array();
			
			$results = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);
			
			foreach ($results as $result) {
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
				} else {
					$special = false;
				}
				
				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}
							
				$this->data['products'][] = array(
					'product_id' => $result['product_id'],
					'thumb'   	 => $image,
					'name'    	 => $result['name'],
					'price'   	 => $price,
					'special' 	 => $special,
					'rating'     => $rating,
					'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
					'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}	
			
			$this->data['tags'] = array();
			if ($product_info['tag']) {		
				$tags = explode(',', $product_info['tag']);
				
				foreach ($tags as $tag) {
					$this->data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('product/search', 'tag=' . trim($tag))
					);
				}
			}
			$this->model_catalog_product->updateViewed($this->request->get['product_id']);
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/product.tpl';
			} else {
				$this->template = 'default/template/product/product.tpl';
			}
			

		$this->language->load('product/combo');
		$this->data['tab_combo'] = $this->language->get('tab_combo');
			
			$this->children = array(

				'module/combo',
			
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
						
			
                    	if (isset($product_info)) {
	                        $snippet = $this->richsnippet($product_info, $this->data);
	                        $content = $this->render();
	                        $content = str_replace('<!--MRS_PLACEHOLDER-->',$snippet,$content);
	                        $this->response->setOutput($content);
	                    } else {
	                    	$this->response->setOutput($this->render());
	                    }
                    
		} else {
			$url = '';
			
			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}
			
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}	
			
			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}			
			
			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}	
					
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
							
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}
					
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}
			
			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
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
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
								
      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('product/product', $url . '&product_id=' . $product_id),
        		'separator' => $this->language->get('text_separator')
      		);			
		
      		$this->document->setTitle($this->language->get('text_error'));

      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
						
			
                    	if (isset($product_info)) {
	                        $snippet = $this->richsnippet($product_info, $this->data);
	                        $content = $this->render();
	                        $content = str_replace('<!--MRS_PLACEHOLDER-->',$snippet,$content);
	                        $this->response->setOutput($content);
	                    } else {
	                    	$this->response->setOutput($this->render());
	                    }
                    
    	}
  	}
	

			 
                         public function richsnippet ($product_info = false, $data) {
                         
                            //error_reporting(E_ALL);
                            //ini_set('display_errors', '1');

                            $result = '';
                            
							if (!$product_info) return $result;

                            /**************************************   BREADCRUMBS SECTION START   ****************************************/
                                            
                            $result .= '<script type="application/ld+json">
                                {
                                "@context": "http://schema.org",
                                "@type": "BreadcrumbList",
                                "itemListElement": [{'."\r\n";
                                
                                foreach ($data['breadcrumbs'] as $bid => $breadcrumb) {
                                          
                                    if (!preg_match('/<[^>]*>(?:[^<]*)?<\/[^>]>/is',$breadcrumb['text'])) {
                                        $bcName = $breadcrumb['text']; 
                                    } else {
                                        $bcName = 'Home';
                                    }
                                    
                                    $bc[] = '
                                            "@type": "ListItem",
                                            "position": '.($bid+1).',
                                            "item": {
                                                "@id": "'.trim($breadcrumb['href']).'",
                                                "name": "'.$bcName.'"
                                            }
                                        }'."\r\n";            
                                }
                                
                            $result .= implode(',{',$bc).']'."\r\n";
                                
                            $result .='}
                            </script>'."\r\n";
                                
                                /**************************************   BREADCRUMBS SECTION END   ****************************************/
                            
                            
                            
                            
                                $result .= '<script type="application/ld+json">
                                            {
                                            "@context": "http://schema.org/",';
                                            
                                
                                
                                            
                                $result .= '"@type": "Product",'."\r\n";
                                            
                                $result .= '"name": "'.$product_info['name'].'",'."\r\n";
                                $result .= '"description": "'.addslashes(json_encode($product_info['description'], JSON_HEX_APOS)).'",'."\r\n";
                                $result .= '"image": "'.$data['thumb'].'",'."\r\n";
                                $result .= '"sku": "'.$product_info['sku'].'",'."\r\n";
                                $result .= '"mpn": "'.$product_info['mpn'].'",'."\r\n";
                                //$result .= '"isbn": "'.$product_info['isbn'].'",'."\r\n";
                                $result .= '"gtin14": "'.$product_info['ean'].'",'."\r\n";
                                $result .= '"brand": "'.$data['manufacturer'].'",'."\r\n";
                                
                                /**************************************   OFFERS SECTION START   ****************************************/
                                
                                if (version_compare(VERSION,'3','>=')) { //OpenCart 3.x
                                    if (isset($this->session->data['currency'])) {
                                        $cur = $this->session->data['currency'];
                                    } else {
                                        $cur = 'CurrencyError';
                                    }
                                } else { // OpenCart 2.x
                                    $sessKeys = array_keys($_SESSION);
                                    if (isset($_SESSION['currency'])) {
                                        $cur = $_SESSION['currency'];
                                    } else if (isset($_SESSION['default']['currency'])) {
                                        $cur = $_SESSION['default']['currency'];
                                    } else if (isset($_SESSION[$sessKeys[0]]['currency'])){
                                        $cur = $_SESSION[$sessKeys[0]]['currency'];
                                    } else {
                                        $cur = 'CurrencyError';
                                    }
                                }
                                
                                $productUrl = end($data['breadcrumbs']);
                                $result .= '"offers": {
                                                "@type": "Offer",
                                                "price": "'. $data['priceISO'] .'",
                                                "priceCurrency": "'. $cur .'",
                                                "availability": "'. $data['stockStatus'] .'",
                                                "priceValidUntil": "'. date('Y-m-d', strtotime('+1 year')) .'",
                                                "url": "'. trim($productUrl['href']) .'",
                                                "itemCondition": "http://schema.org/NewCondition"
                                            } '."\r\n";
                                            
                                /**************************************   OFFERS SECTION END   ****************************************/

                                                                
                               
                                
                                
                                /**************************************   REVIEWS SECTION START   ****************************************/
                                $this->load->model('catalog/review');
                                $all_reviews = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], 0, 100);
                                        
                                $reviews = array();
                                
                                if (is_array($all_reviews) && count($all_reviews)) {

                                    $result .= ',"review": [';
                                    foreach ($all_reviews as $review) {
                                    
                                        $reviews[] = '
                                        {
                                            "@type": "Review",
                                            "reviewRating": {
                                                "@type": "Rating",
                                                "ratingValue": "'.(int)$review['rating'].'"
                                            },
                                            "author": {
                                                "@type": "Person",
                                                "name": "'.$review['author'].'"
                                            },
                                            "datePublished": "'.date('Y-m-d',strtotime($review['date_added'])).'",
                                            "reviewBody": "'.addslashes(json_encode($review['text'])).'"
                                        }'."\r\n";
                                    }
                                }

                                if (count($reviews)) {
                                    $result .= "\r\n".implode(',',$reviews).']';
                                }
                                
                                /**************************************   REVIEWS SECTION END   ****************************************/
                                
                                 /**************************************   AGGREGATE RATING SECTION START   ****************************************/
                                if (count($reviews)) {
                                    $result .= ',"aggregateRating": {
                                        "@type": "AggregateRating",
                                        "ratingValue": "'.$data['rating'].'",
                                        "reviewCount": "'.(int)$product_info['reviews'].'"
                                    }';
                                }
                                
                                /**************************************   AGGREGATE RATING SECTION END   ****************************************/
                                
                                $result .= '}
                                            </script>';
                                        
                                return $result;
                            
                            }
                            
                            
			public function tofloat($num) {
			      $dotPos = strrpos($num, '.');
			      $commaPos = strrpos($num, ',');
			      $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos : 
				  ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
			    
			      if (!$sep) {
				  return floatval(preg_replace("/[^0-9]/", "", $num));
			      } 

			      return floatval(
				  preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
				  preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
			      );
			  }
			 
			  
			  public function stockStatus ($stock = false) {
			      
			      $content = 'http://schema.org/InStock'; 
			      if ($stock == false) return $content;
			      
			      if (!is_numeric($stock)) {
				  global $config;
				  global $db;
				  $content = '';
				  $lang = $config->get('config_language_id');
				  $query = "SELECT stock_status_id FROM ".DB_PREFIX."stock_status WHERE name = '".$stock."' and language_id = '".(int)$lang."' "; 
				  $result = $db->query($query);
				  $result = $result->row;

				  if (isset($result['stock_status_id']) && !empty($result['stock_status_id'])) {
					  switch ($result['stock_status_id']) {
					      case '7' : $content = 'http://schema.org/InStock'; break;
					      case '5' : $content = 'http://schema.org/OutOfStock'; break;
					      case '8' : $content = 'http://schema.org/PreOrder'; break;
					      case '6' : $content = 'http://schema.org/LimitedAvailability'; break;
					  }
				  } else {
					  switch ($stock) {
					      case 'In Stock' : $content = 'http://schema.org/InStock'; break;
					      case 'Out Of Stock' : $content = 'http://schema.org/OutOfStock'; break;
					      case 'Pre-Order' : $content = 'http://schema.org/PreOrder'; break;
					      case '2-3 Days' : $content = 'http://schema.org/LimitedAvailability'; break;
					      default: $content = 'http://schema.org/InStock'; break;
					  }
				  }
			      } else { //stock is a number
				  if ($stock > 0) { 
				      $content = 'http://schema.org/InStock'; 
				  } else {
				      $content = 'http://schema.org/OutOfStock';
				  }
			      }
			      
			      return $content;
			  }
			
	public function review() {

			$data['objConfig'] = $this->config;

			$this->load->language('product/product');

			if (isset($this->request->get['sort'])) {
				$sort_data = explode('-', $this->request->get['sort']);

				if (isset($sort_data[1]) && preg_match('/asc|desc/i', $sort_data[1])) {
					$sort = $this->request->get['sort'];
				} else {
					$sort = 'r.date_added-DESC';
				}
			} else {
				$sort = 'r.date_added-DESC';
			}

			$data['text_pros'] = $this->language->get('text_pros');
			$data['text_cons'] = $this->language->get('text_cons');
			$data['text_reply'] = $this->language->get('text_reply');
			$data['text_on'] = $this->language->get('text_on');
			$data['text_average_review'] = $this->language->get('text_average_review');
			$data['text_report_it'] = $this->language->get('text_report_it');

			if (version_compare(VERSION, '2.0') < 0) {
				$this->data = array_merge($this->data, $data);
			}

			$this->load->model('tool/image');

			$language_id = ($this->config->get('product_reviews_status') && $this->config->get('product_reviews_language_status')) ? (int)$this->config->get('config_language_id') : false;
			
    	$this->language->load('product/product');
		
		$this->load->model('catalog/review');

		$this->data['text_on'] = $this->language->get('text_on');
		$this->data['text_no_reviews'] = $this->language->get('text_no_reviews');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  
		
		$this->data['reviews'] = array();
		
		$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id'], $language_id);

			if (!$review_total) {
				$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id'], false);
				$language_id = false;
			}
			
			
$limit = ($this->config->get('product_reviews_status') && $this->config->get('product_reviews_limit')) ? (int)$this->config->get('product_reviews_limit') : 5;
		$results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * $limit, $limit, $language_id, $sort);
      		
		foreach ($results as $result) {

			$this->load->config('review_booster');

			if ($this->config->get($this->config->get('rb_module_name') . '_status') && $this->config->get($this->config->get('rb_module_name') . '_verified_buyer_status')) {
				$review_query = $this->db->query("SELECT r.customer_id, (SELECT e.verified_buyer FROM " . DB_PREFIX . "rb_email e WHERE e.review_id LIKE '%[" . (int)$result['review_id'] . "]%') AS verified_buyer FROM " . DB_PREFIX . "review r WHERE r.review_id = '" . (int)$result['review_id'] . "'");

				if ($review_query->row && ($review_query->row['customer_id'] || ($review_query->row['verified_buyer'] || $review_query->row['verified_buyer'] == ''))) {
					$verified_buyer_text = (array)$this->config->get($this->config->get('rb_module_name') . '_verified_buyer_text');

					if (isset($verified_buyer_text[$this->config->get('config_language_id')])) {
						$result['author'] .= ' <span class="verified_buyer">' . $verified_buyer_text[$this->config->get('config_language_id')] . '</span>';
					}
				}
			}
			

			$pros = $this->model_catalog_review->getProsByReviewId($result['review_id']);
			$cons = $this->model_catalog_review->getConsByReviewId($result['review_id']);

			if ($result['vote_yes']) {
				$helpfull = round($result['vote_yes'] / ($result['vote_yes'] + $result['vote_no']) * 100);
			} else {
				$helpfull = '0';
			}

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

			$comment_images = array();

			if ($this->config->get('product_reviews_image_status')) {
				foreach ($this->model_catalog_review->getReviewCommentImages($result['review_id']) as $image) {
					if ($image['image'] && file_exists(DIR_IMAGE . 'product_review/review/' . $image['image'])) {
						$comment_images[] = array(
							'thumb' => $this->model_tool_image->resize('product_review/review/' . $image['image'], $this->config->get('product_reviews_image_thumb_width'), $this->config->get('product_reviews_image_thumb_height')),
							'popup' => $this->model_tool_image->resize('product_review/review/' . $image['image'], $this->config->get('product_reviews_image_popup_width'), $this->config->get('product_reviews_image_popup_height'))
						);
					}
				}
			}
			
        	$this->data['reviews'][] = array(

			'review_id'          => $result['review_id'],
			'review_title'       => $result['title'],
			'images'             => $review_images,
			'comment_images'     => $comment_images,
			'comment'            => ($this->config->get('product_reviews_comment_status')) ? $result['comment'] : '',
			'comment_date_added' => date($this->language->get('date_format_short'), strtotime($result['comment_date_added'])),
			'product_pros'       => ($pros) ? $pros : array(),
			'product_cons'       => ($cons) ? $cons : array(),
			'ratings'            => $this->model_catalog_review->getRatingsByReviewId($result['review_id']),
			'share_url'          => $this->url->link('product/allreviews', 'review_id=' . (int)$result['review_id']),
			'share_title'        => str_replace('"', '', sprintf($this->language->get('text_share_title'), $result['author'], $result['name'])),
			'helpfulness'        => ($this->config->get('product_reviews_helpfulness_type') == 'numerically') ? sprintf($this->language->get('text_helpfull_numerically'), $result['review_id'], $result['review_id'], (int)$result['vote_yes'], ((int)$result['vote_yes'] + (int)$result['vote_no'])) : sprintf($this->language->get('text_helpfull_percentage'), $result['review_id'], $result['review_id'], $helpfull . '%'),
			
        		'author'     => $result['author'],
'title'     => $result['name'],
				'text'       => $result['text'],
				'rating'     => (int)$result['rating'],
        		'reviews'    => sprintf($this->language->get('text_reviews'), (int)$review_total),
'timestamp' => strtotime($result['date_added']),
        		'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
        	);
      	}			
			
		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = $limit; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}&sort=' . $sort);
			
		$this->data['pagination'] = $pagination->render();
		

			if ($this->config->get('product_reviews_status')) {
				if (version_compare(VERSION, '2.0') < 0) {
					if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/apr_review.tpl')) {
						$this->template = $this->config->get('config_template') . '/template/product/apr_review.tpl';
					} else {
						$this->template = 'default/template/product/apr_review.tpl';
					}

					$this->response->setOutput($this->render());
				} elseif (version_compare(VERSION, '2.2') < 0) {
					if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/apr_review.tpl')) {
						$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/apr_review.tpl', $data));
					} else {
						$this->response->setOutput($this->load->view('default/template/product/apr_review.tpl', $data));
					}
				}

				return;
			}
			
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/review.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/product/review.tpl';
		} else {
			$this->template = 'default/template/product/review.tpl';
		}
		
		
                    	if (isset($product_info)) {
	                        $snippet = $this->richsnippet($product_info, $this->data);
	                        $content = $this->render();
	                        $content = str_replace('<!--MRS_PLACEHOLDER-->',$snippet,$content);
	                        $this->response->setOutput($content);
	                    } else {
	                    	$this->response->setOutput($this->render());
	                    }
                    
	}
	

			public function discount() {
				$this->language->load('product/product');
				
				$this->load->model('catalog/product');
				
				$json = array();
				
				if ($this->request->server['REQUEST_METHOD'] == 'POST') {
				
					if (isset($this->request->get['product_id'])) {
						$product_id = $this->request->get['product_id'];
					} else {
						$product_id = 0;
					} 				
					
					$discount_quantity = (int)$this->request->post['quantity'];
					
					$price = $this->model_catalog_product->getProductPrice($product_id, $discount_quantity);
				
					if (!$price) {
						$json['error'] = $this->language->get('error_get_price');
					}
					
					if (!isset($json['error'])) {
						$json['price'] = $price;
						$json['success'] = true;
					}
				}
				
				$this->response->setOutput(json_encode($json));
			}
			
	public function write() {
		$this->language->load('product/product');
		
		$this->load->model('catalog/review');
		
		$json = array();
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {

			if ($this->config->get('product_reviews_status')) {
				$this->load->model('catalog/review');

				if ($this->config->get('product_reviews_rating_guest') && !$this->customer->isLogged()) {
					$json['error'] = $this->language->get('error_logged_guest_rate');

					$this->response->setOutput(json_encode($json));

					return;
				}

				$empty = array_filter($this->request->post['rating']);

				if (empty($this->request->post['rating']) || (count($empty) != count($this->request->post['rating']))) {
					$json['error'] = $this->language->get('error_rating');
				}

				if ($this->config->get('product_reviews_captcha') && $this->customer->isLogged()) {
					if (isset($this->session->data['captcha'])) {
						$this->request->post['captcha'] = $this->session->data['captcha'];
					}
				}

				if ($this->config->get('product_reviews_purchase_status') && $this->customer->isLogged()) {
					if (!$this->model_catalog_review->productPurchasedByCustomer($this->request->get['product_id'], $this->customer->getId())) {
						$json['error'] = $this->language->get('error_purchase_product');
					}
				}

				if ($this->config->get('product_reviews_limit_product_status') && $this->customer->isLogged()) {
					if ($this->model_catalog_review->alreadyWrittenByCustomer($this->request->get['product_id'], $this->customer->getId())) {
						$json['error'] = $this->language->get('error_already_review_product');
					}
				}

				if ($this->config->get('product_reviews_review_title_status')) {
					$this->request->post['review_title'] = strip_tags($this->request->post['review_title']);

					if ((utf8_strlen($this->request->post['review_title']) < 3) || (utf8_strlen($this->request->post['review_title']) > 40)) {
						$json['error'] = $this->language->get('error_review_title');
					}
				}

				if ($this->config->get('product_reviews_pros_cons_character_limit_from') && $this->config->get('product_reviews_pros_cons_character_limit_to')) {
					$from = (int)$this->config->get('product_reviews_pros_cons_character_limit_from');
					$to = (int)$this->config->get('product_reviews_pros_cons_character_limit_to');

					if (isset($this->request->post['review_pros']) && $this->request->post['review_pros']) {
						foreach (array_filter($this->request->post['review_pros']) as $pros) {
							if (utf8_strlen($pros) < $from || utf8_strlen($pros) > $to) {
								$json['error'] = sprintf($this->language->get('error_pros_cons_limit'), $from, $to);

								break;
							}
						}
					}

					if (isset($this->request->post['review_cons']) && $this->request->post['review_cons']) {
						foreach (array_filter($this->request->post['review_cons']) as $cons) {
							if (utf8_strlen($cons) < $from || utf8_strlen($cons) > $to) {
								$json['error'] = sprintf($this->language->get('error_pros_cons_limit'), $from, $to);

								break;
							}
						}
					}
				}
			}
			
			if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
				$json['error'] = $this->language->get('error_name');
			}
			
			if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$json['error'] = $this->language->get('error_text');
			}
	
			if (empty($this->request->post['rating'])) {
				
			if ($this->config->get('product_reviews_status')) {
				//$json['error'] = $this->language->get('error_rating');
			}
			
			}
	
			if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
				
			if ($this->config->get('product_reviews_status') && ($this->config->get('product_reviews_captcha') && $this->customer->isLogged())) {
				//$json['error'] = $this->language->get('error_captcha');
			} else {
				$json['error'] = $this->language->get('error_captcha');
			}
			
			}
				
			if (!isset($json['error'])) {
				$this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post);
				
				$json['success'] = $this->language->get('text_success');
			}
		}
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function captcha() {
		$this->load->library('captcha');
		
		$captcha = new Captcha();
		
		$this->session->data['captcha'] = $captcha->getCode();
		
		$captcha->showImage();
	}
	
	public function upload() {
		$this->language->load('product/product');
		
		$json = array();
		
		if (!empty($this->request->files['file']['name'])) {
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));
			
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
        		$json['error'] = $this->language->get('error_filename');
	  		}	  	
			
			// Allowed file extension types
			$allowed = array();
			
			$filetypes = explode("\n", $this->config->get('config_file_extension_allowed'));
			
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			
			if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
       		}
			
			// Allowed file mime types		
		    $allowed = array();
			
			$filetypes = explode("\n", $this->config->get('config_file_mime_allowed'));
			
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
							
			if (!in_array($this->request->files['file']['type'], $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}
						
			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}
		
		if (!$json && is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
			$file = basename($filename) . '.' . md5(mt_rand());
			
			// Hide the uploaded file name so people can not link to it directly.
			$json['file'] = $this->encryption->encrypt($file);
			
			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $file);
						
			$json['success'] = $this->language->get('text_upload');
		}	
		
		$this->response->setOutput(json_encode($json));		
	}
}
?>