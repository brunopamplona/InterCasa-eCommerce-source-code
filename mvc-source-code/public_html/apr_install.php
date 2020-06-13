<?php
include"config.php";

echo'<h3>Installing Advanced Product Reviews</h3>';

$new_css = array();

$new_css['form_css'] = 'dGFibGUucHJvZHVjdF9yYXRpbmcgeyBkaXNwbGF5OiB0YWJsZTsgbWFyZ2luOiAwcHg7IHBhZGRpbmc6IDBweDsgfQ0KdGFibGUucHJvZHVjdF9yYXRpbmcgdHIgeyBtYXJnaW4tdG9wOiA0cHg7IH0NCnRhYmxlLnByb2R1Y3RfcmF0aW5nIHRyIHRkOmZpcnN0LWNoaWxkIHsgd2lkdGg6IDEwMHB4OyB3aGl0ZS1zcGFjZTogbm93cmFwOyBwYWRkaW5nLXJpZ2h0OiAxNXB4OyB9DQp0YWJsZS5wcm9zX2NvbnMgeyBkaXNwbGF5OiB0YWJsZTsgd2lkdGg6IDEwMCU7IG1hcmdpbjogMTBweCAwcHggMHB4IDBweDsgcGFkZGluZzogMHB4OyB9DQp0YWJsZS5wcm9zX2NvbnMgdHIgdGQgeyB2ZXJ0aWNhbC1hbGlnbjogdG9wOyB9DQp0YWJsZS5wcm9zX2NvbnMgdHIgdGQucHJvcyB7IGZvbnQtc2l6ZTogMTNweDsgY29sb3I6ICM2ZTliMjY7IGZvbnQtd2VpZ2h0OiA0MDA7IHRleHQtdHJhbnNmb3JtOiB1cHBlcmNhc2U7IH0NCnRhYmxlLnByb3NfY29ucyB0ciB0ZC5jb25zIHsgZm9udC1zaXplOiAxM3B4OyBjb2xvcjogI2U3MTIyNjsgZm9udC13ZWlnaHQ6IDQwMDsgdGV4dC10cmFuc2Zvcm06IHVwcGVyY2FzZTsgfQ0KdGFibGUucHJvc19jb25zIHRyIHRkIGlucHV0IHsgd2lkdGg6IDcwJTsgZGlzcGxheTogYmxvY2s7IH0NCnRhYmxlLnByb3NfY29ucyB0ciB0ZCBpbnB1dCtpbnB1dCB7IG1hcmdpbi10b3A6IDdweDsgfQ0KdGFibGUucHJvc19jb25zIHRyIHRkIC5wcmVkZWZpbmVkX3Byb3NfY29ucyB7IG1hcmdpbi1ib3R0b206IDNweDsgdmVydGljYWwtYWxpZ246IG1pZGRsZTsgfQ0KdGFibGUucHJvc19jb25zIHRyIHRkIC5wcmVkZWZpbmVkX3Byb3NfY29ucyBpbnB1dFt0eXBlPSZxdW90O2NoZWNrYm94JnF1b3Q7XSB7IG1hcmdpbjogMDsgZGlzcGxheTogaW5saW5lLWJsb2NrOyB3aWR0aDogYXV0bzsgdmVydGljYWwtYWxpZ246IG1pZGRsZTsgfQ0KZGl2I3Jldmlld19pbWFnZXMgLnJpbWFnZSB7IGJvcmRlcjogMXB4IHNvbGlkICNlZWU7IHBhZGRpbmc6IDJweDsgZGlzcGxheTogaW5saW5lLWJsb2NrOyBtYXJnaW46IDEwcHggMTBweCAwIDA7IHRleHQtYWxpZ246IGNlbnRlcjsgfQ==';
$new_css['list_css'] = 'LnByb2R1Y3RfcmV2aWV3X2xpc3QgeyBjbGVhcjogYm90aDsgb3ZlcmZsb3c6IGhpZGRlbjsgcGFkZGluZzogN3B4OyBib3JkZXI6IDFweCBzb2xpZCAjZWVlOyBtYXJnaW4tYm90dG9tOiAxNXB4OyB9DQoucHJvZHVjdF9yZXZpZXdfbGlzdCAubGVmdCB7IGZsb2F0OiBsZWZ0OyB3aWR0aDogNjUlOyB2ZXJ0aWNhbC1hbGlnbjogdG9wOyB9DQoucHJvZHVjdF9yZXZpZXdfbGlzdCAucmlnaHQgeyBmbG9hdDogcmlnaHQ7IHdpZHRoOiAzMyU7IHZlcnRpY2FsLWFsaWduOiB0b3A7IH0NCi5wcm9kdWN0X3Jldmlld19saXN0IC5yZXZpZXdfbGlzdF90aXRsZSB7IGZvbnQtc2l6ZTogMTVweDsgY29sb3I6ICMyYjJiMmI7IG1hcmdpbi1ib3R0b206IDNweDsgfQ0KLnByb2R1Y3RfcmV2aWV3X2xpc3QgLnJldmlld19saXN0X2F1dGhvciB7IGZvbnQtc2l6ZTogMTJweDsgY29sb3I6ICMyYjJiMmI7IG1hcmdpbi1ib3R0b206IDhweDsgfQ0KLnByb2R1Y3RfcmV2aWV3X2xpc3QgLnJldmlld19saXN0X3RleHQgeyBmb250LXNpemU6IDEycHg7IGNvbG9yOiAjMmIyYjJiOyBmb250LXdlaWdodDogbm9ybWFsOyBtYXJnaW4tYm90dG9tOiA3cHg7IH0=';
$new_css['pros_cons_list_css'] = 'LnByb2R1Y3RfZmVhdHVyZSB7IG1hcmdpbi10b3A6IDEycHg7IHdpZHRoOiAxMDAlOyB2ZXJ0aWNhbC1hbGlnbjogdG9wOyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7IH0NCi5wcm9kdWN0X2ZlYXR1cmUgaW1nIHsgdmVydGljYWwtYWxpZ246IG1pZGRsZTsgbWFyZ2luLXJpZ2h0OiAxNXB4OyAgfQ0KLnByb2R1Y3RfZmVhdHVyZSBkaXYgeyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7IHZlcnRpY2FsLWFsaWduOiB0b3A7IHdpZHRoOiA0OCU7IH0NCi5wcm9kdWN0X2ZlYXR1cmUgZGl2K2RpdiB7IG1hcmdpbi1sZWZ0OiAxMHB4OyB9DQoucHJvZHVjdF9mZWF0dXJlIGRpdiBiLnByb3MgeyBmb250LXNpemU6IDEzcHg7IGNvbG9yOiAjNmU5YjI2OyBmb250LXdlaWdodDogNDAwOyB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlOyBkaXNwbGF5OiAgaW5saW5lLWJsb2NrOyB9DQoucHJvZHVjdF9mZWF0dXJlIGRpdiBiLmNvbnMgeyBmb250LXNpemU6IDEzcHg7IGNvbG9yOiAjZTcxMjI2OyBmb250LXdlaWdodDogNDAwOyB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlOyBkaXNwbGF5OiAgaW5saW5lLWJsb2NrOyB9DQoucHJvZHVjdF9mZWF0dXJlIGRpdiB1bCB7IGxpc3Qtc3R5bGU6IG5vbmU7IHBhZGRpbmc6IDBweDsgbWFyZ2luOiA3cHggMHB4IDBweCA0MHB4OyB9DQoucHJvZHVjdF9mZWF0dXJlIGRpdiB1bCBsaSB7IHBhZGRpbmctdG9wOiAzcHg7IH0=';
$new_css['rating_css'] = 'LnByb2R1Y3RfcmF0aW5nX2xpc3QgeyBwYWRkaW5nOiAxMHB4OyBiYWNrZ3JvdW5kOiAjZjFmNWY4OyB9DQoucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCB7IGxpc3Qtc3R5bGU6IG5vbmU7IHBhZGRpbmc6IDBweDsgbWFyZ2luOiAwcHg7ICB9DQoucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCBsaSB7IHBhZGRpbmctdG9wOiAzcHg7IGNsZWFyOiBib3RoOyB9DQoucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCBsaSBpbWcgeyBmbG9hdDogcmlnaHQ7ICB9';
$new_css['helpfulness_css'] = 'LnByb2R1Y3RfcmV2aWV3X2hlbHBmdWxuZXNzIHsgYm9yZGVyLXRvcDogMXB4IHNvbGlkICNkZGQ7IHBvc2l0aW9uOiByZWxhdGl2ZTsgcGFkZGluZzogN3B4OyBtYXJnaW4tdG9wOiAxNXB4OyBmb250LXNpemU6IDEycHg7IGNvbG9yOiAjNzc3OyAgbGluZS1oZWlnaHQ6IDEuNjsgY2xlYXI6IGJvdGg7IH0NCi5wcm9kdWN0X3Jldmlld19oZWxwZnVsbmVzcyBidXR0b24geyBtYXJnaW46IDBweDsgcGFkZGluZzogMHB4IDRweDsgZm9udC1zaXplOiAxMnB4OyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7IGhlaWdodDogMS41ZW07IG1hcmdpbjogMCAuM2VtOyB2ZXJ0aWNhbC1hbGlnbjogbWlkZGxlOyBib3JkZXI6IDA7IGxpbmUtaGVpZ2h0OiAxLjU7IHRleHQtdHJhbnNmb3JtOiB1cHBlcmNhc2U7IGNvbG9yOiAjZmZmOyB9DQoucHJvZHVjdF9yZXZpZXdfaGVscGZ1bG5lc3MgYnV0dG9uLnZvdGVfeWVzIHsgYmFja2dyb3VuZDogIzZlOWIyNjsgfQ0KLnByb2R1Y3RfcmV2aWV3X2hlbHBmdWxuZXNzIGJ1dHRvbi52b3RlX25vIHsgYmFja2dyb3VuZDogI2U3MTIyNjsgfQ0KLnByb2R1Y3RfcmV2aWV3X2hlbHBmdWxuZXNzIGEgeyBwb3NpdGlvbjogYWJzb2x1dGU7IHRvcDogN3B4OyByaWdodDogN3B4OyB9';
$new_css['sort_css'] = 'LnByb2R1Y3RfcmV2aWV3X3NvcnQgeyBib3JkZXI6IG5vbmU7IG1hcmdpbi1ib3R0b206IDEwcHg7IGZvbnQtc2l6ZTogMTJweDsgY29sb3I6ICMzMzM7ICBsaW5lLWhlaWdodDogMS42OyB0ZXh0LWFsaWduOiByaWdodDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3NvcnQgYiB7IGZvbnQtd2VpZ2h0OiA3MDA7IH0=';
$new_css['total_rating_css'] = 'LnByb2R1Y3RfcmV2aWV3X3RvdGFsX3JhdGluZyB7IGJhY2tncm91bmQ6ICNkYmU4ZjE7IGZvbnQtd2VpZ2h0OiA3MDA7IG1hcmdpbi10b3A6IDVweDsgcGFkZGluZzogM3B4OyB9DQoucHJvZHVjdF9yZXZpZXdfdG90YWxfcmF0aW5nIGltZyB7IGJvcmRlcjogbm9uZTsgfQ==';
$new_css['image_css'] = 'LnByb2R1Y3RfcmV2aWV3X2ltYWdlX3BvcHVwIHsgYmFja2dyb3VuZDogI2ZmZjsgZGlzcGxheTogaW5saW5lLWJsb2NrOyBtYXJnaW4tdG9wOiAzcHg7IG1hcmdpbi1yaWdodDogNHB4OyB9DQoucHJvZHVjdF9yZXZpZXdfaW1hZ2VfcG9wdXAgaW1nIHsgcGFkZGluZzogM3B4OyBib3JkZXI6IDFweCBzb2xpZCAjRTdFN0U3OyB9';
$new_css['comment_css'] = 'LnByb2R1Y3RfcmV2aWV3X2NvbW1lbnQgeyBib3JkZXI6IDFweCBzb2xpZCAjZGRkOyBiYWNrZ3JvdW5kOiAjZWVlOyBwYWRkaW5nOiA1cHg7IG1hcmdpbjogNnB4IDAgMCAwcHg7ICBmb250LXNpemU6IDEycHg7IGNvbG9yOiAjYTNhM2EzOyB9DQoucHJvZHVjdF9yZXZpZXdfY29tbWVudCAuY29tbWVudF9hdXRob3IgeyBtYXJnaW4tYm90dG9tOiA0cHg7IH0NCi5wcm9kdWN0X3Jldmlld19jb21tZW50IC5jb21tZW50X3RleHQgeyBmb250LXdlaWdodDogbm9ybWFsOyB9';
$new_css['summary_css'] = 'LnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgeyB3aWR0aDogMTAwJTsgZm9udC1zaXplOiAxMnB4OyBiYWNrZ3JvdW5kOiAjZTlmNGQxOyBtYXJnaW4tYm90dG9tOiAyMHB4OyBwYWRkaW5nLWJvdHRvbTogMTBweDsgYm9yZGVyLWJvdHRvbTogM3B4IHNvbGlkICNkNGU5YTM7IH0NCi5wcm9kdWN0X3Jldmlld19zdW1tYXJ5IC5wcm9kdWN0X25hbWUgeyBtYXJnaW46IDBweCAwcHggNXB4IDBweDsgcGFkZGluZzogMTBweDsgZm9udC1zaXplOiAxNHB4OyBjb2xvcjogIzI5N2EyYzsgYmFja2dyb3VuZC1jb2xvcjogI2Q0ZTlhMzsgZm9udC13ZWlnaHQ6IDYwMDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgLmxlZnQgeyBmbG9hdDogbGVmdDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgLmxlZnQgLmdlbmVyYWxfYXZhcmFnZSB7IGZvbnQtc2l6ZTogMTZweDsgZm9udC13ZWlnaHQ6IDYwMDsgY29sb3I6ICMzMzMzMzM7IHBhZGRpbmc6IDEwcHggMCA3cHggMTBweDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgLmxlZnQgLmdlbmVyYWxfYXZhcmFnZSBpbWcgeyB2ZXJ0aWNhbC1hbGlnbjogYmFzZWxpbmU7IH0NCi5wcm9kdWN0X3Jldmlld19zdW1tYXJ5IC5sZWZ0IC5jb3VudF9yZWNvbW1lbmRfcHJvZHVjdCB7IHBhZGRpbmc6IDEwcHggMHB4IDAgMTBweDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgLmxlZnQgLmNvdW50X21hcmsgeyBwYWRkaW5nOiAxMHB4OyB9DQoucHJvZHVjdF9yZXZpZXdfc3VtbWFyeSAucmlnaHQgeyBmbG9hdDogcmlnaHQ7IH0NCi5wcm9kdWN0X3Jldmlld19zdW1tYXJ5IC5yaWdodCAucHJvZHVjdF9yYXRpbmdfbGlzdCB7IG1hcmdpbjogMHB4OyBwYWRkaW5nOiAyMHB4IDEwcHggMHB4IDBweDsgYmFja2dyb3VuZDogdHJhbnNwYXJlbnQ7IH0NCi5wcm9kdWN0X3Jldmlld19zdW1tYXJ5IC5yaWdodCAucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCB7IGxpc3Qtc3R5bGU6IG5vbmU7IHBhZGRpbmc6IDBweDsgbWFyZ2luOiAwcHg7ICB9DQoucHJvZHVjdF9yZXZpZXdfc3VtbWFyeSAucmlnaHQgLnByb2R1Y3RfcmF0aW5nX2xpc3QgdWwgbGkgeyBwYWRkaW5nLXRvcDogM3B4OyBjbGVhcjogYm90aDsgfQ0KLnByb2R1Y3RfcmV2aWV3X3N1bW1hcnkgLnJpZ2h0IC5wcm9kdWN0X3JhdGluZ19saXN0IHVsIGxpIGltZyB7IGZsb2F0OiByaWdodDsgbWFyZ2luLWxlZnQ6IDQ1cHg7IH0NCi5wcm9kdWN0X3Jldmlld19zdW1tYXJ5IC5idXR0b24geyBjdXJzb3I6IHBvaW50ZXI7IG1hcmdpbi1sZWZ0OiAxMHB4OyB9';
$new_css['page_list_css'] = 'LmFsbF9yZXZpZXcgJmd0OyBkaXYgIHsgY2xlYXI6IGJvdGg7IG92ZXJmbG93OiBoaWRkZW47IHBhZGRpbmc6IDdweDsgYm9yZGVyOiAxcHggc29saWQgI2VlZTsgbWFyZ2luLWJvdHRvbTogMTVweDsgfQ0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLmxlZnQgeyBmbG9hdDogbGVmdDsgd2lkdGg6IDY0JTsgdmVydGljYWwtYWxpZ246IHRvcDsgfQ0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnJpZ2h0IHsgZmxvYXQ6IHJpZ2h0OyB3aWR0aDogMzMlOyB2ZXJ0aWNhbC1hbGlnbjogdG9wOyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucmV2aWV3X2xpc3RfdGl0bGUgeyBmb250LXNpemU6IDE1cHg7IGNvbG9yOiAjMmIyYjJiOyBtYXJnaW4tYm90dG9tOiAzcHg7IH0NCi5hbGxfcmV2aWV3ICZndDsgZGl2IC5yZXZpZXdfbGlzdF9hdXRob3IgeyBmb250LXNpemU6IDEycHg7IGNvbG9yOiAjMmIyYjJiOyBtYXJnaW4tYm90dG9tOiA4cHg7IH0NCi5hbGxfcmV2aWV3ICZndDsgZGl2IC5yZXZpZXdfbGlzdF9hdXRob3Igc3BhbiB7IGZvbnQtc2l6ZTogMTNweDsgY29sb3I6ICM2NjY7IGZvbnQtd2VpZ2h0OiA3MDA7ICB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucmV2aWV3X2xpc3RfYXV0aG9yIHNwYW4gYSB7IGZvbnQtd2VpZ2h0OiAgbm9ybWFsOyB0ZXh0LWRlY29yYXRpb246IG5vbmU7IGxpbmUtaGVpZ2h0OiAxNHB4OyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucmV2aWV3X2xpc3RfdGV4dCB7IGZvbnQtc2l6ZTogMTJweDsgbGluZS1oZWlnaHQ6IDE0cHg7IGNvbG9yOiAjMmIyYjJiOyBmb250LXdlaWdodDogbm9ybWFsOyBtYXJnaW4tYm90dG9tOiA3cHg7IH0NCg0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfZmVhdHVyZSB7IG1hcmdpbi10b3A6IDEycHg7IHdpZHRoOiAxMDAlOyB2ZXJ0aWNhbC1hbGlnbjogdG9wOyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7IH0NCi5hbGxfcmV2aWV3ICZndDsgZGl2IC5wcm9kdWN0X2ZlYXR1cmUgaW1nIHsgdmVydGljYWwtYWxpZ246IG1pZGRsZTsgbWFyZ2luLXJpZ2h0OiAxNXB4OyAgfQ0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfZmVhdHVyZSBkaXYgeyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7IHZlcnRpY2FsLWFsaWduOiB0b3A7IHdpZHRoOiA0OCU7IH0NCi5hbGxfcmV2aWV3ICZndDsgZGl2IC5wcm9kdWN0X2ZlYXR1cmUgZGl2K2RpdiB7IG1hcmdpbi1sZWZ0OiAxMHB4OyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9mZWF0dXJlIGRpdiBiLnByb3MgeyBmb250LXNpemU6IDEzcHg7IGNvbG9yOiAjNmU5YjI2OyBmb250LXdlaWdodDogNDAwOyB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlOyBkaXNwbGF5OiAgaW5saW5lLWJsb2NrOyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9mZWF0dXJlIGRpdiBiLmNvbnMgeyBmb250LXNpemU6IDEzcHg7IGNvbG9yOiAjZTcxMjI2OyBmb250LXdlaWdodDogNDAwOyB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlOyBkaXNwbGF5OiAgaW5saW5lLWJsb2NrOyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9mZWF0dXJlIGRpdiB1bCB7IGxpc3Qtc3R5bGU6IG5vbmU7IHBhZGRpbmc6IDBweDsgbWFyZ2luOiA3cHggMHB4IDBweCA0MHB4OyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9mZWF0dXJlIGRpdiB1bCBsaSB7IHBhZGRpbmctdG9wOiAzcHg7IH0NCg0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfcmF0aW5nX2xpc3QgeyBwYWRkaW5nOiAxMHB4OyBiYWNrZ3JvdW5kOiAjZjFmNWY4OyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCB7IGxpc3Qtc3R5bGU6IG5vbmU7IHBhZGRpbmc6IDBweDsgbWFyZ2luOiAwcHg7ICB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCBsaSB7IHBhZGRpbmctdG9wOiAzcHg7IGNsZWFyOiBib3RoOyB9DQouYWxsX3JldmlldyAmZ3Q7IGRpdiAucHJvZHVjdF9yYXRpbmdfbGlzdCB1bCBsaSBpbWcgeyBmbG9hdDogcmlnaHQ7ICB9DQoNCi5hbGxfcmV2aWV3ICZndDsgZGl2IC5wcm9kdWN0X3Jldmlld190b3RhbF9yYXRpbmcgeyBiYWNrZ3JvdW5kOiAjZGJlOGYxOyBmb250LXdlaWdodDogNzAwOyBtYXJnaW4tdG9wOiA1cHg7IHBhZGRpbmc6IDNweDsgfQ0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfcmV2aWV3X3RvdGFsX3JhdGluZyBpbWcgeyBib3JkZXI6IG5vbmU7IH0NCg0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfcmV2aWV3X2ltYWdlX3BvcHVwIHsgYmFja2dyb3VuZDogI2ZmZjsgfQ0KLmFsbF9yZXZpZXcgJmd0OyBkaXYgLnByb2R1Y3RfcmV2aWV3X2ltYWdlX3BvcHVwIGltZyB7IHBhZGRpbmc6IDNweDsgYm9yZGVyOiAxcHggc29saWQgI0U3RTdFNzsgbWFyZ2luLXJpZ2h0OiA0cHg7IH0NCg0KLmFsbF9yZXZpZXcgLnByb2R1Y3RfcmV2aWV3X3NvY2lhbCB7IG1hcmdpbi10b3A6IDhweDsgZmxvYXQ6IHJpZ2h0OyB9DQouYWxsX3JldmlldyAucHJvZHVjdF9yZXZpZXdfc29jaWFsOmFmdGVyIHsgY29udGVudDomcXVvdDsmcXVvdDs7IGNsZWFyOiBib3RoOyBoZWlnaHQ6IDFweDsgfQ==';
$new_css['box_css'] = 'LnJldmlld19ib3ggeyBtYXJnaW4tYm90dG9tOiAxMHB4OyBib3JkZXI6IDFweCBzb2xpZCAjZGRkOyAgcGFkZGluZzogN3B4OyB9DQoucmV2aWV3X2JveCAuYm94LWhlYWRpbmcgeyBmb250LXNpemU6IDE2cHg7IGZvbnQtd2VpZ2h0OiA2MDA7IGNvbG9yOiAjMzMzOyAgbWFyZ2luLWJvdHRvbTogMjBweDsgIH0NCi5yZXZpZXdfYm94IC5ib3gtcHJvZHVjdCAmZ3Q7IGRpdiB7IG1hcmdpbi1ib3R0b206IDE1cHg7IH0NCi5yZXZpZXdfYm94IC5ib3gtcHJvZHVjdCAmZ3Q7IGRpdjpsYXN0LWNoaWxkIHsgbWFyZ2luLWJvdHRvbTogMHB4OyB9DQoucmV2aWV3X2JveCAucmV2aWV3X3RleHQgeyBib3JkZXItbGVmdDogNXB4IHNvbGlkICNlMWUxZTE7IHBhZGRpbmctbGVmdDogNXB4OyBtYXJnaW4tYm90dG9tOiA0cHg7IGZvbnQtc3R5bGU6IGl0YWxpYzsgfQ0KLnJldmlld19ib3ggLnJldmlld19hdXRob3IgeyBmb250LXNpemU6IDk5JTsgY29sb3I6ICMyMjI7IG1hcmdpbjogMnB4IDBweCAzcHggMHB4OyB9DQoucmV2aWV3X2JveCAucmV2aWV3X2RhdGUgeyBmb250LXNpemU6IDExcHg7IGNvbG9yOiAjNTU1OyB3aGl0ZS1zcGFjZTogbm93cmFwOyB9DQoucmV2aWV3X2JveCAucmV2aWV3X3JhdGluZyB7IGRpc3BsYXk6IGJsb2NrOyB9DQoucmV2aWV3X2JveCAuYnV0dG9uIHsgZGlzcGxheTogaW5saW5lLWJsb2NrOyBtYXJnaW4tdG9wOiAxNXB4OyB9';
$new_css['share_css'] = 'LnByb2R1Y3RfcmV2aWV3X3NvY2lhbCB7IG1hcmdpbi10b3A6IDhweDsgZmxvYXQ6IHJpZ2h0OyB9DQoucHJvZHVjdF9yZXZpZXdfc29jaWFsOmFmdGVyIHsgY29udGVudDoiIjsgY2xlYXI6IGJvdGg7IGhlaWdodDogMXB4OyB9';

