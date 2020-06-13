<?php
/*
  Review Booster
  Premium Extension
  
  Copyright (c) 2013 - 2019 Adikon.eu
  http://www.adikon.eu/
  
  You may not copy or reuse code within this file without written permission.
*/
class ControllerModuleReviewBooster extends Controller {
	private $module_type = '';
	private $module_name = '';
	private $module_path = '';
	private $module_model = '';

	private $compatibility = null;

	private $language_data = array();
	private $settings = array();
	private $error = array();

	private $test = false;

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->config('review_booster');

		$this->module_type = $this->config->get('rb_module_type');
		$this->module_name = $this->config->get('rb_module_name');
		$this->module_path = $this->config->get('rb_module_path');

		$this->load->model($this->module_path);

		$this->module_model = $this->{$this->config->get('rb_module_model')};

		$this->compatibility = $this->module_model->compatibility();

		$this->language_data = $this->language->load($this->module_path);

		$this->settings = $this->compatibility->getSetting($this->module_name, $this->config->get('config_store_id'));
	}

	public function index($setting = array()) {
		if (isset($this->settings['status']) && $this->settings['status']) {
			$data = array_merge(array(), $this->language_data);

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->compatibility->link('common/home'),
				'separator' => false
			);

			if (isset($this->request->get['hash'])) {
				$hash = $this->request->get['hash'];
			} else {
				$hash = 0;
			}

			if (isset($this->request->get['code'])) {
				$code = $this->request->get['code'];
			} else {
				$code = 0;
			}

			$reminder_info = $this->module_model->getReminder($hash, $code);

			if ($reminder_info) {
				$data['breadcrumbs'][] = array(
					'text'      => $this->language->get('heading_title'),
					'href'      => $this->compatibility->link($this->module_path, 'hash=' . $hash . '&code=' . $code),
					'separator' => ' &raquo; '
				);

				$data['success'] = '';

				if ($reminder_info['date_review'] != '0000-00-00 00:00:00') {
					$coupon_info = $this->module_model->getCoupon($reminder_info['coupon_id']);

					if ($coupon_info) {
						$discount = ($coupon_info['type'] == 'F') ? $this->currency->format($coupon_info['discount']) : (int)$coupon_info['discount'] . '%';

						$data['success'] = sprintf($this->language->get('text_coupon_success'), $coupon_info['code'], $discount, date($this->language->get('date_format_short'), strtotime($coupon_info['date_end'])));
					} else {
						$data['success'] = $this->language->get('text_success');
					}

					$data['continue'] = $this->compatibility->link('common/home');
				} else {
					$this->load->model('tool/image');

					$products = array();

					$order_products = $this->module_model->getOrderProducts($reminder_info['order_id'], $reminder_info['product_id'], $reminder_info['product_limit']);

					foreach ($order_products as $order_product) {
						if ($order_product['image']) {
							$image = $this->model_tool_image->resize($order_product['image'], $this->settings['product_image_width'], $this->settings['product_image_height']);
						} else {
							$image = $this->model_tool_image->resize($this->compatibility->getNoImage(), $this->settings['product_image_width'], $this->settings['product_image_height']);
						}

						$ratings = array();

						if ($this->settings['apr_status']) {
							$this->load->model('catalog/review');

							$reflection = new ReflectionClass('ModelCatalogReview');

							if ($reflection->hasMethod('getRatings')) {
								foreach ($this->model_catalog_review->getRatings() as $rating) {
									$ratings[] = array(
										'rating_id' => $rating['rating_id'],
										'name'      => $rating['name']
									);
								}
							} elseif (file_exists(DIR_APPLICATION . 'extension/module/product_reviews.php') && $this->settings['type'] != 'order') {
								$this->load->config('product_reviews');
								$this->load->model($this->config->get('pr_module_path'));

								foreach ($this->{$this->config->get('pr_module_model')}->getRatings($order_product['product_id']) as $rating) {
									$ratings[] = array(
										'rating_id' => $rating['rating_id'],
										'name'      => $rating['name']
									);
								}
							}
						} else {
							$ratings[] = array(
								'rating_id' => '0',
								'name'      => $this->language->get('text_overall')
							);
						}

						$products[$order_product['product_id']] = array(
							'product_id' => $order_product['product_id'],
							'image'      => $image,
							'name'       => $order_product['name'],
							'ratings'    => $ratings,
							'href'       => $this->compatibility->link('product/product', 'product_id=' . (int)$order_product['product_id'])
						);
					}

					$noticed_list = isset($this->settings['notice']) ? (array)$this->settings['notice'] : array();
					$notices = array();

					foreach ($noticed_list as $key => $value) {
						$notices[hash('md5', $value)] = $value;
					}

					if ($this->customer->isLogged()) {
						$customer_id = $this->customer->getId();
					} else {
						$this->load->model('account/order');

						$order_info = $this->model_account_order->getOrder($reminder_info['order_id']);

						if ($order_info) {
							$customer_id = $order_info['customer_id'];
						} else {
							$customer_id = 0;
						}
					}

					if (isset($this->request->get['review'])) {
						$this->request->post['review'] = (array)$this->request->get['review'];
						$this->request->server['REQUEST_METHOD'] = 'POST';
					}

					if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
						if ($products) {
							$review_ids = array();

							foreach ($this->request->post['review'] as $product_id => $review) {
								$this->request->post['customer_id'] = $customer_id;
								$this->request->post['author'] = $reminder_info['customer'];
								$this->request->post['store_id'] = $reminder_info['store_id'];
								$this->request->post['rating'] = $review['rating'];
								$this->request->post['text'] = $review['text'];
								$this->request->post['images'] = isset($review['images']) ? $review['images'] : array();

								if ($this->settings['type'] != 'product_single') {
									foreach ($products as $product) {
										$review_id = $this->module_model->addReview($product['product_id'], $this->request->post);

										if ($this->settings['approve_review_status'] && round(array_sum($this->request->post['rating']) / count($this->request->post['rating'])) >= $this->settings['approve_review_rating']) {
											$this->module_model->editReviewStatus(1, $review_id);
										}
									}
								} else {
									$review_id = $this->module_model->addReview($product_id, $this->request->post);

									if ($this->settings['approve_review_status'] && round(array_sum($this->request->post['rating']) / count($this->request->post['rating'])) >= $this->settings['approve_review_rating']) {
										$this->module_model->editReviewStatus(1, $review_id);
									}
								}

								$review_ids[] = $review_id;
							}

							if ($this->settings['coupon_status'] && !$reminder_info['coupon_id']) {
								$date_start = date("Y-m-d H:i:s");

								$post_data = array(
									'name'       => 'Review Booster #'. $reminder_info['email_id'],
									'discount'   => $this->settings['coupon_discount'],
									'type'       => ($this->settings['coupon_status'] == 'fixed') ? 'F' : 'P',
									'date_start' => $date_start,
									'date_end'   => date("Y-m-d H:i:s", strtotime("+" . (int)$this->settings['coupon_validity'] . " days", strtotime($date_start))),
								);

								$reminder_info['coupon_id'] = $this->module_model->addCoupon($post_data);
							}

							if (isset($this->request->post['noticed']) && isset($notices[$this->request->post['noticed']])) {
								$noticed = $notices[$this->request->post['noticed']];
							} else {
								$noticed = '';
							}

							$this->module_model->updateReminder($reminder_info['email_id'], $noticed, $reminder_info['coupon_id'], $review_ids, (isset($this->request->post['gdpr']) ? 1 : 0));

							$this->compatibility->redirect($this->compatibility->link($this->module_path, 'hash=' . $hash . '&code=' . $code));
						}
					}

					if (isset($this->error['rating'])) {
						$data['error_rating'] = $this->error['rating'];
					} else {
						$data['error_rating'] = array();
					}

					if (isset($this->error['review'])) {
						$data['error_review'] = $this->error['review'];
					} else {
						$data['error_review'] = array();
					}

					if (isset($this->error['gdpr'])) {
						$data['error_gdpr'] = $this->error['gdpr'];
					} else {
						$data['error_gdpr'] = '';
					}

					$data['action'] = $this->compatibility->link($this->module_path, 'hash=' .  $hash . '&code=' . $code);

					$data['text_gdpr'] = sprintf($this->language->get('text_gdpr'), $this->compatibility->link('information/information', 'information_id=' . $this->settings['gdpr_information_id']));

					if (file_exists(DIR_APPLICATION . 'extension/module/product_reviews.php')) {
						$data['apr_image_url'] = 'index.php?route=extension/module/product_reviews/upload';
					} else {
						$data['apr_image_url'] = 'index.php?route=product/allreviews/reviewimageupload';
					}

					$data['products'] = $products;
					$data['notices'] = $notices;

					if (isset($this->request->post['review'])) {
						$data['review'] = $this->request->post['review'];
						$data['images'] = array();

						foreach ($this->request->post['review'] as $product_id => $review) {
							if (isset($review['images'])) {
								foreach ((array)$review['images'] as $image) {
									if ($image) {
										$image = (strpos($image, 'product_review/') === false) ? 'product_review/review/' . $image : $image;

										if (is_file(DIR_IMAGE . $image)) {
											$data['images'][$product_id][] = array(
												'image' => $image,
												'thumb' => $this->model_tool_image->resize($image, 40, 40)
											);
										}
									}
								}
							}
						}
					} else {
						$data['review'] = array();
						$data['images'] = array();
					}

					if (isset($this->request->post['noticed'])) {
						$data['noticed'] = $this->request->post['noticed'];
					} else {
						$data['noticed'] = '';
					}

					if (isset($this->request->post['gdpr'])) {
						$data['gdpr'] = $this->request->post['gdpr'];
					} else {
						$data['gdpr'] = '';
					}
				}

				$colors = (array)$this->config->get('rb_colors');

				$data['color'] = $this->settings['star_custom'] ? '#' . $this->settings['star_custom'] : (isset($colors[$this->settings['star']]) ? $colors[$this->settings['star']]['hex'] : '#f7941d');
				$data['type'] = $this->settings['type'];
				$data['product_image_status'] = $this->settings['product_image_status'];
				$data['product_image_width'] = $this->settings['product_image_width'];
				$data['apr_image_status'] = $this->settings['apr_image_status'];
				$data['noticed_status'] = $this->settings['noticed_status'];
				$data['gdpr_status'] = $this->settings['gdpr_status'];

				$data['module_path'] = $this->module_path;

				foreach ($this->compatibility->getChildren() as $key => $child) {
					$data[$key] = ($key == 'header') ? $this->compatibility->jquery($child) : $child;
				}

				$this->response->setOutput($this->compatibility->view($this->module_path, $data));
			} else {
				$this->document->setTitle($this->language->get('text_error'));

				$data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_error'),
					'href'      => $this->compatibility->link($this->module_path, 'hash=' . $hash . '&code=' . $code),
					'separator' => ' &raquo; '
				);

				$data['heading_title'] = $this->language->get('text_error');

				$data['continue'] = $this->compatibility->link('common/home');

				$data['module_path'] = $this->module_path;

				$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

				foreach ($this->compatibility->getChildren() as $key => $child) {
					$data[$key] = ($key == 'header') ? $this->compatibility->jquery($child) : $child;
				}

				$this->response->setOutput($this->compatibility->view('error/not_found', $data));
			}
		}
	}

	public function unsubscribe() {
		if (isset($this->settings['status']) && $this->settings['status']) {
			if (isset($this->request->get['hash'])) {
				$hash = $this->request->get['hash'];
			} else {
				$hash = 0;
			}

			if (isset($this->request->get['code'])) {
				$code = $this->request->get['code'];
			} else {
				$code = 0;
			}

			$reminder_info = $this->module_model->getReminder($hash, $code);

			if ($reminder_info) {
				$data = array_merge(array(), $this->language_data);

				$this->document->setTitle($data['heading_unsubscribe_title']);

				$data['breadcrumbs'] = array();

				$data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_home'),
					'href'      => $this->compatibility->link('common/home'),
					'separator' => false
				);

				$data['breadcrumbs'][] = array(
					'text'      => $this->language->get('heading_unsubscribe_title'),
					'href'      => $this->compatibility->link($this->module_path . '/unsubscribe', 'hash=' . $hash . '&code=' . $code),
					'separator' => ' &raquo; '
				);

				$data['heading_title'] = $data['heading_unsubscribe_title'];

				$this->module_model->editNewsletterStatus(0, $reminder_info['customer_id']);

				$data['continue'] = $this->compatibility->link('common/home');

				$data['module_path'] = $this->module_path;

				foreach ($this->compatibility->getChildren() as $key => $child) {
					$data[$key] = ($key == 'header') ? $this->compatibility->jquery($child) : $child;
				}

				$this->response->setOutput($this->compatibility->view($this->module_path . '/unsubscribe', $data));
			} else {
				$this->compatibility->redirect($this->compatibility->link('common/home'));
			}
		} else {
			$this->compatibility->redirect($this->compatibility->link('common/home'));
		}
	}

	public function cron() {
		header('Access-Control-Allow-Origin: *');

		$orders = array();

		// manual
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if (isset($this->request->post['order_id'])) {
				$filter_data = array(
					'filter_store_id' => $this->config->get('config_store_id'),
					'filter_order_id' => $this->request->post['order_id'],
					'limit'           => 1
				);

				$orders = $this->module_model->getOrders($filter_data);
			}
		} else {
			// test message
			if (isset($this->request->get['test']) && $this->request->get['test'] == 1 && isset($this->request->get['email'])) {
				$filter_data = array(
					'filter_store_id' => $this->config->get('config_store_id'),
					'limit'           => 1
				);

				$this->setTestReminder(true);
			} else {// cron
				$filter_data = array(
					'filter_to'                     => $this->settings['to'],
					'filter_order_status'           => (isset($this->settings['order_status']) && $this->settings['order_status']) ? $this->settings['order_status'] : array(),
					'filter_customer_group_exclude' => (isset($this->settings['exclude_customer_group']) && $this->settings['exclude_customer_group']) ? $this->settings['exclude_customer_group'] : array(),
					'filter_store_id'               => $this->config->get('config_store_id'),
					'filter_after_day'              => $this->settings['day'],
					'filter_previous'               => $this->settings['previous'],
					'limit'                         => 20
				);
			}

			$orders = $this->module_model->getOrders($filter_data);
		}

		if ($orders) {
			$this->load->model('tool/image');

			$i = 0;

			foreach ($orders as $order_info) {
				if (!isset($this->settings['status']) || !$this->settings['status']) {
					echo'Module is disabled for ' . $order_info['store_name'] . '!';

					exit();
				}

				if ($this->test) {
					$order_info['email'] = $this->request->get['email'];
				}

				$order_info['email'] = trim($order_info['email']);

				if (!$order_info['email'] || !filter_var($order_info['email'], FILTER_VALIDATE_EMAIL)) {
					continue;
				}

				if (!$order_info['store_name']) {
					$order_info['store_name'] = $this->config->get('config_name');
				}

				if (!$order_info['store_url']) {
					$order_info['store_url'] = HTTP_SERVER;
				}

				if (substr($order_info['store_url'], -1) != '/') {
					$order_info['store_url'] .= '/';
				}

				if (!preg_match('#^http#i', $order_info['store_url'])) {
					$order_info['store_url'] = 'http://' . $order_info['store_url'];
				}

				$order_products = $this->module_model->getOrderProducts($order_info['order_id'], 0, $this->settings['product_limit']);

				if ($order_products) {
					$products = array();

					foreach ($order_products as $order_product) {
						if ($order_product['image']) {
							$image = $this->model_tool_image->resize($order_product['image'], $this->settings['product_image_width'], $this->settings['product_image_height']);
						} else {
							$image = $this->model_tool_image->resize($this->compatibility->getNoImage(), $this->settings['product_image_width'], $this->settings['product_image_height']);
						}

						$products[$order_product['product_id']] = array(
							'product_id' => $order_product['product_id'],
							'image'      => $image,
							'name'       => $order_product['name'],
							'href'       => $this->compatibility->link('product/product', 'product_id=' . (int)$order_product['product_id'])
						);
					}

					if ($this->settings['type'] == 'product') {
						foreach ($products as $product) {
							$hash = strtolower(md5($i . '_A' . uniqid(time(), true) . '_' . $order_info['order_id'] . $order_info['email'] . time()));
							$code = substr(hash('sha256', $hash), 0, 10);

							$this->send($order_info, $hash, $code, $this->getFormReview($order_info['language_id'], $hash, $code, $product, true), $this->getHtmlListProducts(array($product)), $product['product_id']);

							$i++;
						}
					} else {
						$hash = strtolower(md5($i . '_A' . uniqid(time(), true) . '_' . $order_info['order_id'] . $order_info['email'] . time()));
						$code = substr(hash('sha256', $hash), 0, 10);

						$form = '';
						$j = 0;

						foreach ($products as $product) {
							if ($this->settings['type'] == 'product_single') {
								$form .= $this->getFormReview($order_info['language_id'], $hash, $code, $product, (++$j == count($products) ? true : false));
							} else {
								$form = $this->getFormReview($order_info['language_id'], $hash, $code, array('all'), true);
							}
						}

						$this->send($order_info, $hash, $code, $form, $this->getHtmlListProducts($products));

						$i++;
					}

					if (!$this->test && $this->settings['new_order_status']) {
						$this->changeOrderStatus($order_info['order_id'], $this->settings['new_order_status'], '', ((isset($this->settings['notify']) && $this->settings['notify']) ? true : false));
					}
				}
			}

			echo"Success: Reminders have been sent!";

			exit();
		} else {
			echo'No orders to send reminders!';

			exit();
		}
	}

	private function send($order_info, $hash, $code, $form, $list, $product_id = 0) {
		$link = $this->compatibility->link($this->module_path, 'hash=' . $hash . '&code=' . $code);

		$find = array(
			'{firstname}',
			'{lastname}',
			'{order_id}',
			'{email}',
			'{date_order}',
			'{store_name}',
			'{list}',
			'{form}',
			'{link}',
			'{unsubscribe}'
		);

		$replace = array(
			'firstname'   => $order_info['firstname'],
			'lastname'    => $order_info['lastname'],
			'order_id'    => $order_info['order_id'],
			'email'       => $order_info['email'],
			'date_order'  => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
			'store_name'  => $order_info['store_name'],
			'list'        => $list,
			'form'        => '<form action="' . $order_info['store_url'] . '" method="get" accept-charset="UTF-8" target="_blank" id="form-review" style="border:0;margin:0;padding:0;"><input type="hidden" name="route" value="' . $this->module_path . '"><input type="hidden" name="hash" value="' . $hash . '"><input type="hidden" name="code" value="' . $code . '">' . $form . '</form>',
			'link'        => '<a href="' . $link . '">' . (isset($this->settings['link_text'][$order_info['language_id']]) ? $this->settings['link_text'][$order_info['language_id']] : $link) . '</a>',
			'unsubscribe' => $this->compatibility->link($this->module_path . '/unsubscribe', 'hash=' . $hash . '&code=' . $code)
		);

		if (isset($this->settings['email'][$order_info['language_id']]) && $this->settings['email'][$order_info['language_id']]) {
			$subject = str_replace($find, $replace, html_entity_decode($this->settings['email'][$order_info['language_id']]['subject'], ENT_QUOTES, 'UTF-8'));
			$message = str_replace($find, $replace, html_entity_decode($this->settings['email'][$order_info['language_id']]['description'], ENT_QUOTES, 'UTF-8'));
		} else {
			$subject = str_replace($find, $replace, html_entity_decode($this->settings['email'][(int)$this->config->get('config_language_id')]['subject'], ENT_QUOTES, 'UTF-8'));
			$message = str_replace($find, $replace, html_entity_decode($this->settings['email'][(int)$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8'));
		}

		$reviewBoosterMail = $this->compatibility->mail();
		$reviewBoosterMail->setFrom($order_info['owner_email']);
		$reviewBoosterMail->setSender(html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'));
		$reviewBoosterMail->setSubject($subject);
		$reviewBoosterMail->setHtml($this->compatibility->view($this->module_path . '/mail', array('template' => $message)));
		$reviewBoosterMail->setTo($order_info['email']);
		$reviewBoosterMail->send();

		$post_data = array(
			'email'         => $order_info['email'],
			'hash'          => $hash,
			'code'          => $code,
			'order_id'      => $order_info['order_id'],
			'store_id'      => $order_info['store_id'],
			'product_id'    => $product_id,
			'product_limit' => $this->settings['product_limit'],
			'test'          => $this->test ? 1 : 0
		);

		$this->module_model->addReminder($post_data);
	}

	private function getFormReview($language_id, $hash, $code, $product = array(), $last = false) {
		$link = str_replace('&amp;', '&', $this->compatibility->link($this->module_path, 'hash=' . $hash . '&code=' . $code));

		$this->load->model('localisation/language');

		$language_info = $this->model_localisation_language->getLanguage($language_id);

		if ($language_info) {
			$language_code = $language_info['code'];
			$language_directory = $language_info['directory'];
		} else {
			$language_code = '';
			$language_directory = '';
		}

		$language = new Language(version_compare(VERSION, '2.2', '<') ? $language_directory : $language_code);
		$language->load($this->module_path);

		$html = '<table border="0" cellpadding="5" cellspacing="0" style="width:100%;margin:0;padding:0;border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;mso-hide:all;">' . "\n";
		$html .= '  <tbody>' . "\n";

		if ($this->settings['type'] == 'product_single') {
			$html .= '<tr>' . "\n";
			$html .= '  <td valign="middle" style="padding:2px;">' . "\n";
			
			if ($this->settings['product_image_status']) {
				$html .= '<img src="' . $product['image'] . '" border="0" style="vertical-align:middle;border: 1px solid #dddddd;margin-left:10px;margin-right:10px;" />';
			}

			$html .= '  <b>' . $product['name'] . '</b></td>' . "\n";
			$html .= '</tr>' . "\n";
		}

		$html .= '<tr>' . "\n";
		$html .= '  <td align="center">' . "\n";
		$html .= '    <table border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;">' . "\n";

		$product_id = isset($product['product_id']) ? $product['product_id'] : $product[0];

		$ratings = array();

		if ($this->settings['apr_status']) {
			$this->load->model('catalog/review');

			$reflection = new ReflectionClass('ModelCatalogReview');

			if ($reflection->hasMethod('getRatings')) {
				foreach ($this->model_catalog_review->getRatings() as $rating) {
					$ratings[] = array(
						'rating_id' => $rating['rating_id'],
						'name'      => $rating['name']
					);
				}
			} elseif (file_exists(DIR_APPLICATION . 'extension/module/product_reviews.php') && $product_id != 'all') {
				$this->load->config('product_reviews');
				$this->load->model($this->config->get('pr_module_path'));

				foreach ($this->{$this->config->get('pr_module_model')}->getRatings($product_id) as $rating) {
					$ratings[] = array(
						'rating_id' => $rating['rating_id'],
						'name'      => $rating['name']
					);
				}
			}
		} else {
			$ratings[] = array(
				'rating_id' => '0',
				'name'      => $language->get('text_overall')
			);
		}

		$colors = (array)$this->config->get('rb_colors');
		$color = $this->settings['star_custom'] ? '#' . $this->settings['star_custom'] : (isset($colors[$this->settings['star']]) ? $colors[$this->settings['star']]['hex'] : '#f7941d');

		foreach ($ratings as $rating) {
			$html .= '<tr>' . "\n";
			$html .= '  <td style="text-align:center;">' . $rating['name'] . '<br />' . "\n";
			$html .= '    <span class="stars" style="display:inline-block">' . "\n";

			for ($j = 1; $j <= 5; $j++) {
				$html .= '  <span class="star" style="display:inline-block;float:left;margin-right:' . ($j == 5 ? '0' : '15') . 'px;color:' . $color . ';">' . "\n";
				$html .= '    <input type="radio" name="review[' . $product_id . '][rating][' . $rating['rating_id'] . ']" value="' . $j . '" ' . ($j == 5 ? 'checked' : '') . ' style="margin:0;margin-right:7px;padding:0;" id="review' . $product_id . '_' . $j . '" class="star_input" />' . "\n";
				$html .= '    <label for="review' . $product_id . '_' . $j . '" style="font-size:21px;line-height:1;">' . "\n";

				for ($k = 1; $k <= $j; $k++) {
					$html .= '★';
				}

				$html .= '    </label>' . "\n";
				$html .= '  </span>' . "\n";
			}

			$html .= '    </span>' . "\n";
			$html .= '  </td>' . "\n";
			$html .= '</tr>' . "\n";
		}

		$html .= '    </table>' . "\n";
		$html .= '  </td>' . "\n";
		$html .= '</tr>' . "\n";
		$html .= '<tr>' . "\n";
		$html .= '  <td>' . $language->get('entry_review') . '</td>' . "\n";
		$html .= '</tr>' . "\n";
		$html .= '<tr>' . "\n";
		$html .= '  <td>' . "\n";
		$html .= '    <textarea name="review[' . $product_id . '][text]" rows="5" style="width:100%;"></textarea>' . "\n";
		$html .= '  </td>' . "\n";
		$html .= '</tr>' . "\n";

		if ($this->settings['apr_image_status']) {
			$html .= '<tr>' . "\n";
			$html .= '  <td>' . $language->get('entry_image') . ' <a href="' . $link . '" style="display:inline-block;text-align:center;padding:3px 5px;cursor:pointer;font-weight:normal;font-size:12px;white-space:nowrap;background-color:#1e91cf;color:#fff;border:1px solid #1978ab;text-decoration:none;">' . $language->get('button_upload') . '</a></td>' . "\n";
			$html .= '</tr>' . "\n";
		}

		if ($last) {
			if ($this->settings['noticed_status']) {
				$html .= '<tr>' . "\n";
				$html .= '  <td>' . $language->get('entry_noticed') . ' <select name="review[' . $product_id . '][noticed]">';

				$noticed_list = isset($this->settings['notice']) ? (array)$this->settings['notice'] : array();

				foreach ($noticed_list as $noticed) {
					$html .= '  <option value="' . hash('md5', $noticed) . '">' . $noticed . '</option>';
				}

				$html .= '  </select></td>' . "\n";
				$html .= '</tr>' . "\n";
			}

			if ($this->settings['gdpr_status']) {
				$html .= '<tr>' . "\n";
				$html .= '  <td><input type="checkbox" name="review[' . $product_id . '][gdpr]" value="1" /> ' . sprintf($language->get('text_gdpr'), $this->compatibility->link('information/information', 'information_id=' . $this->settings['gdpr_information_id'])) . '</td>' . "\n";
				$html .= '</tr>' . "\n";
			}

			$html .= '<tr>' . "\n";
			$html .= '  <td align="right">' . "\n";
			$html .= '    <!--[if !IE]><!-->' . "\n";
			$html .= '    <button type="submit" style="display:inline-block;text-align:center;padding:6px 10px;cursor:pointer;font-weight:normal;white-space:nowrap;background-color:#1e91cf;color:#fff;border:1px solid #1978ab;">' . $language->get('button_submit') . '</button>' . "\n";
			$html .= '    <!--<![endif]-->' . "\n";
			$html .= '    <!--[if IE]>' . "\n";
			$html .= '    <a href="' . $link . '" style="display:inline-block;text-align:center;padding:6px 10px;cursor:pointer;font-weight:normal;white-space:nowrap;background-color:#1e91cf;color:#fff;border:1px solid #1978ab;">' . $language->get('button_submit') . '</a>' . "\n";
			$html .= '    <![endif]-->' . "\n";
			$html .= '  </td>' . "\n";
			$html .= '</tr>' . "\n";
		}

		$html .= '  </tbody>' . "\n";
		$html .= '</table>' . "\n";

		if (!$last && $this->settings['type'] == 'product_single') {
			$html .= '<hr style="margin0;padding:0;margin-top:17px;margin-bottom:17px;border:0;border-top:1px solid #eeeeee;" />' . "\n";
		}

		return $html;
	}

	private function getHtmlListProducts($products) {
		if ($this->settings['product_image_status'] && $this->settings['type'] != 'product_single') {
			$list = '<table border="0" cellpadding="0" cellspacing="0" style="width:100%;margin:0;padding:0;border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;">' . "\n";

			foreach ($products as $product) {
				$list .= '<tr>' . "\n";
				$list .= '  <td valign="middle" style="padding:2px;">' . "\n";
				$list .= '    <img src="' . $product['image'] . '" border="0" style="vertical-align:middle;border:1px solid #dddddd;margin-left:10px;margin-right:10px;" />' . "\n";
				$list .= '    <a href="' . $product['href'] . '">' . $product['name'] . '</a>' . "\n";
				$list .= '  </td>' . "\n";
				$list .= '</tr>' . "\n";
			}

			$list .= '</table>' . "\n";
		} else {
			$list = implode(', ', array_map(function($product) {
				return '<a href="' . $product['href'] . '">' . $product['name'] . '</a>';
			}, $products));
		}

		return $list;
	}

	private function changeOrderStatus($order_id, $order_status_id, $comment = '', $notify = false) {
		$this->load->model('checkout/order');

		if (version_compare(VERSION, '2.0', '<')) {
			$this->model_checkout_order->update($order_id, $order_status_id, $comment, $notify);
		} else {
			$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $comment, $notify);
		}
	}

	private function setTestReminder($status) {
		$this->test = $status;
	}

	protected function validate() {
		$this->load->model('catalog/review');

		foreach ($this->request->post['review'] as $product_id => $review) {
			if (isset($review['rating'])) {
				$empty = array_filter($review['rating']);

				$total = 1;

				if ($this->settings['apr_status']) {
					$this->load->model('catalog/review');

					$reflection = new ReflectionClass('ModelCatalogReview');

					if ($reflection->hasMethod('getRatings')) {
						$total = count($this->model_catalog_review->getRatings());
					} elseif (file_exists(DIR_APPLICATION . 'extension/module/product_reviews.php') && $product_id != 'all') {
						$this->load->config('product_reviews');
						$this->load->model($this->config->get('pr_module_path'));

						$total = count($this->{$this->config->get('pr_module_model')}->getRatings($product_id));
					}
				}

				if (empty($review['rating']) || count($empty) != $total) {
					$this->error['rating'][$product_id] = $this->language->get('error_rating');
				}
			} else {
				$this->error['rating'][$product_id] = $this->language->get('error_rating');
			}

			if ((utf8_strlen($review['text']) < 15) || (utf8_strlen($review['text']) > 1000)) {
				$this->error['review'][$product_id] = $this->language->get('error_review');
			}
		}

		if ($this->settings['gdpr_status']) {
			if (!isset($this->request->post['gdpr'])) {
				$this->error['gdpr'] = $this->language->get('error_gdpr');
			}
		}

		return (!$this->error) ? true : false;
	}
}