<?php
/***********************************************************************
  Extension: People's Code - Fee / Discount v1.2
  Copyright (C) 2013 People's Code
  Email: info.peoplescode@gmail.com
  Web: http://www.peoplescode.com
************************************************************************/
// Heading
$_['heading_title']              = 'People\'s Code - Fee / Discount';

// Button
$_['button_cancel']              = 'Exit';

// Text
$_['text_total']                 = 'Order Totals';
$_['text_success']               = 'Success: You have modified payment fee total!';
$_['text_pfd_help']              = 'Help On/Off';
$_['text_pfd_shipping_address']  = 'Shipping address';
$_['text_pfd_payment_address']   = 'Payment address';
$_['text_pfd_sub_total']         = 'SubTotal is';
$_['text_pfd_total']             = 'Total is';
$_['text_pfd_enable_more']       = '&gt;';
$_['text_pfd_enable_less']       = '&lt;';
$_['text_pfd_fixed']             = 'Fixed Amount';
$_['text_pfd_percentage']        = 'Percentage %';
$_['text_pfd_parallel']          = 'Parallel';
$_['text_pfd_serial']            = 'Serial';
$_['text_pfd_expand']            = 'Expand All';
$_['text_pfd_collapse']          = 'Collapse All';
$_['text_pfd_one_step_up']       = 'One Step Up';
$_['text_pfd_one_step_down']     = 'One Step Down';
$_['text_pfd_up']                = 'Click &amp; Drag';
$_['text_pfd_down']              = 'Click &amp; Drag';
$_['text_pfd_add']               = 'Add Row';
$_['text_pfd_remove']            = 'Remove Row';
$_['text_pfd_confirm']           = 'Are you sure you want to delete this row ?';
$_['text_pfd_default']           = 'Default';
$_['text_pfd_light']             = 'Light';

// Help
$_['help_conditions_h']          = 'Conditions';
$_['help_conditions']            = '<p>Conditions are compared with order data during checkout. If all comparisons evaluate to true, the row\'s payment Fee / Discount is applied, otherwise the row is skipped and the next row is evaluated.</p><p>IMPORTANT!: If all fields in a list are left unselected, the condition will be skipped and will evaluate to true for all cases, therefore it is the same as if all fields were selected. Although either way produces the same results, if a condition is required to always evaluate to true, the preferred way is to leave the list unselected instead of selecting everything.</p><p>All conditions are evaluated in the order listed bellow (to skip evaluating any condition, leave its fields unselected).</p><ol>
<li><strong>Shipping method:</strong> Limits row\'s Fee / Discount to selected Shipping Methods*. To list more shipping methods, go to menu: Extensions->Shipping and enable the required shipping methods. *Note: Some shipping methods implement various services as shipping options (e.g. Fedex, UPS, etc). Those services cannot be used as conditions.</li>
<li><strong>Payment method:</strong> Limits row\'s Fee / Discount to selected Payment Methods. To list more payment methods, go to menu: Extensions->Payments and enable the required payment methods.</li>
<li><strong>Customer Group:</strong> Limits row\'s Fee / Discount to selected Customer Groups.</li>
<li><strong>Geo Zone:</strong> Limits row\'s Fee / Discount to selected Geo Zones.</li><li><strong>Geo Zone based on Customer\'s address:</strong> Defines whether Geo Zones are compared to customer\'s Shipping or Payment Address Geo Zone (this condition applies only if any Geo Zones are selected).</li><li><strong>Enable Payment Fee / Discount if:</strong> Checks if the Cart\'s Sub-total or Total** amount is above or below the specified limit. The value must be a positive number (to disable this condition leave this value blank). **Note: Total here reflects the total calculated amount <span style="text-decoration:underline;font-weight:bold">just before</span> Fee / Discount extension. This is the Total value fed to this extension from previous Order Total extensions (e.g. Sub-Total, Reward Points, Low Order Fee, etc).</li></ol>';
$_['help_fee_discount_h']        = 'Fee / Discount';
$_['help_fee_discount']          = '<p>Fee / Discount is the amount added or subtracted from the cart\'s Total during checkout if all conditions are met (in other words evaluate to true). Each Fee / Discount applied is rounded to two decimal places, so that displayed values match internal computed values.</p><ol>
<li><strong>Amount (+ /-):</strong> Select "Fixed amount" or "Percentage %" and enter a positive number for Fee or a negative number for Discount. For decimal point use dot. If you select percentage, do not enter the % sign, just write a number.</li><li><strong>Compute:</strong> Multiple Fees / Discounts can be applied to an order in parallel or serial manner:<br />
<p><strong>Parallel:</strong> Each Fee / Discount is calculated independently based on the <span style="text-decoration:underline;">same</span> Total value fed to this extension from previous Order Total extensions (e.g. Sub-Total, Reward Points, Low Order Fee, etc).<br />
<strong>Serial:</strong> Each subsequent serial Fee / Discount is based on the calculated Total of previously applied serial Fees / Discounts.</p>


