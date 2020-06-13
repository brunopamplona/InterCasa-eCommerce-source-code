<?php
// Heading
$_['heading_title']               = 'ClearSale Start';

// Text
$_['text_module']                 = 'Módulos';
$_['text_success']                = 'Módulo ClearSale Start modificado com sucesso!';
$_['text_edit']                   = 'Configurações do módulo ClearSale Start';
$_['text_info_api']               = 'As informações abaixo são fornecidas pela ClearSale.';
$_['text_info_pagamentos']        = 'Selecione os pagamentos conforme o tipo. Se não houver pagamento para o tipo, deixe vazio.';
$_['text_info_cartao']            = 'Caso utilize a análise da ClearSale para pagamento por cartão de crédito, abaixo você deve indicar em que tabela a extensão encontrará os dados do parcelamento.<br>Se todos os campos não forem preenchidos, o valor do pedido será utilizado como valor do parcelamento, e a parcela será definida como 1x.';
$_['text_automatico']             = 'Automático';
$_['text_manual']                 = 'Manual';
$_['text_homologacao']            = 'Homologação';
$_['text_producao']               = 'Produção';
$_['text_pagamentos']             = 'Formas de pagamento';
$_['text_campos_conta']           = 'Conta do cliente';
$_['text_campos_endereco']        = 'Endereço do cliente';
$_['text_campos_cartao']          = 'Dados do cartão de crédito';
$_['text_select_table']           = 'Selecione a tabela';
$_['text_select_column']          = 'Selecione a coluna';
$_['text_campo']                  = 'Campo:';
$_['text_nao_personalizado']      = 'Coluna na tabela de pedidos';
$_['text_razao']                  = 'Coluna Razão Social do cliente:';
$_['text_cnpj']                   = 'Coluna CNPJ do cliente:';
$_['text_cpf']                    = 'Coluna CPF do cliente:';
$_['text_nascimento']             = 'Coluna Data de nascimento:';
$_['text_numero_fatura']          = 'Coluna número para fatura:';
$_['text_numero_entrega']         = 'Coluna número para entrega:';
$_['text_complemento_fatura']     = 'Coluna complemento para fatura:';
$_['text_complemento_entrega']    = 'Coluna complemento para entrega:';
$_['text_cartao_tabela']          = 'Tabela com dados do parcelamento:';
$_['text_cartao_coluna_order_id'] = 'Coluna order_id:';
$_['text_cartao_coluna_parcelas'] = 'Coluna parcelas:';
$_['text_cartao_coluna_valor']    = 'Coluna total pago:';

// Tab
$_['tab_geral']                   = 'Configurações';
$_['tab_api']                     = 'API';
$_['tab_campos']                  = 'Campos';

// Button
$_['button_save_stay']            = 'Salvar e continuar';
$_['button_save']                 = 'Salvar e sair';
$_['button_consultar']            = 'Consultar na ClearSale';

// Entry
$_['entry_order_status']          = 'Situação para consulta:';
$_['entry_metodo']                = 'Método de consulta:';
$_['entry_status']                = 'Situação:';
$_['entry_codigo']                = 'Código de integração:';
$_['entry_ambiente']              = 'Ambiente de trabalho:';
$_['entry_cartao_credito']        = 'Cartão de Crédito:';
$_['entry_boleto']                = 'Boleto Bancário:';
$_['entry_sedex_cobrar']          = 'Sedex a Cobrar:';
$_['entry_cheque']                = 'Cheque:';
$_['entry_financiamento']         = 'Financiamento:';
$_['entry_fatura']                = 'Fatura:';
$_['entry_multicheque']           = 'Multicheque:';
$_['entry_outros']                = 'Outros:';
$_['entry_cartao_parcelas']       = 'Parcelamento no cartão:';
$_['entry_custom_razao_id']       = 'Razão Social:';
$_['entry_custom_cnpj_id']        = 'CNPJ:';
$_['entry_custom_cpf_id']         = 'CPF:';
$_['entry_custom_nascimento_id']  = 'Data de nascimento:';
$_['entry_custom_numero_id']      = 'Número:';
$_['entry_custom_complemento_id'] = 'Complemento:';

// Help
$_['help_order_status']           = 'Selecione as situações do pedido em que será habilitada a consulta na ClearSale.';
$_['help_metodo']                 = 'Selecione Manual caso deseje executar a consulta manualmente.';
$_['help_codigo']                 = 'Este código é fornecido pela ClearSale.';
$_['help_ambiente']               = 'Selecione Homologação para realizar testes no ambiente de homologação.';
$_['help_cartao_credito']         = 'Selecione o pagamento que corresponde ao tipo Cartão de Crédito.';
$_['help_boleto']                 = 'Selecione o pagamento que corresponde ao tipo Boleto Bancário.';
$_['help_sedex_cobrar']           = 'Selecione o pagamento que corresponde ao tipo Sedex a Cobrar.';
$_['help_cheque']                 = 'Selecione o pagamento que corresponde ao tipo Cheque.';
$_['help_financiamento']          = 'Selecione o pagamento que corresponde ao tipo Financiamento.';
$_['help_fatura']                 = 'Selecione o pagamento que corresponde ao tipo Fatura.';
$_['help_multicheque']            = 'Selecione o pagamento que corresponde ao tipo Multicheque.';
$_['help_outros']                 = 'Selecione o pagamento que corresponde ao tipo Outros.';
$_['help_cartao_parcelas']        = 'Informações sobre o parcelamento no cartão de crédito que serão enviadas a ClearSale.';
$_['help_custom_razao_id']        = 'O campo Razão Social não é nativo do OpenCart, por isso, cadastre-o como um campo do tipo Conta, e selecione-o para que a extensão funcione corretamente.';
$_['help_custom_cnpj_id']         = 'O campo CNPJ não é nativo do OpenCart, por isso, cadastre-o como um campo do tipo Conta, e selecione-o para que a extensão funcione corretamente.';
$_['help_custom_cpf_id']          = 'O campo CPF não é nativo do OpenCart, por isso, cadastre-o como um campo do tipo Conta, e selecione-o para que a extensão funcione corretamente.';
$_['help_custom_nascimento_id']   = 'O campo Data de nascimento não é nativo do OpenCart, por isso, cadastre-o como um campo do tipo Conta, e selecione-o para que a extensão funcione corretamente. O formato da data deverá ser: DD/MM/AAAA';
$_['help_custom_numero_id']       = 'O campo Número não é nativo do OpenCart, por isso, cadastre-o como um campo do tipo Endereço, e selecione-o para que a extensão funcione corretamente.';
$_['help_custom_complemento_id']  = 'O campo Complemento não é nativo do OpenCart, por isso, cadastre-o como um campo do tipo Endereço, e selecione-o para que a extensão funcione corretamente.';
$_['help_campo']                  = 'Caso o campo não seja do tipo personalizado, selecione Não personalizado, e preencha os campos ao lado.';

// Error
$_['error_permission']            = 'Atenção: Você não tem permissão para modificar o módulo ClearSale Start!';
$_['error_warning']               = 'Atenção: A extensão não foi configurada corretamente! Verifique todos os campos para corrigir os erros.';
$_['error_orders_status']         = 'É necessário selecionar pelo menos uma situação de pedido.';
$_['error_codigo']                = 'O código de integração é obrigatório.';
$_['error_iframe']                = 'Seu navegador não tem suporte para iframes.';
$_['error_coluna']                = 'Selecione a coluna.';