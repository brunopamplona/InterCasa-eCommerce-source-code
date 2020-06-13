<?php
class ControllerModuleProductReviews extends Controller {
	const MODULE_VERSION = "v1.7";

	private $error = array();
	private $fields = array(
		'status' => array('default' => '0', 'decode' => false, 'required' => true),
		'notify_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'notify_email' => array('default' => '', 'decode' => false, 'required' => false),
		'notification' => array('default' => '', 'decode' => false, 'required' => false),
		'predefined_pros_cons_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'pros_status' => array('default' => '1', 'decode' => false, 'required' => true),
		'cons_status' => array('default' => '1', 'decode' => false, 'required' => true),
		'report_abuse_status' => array('default' => '1', 'decode' => false, 'required' => true),
		'helpfulness_status' => array('default' => '1', 'decode' => false, 'required' => true),
		'total_rating_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'autoapprove' => array('default' => '0', 'decode' => false, 'required' => true),
		'autoapprove_rating' => array('default' => '4', 'decode' => false, 'required' => true),
		'appearance_type' => array('default' => 'medium', 'decode' => false, 'required' => true),
		'appearance_customer_rating' => array('default' => 'default', 'decode' => false, 'required' => true),
		'report_abuse_guest' => array('default' => '0', 'decode' => false, 'required' => true),
		'rating_guest' => array('default' => '1', 'decode' => false, 'required' => true),
		'helpfulness_guest' => array('default' => '0', 'decode' => false, 'required' => true),
		'helpfulness_type' => array('default' => '2', 'decode' => false, 'required' => true),
		'sort_status' => array('default' => '1', 'decode' => false, 'required' => true),
		'image_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'image_limit' => array('default' => '1', 'decode' => false, 'required' => true),
		'image_thumb_width' => array('default' => '50', 'decode' => false, 'required' => true),
		'image_thumb_height' => array('default' => '50', 'decode' => false, 'required' => true),
		'image_popup_width' => array('default' => '500', 'decode' => false, 'required' => true),
		'image_popup_height' => array('default' => '500', 'decode' => false, 'required' => true),
		'colorbox_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'comment_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'comment_author' => array('default' => 'Administrator', 'decode' => false, 'required' => false),
		'comment_image_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'language_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'review_title_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'recommend_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'limit' => array('default' => '20', 'decode' => false, 'required' => true),
		'pros_cons_limit' => array('default' => '5', 'decode' => false, 'required' => true),
		'pros_cons_character_limit_from' => array('default' => '3', 'decode' => false, 'required' => true),
		'pros_cons_character_limit_to' => array('default' => '40', 'decode' => false, 'required' => true),
		'captcha' => array('default' => '0', 'decode' => false, 'required' => true),
		'seo_keyword' => array('default' => 'product-reviews', 'decode' => false, 'required' => false),
		'default_view' => array('default' => 'list', 'decode' => false, 'required' => true),
		'summary_status' => array('default' => '1', 'decode' => false, 'required' => true),
		'point_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'reward_point' => array('default' => '10', 'decode' => false, 'required' => false),
		'description_point' => array('default' => '', 'decode' => false, 'required' => false),
		'multistore_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'share_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'purchase_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'limit_product_status' => array('default' => '0', 'decode' => false, 'required' => true),
		'license_key' => array('default' => '', 'decode' => false, 'required' => false),
		'license' => array('default' => '', 'decode' => false, 'required' => false),
		'form_css' => array('default' => 'dGFibGUucHJvZHVjdF9yYXRpbmcgeyBkaXNwbGF5OiB0YWJsZTsgbWFyZ2luOiAwcHg7IHBhZGRpbmc6IDBweDsgfQ0KdGFibGUucHJvZHVjdF9yYXRpbmcgdHIgeyBtYXJnaW4tdG9wOiA0cHg7IH0NCnRhYmxlLnByb2R1Y3RfcmF0aW5nIHRyIHRkOmZpcnN0LWNoaWxkIHsgd2lkdGg6IDEwMHB4OyB3aGl0ZS1zcGFjZTogbm93cmFwOyBwYWRkaW5nLXJpZ2h0OiAxNXB4OyB9DQp0YWJsZS5wcm9zX2NvbnMgeyBkaXNwbGF5OiB0YWJsZTsgd2lkdGg6IDEwMCU7IG1hcmdpbjogMTBweCAwcHggMHB4IDBweDsgcGFkZGluZzogMHB4OyB9DQp0YWJsZS5wcm9zX2NvbnMgdHIgdGQgeyB2ZXJ0aWNhbC1hbGlnbjogdG9wOyB9DQp0YWJsZS5wcm9zX2NvbnMgdHIgdGQucHJvcyB7IGZvbnQtc2l6ZTogMTNweDsgY29sb3I6ICM2ZTliMjY7IGZvbnQtd2VpZ2h0OiA0MDA7IHRleHQtdHJhbnNmb3JtOiB1cHBlcmNhc2U7IH0NCnRhYmxlLnByb3NfY29ucyB0ciB0ZC5jb25zIHsgZm9udC1zaXplOiAxM3B4OyBjb2xvcjogI2U3MTIyNjsgZm9udC13ZWlnaHQ6IDQwMDsgdGV4dC10cmFuc2Zvcm06IHVwcGVyY2FzZTsgfQ0KdGFibGUucHJvc19jb25zIHRyIHRkIGlucHV0IHsgd2lkdGg6IDcwJTsgZGlzcGxheTogYmxvY2s7IH0NCnRhYmxlLnByb3NfY29ucyB0ciB0ZCBpbnB1dCtpbnB1dCB7IG1hcmdpbi10b3A6IDdweDsgfQ0KdGFibGUucHJvc19jb25zIHRyIHRkIC5wcmVkZWZpbmVkX3Byb3NfY29ucyB7IG1hcmdpbi1ib3R0b206IDNweDsgdmVydGljYWwtYWxpZ246IG1pZGRsZTsgfQ0KdGFibGUucHJvc19jb25zIHRyIHRkIC5wcmVkZWZpbmVkX3Byb3NfY29ucyBpbnB1dFt0eXBlPSZxdW90O2NoZWNrYm94JnF1b3Q7XSB7IG1hcmdpbjogMDsgZGlzcGxheTogaW5saW5lLWJsb2NrOyB3aWR0aDogYXV0bzsgdmVydGljYWwtYWxpZ246IG1pZGRsZTsgfQ0KZGl2I3Jldmlld19pbWFnZXMgLnJpbWFnZSB7IGJvcmRlcjogMXB4IHNvbGlkICNlZWU7IHBhZGRpbmc6IDJweDsgZGlzcGxheTogaW5saW5lLWJsb2NrOyBtYXJnaW46IDEwcHggMTBweCAwIDA7IHRleHQtYWxpZ246IGNlbnRlcjsgfQ==', 'decode' => true, 'required' => false),
		'list_css' => array('default' => 'LnByb2R1Y3RfcmV2aWV3X2xpc3QgeyBjbGVhcjogYm90aDsgb3ZlcmZsb3c6IGhpZGRlbjsgcGFkZGluZzogN3B4OyBib3JkZXI6IDFweCBzb2xpZCAjZWVlOyBtYXJnaW4tYm90dG9tOiAxNXB4OyB9DQoucHJvZHVjdF9yZXZpZXdfbGlzdCAubGVmdCB7IGZsb2F0OiBsZWZ0OyB3aWR0aDogNjUlOyB2ZXJ0aWNhbC1hbGlnbjogdG9wOyB9DQoucHJvZHVjdF9yZXZpZXdfbGlzdCAucmlnaHQgeyBmbG9hdDogcmlnaHQ7IHdpZHRoOiAzMyU7IHZlcnRpY2FsLWFsaWduOiB0b3A7IH0NCi5wcm9kdWN0X3Jldmlld19saXN0IC5yZXZpZXdfbGlzdF90aXRsZSB7IGZvbnQtc2l6ZTogMTVweDsgY29sb3I6ICMyYjJiMmI7IG1hcmdpbi1ib3R0b206IDNweDsgfQ0KLnByb2R1Y3RfcmV2aWV3X2xpc3QgLnJldmlld19saXN0X2F1dGhvciB7IGZvbnQtc2l6ZTogMTJweDsgY29sb3I6ICMyYjJiMmI7IG1hcmdpbi1ib3R0b206IDhweDsgfQ0KLnByb2R1Y3RfcmV2aWV3X2xpc3QgLnJldmlld19saXN0X3RleHQgeyBmb250LXNpemU6IDEycHg7IGNvbG9yOiAjMmIyYjJiOyBmb250LXdlaWdodDogbm9ybWFsOyBtYXJnaW4tYm90dG9tOiA3cHg7IH0=', 'decode' => true, 'required' => false),
		'pros_cons_list_css' => array('default' => 'LnByb2R1Y3RfZmVhdHVyZSB7IG1hcmdpbi10b3A6IDEycHg7IHdpZHRoOiAxMDAlOyB2ZXJ0aWNhbC1hbGlnbjogdG9wOyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7IH0NCi5wcm9kdWN0X2ZlYXR1cmUgaW1nIHsgdmVydGljYWwtYWxpZ246IG1pZGRsZTsgbWFyZ2luLXJpZ2h0OiAxNXB4OyAgfQ0KLnByb2R1Y3RfZmVhdHVyZSBkaXYgeyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7IHZlcnRpY2FsLWFsaWduOiB0b3A7IHdpZHRoOiA0OCU7IH0NCi5wcm9kdWN0X2ZlYXR1cmUgZGl2K2RpdiB7IG1hcmdpbi1sZWZ0OiAxMHB4OyB9DQoucHJvZHVjdF9mZWF0dXJlIGRpdiBiLnByb3MgeyBmb250LXNpemU6IDEzcHg7IGNvbG9yOiAjNmU5YjI2OyBmb250LXdlaWdodDogNDAwOyB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlOyBkaXNwbGF5OiAgaW5saW5lLWJsb2NrOyB9DQoucHJvZHVjdF9mZWF0dXJlIGRpdiBiLmNvbnMgeyBmb250LXNpemU6IDEzcHg7IGNvbG9yOiAjZTcxMjI2OyBmb250LXdlaWdodDogNDAwOyB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlOyBkaXNwbGF5OiAgaW5saW5lLWJsb2NrOyB9DQoucHJvZHVjdF9mZWF0dXJlIGRpdiB1bCB7IGxpc3Qtc3R5bGU6IG5vbmU7IHBhZGRpbmc6IDBweDsgbWFyZ2luOiA3cHggMHB4IDBweCA0MHB4OyB9DQoucHJvZHVjdF9mZWF0dXJlIGRpdiB1bCBsaSB7IHBhZGRpbmctdG9wOiAzcHg7IH0=', 'decode' => true, 'required' => false),
		'rating_css' => array('default' => 'LnByb2R1Y3RfcmF0aW5nX2xpc3QgeyBwYWRkaW5nOiAxMHB4OyBiYWNrZ3JvdW5kOiAjZjFmNWY4OyB9DQoucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCB7IGxpc3Qtc3R5bGU6IG5vbmU7IHBhZGRpbmc6IDBweDsgbWFyZ2luOiAwcHg7ICB9DQoucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCBsaSB7IHBhZGRpbmctdG9wOiAzcHg7IGNsZWFyOiBib3RoOyB9DQoucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCBsaSBpbWcgeyBmbG9hdDogcmlnaHQ7ICB9', 'decode' => true, 'required' => false),
		'helpfulness_css' => array('default' => 'LnByb2R1Y3RfcmV2aWV3X2hlbHBmdWxuZXNzIHsgYm9yZGVyLXRvcDogMXB4IHNvbGlkICNkZGQ7IHBvc2l0aW9uOiByZWxhdGl2ZTsgcGFkZGluZzogN3B4OyBtYXJnaW4tdG9wOiAxNXB4OyBmb250LXNpemU6IDEycHg7IGNvbG9yOiAjNzc3OyAgbGluZS1oZWlnaHQ6IDEuNjsgY2xlYXI6IGJvdGg7IH0NCi5wcm9kdWN0X3Jldmlld19oZWxwZnVsbmVzcyBidXR0b24geyBtYXJnaW46IDBweDsgcGFkZGluZzogMHB4IDRweDsgZm9udC1zaXplOiAxMnB4OyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7IGhlaWdodDogMS41ZW07IG1hcmdpbjogMCAuM2VtOyB2ZXJ0aWNhbC1hbGlnbjogbWlkZGxlOyBib3JkZXI6IDA7IGxpbmUtaGVpZ2h0OiAxLjU7IHRleHQtdHJhbnNmb3JtOiB1cHBlcmNhc2U7IGNvbG9yOiAjZmZmOyB9DQoucHJvZHVjdF9yZXZpZXdfaGVscGZ1bG5lc3MgYnV0dG9uLnZvdGVfeWVzIHsgYmFja2dyb3VuZDogIzZlOWIyNjsgfQ0KLnByb2R1Y3RfcmV2aWV3X2hlbHBmdWxuZXNzIGJ1dHRvbi52b3RlX25vIHsgYmFja2dyb3VuZDogI2U3MTIyNjsgfQ0KLnByb2R1Y3RfcmV2aWV3X2hlbHBmdWxuZXNzIGEgeyBwb3NpdGlvbjogYWJzb2x1dGU7IHRvcDogN3B4OyByaWdodDogN3B4OyB9', 'decode' => true, 'required' => false),
		'sort_css' => array('default' => 'LnByb2R1Y3RfcmV2aWV3X3NvcnQgeyBib3JkZXI6IG5vbmU7IG1hcmdpbi1ib3R0b206IDEwcHg7IGZvbnQtc2l6ZTogMTJweDsgY29sb3I6ICMzMzM7ICBsaW5lLWhlaWdodDogMS42OyB0ZXh0LWFsaWduOiByaWdodDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3NvcnQgYiB7IGZvbnQtd2VpZ2h0OiA3MDA7IH0=', 'decode' => true, 'required' => false),
		'total_rating_css' => array('default' => 'LnByb2R1Y3RfcmV2aWV3X3RvdGFsX3JhdGluZyB7IGJhY2tncm91bmQ6ICNkYmU4ZjE7IGZvbnQtd2VpZ2h0OiA3MDA7IG1hcmdpbi10b3A6IDVweDsgcGFkZGluZzogM3B4OyB9DQoucHJvZHVjdF9yZXZpZXdfdG90YWxfcmF0aW5nIGltZyB7IGJvcmRlcjogbm9uZTsgfQ==', 'decode' => true, 'required' => false),
		'image_css' => array('default' => 'LnByb2R1Y3RfcmV2aWV3X2ltYWdlX3BvcHVwIHsgYmFja2dyb3VuZDogI2ZmZjsgZGlzcGxheTogaW5saW5lLWJsb2NrOyBtYXJnaW4tdG9wOiAzcHg7IG1hcmdpbi1yaWdodDogNHB4OyB9DQoucHJvZHVjdF9yZXZpZXdfaW1hZ2VfcG9wdXAgaW1nIHsgcGFkZGluZzogM3B4OyBib3JkZXI6IDFweCBzb2xpZCAjRTdFN0U3OyB9', 'decode' => true, 'required' => false),
		'comment_css' => array('default' => 'LnByb2R1Y3RfcmV2aWV3X2NvbW1lbnQgeyBib3JkZXI6IDFweCBzb2xpZCAjZGRkOyBiYWNrZ3JvdW5kOiAjZWVlOyBwYWRkaW5nOiA1cHg7IG1hcmdpbjogNnB4IDAgMCAwcHg7ICBmb250LXNpemU6IDEycHg7IGNvbG9yOiAjYTNhM2EzOyB9DQoucHJvZHVjdF9yZXZpZXdfY29tbWVudCAuY29tbWVudF9hdXRob3IgeyBtYXJnaW4tYm90dG9tOiA0cHg7IH0NCi5wcm9kdWN0X3Jldmlld19jb21tZW50IC5jb21tZW50X3RleHQgeyBmb250LXdlaWdodDogbm9ybWFsOyB9', 'decode' => true, 'required' => false),
		'summary_css' => array('default' => 'LnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgeyB3aWR0aDogMTAwJTsgZm9udC1zaXplOiAxMnB4OyBiYWNrZ3JvdW5kOiAjZTlmNGQxOyBtYXJnaW4tYm90dG9tOiAyMHB4OyBwYWRkaW5nLWJvdHRvbTogMTBweDsgYm9yZGVyLWJvdHRvbTogM3B4IHNvbGlkICNkNGU5YTM7IH0NCi5wcm9kdWN0X3Jldmlld19zdW1tYXJ5IC5wcm9kdWN0X25hbWUgeyBtYXJnaW46IDBweCAwcHggNXB4IDBweDsgcGFkZGluZzogMTBweDsgZm9udC1zaXplOiAxNHB4OyBjb2xvcjogIzI5N2EyYzsgYmFja2dyb3VuZC1jb2xvcjogI2Q0ZTlhMzsgZm9udC13ZWlnaHQ6IDYwMDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgLmxlZnQgeyBmbG9hdDogbGVmdDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgLmxlZnQgLmdlbmVyYWxfYXZhcmFnZSB7IGZvbnQtc2l6ZTogMTZweDsgZm9udC13ZWlnaHQ6IDYwMDsgY29sb3I6ICMzMzMzMzM7IHBhZGRpbmc6IDEwcHggMCA3cHggMTBweDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgLmxlZnQgLmdlbmVyYWxfYXZhcmFnZSBpbWcgeyB2ZXJ0aWNhbC1hbGlnbjogYmFzZWxpbmU7IH0NCi5wcm9kdWN0X3Jldmlld19zdW1tYXJ5IC5sZWZ0IC5jb3VudF9yZWNvbW1lbmRfcHJvZHVjdCB7IHBhZGRpbmc6IDEwcHggMHB4IDAgMTBweDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgLmxlZnQgLmNvdW50X21hcmsgeyBwYWRkaW5nOiAxMHB4OyB9DQoucHJvZHVjdF9yZXZpZXdfc3VtbWFyeSAucmlnaHQgeyBmbG9hdDogcmlnaHQ7IH0NCi5wcm9kdWN0X3Jldmlld19zdW1tYXJ5IC5yaWdodCAucHJvZHVjdF9yYXRpbmdfbGlzdCB7IG1hcmdpbjogMHB4OyBwYWRkaW5nOiAyMHB4IDEwcHggMHB4IDBweDsgYmFja2dyb3VuZDogdHJhbnNwYXJlbnQ7IH0NCi5wcm9kdWN0X3Jldmlld19zdW1tYXJ5IC5yaWdodCAucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCB7IGxpc3Qtc3R5bGU6IG5vbmU7IHBhZGRpbmc6IDBweDsgbWFyZ2luOiAwcHg7ICB9DQoucHJvZHVjdF9yZXZpZXdfc3VtbWFyeSAucmlnaHQgLnByb2R1Y3RfcmF0aW5nX2xpc3QgdWwgbGkgeyBwYWRkaW5nLXRvcDogM3B4OyBjbGVhcjogYm90aDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgLnJpZ2h0IC5wcm9kdWN0X3JhdGluZ19saXN0IHVsIGxpIGltZyB7IGZsb2F0OiByaWdodDsgbWFyZ2luLWxlZnQ6IDQ1cHg7IH0NCi5wcm9kdWN0X3Jldmlld19zdW1tYXJ5IC5idXR0b24geyBjdXJzb3I6IHBvaW50ZXI7IG1hcmdpbi1sZWZ0OiAxMHB4OyB9', 'decode' => true, 'required' => false),
		'page_list_css' => array('default' => 'LmFsbF9yZXZpZXcgJmd0OyBkaXYgIHsgY2xlYXI6IGJvdGg7IG92ZXJmbG93OiBoaWRkZW47IHBhZGRpbmc6IDdweDsgYm9yZGVyOiAxcHggc29saWQgI2VlZTsgbWFyZ2luLWJvdHRvbTogMTVweDsgfQ0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLmxlZnQgeyBmbG9hdDogbGVmdDsgd2lkdGg6IDY0JTsgdmVydGljYWwtYWxpZ246IHRvcDsgfQ0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnJpZ2h0IHsgZmxvYXQ6IHJpZ2h0OyB3aWR0aDogMzMlOyB2ZXJ0aWNhbC1hbGlnbjogdG9wOyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucmV2aWV3X2xpc3RfdGl0bGUgeyBmb250LXNpemU6IDE1cHg7IGNvbG9yOiAjMmIyYjJiOyBtYXJnaW4tYm90dG9tOiAzcHg7IH0NCi5hbGxfcmV2aWV3ICZndDsgZGl2IC5yZXZpZXdfbGlzdF9hdXRob3IgeyBmb250LXNpemU6IDEycHg7IGNvbG9yOiAjMmIyYjJiOyBtYXJnaW4tYm90dG9tOiA4cHg7IH0NCi5hbGxfcmV2aWV3ICZndDsgZGl2IC5yZXZpZXdfbGlzdF9hdXRob3Igc3BhbiB7IGZvbnQtc2l6ZTogMTNweDsgY29sb3I6ICM2NjY7IGZvbnQtd2VpZ2h0OiA3MDA7ICB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucmV2aWV3X2xpc3RfYXV0aG9yIHNwYW4gYSB7IGZvbnQtd2VpZ2h0OiAgbm9ybWFsOyB0ZXh0LWRlY29yYXRpb246IG5vbmU7IGxpbmUtaGVpZ2h0OiAxNHB4OyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucmV2aWV3X2xpc3RfdGV4dCB7IGZvbnQtc2l6ZTogMTJweDsgbGluZS1oZWlnaHQ6IDE0cHg7IGNvbG9yOiAjMmIyYjJiOyBmb250LXdlaWdodDogbm9ybWFsOyBtYXJnaW4tYm90dG9tOiA3cHg7IH0NCg0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfZmVhdHVyZSB7IG1hcmdpbi10b3A6IDEycHg7IHdpZHRoOiAxMDAlOyB2ZXJ0aWNhbC1hbGlnbjogdG9wOyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7IH0NCi5hbGxfcmV2aWV3ICZndDsgZGl2IC5wcm9kdWN0X2ZlYXR1cmUgaW1nIHsgdmVydGljYWwtYWxpZ246IG1pZGRsZTsgbWFyZ2luLXJpZ2h0OiAxNXB4OyAgfQ0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfZmVhdHVyZSBkaXYgeyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7IHZlcnRpY2FsLWFsaWduOiB0b3A7IHdpZHRoOiA0OCU7IH0NCi5hbGxfcmV2aWV3ICZndDsgZGl2IC5wcm9kdWN0X2ZlYXR1cmUgZGl2K2RpdiB7IG1hcmdpbi1sZWZ0OiAxMHB4OyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9mZWF0dXJlIGRpdiBiLnByb3MgeyBmb250LXNpemU6IDEzcHg7IGNvbG9yOiAjNmU5YjI2OyBmb250LXdlaWdodDogNDAwOyB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlOyBkaXNwbGF5OiAgaW5saW5lLWJsb2NrOyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9mZWF0dXJlIGRpdiBiLmNvbnMgeyBmb250LXNpemU6IDEzcHg7IGNvbG9yOiAjZTcxMjI2OyBmb250LXdlaWdodDogNDAwOyB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlOyBkaXNwbGF5OiAgaW5saW5lLWJsb2NrOyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9mZWF0dXJlIGRpdiB1bCB7IGxpc3Qtc3R5bGU6IG5vbmU7IHBhZGRpbmc6IDBweDsgbWFyZ2luOiA3cHggMHB4IDBweCA0MHB4OyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9mZWF0dXJlIGRpdiB1bCBsaSB7IHBhZGRpbmctdG9wOiAzcHg7IH0NCg0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfcmF0aW5nX2xpc3QgeyBwYWRkaW5nOiAxMHB4OyBiYWNrZ3JvdW5kOiAjZjFmNWY4OyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCB7IGxpc3Qtc3R5bGU6IG5vbmU7IHBhZGRpbmc6IDBweDsgbWFyZ2luOiAwcHg7ICB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCBsaSB7IHBhZGRpbmctdG9wOiAzcHg7IGNsZWFyOiBib3RoOyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCBsaSBpbWcgeyBmbG9hdDogcmlnaHQ7ICB9DQoNCi5hbGxfcmV2aWV3ICZndDsgZGl2IC5wcm9kdWN0X3Jldmlld190b3RhbF9yYXRpbmcgeyBiYWNrZ3JvdW5kOiAjZGJlOGYxOyBmb250LXdlaWdodDogNzAwOyBtYXJnaW4tdG9wOiA1cHg7IHBhZGRpbmc6IDNweDsgfQ0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfcmV2aWV3X3RvdGFsX3JhdGluZyBpbWcgeyBib3JkZXI6IG5vbmU7IH0NCg0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfcmV2aWV3X2ltYWdlX3BvcHVwIHsgYmFja2dyb3VuZDogI2ZmZjsgfQ0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfcmV2aWV3X2ltYWdlX3BvcHVwIGltZyB7IHBhZGRpbmc6IDNweDsgYm9yZGVyOiAxcHggc29saWQgI0U3RTdFNzsgbWFyZ2luLXJpZ2h0OiA0cHg7IH0NCg0KLmFsbF9yZXZpZXcgLnByb2R1Y3RfcmV2aWV3X3NvY2lhbCB7IG1hcmdpbi10b3A6IDhweDsgZmxvYXQ6IHJpZ2h0OyB9DQouYWxsX3JldmlldyAucHJvZHVjdF9yZXZpZXdfc29jaWFsOmFmdGVyIHsgY29udGVudDomcXVvdDsmcXVvdDs7IGNsZWFyOiBib3RoOyBoZWlnaHQ6IDFweDsgfQ==', 'decode' => true, 'required' => false),
		'box_css' => array('default' => 'LnJldmlld19ib3ggeyBtYXJnaW4tYm90dG9tOiAxMHB4OyBib3JkZXI6IDFweCBzb2xpZCAjZGRkOyAgcGFkZGluZzogN3B4OyB9DQoucmV2aWV3X2JveCAuYm94LWhlYWRpbmcgeyBmb250LXNpemU6IDE2cHg7IGZvbnQtd2VpZ2h0OiA2MDA7IGNvbG9yOiAjMzMzOyAgbWFyZ2luLWJvdHRvbTogMjBweDsgIH0NCi5yZXZpZXdfYm94IC5ib3gtcHJvZHVjdCAmZ3Q7IGRpdiB7IG1hcmdpbi1ib3R0b206IDE1cHg7IH0NCi5yZXZpZXdfYm94IC5ib3gtcHJvZHVjdCAmZ3Q7IGRpdjpsYXN0LWNoaWxkIHsgbWFyZ2luLWJvdHRvbTogMHB4OyB9DQoucmV2aWV3X2JveCAucmV2aWV3X3RleHQgeyBib3JkZXItbGVmdDogNXB4IHNvbGlkICNlMWUxZTE7IHBhZGRpbmctbGVmdDogNXB4OyBtYXJnaW4tYm90dG9tOiA0cHg7IGZvbnQtc3R5bGU6IGl0YWxpYzsgfQ0KLnJldmlld19ib3ggLnJldmlld19hdXRob3IgeyBmb250LXNpemU6IDk5JTsgY29sb3I6ICMyMjI7IG1hcmdpbjogMnB4IDBweCAzcHggMHB4OyB9DQoucmV2aWV3X2JveCAucmV2aWV3X2RhdGUgeyBmb250LXNpemU6IDExcHg7IGNvbG9yOiAjNTU1OyB3aGl0ZS1zcGFjZTogbm93cmFwOyB9DQoucmV2aWV3X2JveCAucmV2aWV3X3JhdGluZyB7IGRpc3BsYXk6IGJsb2NrOyB9DQoucmV2aWV3X2JveCAuYnV0dG9uIHsgZGlzcGxheTogaW5saW5lLWJsb2NrOyBtYXJnaW4tdG9wOiAxNXB4OyB9', 'decode' => true, 'required' => false),
		'share_css' => array('default' => 'LnByb2R1Y3RfcmV2aWV3X3NvY2lhbCB7IG1hcmdpbi10b3A6IDhweDsgZmxvYXQ6IHJpZ2h0OyB9DQoucHJvZHVjdF9yZXZpZXdfc29jaWFsOmFmdGVyIHsgY29udGVudDoiIjsgY2xlYXI6IGJvdGg7IGhlaWdodDogMXB4OyB9', 'decode' => true, 'required' => true)
	);

