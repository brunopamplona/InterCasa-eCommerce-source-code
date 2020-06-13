<?php
class ModelPaymentCieloAPI extends Model {
    public function install() {
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "order_cielo_api` (
            `order_cielo_api_id` INT(11) NOT NULL AUTO_INCREMENT,
            `order_id` INT(11) NULL,
            `tid` VARCHAR(40) NULL,
            `nsu` VARCHAR(20) NULL,
            `authorizationCode` TEXT NULL,
            `paymentId` VARCHAR(36) NULL,
            `status` VARCHAR(2) NULL,
            `dataPedido` VARCHAR(20) NULL,
            `tipo` VARCHAR(20) NULL,
            `parcelas` VARCHAR(2) NULL,
            `bandeira` VARCHAR(10) NULL,
            `autorizacaoData` VARCHAR(20) NULL,
            `autorizacaoValor` VARCHAR(15) NULL,
            `capturaData` VARCHAR(20) NULL,
            `capturaValor` VARCHAR(15) NULL,
            `cancelaData` VARCHAR(20) NULL,
            `cancelaValor` VARCHAR(15) NULL,
            `json` TEXT NULL,
            PRIMARY KEY (`order_cielo_api_id`) );
        ");
    }

    public function updateTable() {
        $this->install();

        $fields = array(
            'order_cielo_api_id' => 'int(11)',
            'order_id' => 'int(11)',
            'tid' => 'varchar(40)',
            'nsu' => 'varchar(20)',
            'authorizationCode' => 'text',
            'paymentId' => 'varchar(36)',
            'status' => 'varchar(2)',
            'dataPedido' => 'varchar(20)',
            'tipo' => 'varchar(20)',
            'parcelas' => 'varchar(2)',
            'bandeira' => 'varchar(10)',
            'autorizacaoData' => 'varchar(20)',
            'autorizacaoValor' => 'varchar(15)',
            'capturaData' => 'varchar(20)',
            'capturaValor' => 'varchar(15)',
            'cancelaData' => 'varchar(20)',
            'cancelaValor' => 'varchar(15)',
            'json' => 'text'
        );

        $table = DB_PREFIX . "order_cielo_api";

        $field_query = $this->db->query("SHOW COLUMNS FROM `" . $table . "`");
        foreach ($field_query->rows as $field) {
            $field_data[$field['Field']] = $field['Type'];
        }

        foreach ($field_data as $key => $value) {
            if (!array_key_exists($key, $fields)) {
                $this->db->query("ALTER TABLE `" . $table . "` DROP COLUMN `" . $key . "`");
            }
        }

        $this->session->data['after_column'] = 'order_cielo_api_id';
        foreach ($fields as $key => $value) {
            if (!array_key_exists($key, $field_data)) {
                $this->db->query("ALTER TABLE `" . $table . "` ADD `" . $key . "` " . $value . " AFTER `" . $this->session->data['after_column'] . "`");
            }
            $this->session->data['after_column'] = $key;
        }
        unset($this->session->data['after_column']);

        foreach ($fields as $key => $value) {
            if ($key == 'order_cielo_api_id') {
                $this->db->query("ALTER TABLE `" . $table . "` CHANGE COLUMN `" . $key . "` `" . $key . "` " . $value . " NOT NULL AUTO_INCREMENT");
            } else {
                $this->db->query("ALTER TABLE `" . $table . "` CHANGE COLUMN `" . $key . "` `" . $key . "` " . $value);
            }
        }
    }

    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "order_cielo_api`;");
    }

    public function getOrderColumns($data = array()) {
        $sql = "SHOW COLUMNS FROM `" . DB_PREFIX . "order`";

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTransactions($data = array()) {
        $sql = "SELECT oc.order_id, oc.order_cielo_api_id, oc.dataPedido, CONCAT(o.firstname, ' ', o.lastname) as customer, oc.bandeira, oc.parcelas, oc.tipo, oc.tid, oc.nsu, oc.autorizacaoData, oc.autorizacaoValor, oc.capturaData, oc.capturaValor, oc.cancelaData, oc.cancelaValor, oc.status FROM `" . DB_PREFIX . "order_cielo_api` oc INNER JOIN `" . DB_PREFIX . "order` o ON (o.order_id = oc.order_id) ";

        if (!empty($data['filter_order_id'])) {
            $sql .= " WHERE oc.order_id = '" . (int)$data['filter_order_id'] . "'";
        } else {
            $sql .= " WHERE oc.order_id > '0'";
        }

        if (!empty($data['filter_dataPedido'])) {
            $sql .= " AND STR_TO_DATE(oc.dataPedido,'%Y-%m-%d') = '" . $data['filter_dataPedido'] . "'";
        }

        if (!empty($data['filter_customer'])) {
            $sql .= " AND CONCAT(o.firstname, ' ', o.lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
        }

        if (!empty($data['filter_tid'])) {
            $sql .= " AND oc.tid = '" . $this->db->escape($data['filter_tid']) . "'";
        }

        if (!empty($data['filter_nsu'])) {
            $sql .= " AND oc.nsu = '" . $this->db->escape($data['filter_nsu']) . "'";
        }

        if (isset($data['filter_status'])) {
            $sql .= " AND oc.status = '" . $this->db->escape($data['filter_status']) . "'";
        }

        $sort_data = array(
            'oc.order_id',
            'oc.dataPedido',
            'customer',
            'oc.status'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY oc.order_id";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalTransactions($data = array()) {
        $sql = "SELECT COUNT(DISTINCT oc.order_cielo_api_id) AS total FROM `" . DB_PREFIX . "order_cielo_api` oc INNER JOIN `" . DB_PREFIX . "order` o ON (o.order_id = oc.order_id) ";

        if (!empty($data['filter_order_id'])) {
            $sql .= " WHERE oc.order_id = '" . (int)$data['filter_order_id'] . "'";
        } else {
            $sql .= " WHERE oc.order_id > '0'";
        }

        if (!empty($data['filter_dataPedido'])) {
            $sql .= " AND STR_TO_DATE(oc.dataPedido,'%Y-%m-%d') = '" . $data['filter_dataPedido'] . "'";
        }

        if (!empty($data['filter_customer'])) {
            $sql .= " AND CONCAT(o.firstname, ' ', o.lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
        }

        if (!empty($data['filter_tid'])) {
            $sql .= " AND oc.tid = '" . $this->db->escape($data['filter_tid']) . "'";
        }

        if (!empty($data['filter_nsu'])) {
            $sql .= " AND oc.nsu = '" . $this->db->escape($data['filter_nsu']) . "'";
        }

        if (isset($data['filter_status'])) {
            $sql .= " AND oc.status = '" . $this->db->escape($data['filter_status']) . "'";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getOrder($data, $order_id) {
        $columns = implode(", ", array_values($data));

        $qry = $this->db->query("
            SELECT " . $columns . " 
            FROM `" . DB_PREFIX . "order` 
            WHERE `order_id` = '" . (int)$order_id . "'
        ");

        if ($qry->num_rows) {
            return $qry->row;
        } else {
            return false;
        }
    }

    public function getTransaction($order_cielo_api_id) {
        $qry = $this->db->query("
            SELECT * 
            FROM `" . DB_PREFIX . "order_cielo_api` 
            WHERE `order_cielo_api_id` = '" . (int)$order_cielo_api_id . "'
        ");

        if ($qry->num_rows) {
            return $qry->row;
        } else {
            return false;
        }
    }

    public function updateTransactionStatus($data) {
        $this->db->query("
            UPDATE `" . DB_PREFIX . "order_cielo_api`
            SET status = '" . $this->db->escape($data['status']) . "'
            WHERE order_cielo_api_id = '" . (int)$data['order_cielo_api_id'] . "'
        ");
    }

    public function updateTransaction($data) {
        $this->db->query("
            UPDATE `" . DB_PREFIX . "order_cielo_api`
            SET status = '" . $this->db->escape($data['status']) . "',
                autorizacaoData = '" . $this->db->escape($data['autorizacaoData']) . "',
                autorizacaoValor = '" . $this->db->escape($data['autorizacaoValor']) . "',
                capturaData = '" . $this->db->escape($data['capturaData']) . "',
                capturaValor = '" . $this->db->escape($data['capturaValor']) . "',
                cancelaData = '" . $this->db->escape($data['cancelaData']) . "',
                cancelaValor = '" . $this->db->escape($data['cancelaValor']) . "'
            WHERE order_cielo_api_id = '" . (int)$data['order_cielo_api_id'] . "'
        ");
    }

    public function captureTransaction($data) {
        $this->db->query("
            UPDATE `" . DB_PREFIX . "order_cielo_api`
            SET status = '" . $this->db->escape($data['status']) . "',
                json = '" . $data['json'] . "'
            WHERE order_cielo_api_id = '" . (int)$data['order_cielo_api_id'] . "'
        ");
    }

    public function cancelTransaction($data) {
        $this->db->query("
            UPDATE `" . DB_PREFIX . "order_cielo_api`
            SET status = '" . $this->db->escape($data['status']) . "',
                json = '" . $data['json'] . "'
            WHERE order_cielo_api_id = '" . (int)$data['order_cielo_api_id'] . "'
        ");
    }

    public function deleteTransaction($order_cielo_api_id) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "order_cielo_api` WHERE order_cielo_api_id = '" . (int)$order_cielo_api_id . "'");
    }

    public function getOrderShipping($order_id) {
        $order_total_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$order_id . "' ORDER BY sort_order ASC");

        $orderShipping = array();

        foreach ($order_total_query->rows as $total) {
            if ($total['value'] > 0) {
                if ($total['code'] == "shipping") {
                    $orderShipping[] = array(
                        'code' => $total['code'],
                        'title' => $total['title'],
                        'value' => $total['value']
                    );
                }
            }
        }
        return $orderShipping;
    }
}
?>