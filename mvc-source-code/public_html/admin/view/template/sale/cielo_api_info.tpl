<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div id="progress"></div>
    <div class="heading">
      <h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?></h1>
    </div>
    <div class="content">
      <div class="vtabs">
        <a href="#tab-details"><?php echo $tab_details; ?></a>
        <a href="#tab-json"><?php echo $tab_json; ?></a>
      </div>
      <div id="tab-details" class="vtabs-content">
        <table class="form">
          <tr>
            <td><?php echo $entry_order_id; ?></td>
            <td><a href="<?php echo $view_order; ?>"><?php echo $order_id; ?></a></td>
          </tr>
          <tr>
            <td><?php echo $entry_added; ?></td>
            <td><?php echo $added; ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_total; ?></td>
            <td><?php echo $total; ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_customer; ?></td>
            <td><a href="<?php echo $view_customer; ?>"><?php echo $customer; ?></a></td>
          </tr>
          <tr>
            <td><?php echo $entry_cielo_api_id; ?></td>
            <td><?php echo $cielo_api_id; ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_tid; ?></td>
            <td>
              <?php echo $tid; ?>
              <br />
              <a id="button-search" class="button"><?php echo $button_search; ?></a>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_nsu; ?></td>
            <td><?php echo $nsu; ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_bandeira; ?></td>
            <td><?php echo $bandeira; ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_parcelamento; ?></td>
            <td><?php echo $parcelas; ?>x <?php echo $operacao; ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_autorizacao; ?></td>
            <td>
              <?php echo $data_autorizacao; ?>
              <?php if ((!$data_captura) && (!empty($dias_capturar)) && (!$data_cancelamento) && (!empty($dias_cancelar))) { ?>
              <br />
              <strong><?php echo $dias_capturar; ?></strong><br />
              <strong><?php echo $dias_cancelar; ?></strong>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_valor_autorizado; ?></td>
            <td>
              <?php echo $valor_autorizado; ?>
              <?php if ((!$data_captura) && (!empty($dias_capturar)) && (!$data_cancelamento) && (!empty($dias_cancelar))) { ?>
              <br />
              <a id="button-capture" class="button"><?php echo $button_capturar; ?></a>
              <a id="button-cancel" class="button"><?php echo $button_cancelar; ?></a>
              <?php } ?>
            </td>
          </tr>
          <?php if ($data_captura) { ?>
          <tr>
            <td><?php echo $entry_captura; ?></td>
            <td>
              <?php echo $data_captura; ?><br />
              <?php if ((!$data_cancelamento) && (!empty($dias_cancelar))) { ?>
              <strong><?php echo $dias_cancelar; ?></strong>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_valor_capturado; ?></td>
            <td>
              <?php echo $valor_capturado; ?> 
              <?php if ((!$data_cancelamento) && (!empty($dias_cancelar))) { ?>
              <a id="button-cancel" class="button"><?php echo $button_cancelar; ?></a>
              <?php } ?>
            </td>
          </tr>
          <?php } ?>
          <?php if ($data_cancelamento) { ?>
          <tr>
            <td><?php echo $entry_cancelamento; ?></td>
            <td><?php echo $data_cancelamento; ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_valor_cancelado; ?></td>
            <td><?php echo $valor_cancelado; ?></td>
          </tr>
          <?php } ?>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><strong><?php echo $status; ?></strong></td>
          </tr>
          <?php if (!$data_cancelamento) { ?>
          <?php if ($clearsale) { ?>
          <tr>
            <td><?php echo $entry_clearsale; ?></td>
            <td>
              <form action="<?php echo $clearsale_url ?>" method="post" id="clearsale" target="iFrameStart" onSubmit="carregarIframe(this);">
                <?php foreach($clearsale_itens as $name => $value) { ?>
                <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
                <?php } ?>
              </form>
              <a id="button-clearsale" class="button" onclick="$('#clearsale').submit();"><?php echo $button_consultar; ?></a>
              <script type="text/javascript"><!--
                function carregarIframe(form){
                  var src = "<?php echo $clearsale_src ?>";
                  $('#button-clearsale').hide();
                  $('#iFrameStart').show();
                  $('#iFrameStart').attr("src", src);
                  return true;
                }
              //--></script>
              <iframe style="display:none;" id="iFrameStart" name="iFrameStart" width="280" height="100" frameborder="0" scrolling="no"><p><?php echo $error_iframe ?></p></iframe>
            </td>
          </tr>
          <?php } ?>
          <?php if ($fcontrol) { ?>
          <tr>
            <td><?php echo $entry_fcontrol; ?></td>
            <td>
              <a id="button-fcontrol" class="button"><?php echo $button_consultar; ?></a>
              <script type="text/javascript"><!--
                $(document).delegate('#button-fcontrol', 'click', function() {
                  var src = "<?php echo $fcontrol_url ?>";
                  $(this).hide();
                  $('#fcontrol').show();
                  $('#fcontrol').attr("src", src);
                });
              //--></script>
              <iframe style="display:none;" id="fcontrol" width="300" height="110" frameborder="0" scrolling="no"><p><?php echo $error_iframe ?></p></iframe>
            </td>
          </tr>
          <?php } ?>
          <?php } ?>
        </table>
      </div>
      <div id="tab-json" class="vtabs-content">
        <table class="form">
          <textarea wrap="off" rows="20" readonly style="width:99%;"><?php echo $json; ?></textarea>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
  $('.vtabs a').tabs();

  $('#button-search').on('click', function() {
    $.ajax({ 
        url: 'index.php?route=sale/cielo_api_search/getConsultar&token=<?php echo $token; ?>&cielo_api_id=<?php echo $cielo_api_id; ?>',
        dataType: 'json',
        beforeSend: function() {
          $('#button-search').unbind('click');
          $('#progress').html('<div class="attention"><img src="view/image/ajax-loader.gif" alt="" /> <?php echo $text_consultando; ?></div>');
        },
        complete: function() {
          $('#button-search').bind('click');
          $('.attention').remove();
          $('.wait').remove();
        },
        success: function(json) {
          if (json['error']) {
            $('#progress').html('<div class="warning">' + json['error'] + '</div>');
          } else {
            $('#progress').html('<div class="success">' + json['mensagem'] + '</div>');
            location.href = location.href;
          }
        }
    });
  });
  $('#button-capture').on('click', function() {
    $.ajax({ 
      url: 'index.php?route=sale/cielo_api_search/setCapturar&token=<?php echo $token; ?>&cielo_api_id=<?php echo $cielo_api_id; ?>',
      dataType: 'json',
      beforeSend: function() {
        $('#button-capture').unbind('click');
        $('#progress').html('<div class="attention"><img src="view/image/ajax-loader.gif" alt="" /> <?php echo $text_capturando; ?></div>');
      },
      success: function(json) {
        $('#button-capture').bind('click');
        $('.attention').remove();
        $('.wait').remove();
        if (json['error']) {
          $('#progress').html('<div class="warning">' + json['error'] + '</div>');
        } else {
          $('#progress').html('<div class="success">' + json['mensagem'] + '</div>');
          $('#button-search').trigger('click');
        }
      }
    });
  });
  $('#button-cancel').on('click', function() {
    $.ajax({ 
      url: 'index.php?route=sale/cielo_api_search/setCancelar&token=<?php echo $token; ?>&cielo_api_id=<?php echo $cielo_api_id; ?>',
      dataType: 'json',
      beforeSend: function() {
        $('#button-cancel').unbind('click');
        $('#progress').html('<div class="attention"><img src="view/image/ajax-loader.gif" alt="" /> <?php echo $text_cancelando; ?></div>');
      },
      success: function(json) {
        $('#button-cancel').bind('click');
        $('.attention').remove();
        $('.wait').remove();
        if (json['error']) {
          $('#progress').html('<div class="warning">' + json['error'] + '</div>');
        } else {
          $('#progress').html('<div class="success">' + json['mensagem'] + '</div>');
          $('#button-search').trigger('click');
        }
      }
    });
  });
//--></script>
<?php echo $footer; ?>