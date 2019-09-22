<div class="ewd-upcp-dashboard-new-widget-box ewd-widget-box-full ewd-upcp-admin-closeable-widget-box<?php echo ( empty($MetaValues) ? ' ewd-upcp-admin-widget-box-start-closed' : '' ); ?>" id="ewd-upcp-admin-edit-product-makers-widget-box">
	<div class="ewd-upcp-dashboard-new-widget-box-top"><?php _e('Makers', 'UPC_MC'); ?><span class="ewd-upcp-admin-edit-product-down-caret">&nbsp;&nbsp;&#9660;</span><span class="ewd-upcp-admin-edit-product-up-caret">&nbsp;&nbsp;&#9650;</span></div>
	<div class="ewd-upcp-dashboard-new-widget-box-bottom">
		<table class="form-table">
			<th><label for="Item_Maker"><?php _e("Maker", 'UPC_MC') ?></label></th>
			<td><select name="Maker_ID" id="Item_Maker" >
				<option value=""></option>
					<?php $Makers = $wpdb->get_results("SELECT * FROM $makers_table_name ORDER BY Maker_Sidebar_Order, Maker_Name"); ?>
					<?php foreach ($Makers as $Maker) {
						echo "<option value='" . $Maker->Maker_ID . "' >" . $Maker->Maker_Name . "</option>";
					} ?>
				</select>
			</td>			
		</table>
	</div>
</div>
<div class="ewd-upcp-dashboard-new-widget-box ewd-widget-box-full ewd-upcp-admin-closeable-widget-box<?php echo ( empty($MetaValues) ? ' ewd-upcp-admin-widget-box-start-closed' : '' ); ?>" id="ewd-upcp-admin-edit-product-profuses-widget-box">
	<div class="ewd-upcp-dashboard-new-widget-box-top"><?php _e('Profuses', 'UPC_MC'); ?><span class="ewd-upcp-admin-edit-product-down-caret">&nbsp;&nbsp;&#9660;</span><span class="ewd-upcp-admin-edit-product-up-caret">&nbsp;&nbsp;&#9650;</span></div>
	<div class="ewd-upcp-dashboard-new-widget-box-bottom">
		<table class="form-table">
			<th><label for="Item_Profuse"><?php _e("Profuse", 'UPC_MC') ?></label></th>
			<td>
				<?php 
				$Profuses = $wpdb->get_results("SELECT * FROM $profuses_table_name ORDER BY Profuse_Name ASC" );
				if(!empty($Profuses)){?>
					<?php foreach ($Profuses as $Profuse) {?>
							<input type="checkbox" class='upcp-profuse-input' name="Profuses[]" value="<?php echo $Profuse->Profuse_ID; ?>" id="Profuse-<?php echo $Profuse->Profuse_ID; ?>"><?php echo $Profuse->Profuse_Name; ?></br>
					<?php }	}?>		
				</td>			
		</table>
	</div>
</div>