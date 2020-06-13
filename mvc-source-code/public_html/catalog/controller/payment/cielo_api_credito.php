<?php
class ControllerPaymentCieloApiCredito extends Controller {
    private $valorTotal = 0;

    public function index() {
        $this->load->language('payment/cielo_api_credito');

        $this->data['text_sandbox'] = $this->language->get('text_sandbox');
        $this->data['text_detalhes'] = $this->language->get('text_detalhes');
        $this->data['text_ate'] = $this->language->get('text_ate');
        $this->data['text_de'] = $this->language->get('text_de');
        $this->data['text_total'] = $this->language->get('text_total');
        $this->data['text_sem_juros'] = $this->language->get('text_sem_juros');
        $this->data['text_com_juros'] = $this->language->get('text_com_juros');
        $this->data['text_juros'] = $this->language->get('text_juros');
        $this->data['text_mes'] = $this->language->get('text_mes');
        $this->data['text_ano'] = $this->language->get('text_ano');
        $this->data['text_carregando'] = $this->language->get('text_carregando');
        $this->data['text_autorizando'] = $this->language->get('text_autorizando');
        $this->data['text_autorizou'] = $this->language->get('text_autorizou');

        $this->data['button_pagar'] = $this->language->get('button_pagar');

        $this->data['entry_bandeira'] = $this->language->get('entry_bandeira');
        $this->data['entry_cartao'] = $this->language->get('entry_cartao');
        $this->data['entry_titular'] = $this->language->get('entry_titular');
        $this->data['entry_parcelas'] = $this->language->get('entry_parcelas');
        $this->data['entry_validade_mes'] = $this->language->get('entry_validade_mes');
        $this->data['entry_validade_ano'] = $this->language->get('entry_validade_ano');
        $this->data['entry_codigo'] = $this->language->get('entry_codigo');
        $this->data['entry_captcha'] = $this->language->get('entry_captcha');

        $this->data['error_parcelas'] = $this->language->get('error_parcelas');
        $this->data['error_cartao'] = $this->language->get('error_cartao');
        $this->data['error_titular'] = $this->language->get('error_titular');
        $this->data['error_mes'] = $this->language->get('error_mes');
        $this->data['error_ano'] = $this->language->get('error_ano');
        $this->data['error_codigo'] = $this->language->get('error_codigo');

        $this->data['error_bandeiras'] = $this->language->get('error_bandeiras');
        $this->data['error_configuracao'] = $this->language->get('error_configuracao');

        $this->data['ambiente'] = $this->config->get('cielo_api_credito_ambiente');

        $this->data['exibir_juros'] = $this->config->get('cielo_api_credito_exibir_juros');

        $this->data['cor_normal_texto'] = $this->config->get('cielo_api_credito_cor_normal_texto');
        $this->data['cor_normal_fundo'] = $this->config->get('cielo_api_credito_cor_normal_fundo');
        $this->data['cor_normal_borda'] = $this->config->get('cielo_api_credito_cor_normal_borda');
        $this->data['cor_efeito_texto'] = $this->config->get('cielo_api_credito_cor_efeito_texto');
        $this->data['cor_efeito_fundo'] = $this->config->get('cielo_api_credito_cor_efeito_fundo');
        $this->data['cor_efeito_borda'] = $this->config->get('cielo_api_credito_cor_efeito_borda');

        $this->data['bandeiras'] = array();
        foreach ($this->getBandeiras() as $bandeira => $parcelamento) {
            ($this->config->get('cielo_api_credito_' . $bandeira)) ? array_push($this->data['bandeiras'], $bandeira) : '';
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

        $this->data['captcha'] = $this->config->get('cielo_api_credito_recaptcha_status');
        if ($this->data['captcha']) {
            $this->data['site_key'] = $this->config->get('cielo_api_credito_recaptcha_site_key');
        }

        if (isset($this->session->data['attempts'])) {
            unset($this->session->data['attempts']);
        }
        $this->session->data['attempts'] = 3;

        include_once(DIR_SYSTEM . 'library/cielo_api/versao.php');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/cielo_api_credito.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/payment/cielo_api_credito.tpl';
        } else {
            $this->template = 'default/template/payment/cielo_api_credito.tpl';
        }

        $this->render();
    }

