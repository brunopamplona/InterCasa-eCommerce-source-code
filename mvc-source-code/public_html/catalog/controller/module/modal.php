<?php
class ControllerModuleModal extends Controller
{
	public function index()
	{
		if (!isset($this->session->data['popupfb'])):
			$facebook = $this->config->get('facebooklogin_module');
			$facebook = array_shift($facebook);
			$facebook = $this->getChild('module/facebooklogin', $facebook);

			$this->data['facebook'] = $facebook;

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/modal.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/modal.tpl';
			} else {
				$this->template = 'default/template/module/modal.tpl';
			}

			$this->session->data['popupfb'] = TRUE;

			$this->render();
		endif;
	}
}