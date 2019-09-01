<?PHP
function Makers_Save_Order(){
	global $makers_table_name;
	global $wpdb;
	
	foreach ($_POST['maker-item'] as $Key=>$ID) {
		$Result = $wpdb->query($wpdb->prepare("UPDATE $makers_table_name SET Maker_Sidebar_Order=%d WHERE Maker_ID=%d", sanitize_text_field($Key), $ID));
	}
}
add_action('wp_ajax_makers_update_order','Makers_Save_Order');

function Profuses_Save_Order(){
	global $profuses_table_name;
	global $wpdb;
	
	foreach ($_POST['profuse-item'] as $Key=>$ID) {
		$Result = $wpdb->query($wpdb->prepare("UPDATE $profuses_table_name SET Profuse_Sidebar_Order=%d WHERE Profuse_ID=%d", sanitize_text_field($Key), $ID));
	}
}
add_action('wp_ajax_profuses_update_order','Profuses_Save_Order');


?>