	public function index() {
		$data = array_merge(array(), $this->language->load('module/product_reviews'));

		if (version_compare(VERSION, '2.0') < 0) {
			$this->document->addStyle('view/javascript/AdvancedProductReviews/font-awesome/css/font-awesome.min.css');
			$this->document->addScript('view/javascript/AdvancedProductReviews/bootstrap/js/bootstrap.min.js');
			$this->document->addScript('view/javascript/AdvancedProductReviews/compatibility.js');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/bootstrap/css/bootstrap.css');
			$this->document->addStyle('view/javascript/AdvancedProductReviews/compatibility.css');
		}

		$this->document->addStyle('view/javascript/AdvancedProductReviews/module.css');

		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title'] = $this->language->get('heading_title') . ' ' . self::MODULE_VERSION;

		if (isset($this->request->get['filter_store_id'])) {
			$filter_store_id = (int)$this->request->get['filter_store_id'];
		} else {
			$filter_store_id = 0;
		}

		$url = '&filter_store_id=' . (int)$filter_store_id;
		
		$this->load->model('catalog/product_review');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_catalog_product_review->editSetting('product_reviews', $this->request->post['product_reviews'], $filter_store_id);

			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirectTo('module/product_reviews', $url);
		}

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

  		$data['breadcrumbs'] = array();

