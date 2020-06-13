<?php
//OpenCart Extension
//Project Name: OpenCart Combo/Bundle
//Author: Fanha Giang a.k.a fanha99
//Email (PayPal Account): fanha99@gmail.com
//License: Commercial
?>
<?php
class ControllerProductCombo extends Controller { 	
	private $error = array(); 
	
	public function index() { 
    	$this->language->load('product/product');
    	$this->language->load('product/combo');
	
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),			
			'separator' => false
		);
		
		if (isset($this->request->get['combo_id'])) {
			$combo_id = (int)$this->request->get['combo_id'];
		} else {
			$combo_id = 0;
		}
		
		$this->load->model('catalog/product');
		$this->load->model('catalog/combo');
		
		$combo_info = $this->model_catalog_combo->getComboInfo($combo_id);
		
		if ($combo_info) {
			$url = '';
														
			$this->data['breadcrumbs'][] = array(
				'text'      => $combo_info['name'],
				'href'      => $this->url->link('product/combo', $url . '&combo_id=' . $this->request->get['combo_id']),
				'separator' => $this->language->get('text_separator')
			);			
			
			$this->document->setTitle($combo_info['name']);
			$this->document->setDescription($combo_info['meta_description']);
			$this->document->setKeywords($combo_info['meta_keyword']);
			$this->document->addLink($this->url->link('product/combo', 'combo_id=' . $this->request->get['combo_id']), 'canonical');
			$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/combos.css')) {
				$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/combos.css');
			} else {
				$this->document->addStyle('catalog/view/theme/default/stylesheet/combos.css');
			}
			
			$this->data['heading_title'] = $combo_info['name'];
			
			$this->data['text_select'] = $this->language->get('text_select');
			$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$this->data['text_model'] = $this->language->get('text_model');
			$this->data['text_reward'] = $this->language->get('text_reward');
			$this->data['text_points'] = $this->language->get('text_points');	
			$this->data['text_stock'] = $this->language->get('text_stock');
			$this->data['text_price'] = $this->language->get('text_price');
			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['text_discount'] = $this->language->get('text_discount');
			$this->data['text_option'] = $this->language->get('combo_items');
			$this->data['text_qty'] = $this->language->get('text_qty');
			$this->data['text_write'] = $this->language->get('text_write');
			$this->data['text_note'] = $this->language->get('text_note');
			$this->data['text_share'] = $this->language->get('text_share');
			$this->data['text_wait'] = $this->language->get('text_wait');
			$this->data['text_tags'] = $this->language->get('text_tags');
			$this->data['save_percent'] = $this->language->get('save_percent');			
			$this->data['save_amount'] = $this->language->get('save_amount');			
			$this->data['text_payment_profile'] = $this->language->get('text_payment_profile');
			
			$this->data['entry_name'] = $this->language->get('entry_name');
			$this->data['entry_review'] = $this->language->get('entry_review');
			$this->data['entry_rating'] = $this->language->get('entry_rating');
			$this->data['entry_good'] = $this->language->get('entry_good');
			$this->data['entry_bad'] = $this->language->get('entry_bad');
			$this->data['entry_captcha'] = $this->language->get('entry_captcha');
			
			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_combo_cart'] = $this->language->get('button_combo_cart');
			$this->data['button_upload'] = $this->language->get('button_upload');
			$this->data['button_continue'] = $this->language->get('button_continue');
			
			$this->load->model('catalog/review');

			$this->data['tab_description'] = $this->language->get('tab_description');
			$this->data['tab_related'] = $this->language->get('tab_related');
			
			//todo: reviews			.
			$this->data['tab_review'] = $this->language->get('tab_review');
			//$this->data['tab_review'] = sprintf($this->language->get('tab_review'), $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']));
			
			$this->data['combo_id'] = $this->request->get['combo_id'];
			
			// todo: calculate the reward and point, and stock
			$this->data['reward'] = 0;
			$this->data['points'] = 0;
			$this->data['stock'] = 0;
			
			// if ($product_info['quantity'] <= 0) {
				// $this->data['stock'] = $product_info['stock_status'];
			// } elseif ($this->config->get('config_stock_display')) {
				// $this->data['stock'] = $product_info['quantity'];
			// } else {
				// $this->data['stock'] = $this->language->get('text_instock');
			// }
			
			$this->load->model('tool/image');

			if ($combo_info['image']) {
				$this->data['popup'] = $this->model_tool_image->resize($combo_info['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			} else {
				$this->data['popup'] = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			}
			
			if ($combo_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($combo_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			} else {
				$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			}
														
			$this->data['review_status'] = $this->config->get('config_review_status');
			// $this->data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
			// $this->data['rating'] = (int)$product_info['rating'];
			$this->data['description'] = html_entity_decode($combo_info['description'], ENT_QUOTES, 'UTF-8');
			
			$this->data['images'] = array();						
			$this->data['products'] = array();
			$this->data['options'] = array();

			$sum = 0.0;
			$sum_no_tax = 0.0;
			
			$ps = $this->model_catalog_combo->getComboProducts($this->request->get['combo_id']);
			foreach($ps as $p) {
			
				$result = $this->model_catalog_product->getProduct($p['product_id']);
				$this->data['images'][] = array(
					'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
					'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
				);
				
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('combo_image_combo_width'), $this->config->get('combo_image_combo_height'));
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
				
				// todo: edit the options display
				$data_options = array();
				
				foreach ($this->model_catalog_product->getProductOptions($p['product_id']) as $option) { 
					if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') { 
						$option_value_data = array();
						
						foreach ($option['option_value'] as $option_value) {
							if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
								if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
									$price = $this->currency->format($this->tax->calculate($option_value['price'], $result['tax_class_id'], $this->config->get('config_tax')));
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
						
						$data_options[] = array(
							'product_option_id' => $option['product_option_id'],
							'option_id'         => $option['option_id'],
							'name'              => $option['name'],
							'type'              => $option['type'],
							'option_value'      => $option_value_data,
							'required'          => $option['required']
						);					
					} elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
						$data_options[] = array(
							'product_option_id' => $option['product_option_id'],
							'option_id'         => $option['option_id'],
							'name'              => $option['name'],
							'type'              => $option['type'],
							'option_value'      => $option['option_value'],
							'required'          => $option['required']
						);						
					}
				}
				
				if (method_exists($this->model_catalog_product, 'getProfiles')) {
					$data_profiles = $this->model_catalog_product->getProfiles($result['product_id']);
				} else {
					$data_profiles = array();
				}
			
				$this->data['products'][] = array(
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
					'options'    => $data_options,
					'profiles'   => $data_profiles,
				);
				
				$this->data['options'] = array_merge( $this->data['options'], $data_options);
			}	
			
			$discount = $combo_info['discount'];
					
			$this->data['price'] = $this->currency->format($sum);
			if ($discount != 0) {
				$this->data['special'] = $this->currency->format($sum - $discount);
			} else {
				$this->data['special'] = 0;
			}
			
			if ($this->config->get('config_tax')) {
				$this->data['tax'] = $this->currency->format((float)$sum_no_tax - $discount);
			} else {
				$this->data['tax'] = false;
			}
			
			$this->data['minimum'] = 1;
			
			$this->data['save'] = $this->currency->format($discount);
			$this->data['percent'] = $discount * 100 / $sum;
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/combo.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/combo.tpl';
			} else {
				$this->template = 'default/template/product/combo.tpl';
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
		} else {
			$url = '';
											
      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('product/combo', $url . '&combo_id=' . $combo_id),
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
						
			$this->response->setOutput($this->render());
    	}
  	}
}
?>