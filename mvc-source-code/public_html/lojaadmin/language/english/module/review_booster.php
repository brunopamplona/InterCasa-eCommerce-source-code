<?php
/*
  Review Booster
  Premium Extension
  
  Copyright (c) 2013 - 2019 Adikon.eu
  http://www.adikon.eu/
  
  You may not copy or reuse code within this file without written permission.
*/
// Heading
$_['heading_title']                    = 'Review Booster';

$_['date_format_short']                = 'Y/m/d';
$_['date_format_long']                 = 'Y/m/d H:i:s';

// Text
$_['text_module']                      = 'Modules';
$_['text_success']                     = 'Success: You have modified Review Booster!';
$_['text_no_change']                   = '- do not change -';
$_['text_to_1']                        = 'Customers';
$_['text_to_2']                        = 'Guests';
$_['text_to_3']                        = 'Customers & Guests';
$_['text_day']                         = 'day(s)';
$_['text_percentage']                  = 'Percentage';
$_['text_fixed']                       = 'Fixed amount';
$_['text_type_1']                      = 'A one reminder with one form for all ordered products';
$_['text_type_2']                      = 'Reminder will be sent for each product from the order';
$_['text_type_3']                      = 'All products from the order in a one email with separate forms';
$_['text_width']                       = 'Width';
$_['text_height']                      = 'Height';
$_['text_subject']                     = 'Subject';

// Entry
$_['entry_module_status']              = 'Module Status';
$_['entry_to']                         = 'To';
$_['entry_order_status']               = 'Order Status';
$_['entry_new_order_status']           = 'New Status Order';
$_['entry_notify']                     = 'Notify Customer';
$_['entry_exclude_customer_group']     = 'Exclude Customer Group';
$_['entry_approve_review_status']      = 'Auto Approve Reviews';
$_['entry_approve_review_rating']      = 'Average Rating';
$_['entry_day']                        = 'Delay Message';
$_['entry_previous']                   = 'Previous Orders';
$_['entry_coupon_status']              = 'Discount Status';
$_['entry_coupon_value']               = 'Discount';
$_['entry_coupon_validity']            = 'Validity';
$_['entry_type']                       = 'Review Type';
$_['entry_star']                       = 'Rating Color';
$_['entry_star_custom']                = 'Custom Color';
$_['entry_product_image_status']       = 'Product Image Status';
$_['entry_product_limit']              = 'Product Limit';
$_['entry_verified_buyer_status']      = 'Verified Buyer Status';
$_['entry_verified_buyer_text']        = 'Verified Buyer Text';
$_['entry_manually_status']            = 'Manually Remind Status';
$_['entry_field']                      = 'Custom Field';
$_['entry_field_gdpr']                 = 'Privacy Policy';
$_['entry_field_noticed']              = 'Website Noticed';
$_['entry_noticed']                    = 'Add Value';
$_['entry_apr_status']                 = 'Rating Criteria';
$_['entry_apr_image_status']           = 'Review Images';
$_['entry_link_text']                  = 'Link Text';
$_['entry_mail']                       = 'Mail';

// Caption
$_['caption_general']                  = 'General';
$_['caption_appearance']               = 'Appearance';
$_['caption_integration']              = 'Integration';
$_['caption_template']                 = 'Email Template';

// Help
$_['help_order_status']                = 'Choose which order statuses receive remind mail.';
$_['help_new_order_status']            = 'A new status of order after sending the reminder.';
$_['help_exclude_customer_group']      = 'Customer groups which DO NOT receive a review reminder.';
$_['help_day']                         = 'Review request email will be send after X days of setting the order status to a specific value (orders selected by Date Modified).';
$_['help_previous']                    = 'Enable it, if you want send emails after X days and more, disable to send exactly after X days.';
$_['help_coupon_status']               = 'The coupon code will be generated for each user individually and will be displayed after submitting the review form.';
$_['help_product_limit']               = 'If the client ordered a lot of products, you can limit them in the form review. Leave blank or enter 0 for unlimited.';
$_['help_verified_buyer_status']       = 'Additional note \'Verified Buyer\' beside the name of the reviewer.';
$_['help_manually_status']             = 'Enable it, if you want to show an additional button on the list of orders to run the reminders process manually.';
$_['help_apr_status']                  = 'If you have a module <a href="http://www.adikon.eu/advanced-product-review-review-manager" target="_blank">Advanced Product Reviews</a>, enable it, if you want show the created stars in the form review.';
$_['help_apr_image_status']            = 'If you have a module <a href="http://www.adikon.eu/advanced-product-review-review-manager" target="_blank">Advanced Product Reviews</a>, enable it, if you want allow customer to upload images.';
$_['help_link_text']                   = 'Text for link when you use a shortcode {link} in content of email.';

// Tab
$_['tab_setting']                      = 'Module Settings';

// Error
$_['error_permission']                 = 'Warning: You do not have permission to modify module Review Booster!';
$_['error_required']                   = 'Warning: Please check the form carefully for errors!';
$_['error_module']                     = 'Module does not exist!';
$_['error_order_status']               = 'Select an order status at which to send email to the customer!';
$_['error_day']                        = 'Define after how many days to send the email!';
?>