<?php
class ControllerCheckoutSuccess extends Controller { 
	public function index() { 	

				$this->data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
				$this->data['ecommerce_tracking_status'] = false;
				$this->data['order'] = array();
				$this->data['order_products'] = array();

				if ($this->config->get('ecommerce_tracking_status') && $this->config->get('config_google_analytics')) {
					$this->data['ecommerce_tracking_status'] = true;

					if (strpos($this->data['google_analytics'], 'i,s,o,g,r,a,m') !== false) {
						$ecommerce_global_object_pos = strrpos($this->data['google_analytics'], "analytics.js','") + strlen("analytics.js','");
						$this->data['ecommerce_global_object'] = substr($this->data['google_analytics'], $ecommerce_global_object_pos, (strpos($this->data['google_analytics'], "');", $ecommerce_global_object_pos) - $ecommerce_global_object_pos));
						$this->data['start_google_code'] = substr($this->data['google_analytics'], 0, (strpos($this->data['google_analytics'], "pageview');") + strlen("pageview');")));
						$this->data['end_google_code'] = substr($this->data['google_analytics'], (strpos($this->data['google_analytics'], "pageview');") + strlen("pageview');")));
					} else {
						$this->data['ecommerce_global_object'] = false;
						$this->data['start_google_code'] = substr($this->data['google_analytics'], 0, strpos($this->data['google_analytics'], '(function'));
						$this->data['end_google_code'] = substr($this->data['google_analytics'], strpos($this->data['google_analytics'], '(function'));
					}

					if (isset($this->session->data['order_id'])) {
						$order_id = $this->session->data['order_id'];

						$this->load->model('account/order');

						$order_info = $this->model_account_order->getOrder($order_id);

						if ($order_info) {
							$tax = 0;
							$shipping = 0;

							$order_totals = $this->model_account_order->getOrderTotals($order_id);

							foreach ($order_totals as $order_total) {
								if ($order_total['code'] == 'tax') {
									$tax += $order_total['value'];
								} elseif($order_total['code'] == 'shipping') {
									$shipping += $order_total['value'];
								}
							}

							// Data required for _addTrans
							$this->data['order'] = $order_info;
							$this->data['order']['store_name'] = $this->config->get('config_name');
							$this->data['order']['order_total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
							$this->data['order']['order_tax'] = $this->currency->format($tax, $order_info['currency_code'], $order_info['currency_value'], false);
							$this->data['order']['order_shipping'] = $this->currency->format($shipping, $order_info['currency_code'], $order_info['currency_value'], false);

							// Data required for _addItem
							$order_products = $this->model_account_order->getOrderProducts($order_id);

							$this->load->model('catalog/product');
							$this->load->model('catalog/category');

							foreach ($order_products as $order_product) {
								$sku = $order_product['product_id'];

								if (($this->config->get('ecommerce_tracking_sku') == 'sku') || ($this->config->get('ecommerce_tracking_sku') == 'sku_option')) {
									$order_product_info = $this->model_catalog_product->getProduct($order_product['product_id']);

									if ($order_product_info && $order_product_info['sku']) {
										$sku = $order_product_info['sku'];
									}
								}

								if (($this->config->get('ecommerce_tracking_sku') == 'id_option') || ($this->config->get('ecommerce_tracking_sku') == 'sku_option')) {
									$order_options = $this->model_account_order->getOrderOptions($order_id, $order_product['order_product_id']);

									foreach ($order_options as $order_option) {
										$sku .= '-' . $order_option['product_option_id'] . ':' . $order_option['product_option_value_id'];

										if ($order_option['type'] != 'file') {
											$option_value = $order_option['value'];
										} else {
											$option_value = utf8_substr($order_option['value'], 0, utf8_strrpos($order_option['value'], '.'));
										}

										$order_product['name'] .= ' - ' . $order_option['name'] . ': ' . (utf8_strlen($option_value) > 20 ? utf8_substr($option_value, 0, 20) . '..' : $option_value);
									}
								}

								$categories = array();

								$order_product_categories = $this->model_catalog_product->getCategories($order_product['product_id']);

								if ($order_product_categories) {
									foreach ($order_product_categories as $order_product_category) {
										$category_data = $this->model_catalog_category->getCategory($order_product_category['category_id']);

										if ($category_data) {
											$categories[] = $category_data['name'];
										}
									}
								}

								$this->data['order_products'][] = array(
									'order_id' => $order_id,
									'sku'      => $sku,
									'name'     => $order_product['name'],
									'category' => implode(',', $categories),
									'quantity' => $order_product['quantity'],
									'price'    => $this->currency->format($order_product['price'] + ($this->config->get('config_tax') ? $order_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value'], false)
								);
							}
						}
					}
				}
			
	   $orderinfo = "<span class='pedido'>"."Obrigado por comprar na INTERCASA MOVEIS<br> O Valor total do pedido: ".$this->session->data['total'];
	$orderinfo .= "<br>O N° DO SEU PEDIDO: ". $this->session->data['order_id']. " " . "<br>"."</span>";
		if (isset($this->session->data['order_id'])) {
		    	$this->load->model('checkout/order'); 
			$data['orderDetails'] = $this->model_checkout_order->getOrder($this->session->data['order_id']);
         
			$this->cart->clear();
		

			
			// MIT : Order Id
			$this->session->data['last_order_id'] = $this->session->data['order_id'];
			// MIT : Order Id End
			
            
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);	
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
		}	
			
		
									   
		$this->language->load('checkout/success');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['breadcrumbs'] = array(); 

      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('common/home'),
        	'text'      => $this->language->get('text_home'),
        	'separator' => false
      	); 
		
      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/cart'),
        	'text'      => $this->language->get('text_basket'),
        	'separator' => $this->language->get('text_separator')
      	);
				
		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('checkout/checkout', '', 'SSL'),
			'text'      => $this->language->get('text_checkout'),
			'separator' => $this->language->get('text_separator')
		);	
					
      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/success'),
        	'text'      => $this->language->get('text_success'),
        	'separator' => $this->language->get('text_separator')
      	);

		$this->data['heading_title'] = $this->language->get('heading_title');
		
	if ($this->customer->isLogged()) {
			$new_message = $orderinfo;
			$new_message .= sprintf($this->language->get('text_customer'), $this->url->link('account/account', '', 'SSL'), $this->url->link('account/order', '', 'SSL'), $this->url->link('account/download', '', 'SSL'), $this->url->link('information/contact'));
    		$this->data['text_message'] = $new_message;
		} else {
			$new_message = $orderinfo;
			$new_message .= sprintf($this->language->get('text_guest'), $this->url->link('information/contact'));
    		$this->data['text_message'] = $new_message;
		}
		
    	$this->data['button_continue'] = $this->language->get('button_continue');

    	$this->data['continue'] = $this->url->link('common/home');

			
			// MIT : Orderid
			$this->load->language('account/order');
			$last_order_id = isset($this->session->data['last_order_id']) ? $this->session->data['last_order_id'] : '';
			$this->data['text_order_id'] = '';
			if($last_order_id)
				$this->data['text_order_id'] = $last_order_id;
			// MIT : Orderid End
			
            

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/success.tpl';
		} else {
			$this->template = 'default/template/common/success.tpl';
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