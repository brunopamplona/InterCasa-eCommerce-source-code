<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?></h1>
    </div>
    <div class="content">
      <form action="" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td class="right"><?php if ($sort == 'oc.order_id') { ?>
                <a href="<?php echo $sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_order_id; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_order; ?>"><?php echo $column_order_id; ?></a>
                <?php } ?>
              </td>
              <td class="left"><?php if ($sort == 'oc.dataPedido') { ?>
                <a href="<?php echo $sort_dataPedido; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_dataPedido; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_dataPedido; ?>"><?php echo $column_dataPedido; ?></a>
                <?php } ?>
              </td>
              <td class="left"><?php if ($sort == 'customer') { ?>
                <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_customer; ?>"><?php echo $column_customer; ?></a>
                <?php } ?>
              </td>
              <td class="right"><?php echo $column_bandeira; ?></td>
              <td class="right"><?php echo $column_parcelas; ?></td>
              <td class="right"><?php echo $column_tid; ?></td>
              <td class="right"><?php echo $column_nsu; ?></td>
              <td class="right"><?php echo $column_autorizada; ?></td>
              <td class="right"><?php echo $column_capturada; ?></td>
              <td class="right"><?php echo $column_cancelada; ?></td>
              <td class="right"><?php if ($sort == 'oc.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?>
              </td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td align="right"><input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" size="4" style="text-align: right;" /></td>
              <td><input type="text" name="filter_dataPedido" value="<?php echo $filter_dataPedido; ?>" size="12" class="date" /></td>
              <td><input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" /></td>
              <td></td>
              <td></td>
              <td><input type="text" name="filter_tid" value="<?php echo $filter_tid; ?>" /></td>
              <td><input type="text" name="filter_nsu" value="<?php echo $filter_nsu; ?>" /></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <select name="filter_status">
                  <option value="*"><?php echo $text_todas; ?></option>
                  <?php foreach ($situacoes as $key => $value) { ?>
                  <?php if ((string)$key == $filter_status) { ?>
                  <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($transactions) { ?>
            <?php foreach ($transactions as $transaction) { ?>
            <tr>
              <td class="right"><a href="<?php echo $transaction['view_order']; ?>"><?php echo $transaction['order_id']; ?></a></td>
              <td class="left"><?php echo $transaction['dataPedido']; ?></td>
              <td class="left"><?php echo $transaction['customer']; ?></td>
              <td class="right"><?php echo $transaction['bandeira']; ?></td>
              <td class="right"><?php echo $transaction['parcelas']; ?>x <?php echo $transaction['operacao']; ?></td>
              <td class="right"><?php echo $transaction['tid']; ?></td>
              <td class="right"><?php echo $transaction['nsu']; ?></td>
              <td class="right"><?php echo $transaction['dataAutorizado'] . ' ' . $transaction['valorAutorizado']; ?></td>
              <td class="right"><?php echo $transaction['dataCapturado'] . ' ' . $transaction['valorCapturado']; ?></td>
              <td class="right"><?php echo $transaction['dataCancelado'] . ' ' . $transaction['valorCancelado']; ?></td>
              <td class="right"><?php echo $transaction['status']; ?></td>
              <td class="right">[ <a href="<?php echo $transaction['view_transaction']; ?>"><?php echo $button_info; ?></a> ]</td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="12"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
  function filter() {
    url = 'index.php?route=sale/cielo_api_search&token=<?php echo $token; ?>';

    var filter_order_id = $('input[name=\'filter_order_id\']').val();
    if (filter_order_id) {
      url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
    }

    var filter_dataPedido = $('input[name=\'filter_dataPedido\']').val();
    if (filter_dataPedido) {
      url += '&filter_dataPedido=' + encodeURIComponent(filter_dataPedido);
    }

    var filter_customer = $('input[name=\'filter_customer\']').val();
    if (filter_customer) {
      url += '&filter_customer=' + encodeURIComponent(filter_customer);
    }

    var filter_tid = $('input[name=\'filter_tid\']').val();
    if (filter_tid) {
      url += '&filter_tid=' + encodeURIComponent(filter_tid);
    }

    var filter_nsu = $('input[name=\'filter_nsu\']').val();
    if (filter_nsu) {
      url += '&filter_nsu=' + encodeURIComponent(filter_nsu);
    }

    var filter_status = $('select[name=\'filter_status\']').val();
    if (filter_status != '*') {
      url += '&filter_status=' + encodeURIComponent(filter_status);
    }

    location = url;
  }

  $(document).ready(function() {
    $('.date').datepicker({dateFormat: 'yy-mm-dd'});
  });

  $('#form input').keydown(function(e) {
    if (e.keyCode == 13) {
      filter();
    }
  });

  $.widget('custom.catcomplete', $.ui.autocomplete, {
    _renderMenu: function(ul, items) {
      var self = this, currentCategory = '';

      $.each(items, function(index, item) {
        if (item.category != currentCategory) {
          ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');

          currentCategory = item.category;
        }

        self._renderItem(ul, item);
      });
    }
  });

  $('input[name=\'filter_customer\']').catcomplete({
    delay: 500,
    source: function(request, response) {
      $.ajax({
        url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
        dataType: 'json',
        success: function(json) {
          response($.map(json, function(item) {
            return {
              category: item.customer_group,
              label: item.name,
              value: item.customer_id
            }
          }));
        }
      });
    }, 
    select: function(event, ui) {
      $('input[name=\'filter_customer\']').val(ui.item.label);

      return false;
    },
    focus: function(event, ui) {
      return false;
    }
  });
//--></script>
<?php echo $footer; ?>