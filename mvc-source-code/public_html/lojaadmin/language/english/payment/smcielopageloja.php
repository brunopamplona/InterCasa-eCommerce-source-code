<?php
// Heading
$_['heading_title']              = 'System Master - Cielo Page Loja';

// Text 
$_['text_payment']               = 'Formas de Pagamento';
$_['text_success']               = 'Módulo Cielo atualizado com sucesso!';
$_['text_smcielopageloja']       = '<a onclick="window.open(\'http://www.cielo.com.br/portal/cielo/solucoes-de-tecnologia/e-commerce.html\');"><img src="view/image/payment/cielo.jpg" alt="cielo" title="cielo" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_loja']                  = 'Loja';
$_['text_administradora']        = 'Administradora';

//Tabs
$_['tab_config']        		= 'Configurações gerais';
$_['tab_config_avanc']     		= 'Configurações avançadas';
$_['tab_transacoes']    		= 'Transações efetuadas';

//Colunas
$_['coluna_order_cielo_id'] 	= 'Id';
$_['coluna_tid']				= 'TID';
$_['coluna_pan']				= 'PAN';
$_['coluna_status']				= 'Status';
$_['coluna_pedido_numero']		= 'Pedido';
$_['coluna_pedido_valor']		= 'Valor';
$_['coluna_pedido_moeda']		= 'Moeda';
$_['coluna_pedido_data'] 		= 'Data';

// Entry
$_['entry_total']       		 = 'Total:<br /><span class="help">O total que o pedido deve alcançar para que este método de pagamento seja ativado.</span>';
$_['entry_afiliacao']            = 'Afiliação:<br /><span class="help">Seu número de afiliação junto a Cielo.</span>';
$_['entry_chave']                = 'Chave:<br /><span class="help">Sua chave fornecida pela Cielo.</span>';
$_['entry_licenca']              = 'Licença:<br /><span class="help">Sua licença fornecida pela System Master.</span>';
$_['entry_teste']                = 'Modo Teste:<br /><span class="help">Ambiente de trabalho de sua loja.</span>';
$_['entry_cartao_visa']          = 'Ativar Visa:';
$_['entry_cartao_visae']         = 'Ativar Visa Electron:';
$_['entry_cartao_mastercard']    = 'Ativar Mastercard:';
$_['entry_cartao_diners']        = 'Ativar Diners:';
$_['entry_cartao_discover']      = 'Ativar Discover:';
$_['entry_cartao_elo']           = 'Ativar Elo:';
$_['entry_cartao_amex']          = 'Ativar American Express:';
$_['entry_parcelas']             = 'Nº Máx. de Parcelas: ';
$_['entry_parcelamento']         = 'Parcelamento pela:';
$_['entry_cartao_semjuros']      = 'Nº de Parcelas sem Juros:';
$_['entry_cartao_minimo']        = 'Valor mínimo por parcela:';
$_['entry_cartao_juros']         = 'Taxa de Juros Mensal (%):';
$_['entry_aprovado'] 	         = 'Situação do Pedido se Aprovado:';
$_['entry_nao_aprovado']      	 = 'Situação do Pedido se Não Aprovado:';
$_['entry_geo_zone']             = 'Região Geográfica:';
$_['entry_status']               = 'Situação:';
$_['entry_sort_order']           = 'Ordem:';
$_['entry_autentic_visa_master'] = 'Modo de autenticação para visa e master:';
$_['entry_cancel_transac_pedido_excluido'] = 'Cancelar transação ao excluir um pedido: <br> <span class="help"> Se ativado, ao excluir um pedido a transação correspondente ao mesmo será cancelada na CIELO automaticamente.</span>';
$_['entry_cancel_transac_pedido_cancelado'] = 'Cancelar transação ao cancelar um pedido: <br> <span class="help">Informe os status de pedido que implicam no cancelamento da transação correspondente devolvendo assim o valor de crédito ao cliente ao mudar o pedido para algum dos status selecionados ao lado.</span>';


// Error
$_['error_permission']           = 'Atenção: Você não possui permissão para modificar o módulo Cielo!';
$_['error_afiliacao']            = 'Atenção: Informe corretamente o número da sua afiliação junto a Cielo!';
$_['error_licenca_vazia']        = 'Atenção: Informe corretamente sua chave de licença do módulo de pagamento fornecida pela System Master!';
$_['error_licenca_expirada']     = 'Atenção: Licença expirada! Entre contato com a System Master para maiores informações.';
$_['error_licenca_invalida']     = 'Atenção: Licença inválida para esta Loja! Entre em contato com nossa equipe para solucionar o problema. System Master - (47)3264-7741';
$_['error_licenca_not_found']    = 'Atenção: Arquivo de licença inexistente! Entre em contato com nossa equipe para solucionar o problema. System Master - (47)3264-7741';
$_['error_cartao_semjuros']      = 'Atenção: Informe corretamente quantidade de parcelas sem juros!';
$_['error_cartao_minimo']        = 'Atenção: Informe o valor minimo de cada parcela!';
$_['error_cartao_juros']         = 'Atenção: Informe o corretamente a taxa de juros!';
?>