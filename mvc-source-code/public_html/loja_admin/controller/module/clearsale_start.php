<?php
class ControllerModuleClearsaleStart extends Controller {
    private $error = array();

    public function index() {
        $data = $this->load->language('module/clearsale_start');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('clearsale_start', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            if (isset($this->request->post['save_stay']) && ($this->request->post['save_stay'] = 1)) {
                $this->response->redirect($this->url->link('module/clearsale_start', 'token=' . $this->session->data['token'], true));
            } else {
                $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));
            }
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $erros = array(
            'warning',
            'orders_status',
            'codigo',
            'razao',
            'cnpj',
            'cpf',
            'nascimento',
            'numero_fatura',
            'numero_entrega',
            'complemento_fatura',
            'complemento_entrega'
        );

        foreach ($erros as $erro) {
            if (isset($this->error[$erro])) {
                $data['error_'.$erro] = $this->error[$erro];
            } else {
                $data['error_'.$erro] = '';
            }
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/clearsale_start', 'token=' . $this->session->data['token'], true)
        );

        $data['token'] = $this->session->data['token'];

        $data['versao'] = '2.0.5';

        $campos = array(
            'orders_status' => array(0),
            'metodo' => '',
            'status' => '',
            'codigo' => '',
            'ambiente' => '',
            'cartao_credito' => '',
            'boleto' => '',
            'sedex_cobrar' => '',
            'cheque' => '',
            'financiamento' => '',
            'fatura' => '',
            'multicheque' => '',
            'outros' => '',
            'custom_razao_id' => '',
            'razao_coluna' => '',
            'custom_cnpj_id' => '',
            'cnpj_coluna' => '',
            'custom_cpf_id' => '',
            'cpf_coluna' => '',
            'custom_nascimento_id' => '',
            'nascimento_coluna' => '',
            'custom_numero_id' => '',
            'numero_fatura_coluna' => '',
            'numero_entrega_coluna' => '',
            'custom_complemento_id' => '',
            'complemento_fatura_coluna' => '',
            'complemento_entrega_coluna' => '',
            'cartao_tabela' => '',
            'cartao_coluna_order_id' => '',
            'cartao_coluna_parcelas' => '',
            'cartao_coluna_valor' => ''
        );

        foreach ($campos as $campo => $valor) {
            if (!empty($valor)) {
                if (isset($this->request->post['clearsale_start_'.$campo])) {
                    $data['clearsale_start_'.$campo] = $this->request->post['clearsale_start_'.$campo];
                } else if ($this->config->get('clearsale_start_'.$campo)) {
                    $data['clearsale_start_'.$campo] = $this->config->get('clearsale_start_'.$campo);
                } else {
                    $data['clearsale_start_'.$campo] = $valor;
                }
            } else {
                if (isset($this->request->post['clearsale_start_'.$campo])) {
                    $data['clearsale_start_'.$campo] = $this->request->post['clearsale_start_'.$campo];
                } else {
                    $data['clearsale_start_'.$campo] = $this->config->get('clearsale_start_'.$campo);
                }
            }
        }

        $this->load->model('module/clearsale_start');

        $data['tables'] = $this->model_module_clearsale_start->getTables();

        $data['columns'] = $this->model_module_clearsale_start->getOrderColumns();

        $this->load->model('extension/extension');
        $payments = $this->model_extension_extension->getInstalled('payment');
        foreach ($payments as $key => $code) {
            $this->load->language('payment/' . $code);
            $data['payments'][] = array(
                'name' => $this->language->get('heading_title'),
                'code' => $code
            );
        }

        $this->load->model('localisation/order_status');
        $data['orders_status'] = $this->model_localisation_order_status->getOrderStatuses();

        $data['custom_fields'] = array();
        $this->load->model('sale/custom_field');
        $custom_fields = $this->model_sale_custom_field->getCustomFields();
        foreach ($custom_fields as $custom_field) {
            $data['custom_fields'][] = array(
                'custom_field_id' => $custom_field['custom_field_id'],
                'name' => $custom_field['name'],
                'type' => $custom_field['type'],
                'location' => $custom_field['location']
            );
        }

        $data['action'] = $this->url->link('module/clearsale_start', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], true);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/clearsale_start.tpl', $data));
    }

    public function columns() {
        $json = array();

        if ($this->user->hasPermission('modify', 'module/clearsale_start')) {
            if (isset($this->request->get['table']) && !empty($this->request->get['table'])) {
                $table = $this->request->get['table'];

                $this->load->model('module/clearsale_start');
                $json = $this->model_module_clearsale_start->getColumns($table);
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/clearsale_start')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (empty($this->request->post['clearsale_start_orders_status'])) {
            $this->error['orders_status'] = $this->language->get('error_orders_status');
        }

        $erros = array(
            'codigo'
        );

        foreach ($erros as $erro) {
            if (!(trim($this->request->post['clearsale_start_'.$erro]))) {
                $this->error[$erro] = $this->language->get('error_'.$erro);
            }
        }

        $erros_campos = array(
            'razao',
            'cnpj',
            'nascimento',
            'cpf'
        );

        foreach ($erros_campos as $erro) {
            if ($this->request->post['clearsale_start_custom_'.$erro.'_id'] == 'N') {
                if (!(trim($this->request->post['clearsale_start_'.$erro.'_coluna']))) {
                    $this->error[$erro] = $this->language->get('error_coluna');
                }
            }
        }

        $erros_campos_numero = array(
            'numero_fatura',
            'numero_entrega'
        );

        if ($this->request->post['clearsale_start_custom_numero_id'] == 'N') {
            foreach ($erros_campos_numero as $erro) {
                if (!(trim($this->request->post['clearsale_start_'.$erro.'_coluna']))) {
                    $this->error[$erro] = $this->language->get('error_coluna');
                }
            }
        }

        $erros_campos_complemento = array(
            'complemento_fatura',
            'complemento_entrega'
        );

        if ($this->request->post['clearsale_start_custom_complemento_id'] == 'N') {
            foreach ($erros_campos_complemento as $erro) {
                if (!(trim($this->request->post['clearsale_start_'.$erro.'_coluna']))) {
                    $this->error[$erro] = $this->language->get('error_coluna');
                }
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }
}