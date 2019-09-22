<?php
	$Makers_Show_Hide = get_option("UPCP_Makers_Show_Hide");
	$Profuses_Show_Hide = get_option("UPCP_Profuses_Show_Hide");
?>
	<tr>
		<th scope="row"><?php _e("Show/Hide Makers", 'UPC_MC')?> <br/>
		</th>
		<td>
			<fieldset><legend class="screen-reader-text"><span><?php _e("Should makers in the sidebar show or be hidden when the page loads?", 'UPC_MC')?></span></legend>
			<label title='Show' class='ewd-upcp-admin-input-container'><input type='radio' name='makers_show_hide' value='Show' <?php if($Makers_Show_Hide == "Show") {echo "checked='checked'";} ?> /><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Show", 'UPC_MC')?></span></label><br />
			<label title='Hide' class='ewd-upcp-admin-input-container'><input type='radio' name='makers_show_hide' value='Hide' <?php if($Makers_Show_Hide == "Hide") {echo "checked='checked'";} ?> <?php if ($Full_Version != "Yes") {echo "disabled";} ?>/><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Hide", 'UPC_MC')?></span></label><br />
			<p><?php _e("Should makers in the sidebar show or be hidden when the page loads?", 'UPC_MC')?></p>
			</fieldset>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e("Show/Hide Profuses", 'UPC_MC')?> <br/>
		</th>
		<td>
			<fieldset><legend class="screen-reader-text"><span><?php _e("Should profuses in the sidebar show or be hidden when the page loads?", 'UPC_MC')?></span></legend>
			<label title='Show' class='ewd-upcp-admin-input-container'><input type='radio' name='profuses_show_hide' value='Show' <?php if($Profuses_Show_Hide == "Show") {echo "checked='checked'";} ?> /><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Show", 'UPC_MC')?></span></label><br />
			<label title='Hide' class='ewd-upcp-admin-input-container'><input type='radio' name='profuses_show_hide' value='Hide' <?php if($Profuses_Show_Hide == "Hide") {echo "checked='checked'";} ?> <?php if ($Full_Version != "Yes") {echo "disabled";} ?>/><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Hide", 'UPC_MC')?></span></label><br />
			<p><?php _e("Should profuses in the sidebar show or be hidden when the page loads?", 'UPC_MC')?></p>
			</fieldset>
		</td>
	</tr>
