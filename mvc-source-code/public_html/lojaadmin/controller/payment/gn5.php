<?php
class ControllerPaymentGN5 extends Controller {
	
	private $error = array(); 
	public $opcoes = array();
	
	public function index() {
		
		$this->language->load('payment/gn5');
		$this->document->setTitle('GerenciaNET Transparente [Loja5]');
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('gn5', $this->request->post);	
			if(isset($this->request->post['gn5_status'])){
			$this->model_setting_setting->editSetting('gn5boleto', array('gn5boleto_status'=>$this->request->post['gn5_status']));	
			}
			if(isset($this->request->post['gn5_status'])){
			$this->model_setting_setting->editSetting('gn5carne', array('gn5carne_status'=>$this->request->post['gn5_status']));	
			}
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('payment/gn5', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['error_warning'] = '';

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),      		
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => 'GerenciaNET Transparente [Loja5]',
			'href'      => $this->url->link('payment/gn5', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['action'] = $this->url->link('payment/gn5', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		//custom
		$serial = trim($this->config->get('gn5_serial'));
		$OOO000000=urldecode('%61%68%36%73%62%65%68%71%6c%61%34%63%6f%5f%73%61%64');
		$OO00O0000=244;
		$OOO0000O0=$OOO000000{4}.$OOO000000{9}.$OOO000000{3}.$OOO000000{5};
		$OOO0000O0.=$OOO000000{2}.$OOO000000{10}.$OOO000000{13}.$OOO000000{16};
		$OOO0000O0.=$OOO0000O0{3}.$OOO000000{11}.$OOO000000{12}.$OOO0000O0{7}.$OOO000000{5};
		$O0O0000O0='OOO0000O0';
		$key_string = $serial;
		$remote_auth = 'df08acba4ec3';
		$key_location = DIR_DOWNLOAD."key.gerencianet5.php";
		$key_age = 1296000;
		$resultado = new gateway_gn5_open_web_loja5($key_string, $remote_auth, $key_location, $key_age);
		$idPagamento = $OOO0000O0($resultado->result);
		$this->data['mod_ativado'] = $idPagamento;
		
		//colunas de orders
		$query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "order`");
		$this->data['colunas'] = $query->rows;
		
		$this->get('gn5_serial');

		if($idPagamento==1){
		//dados
		$this->get('gn5_titulo');
		$this->get('gn5_titulo_boleto');
		$this->get('gn5_titulo_carne');
		$this->get('gn5_conta');
		$this->get('gn5_id');
		$this->get('gn5_boleto');
		$this->get('gn5_cartao');
		$this->get('gn5_carne');
		$this->get('gn5_sec');
		$this->get('gn5_modo');
		$this->get('gn5_in');
		$this->get('gn5_ne');
		$this->get('gn5_pg');
		$this->get('gn5_ca');
		$this->get('gn5_de');
		$this->get('gn5_di');
		$this->get('gn5_geo_zone_id');
		$this->get('gn5_status');
		$this->get('gn5_sort_order');
		$this->get('gn5_sort_order_boleto');
		$this->get('gn5_sort_order_carne');
		$this->get('gn5_total');
		$this->get('gn5_fiscal');
		$this->get('gn5_numero');
		
		$this->get('gn5_carne_dividir_valor');
		$this->get('gn5_carne_div');
		$this->get('gn5_carne_primeiro');
		$this->get('gn5_carne_minimo');
		
		}

		//cria os data com os valores
		foreach($this->opcoes AS $k=>$v){
		$this->data[$k]=$v;
		}		
		
		//libs
		$this->load->model('localisation/order_status');
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		$this->load->model('localisation/geo_zone');
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		//layout
		if($idPagamento==1){
		$tema = 'payment/gn5.tpl';
		}else{
		$tema = 'payment/gn5_ativar.tpl';	
		}
		
		$this->template = $tema;
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	public function install(){
		$this->load->model('setting/extension');
		$this->model_setting_extension->install('payment', 'gn5boleto');
		$this->model_setting_extension->install('payment', 'gn5carne');
	}
	
	public function uninstall(){
		$this->load->model('setting/extension');
		$this->model_setting_extension->uninstall('payment', 'gn5boleto');
		$this->model_setting_extension->uninstall('payment', 'gn5carne');
	}
	
	public function get($campo){
		if (isset($this->request->post[$campo])) {
		$this->opcoes[$campo] = $this->request->post[$campo];
		} else {
		$this->opcoes[$campo] = $this->config->get($campo);
		}
	}

	protected function validate() {
		return true;	
	}
}

class gateway_gn5_open_web_loja5 {
    var $license_key;
	var $home_url_site = 'd3d3LmxvY2FzaXN0ZW1hcy5jb20=';
	var $home_url_port = 80;
	var $home_url_iono = 'L2NsaWVudGVzL3JlbW90ZS5waHA=';
	var $key_location;	
	var $remote_auth;
	var $key_age;
	var $key_data;
	var $now;
	var $result;
	function Visa(){
	return true;
	}
    function http_response($url) 
    {
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, "http://".$url); 
			curl_setopt($ch,CURLOPT_TIMEOUT, 5); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
			$head = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
            curl_close($ch);
 
			return $httpCode;
    }
	function CiCielo(){
	return true;
	}
	function MCoder($str){
	$OOO000000=urldecode('%61%68%36%73%62%65%68%71%6c%61%34%63%6f%5f%73%61%64');
	$OO00O0000=244;
	$OOO0000O0=$OOO000000{4}.$OOO000000{9}.$OOO000000{3}.$OOO000000{5};
	$OOO0000O0.=$OOO000000{2}.$OOO000000{10}.$OOO000000{13}.$OOO000000{16};
	$OOO0000O0.=$OOO0000O0{3}.$OOO000000{11}.$OOO000000{12}.$OOO0000O0{7}.$OOO000000{5};
	$O0O0000O0='OOO0000O0';
	return $OOO0000O0($str);
	}
	function gateway_gn5_open_web_loja5($license_key, $remote_auth, $key_location = 'key.php', $key_age = 1296000)
	{
		$this->license_key = $license_key;
		$this->remote_auth = $remote_auth;
		$this->key_location =  $key_location;
		$this->key_age =  $key_age;
		$this->now = time();
	    $p_id = '66';
	    $a = @explode('-',$license_key);
	    if(isset($a[2]) && $a[2]!=$p_id){
		$this->result = 'NjY=';
		return true;
		}
		
        $servidoronline = $this->http_response($this->MCoder($this->home_url_site));
		if($servidoronline<=0){
        $this->result = 'MQ==';
		return true;
		}
		
		if (empty($license_key))
		{
			$this->result = 'NA==';
			return false;
		}
		
		if (empty($remote_auth))
		{
			$this->result = 'NA==';
			return false;
		}
		
		if (file_exists($this->key_location))
		{
			$this->result = $this->PagamentoCreditoDebitoCielo();
		}
		else
		{
			$this->result = $this->PagamentoCreditoDebito();
			
			if (empty($this->result))
			{
				$this->result = $this->PagamentoCreditoDebitoCielo();
			}
		}
				
		unset($this->remote_auth);
		
		return true;
	}
	function PagamentoCreditoDebito()
	{
        $servidoronline = $this->http_response($this->MCoder($this->home_url_site));
		if($servidoronline<=0){
		return 'MQ==';
		}
		$request = 'remote=licenses&type=5&license_key='.urlencode(base64_encode($this->license_key));
		$request .= '&host_ip='.urlencode(base64_encode("")).'&host_name='.urlencode(base64_encode(str_replace('www.','',$_SERVER['SERVER_NAME'])));
		$request .= '&hash='.urlencode(base64_encode(md5($request)));
		$request = $this->MCoder($this->home_url_iono).'?'.$request;
		$header  = "GET $request HTTP/1.0\r\nHost: ".$this->MCoder($this->home_url_site)."\r\nConnection: Close\r\nUser-Agent: iono (www.olate.co.uk/iono)\r\n";
		$header .= "\r\n\r\n";
		$fpointer = @fsockopen($this->MCoder($this->home_url_site), $this->home_url_port, $errno, $errstr, 5);
		$return = '';
		if ($fpointer) 
		{
			@fwrite($fpointer, $header);
			while(!@feof($fpointer)) 
			{
				$return .= @fread($fpointer, 1024);
			}
			@fclose($fpointer);
		}
		else
		{
			return 'MTI=';
		}
		$content = explode("\r\n\r\n", $return);
		$content = explode($content[0], $return);
		$string = urldecode($content[1]);
		$exploded = explode('|', $string);		
		switch ($exploded[0])
		{
			case 0:
				return 'OA==';
				break;
			case 2:
				return 'OQ==';
				break;
			case 3:
				return 'NQ==';
				break;
			case 10:
				return 'NA==';
				break;
		}
		$data['license_key'] = $exploded[1];
		$data['expiry']	= $exploded[2];
		$data['hostname'] = $exploded[3];
		$data['ip']	= $exploded[4];
		$data['timestamp'] = $this->now;
		if (empty($data['hostname']))
		{
			$data['hostname'] = str_replace('www.','',$_SERVER['SERVER_NAME']);
		}
		
		if (empty($data['ip']))
		{
			$data['ip'] = "";
		}
		$data_encoded = serialize($data);
		$data_encoded = base64_encode($data_encoded);
		$data_encoded = md5($this->now.$this->remote_auth).$data_encoded;
		$data_encoded = strrev($data_encoded);
		$data_encoded_hash = sha1($data_encoded.$this->remote_auth);
		
		$fp = fopen($this->key_location, 'w');
		if ($fp)
		{
			$fp_write = fwrite($fp, wordwrap($data_encoded.$data_encoded_hash, 40, "\n", true));
			
			if (!$fp_write)
			{	
				return 'MTE=';
			}
			
			fclose($fp);
		}
		else
		{
			return 'MTA=';
		}
	}
	function B0000000(){
	return true;
	}
	function PagamentoCreditoDebitoCielo()
	{
		$key = file_get_contents($this->key_location);
		
		if ($key !== false)
		{
			$key = str_replace("\n", '', $key);
			$key_string = substr($key, 0, strlen($key)-40);
			$key_sha_hash = substr($key, strlen($key)-40, (strlen($key)));
			
			if (sha1($key_string.$this->remote_auth) == $key_sha_hash) // Compare SHA1 hash to the key data
			{
				$key = strrev($key_string); // Back the right way around
				
				$key_hash = substr($key, 0, 32); // Get the MD5 hash of the data from the string
				$key_data = substr($key, 32); // Get the data from the string
				
				$key_data = base64_decode($key_data);
				$key_data = unserialize($key_data);
				
				if (md5($key_data['timestamp'].$this->remote_auth) == $key_hash) // Check the MD5 hash
				{					
					// Is it more than $this->key_age seconds old?
					if (($this->now - $key_data['timestamp']) >= $this->key_age)
					{						
						unlink($this->key_location);
						
						$this->result = $this->PagamentoCreditoDebito();
			
						if (empty($this->result))
						{
							$this->result = $this->PagamentoCreditoDebitoCielo();
						}
						
						return 'MQ==';
					}
					else
					{
						$this->key_data = $key_data;
						
						if ($key_data['license_key'] != $this->license_key)
						{
							return 'NA==';
						}
						
						if ($key_data['expiry'] <= $this->now && $key_data['expiry'] != 1)
						{
							return 'NQ==';
						}
						// Do we have multiple hostnames?
						if (substr_count($key_data['hostname'], ',') == 0)
						{ // No
						    $limpo = str_replace('www.','',$_SERVER['SERVER_NAME']);
							if ($key_data['hostname'] != $limpo && !empty($key_data['hostname']))
							{
								return 'Ng=='; // Host name does not match key file
							}
						}
						else
						{ // Yes
							$hostnames = explode(',', $key_data['hostname']);
							$limpo = str_replace('www.','',$_SERVER['SERVER_NAME']);
							if (!in_array($limpo, $hostnames))
							{
								return 'Ng=='; // Host name is not in key file
							}
						}
						
						return 'MQ==';
					}
				}
				else
				{
					return 'Mw==';
				}
			}
			else
			{
				return 'Mg==';
			}
		}
		else
		{
			return 'MA==';
		}
	}
	function get_data()
	{
		return $this->key_data;
	}
	function B39(){
	return true;
	}
}
?>