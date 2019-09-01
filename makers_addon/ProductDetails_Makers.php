<?php 
/*
// add this string betwin "Custom Fields@ and "Other Products" modules
include UPCP_CD_PLUGIN_PATH . 'makers_addon/ProductDetails_Makers.php'; 

*/
$MakerValue = $wpdb->get_row($wpdb->prepare("SELECT Maker_ID FROM $makers_meta_table_name WHERE Item_ID=%d", $Product->Item_ID)); 

$ProfuseValue = $wpdb->get_results($wpdb->prepare("SELECT Profuse_ID FROM $profuses_meta_table_name WHERE Item_ID=%d", $Product->Item_ID)); 
?>

<div class="ewd-upcp-dashboard-new-widget-box ewd-widget-box-full ewd-upcp-admin-closeable-widget-box<?php echo ( empty($MakerValue) ? ' ewd-upcp-admin-widget-box-start-closed' : '' ); ?>" id="ewd-upcp-admin-edit-product-Makers-widget-box">
	<div class="ewd-upcp-dashboard-new-widget-box-top"><?php _e('Maker', 'ultimate-product-catalogue'); ?><span class="ewd-upcp-admin-edit-product-down-caret">&nbsp;&nbsp;&#9660;</span><span class="ewd-upcp-admin-edit-product-up-caret">&nbsp;&nbsp;&#9650;</span></div>
	<div class="ewd-upcp-dashboard-new-widget-box-bottom">
		<table class="form-table">
			<tr>
			<th><label for="Item_Maker"><?php _e("Maker", 'ultimate-product-catalogue') ?></label></th>
			<td>
				<select name="Makers[]" id="Item_Maker" >
					<option value=""></option>
					<?php $Makers = $wpdb->get_results("SELECT Maker_ID, Maker_Name FROM $makers_table_name ORDER BY Maker_Sidebar_Order, Maker_Name"); 
					foreach ($Makers as $Maker) {
						echo "<option value='" . $Maker->Maker_ID . "'" ;
						if ( is_object($MakerValue) && $Maker->Maker_ID == $MakerValue->Maker_ID) echo " selected='selected' ";
						echo ">". $Maker->Maker_Name ."</option>";
					} 
					?>
				</select>
			</td>	
		</table>
	</div>
</div>

<div class="ewd-upcp-dashboard-new-widget-box ewd-widget-box-full ewd-upcp-admin-closeable-widget-box<?php echo ( empty($ProfuseValue) ? ' ewd-upcp-admin-widget-box-start-closed' : '' ); ?>" id="ewd-upcp-admin-edit-product-Profuses-widget-box">
	<div class="ewd-upcp-dashboard-new-widget-box-top"><?php _e('Profuse', 'ultimate-product-catalogue'); ?><span class="ewd-upcp-admin-edit-product-down-caret">&nbsp;&nbsp;&#9660;</span><span class="ewd-upcp-admin-edit-product-up-caret">&nbsp;&nbsp;&#9650;</span></div>
	<div class="ewd-upcp-dashboard-new-widget-box-bottom">
		<table class="form-table">
			<tr>
			<th><label for="Item_Profuse"><?php _e("Profuse", 'ultimate-product-catalogue') ?></label></th>
			<td>

				<?php 
				$Profuses = $wpdb->get_results("SELECT * FROM $profuses_table_name ORDER BY Profuse_Name ASC" );
if(!empty($Profuses)){
foreach ($Profuses as $Profuse) {
  $Is_Used = false;
  foreach ($ProfuseValue as $Profuse_Item) {
  if ($Profuse_Item->Profuse_ID == $Profuse->Profuse_ID) {$Is_Used = true;}
  }
						                                
				?>
							<input type="checkbox" class='upcp-profuse-input' name="Profuses[]" value="<?php echo $Profuse->Profuse_ID; ?>" id="Profuse-<?php echo $Profuse->Profuse_ID; ?>"
							<?php if ( $Is_Used) {echo " checked";} ?>>
							<?php echo $Profuse->Profuse_Name; ?></br>
							
					<?php }	}?>						
			</td>	
		</table>
	</div>
</div>
