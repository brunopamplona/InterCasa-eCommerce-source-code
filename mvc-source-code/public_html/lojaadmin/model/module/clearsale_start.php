<?php
class ModelModuleClearsaleStart extends Model {
    public function getTables() {
        $query = $this->db->query("
            SELECT TABLE_NAME AS _table
            FROM INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = '" . DB_DATABASE . "'
        ");

        return $query->rows;
    }

    public function getColumns($table) {
        $query = $this->db->query("SHOW COLUMNS FROM `" . $this->db->escape($table) . "`");

        return $query->rows;
    }

    public function getOrderColumns() {
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "order`");

        return $query->rows;
    }

    public function getOrder($data, $order_id) {
        $columns = implode(", ", array_values($data));

        $query = $this->db->query("
            SELECT " . $columns . " 
            FROM `" . DB_PREFIX . "order` 
            WHERE `order_id` = '" . (int) $order_id . "'
        ");

        if ($query->num_rows) {
            return $query->row;
        } else {
            return false;
        }
    }

    public function getTransaction($tabela = '', $colunas = array(), $coluna_order_id = '', $order_id = 0) {
        if (!empty($tabela) && is_array($colunas) && !empty($colunas) && !empty($coluna_order_id) && $order_id > 0) {
            $colunas = implode(", ", array_values($colunas));

            $query = $this->db->query("
                SELECT " . $colunas . "
                FROM `" . $tabela . "`
                WHERE `" . $coluna_order_id . "` = '" . (int) $order_id . "'
            ");

            if ($query->num_rows) {
                return $query->row;
            }
        }

        return false;
    }

    public function getOrderShipping($order_id) {
        $query = $this->db->query("
            SELECT * FROM `" . DB_PREFIX . "order_total`
            WHERE order_id = '" . (int) $order_id . "'
            ORDER BY sort_order ASC
        ");

        $result = array();

        foreach ($query->rows as $total) {
            if ($total['value'] > 0) {
                if ($total['code'] == "shipping") {
                    $result[] = array(
                        'code' => $total['code'],
                        'title' => $total['title'],
                        'value' => $total['value']
                    );
                }
            }
        }

        return $result;
    }
}