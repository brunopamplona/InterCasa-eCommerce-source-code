<?php
class ModelModuleProductquestion extends Model {
	public function createTable() {
		$createTable = "
			CREATE TABLE " . DB_PREFIX . "productquestion (
             `question_id` int(11) NOT NULL AUTO_INCREMENT,
             `product_id` int(11) NOT NULL DEFAULT '0',
             `customer_id` int(11) NOT NULL DEFAULT '0',
             `customer_language_id` int(11) NOT NULL DEFAULT '0',
             `name` varchar(32) NOT NULL DEFAULT '',
             `email` varchar(128) NOT NULL DEFAULT '',
             `create_time` int(11) NOT NULL DEFAULT '0',
             `answer_time` int(11) NOT NULL DEFAULT '0',
        	PRIMARY KEY (`question_id`)) default CHARSET=utf8";
        
        $this->db->query($createTable);
        
		$createTable = "
			CREATE TABLE " . DB_PREFIX . "productquestion_lang (
             `question_id` int(11) NOT NULL,
			 `language_id` int(11) NOT NULL,
             `question_text` text NOT NULL,
             `answer_text` text,
             `display` tinyint(1) NOT NULL DEFAULT '0',
        	PRIMARY KEY (`question_id`,`language_id`)) default CHARSET=utf8";
        
        $this->db->query($createTable);  
	}
	
	public function dropTable() {
		$dropTable = "DROP TABLE IF EXISTS `" . DB_PREFIX . "productquestion`,`" . DB_PREFIX . "productquestion_lang`";
		$this->db->query($dropTable);
    }

	public function getLangIdByCode($code) {
		$res = $this->db->query("SELECT language_id FROM `" . DB_PREFIX . "language` WHERE code = '" . $code . "'");
		
		return $res->row['language_id'];
	}
	
    public function getQuestionCount($data = array()) {
        $sql = "SELECT count(*) AS total
        		FROM `" . DB_PREFIX . "productquestion` q
				WHERE 1 = 1"
				. (isset($data['unanswered']) ? " AND q.answer_time = 0" : '');

        if (!$res = $this->db->query($sql))
        	return $this->showErrors();
        
        return $res->row['total'];
    }
    
	public function getQuestions($data = array(), $sort = array()) {
		$sql = "SELECT  *,
						pql.language_id as `pql.language_id`,
						pd.name as product_name
				FROM " . DB_PREFIX . "productquestion pq
				LEFT JOIN " . DB_PREFIX . "productquestion_lang pql
					USING(question_id)
				LEFT JOIN " . DB_PREFIX . "product_description pd
					USING(product_id)
			  	WHERE pq.question_id IN (
					SELECT * FROM (
						SELECT question_id 
						FROM `" . DB_PREFIX . "productquestion` pq"
						. (isset($sort['order_by']) ? " ORDER BY {$sort['order_by']} {$sort['order_way']}" : '') 
						. (isset($sort['limit']) ? " LIMIT ".(int)$sort['offset'].', '.(int)($sort['limit']) : '') . "
				 	) alias
				)"
				. (isset($sort['order_by']) ? " ORDER BY {$sort['order_by']} {$sort['order_way']}" : '');

		$res = $this->db->query($sql);

		$result = array();
		foreach ($res->rows as $row)  {
			$row['answer_text'] = htmlspecialchars_decode($row['answer_text']);
			$row['question_text'] = htmlspecialchars_decode($row['question_text']);
			$result[$row['question_id']][$row['pql.language_id']] = $row;
		}
		return $result;
	}

	public function deleteQuestion($question_id) {
		$sql = "DELETE FROM `" . DB_PREFIX . "productquestion_lang`
				WHERE question_id = " . (int)$question_id;
				
		$this->db->query($sql);			
				
		$sql = "DELETE FROM `" . DB_PREFIX . "productquestion`
				WHERE question_id = " . (int)$question_id;

		$this->db->query($sql);
		return true;
	}

