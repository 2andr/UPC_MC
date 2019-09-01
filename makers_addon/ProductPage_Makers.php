<?php 
/* 
// add this string ProductsPage.php after
//echo $ReturnString;
//
//?>

include UPCP_CD_PLUGIN_PATH . 'makers_addon/ProductPage_Makers.php'; 

*/
?>
<div class='form-field'>
	<label for="Item_Maker"><?php _e("Maker", 'ultimate-product-catalogue') ?></label>
	<select name="Maker_ID" id="Item_Maker" class='upcp-select'>
		<option value=""></option>
		<?php $Makers = $wpdb->get_results("SELECT * FROM $makers_table_name ORDER BY Maker_Sidebar_Order, Maker_Name"); 	foreach ($Makers as $Maker) {
			echo "<option value='" . $Maker->Maker_ID . "' >" . $Maker->Maker_Name . "</option>";
		} 
		?>
	</select>

</div>

<div class='form-field'>
	<label for="Item_Profuse"><?php _e("Profuse", 'ultimate-product-catalogue') ?></label>
	<select name="Profuse_ID" id="Item_Profuse" class='upcp-select'>
		<option value=""></option>
		<?php $Profuses = $wpdb->get_results("SELECT * FROM $profuses_table_name ORDER BY Profuse_Sidebar_Order, Profuse_Name"); 	foreach ($Profuses as $Profuse) {
			echo "<option value='" . $Profuse->Profuse_ID . "' >" . $Profuse->Profuse_Name . "</option>";
		} 
		?>
	</select>

</div>