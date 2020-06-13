<?php
class ControllerPaymentCieloApiDebito extends Controller {
    public function index() {
        $this->load->language('payment/cielo_api_debito');

        $this->data['text_sandbox'] = $this->language->get('text_sandbox');
        $this->data['text_detalhes'] = $this->language->get('text_detalhes');
        $this->data['text_mes'] = $this->language->get('text_mes');
        $this->data['text_ano'] = $this->language->get('text_ano');
        $this->data['text_carregando'] = $this->language->get('text_carregando');
        $this->data['text_verificando'] = $this->language->get('text_verificando');
        $this->data['text_redirecionando'] = $this->language->get('text_redirecionando');

        $this->data['button_pagar'] = $this->language->get('button_pagar');

        $this->data['entry_bandeira'] = $this->language->get('entry_bandeira');
        $this->data['entry_cartao'] = $this->language->get('entry_cartao');
        $this->data['entry_titular'] = $this->language->get('entry_titular');
        $this->data['entry_validade_mes'] = $this->language->get('entry_validade_mes');
        $this->data['entry_validade_ano'] = $this->language->get('entry_validade_ano');
        $this->data['entry_codigo'] = $this->language->get('entry_codigo');
        $this->data['entry_total'] = $this->language->get('entry_total');

        $this->data['error_cartao'] = $this->language->get('error_cartao');
        $this->data['error_titular'] = $this->language->get('error_titular');
        $this->data['error_mes'] = $this->language->get('error_mes');
        $this->data['error_ano'] = $this->language->get('error_ano');
        $this->data['error_codigo'] = $this->language->get('error_codigo');

        $this->data['error_bandeiras'] = $this->language->get('error_bandeiras');
        $this->data['error_configuracao'] = $this->language->get('error_configuracao');

        $this->data['ambiente'] = $this->config->get('cielo_api_debito_ambiente');

        $this->data['cor_normal_texto'] = $this->config->get('cielo_api_debito_cor_normal_texto');
        $this->data['cor_normal_fundo'] = $this->config->get('cielo_api_debito_cor_normal_fundo');
        $this->data['cor_normal_borda'] = $this->config->get('cielo_api_debito_cor_normal_borda');
        $this->data['cor_efeito_texto'] = $this->config->get('cielo_api_debito_cor_efeito_texto');
        $this->data['cor_efeito_fundo'] = $this->config->get('cielo_api_debito_cor_efeito_fundo');
        $this->data['cor_efeito_borda'] = $this->config->get('cielo_api_debito_cor_efeito_borda');

        $this->load->model('checkout/order');
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        $this->data['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], true);

        $this->data['bandeiras'] = array();
        foreach ($this->getBandeiras() as $bandeira) {
            ($this->config->get('cielo_api_debito_' . $bandeira)) ? array_push($this->data['bandeiras'], $bandeira) : '';
        }

        $meses = array();
        for ($i = 1; $i <= 12; $i++) {
            $meses[] = array(
                'text' => sprintf('%02d', $i),
                'value' => sprintf('%02d', $i)
            );
        }
        $this->data['meses'] = json_encode($meses);

        $anos = array();
        $hoje = getdate();
        for ($i = $hoje['year']; $i < $hoje['year'] + 12; $i++) {
            $anos[] = array(
                'text' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)),
                'value' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i))
            );
        }
        $this->data['anos'] = json_encode($anos);

        if (isset($this->session->data['attempts'])) {
            unset($this->session->data['attempts']);
        }
        $this->session->data['attempts'] = 3;

        include_once(DIR_SYSTEM . 'library/cielo_api/versao.php');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/cielo_api_debito.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/payment/cielo_api_debito.tpl';
        } else {
            $this->template = 'default/template/payment/cielo_api_debito.tpl';
        }

        $this->render();
    }

    public function bandeiras() {
        $json = array();

        if (isset($this->session->data['order_id']) && isset($this->session->data['attempts'])) {
            foreach ($this->getBandeiras() as $bandeira) {
                ($this->config->get('cielo_api_debito_' . $bandeira)) ? $json[] = array('bandeira' => $bandeira, 'titulo' => ($bandeira == 'visa' ? 'VISA ELECTRON' : 'MAESTRO'), 'imagem' => HTTPS_SERVER .'image/cielo_api/'. $bandeira .'_debito.png') : '';
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function pagamento() {
        if (isset($this->session->data['order_id'])) {
            $this->load->language('payment/cielo_api_pagamento');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->data['breadcrumbs'] = array();

            $this->data['breadcrumbs'][] = array(
                'href' => $this->url->link('common/home'),
                'text' => $this->language->get('text_home'),
                'separator' => false
            );

            $this->data['breadcrumbs'][] = array(
                'href' => $this->url->link('checkout/cart'),
                'text' => $this->language->get('text_basket'),
                'separator' => $this->language->get('text_separator')
            );

            $this->data['breadcrumbs'][] = array(
                'href' => $this->url->link('checkout/checkout', '', 'SSL'),
                'text' => $this->language->get('text_checkout'),
                'separator' => $this->language->get('text_separator')
            );

            $this->data['breadcrumbs'][] = array(
                'href' => $this->url->link('payment/cielo_api_debito/pagamento', '', 'SSL'),
                'text' => $this->language->get('text_pagamento'),
                'separator' => $this->language->get('text_separator')
            );

            include_once(DIR_SYSTEM . 'library/cielo_api/versao.php');

            $this->document->addStyle('catalog/view/javascript/cielo_api/css/skeleton/normalize.css?v='.$this->data['versao']);
            $this->document->addStyle('catalog/view/javascript/cielo_api/css/skeleton/skeleton.css?v='.$this->data['versao']);
            $this->document->addScript('catalog/view/javascript/cielo_api/js/jquery-loading-overlay/loadingoverlay.min.js?v='.$this->data['versao']);

            $this->data['heading_title'] = $this->language->get('heading_title');

            $this->data['text_sandbox'] = $this->language->get('text_sandbox');
            $this->data['text_informacoes'] = $this->language->get('text_informacoes');
            $this->data['text_detalhes'] = $this->language->get('text_detalhes');
            $this->data['text_carregando'] = $this->language->get('text_carregando');
            $this->data['text_validando'] = $this->language->get('text_validando');
            $this->data['text_redirecionando'] = $this->language->get('text_redirecionando');
            $this->data['text_mes'] = $this->language->get('text_mes');
            $this->data['text_ano'] = $this->language->get('text_ano');

            $this->data['button_pagar'] = $this->language->get('button_pagar');

            $this->data['entry_bandeira'] = $this->language->get('entry_bandeira');
            $this->data['entry_cartao'] = $this->language->get('entry_cartao');
            $this->data['entry_titular'] = $this->language->get('entry_titular');
            $this->data['entry_validade_mes'] = $this->language->get('entry_validade_mes');
            $this->data['entry_validade_ano'] = $this->language->get('entry_validade_ano');
            $this->data['entry_codigo'] = $this->language->get('entry_codigo');
            $this->data['entry_total'] = $this->language->get('entry_total');

            $this->data['error_cartao'] = $this->language->get('error_cartao');
            $this->data['error_titular'] = $this->language->get('error_titular');
            $this->data['error_mes'] = $this->language->get('error_mes');
            $this->data['error_ano'] = $this->language->get('error_ano');
            $this->data['error_codigo'] = $this->language->get('error_codigo');

            $this->data['error_autorizacao'] = $this->language->get('error_autorizacao');
            $this->data['error_bandeiras'] = $this->language->get('error_bandeiras');
            $this->data['error_configuracao'] = $this->language->get('error_configuracao');

            $this->data['ambiente'] = $this->config->get('cielo_api_debito_ambiente');

            $this->data['cor_normal_texto'] = $this->config->get('cielo_api_debito_cor_normal_texto');
            $this->data['cor_normal_fundo'] = $this->config->get('cielo_api_debito_cor_normal_fundo');
            $this->data['cor_normal_borda'] = $this->config->get('cielo_api_debito_cor_normal_borda');
            $this->data['cor_efeito_texto'] = $this->config->get('cielo_api_debito_cor_efeito_texto');
            $this->data['cor_efeito_fundo'] = $this->config->get('cielo_api_debito_cor_efeito_fundo');
            $this->data['cor_efeito_borda'] = $this->config->get('cielo_api_debito_cor_efeito_borda');

            $this->data['falhou'] = false;

            if (isset($this->session->data['falhou'])) {
                $this->data['falhou'] = $this->session->data['falhou'];
                unset($this->session->data['falhou']);
            }

            $this->load->model('checkout/order');
            $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

            $this->data['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], true);

            $bandeiras = array();
            foreach ($this->getBandeiras() as $bandeira) {
                ($this->config->get('cielo_api_debito_' . $bandeira)) ? array_push($bandeiras, $bandeira) : '';
            }
            $this->data['bandeiras'] = $bandeiras;

            $meses = array();
            for ($i = 1; $i <= 12; $i++) {
                $meses[] = array(
                    'text' => sprintf('%02d', $i),
                    'value' => sprintf('%02d', $i)
                );
            }
            $this->data['meses'] = json_encode($meses);

            $anos = array();
            $hoje = getdate();
            for ($i = $hoje['year']; $i < $hoje['year'] + 12; $i++) {
                $anos[] = array(
                    'text' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)),
                    'value' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i))
                );
            }
            $this->data['anos'] = json_encode($anos);

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/cielo_api_pagamento.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/payment/cielo_api_pagamento.tpl';
            } else {
                $this->template = 'default/template/payment/cielo_api_pagamento.tpl';
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
        } else {
            $this->redirect($this->url->link('error/not_found'));
        }
    }

    public function comprovante() {
        if (isset($this->session->data['comprovante'])) {
            if (isset($this->session->data['order_id'])) {
                $this->cart->clear();

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

            $this->language->load('payment/cielo_api_comprovante');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->data['breadcrumbs'] = array();

            $this->data['breadcrumbs'][] = array(
                'href' => $this->url->link('common/home'),
                'text' => $this->language->get('text_home'),
                'separator' => false
            );

            $this->data['breadcrumbs'][] = array(
                'href' => $this->url->link('checkout/cart'),
                'text' => $this->language->get('text_basket'),
                'separator' => $this->language->get('text_separator')
            );

            $this->data['breadcrumbs'][] = array(
                'href' => $this->url->link('checkout/checkout', '', 'SSL'),
                'text' => $this->language->get('text_checkout'),
                'separator' => $this->language->get('text_separator')
            );

            $this->data['breadcrumbs'][] = array(
                'href' => $this->url->link('payment/cielo_api_debito/comprovante', '', 'SSL'),
                'text' => $this->language->get('text_success'),
                'separator' => $this->language->get('text_separator')
            );

            $this->data['heading_title'] = $this->language->get('heading_title');

            $this->data['text_title'] = $this->language->get('text_title');

            $this->data['text_importante'] = $this->language->get('text_importante');
            $this->data['text_comprovante'] = $this->session->data['comprovante'];

            $this->data['button_imprimir'] = $this->language->get('button_imprimir');

            $this->data['print'] = $this->url->link('payment/cielo_api_debito/imprimir');
            $this->data['continue'] = $this->url->link('common/home');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/cielo_api_comprovante.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/payment/cielo_api_comprovante.tpl';
            } else {
                $this->template = 'default/template/payment/cielo_api_comprovante.tpl';
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
        } else {
            $this->redirect($this->url->link('error/not_found'));
        }
    }

    public function imprimir() {
        if (isset($this->session->data['comprovante'])) {
            $this->language->load('payment/cielo_api_imprimir');

            $this->document->setTitle($this->config->get('config_name') . ' - ' . $this->language->get('text_title'));

            if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
                $server = $this->config->get('config_ssl');
            } else {
                $server = $this->config->get('config_url');
            }

            if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
                $this->data['icon'] = $server . 'image/' . $this->config->get('config_icon');
            } else {
                $this->data['icon'] = '';
            }

            $this->data['title'] = $this->document->getTitle();

            $this->data['lang'] = $this->language->get('code');
            $this->data['direction'] = $this->language->get('direction');
            $this->data['name'] = $this->config->get('config_name');

            $this->data['text_title'] = $this->language->get('text_title');
            $this->data['text_comprovante'] = $this->session->data['comprovante'];

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/cielo_api_imprimir.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/payment/cielo_api_imprimir.tpl';
            } else {
                $this->template = 'default/template/payment/cielo_api_imprimir.tpl';
            }

            $this->response->setOutput($this->render());
        } else {
            $this->redirect($this->url->link('error/not_found'));
        }
    }

    public function retorno() {
        $this->language->load('payment/cielo_api_debito');

        if (isset($this->session->data['order_id']) || isset($this->session->data['cielo_api_id'])) {
            $this->session->data['falhou'] = true;

            $numPedido = $this->session->data['order_id'];
            $cielo_api_id = $this->session->data['cielo_api_id'];

            $this->load->model('payment/cielo_api_debito');
            $transactionInfo = $this->model_payment_cielo_api_debito->getTransaction($cielo_api_id);

            $dados['MerchantId'] = $this->config->get('cielo_api_debito_merchantid');
            $dados['MerchantKey'] = $this->config->get('cielo_api_debito_merchantkey');
            $dados['Chave'] = $this->config->get('cielo_api_debito_chave');
            $dados['PaymentId'] = $transactionInfo['paymentId'];

            require_once(DIR_SYSTEM . 'library/cielo_api/debug.php');
            require_once(DIR_SYSTEM . 'library/cielo_api/cielo.php');
            $sandbox = ($this->config->get('cielo_api_debito_ambiente')) ? true : false;
            $cielo = new Cielo($sandbox, true);
            $resposta = $cielo->getTransaction($dados);

            if ($resposta) {
                if (!empty($resposta->Payment)) {
                    $this->load->model('checkout/order');
                    $order_info = $this->model_checkout_order->getOrder($numPedido);

                    $transacaoStatus = $resposta->Payment->Status;
                    $transacaoData = date('d/m/Y H:i', strtotime($resposta->Payment->ReceivedDate));
                    $transacaoTid = $resposta->Payment->Tid;
                    $transacaoBandeira = $resposta->Payment->DebitCard->Brand;
                    $transacaoValor = $this->currency->format(($resposta->Payment->Amount / 100), $order_info['currency_code'], '1.00', true);

                    if (!empty($transacaoStatus)) {
                        switch($transacaoStatus) {
                            case '1':
                                $comment = $this->language->get('entry_pedido') . $numPedido . "\n";
                                $comment .= $this->language->get('entry_data') . $transacaoData . "\n";
                                $comment .= $this->language->get('entry_tid') . $transacaoTid . "\n";
                                $comment .= $this->language->get('entry_nsu') . $resposta->Payment->ProofOfSale . "\n";
                                $comment .= $this->language->get('entry_tipo') . $this->language->get('text_cartao_debito') . "\n";
                                $comment .= $this->language->get('entry_bandeira') . strtoupper($transacaoBandeira) . "\n";
                                $comment .= $this->language->get('entry_total') . $transacaoValor . "\n";
                                $comment .= $this->language->get('entry_status') . $this->language->get('text_autorizado');

                                $this->model_checkout_order->update($numPedido, $this->config->get('cielo_api_debito_situacao_autorizada_id'), $comment, true);

                                $dados = array(
                                    'order_cielo_api_id' => $transactionInfo['order_cielo_api_id'],
                                    'status' => $transacaoStatus,
                                    'autorizacaoData' => $resposta->Payment->ReceivedDate,
                                    'autorizacaoValor' => $resposta->Payment->Amount,
                                    'capturaData' => '',
                                    'capturaValor' => '',
                                    'json' => json_encode($resposta)
                                );

                                $this->model_payment_cielo_api_debito->updateTransaction($dados);

                                if(isset($this->session->data['comprovante'])) {
                                    unset($this->session->data['comprovante']);
                                }
                                $this->session->data['comprovante'] = $comment;
                                break;
                            case '2':
                                $transacaoData = date('d/m/Y H:i', strtotime($resposta->Payment->CapturedDate));
                                $transacaoValor = $this->currency->format(($resposta->Payment->CapturedAmount / 100), $order_info['currency_code'], '1.00', true);

                                $comment = $this->language->get('entry_pedido') . $numPedido . "\n";
                                $comment .= $this->language->get('entry_data') . $transacaoData . "\n";
                                $comment .= $this->language->get('entry_tid') . $transacaoTid . "\n";
                                $comment .= $this->language->get('entry_nsu') . $resposta->Payment->ProofOfSale . "\n";
                                $comment .= $this->language->get('entry_tipo') . $this->language->get('text_cartao_debito') . "\n";
                                $comment .= $this->language->get('entry_bandeira') . strtoupper($transacaoBandeira) . "\n";
                                $comment .= $this->language->get('entry_total') . $transacaoValor . "\n";
                                $comment .= $this->language->get('entry_status') . $this->language->get('text_capturado');

                                $this->model_checkout_order->update($numPedido, $this->config->get('cielo_api_debito_situacao_capturada_id'), $comment, true);

                                $dados = array(
                                    'order_cielo_api_id' => $transactionInfo['order_cielo_api_id'],
                                    'status' => $transacaoStatus,
                                    'autorizacaoData' => $resposta->Payment->ReceivedDate,
                                    'autorizacaoValor' => $resposta->Payment->Amount,
                                    'capturaData' => $resposta->Payment->CapturedDate,
                                    'capturaValor' => $resposta->Payment->CapturedAmount,
                                    'json' => json_encode($resposta)
                                );

                                $this->model_payment_cielo_api_debito->updateTransaction($dados);

                                if(isset($this->session->data['comprovante'])) {
                                    unset($this->session->data['comprovante']);
                                }
                                $this->session->data['comprovante'] = $comment;
                                break;
                            default:
                                $comment = $this->language->get('entry_pedido') . $numPedido . "\n";
                                $comment .= $this->language->get('entry_data') . $transacaoData . "\n";
                                $comment .= $this->language->get('entry_tid') . $transacaoTid . "\n";
                                if (isset($resposta->Payment->ProofOfSale)) {
                                    $comment .= $this->language->get('entry_nsu') . $resposta->Payment->ProofOfSale . "\n";
                                }
                                $comment .= $this->language->get('entry_tipo') . $this->language->get('text_cartao_debito') . "\n";
                                $comment .= $this->language->get('entry_bandeira') . strtoupper($transacaoBandeira) . "\n";
                                $comment .= $this->language->get('entry_total') . $transacaoValor . "\n";
                                $comment .= $this->language->get('entry_status') . $this->language->get('text_nao_autorizado');

                                $this->model_checkout_order->update($numPedido, $this->config->get('cielo_api_debito_situacao_nao_autorizada_id'), $comment, false);

                                $dados = array(
                                    'order_cielo_api_id' => $transactionInfo['order_cielo_api_id'],
                                    'status' => $transacaoStatus,
                                    'json' => json_encode($resposta)
                                );

                                $this->model_payment_cielo_api_debito->updateTransactionStatus($dados);
                                break;
                        }

                        if (($transacaoStatus == '1') || ($transacaoStatus == '2')) {
                            $this->redirect($this->url->link('payment/cielo_api_debito/comprovante', '', 'SSL'));
                        } else {
                            $this->redirect($this->url->link('payment/cielo_api_debito/pagamento', '', 'SSL'));
                        }
                    } else {
                        $this->redirect($this->url->link('payment/cielo_api_debito/pagamento', '', 'SSL'));
                    }
                } else {
                    $this->redirect($this->url->link('payment/cielo_api_debito/pagamento', '', 'SSL'));
                }
            } else {
                $this->redirect($this->url->link('payment/cielo_api_debito/pagamento', '', 'SSL'));
            }
        } else {
            $this->redirect($this->url->link('error/not_found'));
        }
    }

    private function getBandeiras() {
        $bandeiras = array(
            "visa",
            "mastercard"
        );

        return $bandeiras;
    }

    public function setTransacao() {
        $json = array();

        $this->language->load('payment/cielo_api_debito');

        if (isset($this->session->data['order_id']) && isset($this->session->data['attempts']) && $this->setValidarPost()) {
            if ($this->session->data['attempts'] > 0) {
                $bandeiraCartao = trim($this->request->post['bandeira']);
                $titularCartao = trim($this->request->post['titular']);
                $numeroCartao = preg_replace("/[^0-9]/", '', $this->request->post['cartao']);
                $validadeMes = preg_replace("/[^0-9]/", '', $this->request->post['mes']);
                $validadeAno = preg_replace("/[^0-9]/", '', $this->request->post['ano']);
                $codigoCartao = preg_replace("/[^0-9]/", '', $this->request->post['codigo']);

                $campos = array($bandeiraCartao, $titularCartao, $numeroCartao, $validadeMes, $validadeAno, $codigoCartao);

                $bandeiras = $this->getBandeiras();

                if ($this->setValidarCampos($campos) && in_array(strtolower($bandeiraCartao), $bandeiras)) {
                    $this->session->data['attempts']--;
                    $numPedido = $this->session->data['order_id'];

                    $this->load->model('checkout/order');
                    $order_info = $this->model_checkout_order->getOrder($numPedido);

                    $this->valorTotal = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
                    $total = $this->valorTotal;
                    $total = number_format($total, 2, '', '');

                    $bandeirasCielo = array(
                        'visa' => 'Visa',
                        'mastercard' => 'Master'
                    );

                    $dados['MerchantOrderId'] = $numPedido;
                    $dados['Customer'] = $order_info['firstname'] . ' ' . $order_info['lastname'];
                    $dados['Amount'] = $total;
                    $dados['CardNumber'] = $numeroCartao;
                    $dados['Holder'] = $titularCartao;
                    $dados['ExpirationDate'] = $validadeMes . '/' . $validadeAno;
                    $dados['SecurityCode'] = $codigoCartao;
                    $dados['Brand'] = $bandeirasCielo[$bandeiraCartao];

                    $dados['ReturnUrl'] = HTTPS_SERVER . 'index.php?route=payment/cielo_api_debito/retorno';
                    $dados['SoftDescriptor'] = $this->config->get('cielo_api_debito_soft_descriptor');

                    $dados['MerchantId'] = $this->config->get('cielo_api_debito_merchantid');
                    $dados['MerchantKey'] = $this->config->get('cielo_api_debito_merchantkey');
                    $dados['Chave'] = $this->config->get('cielo_api_debito_chave');
                    $dados['Debug'] = ($this->config->get('cielo_api_debito_debug')) ? true : false;

                    require_once(DIR_SYSTEM . 'library/cielo_api/debug.php');
                    require_once(DIR_SYSTEM . 'library/cielo_api/cielo.php');
                    $sandbox = ($this->config->get('cielo_api_debito_ambiente')) ? true : false;
                    $cielo = new Cielo($sandbox);
                    $resposta = $cielo->setTransactionDebit($dados);

                    if ($resposta) {
                        if (!empty($resposta->Payment)) {
                            $transacaoStatus = $resposta->Payment->Status;

                            switch($transacaoStatus) {
                                case '0':
                                    $campos = array(
                                        'order_id' => $numPedido,
                                        'status' => $transacaoStatus,
                                        'dataPedido' => $resposta->Payment->ReceivedDate,
                                        'tid' => $resposta->Payment->Tid,
                                        'nsu' => (isset($resposta->Payment->ProofOfSale)) ? $resposta->Payment->ProofOfSale : '',
                                        'paymentId' => $resposta->Payment->PaymentId,
                                        'tipo' => $resposta->Payment->Type,
                                        'parcelas' => '1',
                                        'bandeira' => $resposta->Payment->DebitCard->Brand,
                                        'json' => json_encode($resposta)
                                    );

                                    $this->load->model('payment/cielo_api_debito');
                                    $this->session->data['cielo_api_id'] = $this->model_payment_cielo_api_debito->addTransaction($campos);

                                    $this->model_checkout_order->confirm($numPedido, $this->config->get('cielo_api_debito_situacao_pendente_id'), $this->language->get('text_pendente'), true);

                                    $json['redirect'] = $resposta->Payment->AuthenticationUrl;
                                    break;
                                default:
                                    $this->model_checkout_order->confirm($numPedido, $this->config->get('cielo_api_debito_situacao_pendente_id'), $this->language->get('text_nao_autorizado'), true);

                                    $json['error'] = $this->language->get('error_autorizacao');
                                    break;
                            }
                        } else {
                            $json['error'] = $this->language->get('error_json');
                        }
                    } else {
                        $json['error'] = $this->language->get('error_configuracao');
                    }
                } else {
                    $json['error'] = $this->language->get('error_preenchimento');
                }
            } else {
                if ($this->session->data['attempts'] == 0) {
                    $this->session->data['attempts']--;

                    $this->load->model('checkout/order');
                    $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

                    if ($order_info['order_status_id'] == 0) {
                        $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('cielo_api_debito_situacao_nao_autorizada_id'), $this->language->get('text_tentativas'), true);
                    } else {
                        $this->model_checkout_order->update($this->session->data['order_id'], $this->config->get('cielo_api_debito_situacao_nao_autorizada_id'), $this->language->get('text_tentativas'), true);
                    }
                }

                $json['error'] = $this->language->get('error_tentativas');
            }
        } else {
            $json['error'] = $this->language->get('error_permissao');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    private function setValidarPost() {
        $campos = array('bandeira', 'cartao', 'mes', 'ano', 'codigo');

        $erros = 0;
        foreach ($campos as $campo) {
            if (!isset($this->request->post[$campo])) {
                $erros++;
                break;
            }
        }

        if ($erros == 0) {
            return true;
        } else {
            return false;
        }
    }

    private function setValidarCampos($campos) {
        $erros = 0;
        foreach ($campos as $campo) {
            if (empty($campo)) {
                $erros++;
                break;
            }
        }

        if ($erros == 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>