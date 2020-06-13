<?php
class ControllerExtensionModuleReviewBox extends Controller {
	public function index($setting) {
		$data['objConfig'] = $this->config;

		$this->language->load('module/review_box');

      	$data['heading_title'] = (isset($setting['header'][$this->config->get('config_language_id')])) ? $setting['header'][$this->config->get('config_language_id')] : $this->language->get('heading_title');

		$data['button_view'] = $this->language->get('button_view');

		$data['reviews'] = array();

		$this->load->model('catalog/review');

		$limit = ($setting['limit']) ? $setting['limit'] : 5;

		$filter_data = array(
			'type'        => ($setting['type'] == 'random') ? 'random' : '',
			'language_id' => ($this->config->get('product_reviews_status') && $this->config->get('product_reviews_language_status')) ? (int)$this->config->get('config_language_id') : false,
			'start'       => 0,
			'order'       => ($setting['type'] == 'random') ? '' : 'DESC',
			'limit'       => $limit
		);

		$results = $this->model_catalog_review->getAllReviews($filter_data);

		foreach ($results as $result) {
			$data['reviews'][] = array(
				'review_id'   => $result['review_id'],
				'text'   	  => (utf8_strlen($result['text']) > 90) ? utf8_substr($result['text'], 0, 80) . '...' : $result['text'],
				'author'      => $result['author'],
				'date'   	  => sprintf($this->language->get('text_date'), date($this->language->get('date_format_short'), strtotime($result['date_added']))),
				'rating'      => $result['rating']
			);
		}

		$data['button'] = $setting['button'];
		$data['all'] = $this->url->link('product/allreviews');

		if (version_compare(VERSION, '2.0') < 0) {
			$this->data = $data;

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/review_box.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/review_box.tpl';
			} else {
				$this->template = 'default/template/module/review_box.tpl';
			}

			$this->render();
		} elseif (version_compare(VERSION, '2.2') < 0) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/review_box.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/review_box.tpl', $data);
			} else {
				return $this->load->view('default/template/module/review_box.tpl', $data);
			}
		} else {
			return $this->load->view('module/review_box', $data);
		}
	}
}
?>