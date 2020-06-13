<?php
// Heading
$_['heading_title']                 = 'Cielo API Débito';

// Text
$_['text_payment']                  = 'Formas de Pagamento';
$_['text_success']                  = 'Pagamento por Cielo API Débito modificado com sucesso!';
$_['text_cielo_api_debito']         = '<a target="_BLANK" href="https://www.cielo.com.br/aceite-cartao/api/"><img src="view/image/payment/cielo.jpg" alt="Cielo API Débito" title="Cielo API Débito" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_image_manager']            = 'Gerenciador de arquivos';
$_['text_browse']                   = 'Localizar';
$_['text_clear']                    = 'Apagar';
$_['text_sandbox']                  = 'Sandbox';
$_['text_homologacao']              = 'Homologação';
$_['text_producao']                 = 'Produção';
$_['text_botao']                    = 'Cor do botão CONFIRMAR PAGAMENTO na finalização do pedido';
$_['text_texto']                    = 'Cor do texto';
$_['text_fundo']                    = 'Cor do fundo';
$_['text_borda']                    = 'Cor da borda';

// Tab
$_['tab_geral']                     = 'Configurações';
$_['tab_api']                       = 'API';
$_['tab_situacoes_pedido']          = 'Situações';
$_['tab_finalizacao']               = 'Finalização';

// Button
$_['button_save_stay']              = 'Salvar e continuar';
$_['button_save']                   = 'Salvar e sair';

// Entry
$_['entry_chave']                   = 'Chave da extensão:<br /><span class="help">A chave da extensão é fornecida pelo OpenCart Brasil.</span>';
$_['entry_total']                   = 'Total mínimo<br /><span class="help">Valor mínimo que o pedido deve alcançar para que a extensão seja habilitada. Deixe em branco se não houver valor mínimo.</span>';
$_['entry_geo_zone']                = 'Região geográfica';
$_['entry_status']                  = 'Situação';
$_['entry_sort_order']              = 'Ordem de exibição';
$_['entry_merchantid']              = 'Merchant ID<br /><span class="help">É gerado e enviado ao lojista pela Cielo através de e-mail. Você recebe após a confirmação do credenciamento da loja na Cielo. Contém 36 caracteres.</span>';
$_['entry_merchantkey']             = 'Merchant Key<br /><span class="help">É gerada e enviada ao lojista pela Cielo através de e-mail. Você recebe após a confirmação do credenciamento da loja na Cielo. Contém 40 caracteres.</span>';
$_['entry_soft_descriptor']         = 'Identificação no extrato<br /><span class="help">Texto com até 13 caracteres que será exibido no extrato bancário do cliente para que ele identifique a origem do débito. O texto não deve conter espaço, sinais de pontuação, acentuação ou ç, e deve ser preenchido em maiúsculo.</span>';
$_['entry_ambiente']                = 'Ambiente<br /><span class="help">Selecione Sandbox, caso deseje apenas testar o funcionamento da extensão na loja. Quando for vender selecione Produção.</span>';
$_['entry_debug']                   = 'Debug<br /><span class="help">Selecione Habilitado caso deseje visualizar as informações enviadas pela API da Cielo para a loja. Por padrão deixe Desabilitado.</span>';
$_['entry_visa']                    = 'Cartão Visa Electron<br /><span class="help">Para pagamento à vista, com suporte para autenticação do titular do cartão através do banco emissor.</span>';
$_['entry_mastercard']              = 'Cartão Maestro<br /><span class="help">Para pagamento à vista, com suporte para autenticação do titular do cartão através do banco emissor.</span>';
$_['entry_situacao_pendente']       = 'Pendente<br /><span class="help">Selecione a situação para identificar o pedido pendente, ou situação inicial do pedido.</span>';
$_['entry_situacao_autorizada']     = 'Autorizado<br /><span class="help">Selecione a situação para identificar o pedido que está com a transação autorizada.</span>';
$_['entry_situacao_nao_autorizada'] = 'Não autorizado<br /><span class="help">Selecione a situação para identificar o pedido que está com a transação não autorizada.</span>';
$_['entry_situacao_capturada']      = 'Capturado<br /><span class="help">Selecione a situação para identificar o pedido que está com a transação capturada.</span>';
$_['entry_situacao_cancelada']      = 'Cancelado<br /><span class="help">Selecione a situação para identificar o pedido que está com a transação cancelada.</span>';
$_['entry_titulo']                  = 'Título da extensão<br /><span class="help">Título que será exibido na finalização do pedido.</span>';
$_['entry_imagem']                  = 'Imagem da extensão<br /><span class="help">Caso selecione uma imagem, ela será exibida no lugar do título da extensão.</span>';
$_['entry_exibir_juros']            = 'Exibir percentual de juros<br /><span class="help">Se Não, aparecerá somente (com juros).</span>';
$_['entry_botao_normal']            = 'Cor inicial<br /><span class="help">Cor do botão quando o mesmo não estiver pressionado ou não estiver com o mouse sobre ele.</span>';
$_['entry_botao_efeito']            = 'Cor com efeito<br /><span class="help">Cor do botão quando o mesmo for pressionado ou quando o mouse estiver sobre ele.</span>';

// Error
$_['error_permission']              = 'Atenção: Você não tem permissão para modificar o módulo Cielo Webservice Débito!';
$_['error_warning']                 = 'Atenção: A extensão não foi configurada corretamente! Verifique todos os campos para corrigir os erros.';
$_['error_readable']                = 'Você necessita conceder permissão de leitura para o arquivo abaixo:';
$_['error_chave']                   = 'O campo Chave da extensão é obrigatório!';
$_['error_merchantid']              = 'O campo Merchant ID está vazio ou foi preenchido de maneira incorreta!';
$_['error_merchantkey']             = 'O campo Merchant Key está vazio ou foi preenchido de maneira incorreta!';
$_['error_soft_descriptor']         = 'O campo Identificação no extrato está vazio ou foi preenchido de maneira incorreta!';
$_['error_titulo']                  = 'O campo Título da extensão é obrigatório!';
?>