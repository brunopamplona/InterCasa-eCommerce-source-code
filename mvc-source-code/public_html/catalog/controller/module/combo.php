<?php
//OpenCart Extension
//Project Name: OpenCart Combo/Bundle
//Author: Fanha Giang a.k.a fanha99
//Email (PayPal Account): fanha99@gmail.com
//License: Commercial
?>
<?php 
class ControllerModuleCombo extends Controller {
	public function index() {
	
		if (isset($this->request->get['product_id'])) {
			$product_id = $this->request->get['product_id'];
		} else {
			$product_id = 0;
		}
	
		$this->data['text_tax'] = $this->language->get('text_tax');

		$this->language->load('product/combo');
		$this->data['button_combo_cart'] = $this->language->get('button_combo_cart');
		$this->data['this_item'] = $this->language->get('this_item');
		$this->data['save_percent'] = $this->language->get('save_percent');
		$this->data['save_amount'] = $this->language->get('save_amount');
		$this->data['product_id'] = $product_id;
		
		$this->data['combos'] = array();
		
		$this->load->model('catalog/combo');
		$combos = $this->model_catalog_combo->getProductCombos($product_id);
		
		foreach ($combos as $combo) {
			
			$ps = $this->model_catalog_combo->getComboProducts($combo['combo_id']);			

			$this_item = $ps[$product_id];			
			unset($ps[$product_id]);
			array_unshift($ps, $this_item);		
			
			$products = array();
			$sum = 0.0;
			$sum_no_tax = 0.0;
			
			foreach($ps as $p) {
				$result = $this->model_catalog_product->getProduct($p['product_id']);
				
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('combo_image_product_width'), $this->config->get('combo_image_product_height'));
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
		
		$this->data['combo_image_product_height'] = $this->config->get('combo_image_product_height');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/combo.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/combo.tpl';
		} else {
			$this->template = 'default/template/module/combo.tpl';
		}
				
		$this->response->setOutput($this->render());		
	}
}
?>