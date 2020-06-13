<?php
// Heading
$_['heading_title']                 = 'Cielo API Crédito';

// Text
$_['text_payment']                  = 'Formas de Pagamento';
$_['text_success']                  = 'Pagamento por Cielo API Crédito modificado com sucesso!';
$_['text_cielo_api_credito']        = '<a target="_blank" href="https://www.cielo.com.br/aceite-cartao/api/"><img src="view/image/payment/cielo.jpg" alt="Cielo API Crédito" title="Cielo API Crédito" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_image_manager']            = 'Gerenciador de arquivos';
$_['text_browse']                   = 'Localizar';
$_['text_clear']                    = 'Apagar';
$_['text_manual']                   = 'Manual';
$_['text_automatica']               = 'Automática';
$_['text_simples']                  = 'Simples';
$_['text_composto']                 = 'Composto';
$_['text_ativar']                   = 'Ativar:';
$_['text_parcelas']                 = 'Parcelar em até:';
$_['text_sem_juros']                = 'Sem juros:';
$_['text_juros']                    = 'Juros (%):';
$_['text_botao']                    = 'Cor do botão CONFIRMAR PAGAMENTO na finalização do pedido';
$_['text_texto']                    = 'Cor do texto';
$_['text_fundo']                    = 'Cor do fundo';
$_['text_borda']                    = 'Cor da borda';
$_['text_recaptcha']                = 'Integração com Google reCAPTCHA V2';
$_['text_recaptcha_registrar']      = '<a target="_blank" href="https://www.google.com/recaptcha/admin">Clique aqui</a> para acessar o site do Google reCAPTCHA e gerar suas credenciais de acesso.';
$_['text_sandbox']                  = 'Sandbox';
$_['text_homologacao']              = 'Homologação';
$_['text_producao']                 = 'Produção';

// Tab
$_['tab_geral']                     = 'Configurações';
$_['tab_api']                       = 'API';
$_['tab_parcelamentos']             = 'Parcelamentos';
$_['tab_situacoes_pedido']          = 'Situações';
$_['tab_finalizacao']               = 'Finalização';
$_['tab_campos']                    = 'Campos para antifraude';
$_['tab_clearsale']                 = 'ClearSale Start';
$_['tab_fcontrol']                  = 'Fcontrol Flex';

// Button
$_['button_save_stay']              = 'Salvar e continuar';
$_['button_save']                   = 'Salvar e sair';

