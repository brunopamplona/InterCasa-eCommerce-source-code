<?php
class ControllerSaleCieloApiSearch extends Controller {
    private $error = array();

    public function index() {
        $this->language->load('sale/cielo_api_search');

        $this->document->setTitle($this->language->get('heading_title'));

        if (isset($this->request->get['filter_order_id'])) {
            $filter_order_id = $this->request->get['filter_order_id'];
        } else {
            $filter_order_id = null;
        }

        if (isset($this->request->get['filter_dataPedido'])) {
            $filter_dataPedido = $this->request->get['filter_dataPedido'];
        } else {
            $filter_dataPedido = null;
        }

        if (isset($this->request->get['filter_customer'])) {
            $filter_customer = $this->request->get['filter_customer'];
        } else {
            $filter_customer = null;
        }

        if (isset($this->request->get['filter_tid'])) {
            $filter_tid = $this->request->get['filter_tid'];
        } else {
            $filter_tid = null;
        }

        if (isset($this->request->get['filter_nsu'])) {
            $filter_nsu = $this->request->get['filter_nsu'];
        } else {
            $filter_nsu = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'oc.order_id';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_order_id'])) {
            $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }

        if (isset($this->request->get['filter_dataPedido'])) {
            $url .= '&filter_dataPedido=' . $this->request->get['filter_dataPedido'];
        }

        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_tid'])) {
            $url .= '&filter_tid=' . $this->request->get['filter_tid'];
        }

        if (isset($this->request->get['filter_nsu'])) {
            $url .= '&filter_nsu=' . $this->request->get['filter_nsu'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/cielo_api_search', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $data = array(
            'filter_order_id' => $filter_order_id,
            'filter_dataPedido' => $filter_dataPedido,
            'filter_customer' => $filter_customer,
            'filter_tid' => $filter_tid,
            'filter_nsu' => $filter_nsu,
            'filter_status' => $filter_status,
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );

        $this->load->model('payment/cielo_api');

        $transactions_total = $this->model_payment_cielo_api->getTotalTransactions($data);

        $results = $this->model_payment_cielo_api->getTransactions($data);

        $this->data['transactions'] = array();

        foreach ($results as $result) {
            switch ($result['status']) {
                case '0':
                    $status = $this->language->get('text_nao_finalizada');
                    break;
                case '1':
                    $status = $this->language->get('text_autorizada');
                    break;
                case '2':
                    $status = $this->language->get('text_capturada');
                    break;
                case '3':
                    $status = $this->language->get('text_negada');
                    break;
                case '10':
                    $status = $this->language->get('text_cancelada');
                    break;
                case '11':
                    $status = $this->language->get('text_estornada');
                    break;
                case '12':
                    $status = $this->language->get('text_pendente');
                    break;
                case '13':
                    $status = $this->language->get('text_abortada');
                    break;
            }

            $this->data['transactions'][] = array(
                'order_cielo_api_id' => $result['order_cielo_api_id'],
                'order_id' => $result['order_id'],
                'dataPedido' => date('d/m/Y H:i:s', strtotime($result['dataPedido'])),
                'customer' => $result['customer'],
                'bandeira' => $result['bandeira'],
                'parcelas' => $result['parcelas'],
                'operacao' => ($result['tipo'] == 'DebitCard') ? $this->language->get('text_debito') : $this->language->get('text_credito'),
                'tid' => $result['tid'],
                'nsu' => $result['nsu'],
                'dataAutorizado' => (!empty($result['autorizacaoData'])) ? date('d/m/Y H:i:s', strtotime($result['autorizacaoData'])) : '',
                'valorAutorizado' => (!empty($result['autorizacaoValor'])) ? $this->currency->format(($result['autorizacaoValor'] / 100), $this->config->get('config_currency'), '1.00', true) : '',
                'dataCapturado' => (!empty($result['capturaData'])) ? date('d/m/Y H:i:s', strtotime($result['capturaData'])) : '',
                'valorCapturado' => (!empty($result['capturaValor'])) ? $this->currency->format(($result['capturaValor'] / 100), $this->config->get('config_currency'), '1.00', true) : '',
                'dataCancelado' => (!empty($result['cancelaData'])) ? date('d/m/Y H:i:s', strtotime($result['cancelaData'])) : '',
                'valorCancelado' => (!empty($result['cancelaValor'])) ? $this->currency->format(($result['cancelaValor'] / 100), $this->config->get('config_currency'), '1.00', true) : '',
                'status' => $status,
                'view_order' => $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL'),
                'view_transaction' => $this->url->link('sale/cielo_api_search/info', 'token=' . $this->session->data['token'] . '&cielo_api_id=' . $result['order_cielo_api_id'], 'SSL')
            );
        }

        $this->data['situacoes'] = array (
            '0' => $this->language->get('text_nao_finalizada'),
            '1' => $this->language->get('text_autorizada'),
            '2' => $this->language->get('text_capturada'),
            '3' => $this->language->get('text_negada'),
            '10' => $this->language->get('text_cancelada'),
            '11' => $this->language->get('text_estornada'),
            '12' => $this->language->get('text_pendente'),
            '13' => $this->language->get('text_abortada')
        );

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_list'] = $this->language->get('text_list');
        $this->data['text_no_results'] = $this->language->get('text_no_results');
        $this->data['text_todas'] = $this->language->get('text_todas');

        $this->data['column_order_id'] = $this->language->get('column_order_id');
        $this->data['column_dataPedido'] = $this->language->get('column_dataPedido');
        $this->data['column_customer'] = $this->language->get('column_customer');
        $this->data['column_bandeira'] = $this->language->get('column_bandeira');
        $this->data['column_parcelas'] = $this->language->get('column_parcelas');
        $this->data['column_tid'] = $this->language->get('column_tid');
        $this->data['column_nsu'] = $this->language->get('column_nsu');
        $this->data['column_autorizada'] = $this->language->get('column_autorizada');
        $this->data['column_capturada'] = $this->language->get('column_capturada');
        $this->data['column_cancelada'] = $this->language->get('column_cancelada');
        $this->data['column_status'] = $this->language->get('column_status');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['button_filter'] = $this->language->get('button_filter');
        $this->data['button_info'] = $this->language->get('button_info');

        $this->data['token'] = $this->session->data['token'];

        $url = '';

        if (isset($this->request->get['filter_order_id'])) {
            $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }

        if (isset($this->request->get['filter_dataPedido'])) {
            $url .= '&filter_dataPedido=' . $this->request->get['filter_dataPedido'];
        }

        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_tid'])) {
            $url .= '&filter_tid=' . $this->request->get['filter_tid'];
        }