The following examples illustrate how different combinations are calculated (Taxes are omitted for the sake of simplicity):
<p><strong>All Parallel</strong> (Input Total = 100&euro;).<br />All parallel discounts are based on the Input Total.<br />1st Parallel discount -25% (100&euro; x -25% = -25&euro;)<br />2nd Parallel discount -9% (100&euro; x -9% = -9&euro;)<br />3rd Parallel discount -4% (100&euro; x -4% = -4&euro;)<br />Total after all Fees/Discounts Applied (100&euro; - 25&euro; - 9&euro; - 4&euro;) = <strong>62&euro;</strong></p><p><strong>All Serial</strong> (Input Total = 100&euro;)<br />Each subsequent discount is based on the outcome of  a previous discount.<br />1st Serial discount -25% (100&euro; x -25% = -25&euro;, Total after 1st serial discount: 100&euro; - 25&euro; = 75&euro;)<br />2nd Serial discount -9% (75&euro; x -9% = -6.75&euro; &amp;, Total after 2nd serial discount: 75&euro; - 6.75&euro; = 68.25&euro;)<br />3rd Serial discount -4% (68.25&euro; x -4% = -2.73&euro;)<br />Total after all Fees/Discounts Applied (100&euro; - 25&euro; - 6.75&euro; - 2.73&euro;) = <strong>65.52&euro;</strong> </p><p><strong>Serial - Parallel - Serial*</strong> (Input Total = 100&euro;)<br />
Here the outcome of the 1st serial discount feeds the 3rd serial discount. The 2nd parallel discount is calculated interdependently based on the Input total. *Note: This is a really rare setting, but it\'s documented here just to inform you that this behavior exists if you ever need it.<br />1st Serial discount -25% (100&euro; x -25% = -25&euro;, Total after 1st serial discount: 100&euro; - 25&euro; = 75&euro;)<br />2nd Parallel discount -9% (100&euro; x -9% = -9&euro;, this is calculated independently, based on the extension\'s Input Total.)<br />3rd Serial discount -4% (75&euro; x -4% = -3&euro;)<br />Total after all Fees/Discounts Applied (100&euro; - 25&euro; - 9&euro; - 3&euro;) = <strong>63&euro;</strong></p></li><li><strong>Tax Class:</strong> If a tax class is selected, the Fee\'s / Discount\'s tax is calculated according to the tax class\' rules (System->Localisation->Taxes->Tax Classes). All calculated taxes are added to the "Tax Order Total\'s" amount. If it\'s set to none, then it is skipped and the Fee / Discount is applied without tax.</li><li><strong>Description:</strong> You may enter a multilanguage description for each Fee /discount applied. This description is displayed at checkout and order invoice. If left blank, a generic "Fee / Discount" description is displayed.</li></ol>';

// Column
$_['text_pfd_conditions']        = 'Conditions';
$_['text_pfd_fee']               = 'Fee / Discount';

// Entry
$_['entry_pfd_shipping']         = 'Shipping Method:';
$_['entry_pfd_payment']          = 'Payment Method:';
$_['entry_pfd_enable_if']        = 'Enable Fee / Discount if:';
$_['entry_pfd_customer_group']   = 'Customer Group:';
$_['entry_pfd_geo_zone']         = 'Geo Zone:';
$_['entry_pfd_cust_geo_zone']    = 'Geo Zone based on Customer&#39;s:';
$_['entry_pfd_amount']           = 'Amount (+ / -):';
$_['entry_pfd_compute']          = 'Compute:';
$_['entry_pfd_tax_class']        = 'Tax Class:';
$_['entry_pfd_translations']     = 'Description:';

$_['entry_style']                = 'Theme:<br /><span class="help">Changes module\'s backend theme.</span>';
$_['entry_status']               = 'Status:';
$_['entry_sort_order']           = 'Sort Order:<br /><span class="help">Initially set after Sub-total. <br />For proper operation, sort order number should be higher than Sub-total\'s and lower than Tax\'s sort-order.</span>';

// Error
$_['error_permission']           = 'Warning: You do not have permission to modify payment fee total!';
$_['error_check_form']           = 'Please check form for errors. For more details, place mouse pointer over the warning signs!';
$_['error_enable_amount']        = 'Enable amount must be positive number';
$_['error_fee']                  = 'Amount must be positive or negative number';
$_['error_blank']                = 'Please enter an amount';
?>