    public function editQuestion($question) {
    	$question_id = (int)$question[0]['question_id'];
		$product_id =(int)$question[0]["product_id"];

    	$sql = "SELECT name as customer_name, email as customer_email, answer_time,customer_language_id FROM `" . DB_PREFIX . "productquestion` q"
        	.  " WHERE q.question_id = {$question_id}";

        if (!$res = $this->db->query($sql))
        	return $this->showErrors();
        	
        $question_data =  $res->row;
		$question_data['question_text'] = $question[0]['question_text'];
		$question_data['answer_text'] = $question[0]['answer_text'];
        
        
        if ($question_data['customer_language_id'] == 0)
        	$question_data['customer_language_id'] = $this->config->get('config_language_id');

    	$sql = "UPDATE `" . DB_PREFIX . "productquestion` q"
    		. " SET	q.product_id = $product_id, q.answer_time = UNIX_TIMESTAMP(NOW())"
        	. " WHERE q.question_id = $question_id ";

    	$this->db->query($sql);

		foreach ($question as $qLang) {
			$question_text = $this->db->escape($qLang["question_text"]);
			$answer_text = $this->db->escape($qLang["answer_text"]);
			$display = ((isset($qLang["display"]) && $qLang["display"] == "on") ? '1' : '0');
			$language_id =(int)$qLang["language_id"];
			
			if ($language_id == $question_data['customer_language_id']) {
				if ($qLang["question_text"] != '') $question_data['question_text'] = $qLang["question_text"];
				if ($qLang["answer_text"] != '') $question_data['answer_text'] = $qLang["answer_text"];
			}
			
        	$sql = "INSERT INTO `" . DB_PREFIX . "productquestion_lang`"
        		. " (question_id, language_id, question_text, answer_text,display)"
        		. " VALUES"
        		. " ($question_id, $language_id,'$question_text','$answer_text',$display)"
            	. " ON DUPLICATE KEY UPDATE "
            	. " question_text = '$question_text'"
            	. ",answer_text = '$answer_text'"
            	. ",display = $display";
            	
        	if (!$this->db->query($sql))
        		return $this->showErrors();			
    	}
    	
		$this->load->model('localisation/language');
		$language_info = $this->model_localisation_language->getLanguage($question_data['customer_language_id']);
		    
		if ($language_info) {
			$file = DIR_LANGUAGE . $this->directory . $language_info['directory'] . '/module/productquestion.php';			
		} else {
			$file = '';
		}

		if (!file_exists($file)) {
			$language_info = $this->model_localisation_language->getLanguage($this->config->get('config_language_id'));
		}
		
		$language = new Language($language_info['directory']);
		$language->load('module/productquestion');
		
		if ($question_data["answer_time"] == 0 
		&& !empty($question_data["answer_text"]) 
		&& filter_var($question_data["customer_email"], FILTER_VALIDATE_EMAIL)) {
			$template = new Template();
			$template->data['mail_text_greeting'] = sprintf($language->get('mail_text_greeting'), $question_data['customer_name']);
			$template->data['mail_text_question'] = $language->get('mail_text_question');
			$template->data['mail_text_answer'] = $language->get('mail_text_answer');
			$template->data['question_text'] = $question_data["question_text"];
			$template->data['answer_text'] = htmlspecialchars_decode($question_data["answer_text"]);
			$template->data['mail_text_sincerely'] = $language->get('mail_text_sincerely');
			$template->data['store_name'] = $this->config->get('config_name');
			$template->data['store_url'] = HTTP_CATALOG;

			if ($product_id) {
				$this->load->model('catalog/product');
				$prod = $this->model_catalog_product->getProduct($product_id);
				$question_data['product_name'] = $prod['name'];
				$template->data['mail_text_question_answered'] = sprintf($language->get('pq_mail_text_question_answered'),"<a href='".HTTP_CATALOG."'>".$this->config->get('config_name')."</a>","<a href='".HTTP_CATALOG."index.php?route=product/product&product_id=$product_id'>".$question_data['product_name']."</a>");
				$subject = sprintf($language->get('pq_mail_text_subject'), $this->config->get('config_name'), $question_data["product_name"]);
			} else {
				$template->data['mail_text_question_answered'] = sprintf($language->get('pqs_mail_text_question_answered'),"<a href='".HTTP_CATALOG."'>".$this->config->get('config_name')."</a>");
				$subject = sprintf($language->get('pqs_mail_text_subject'), $this->config->get('config_name'));
			}
			
			
			$mail = new Mail(); 
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');
						
			$mail->setTo($question_data['customer_email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender($this->config->get('config_name'));
			$mail->setSubject($subject);
			$mail->setHtml($template->fetch('mail/productquestion.tpl'));
			$mail->send();	
		}
        return true;
    }
        
    public function showErrors() {
        $sql = 'SHOW ERRORS';
        $err = $this->db->query($sql);
        
        foreach ($err as $e) {
			echo "<div class='error'>Error: {$e['Message']}</div>";
		}
		return false;
    }
}
