<?php echo $header; ?>

<script type='text/javascript' src='https://raw.github.com/digitalBush/jquery.maskedinput/1.3.1/dist/jquery.maskedinput.min.js'></script>
<script type="text/javascript">
		function LoadLoad(){
		jQuery(
			function($){
			//mascara
			$(".cep").mask("99999999");
			
			$('.real').blur(function(e){
			var curVal = parseFloat($(this).val()),
			curInt = parseInt(curVal, 10),
			curDec = parseInt(curVal*100, 10) - parseInt(curInt*100, 10);

			curDec = (curDec < 10) ? "0" + curDec : curDec;

			if (!isNaN(curInt) && !isNaN(curDec)) {
				$(this).val(""+curInt+"."+curDec);
			}
			});
			
			}
		);
		}
</script>
	
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	  
	      <div id="tab-general">
          <table class="form">
            <tr>
              <td>Nome:</td>
              <td><input type="text" name="faixadeceploja5peso_nome" value="<?php echo $faixadeceploja5peso_nome; ?>" /></td>
            </tr>
            <tr>
              <td>Status:</td>
              <td><select name="faixadeceploja5peso_status">
                  <?php if ($faixadeceploja5peso_status) { ?>
                  <option value="1" selected="selected">Ativo</option>
                  <option value="0">Inativo</option>
                  <?php } else { ?>
                  <option value="1">Ativo</option>
                  <option value="0" selected="selected">Inativo</option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td>Ordem:</td>
              <td><input type="text" name="faixadeceploja5peso_sort_order" value="<?php echo $faixadeceploja5peso_sort_order; ?>" size="1" /></td>
            </tr>
          </table>
          
		
        <table id="module" class="list">
          <thead>
            <tr>
              <td class="left">CEP de:</td>
              <td class="left">CEP at&eacute;:</td>
              <td class="left">Peso at&eacute;:</td>
              <td class="left">Valor Frete:</td>
              <td></td>
            </tr>
          </thead>
          <?php $module_row = 0; ?>
		  
          <?php foreach ($modules as $module) { ?>
          <tbody id="module-row<?php echo $module_row; ?>">
            <tr>
			
		<td class="left">
		<input type="text" class="cep" onblur="LoadLoad()" name="faixadeceploja5peso[<?php echo $module_row; ?>][de]" value="<?php echo $module['de']; ?>" size="10" />
		</td>
		
		<td class="left">
		<input type="text" class="cep" onblur="LoadLoad()" name="faixadeceploja5peso[<?php echo $module_row; ?>][para]" value="<?php echo $module['para']; ?>" size="10" />
		</td>
		
		<td class="left">
		<input type="text" class="real" onblur="LoadLoad()" name="faixadeceploja5peso[<?php echo $module_row; ?>][total]" value="<?php echo $module['total']; ?>" size="8" />
		</td>
		
		<td class="left">
		<input type="text" class="real" onblur="LoadLoad()" name="faixadeceploja5peso[<?php echo $module_row; ?>][frete]" value="<?php echo $module['frete']; ?>" size="8" />
		</td>

        <td style="width:100px" class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button">
		Excluir</a>
		</td>
           
		   </tr>
          </tbody>
          <?php $module_row++; ?>
          <?php } ?>
		  
		  
          <tfoot>
            <tr>
              <td colspan="4"></td>
              <td class="left"><a onclick="addModule();" class="button">Nova Faixa</a></td>
            </tr>
          </tfoot>
        </table>
		
		</div>
		
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><input type="text" onblur="LoadLoad()" class="cep" name="faixadeceploja5peso[' + module_row + '][de]" value="" size="10" /></td>';
	html += '    <td class="left"><input type="text" onblur="LoadLoad()" class="cep" name="faixadeceploja5peso[' + module_row + '][para]" value="" size="10" /></td>';	
	html += '    <td class="left"><input type="text" onblur="LoadLoad()" class="real" name="faixadeceploja5peso[' + module_row + '][total]" value="" size="8" /></td>';
	html += '    <td class="left"><input type="text" onblur="LoadLoad()" class="real" name="faixadeceploja5peso[' + module_row + '][frete]" value="" size="8" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button">Excluir</a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script> 
<?php echo $footer; ?>