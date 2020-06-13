<?php
class ModelDesignBanner extends Model
{
    public function getBanner($banner_id)
    {
        if (isset($this->request->get['path'])) {
            $path = $this->request->get['path'];
        } else {
            $path = '';
        }
        if (isset($this->request->get['route'])) {
            $route = $this->request->get['route'];
        } else {
            $route = '';
        }

        if (strripos($path, '_')){
            $oldPath = $path;
            $path = explode('_', $path);
            $path = end($path);
        }

        if ($route == 'product/category') {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image bi INNER JOIN " . DB_PREFIX . "banner_to_category btc ON (bi.banner_image_id  = btc.banner_image_id and btc.category_id='" . $path . "')  LEFT JOIN " . DB_PREFIX . "banner_image_description bid ON (bi.banner_image_id  = bid.banner_image_id) WHERE bi.banner_id = '" . (int)$banner_id . "' AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        } else if ($route == 'product/product') {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image bi INNER JOIN " . DB_PREFIX . "banner_to_category btc ON (bi.banner_image_id  = btc.banner_image_id and btc.category_id='" . $path . "')  LEFT JOIN " . DB_PREFIX . "banner_image_description bid ON (bi.banner_image_id  = bid.banner_image_id) WHERE bi.banner_id = '" . (int)$banner_id . "' AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        } else {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image bi LEFT JOIN " . DB_PREFIX . "banner_image_description bid ON (bi.banner_image_id  = bid.banner_image_id) WHERE bi.banner_id = '" . (int)$banner_id . "' AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        }

        return $query->rows;
    }
}

?>