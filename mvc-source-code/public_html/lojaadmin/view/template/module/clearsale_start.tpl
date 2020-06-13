<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-clearsale-start" input type="hidden" id="save_stay" name="save_stay" value="1" data-toggle="tooltip" title="<?php echo $button_save_stay; ?>" class="btn btn-success"><i class="fa fa-save"></i></button>
        <button type="submit" form="form-clearsale-start" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1> <span class="badge"><?php echo $versao; ?></span>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-clearsale-start" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-geral" data-toggle="tab"><?php echo $tab_geral; ?></a></li>
            <li><a href="#tab-api" data-toggle="tab"><?php echo $tab_api; ?></a></li>
            <li><a href="#tab-campos" data-toggle="tab"><?php echo $tab_campos; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-geral">
              <div class="form-group">
                <div class="col-sm-3">
                  <h5><span class="text-danger">*</span> <strong><?php echo $entry_order_status; ?></strong></h5>
                  <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_order_status; ?></span>
                </div>
                <div class="col-sm-6">
                  <div class="well well-sm" style="height: 300px; overflow: auto;">
                    <?php foreach ($orders_status as $order_status) { ?>
                    <div class="checkbox">
                      <label>
                        <?php if (in_array($order_status['order_status_id'], $clearsale_start_orders_status)) { ?>
                        <input type="checkbox" name="clearsale_start_orders_status[]" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" />
                        <?php echo $order_status['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="clearsale_start_orders_status[]" value="<?php echo $order_status['order_status_id']; ?>" />
                        <?php echo $order_status['name']; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                  <?php if ($error_orders_status) { ?>
                  <div class="text-danger"><?php echo $error_orders_status; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-3">
                  <h5><strong><?php echo $entry_metodo; ?></strong></h5>
                  <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_metodo; ?></span>
                </div>
                <div class="col-sm-2">
                  <select name="clearsale_start_metodo" class="form-control">
                    <?php if ($clearsale_start_metodo) { ?>
                    <option value="1" selected="selected"><?php echo $text_automatico; ?></option>
                    <option value="0"><?php echo $text_manual; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_automatico; ?></option>
                    <option value="0" selected="selected"><?php echo $text_manual; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-3">
                  <h5><strong><?php echo $entry_status; ?></strong></h5>
                </div>
                <div class="col-sm-2">
                  <select name="clearsale_start_status" class="form-control">
                    <?php if ($clearsale_start_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-api">
              <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_info_api; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>
              <div class="form-group">
                <div class="col-sm-3">
                  <h5><span class="text-danger">*</span> <strong><?php echo $entry_codigo; ?></strong></h5>
                  <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_codigo; ?></span>
                </div>
                <div class="col-sm-5">
                  <input type="text" name="clearsale_start_codigo" value="<?php echo $clearsale_start_codigo; ?>" placeholder="" class="form-control" />
                  <?php if ($error_codigo) { ?>
                  <div class="text-danger"><?php echo $error_codigo; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-3">
                  <h5><span class="text-danger">*</span> <strong><?php echo $entry_ambiente; ?></strong></h5>
                  <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_ambiente; ?></span>
                </div>
                <div class="col-sm-2">
                  <select name="clearsale_start_ambiente" class="form-control">
                    <?php if ($clearsale_start_ambiente) { ?>
                    <option value="1" selected="selected"><?php echo $text_producao; ?></option>
                    <option value="0"><?php echo $text_homologacao; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_producao; ?></option>
                    <option value="0" selected="selected"><?php echo $text_homologacao; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <fieldset>
                <legend><?php echo $text_pagamentos; ?></legend>
                <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_info_pagamentos; ?>
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_cartao_credito; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_cartao_credito; ?></span>
                  </div>
                  <div class="col-sm-4">
                    <select name="clearsale_start_cartao_credito" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php foreach ($payments as $payment) { ?>
                      <?php if ($payment['code'] == $clearsale_start_cartao_credito) { ?>
                      <option value="<?php echo $payment['code']; ?>" selected="selected"><?php echo $payment['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $payment['code']; ?>"><?php echo $payment['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_boleto; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_boleto; ?></span>
                  </div>
                  <div class="col-sm-4">
                    <select name="clearsale_start_boleto" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php foreach ($payments as $payment) { ?>
                      <?php if ($payment['code'] == $clearsale_start_boleto) { ?>
                      <option value="<?php echo $payment['code']; ?>" selected="selected"><?php echo $payment['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $payment['code']; ?>"><?php echo $payment['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_sedex_cobrar; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_sedex_cobrar; ?></span>
                  </div>
                  <div class="col-sm-4">
                    <select name="clearsale_start_sedex_cobrar" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php foreach ($payments as $payment) { ?>
                      <?php if ($payment['code'] == $clearsale_start_sedex_cobrar) { ?>
                      <option value="<?php echo $payment['code']; ?>" selected="selected"><?php echo $payment['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $payment['code']; ?>"><?php echo $payment['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_cheque; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_cheque; ?></span>
                  </div>
                  <div class="col-sm-4">
                    <select name="clearsale_start_cheque" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php foreach ($payments as $payment) { ?>
                      <?php if ($payment['code'] == $clearsale_start_cheque) { ?>
                      <option value="<?php echo $payment['code']; ?>" selected="selected"><?php echo $payment['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $payment['code']; ?>"><?php echo $payment['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_financiamento; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_financiamento; ?></span>
                  </div>
                  <div class="col-sm-4">
                    <select name="clearsale_start_financiamento" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php foreach ($payments as $payment) { ?>
                      <?php if ($payment['code'] == $clearsale_start_financiamento) { ?>
                      <option value="<?php echo $payment['code']; ?>" selected="selected"><?php echo $payment['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $payment['code']; ?>"><?php echo $payment['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_fatura; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_fatura; ?></span>
                  </div>
                  <div class="col-sm-4">
                    <select name="clearsale_start_fatura" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php foreach ($payments as $payment) { ?>
                      <?php if ($payment['code'] == $clearsale_start_fatura) { ?>
                      <option value="<?php echo $payment['code']; ?>" selected="selected"><?php echo $payment['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $payment['code']; ?>"><?php echo $payment['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_multicheque; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_multicheque; ?></span>
                  </div>
                  <div class="col-sm-4">
                    <select name="clearsale_start_multicheque" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php foreach ($payments as $payment) { ?>
                      <?php if ($payment['code'] == $clearsale_start_multicheque) { ?>
                      <option value="<?php echo $payment['code']; ?>" selected="selected"><?php echo $payment['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $payment['code']; ?>"><?php echo $payment['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_outros; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_outros; ?></span>
                  </div>
                  <div class="col-sm-4">
                    <select name="clearsale_start_outros" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php foreach ($payments as $payment) { ?>
                      <?php if ($payment['code'] == $clearsale_start_outros) { ?>
                      <option value="<?php echo $payment['code']; ?>" selected="selected"><?php echo $payment['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $payment['code']; ?>"><?php echo $payment['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="tab-pane" id="tab-campos">
              <fieldset>
                <legend><?php echo $text_campos_cartao; ?></legend>
                <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_info_cartao; ?>
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_cartao_parcelas; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_cartao_parcelas; ?></span>
                  </div>
                  <div class="col-sm-3">
                    <label><?php echo $text_cartao_tabela; ?></label>
                    <select name="clearsale_start_cartao_tabela" class="form-control" onchange="columns(this);">
                      <option value=""><?php echo $text_select_table; ?></option>
                      <?php foreach ($tables as $table) { ?>
                      <?php if ($table['_table'] == $clearsale_start_cartao_tabela) { ?>
                      <option value="<?php echo $table['_table']; ?>" selected="selected"><?php echo $table['_table']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $table['_table']; ?>"><?php echo $table['_table']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <label><?php echo $text_cartao_coluna_order_id; ?></label>
                    <select name="clearsale_start_cartao_coluna_order_id" class="form-control">
                      <option value=""><?php echo $text_select_table; ?></option>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <label><?php echo $text_cartao_coluna_parcelas; ?></label>
                    <select name="clearsale_start_cartao_coluna_parcelas" class="form-control">
                      <option value=""><?php echo $text_select_table; ?></option>
                    </select>
                    <label><?php echo $text_cartao_coluna_valor; ?></label>
                    <select name="clearsale_start_cartao_coluna_valor" class="form-control">
                      <option value=""><?php echo $text_select_table; ?></option>
                    </select>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend><?php echo $text_campos_conta; ?></legend>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_custom_razao_id; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_custom_razao_id; ?></span>
                  </div>
                  <div class="col-sm-3">
                    <label><?php echo $text_campo; ?></label>
                    <select name="clearsale_start_custom_razao_id" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php if ($clearsale_start_custom_razao_id == 'N') { ?>
                      <option value="N" selected="selected"><?php echo $text_nao_personalizado; ?></option>
                      <?php } else { ?>
                      <option value="N"><?php echo $text_nao_personalizado; ?></option>
                      <?php } ?>
                      <?php foreach ($custom_fields as $custom_field) { ?>
                      <?php if ($custom_field['location'] == 'account') { ?>
                      <?php if ($custom_field['type'] == 'text') { ?>
                      <?php if ($custom_field['custom_field_id'] == $clearsale_start_custom_razao_id) { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>" selected="selected"><?php echo $custom_field['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-3" id="razao_coluna">
                    <label><?php echo $text_razao; ?></label>
                    <select name="clearsale_start_razao_coluna" class="form-control">
                      <option value=""></option>
                      <?php foreach ($columns as $column) { ?>
                      <?php if ($column['Field'] == $clearsale_start_razao_coluna) { ?>
                      <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    <?php if ($error_razao) { ?>
                    <div class="text-danger"><?php echo $error_razao; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_custom_cnpj_id; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_custom_cnpj_id; ?></span>
                  </div>
                  <div class="col-sm-3">
                    <label><?php echo $text_campo; ?></label>
                    <select name="clearsale_start_custom_cnpj_id" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php if ($clearsale_start_custom_cnpj_id == 'N') { ?>
                      <option value="N" selected="selected"><?php echo $text_nao_personalizado; ?></option>
                      <?php } else { ?>
                      <option value="N"><?php echo $text_nao_personalizado; ?></option>
                      <?php } ?>
                      <?php foreach ($custom_fields as $custom_field) { ?>
                      <?php if ($custom_field['location'] == 'account') { ?>
                      <?php if ($custom_field['type'] == 'text') { ?>
                      <?php if ($custom_field['custom_field_id'] == $clearsale_start_custom_cnpj_id) { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>" selected="selected"><?php echo $custom_field['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-3" id="cnpj_coluna">
                    <label><?php echo $text_cnpj; ?></label>
                    <select name="clearsale_start_cnpj_coluna" class="form-control">
                      <option value=""></option>
                      <?php foreach ($columns as $column) { ?>
                      <?php if ($column['Field'] == $clearsale_start_cnpj_coluna) { ?>
                      <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    <?php if ($error_cnpj) { ?>
                    <div class="text-danger"><?php echo $error_cnpj; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><span class="text-danger">*</span> <strong><?php echo $entry_custom_cpf_id; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_custom_cpf_id; ?></span>
                  </div>
                  <div class="col-sm-3">
                    <label><?php echo $text_campo; ?></label>
                    <select name="clearsale_start_custom_cpf_id" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php if ($clearsale_start_custom_cpf_id == 'N') { ?>
                      <option value="N" selected="selected"><?php echo $text_nao_personalizado; ?></option>
                      <?php } else { ?>
                      <option value="N"><?php echo $text_nao_personalizado; ?></option>
                      <?php } ?>
                      <?php foreach ($custom_fields as $custom_field) { ?>
                      <?php if ($custom_field['location'] == 'account') { ?>
                      <?php if ($custom_field['type'] == 'text') { ?>
                      <?php if ($custom_field['custom_field_id'] == $clearsale_start_custom_cpf_id) { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>" selected="selected"><?php echo $custom_field['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-3" id="cpf_coluna">
                    <label><?php echo $text_cpf; ?></label>
                    <select name="clearsale_start_cpf_coluna" class="form-control">
                      <option value=""></option>
                      <?php foreach ($columns as $column) { ?>
                      <?php if ($column['Field'] == $clearsale_start_cpf_coluna) { ?>
                      <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    <?php if ($error_cpf) { ?>
                    <div class="text-danger"><?php echo $error_cpf; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_custom_nascimento_id; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_custom_nascimento_id; ?></span>
                  </div>
                  <div class="col-sm-3">
                    <label><?php echo $text_campo; ?></label>
                    <select name="clearsale_start_custom_nascimento_id" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php if ($clearsale_start_custom_nascimento_id == 'N') { ?>
                      <option value="N" selected="selected"><?php echo $text_nao_personalizado; ?></option>
                      <?php } else { ?>
                      <option value="N"><?php echo $text_nao_personalizado; ?></option>
                      <?php } ?>
                      <?php foreach ($custom_fields as $custom_field) { ?>
                      <?php if ($custom_field['location'] == 'account') { ?>
                      <?php if ($custom_field['type'] == 'text') { ?>
                      <?php if ($custom_field['custom_field_id'] == $clearsale_start_custom_nascimento_id) { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>" selected="selected"><?php echo $custom_field['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-3" id="nascimento_coluna">
                    <label><?php echo $text_nascimento; ?></label>
                    <select name="clearsale_start_nascimento_coluna" class="form-control">
                      <option value=""></option>
                      <?php foreach ($columns as $column) { ?>
                      <?php if ($column['Field'] == $clearsale_start_nascimento_coluna) { ?>
                      <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    <?php if ($error_nascimento) { ?>
                    <div class="text-danger"><?php echo $error_nascimento; ?></div>
                    <?php } ?>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend><?php echo $text_campos_endereco; ?></legend>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><span class="text-danger">*</span> <strong><?php echo $entry_custom_numero_id; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_custom_numero_id; ?></span>
                  </div>
                  <div class="col-sm-3">
                    <label><?php echo $text_campo; ?></label>
                    <select name="clearsale_start_custom_numero_id" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php if ($clearsale_start_custom_numero_id == 'N') { ?>
                      <option value="N" selected="selected"><?php echo $text_nao_personalizado; ?></option>
                      <?php } else { ?>
                      <option value="N"><?php echo $text_nao_personalizado; ?></option>
                      <?php } ?>
                      <?php foreach ($custom_fields as $custom_field) { ?>
                      <?php if ($custom_field['location'] == 'address') { ?>
                      <?php if ($custom_field['type'] == 'text') { ?>
                      <?php if ($custom_field['custom_field_id'] == $clearsale_start_custom_numero_id) { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>" selected="selected"><?php echo $custom_field['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-3" id="numero_fatura_coluna">
                    <label><?php echo $text_numero_fatura; ?></label>
                    <select name="clearsale_start_numero_fatura_coluna" class="form-control">
                      <option value=""></option>
                      <?php foreach ($columns as $column) { ?>
                      <?php if ($column['Field'] == $clearsale_start_numero_fatura_coluna) { ?>
                      <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    <?php if ($error_numero_fatura) { ?>
                    <div class="text-danger"><?php echo $error_numero_fatura; ?></div>
                    <?php } ?>
                  </div>
                  <div class="col-sm-3" id="numero_entrega_coluna">
                    <label><?php echo $text_numero_entrega; ?></label>
                    <select name="clearsale_start_numero_entrega_coluna" class="form-control">
                      <option value=""></option>
                      <?php foreach ($columns as $column) { ?>
                      <?php if ($column['Field'] == $clearsale_start_numero_entrega_coluna) { ?>
                      <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    <?php if ($error_numero_entrega) { ?>
                    <div class="text-danger"><?php echo $error_numero_entrega; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <h5><strong><?php echo $entry_custom_complemento_id; ?></strong></h5>
                    <span class="help"><i class="fa fa-info-circle"></i> <?php echo $help_custom_complemento_id; ?></span>
                  </div>
                  <div class="col-sm-3">
                    <label><?php echo $text_campo; ?></label>
                    <select name="clearsale_start_custom_complemento_id" class="form-control">
                      <option value=""><?php echo $text_none; ?></option>
                      <?php if ($clearsale_start_custom_complemento_id == 'N') { ?>
                      <option value="N" selected="selected"><?php echo $text_nao_personalizado; ?></option>
                      <?php } else { ?>
                      <option value="N"><?php echo $text_nao_personalizado; ?></option>
                      <?php } ?>
                      <?php foreach ($custom_fields as $custom_field) { ?>
                      <?php if ($custom_field['location'] == 'address') { ?>
                      <?php if ($custom_field['type'] == 'text') { ?>
                      <?php if ($custom_field['custom_field_id'] == $clearsale_start_custom_complemento_id) { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>" selected="selected"><?php echo $custom_field['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-3" id="complemento_fatura_coluna">
                    <label><?php echo $text_complemento_fatura; ?></label>
                    <select name="clearsale_start_complemento_fatura_coluna" class="form-control">
                      <option value=""></option>
                      <?php foreach ($columns as $column) { ?>
                      <?php if ($column['Field'] == $clearsale_start_complemento_fatura_coluna) { ?>
                      <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    <?php if ($error_complemento_fatura) { ?>
                    <div class="text-danger"><?php echo $error_complemento_fatura; ?></div>
                    <?php } ?>
                  </div>
                  <div class="col-sm-3" id="complemento_entrega_coluna">
                    <label><?php echo $text_complemento_entrega; ?></label>
                    <select name="clearsale_start_complemento_entrega_coluna" class="form-control">
                      <option value=""></option>
                      <?php foreach ($columns as $column) { ?>
                      <?php if ($column['Field'] == $clearsale_start_complemento_entrega_coluna) { ?>
                      <option value="<?php echo $column['Field']; ?>" selected="selected"><?php echo $column['Field']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    <?php if ($error_complemento_entrega) { ?>
                    <div class="text-danger"><?php echo $error_complemento_entrega; ?></div>
                    <?php } ?>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
  function columns(element) {
    $.ajax({
      url: 'index.php?route=module/clearsale_start/columns&token=<?php echo $token; ?>&table=' + element.value,
      dataType: 'json',
      beforeSend: function() {
        $('select[name=\'clearsale_start_cartao_tabela\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
      },
      complete: function() {
        $('.fa-spin').remove();
      },
      success: function(json) {
        if (json) {
          var campos = {
            clearsale_start_cartao_coluna_order_id: '<?php echo $clearsale_start_cartao_coluna_order_id; ?>',
            clearsale_start_cartao_coluna_parcelas: '<?php echo $clearsale_start_cartao_coluna_parcelas; ?>',
            clearsale_start_cartao_coluna_valor: '<?php echo $clearsale_start_cartao_coluna_valor; ?>'
          };

          for (var chave in campos){
            html = '<option value=""><?php echo $text_select_column; ?></option>';

            for (i = 0; i < json.length; i++) {
              html += '<option value="' + json[i]['Field'] + '"';

              if (json[i]['Field'] == campos[chave]) {
                html += ' selected="selected"';
              }

              html += '>' + json[i]['Field'] + '</option>';
            }

            $('select[name='+ chave +']').html(html);
          }
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  if ($('select[name=\'clearsale_start_cartao_tabela\']').val() != '') {
    $('select[name=\'clearsale_start_cartao_tabela\']').trigger('change');
  }

  $('#razao_coluna').hide();
  $('#cnpj_coluna').hide();
  $('#cpf_coluna').hide();
  $('#nascimento_coluna').hide();
  $('#numero_fatura_coluna').hide();
  $('#numero_entrega_coluna').hide();
  $('#complemento_fatura_coluna').hide();
  $('#complemento_entrega_coluna').hide();

  $('select[name=\'clearsale_start_custom_razao_id\']').on('change', function() {
    if($(this).val() == 'N'){ $('#razao_coluna').show(); }else{ $('#razao_coluna').hide(); }
  });
  $('select[name=\'clearsale_start_custom_cnpj_id\']').on('change', function() {
    if($(this).val() == 'N'){ $('#cnpj_coluna').show(); }else{ $('#cnpj_coluna').hide(); }
  });
  $('select[name=\'clearsale_start_custom_cpf_id\']').on('change', function() {
    if($(this).val() == 'N'){ $('#cpf_coluna').show(); }else{ $('#cpf_coluna').hide(); }
  });
  $('select[name=\'clearsale_start_custom_nascimento_id\']').on('change', function() {
    if($(this).val() == 'N'){ $('#nascimento_coluna').show(); }else{ $('#nascimento_coluna').hide(); }
  });
  $('select[name=\'clearsale_start_custom_numero_id\']').on('change', function() {
    if($(this).val() == 'N'){ $('#numero_fatura_coluna').show(); }else{ $('#numero_fatura_coluna').hide(); }
    if($(this).val() == 'N'){ $('#numero_entrega_coluna').show(); }else{ $('#numero_entrega_coluna').hide(); }
  });
  $('select[name=\'clearsale_start_custom_complemento_id\']').on('change', function() {
    if($(this).val() == 'N'){ $('#complemento_fatura_coluna').show(); }else{ $('#complemento_fatura_coluna').hide(); }
    if($(this).val() == 'N'){ $('#complemento_entrega_coluna').show(); }else{ $('#complemento_entrega_coluna').hide(); }
  });

  $('select[name=\'clearsale_start_custom_razao_id\']').trigger('change');
  $('select[name=\'clearsale_start_custom_cnpj_id\']').trigger('change');
  $('select[name=\'clearsale_start_custom_cpf_id\']').trigger('change');
  $('select[name=\'clearsale_start_custom_nascimento_id\']').trigger('change');
  $('select[name=\'clearsale_start_custom_numero_id\']').trigger('change');
  $('select[name=\'clearsale_start_custom_complemento_id\']').trigger('change');
//--></script>
<?php echo $footer; ?>