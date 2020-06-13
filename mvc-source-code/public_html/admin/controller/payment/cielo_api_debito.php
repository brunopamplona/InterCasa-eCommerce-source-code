<?php
class ControllerPaymentCieloApiDebito extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('payment/cielo_api_debito');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('cielo_api_debito', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            if ($this->request->post['save_stay'] == '1') {
                $this->redirect($this->url->link('payment/cielo_api_debito', 'token=' . $this->session->data['token'], 'SSL'));
            } else {
                $this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
            }
        }

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_edit'] = $this->language->get('text_edit');
        $this->data['text_image_manager'] = $this->language->get('text_image_manager');
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_all_zones'] = $this->language->get('text_all_zones');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');
        $this->data['text_browse'] = $this->language->get('text_browse');
        $this->data['text_clear'] = $this->language->get('text_clear');
        $this->data['text_sandbox'] = $this->language->get('text_sandbox');
        $this->data['text_homologacao'] = $this->language->get('text_homologacao');
        $this->data['text_producao'] = $this->language->get('text_producao');
        $this->data['text_botao'] = $this->language->get('text_botao');
        $this->data['text_texto'] = $this->language->get('text_texto');
        $this->data['text_fundo'] = $this->language->get('text_fundo');
        $this->data['text_borda'] = $this->language->get('text_borda');

        $this->data['tab_geral'] = $this->language->get('tab_geral');
        $this->data['tab_api'] = $this->language->get('tab_api');
        $this->data['tab_situacoes_pedido'] = $this->language->get('tab_situacoes_pedido');
        $this->data['tab_finalizacao'] = $this->language->get('tab_finalizacao');

        $this->data['entry_chave'] = $this->language->get('entry_chave');
        $this->data['entry_total'] = $this->language->get('entry_total');
        $this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $this->data['entry_merchantid'] = $this->language->get('entry_merchantid');
        $this->data['entry_merchantkey'] = $this->language->get('entry_merchantkey');
        $this->data['entry_soft_descriptor'] = $this->language->get('entry_soft_descriptor');
        $this->data['entry_ambiente'] = $this->language->get('entry_ambiente');
        $this->data['entry_debug'] = $this->language->get('entry_debug');
        $this->data['entry_visa'] = $this->language->get('entry_visa');
        $this->data['entry_mastercard'] = $this->language->get('entry_mastercard');
        $this->data['entry_situacao_pendente'] = $this->language->get('entry_situacao_pendente');
        $this->data['entry_situacao_autorizada'] = $this->language->get('entry_situacao_autorizada');
        $this->data['entry_situacao_nao_autorizada'] = $this->language->get('entry_situacao_nao_autorizada');
        $this->data['entry_situacao_capturada'] = $this->language->get('entry_situacao_capturada');
        $this->data['entry_situacao_cancelada'] = $this->language->get('entry_situacao_cancelada');
        $this->data['entry_titulo'] = $this->language->get('entry_titulo');
        $this->data['entry_imagem'] = $this->language->get('entry_imagem');
        $this->data['entry_botao_normal'] = $this->language->get('entry_botao_normal');
        $this->data['entry_botao_efeito'] = $this->language->get('entry_botao_efeito');

        $this->data['button_save_stay'] = $this->language->get('button_save_stay');
        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['token'] = $this->session->data['token'];

        $erros = array(
            'warning',
            'chave',
            'merchantid',
            'merchantkey',
            'soft_descriptor',
            'titulo'
        );

        foreach ($erros as $erro) {
            if (isset($this->error[$erro])) {
                $this->data['error_'.$erro] = $this->error[$erro];
            } else {
                $this->data['error_'.$erro] = '';
            }
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_payment'),
            'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('payment/cielo_api_debito', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('payment/cielo_api_debito', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        include_once(DIR_SYSTEM . 'library/cielo_api/versao.php');

        $this->data['error_readable'] = $this->language->get('error_readable');

        $this->data['arquivos'] = array();

        $arquivos = array(
            'cielo'
        );

        foreach ($arquivos as $arquivo) {
            if (!is_file(DIR_SYSTEM . 'library/cielo_api/'.$arquivo.'.php')) {
                $this->data['arquivos'][] = 'system/library/cielo_api/<strong>'.$arquivo.'.php</strong>';
            }
        }

        $this->document->addScript('view/javascript/jquery/jscolor/jscolor.min.js');

        $campos = array(
            'chave' => '',
            'total' => '',
            'lojas' => array(0),
            'geo_zone_id' => '',
            'status' => '',
            'sort_order' => '',
            'merchantid' => '',
            'merchantkey' => '',
            'soft_descriptor' => '',
            'ambiente' => '',
            'debug' => '',
            'visa' => '',
            'mastercard' => '',
            'situacao_pendente_id' => '',
            'situacao_autorizada_id' => '',
            'situacao_nao_autorizada_id' => '',
            'situacao_capturada_id' => '',
            'situacao_cancelada_id' => '',
            'titulo' => '',
            'imagem' => '',
            'cor_normal_texto' => '#FFFFFF',
            'cor_normal_fundo' => '#33b0f0',
            'cor_normal_borda' => '#33b0f0',
            'cor_efeito_texto' => '#FFFFFF',
            'cor_efeito_fundo' => '#0487b0',
            'cor_efeito_borda' => '#0487b0'
        );

        foreach ($campos as $campo => $valor) {
            if (!empty($valor)) {
                if (isset($this->request->post['cielo_api_debito_'.$campo])) {
                    $this->data['cielo_api_debito_'.$campo] = $this->request->post['cielo_api_debito_'.$campo];
                } else if ($this->config->get('cielo_api_debito_'.$campo)) {
                    $this->data['cielo_api_debito_'.$campo] = $this->config->get('cielo_api_debito_'.$campo);
                } else {
                    $this->data['cielo_api_debito_'.$campo] = $valor;
                }
            } else {
                if (isset($this->request->post['cielo_api_debito_'.$campo])) {
                    $this->data['cielo_api_debito_'.$campo] = $this->request->post['cielo_api_debito_'.$campo];
                } else {
                    $this->data['cielo_api_debito_'.$campo] = $this->config->get('cielo_api_debito_'.$campo);
                }
            }
        }

        $this->load->model('localisation/geo_zone');
        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        $this->load->model('localisation/order_status');
        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();        

        $this->load->model('tool/image');
        if (isset($this->request->post['cielo_api_debito_imagem']) && is_file(DIR_IMAGE . $this->request->post['cielo_api_debito_imagem'])) {
            $this->data['thumb'] = $this->model_tool_image->resize($this->request->post['cielo_api_debito_imagem'], 100, 100);
        } elseif (is_file(DIR_IMAGE . $this->config->get('cielo_api_debito_imagem'))) {
            $this->data['thumb'] = $this->model_tool_image->resize($this->config->get('cielo_api_debito_imagem'), 100, 100);
        } else {
            $this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
        }
        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

        $this->update();

        $this->template = 'payment/cielo_api_debito.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function imageLogo() {
        $this->load->model('tool/image');

        if (isset($this->request->get['image'])) {
            $this->response->setOutput($this->model_tool_image->resize(html_entity_decode($this->request->get['image'], ENT_QUOTES, 'UTF-8'), 100, 100));
        }
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'payment/cielo_api_debito')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $erros = array(
            'chave',
            'titulo'
        );

        foreach ($erros as $erro) {
            if (!(trim($this->request->post['cielo_api_debito_'.$erro]))) {
                $this->error[$erro] = $this->language->get('error_'.$erro);
            }
        }

        if (strlen($this->request->post['cielo_api_debito_merchantid']) != 36) {
            $this->error['merchantid'] = $this->language->get('error_merchantid');
        }

        if (strlen($this->request->post['cielo_api_debito_merchantkey']) != 40) {
            $this->error['merchantkey'] = $this->language->get('error_merchantkey');
        }

        if (strlen($this->request->post['cielo_api_debito_soft_descriptor']) <= 13) {
            if (!preg_match('/^[A-Z0-9]+$/', $this->request->post['cielo_api_debito_soft_descriptor'])) {
                $this->error['soft_descriptor'] = $this->language->get('error_soft_descriptor');
            }
        } else {
            $this->error['soft_descriptor'] = $this->language->get('error_soft_descriptor');
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function install(){
        $this->load->model('payment/cielo_api');
        $this->model_payment_cielo_api->install();
    }

    public function uninstall() {
        $this->load->model('payment/cielo_api');
        $this->model_payment_cielo_api->uninstall();
    }

    public function update() {
        $this->load->model('payment/cielo_api');
        $this->model_payment_cielo_api->updateTable();
    }
}
?>