if (function_exists('mysqli_connect')) {
  $r = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);

	if (!$r) {
		die('Could not connect: ' . mysql_error());
	}

	mysqli_select_db($r, DB_DATABASE) or die('Could not select database.');

	echo 'Connected successfully....';

	mysqli_query($r, "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_attribute` (
					`attribute_id` int(11) NOT NULL AUTO_INCREMENT,
					`name` varchar(255) NOT NULL,
					`type` tinyint(1) NOT NULL,
					`added_by` varchar(1) NOT NULL DEFAULT 'u',
					`predefined` tinyint(1) NOT NULL DEFAULT '0',
					`review_id` int(11) NOT NULL,
					`status` tinyint(1) NOT NULL,
					PRIMARY KEY (`attribute_id`),
					KEY `review_id` (`review_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysqli_query($r, "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_rating` (
					`rating_id` int(11) NOT NULL AUTO_INCREMENT,
					`sort_order` int(3) NOT NULL DEFAULT '0',
					`status` tinyint(1) NOT NULL,
					PRIMARY KEY (`rating_id`),
					UNIQUE KEY `rating_id` (`rating_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysqli_query($r, "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_rating_description` (
					`rating_id` int(11) NOT NULL,
					`language_id` int(11) NOT NULL,
					`name` varchar(64) NOT NULL,
					PRIMARY KEY (`rating_id`,`language_id`),
					KEY `name` (`name`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysqli_query($r, "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_rating_review` (
					`rating_review_id` int(11) NOT NULL AUTO_INCREMENT,
					`review_id` int(11) NOT NULL,
					`rating_id` int(11) NOT NULL,
					`rating` tinyint(1) NOT NULL,
					PRIMARY KEY (`rating_review_id`,`rating_id`),
					KEY `review_id` (`review_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysqli_query($r, "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_rating_to_store` (
					`rating_id` int(11) NOT NULL,
					`store_id` int(11) NOT NULL,
					PRIMARY KEY (`rating_id`,`store_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysqli_query($r, "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_reason` (
					`reason_id` int(11) NOT NULL AUTO_INCREMENT,
					`status` tinyint(1) NOT NULL,
					PRIMARY KEY (`reason_id`),
					UNIQUE KEY `reason_id` (`reason_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysqli_query($r, "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_reason_description` (
					`reason_id` int(11) NOT NULL,
					`language_id` int(11) NOT NULL,
					`name` varchar(255) NOT NULL,
					PRIMARY KEY (`reason_id`,`language_id`),
					KEY `name` (`name`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysqli_query($r, "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_reason_to_store` (
					`reason_id` int(11) NOT NULL,
					`store_id` int(11) NOT NULL,
					PRIMARY KEY (`reason_id`,`store_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysqli_query($r, "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_report` (
					`report_id` int(11) NOT NULL AUTO_INCREMENT,
					`title` varchar(255) NOT NULL,
					`reported` varchar(94) NOT NULL,
					`review_id` int(11) NOT NULL,
					`customer_id` int(11) NOT NULL,
					`store_id` int(11) NOT NULL,
					`date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
					PRIMARY KEY (`report_id`,`store_id`),
					UNIQUE KEY `report_id` (`report_id`),
					KEY `review_id` (`review_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysqli_query($r, "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_review_image` (
					`review_image_id` int(11) NOT NULL AUTO_INCREMENT,
					`review_id` int(11) NOT NULL,
					`image` varchar(255) NOT NULL DEFAULT '',
					PRIMARY KEY (`review_image_id`,`review_id`),
					KEY `review_id` (`review_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysqli_query($r, "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_comment_image` (
					`comment_image_id` int(11) NOT NULL AUTO_INCREMENT,
					`review_id` int(11) NOT NULL,
					`image` varchar(255) NOT NULL DEFAULT '',
					PRIMARY KEY (`comment_image_id`,`review_id`),
					KEY `review_id` (`review_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	$query_exists_col = mysqli_query($r, "SHOW COLUMNS FROM `" . DB_PREFIX . "review` LIKE 'recommend'");

	if (!mysqli_num_rows($query_exists_col)) {
		mysqli_query($r, "ALTER TABLE `" . DB_PREFIX . "review` ADD `language_id` INT(9) NOT NULL DEFAULT '0'");
		mysqli_query($r, "ALTER TABLE `" . DB_PREFIX . "review` ADD `title` VARCHAR(40) NOT NULL");
		mysqli_query($r, "ALTER TABLE `" . DB_PREFIX . "review` ADD `recommend` VARCHAR(1) NOT NULL DEFAULT 'y'");
		mysqli_query($r, "ALTER TABLE `" . DB_PREFIX . "pr_attribute` ADD `added_by` VARCHAR(1) NOT NULL DEFAULT 'u'");
		mysqli_query($r, "ALTER TABLE `" . DB_PREFIX . "pr_attribute` ADD `predefined` tinyint(1) NOT NULL DEFAULT '0'");

		foreach ($new_css as $key => $css) {
			mysqli_query($r, "UPDATE " . DB_PREFIX . "setting SET `value` = '" . mysqli_real_escape_string($r, base64_decode($css)) . "' WHERE store_id = '0' AND `key` = 'product_reviews_" . mysqli_real_escape_string($r, $key) . "'");
		}
	}

	$query_exists_col = mysqli_query($r, "SHOW COLUMNS FROM `" . DB_PREFIX . "review` LIKE 'vote_yes'");

	if (!mysqli_num_rows($query_exists_col)) {
		mysqli_query($r, "ALTER TABLE `" . DB_PREFIX . "review` ADD `vote_yes` INT(9) NOT NULL DEFAULT '0'");
		mysqli_query($r, "ALTER TABLE `" . DB_PREFIX . "review` ADD `vote_no` INT(9) NOT NULL DEFAULT '0'");
	}

	$query_exists_col = mysqli_query($r, "SHOW COLUMNS FROM `" . DB_PREFIX . "review` LIKE 'comment'");

	if (!mysqli_num_rows($query_exists_col)) {
		mysqli_query($r, "ALTER TABLE `" . DB_PREFIX . "review` ADD `comment` text COLLATE utf8_bin NOT NULL");
		mysqli_query($r, "ALTER TABLE `" . DB_PREFIX . "review` ADD `comment_date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'");
	}

	$query_exists_col = mysqli_query($r, "SHOW COLUMNS FROM `" . DB_PREFIX . "review` LIKE 'store_id'");

	if (!mysqli_num_rows($query_exists_col)) {
		mysqli_query($r, "ALTER TABLE `" . DB_PREFIX . "review` ADD `store_id` INT(11) NOT NULL DEFAULT '0'");
	}

	$query_exists_col = mysqli_query($r, "SHOW COLUMNS FROM `" . DB_PREFIX . "review` LIKE 'image'");

	if (mysqli_num_rows($query_exists_col)) {
		$query_review_images = mysqli_query($r, "SELECT review_id, image FROM `" . DB_PREFIX . "review` WHERE image <> ''");

		if (mysqli_num_rows($query_review_images)) {
			while ($review = mysqli_fetch_array($query_review_images)) {
				mysqli_query($r, "INSERT INTO " . DB_PREFIX . "pr_review_image SET review_id = '" . (int)$review['review_id'] . "', image = '" . mysqli_real_escape_string($r, $review['image']) . "'");
			}
		}

		mysqli_query($r, "ALTER TABLE `" . DB_PREFIX . "review` DROP COLUMN `image`");
	}
} else {
	$r = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);

	if (!$r) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db(DB_DATABASE, $r) or die('Could not select database.');

	echo 'Connected successfully....';

	mysql_query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_attribute` (
					`attribute_id` int(11) NOT NULL AUTO_INCREMENT,
					`name` varchar(255) NOT NULL,
					`type` tinyint(1) NOT NULL,
					`added_by` varchar(1) NOT NULL DEFAULT 'u',
					`predefined` tinyint(1) NOT NULL DEFAULT '0',
					`review_id` int(11) NOT NULL,
					`status` tinyint(1) NOT NULL,
					PRIMARY KEY (`attribute_id`),
					KEY `review_id` (`review_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysql_query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_rating` (
					`rating_id` int(11) NOT NULL AUTO_INCREMENT,
					`sort_order` int(3) NOT NULL DEFAULT '0',
					`status` tinyint(1) NOT NULL,
					PRIMARY KEY (`rating_id`),
					UNIQUE KEY `rating_id` (`rating_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysql_query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_rating_description` (
					`rating_id` int(11) NOT NULL,
					`language_id` int(11) NOT NULL,
					`name` varchar(64) NOT NULL,
					PRIMARY KEY (`rating_id`,`language_id`),
					KEY `name` (`name`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysql_query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_rating_review` (
					`rating_review_id` int(11) NOT NULL AUTO_INCREMENT,
					`review_id` int(11) NOT NULL,
					`rating_id` int(11) NOT NULL,
					`rating` tinyint(1) NOT NULL,
					PRIMARY KEY (`rating_review_id`,`rating_id`),
					KEY `review_id` (`review_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysql_query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_rating_to_store` (
					`rating_id` int(11) NOT NULL,
					`store_id` int(11) NOT NULL,
					PRIMARY KEY (`rating_id`,`store_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysql_query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_reason` (
					`reason_id` int(11) NOT NULL AUTO_INCREMENT,
					`status` tinyint(1) NOT NULL,
					PRIMARY KEY (`reason_id`),
					UNIQUE KEY `reason_id` (`reason_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysql_query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_reason_description` (
					`reason_id` int(11) NOT NULL,
					`language_id` int(11) NOT NULL,
					`name` varchar(255) NOT NULL,
					PRIMARY KEY (`reason_id`,`language_id`),
					KEY `name` (`name`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysql_query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_reason_to_store` (
					`reason_id` int(11) NOT NULL,
					`store_id` int(11) NOT NULL,
					PRIMARY KEY (`reason_id`,`store_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysql_query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_report` (
					`report_id` int(11) NOT NULL AUTO_INCREMENT,
					`title` varchar(255) NOT NULL,
					`reported` varchar(94) NOT NULL,
					`review_id` int(11) NOT NULL,
					`customer_id` int(11) NOT NULL,
					`store_id` int(11) NOT NULL,
					`date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
					PRIMARY KEY (`report_id`,`store_id`),
					UNIQUE KEY `report_id` (`report_id`),
					KEY `review_id` (`review_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysql_query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_review_image` (
					`review_image_id` int(11) NOT NULL AUTO_INCREMENT,
					`review_id` int(11) NOT NULL,
					`image` varchar(255) NOT NULL DEFAULT '',
					PRIMARY KEY (`review_image_id`,`review_id`),
					KEY `review_id` (`review_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	mysql_query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pr_comment_image` (
					`comment_image_id` int(11) NOT NULL AUTO_INCREMENT,
					`review_id` int(11) NOT NULL,
					`image` varchar(255) NOT NULL DEFAULT '',
					PRIMARY KEY (`comment_image_id`,`review_id`),
					KEY `review_id` (`review_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	$query_exists_col = mysql_query("SHOW COLUMNS FROM `" . DB_PREFIX . "review` LIKE 'recommend'");

	if (!mysql_num_rows($query_exists_col)) {
		mysql_query("ALTER TABLE `" . DB_PREFIX . "review` ADD `language_id` INT(9) NOT NULL DEFAULT '0'");
		mysql_query("ALTER TABLE `" . DB_PREFIX . "review` ADD `title` VARCHAR(40) NOT NULL");
		mysql_query("ALTER TABLE `" . DB_PREFIX . "review` ADD `recommend` VARCHAR(1) NOT NULL DEFAULT 'y'");
		mysql_query("ALTER TABLE `" . DB_PREFIX . "pr_attribute` ADD `added_by` VARCHAR(1) NOT NULL DEFAULT 'u'");
		mysql_query("ALTER TABLE `" . DB_PREFIX . "pr_attribute` ADD `predefined` tinyint(1) NOT NULL DEFAULT '0'");

		foreach ($new_css as $key => $css) {
			mysql_query("UPDATE " . DB_PREFIX . "setting SET `value` = '" . mysql_real_escape_string(base64_decode($css), $r) . "' WHERE store_id = '0' AND `key` = 'product_reviews_" . mysql_real_escape_string($key, $r) . "'");
		}
	}

	$query_exists_col = mysql_query("SHOW COLUMNS FROM `" . DB_PREFIX . "review` LIKE 'vote_yes'");

	if (!mysql_num_rows($query_exists_col)) {
		mysql_query("ALTER TABLE `" . DB_PREFIX . "review` ADD `vote_yes` INT(9) NOT NULL DEFAULT '0'");
		mysql_query("ALTER TABLE `" . DB_PREFIX . "review` ADD `vote_no` INT(9) NOT NULL DEFAULT '0'");
	}

	$query_exists_col = mysql_query("SHOW COLUMNS FROM `" . DB_PREFIX . "review` LIKE 'comment'");

	if (!mysql_num_rows($query_exists_col)) {
		mysql_query("ALTER TABLE `" . DB_PREFIX . "review` ADD `comment` text COLLATE utf8_bin NOT NULL");
		mysql_query("ALTER TABLE `" . DB_PREFIX . "review` ADD `comment_date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'");
	}

	$query_exists_col = mysql_query("SHOW COLUMNS FROM `" . DB_PREFIX . "review` LIKE 'store_id'");

	if (!mysql_num_rows($query_exists_col)) {
		mysql_query("ALTER TABLE `" . DB_PREFIX . "review` ADD `store_id` INT(11) NOT NULL DEFAULT '0'");
	}

	$query_exists_col = mysql_query("SHOW COLUMNS FROM `" . DB_PREFIX . "review` LIKE 'image'");

	if (mysql_num_rows($query_exists_col)) {
		$query_review_images = mysql_query("SELECT review_id, image FROM `" . DB_PREFIX . "review` WHERE image <> ''");

		if (mysql_num_rows($query_review_images)) {
			while ($review = mysql_fetch_array($query_review_images)) {
				mysql_query("INSERT INTO " . DB_PREFIX . "pr_review_image SET review_id = '" . (int)$review['review_id'] . "', image = '" . mysql_real_escape_string($review['image'], $r) . "'");
			}
		}

		mysql_query("ALTER TABLE `" . DB_PREFIX . "review` DROP COLUMN `image`");
	}
}

echo'<br /><br />Done!<br />You must go to admin and set up module (Extensions -> Modules -> Advanced Product Reviews).';
?>