		$data['action'] = $this->url->link('module/product_reviews', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (version_compare(VERSION, '2.3') < 0) {
			$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');
		}

		$config_store = $this->model_catalog_product_review->getSetting('product_reviews', $filter_store_id);

		foreach ($this->fields as $key => $value) {
			if (isset($this->request->post['product_reviews'][$key])) {
				$data[$key] = $this->request->post['product_reviews'][$key];
			} elseif (isset($config_store[$key])) {
				if (preg_match('#_css$#', $key)) {
				//file_put_contents(DIR_DOWNLOAD.''.$key.'.txt', base64_encode($config_store[$key]));
				}
				$data[$key] = $config_store[$key];
			} else {
				if ($value['decode']) {
					$value['default'] = base64_decode($value['default']);
				}

				$data[$key] = $value['default'];
			}
		}

		$data['appearance'] = array('small', 'medium' , 'big');

		$data['appearance_customer'] = array();

		$stars = glob(DIR_IMAGE . 'product_review/stars-*');

		$base = defined('HTTPS_CATALOG') ? HTTPS_CATALOG : HTTP_CATALOG;

		foreach ($stars as $star) {
			preg_match("/\/stars-(.*)-(\d+)\.png$/i", $star, $name);

			if (isset($name[1]) && $name[sizeof($name) - 1] == '5') {
				$data['appearance_customer'][] = array($base . 'image/product_review' . $name[0], $name[sizeof($name) - 2]);
			}
		}

		$data['helpfulness_percentage'] = 'view/javascript/AdvancedProductReviews/image/percentage.jpg';
		$data['helpfulness_numerically'] = 'view/javascript/AdvancedProductReviews/image/numerically.jpg';

		$data['product_ratings'] = range(1, 5);

		$data['stores'] = $this->getStores();

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['filter_store_id'] = $filter_store_id;

		if (version_compare(VERSION, '2.0') < 0) {
			$data['column_left'] = '';
			$this->data = $data;

			$this->template = 'module/product_reviews.tpl';

			$this->children = array(
				'common/header',
				'common/footer',
			);

			$this->response->setOutput($this->render());
		} else {
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('module/product_reviews.tpl', $data));
		}
	}

	private function getStores() {
		$this->language->load('module/product_reviews');

		$stores = array();

		$stores[0] = array('store_id' => '0', 'href' => $this->url->link('module/product_reviews', 'token=' . $this->session->data['token'] . '&filter_store_id=0', 'SSL'), 'name' => $this->language->get('text_store') . ' ' . strip_tags($this->language->get('text_default')));

		$this->load->model('setting/store');

		$results = $this->model_setting_store->getStores();

		foreach ($results as $store) {
			$stores[$store['store_id']] = array(
				'store_id' => $store['store_id'],
				'href'     => $this->url->link('module/product_reviews', 'token=' . $this->session->data['token'] . '&filter_store_id=' . (int)$store['store_id'], 'SSL'),
				'name'     => $this->language->get('text_store') . ' ' . $store['name']
			);
		}

		return (array)$stores;
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/product_reviews')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ($this->request->post['product_reviews']) {
			foreach ($this->fields as $key => $value) {
				if ($value['required'] && (!isset($this->request->post['product_reviews'][$key]) || $this->request->post['product_reviews'][$key] === null)) {
					$this->error['warning'] = $this->language->get('error_required');

					break;
				}

				if ($key == 'seo_keyword' && $this->request->post['product_reviews'][$key]) {
					if ($this->model_catalog_product_review->getUrlAlias($this->request->post['product_reviews'][$key])) {
						$this->error['warning'] = $this->language->get('error_keyword');

						break;
					}
				}
			}
		} else {
			$this->error['warning'] = $this->language->get('error_module');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}

	private function redirectTo($route, $params = '') {
		if (!$route) {
			$route = 'common/home';
		}

		if (version_compare(VERSION, '2.0') < 0) {
			$this->redirect($this->url->link($route, 'token=' . $this->session->data['token'] . $params, 'SSL'));
		} else {
			$this->response->redirect($this->url->link($route, 'token=' . $this->session->data['token'] . $params, 'SSL'));
		}
	}
}
?>