        if (isset($this->request->get['filter_nsu'])) {
            $url .= '&filter_nsu=' . $this->request->get['filter_nsu'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['sort_order'] = $this->url->link('sale/cielo_api_search', 'token=' . $this->session->data['token'] . '&sort=oc.order_id' . $url, 'SSL');
        $this->data['sort_dataPedido'] = $this->url->link('sale/cielo_api_search', 'token=' . $this->session->data['token'] . '&sort=oc.dataPedido' . $url, 'SSL');
        $this->data['sort_customer'] = $this->url->link('sale/cielo_api_search', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
        $this->data['sort_status'] = $this->url->link('sale/cielo_api_search', 'token=' . $this->session->data['token'] . '&sort=oc.status' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['filter_order_id'])) {
            $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }

        if (isset($this->request->get['filter_dataPedido'])) {
            $url .= '&filter_dataPedido=' . $this->request->get['filter_dataPedido'];
        }

        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_tid'])) {
            $url .= '&filter_tid=' . $this->request->get['filter_tid'];
        }

        if (isset($this->request->get['filter_nsu'])) {
            $url .= '&filter_nsu=' . $this->request->get['filter_nsu'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $transactions_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('sale/cielo_api_search', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['filter_order_id'] = $filter_order_id;
        $this->data['filter_dataPedido'] = $filter_dataPedido;
        $this->data['filter_customer'] = $filter_customer;
        $this->data['filter_tid'] = $filter_tid;
        $this->data['filter_nsu'] = $filter_nsu;
        $this->data['filter_status'] = $filter_status;

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;

        $this->template = 'sale/cielo_api_search.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function info() {
        if (isset($this->request->get['cielo_api_id'])) {
            $order_cielo_api_id = $this->request->get['cielo_api_id'];
        } else {
            $order_cielo_api_id = 0;
        }

        $this->load->model('payment/cielo_api');
        $transaction_info = $this->model_payment_cielo_api->getTransaction($order_cielo_api_id);

        if ($transaction_info) {
            $order_id = $transaction_info['order_id'];

            $this->load->model('sale/order');
            $order_info = $this->model_sale_order->getOrder($order_id);

            $this->load->language('sale/cielo_api_info');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->data['heading_title'] = $this->language->get('heading_title');

            $this->data['text_edit'] = $this->language->get('text_edit');
            $this->data['text_consultando'] = $this->language->get('text_consultando');
            $this->data['text_cancelando'] = $this->language->get('text_cancelando');
            $this->data['text_capturando'] = $this->language->get('text_capturando');
            $this->data['text_atualizando'] = $this->language->get('text_atualizando');

            $this->data['tab_details'] = $this->language->get('tab_details');
            $this->data['tab_json'] = $this->language->get('tab_json');

            $this->data['button_search'] = $this->language->get('button_search');
            $this->data['button_capturar'] = $this->language->get('button_capturar');
            $this->data['button_cancelar'] = $this->language->get('button_cancelar');
            $this->data['button_consultar'] = $this->language->get('button_consultar');

            $this->data['entry_order_id'] = $this->language->get('entry_order_id');
            $this->data['entry_added'] = $this->language->get('entry_added');
            $this->data['entry_total'] = $this->language->get('entry_total');
            $this->data['entry_customer'] = $this->language->get('entry_customer');
            $this->data['entry_cielo_api_id'] = $this->language->get('entry_cielo_api_id');
            $this->data['entry_tid'] = $this->language->get('entry_tid');
            $this->data['entry_nsu'] = $this->language->get('entry_nsu');
            $this->data['entry_bandeira'] = $this->language->get('entry_bandeira');
            $this->data['entry_parcelamento'] = $this->language->get('entry_parcelamento');
            $this->data['entry_autorizacao'] = $this->language->get('entry_autorizacao');
            $this->data['entry_valor_autorizado'] = $this->language->get('entry_valor_autorizado');
            $this->data['entry_captura'] = $this->language->get('entry_captura');
            $this->data['entry_valor_capturado'] = $this->language->get('entry_valor_capturado');
            $this->data['entry_cancelamento'] = $this->language->get('entry_cancelamento');
            $this->data['entry_valor_cancelado'] = $this->language->get('entry_valor_cancelado');
            $this->data['entry_status'] = $this->language->get('entry_status');
            $this->data['entry_clearsale'] = $this->language->get('entry_clearsale');
            $this->data['entry_fcontrol'] = $this->language->get('entry_fcontrol');

            $this->data['error_iframe'] = $this->language->get('error_iframe');

            $this->data['token'] = $this->session->data['token'];

            $url = '';

            if (isset($this->request->get['filter_order_id'])) {
                $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }

            if (isset($this->request->get['filter_dataPedido'])) {
                $url .= '&filter_dataPedido=' . $this->request->get['filter_dataPedido'];
            }

            if (isset($this->request->get['filter_customer'])) {
                $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_tid'])) {
                $url .= '&filter_tid=' . $this->request->get['filter_tid'];
            }

            if (isset($this->request->get['filter_nsu'])) {
                $url .= '&filter_nsu=' . $this->request->get['filter_nsu'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            $this->data['breadcrumbs'] = array();

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => false
            );

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_search'),
                'href' => $this->url->link('sale/cielo_api_search', 'token=' . $this->session->data['token'] . $url, 'SSL'),
                'separator' => ' :: '
            );

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('sale/cielo_api_search/info', 'token=' . $this->session->data['token'] . '&cielo_api_id=' . $order_cielo_api_id . $url, 'SSL'),
                'separator' => ' :: '
            );

            switch ($transaction_info['status']) {
                case '0':
                    $status = $this->language->get('text_nao_finalizada');
                    break;
                case '1':
                    $status = $this->language->get('text_autorizada');
                    break;
                case '2':
                    $status = $this->language->get('text_capturada');
                    break;
                case '3':
                    $status = $this->language->get('text_negada');
                    break;
                case '10':
                    $status = $this->language->get('text_cancelada');
                    break;
                case '11':
                    $status = $this->language->get('text_estornada');
                    break;
                case '12':
                    $status = $this->language->get('text_pendente');
                    break;
                case '13':
                    $status = $this->language->get('text_abortada');
                    break;
            }

            $this->data['view_order'] = $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $order_id, true);
            $this->data['view_customer'] = $this->url->link('sale/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $order_info['customer_id'], true);

            $this->data['cielo_api_id'] = $transaction_info['order_cielo_api_id'];
            $this->data['order_id'] = $order_id;
            $this->data['added'] = date('d/m/Y H:i:s', strtotime($transaction_info['dataPedido']));
            $this->data['customer'] = $order_info['firstname'] . ' ' . $order_info['lastname'];
            $this->data['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], true);
            $this->data['bandeira'] = $transaction_info['bandeira'];
            $this->data['parcelas'] = $transaction_info['parcelas'];
            $this->data['tipo'] = $transaction_info['tipo'];
            $this->data['operacao'] = ($transaction_info['tipo'] == 'DebitCard') ? $this->language->get('text_debito') : $this->language->get('text_credito');
            $this->data['tid'] = $transaction_info['tid'];
            $this->data['nsu'] = $transaction_info['nsu'];
            $this->data['data_autorizacao'] = (!empty($transaction_info['autorizacaoData'])) ? date('d/m/Y H:i:s', strtotime($transaction_info['autorizacaoData'])) : '';
            $this->data['valor_autorizado'] = (!empty($transaction_info['autorizacaoValor'])) ? $this->currency->format(($transaction_info['autorizacaoValor'] / 100), $this->config->get('config_currency'), '1.00', true) : '';
            $this->data['data_captura'] = (!empty($transaction_info['capturaData'])) ? date('d/m/Y H:i:s', strtotime($transaction_info['capturaData'])) : '';
            $this->data['valor_capturado'] = (!empty($transaction_info['capturaValor'])) ? $this->currency->format(($transaction_info['capturaValor'] / 100), $this->config->get('config_currency'), '1.00', true) : '';
            $this->data['data_cancelamento'] = (!empty($transaction_info['cancelaData'])) ? date('d/m/Y H:i:s', strtotime($transaction_info['cancelaData'])) : '';
            $this->data['valor_cancelado'] = (!empty($transaction_info['cancelaValor'])) ? $this->currency->format(($transaction_info['cancelaValor'] / 100), $this->config->get('config_currency'), '1.00', true) : '';
            $this->data['status'] = $status;
            $this->data['clearsale'] = $this->config->get('cielo_api_clearsale_status');
            $this->data['fcontrol'] = $this->config->get('cielo_api_fcontrol_status');
            $this->data['json'] = $this->setJson($transaction_info['json']);

            $this->data['dias_capturar'] = '';
            $this->data['dias_cancelar'] = '';
            
            $atual = strtotime(date('Y-m-d'));

            if ($transaction_info['status'] == '1') {
                if (!empty($transaction_info['autorizacaoData'])) {
                    $inicial = strtotime(date('Y-m-d', strtotime($transaction_info['autorizacaoData'])));
                    $final = strtotime(date('Y-m-d', strtotime('+5 days', $inicial)));
                    if ($atual <= $final) {
                        $dataFinal = date('d/m/Y H:i:s', $final);
                        $dias = (int)floor(($final - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
                        $desc = ($dias > 1) ? $this->language->get('text_dias') : $this->language->get('text_dia');
                        $this->data['dias_capturar'] = sprintf($this->language->get('text_dias_capturar'), $dataFinal, $dias, $desc);
                    }
                }
            }

            if (($transaction_info['status'] == '1') || ($transaction_info['status'] == '2')) {
                if (!empty($transaction_info['capturaData'])) {
                    $inicial = strtotime(date('Y-m-d', strtotime($transaction_info['capturaData'])));
                    $final = strtotime(date('Y-m-d', strtotime('+89 days', $inicial)));
                } else {
                    $inicial = strtotime(date('Y-m-d', strtotime($transaction_info['autorizacaoData'])));
                    $final = strtotime(date('Y-m-d', strtotime('+5 days', $inicial)));
                }
                if ($atual <= $final) {
                    $dataFinal = date('d/m/Y H:i:s', $final);
                    $dias = (int)floor(($final - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
                    $desc = ($dias > 1) ? $this->language->get('text_dias') : $this->language->get('text_dia');
                    $this->data['dias_cancelar'] = sprintf($this->language->get('text_dias_cancelar'), $dataFinal, $dias, $desc);
                }
            }

            $products = $this->model_sale_order->getOrderProducts($order_id);
            $shippings = $this->model_payment_cielo_api->getOrderShipping($order_id);

            $parcelas = $transaction_info['parcelas'];
            $telefone = preg_replace("/[^0-9]/", '', $order_info['telephone']);
            $email = strtolower($order_info['email']);
            $documento = '';

            $cobranca_nome = '';
            $cobranca_logradouro  = $order_info['payment_address_1'];
            $cobranca_numero = '';
            $cobranca_complemento = '';
            $cobranca_bairro = $order_info['payment_address_2'];
            $cobranca_cidade = $order_info['payment_city'];
            $cobranca_estado = $order_info['payment_zone_code'];
            $cobranca_cep = preg_replace("/[^0-9]/", '', $order_info['payment_postcode']);

            $entrega_nome = $order_info['shipping_firstname'].' '.$order_info['shipping_lastname'];
            $entrega_logradouro  = $order_info['shipping_address_1'];
            $entrega_numero = '';
            $entrega_complemento = '';
            $entrega_bairro = $order_info['shipping_address_2'];
            $entrega_cidade = $order_info['shipping_city'];
            $entrega_estado = $order_info['shipping_zone_code'];
            $entrega_cep = preg_replace("/[^0-9]/", '', $order_info['shipping_postcode']);

            $colunas = array();

            if ($this->config->get('cielo_api_razao_coluna')) {
                array_push($colunas, $this->config->get('cielo_api_razao_coluna'));
            }

            if ($this->config->get('cielo_api_cnpj_coluna')) {
                array_push($colunas, $this->config->get('cielo_api_cnpj_coluna'));
            }

            if ($this->config->get('cielo_api_cpf_coluna')) {
                array_push($colunas, $this->config->get('cielo_api_cpf_coluna'));
            }

            if ($this->config->get('cielo_api_numero_cobranca_coluna')) {
                array_push($colunas, $this->config->get('cielo_api_numero_cobranca_coluna'));
            }

            if ($this->config->get('cielo_api_numero_entrega_coluna')) {
                array_push($colunas, $this->config->get('cielo_api_numero_entrega_coluna'));
            }

            if ($this->config->get('cielo_api_complemento_cobranca_coluna')) {
                array_push($colunas, $this->config->get('cielo_api_complemento_cobranca_coluna'));
            }

            if ($this->config->get('cielo_api_complemento_entrega_coluna')) {
                array_push($colunas, $this->config->get('cielo_api_complemento_entrega_coluna'));
            }

            if (count($colunas)) {
                $this->load->model('payment/cielo_api');
                $colunas_info = $this->model_payment_cielo_api->getOrder($colunas, $order_id);
            }

            if ($this->config->get('cielo_api_razao_coluna')) {
                if (!empty($colunas_info[$this->config->get('cielo_api_razao_coluna')])) {
                    $cobranca_nome = $colunas_info[$this->config->get('cielo_api_razao_coluna')];
                }
            }

            if ($this->config->get('cielo_api_cnpj_coluna')) {
                if (!empty($colunas_info[$this->config->get('cielo_api_cnpj_coluna')])) {
                    $documento = preg_replace("/[^0-9]/", '', $colunas_info[$this->config->get('cielo_api_cnpj_coluna')]);
                }
            }

            if (empty($cobranca_nome)) {
                $cobranca_nome = $order_info['payment_firstname'].' '.$order_info['payment_lastname'];

                if ($this->config->get('cielo_api_cpf_coluna')) {
                    if (!empty($colunas_info[$this->config->get('cielo_api_cpf_coluna')])) {
                        $documento = preg_replace("/[^0-9]/", '', $colunas_info[$this->config->get('cielo_api_cpf_coluna')]);
                    }
                }
            }

            if ($this->config->get('cielo_api_numero_cobranca_coluna')) {
                $cobranca_numero = preg_replace("/[^0-9]/", '', $colunas_info[$this->config->get('cielo_api_numero_cobranca_coluna')]);
            }

            if ($this->config->get('cielo_api_numero_entrega_coluna')) {
                $entrega_numero  = preg_replace("/[^0-9]/", '', $colunas_info[$this->config->get('cielo_api_numero_entrega_coluna')]);
            }

            if ($this->config->get('cielo_api_complemento_cobranca_coluna')) {
                $cobranca_complemento = substr($colunas_info[$this->config->get('cielo_api_complemento_cobranca_coluna')], 0, 250);
            }

            if ($this->config->get('cielo_api_complemento_entrega_coluna')) {
                $entrega_complemento  = substr($colunas_info[$this->config->get('cielo_api_complemento_entrega_coluna')], 0, 250);
            }

            if ($this->data['clearsale']) {
                if ($this->config->get('cielo_api_credito_clearsale_ambiente')) {
                    $clearsale_url = "https://www.clearsale.com.br/start/Entrada/EnviarPedido.aspx";
                } else {
                    $clearsale_url = "https://homolog.clearsale.com.br/start/Entrada/EnviarPedido.aspx";
                }

                $clearsale_itens['CodigoIntegracao'] = $this->config->get('cielo_api_credito_clearsale_codigo');
                $clearsale_itens['PedidoID'] = $order_id;
                $clearsale_itens['Data'] = date('d/m/Y h:i:s', strtotime($order_info['date_added']));
                $clearsale_itens['IP'] = $order_info['ip'];
                $clearsale_itens['TipoPagamento'] = '1';
                $clearsale_itens['Parcelas'] = $parcelas;
                $clearsale_itens['Cobranca_Nome'] = substr($cobranca_nome, 0, 500);
                $clearsale_itens['Cobranca_Email'] = substr($email, 0, 150);
                $clearsale_itens['Cobranca_Documento'] = substr($documento, 0, 100);
                $clearsale_itens['Cobranca_Logradouro'] = substr($cobranca_logradouro, 0, 200);
                $clearsale_itens['Cobranca_Logradouro_Numero'] = substr($cobranca_numero, 0, 15);
                $clearsale_itens['Cobranca_Logradouro_Complemento'] = substr($cobranca_complemento, 0, 250);
                $clearsale_itens['Cobranca_Bairro'] = substr($cobranca_bairro, 0, 150);
                $clearsale_itens['Cobranca_Cidade'] = substr($cobranca_cidade, 0, 150);
                $clearsale_itens['Cobranca_Estado' ] = substr($cobranca_estado, 0, 2);
                $clearsale_itens['Cobranca_CEP'] = $cobranca_cep;
                $clearsale_itens['Cobranca_Pais'] = 'Bra';
                $clearsale_itens['Cobranca_DDD_Telefone_1'] = substr($telefone, 0, 2);
                $clearsale_itens['Cobranca_Telefone_1'] = substr($telefone, 2);

                if (utf8_strlen($order_info['shipping_method']) > 0) {
                    $clearsale_itens['Entrega_Nome'] = substr($entrega_nome, 0, 500);
                    $clearsale_itens['Entrega_Logradouro'] = substr($entrega_logradouro, 0, 200);
                    $clearsale_itens['Entrega_Logradouro_Numero'] = substr($entrega_numero, 0, 15);
                    $clearsale_itens['Entrega_Logradouro_Complemento'] = substr($entrega_complemento, 0, 250);
                    $clearsale_itens['Entrega_Bairro'] = substr($entrega_bairro, 0, 150);
                    $clearsale_itens['Entrega_Cidade'] = substr($entrega_cidade, 0, 150);
                    $clearsale_itens['Entrega_Estado'] = substr($entrega_estado, 0, 2);
                    $clearsale_itens['Entrega_CEP'] = $entrega_cep;
                    $clearsale_itens['Entrega_Pais'] = 'Bra';
                }

                $order_total = 0;

                $i = 1; 
                foreach ($products as $product) {
                    $item_valor = $this->currency->format($product['price'], $order_info['currency_code'], '1.00', false);

                    $clearsale_itens['Item_ID_'.$i] = substr($product['product_id'], 0, 50);
                    $clearsale_itens['Item_Nome_'.$i] = substr($product['name'], 0, 150);
                    $clearsale_itens['Item_Qtd_'.$i] = $product['quantity'];
                    $clearsale_itens['Item_Valor_'.$i] = $item_valor;
                    $order_total += ($product['quantity'] * $item_valor);
                    $i++;
                }

                foreach ($shippings as $shipping) {
                    if ($shipping['value'] > 0) {
                        $item_valor = $this->currency->format($shipping['value'], $order_info['currency_code'], '1.00', false);

                        $clearsale_itens['Item_ID_'.$i] = substr($shipping['code'], 0, 50);
                        $clearsale_itens['Item_Nome_'.$i] = substr($shipping['title'], 0, 150);
                        $clearsale_itens['Item_Qtd_'.$i] = '1';
                        $clearsale_itens['Item_Valor_'.$i] = $item_valor;
                        $order_total += $item_valor;
                        $i++;
                    }
                }

                $valor_pago = $transaction_info['autorizacaoValor'] / 100;
                if ($order_total > $valor_pago) {
                    $desconto = $order_total - $valor_pago;
                    $item_valor = $this->currency->format($desconto, $order_info['currency_code'], '1.00', false);

                    $clearsale_itens['Item_ID_'.$i] = substr('desconto', 0, 50);
                    $clearsale_itens['Item_Nome_'.$i] = substr('Desconto', 0, 150);
                    $clearsale_itens['Item_Qtd_'.$i] = '1';
                    $clearsale_itens['Item_Valor_'.$i] = -$item_valor;
                    $order_total -= $item_valor;
                    $i++;
                }

                $clearsale_itens['Total'] = $this->currency->format($order_total, $order_info['currency_code'], '1.00', false);

                $this->data['clearsale_url'] = $clearsale_url;
                $this->data['clearsale_itens'] = $clearsale_itens;
                $this->data['clearsale_src'] = $clearsale_url . '?codigointegracao=' . $this->config->get('cielo_api_credito_clearsale_codigo') . '&PedidoID=' . $order_id;
            }

            if ($this->data['fcontrol']) {
                $this->data['fcontrol_url'] = "https://secure.fcontrol.com.br/validatorframe/validatorframe.aspx?";

                $this->data['fcontrol_url'] .= 'login='.$this->config->get('cielo_api_credito_fcontrol_login').
                                               '&Senha='.$this->config->get('cielo_api_credito_fcontrol_senha').
                                               '&nomeComprador='.substr($cobranca_nome, 0, 255).
                                               '&ruaComprador='.substr($cobranca_logradouro, 0, 255).
                                               '&numeroComprador='.substr($cobranca_numero, 0, 8).
                                               '&complementoComprador='.substr($cobranca_complemento, 0, 50).
                                               '&bairroComprador='.substr($cobranca_bairro, 0, 150).
                                               '&cidadeComprador='.substr($cobranca_cidade, 0, 255).
                                               '&ufComprador='.substr($cobranca_estado, 0, 2).
                                               '&paisComprador=Bra'.
                                               '&cepComprador='.substr($cobranca_cep, 0, 5) . '-' . substr($cobranca_cep, 5, 3).
                                               '&cpfComprador='.$documento.
                                               '&dddComprador='.substr($telefone, 0, 2).
                                               '&telefoneComprador='.substr($telefone, 2).
                                               '&emailComprador='.$email.
                                               '&ip='.$order_info['ip'];

                if (utf8_strlen($order_info['shipping_method']) > 0) {
                    $this->data['fcontrol_url'] .= '&nomeEntrega='.substr($entrega_nome, 0, 255).
                                                   '&ruaEntrega='.substr($entrega_logradouro, 0, 255).
                                                   '&numeroEntrega='.substr($entrega_numero, 0, 8).
                                                   '&complementoEntrega='.substr($entrega_complemento, 0, 50).
                                                   '&bairroEntrega='.substr($entrega_bairro, 0, 150).
                                                   '&cidadeEntrega='.substr($entrega_cidade, 0, 255).
                                                   '&ufEntrega='.substr($entrega_estado, 0, 2).
                                                   '&paisEntrega=Bra'.
                                                   '&cepEntrega='.substr($entrega_cep, 0, 5) . '-' . substr($entrega_cep, 5, 3).
                                                   '&dddEntrega='.substr($telefone, 0, 2).
                                                   '&telefoneEntrega='.substr($telefone, 2);
                }

                $order_total = 0;
                $itens_total = 0;
                $itens_qtd = 0;

                foreach ($products as $product) {
                    $item_valor = $product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0);
                    $order_total += $item_valor;
                    $itens_total += $product['quantity'];
                    $itens_qtd++;
                }

                foreach ($shippings as $shipping) {
                    $order_total += $shipping['value'];
                    $itens_total += 1;
                    $itens_qtd++;
                }

                $valor_compra = $this->currency->format($order_total, $order_info['currency_code'], '1.00', false);
                $valor_pagamento = $this->currency->format(($transaction_info['autorizacaoValor'] / 100), $order_info['currency_code'], '1.00', false);

                $this->data['fcontrol_url'] .= '&codigoPedido='.$order_id.
                                               '&quantidadeItensDistintos='.$itens_qtd.
                                               '&quantidadeTotalItens='.$itens_total.
                                               '&valorTotalCompra='.($valor_compra*100).
                                               '&dataCompra='.date('Y-m-d', strtotime($order_info['date_added'])).'T'.date('h:i:s', strtotime($order_info['date_added'])).
                                               '&canalVenda=lojavirtual'.
                                               '&codigoIntegrador=0';

                $this->data['fcontrol_url'] .= '&metodoPagamentos=55'.
                                               '&numeroParcelasPagamentos='.$parcelas.
                                               '&valorPagamentos='.($valor_pagamento*100);
            }

            $this->template = 'sale/cielo_api_info.tpl';
            $this->children = array(
                'common/header',
                'common/footer'
            );

            $this->response->setOutput($this->render());
        } else {
            $this->language->load('error/not_found');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->data['heading_title'] = $this->language->get('heading_title');

            $this->data['text_not_found'] = $this->language->get('text_not_found');

            $this->data['breadcrumbs'] = array();

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => false
            );

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
            );

            $this->template = 'error/not_found.tpl';
            $this->children = array(
                'common/header',
                'common/footer'
            );

            $this->response->setOutput($this->render());
        }
    }

    public function getConsultar() {
        $json = array();

        $this->load->language('sale/cielo_api_search');

        if ($this->user->hasPermission('modify', 'sale/cielo_api_search')) {
            if (isset($this->request->get['cielo_api_id'])) {
                $order_cielo_api_id = (int)$this->request->get['cielo_api_id'];

                $this->load->model('payment/cielo_api');
                $transactionInfo = $this->model_payment_cielo_api->getTransaction($order_cielo_api_id);

                $dados['MerchantId'] = ($this->config->get('cielo_api_credito_merchantid')) ? $this->config->get('cielo_api_credito_merchantid') : $this->config->get('cielo_api_debito_merchantid');
                $dados['MerchantKey'] = ($this->config->get('cielo_api_credito_merchantkey')) ? $this->config->get('cielo_api_credito_merchantkey') : $this->config->get('cielo_api_debito_merchantkey');
                $dados['Chave'] = ($this->config->get('cielo_api_credito_chave')) ? $this->config->get('cielo_api_credito_chave') : $this->config->get('cielo_api_debito_chave');
                $dados['PaymentId'] = $transactionInfo['paymentId'];

                require_once(DIR_SYSTEM . 'library/cielo_api/debug.php');
                require_once(DIR_SYSTEM . 'library/cielo_api/cielo.php');
                $ambiente = ($this->config->get('cielo_api_credito_ambiente')) ? $this->config->get('cielo_api_credito_ambiente') : $this->config->get('cielo_api_debito_ambiente');
                $sandbox = ($ambiente) ? true : false;
                $cielo = new Cielo($sandbox, true);
                $resposta = $cielo->getTransaction($dados);

                if ($resposta) {
                    if (!empty($resposta->Payment)) {
                        $transacaoStatus = $resposta->Payment->Status;

                        if (!empty($transacaoStatus)) {
                            switch($transacaoStatus) {
                                case '1':
                                    $dados = array(
                                        'order_cielo_api_id' => $order_cielo_api_id,
                                        'status' => $transacaoStatus,
                                        'autorizacaoData' => $resposta->Payment->ReceivedDate,
                                        'autorizacaoValor' => $resposta->Payment->Amount,
                                        'capturaData' => '',
                                        'capturaValor' => '',
                                        'cancelaData' => '',
                                        'cancelaValor' => '',
                                        'json' => json_encode($resposta)
                                    );

                                    $this->model_payment_cielo_api->updateTransaction($dados);

                                    $json['mensagem'] = $this->language->get('text_autorizada');
                                    break;
                                case '2':
                                    $dados = array(
                                        'order_cielo_api_id' => $order_cielo_api_id,
                                        'status' => $transacaoStatus,
                                        'autorizacaoData' => $resposta->Payment->ReceivedDate,
                                        'autorizacaoValor' => $resposta->Payment->Amount,
                                        'capturaData' => $resposta->Payment->CapturedDate,
                                        'capturaValor' => $resposta->Payment->CapturedAmount,
                                        'cancelaData' => '',
                                        'cancelaValor' => '',
                                        'json' => json_encode($resposta)
                                    );

                                    $this->model_payment_cielo_api->updateTransaction($dados);

                                    $json['mensagem'] = $this->language->get('text_capturada');
                                    break;
                                case '10':
                                    $dados = array(
                                        'order_cielo_api_id' => $order_cielo_api_id,
                                        'status' => $transacaoStatus,
                                        'autorizacaoData' => $resposta->Payment->ReceivedDate,
                                        'autorizacaoValor' => $resposta->Payment->Amount,
                                        'capturaData' => (isset($resposta->Payment->CapturedDate)) ? $resposta->Payment->CapturedDate : '',
                                        'capturaValor' => (isset($resposta->Payment->CapturedAmount)) ? $resposta->Payment->CapturedAmount : '',
                                        'cancelaData' => $resposta->Payment->VoidedDate,
                                        'cancelaValor' => $resposta->Payment->VoidedAmount,
                                        'json' => json_encode($resposta)
                                    );

                                    $this->model_payment_cielo_api->updateTransaction($dados);

                                    $json['mensagem'] = $this->language->get('text_cancelada');
                                    break;
                                case '11':
                                    $dados = array(
                                        'order_cielo_api_id' => $order_cielo_api_id,
                                        'status' => $transacaoStatus,
                                        'autorizacaoData' => $resposta->Payment->ReceivedDate,
                                        'autorizacaoValor' => $resposta->Payment->Amount,
                                        'capturaData' => (isset($resposta->Payment->CapturedDate)) ? $resposta->Payment->CapturedDate : '',
                                        'capturaValor' => (isset($resposta->Payment->CapturedAmount)) ? $resposta->Payment->CapturedAmount : '',
                                        'cancelaData' => $resposta->Payment->VoidedDate,
                                        'cancelaValor' => $resposta->Payment->VoidedAmount,
                                        'json' => json_encode($resposta)
                                    );

                                    $this->model_payment_cielo_api->updateTransaction($dados);

                                    $json['mensagem'] = $this->language->get('text_estornada');
                                    break;
                                default:
                                    $dados = array(
                                        'order_cielo_api_id' => $order_cielo_api_id,
                                        'status' => $transacaoStatus
                                    );

                                    $this->model_payment_cielo_api->updateTransactionStatus($dados);

                                    $mensagem = array(
                                        '0' => $this->language->get('text_nao_finalizada'),
                                        '3' => $this->language->get('text_negada'),
                                        '12' => $this->language->get('text_pendente'),
                                        '13' => $this->language->get('text_abortada'),
                                    );

                                    $json['mensagem'] = $mensagem[$transacaoStatus];
                                    break;
                            }
                        } else {
                            $json['error'] = $this->language->get('error_search');
                        }
                    } else {
                        $json['error'] = $this->language->get('error_search');
                    }
                } else {
                    $json['error'] = $this->language->get('error_search');
                }
            } else {
                $json['error'] = $this->language->get('error_warning');
            }
        } else {
            $json['error'] = $this->language->get('error_permission');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function setCapturar() {
        $json = array();

        $this->load->language('sale/cielo_api_search');

        if ($this->user->hasPermission('modify', 'sale/cielo_api_search')) {
            if (isset($this->request->get['cielo_api_id'])) {
                $order_cielo_api_id = (int)$this->request->get['cielo_api_id'];

                $this->load->model('payment/cielo_api');
                $transactionInfo = $this->model_payment_cielo_api->getTransaction($order_cielo_api_id);

                $dados['MerchantId'] = ($this->config->get('cielo_api_credito_merchantid')) ? $this->config->get('cielo_api_credito_merchantid') : $this->config->get('cielo_api_debito_merchantid');
                $dados['MerchantKey'] = ($this->config->get('cielo_api_credito_merchantkey')) ? $this->config->get('cielo_api_credito_merchantkey') : $this->config->get('cielo_api_debito_merchantkey');
                $dados['Chave'] = ($this->config->get('cielo_api_credito_chave')) ? $this->config->get('cielo_api_credito_chave') : $this->config->get('cielo_api_debito_chave');
                $dados['PaymentId'] = $transactionInfo['paymentId'];
                $dados['Debug'] = ($this->config->get('cielo_api_credito_debug')) ? true : ($this->config->get('cielo_api_debito_debug') ? true : false);

                require_once(DIR_SYSTEM . 'library/cielo_api/debug.php');
                require_once(DIR_SYSTEM . 'library/cielo_api/cielo.php');
                $ambiente = ($this->config->get('cielo_api_credito_ambiente')) ? $this->config->get('cielo_api_credito_ambiente') : $this->config->get('cielo_api_debito_ambiente');
                $sandbox = ($ambiente) ? true : false;
                $cielo = new Cielo($sandbox);
                $resposta = $cielo->setCapture($dados);

                if ($resposta) {
                    if (!empty($resposta->Status)) {
                        switch($resposta->Status) {
                            case '2':
                                $dados['order_cielo_api_id'] = $order_cielo_api_id;
                                $dados['status'] = $resposta->Status;
                                $dados['json'] = json_encode($resposta);

                                $this->model_payment_cielo_api->captureTransaction($dados);

                                $json['mensagem'] = $this->language->get('text_capturada');
                                break;
                        }
                    } else {
                        $json['error'] = $this->language->get('error_capture');
                    }
                } else {
                    $json['error'] = $this->language->get('error_capture');
                }
            } else {
                $json['error'] = $this->language->get('error_warning');
            }
        } else {
            $json['error'] = $this->language->get('error_permission');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function setCancelar() {
        $json = array();

        $this->load->language('sale/cielo_api_search');

        if ($this->user->hasPermission('modify', 'sale/cielo_api_search')) {
            if (isset($this->request->get['cielo_api_id'])) {
                $order_cielo_api_id = (int)$this->request->get['cielo_api_id'];

                $this->load->model('payment/cielo_api');
                $transactionInfo = $this->model_payment_cielo_api->getTransaction($order_cielo_api_id);

                $dados['MerchantId'] = ($this->config->get('cielo_api_credito_merchantid')) ? $this->config->get('cielo_api_credito_merchantid') : $this->config->get('cielo_api_debito_merchantid');
                $dados['MerchantKey'] = ($this->config->get('cielo_api_credito_merchantkey')) ? $this->config->get('cielo_api_credito_merchantkey') : $this->config->get('cielo_api_debito_merchantkey');
                $dados['Chave'] = ($this->config->get('cielo_api_credito_chave')) ? $this->config->get('cielo_api_credito_chave') : $this->config->get('cielo_api_debito_chave');
                $dados['PaymentId'] = $transactionInfo['paymentId'];
                $dados['Debug'] = ($this->config->get('cielo_api_credito_debug')) ? true : ($this->config->get('cielo_api_debito_debug') ? true : false);

                require_once(DIR_SYSTEM . 'library/cielo_api/debug.php');
                require_once(DIR_SYSTEM . 'library/cielo_api/cielo.php');
                $ambiente = ($this->config->get('cielo_api_credito_ambiente')) ? $this->config->get('cielo_api_credito_ambiente') : $this->config->get('cielo_api_debito_ambiente');
                $sandbox = ($ambiente) ? true : false;
                $cielo = new Cielo($sandbox);
                $resposta = $cielo->setCancel($dados);

                if ($resposta) {
                    if (!empty($resposta->Status)) {
                        switch($resposta->Status) {
                            case '10':
                                $dados['order_cielo_api_id'] = $order_cielo_api_id;
                                $dados['status'] = $resposta->Status;
                                $dados['json'] = json_encode($resposta);

                                $this->model_payment_cielo_api->cancelTransaction($dados);

                                $json['mensagem'] = $this->language->get('text_cancelada');
                                break;
                            case '11':
                                $dados['order_cielo_api_id'] = $order_cielo_api_id;
                                $dados['status'] = $resposta->Status;
                                $dados['json'] = json_encode($resposta);

                                $this->model_payment_cielo_api->cancelTransaction($dados);

                                $json['mensagem'] = $this->language->get('text_estornada');
                                break;
                        }
                    } else {
                        $json['error'] = $this->language->get('error_cancel');
                    }
                } else {
                    $json['error'] = $this->language->get('error_cancel');
                }
            } else {
                $json['error'] = $this->language->get('error_warning');
            }
        } else {
            $json['error'] = $this->language->get('error_permission');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    private function setJson($json) {
        $result = '';
        $level = 0;
        $in_quotes = false;
        $in_escape = false;
        $ends_line_level = NULL;
        $json_length = strlen($json);

        for ($i = 0; $i < $json_length; $i++) {
            $char = $json[$i];
            $new_line_level = NULL;
            $post = "";
            if ($ends_line_level !== NULL) {
                $new_line_level = $ends_line_level;
                $ends_line_level = NULL;
            }
            if ($in_escape) {
                $in_escape = false;
            } else if ($char === '"') {
                $in_quotes = !$in_quotes;
            } else if (!$in_quotes) {
                switch($char) {
                    case '}': case ']':
                        $level--;
                        $ends_line_level = NULL;
                        $new_line_level = $level;
                        break;
                    case '{': case '[':
                        $level++;
                    case ',':
                        $ends_line_level = $level;
                        break;
                    case ':':
                        $post = " ";
                        break;
                    case " ": case "\t": case "\n": case "\r":
                        $char = "";
                        $ends_line_level = $new_line_level;
                        $new_line_level = NULL;
                        break;
                }
            } else if ($char === '\\') {
                $in_escape = true;
            }
            if($new_line_level !== NULL) {
                $result .= "\n".str_repeat( "\t", $new_line_level );
            }
            $result .= $char.$post;
        }

        return $result;
    }
}
?>