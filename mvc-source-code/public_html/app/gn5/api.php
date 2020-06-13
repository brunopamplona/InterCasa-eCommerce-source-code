<?php
class GerencianetException extends Exception { }
class Gerencianet {
    
    public $token;
    public $erro;
    public $tipo;
    public $modo_sandbox;
    
    public function __construct($opcoes){
        $token = $this->token_gn($opcoes['client_id'],$opcoes['client_secret'],$opcoes['sandbox']);
        if($token['resposta']==200){
            $this->token = $token['access_token'];
            $this->tipo = $token['token_type'];
            $this->modo_sandbox = $opcoes['sandbox'];
        }else{
            throw new Exception($token['error_description']);
        }
    }
    
    public function getNotification($a,$b)
    {
        return $this->api_gn('','/notification/'.$a['token']);
    }
    
    public function detailCharge($a,$b)
    {
        return $this->api_gn('','/charge/'.$a['id']);
    }
    
    public function payCharge($a,$b)
    {
        return $this->api_gn($b,'/charge/'.$a['id'].'/pay');
    }
    
    public function createCharge($a,$b)
    {
        return $this->api_gn($b,'/charge');
    }
    
    public function api_gn($json,$metodo)
    {
        if($this->modo_sandbox){
            $url = 'https://sandbox.gerencianet.com.br/v1';
            $modo = 'sandbox';
        }else{
            $url = 'https://api.gerencianet.com.br/v1';
            $modo = '';   
        }
        $header = array(
            'Content-Type: application/json',
            'Authorization: '.$this->tipo.' '.$this->token,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.$metodo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if(is_array($json)){
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json));
        curl_setopt($ch, CURLOPT_POST, true);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $result = @json_decode($response, true);     
        //exeption de erro 500
        if($httpcode==500 && is_array($result)){
            if(isset($result['error_description'])){
                $erro = $result['error_description'];
            }elseif(isset($result['code'])){
                $erro = $this->getErrorMessage($result['code'], $result['error_description']['property'], $result['error_description']['message']);
                //$erro = print_r($result,true);
            }else{
                $erro = print_r($result,true);
            }
            throw new Exception($erro);
        } else if(($httpcode==200 || $httpcode==201) && is_array($result)){
            $resultado = array_merge($result,array('resposta'=>$httpcode));
            return $resultado;
        }else{
            throw new Exception($response);
        }
    }
    
