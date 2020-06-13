<?php
class ControllerModuleReviewBox extends Controller {
	private $error = array();
	
	public function index() {   
		$data = array_merge(array(), $this->language->load('module/review_box'));

		if (version_compare(VERSION, '2.0') < 0) {
			$this->document->addStyle('view/javascript/AdvancedProductReviews/font-awesome/css/font-awesome.min.css');
			$this->document->addScript('view/javascript/AdvancedProductReviews/bootstrap/js/bootstrap.min.js');
			$this->document->addScript('view/javascript/AdvancedProductReviews/compatibility.js');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/bootstrap/css/bootstrap.css');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/compatibility.css');
		}
		
		$this->document->addStyle('view/javascript/AdvancedProductReviews/module.css');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');

		if (file_exists(DIR_APPLICATION . 'model/extension/module.php')) {
			$this->load->model('extension/module');
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (version_compare(VERSION, '2.0.1') < 0) {
				$this->model_setting_setting->editSetting('review_box', $this->request->post);
			} else {
				$setting = array();

				foreach ($this->request->post['review_box_module'][0] as $key => $value) {
					$setting[$key] = $value;
				}

				if (!isset($this->request->get['module_id'])) {
					$this->model_extension_module->addModule('review_box', $setting);
				} else {
					$this->model_extension_module->editModule($this->request->get['module_id'], $setting);
				}
			}

			$this->session->data['success'] = $this->language->get('text_success');

			if (version_compare(VERSION, '2.3') < 0) {
				$this->redirectTo('extension/module');
			} else {
				$this->redirectTo('extension/extension');
			}
		}

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

		if (isset($this->error['header'])) {
			$data['error_header'] = $this->error['header'];
		} else {
			$data['error_header'] = array();
		}

  		$data['breadcrumbs'] = array();

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/review_box', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/review_box', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		if (version_compare(VERSION, '2.3') < 0) {
			$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');
		}

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}

		$data['modules'] = array();

		if (isset($this->request->post['review_box_module'])) {
			$data['modules'] = $this->request->post['review_box_module'];
		} elseif (isset($module_info) && $module_info) {
			$data['modules'] = $module_info;
		} elseif ($this->config->get('review_box_module')) { 
			$data['modules'] = $this->config->get('review_box_module');
		}

		$this->load->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (version_compare(VERSION, '2.0') < 0) {
			$data['column_left'] = '';
			$this->data = $data;

			$this->template = 'module/review_box.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
			);

			$this->response->setOutput($this->render());
		} else {
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('module/review_box.tpl', $data));
		}
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/review_box')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (isset($this->request->post['review_box_module'])) {
			foreach ($this->request->post['review_box_module'] as $key => $value) {
				foreach ($value as $key2 => $value2) {
					if ($key2 == 'name') {
						if ((utf8_strlen($value2) < 3) || (utf8_strlen($value2) > 64)) {
							$this->error['name'] = $this->language->get('error_name');
						}
					}

					if ($key2 == 'header') {
						foreach ($value2 as $language_id => $title) {
							if (utf8_strlen($title) < 2) {
								$this->error['header'][$key] = $this->language->get('error_header');
							}
						}
					}
				}
			}
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
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