// Entry
$_['entry_chave']                   = 'Chave da extensão:<br><span class="help">A chave da extensão é fornecida pelo OpenCart Brasil.</span>';
$_['entry_total']                   = 'Total mínimo<br><span class="help">Valor mínimo que o pedido deve alcançar para que a extensão seja habilitada. Deixe em branco se não houver valor mínimo.</span>';
$_['entry_geo_zone']                = 'Região geográfica';
$_['entry_status']                  = 'Situação';
$_['entry_sort_order']              = 'Ordem de exibição';
$_['entry_merchantid']              = 'Merchant ID<br><span class="help">É gerado e enviado ao lojista pela Cielo através de e-mail. Você recebe após a confirmação do credenciamento da loja na Cielo. Contém 36 caracteres.</span>';
$_['entry_merchantkey']             = 'Merchant Key<br><span class="help">É gerada e enviada ao lojista pela Cielo através de e-mail. Você recebe após a confirmação do credenciamento da loja na Cielo. Contém 40 caracteres.</span>';
$_['entry_soft_descriptor']         = 'Identificação na fatura<br><span class="help">Texto com até 13 caracteres que será exibido na fatura do cliente para que ele identifique a origem do crédito. O texto não deve conter espaço, sinais de pontuação, acentuação ou ç, e deve ser preenchido em maiúsculo. Exclusivo para VISA/MASTER.</span>';
$_['entry_ambiente']                = 'Ambiente<br><span class="help">Selecione Sandbox, caso deseje apenas testar o funcionamento da extensão na loja. Quando for vender selecione Produção.</span>';
$_['entry_debug']                   = 'Debug<br><span class="help">Selecione Habilitado caso deseje visualizar as informações enviadas pela API da Cielo para a loja. Por padrão deixe Desabilitado.</span>';
$_['entry_captura']                 = 'Tipo de captura<br><span class="help">Se você utiliza um sistema antifraude, utilize a opção Manual para autorizar e posteriormente capturar.</span>';
$_['entry_minimo']                  = 'Mínimo por parcela<br><span class="help">O valor mínimo por parcela é 5.00, abaixo desse valor, a venda será negada.</span>';
$_['entry_desconto']                = 'Desconto à vista (%)<br><span class="help">Desconto para pagamento por crédito à vista, ou seja, 1x no cartão de crédito. Deixe em branco caso você não ofereça desconto.</span>';
$_['entry_calculo']                 = 'Cálculo de juros<br><span class="help">Fórmula para cálculo de juros. O padrão é Composto. O cálculo de juros é de inteira responsabilidade da loja.</span>';
$_['entry_visa']                    = 'Cartão Visa<br><span class="help">Parcelamento em até 12x.</span>';
$_['entry_mastercard']              = 'Cartão Mastercard<br><span class="help">Parcelamento em até 12x.</span>';
$_['entry_diners']                  = 'Cartão Diners<br><span class="help">Parcelamento em até 12x.</span>';
$_['entry_discover']                = 'Cartão Discover<br><span class="help">Apenas crédito a vista</span>';
$_['entry_elo']                     = 'Cartão Elo<br><span class="help">Parcelamento em até 12x.</span>';
$_['entry_amex']                    = 'Cartão Amex<br><span class="help">Parcelamento em até 12x.</span>';
$_['entry_hipercard']               = 'Cartão Hipercard<br><span class="help">Parcelamento em até 12x.</span>';
$_['entry_jcb']                     = 'Cartão JCB<br><span class="help">Parcelamento em até 12x.</span>';
$_['entry_aura']                    = 'Cartão Aura<br><span class="help">Parcelamento em até 12x.</span>';
$_['entry_situacao_pendente']       = 'Pendente<br><span class="help">Selecione a situação para identificar o pedido pendente, ou situação inicial do pedido.</span>';
$_['entry_situacao_autorizada']     = 'Autorizado<br><span class="help">Selecione a situação para identificar o pedido que está com a transação autorizada.</span>';
$_['entry_situacao_nao_autorizada'] = 'Não autorizado<br><span class="help">Selecione a situação para identificar o pedido que está com a transação não autorizada.</span>';
$_['entry_situacao_capturada']      = 'Capturado<br><span class="help">Selecione a situação para identificar o pedido que está com a transação capturada.</span>';
$_['entry_situacao_cancelada']      = 'Cancelado<br><span class="help">Selecione a situação para identificar o pedido que está com a transação cancelada.</span>';
$_['entry_titulo']                  = 'Título da extensão<br><span class="help">Título que será exibido na finalização do pedido.</span>';
$_['entry_imagem']                  = 'Imagem da extensão<br><span class="help">Caso selecione uma imagem, ela será exibida no lugar do título da extensão.</span>';
$_['entry_exibir_juros']            = 'Exibir percentual de juros<br><span class="help">Se Não, aparecerá somente (com juros).</span>';
$_['entry_botao_normal']            = 'Cor inicial<br><span class="help">Cor do botão quando o mesmo não estiver pressionado ou não estiver com o mouse sobre ele.</span>';
$_['entry_botao_efeito']            = 'Cor com efeito<br><span class="help">Cor do botão quando o mesmo for pressionado ou quando o mouse estiver sobre ele.</span>';
$_['entry_recaptcha_site_key']      = 'Site key<br><span class="help">É gerada no site do Google reCAPTCHA.</span>';
$_['entry_recaptcha_secret_key']    = 'Secret key<br><span class="help">É gerada no site do Google reCAPTCHA.</span>';
$_['entry_recaptcha_status']        = 'Situação<br><span class="help">Selecione Habilitado para que o Google reCAPTCHA seja exibido no formulário de pagamento.</span>';
$_['entry_razao']                   = 'Razão Social do cliente:<br><span class="help">Coluna com a Razão Social do cliente na tabela de pedidos.</span>';
$_['entry_cnpj']                    = 'CNPJ do cliente:<br><span class="help">Coluna com o CNPJ do cliente na tabela de pedidos.</span>';
$_['entry_cpf']                     = 'CPF do cliente:<br><span class="help">Coluna com o CPF do cliente na tabela de pedidos.</span>';
$_['entry_numero_cobranca']         = 'Número do endereço para cobrança:<br><span class="help">Coluna com o número do endereço para cobrança na tabela de pedidos.</span>';
$_['entry_numero_entrega']          = 'Número do endereço para entrega:<br><span class="help">Coluna com o número do endereço para entrega na tabela de pedidos.</span>';
$_['entry_complemento_cobranca']    = 'Complemento do endereço para cobrança:<br><span class="help">Coluna com o complemento do endereço para cobrança na tabela de pedidos.</span>';
$_['entry_complemento_entrega']     = 'Complemento do endereço para entrega:<br><span class="help">Coluna com o complemento do endereço para entrega na tabela de pedidos.</span>';
$_['entry_clearsale_codigo']        = 'Código de integração<br><span class="help">Fornecido pela ClearSale.</span>';
$_['entry_clearsale_ambiente']      = 'Ambiente de trabalho';
$_['entry_fcontrol_login']          = 'Login na Fcontrol<br><span class="help">Fornecido pela Fcontrol.</span>';
$_['entry_fcontrol_senha']          = 'Senha na Fcontrol<br><span class="help">Fornecida pela Fcontrol, podendo ser alterada através do painel da Fcontrol.</span>';

// Error
$_['error_permission']              = 'Atenção: Você não tem permissão para modificar a extensão de pagamento Cielo API Crédito!';
$_['error_warning']                 = 'Atenção: A extensão não foi configurada corretamente! Verifique todos os campos para corrigir os erros.';
$_['error_readable']                = 'Você necessita conceder permissão de leitura para o arquivo abaixo:';
$_['error_chave']                   = 'O campo Chave da extensão é obrigatório!';
$_['error_merchantid']              = 'O campo Merchant ID está vazio ou foi preenchido de maneira incorreta!';
$_['error_merchantkey']             = 'O campo Merchant Key está vazio ou foi preenchido de maneira incorreta!';
$_['error_soft_descriptor']         = 'O campo Identificação na fatura está vazio ou foi preenchido de maneira incorreta!';
$_['error_parcelamento_juros']      = 'Preencha o juros!';
$_['error_titulo']                  = 'O campo Título da extensão é obrigatório!';
$_['error_recaptcha_site_key']      = 'O campo Site key é obrigatório!';
$_['error_recaptcha_secret_key']    = 'O campo Secret key é obrigatório!';
$_['error_campos_coluna']           = 'Preencha o nome da coluna!';
$_['error_clearsale_codigo']        = 'O campo Código de integração é obrigatório!';
$_['error_fcontrol_login']          = 'O campo Login na Fcontrol é obrigatório!';
$_['error_fcontrol_senha']          = 'O campo Senha na Fcontrol é obrigatório!';
?>