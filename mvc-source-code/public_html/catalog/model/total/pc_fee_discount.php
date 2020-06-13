<?php
/***********************************************************************
  Extension: People's Code - Fee / Discount v1.2
  Copyright (C) 2013 People's Code
  Email: info.peoplescode@gmail.com
  Web: http://www.peoplescode.com
************************************************************************/
class ModelTotalPcFeeDiscount extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {

    // Check if Shipping & Payment Method is set
    if (isset($this->session->data['shipping_method']) && isset($this->session->data['payment_method'])) {

      $this->language->load('total/pc_fee_discount');

      $sub_total = $this->cart->getSubTotal();

      $computed_total = $default_total = $total;

      $language_id = $this->config->get('config_language_id');

      $pc_fee_discount_rows = $this->config->get('pc_fee_discount_rows');

	    if ($this->customer->isLogged()) {
	      $customer_group_id = $this->customer->getCustomerGroupId();
			} elseif (isset($this->session->data['guest'])) {
			  $customer_group_id = $this->session->data['guest']['customer_group_id'];
			}

      // Start pc_fee_discount_rows loop
      $row_count = count($pc_fee_discount_rows);
      
      $sub_sort = '';
      $sub_sort_advance_num = 1;

      for ($i = 0; $i < $row_count; $i++) {
        
			  $localization = '';
			  $enable = '';
        $row_fee = '';

			  // Check payment_method and customer_group_id
	      if ((!isset($pc_fee_discount_rows[$i]['shippings_selected']) || (isset($pc_fee_discount_rows[$i]['shippings_selected']) && in_array(substr($this->session->data['shipping_method']['code'], 0, strpos($this->session->data['shipping_method']['code'], '.')), $pc_fee_discount_rows[$i]['shippings_selected']))) && (!isset($pc_fee_discount_rows[$i]['payments_selected']) || (isset($pc_fee_discount_rows[$i]['payments_selected']) && in_array($this->session->data['payment_method']['code'], $pc_fee_discount_rows[$i]['payments_selected'])))) {

          if (!isset($pc_fee_discount_rows[$i]['groups_selected']) || isset($pc_fee_discount_rows[$i]['groups_selected']) && in_array($customer_group_id, $pc_fee_discount_rows[$i]['groups_selected'])) {

					  // Check geo_zone_id
					  if (isset($pc_fee_discount_rows[$i]['geo_zones_selected'])) {
              
              // Check Shipping / Payment address
              if ($pc_fee_discount_rows[$i]['address']) {
		    	      $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE country_id = '" . (int)$this->session->data['payment_country_id'] . "' AND (zone_id = '" . (int)$this->session->data['payment_zone_id'] . "' OR zone_id = '0')");
              } else {
		    	      $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE country_id = '" . (int)$this->session->data['shipping_country_id'] . "' AND (zone_id = '" . (int)$this->session->data['shipping_zone_id'] . "' OR zone_id = '0')");
              }

              if ($query->num_rows) {
                foreach ($query->rows as $row) {
                  if (in_array($row['geo_zone_id'], $pc_fee_discount_rows[$i]['geo_zones_selected'])) {
                    $localization = true;
                  }
                }
              }
					             
            } else {
              $localization = true;
            }

            // Check enable_condition & enable_more against sub_total / total
					  if ($pc_fee_discount_rows[$i]['enable_amount']) {

					    if (!$pc_fee_discount_rows[$i]['enable_condition'] && !$pc_fee_discount_rows[$i]['enable_more']) {
					      $enable = $sub_total < $pc_fee_discount_rows[$i]['enable_amount'] ? true : false;
					    } elseif (!$pc_fee_discount_rows[$i]['enable_condition'] && $pc_fee_discount_rows[$i]['enable_more']) {
							  $enable = $sub_total > $pc_fee_discount_rows[$i]['enable_amount'] ? true : false;
					    } elseif ($pc_fee_discount_rows[$i]['enable_condition'] && !$pc_fee_discount_rows[$i]['enable_more']) {
						  $enable = $total < $pc_fee_discount_rows[$i]['enable_amount'] ? true : false;
					    } elseif ($pc_fee_discount_rows[$i]['enable_condition'] && $pc_fee_discount_rows[$i]['enable_more']) {
					      $enable = $total > $pc_fee_discount_rows[$i]['enable_amount'] ? true : false;
              }

					  } else {
					    $enable = true;
					  }

					  if ($localization && $enable) {

					    if ($pc_fee_discount_rows[$i]['percentage']) {

                if ($pc_fee_discount_rows[$i]['serial']) {
							    $row_fee = ($computed_total / 100 * $pc_fee_discount_rows[$i]['fee']);
                  $computed_total += $row_fee;
                } else {
                  $row_fee = ($default_total / 100 * $pc_fee_discount_rows[$i]['fee']);
                }

						  } else { // It's Fixed Amount

                 if ($pc_fee_discount_rows[$i]['serial']) {
                   $row_fee = $pc_fee_discount_rows[$i]['fee'];
                   $computed_total += $row_fee;
                 } else {
                   $row_fee = $pc_fee_discount_rows[$i]['fee'];
                 }

						  }

            $row_fee = round($row_fee, 2);  // Round Row Fee to match displayed values

					  if ($pc_fee_discount_rows[$i]['tax_class_id']) {
					    $tax_rates = $this->tax->getRates($row_fee, $pc_fee_discount_rows[$i]['tax_class_id']);
			    
					    foreach ($tax_rates as $tax_rate) {
						    if (!isset($taxes[$tax_rate['tax_rate_id']])) {
							    $taxes[$tax_rate['tax_rate_id']] = $tax_rate['amount'];
							  } else {
							    $taxes[$tax_rate['tax_rate_id']] += $tax_rate['amount'];
							  }
						  }
					  }
                    
            // If description is not set show generic fee or discount description
            $description = isset($pc_fee_discount_rows[$i]['description'][$language_id]) && $pc_fee_discount_rows[$i]['description'][$language_id] ? $pc_fee_discount_rows[$i]['description'][$language_id] : ($row_fee > 0 ? $this->language->get('text_pfd_description_fee') : $this->language->get('text_pfd_description_discount')); // check pc_fee_discount and show appropriate description
					  }
          }
        }

					if ($row_fee) {           

            // Sorting fix for SORT_ASC
            if (substr_count($sub_sort, '1') < ceil($row_count / 9)) {
              $sub_sort .= '1';
            } else {
              $sub_sort = ++$sub_sort_advance_num . '1';
            }

            $total_data[] = array(
				      'code'        => 'pc_fee_discount',
              'title'       => $description,
              'text'        => $this->currency->format($row_fee),
              'value'       => $row_fee,
              'sort_order'  => $this->config->get('pc_fee_discount_sort_order') . '.' . $sub_sort
				    );
            
				    $total += $row_fee;

			    }

      } // END pc_fee_discount_rows loop
		} // END Check if Shipping & Payment Method is set
	}
}
?>