    public function bandeiras() {
        $json = array();

        if (isset($this->session->data['order_id']) && isset($this->session->data['attempts'])) {
            foreach ($this->getBandeiras() as $bandeira => $parcelas) {
                ($this->config->get('cielo_api_credito_' . $bandeira)) ? $json[] = array('bandeira' => $bandeira, 'titulo' => strtoupper($bandeira), 'imagem' => HTTPS_SERVER .'image/cielo_api/'. $bandeira .'.png', 'parcelas' => $parcelas) : '';
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function parcelas() {
        $json = array();

        if (isset($this->session->data['order_id']) && isset($this->session->data['attempts']) && isset($this->request->get['bandeira'])) {
            $valorMinimo = ($this->config->get('cielo_api_credito_minimo') > 0) ? $this->config->get('cielo_api_credito_minimo') : '0';

            $this->load->model('checkout/order');
            $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

            $this->valorTotal = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);

            $total = $this->valorTotal;
            $desconto = ($this->config->get('cielo_api_credito_desconto')) ? (float)$this->config->get('cielo_api_credito_desconto') : 0;

            $bandeira = $this->request->get['bandeira'];
            $currency_code = $this->currency->getCode();

            if ((strtolower($bandeira) != 'discover') && (strtoupper($currency_code) == 'BRL')) {
                $parcelas = $this->config->get('cielo_api_credito_'. strtolower($bandeira) .'_parcelas');
                $sem_juros = $this->config->get('cielo_api_credito_'. strtolower($bandeira) .'_sem_juros');
                $juros = $this->config->get('cielo_api_credito_'. strtolower($bandeira) .'_juros');

                for ($i = 1; $i <= $parcelas; $i++) {
                    if ($i <= $sem_juros) {
                        if ($i == 1) {
                            if ($desconto > 0) {
                                $this->load->model('payment/cielo_api_credito');
                                $shipping = $this->model_payment_cielo_api_credito->getOrderShippingValue($this->session->data['order_id']);

                                $shipping = $this->currency->format($shipping, $order_info['currency_code'], $order_info['currency_value'], false);
                                $subtotal = $total-$shipping;
                                $desconto = ($subtotal*$desconto)/100;
                                $valorParcela = ($subtotal-$desconto)+$shipping;
                                $desconto = $this->currency->format($desconto, $order_info['currency_code'], '1.00', true);
                            } else {
                                $valorParcela = $total;
                            }

                            $json[] = array(
                                'parcela' => 1,
                                'desconto' => $desconto,
                                'valor' => $this->currency->format($valorParcela, $order_info['currency_code'], '1.00', true),
                                'juros' => 0,
                                'total' => $this->currency->format($valorParcela, $order_info['currency_code'], '1.00', true)
                            );
                        } else {
                            $valorParcela = ($total/$i);
                            if ($valorParcela >= $valorMinimo) {
                                $json[] = array(
                                    'parcela' => $i,
                                    'desconto' => 0,
                                    'valor' => $this->currency->format($valorParcela, $order_info['currency_code'], '1.00', true),
                                    'juros' => 0,
                                    'total' => $this->currency->format($total, $order_info['currency_code'], '1.00', true)
                                );
                            }
                        }
                    } else {
                        $total = $this->getParcelar($bandeira, $i);
                        if ($total['valorParcela'] >= $valorMinimo) {
                            $json[] = array(
                                'parcela' => $i,
                                'desconto' => 0,
                                'valor' => $this->currency->format($total['valorParcela'], $order_info['currency_code'], '1.00', true),
                                'juros' => $juros,
                                'total' => $this->currency->format($total['valorTotal'], $order_info['currency_code'], '1.00', true)
                            );
                        }
                    }
                }
            } else {
                if ($desconto > 0) {
                    $this->load->model('payment/cielo_api_credito');
                    $shipping = $this->model_payment_cielo_api_credito->getOrderShippingValue($this->session->data['order_id']);

                    $shipping = $this->currency->format($shipping, $order_info['currency_code'], $order_info['currency_value'], false);
                    $total = $total-$shipping;
                    $desconto = ($total*$desconto)/100;
                    $valorParcela = ($total-$desconto)+$shipping;
                    $desconto = $this->currency->format($desconto, $order_info['currency_code'], '1.00', true);
                } else {
                    $valorParcela = $total;
                }

                $json[] = array(
                    'parcela' => 1,
                    'desconto' => $desconto,
                    'valor' => $this->currency->format($valorParcela, $order_info['currency_code'], '1.00', true),
                    'juros' => 0,
                    'total' => $this->currency->format($valorParcela, $order_info['currency_code'], '1.00', true)
                );
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
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
                'href' => $this->url->link('payment/cielo_api_credito/comprovante', '', 'SSL'),
                'text' => $this->language->get('text_success'),
                'separator' => $this->language->get('text_separator')
            );

            $this->data['heading_title'] = $this->language->get('heading_title');

            $this->data['text_title'] = $this->language->get('text_title');

            $this->data['text_importante'] = $this->language->get('text_importante');
            $this->data['text_comprovante'] = $this->session->data['comprovante'];

            $this->data['button_imprimir'] = $this->language->get('button_imprimir');

            $this->data['print'] = $this->url->link('payment/cielo_api_credito/imprimir');
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

    private function getBandeiras() {
        $bandeiras = array(
            "visa" => $this->config->get('cielo_api_credito_visa_parcelas'),
            "mastercard" => $this->config->get('cielo_api_credito_mastercard_parcelas'),
            "diners" => $this->config->get('cielo_api_credito_diners_parcelas'),
            "discover" => '1',
            "elo" => $this->config->get('cielo_api_credito_elo_parcelas'),
            "amex" => $this->config->get('cielo_api_credito_amex_parcelas'),
            "hipercard" => $this->config->get('cielo_api_credito_hipercard_parcelas'),
            "jcb" => $this->config->get('cielo_api_credito_jcb_parcelas'),
            "aura" => $this->config->get('cielo_api_credito_aura_parcelas')
        );

        return $bandeiras;
    }

    private function getParcelar($bandeira, $parcelas) {
        if ((strtolower($bandeira) != 'discover') && (strtoupper($this->currency->getCode() == 'BRL'))) {
            $parcelar = $this->config->get('cielo_api_credito_'. strtolower($bandeira) .'_parcelas');
            $juros = $this->config->get('cielo_api_credito_'. strtolower($bandeira) .'_juros')/100;
            $calculo = $this->config->get('cielo_api_credito_calculo');

            if ($parcelas > $parcelar) {
                $parcelas = $parcelar;
            }

            if ($calculo) {
                $valorParcela = ($this->valorTotal*$juros)/(1-(1/pow(1+$juros, $parcelas)));
            } else {
                $valorParcela = ($this->valorTotal*pow(1+$juros, $parcelas))/$parcelas;
            }

            $valorParcela = round($valorParcela, 2);
            $valorTotal = $parcelas * $valorParcela;
        } else {
            $valorParcela = $this->valorTotal;
            $valorTotal = $this->valorTotal;
        }

        return array(
            'valorParcela' => $valorParcela,
            'valorTotal' => $valorTotal
        );
    }

    public function setTransacao() {
        $json = array();

        $this->language->load('payment/cielo_api_credito');

        if (isset($this->session->data['order_id']) && isset($this->session->data['attempts']) && $this->setValidarPost()) {
            if ($this->setValidarCaptcha()) {
                if (($this->session->data['attempts'] > 0) && ($this->session->data['attempts'] <= 3)) {
                    $bandeiraCartao = trim($this->request->post['bandeira']);
                    $parcelasCartao = preg_replace("/[^0-9]/", '', $this->request->post['parcelas']);
                    $titularCartao = trim($this->request->post['titular']);
                    $numeroCartao = preg_replace("/[^0-9]/", '', $this->request->post['cartao']);
                    $validadeMes = preg_replace("/[^0-9]/", '', $this->request->post['mes']);
                    $validadeAno = preg_replace("/[^0-9]/", '', $this->request->post['ano']);
                    $codigoCartao = preg_replace("/[^0-9]/", '', $this->request->post['codigo']);

                    $campos = array($bandeiraCartao, $parcelasCartao, $titularCartao, $numeroCartao, $validadeMes, $validadeAno, $codigoCartao);
                    $bandeiras = $this->getBandeiras();

                    if ($this->setValidarCampos($campos) && array_key_exists(strtolower($bandeiraCartao), $bandeiras) && ($parcelasCartao <= '12')) {
                        $this->session->data['attempts']--;
                        $numPedido = $this->session->data['order_id'];

                        $this->load->model('checkout/order');
                        $order_info = $this->model_checkout_order->getOrder($numPedido);

                        if ($order_info['order_status_id'] == 0) {
                            $this->model_checkout_order->confirm($numPedido, $this->config->get('cielo_api_credito_situacao_pendente_id'), $this->language->get('text_payment'), true);
                        }

                        $this->valorTotal = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
                        $desconto = ($this->config->get('cielo_api_credito_desconto')) ? (float)$this->config->get('cielo_api_credito_desconto') : 0;
                        if ($parcelasCartao <= '1') {
                            if ($desconto > 0) {
                                $this->load->model('payment/cielo_api_credito');
                                $shipping = $this->model_payment_cielo_api_credito->getOrderShippingValue($this->session->data['order_id']);

                                $shipping = $this->currency->format($shipping, $order_info['currency_code'], $order_info['currency_value'], false);
                                $total = $this->valorTotal;
                                $total = $total-$shipping;
                                $desconto = ($total*$desconto)/100;
                                $total = ($total-$desconto)+$shipping;
                            } else {
                                $total = $this->valorTotal;
                            }
                        } else {
                            $sem_juros = $this->config->get('cielo_api_credito_'. strtolower($bandeiraCartao) .'_sem_juros');
                            if ($parcelasCartao <= $sem_juros) {
                                $total = $this->valorTotal;
                            } else {
                                $resultado = $this->getParcelar($bandeiraCartao, $parcelasCartao);
                                $total = $resultado['valorTotal'];
                            }
                        }
                        $total = number_format($total, 2, '', '');

                        $bandeirasCielo = array(
                            'visa' => 'Visa',
                            'mastercard' => 'Master',
                            'diners' => 'Diners',
                            'discover' => 'Discover',
                            'elo' => 'Elo',
                            'amex' => 'Amex',
                            'hipercard' => 'Hipercard',
                            'jcb' => 'Jcb',
                            'aura' => 'Aura',
                        );

                        $dados['MerchantOrderId'] = $numPedido;
                        $dados['Customer'] = $order_info['firstname'] . ' ' . $order_info['lastname'];
                        $dados['Amount'] = $total;
                        $dados['Installments'] = $parcelasCartao;
                        $dados['CardNumber'] = $numeroCartao;
                        $dados['Holder'] = $titularCartao;
                        $dados['ExpirationDate'] = $validadeMes . '/' . $validadeAno;
                        $dados['SecurityCode'] = $codigoCartao;
                        $dados['Brand'] = $bandeirasCielo[$bandeiraCartao];

                        $dados['Capture'] = ($this->config->get('cielo_api_credito_captura')) ? 'true' : 'false';
                        $dados['SoftDescriptor'] = $this->config->get('cielo_api_credito_soft_descriptor');

                        $dados['MerchantId'] = $this->config->get('cielo_api_credito_merchantid');
                        $dados['MerchantKey'] = $this->config->get('cielo_api_credito_merchantkey');
                        $dados['Chave'] = $this->config->get('cielo_api_credito_chave');
                        $dados['Debug'] = ($this->config->get('cielo_api_credito_debug')) ? true : false;

                        require_once(DIR_SYSTEM . 'library/cielo_api/debug.php');
                        require_once(DIR_SYSTEM . 'library/cielo_api/cielo.php');
                        $sandbox = ($this->config->get('cielo_api_credito_ambiente')) ? true : false;
                        $cielo = new Cielo($sandbox);
                        $resposta = $cielo->setTransactionCredit($dados);

                        if ($resposta) {
                            if (!empty($resposta->Payment)) {
                                $transacaoStatus = $resposta->Payment->Status;
                                $transacaoData = date('d/m/Y H:i', strtotime($resposta->Payment->ReceivedDate));
                                $transacaoTid = $resposta->Payment->Tid;
                                $transacaoPaymentId = $resposta->Payment->PaymentId;
                                $transacaoTipo = $resposta->Payment->Type;
                                $transacaoParcelas = $resposta->Payment->Installments;
                                $transacaoBandeira = $resposta->Payment->CreditCard->Brand;
                                $transacaoValor = $this->currency->format(($resposta->Payment->Amount / 100), $order_info['currency_code'], '1.00', true);

                                if (!empty($transacaoStatus)) {
                                    switch($transacaoStatus) {
                                        case '0':
                                            $comment = $this->language->get('entry_pedido') . $numPedido . "\n";
                                            $comment .= $this->language->get('entry_data') . $transacaoData . "\n";
                                            $comment .= $this->language->get('entry_tid') . $transacaoTid . "\n";
                                            $comment .= $this->language->get('entry_tipo') . $this->language->get('text_cartao_credito') . "\n";
                                            $comment .= $this->language->get('entry_bandeira') . strtoupper($transacaoBandeira) . "\n";
                                            $comment .= $this->language->get('entry_parcelas') . $transacaoParcelas . 'x ' . $this->language->get('text_total') . $transacaoValor . "\n";
                                            $comment .= $this->language->get('entry_status') . $this->language->get('text_pendente');

                                            $campos = array(
                                                'order_id' => $numPedido,
                                                'status' => $transacaoStatus,
                                                'paymentId' => $transacaoPaymentId,
                                                'tid' => $transacaoTid,
                                                'nsu' => (isset($resposta->Payment->ProofOfSale)) ? $resposta->Payment->ProofOfSale : '',
                                                'tipo' => $transacaoTipo,
                                                'parcelas' => $transacaoParcelas,
                                                'bandeira' => $transacaoBandeira,
                                                'json' => json_encode($resposta)
                                            );

                                            $this->load->model('payment/cielo_api_credito');
                                            $this->model_payment_cielo_api_credito->addTransaction($campos);

                                            $this->load->model('checkout/order');
                                            $this->model_checkout_order->update($numPedido, $this->config->get('cielo_api_credito_situacao_pendente_id'), $comment, true);

                                            if (isset($this->session->data['comprovante'])) {
                                                unset($this->session->data['comprovante']);
                                            }
                                            $this->session->data['comprovante'] = $comment;

                                            $json['redirect'] = $this->url->link('payment/cielo_api_credito/comprovante', '', 'SSL');
                                            break;
                                        case '1':
                                            if ($this->config->get('cielo_api_credito_clearsale_status')) {
                                                $analise = true;
                                            } else if ($this->config->get('cielo_api_credito_fcontrol_status')) {
                                                $analise = true;
                                            } else {
                                                $analise = false;
                                            }

                                            $comment = $this->language->get('entry_pedido') . $numPedido . "\n";
                                            $comment .= $this->language->get('entry_data') . $transacaoData . "\n";
                                            $comment .= $this->language->get('entry_tid') . $transacaoTid . "\n";
                                            $comment .= $this->language->get('entry_nsu') . $resposta->Payment->ProofOfSale . "\n";
                                            $comment .= $this->language->get('entry_tipo') . $this->language->get('text_cartao_credito') . "\n";
                                            $comment .= $this->language->get('entry_bandeira') . strtoupper($transacaoBandeira) . "\n";
                                            $comment .= $this->language->get('entry_parcelas') . $transacaoParcelas . 'x ' . $this->language->get('text_total') . $transacaoValor . "\n";
                                            $comment .= $this->language->get('entry_status') . ($analise) ? $this->language->get('text_em_analise') : $this->language->get('text_autorizado');

                                            $campos = array(
                                                'order_id' => $numPedido,
                                                'status' => $transacaoStatus,
                                                'dataPedido' => $resposta->Payment->ReceivedDate,
                                                'tid' => $transacaoTid,
                                                'nsu' => $resposta->Payment->ProofOfSale,
                                                'authorizationCode' => $resposta->Payment->AuthorizationCode,
                                                'paymentId' => $transacaoPaymentId,
                                                'tipo' => $transacaoTipo,
                                                'parcelas' => $transacaoParcelas,
                                                'bandeira' => $transacaoBandeira,
                                                'autorizacaoData' => $resposta->Payment->ReceivedDate,
                                                'autorizacaoValor' => $resposta->Payment->Amount,
                                                'json' => json_encode($resposta)
                                            );

                                            $this->load->model('payment/cielo_api_credito');
                                            $this->model_payment_cielo_api_credito->addTransaction($campos);

                                            $this->load->model('checkout/order');
                                            $this->model_checkout_order->update($numPedido, $this->config->get('cielo_api_credito_situacao_autorizada_id'), $comment, true);

                                            if (isset($this->session->data['comprovante'])) {
                                                unset($this->session->data['comprovante']);
                                            }
                                            $this->session->data['comprovante'] = $comment;

                                            $json['redirect'] = $this->url->link('payment/cielo_api_credito/comprovante', '', 'SSL');
                                            break;
                                        case '2':
                                            $transacaoData = date('d/m/Y H:i', strtotime($resposta->Payment->CapturedDate));
                                            $transacaoValor = $this->currency->format(($resposta->Payment->CapturedAmount / 100), $order_info['currency_code'], '1.00', true);

                                            $comment = $this->language->get('entry_pedido') . $numPedido . "\n";
                                            $comment .= $this->language->get('entry_data') . $transacaoData . "\n";
                                            $comment .= $this->language->get('entry_tid') . $transacaoTid . "\n";
                                            $comment .= $this->language->get('entry_nsu') . $resposta->Payment->ProofOfSale . "\n";
                                            $comment .= $this->language->get('entry_tipo') . $this->language->get('text_cartao_credito') . "\n";
                                            $comment .= $this->language->get('entry_bandeira') . strtoupper($transacaoBandeira) . "\n";
                                            $comment .= $this->language->get('entry_parcelas') . $transacaoParcelas . 'x ' . $this->language->get('text_total') . $transacaoValor . "\n";
                                            $comment .= $this->language->get('entry_status') . $this->language->get('text_capturado');

                                            $campos = array(
                                                'order_id' => $numPedido,
                                                'status' => $transacaoStatus,
                                                'dataPedido' => $resposta->Payment->ReceivedDate,
                                                'tid' => $transacaoTid,
                                                'nsu' => $resposta->Payment->ProofOfSale,
                                                'authorizationCode' => $resposta->Payment->AuthorizationCode,
                                                'paymentId' => $transacaoPaymentId,
                                                'tipo' => $transacaoTipo,
                                                'parcelas' => $transacaoParcelas,
                                                'bandeira' => $transacaoBandeira,
                                                'autorizacaoData' => $resposta->Payment->ReceivedDate,
                                                'autorizacaoValor' => $resposta->Payment->Amount,
                                                'capturaData' => $resposta->Payment->CapturedDate,
                                                'capturaValor' => $resposta->Payment->CapturedAmount,
                                                'json' => json_encode($resposta)
                                            );

                                            $this->load->model('payment/cielo_api_credito');
                                            $this->model_payment_cielo_api_credito->addTransaction($campos);

                                            $this->load->model('checkout/order');
                                            $this->model_checkout_order->update($numPedido, $this->config->get('cielo_api_credito_situacao_capturada_id'), $comment, true);

                                            if (isset($this->session->data['comprovante'])) {
                                                unset($this->session->data['comprovante']);
                                            }
                                            $this->session->data['comprovante'] = $comment;

                                            $json['redirect'] = $this->url->link('payment/cielo_api_credito/comprovante', '', 'SSL');
                                            break;
                                        case '12':
                                            $comment = $this->language->get('entry_pedido') . $numPedido . "\n";
                                            $comment .= $this->language->get('entry_data') . $transacaoData . "\n";
                                            $comment .= $this->language->get('entry_tid') . $transacaoTid . "\n";
                                            $comment .= $this->language->get('entry_tipo') . $this->language->get('text_cartao_credito') . "\n";
                                            $comment .= $this->language->get('entry_bandeira') . strtoupper($transacaoBandeira) . "\n";
                                            $comment .= $this->language->get('entry_parcelas') . $transacaoParcelas . 'x ' . $this->language->get('text_total') . $transacaoValor . "\n";
                                            $comment .= $this->language->get('entry_status') . $this->language->get('text_pendente');

                                            $campos = array(
                                                'order_id' => $numPedido,
                                                'status' => $transacaoStatus,
                                                'paymentId' => $transacaoPaymentId,
                                                'tid' => $transacaoTid,
                                                'nsu' => (isset($resposta->Payment->ProofOfSale)) ? $resposta->Payment->ProofOfSale : '',
                                                'tipo' => $transacaoTipo,
                                                'parcelas' => $transacaoParcelas,
                                                'bandeira' => $transacaoBandeira,
                                                'json' => json_encode($resposta)
                                            );

                                            $this->load->model('payment/cielo_api_credito');
                                            $this->model_payment_cielo_api_credito->addTransaction($campos);

                                            $this->load->model('checkout/order');
                                            $this->model_checkout_order->update($numPedido, $this->config->get('cielo_api_credito_situacao_pendente_id'), $comment, true);

                                            if (isset($this->session->data['comprovante'])) {
                                                unset($this->session->data['comprovante']);
                                            }
                                            $this->session->data['comprovante'] = $comment;

                                            $json['redirect'] = $this->url->link('payment/cielo_api_credito/comprovante', '', 'SSL');
                                            break;
                                        default:
                                            $comment = $this->language->get('entry_pedido') . $numPedido . "\n";
                                            $comment .= $this->language->get('entry_data') . $transacaoData . "\n";
                                            $comment .= $this->language->get('entry_tid') . $transacaoTid . "\n";
                                            if (isset($resposta->Payment->ProofOfSale)) {
                                                $comment .= $this->language->get('entry_nsu') . $resposta->Payment->ProofOfSale . "\n";
                                            }
                                            $comment .= $this->language->get('entry_tipo') . $this->language->get('text_cartao_credito') . "\n";
                                            $comment .= $this->language->get('entry_bandeira') . strtoupper($transacaoBandeira) . "\n";
                                            $comment .= $this->language->get('entry_parcelas') . $transacaoParcelas . 'x ' . $this->language->get('text_total') . $transacaoValor . "\n";
                                            $comment .= $this->language->get('entry_status') . $this->language->get('text_nao_autorizado');

                                            $this->model_checkout_order->update($numPedido, $this->config->get('cielo_api_credito_situacao_nao_autorizada_id'), $comment, true);

                                            $json['error'] = $this->language->get('error_autorizacao');
                                            break;
                                    }
                                } else {
                                    $json['error'] = $this->language->get('error_status');
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
                            $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('cielo_api_credito_situacao_nao_autorizada_id'), $this->language->get('text_tentativas'), true);
                        } else {
                            $this->model_checkout_order->update($this->session->data['order_id'], $this->config->get('cielo_api_credito_situacao_nao_autorizada_id'), $this->language->get('text_tentativas'), true);
                        }
                    }

                    $json['error'] = $this->language->get('error_tentativas');
                }
            } else {
                if (($this->session->data['attempts'] < 0) || ($this->session->data['attempts'] > 3)) {
                    $json['error'] = $this->language->get('error_tentativas');
                } else {
                    $json['error'] = $this->language->get('error_captcha');
                }
            }
        } else {
            $json['error'] = $this->language->get('error_permissao');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    private function setValidarPost() {
        $campos = array('bandeira', 'parcelas', 'cartao', 'mes', 'ano', 'codigo');

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

    public function setValidarCaptcha() {
        if (!$this->config->get('cielo_api_credito_recaptcha_status')) {
            return true;
        }

        if (!isset($this->session->data['attempts'])) {
            return false;
        }

        if (($this->session->data['attempts'] < 0) || ($this->session->data['attempts'] > 3)) {
            return false;
        }

        if (!isset($this->request->post['g-recaptcha-response'])) {
            return false;
        }

        if (empty($this->request->post['g-recaptcha-response'])) {
            return false;
        }

        $recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->config->get('cielo_api_credito_recaptcha_secret_key')) . '&response=' . $this->request->post['g-recaptcha-response'] . '&remoteip=' . $this->request->server['REMOTE_ADDR']);
        $recaptcha = json_decode($recaptcha, true);

        if ($recaptcha['success']) {
            return true;
        } else {
            return false;
        }
    }
}
?>