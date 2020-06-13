<?php
class ControllerSaleCieloApiLog extends Controller { 
    private $error = array();

    public function index() {
        $this->language->load('sale/cielo_api_log');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['button_clear'] = $this->language->get('button_clear');

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),               
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/cielo_api_log', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['clear'] = $this->url->link('sale/cielo_api_log/clear', 'token=' . $this->session->data['token'], 'SSL');

        $file = DIR_LOGS . 'cielo_api.log';

        if (file_exists($file)) {
            $this->data['log'] = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
        } else {
            $this->data['log'] = '';
        }

        $this->template = 'sale/cielo_api_log.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function clear() {
        $this->language->load('sale/cielo_api_log');

        $file = DIR_LOGS . 'cielo_api.log';

        $handle = fopen($file, 'w+');

        fclose($handle);

        $this->session->data['success'] = $this->language->get('text_success');

        $this->redirect($this->url->link('sale/cielo_api_log', 'token=' . $this->session->data['token'], 'SSL'));
    }
}
?>