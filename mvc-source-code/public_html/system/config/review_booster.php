<?php
/*
  Review Booster
  Premium Extension
  
  Copyright (c) 2013 - 2019 Adikon.eu
  http://www.adikon.eu/
  
  You may not copy or reuse code within this file without written permission.
*/
$_['rb_module_type']  = 'module';
$_['rb_module_name']  = 'review_booster';
$_['rb_module_path']  = 'module/review_booster';
$_['rb_module_model'] = 'model_module_review_booster';
$_['rb_fields'] = array(
	'status'                 => array('default' => '0', 'decode' => false, 'required' => true),
	'to'                     => array('default' => 'all', 'decode' => false, 'required' => false),
	'order_status'           => array('default' => array(), 'decode' => false, 'required' => true),
	'new_order_status'       => array('default' => '0', 'decode' => false, 'required' => false),
	'notify'                 => array('default' => '', 'decode' => false, 'required' => false),
	'exclude_customer_group' => array('default' => array(), 'decode' => false, 'required' => false),
	'approve_review_status'  => array('default' => '0', 'decode' => false, 'required' => false),
	'approve_review_rating'  => array('default' => '4', 'decode' => false, 'required' => false),
	'day'                    => array('default' => '5', 'decode' => false, 'required' => true),
	'previous'               => array('default' => '1', 'decode' => false, 'required' => false),
	'coupon_status'          => array('default' => '0', 'decode' => false, 'required' => false),
	'coupon_discount'        => array('default' => '5', 'decode' => false, 'required' => false),
	'coupon_validity'        => array('default' => '10', 'decode' => false, 'required' => false),
	'type'                   => array('default' => 'order', 'decode' => false, 'required' => false),
	'star'                   => array('default' => 'default', 'decode' => false, 'required' => false),
	'star_custom'            => array('default' => '', 'decode' => false, 'required' => false),
	'product_image_status'   => array('default' => '0', 'decode' => false, 'required' => false),
	'product_image_width'    => array('default' => '60', 'decode' => false, 'required' => false),
	'product_image_height'   => array('default' => '60', 'decode' => false, 'required' => false),
	'product_limit'          => array('default' => '', 'decode' => false, 'required' => false),
	'verified_buyer_status'  => array('default' => '0', 'decode' => false, 'required' => false),
	'verified_buyer_text'    => array('default' => 'Verified Buyer', 'decode' => false, 'required' => false),
	'manually_status'        => array('default' => '0', 'decode' => false, 'required' => false),
	'gdpr_status'            => array('default' => '0', 'decode' => false, 'required' => false),
	'gdpr_information_id'    => array('default' => '0', 'decode' => false, 'required' => false),
	'noticed_status'         => array('default' => '0', 'decode' => false, 'required' => false),
	'notice'                 => array('default' => array('Social Media', 'Ads', 'Forum', 'Friend'), 'decode' => false, 'required' => false),
	'apr_status'             => array('default' => '0', 'decode' => false, 'required' => false),
	'apr_image_status'       => array('default' => '0', 'decode' => false, 'required' => false),
	'link_text'              => array('default' => 'click here', 'decode' => false, 'required' => false),
	'email'                  => array('default' => array('subject' => 'V3JpdGUgcmV2aWV3IGZvciBvcmRlcnM=', 'description' => 'PHRhYmxlIHN0eWxlPSJ3aWR0aDoxMDAlO2JvcmRlcjowO21hcmdpbjowO3BhZGRpbmc6MDttYXJnaW4tdG9wOjMwcHg7Zm9udC1mYW1pbHk6VmVyZGFuYTsiPgoJPHRib2R5PgoJCTx0cj4KCQkJPHRkIGFsaWduPSJjZW50ZXIiPgoJCQkJPHRhYmxlIHN0eWxlPSJ3aWR0aDoxMDAlO21heC13aWR0aDo2ODBweDttYXJnaW46MCBhdXRvO2JvcmRlcjoxcHggc29saWQgI2U4ZThlODttYXJnaW46MDtwYWRkaW5nOjA7bGluZS1oZWlnaHQ6MS44O2ZvbnQtc2l6ZToxLjBlbTtmb250LWZhbWlseTpWZXJkYW5hOyI+CgkJCQkJPHRib2R5PgoJCQkJCQk8dHI+CgkJCQkJCQk8dGQgc3R5bGU9ImJhY2tncm91bmQ6IzAxOTFhYztjb2xvcjojZmZmZmZmO3BhZGRpbmc6MTBweDsiIGFsaWduPSJjZW50ZXIiPkFkZCBSZXZpZXc8L3RkPgoJCQkJCQk8L3RyPgoJCQkJCQk8dHI+CgkJCQkJCQk8dGQgYWxpZ249ImxlZnQiIHN0eWxlPSJmb250LWZhbWlseTppbmhlcml0O3BhZGRpbmc6MTBweDsiPgoJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjojYmJiYmJiO2ZvbnQtc2l6ZToxMXB4OyI+SWYgdGhpcyBlbWFpbCBpcyBub3QgZGlzcGxheWVkIGNvcnJlY3RseSBvciB5b3UgY2Fubm90IHN1Ym1pdCB0aGUgZm9ybSwgcGxlYXNlIHtsaW5rfTwvcD4KCQkJCQkJCQk8cD48c3BhbiBzdHlsZT0iZm9udC1mYW1pbHk6aW5oZXJpdDtmb250LXNpemU6MWVtO2xpbmUtaGVpZ2h0OjEuODsiPkRlYXIge2ZpcnN0bmFtZX0ge2xhc3RuYW1lfSw8L3NwYW4+PC9wPgoJCQkJCQkJCTxwPlRoYW5rIHlvdSBmb3IgcmVjZW50IHB1cmNoYXNlIGZyb20gb3VyIHN0b3JlLjxicj5JdOKAmXMgYmVlbiBhIGNvdXBsZSBvZiBkYXlzL3dlZWtzIHNpbmNlIHlvdSBwbGFjZXMgeW91ciBvcmRlciB3aXRoIHVzIGFuZCB3ZSB3ZXJlIGhvcGluZyB5b3Ugd291bGQgbGV0IHVzLCBhbmQgZXZlcnlvbmUgZWxzZSwga25vdyB3aGF0IHlvdSBhcmUgdGhpbmtpbmcgb2Ygb3V0IHByb2R1Y3RzIHtsaXN0fTwvcD4KCQkJCQkJCQk8cD57Zm9ybX08L3A+CgkJCQkJCQkJPHA+S2luZCBSZWdhcmRzLDxicj57c3RvcmVfbmFtZX08L3A+CgkJCQkJCQk8L3RkPgoJCQkJCQk8L3RyPgoJCQkJCQk8dHI+CgkJCQkJCQk8dGQgc3R5bGU9ImJhY2tncm91bmQ6IzAxOTFhYztoZWlnaHQ6NHB4O2ZvbnQtc2l6ZToxcHg7Ij4mbmJzcDs8L3RkPgoJCQkJCQk8L3RyPgoJCQkJCTwvdGJvZHk+CgkJCQk8L3RhYmxlPgoJCQkJPHAgc3R5bGU9IndpZHRoOjEwMCU7bWF4LXdpZHRoOjY4MHB4O21hcmdpbi10b3A6MjBweDtjb2xvcjojYmJiYmJiO2ZvbnQtc2l6ZTowLjllbTt0ZXh0LWFsaWduOnJpZ2h0OyI+WW91IGNhbiB1bnN1YnNjcmliZSA8YSBocmVmPSJ7dW5zdWJzY3JpYmV9Ij5oZXJlPC9hPjwvcD4KCQkJPC90ZD4KCQk8L3RyPgoJPC90Ym9keT4KPC90YWJsZT4='), 'decode' => true, 'required' => false)
);
$_['rb_colors'] = array(
	'default' => array('name' => 'Default', 'hex' => '#ef8c15'),
	'yellow'  => array('name' => 'Yellow', 'hex' => '#ffb200'),
	'blue'    => array('name' => 'Blue', 'hex' => '#2a78c7'),
	'green'   => array('name' => 'Green', 'hex' => '#6c9826'),
	'red'     => array('name' => 'Red', 'hex' => '#d7303f'),
	'grey'    => array('name' => 'Grey', 'hex' => '#888888')
);
$_['rb_ratings'] = array(1, 2, 3, 4, 5);
$_['rb_menu'] = array(
	array(
		'name'   => 'Reminders History',
		'action' => $_['rb_module_path'] . '/reminder'
	),
	array(
		'name'   => 'Coupons',
		'action' => $_['rb_module_path'] . '/coupon'
	),
	array(
		'name'   => '',
		'action' => ''
	),
	array(
		'name'   => 'Settings',
		'action' => $_['rb_module_path']
	)
);