    public function token_gn($client_id,$secret,$modo_sandbox)
    {
        //modo e url
        if($modo_sandbox){
            $url = 'https://sandbox.gerencianet.com.br/v1';
            $modo = 'sandbox';
        }else{
            $url = 'https://api.gerencianet.com.br/v1';
            $modo = '';   
        }

        //solicita o token 
        $header = array(
            'Content-Type: application/json',
        );

        $postvals = array('grant_type' => 'client_credentials');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url."/authorize");
        curl_setopt($ch, CURLOPT_USERPWD, $client_id.":".$secret);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postvals));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $result = json_decode($response, true);
        if(is_array($result)){
            $resultado = array_merge($result,array('resposta'=>$httpcode));
            return $resultado;
        }else{
            return array('resposta'=>$httpcode,'error'=>true,'error_description'=>$response); 
        }
    }
    
    public function getErrorMessage($error_code, $propertys, $originalMessage) 
    {
        $property = '';
        $partes = explode('/',$propertys);
        foreach($partes as $parte){
            $property = $parte;
        }
		$messageErrorDefault = 'Ocorreu um erro ao tentar realizar a sua requisição. Verifique os campos informados nos formulários e, se o erro persistir, entre contato com o proprietário da loja.';
		switch($error_code) {
			case 3500000:
				$message = 'Erro interno do servidor.';
				break;
			case 3500001:
				$message = $messageErrorDefault;
				break;
			case 3500002:
				$message = $messageErrorDefault;
				break;
			case 3500007:
				$message = 'O tipo de pagamento informado não está disponível.';
				break;
			case 3500008:
				$message = 'Requisição não autorizada.';
				break;
			case 3500010:
				$message = $messageErrorDefault;
				break;
			case 3500021:
				$message = 'Não é permitido parcelamento para assinaturas.';
				break;
			case 3500030:
				$message = 'Esta transação já possui uma forma de pagamento definida.';
				break;
			case 3500034:
				if (trim($property)=="credit_card") {
					$message = 'Os dados digitados do cartão são inválidos. Verifique as informações e tente novamente.';
				} else if (trim($property)=="phone_number") {
					$message = 'O telefone digitado não é válido. Por favor, verifique se o DDD informado é válido e se o número está no padrão (XX)XXXX-XXXX.';
				}else {
					$message = 'O campo ' . $this->getFieldName($property) . ' não está preenchido corretamente.';
				}
				break;
			case 3500042:
				$message = $messageErrorDefault;
				break;
			case 3500044:
				$message = 'A transação não pode ser paga. Entre em contato com o vendedor.';
				break;
			case 4600002:
				$message = $messageErrorDefault;
				break;
			case 4600012:
				$message = 'Ocorreu um erro ao tentar realizar o pagamento: ' . $property;
				break;
			case 4600022:
				$message = $messageErrorDefault;
				break;
			case 4600026:
				$message = 'cpf inválido';
				break;
			case 4600029:
				$message = 'pedido já existe';
				break;
			case 4600032:
				$message = $messageErrorDefault;
				break;
			case 4600035:
				$message = 'Serviço indisponível para a conta. Por favor, solicite que o recebedor entre em contato com o suporte Gerencianet.';
				break;
			case 4600037:
				$message = 'O valor da emissão é superior ao limite operacional da conta. Por favor, solicite que o recebedor entre em contato com o suporte Gerencianet.';
				break;
			case 4600111:
				$message = 'valor de cada parcela deve ser igual ou maior que R$5,00';
				break;
			case 4600142:
				$message = 'Transação não processada por conter incoerência nos dados cadastrais.';
				break;
			case 4600148:
				$message = 'já existe um pagamento cadastrado para este identificador.';
				break;
			case 4600196:
				$message = $messageErrorDefault;
				break;
			case 4600204:
				$message = 'cpf deve ter 11 números';
				break;
			case 4600209:
				$message = 'Limite de emissões diárias excedido. Por favor, solicite que o recebedor entre em contato com o suporte Gerencianet.';
				break;
			case 4600210:
				$message = 'não é possível emitir três emissões idênticas. Por favor, entre em contato com nosso suporte para orientações sobre o uso correto dos serviços Gerencianet.';
				break;
			case 4600212:
				$message = 'Número de telefone já associado a outro CPF. Não é possível cadastrar o mesmo telefone para mais de um CPF.';
				break;
			case 4600219:
				$message = 'Ocorreu um erro ao validar seus dados: ' . $property;
				break;
			case 4600224:
				$message = $messageErrorDefault;
				break;
			case 4600254:
				$message = 'identificador da recorrência não foi encontrado';
				break;
			case 4600257:
				$message = 'pagamento recorrente já executado';
				break;
			case 4600329:
				$message = 'código de segurança deve ter três digitos';
				break;
			case 4699999:
				$message = 'falha inesperada';
				break;
			default:
				$message = $originalMessage;
				break;
		}
		return $message;
	}
    
    public function getFieldName($name) 
    {
		$field = trim($name);
		switch($field) {
			case "neighborhood":
				return 'Bairro';
				break;
			case "street":
				return 'Endereço';
				break;
			case "state":
				return 'Estado';
				break;
			case "complement":
				return 'Complemento';
				break;
			case "number":
				return 'Número';
				break;
			case "city":
				return 'Cidade';
				break;
			case "zipcode":
				return 'CEP';
				break;
			case "name":
				return 'Nome';
				break;
			case "cpf":
				return 'CPF';
				break;
			case "phone_number":
				return 'Telefone de contato';
				break;
			case "email":
				return 'Email';
				break;
			case "cnpj":
				return 'CNPJ';
				break;
			case "corporate_name":
				return 'Razão Social';
				break;
			case "birth":
				return 'Aniversario';
				break;
			default:
				return '';
				break;
		}
	}
}
?>