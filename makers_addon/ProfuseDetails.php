<?php 
/* Add to ItemDetails.php before "<?php } ?>"  at end of file
<?php } elseif ($_GET['Selected'] == "Profuse" or $selected == "Profuse") { ?>
	<?php include UPCP_CD_PLUGIN_PATH . 'makers_addon/ProfuseDetails.php'; ?>
*/

$Profuse = $wpdb->get_row($wpdb->prepare("SELECT * FROM $profuses_table_name WHERE Profuse_ID ='%d'", $_GET['Profuse_ID'])); ?>
		
		<div class="OptionTab ActiveTab" id="EditProfuse">
				
				<div id="col-left">
				<div class="col-wrap">
				<div class="form-wrap TagDetail">
						<a href="admin.php?page=UPCP-options&DisplayPage=Profuses" class="NoUnderline">&#171; <?php _e("Back", 'UPC_MC') ?></a>
						<h3>Edit <?php echo $Profuse->Profuse_Name; echo "( ID: "; echo $Profuse->Profuse_ID; echo" )"; ?></h3>
						<form id="addtag" method="post" action="admin.php?page=UPCP-options&Action=UPCP_EditProfuse&DisplayPage=Profuses" class="validate" enctype="multipart/form-data">
						<input type="hidden" name="action" value="Edit_Profuse" />
						<input type="hidden" name="Profuse_ID" value="<?php echo $Profuse->Profuse_ID; ?>" />
						<?php wp_nonce_field('UPCP_Element_Nonce', 'UPCP_Element_Nonce'); ?>
						<?php wp_referer_field(); ?>
						<div class="form-field form-required">
								<label for="Profuse_Name"><?php _e("Name", 'UPC_MC') ?></label>
								<input name="Profuse_Name" id="Profuse_Name" type="text" value="<?php echo $Profuse->Profuse_Name;?>" size="60" />
								<p><?php _e("The name of the field you will see.", 'UPC_MC') ?></p>
						</div>
						<div class="form-field form-required">
								<label for="Profuse_Slug"><?php _e("Slug", 'UPC_MC') ?></label>
								<input name="Profuse_Slug" id="Profuse_Slug" type="text" value="<?php echo $Profuse->Profuse_Slug;?>" size="60" />
								<p><?php _e("An all-lowercase name that will be used to insert the field.", 'UPC_MC') ?></p>
						</div>
						<div class="form-field">
								<label for="Profuse_Description"><?php _e("Description", 'UPC_MC') ?></label>
								<textarea name="Profuse_Description" id="Profuse_Description" rows="2" cols="40"><?php echo $Profuse->Profuse_Description;?></textarea>
								<p><?php _e("The description of the field, which you will see as the instruction for the field.", 'UPC_MC') ?></p>
						</div>
						<div class="form-field">
							<label for="Profuse_Image"><?php _e("Image", 'UPC_MC') ?></label>
							<input id="Profuse_Image" type="text" size="36" name="Profuse_Image" value="<?php echo $Profuse->Profuse_Image;?>" /> 
							<input id="Profuse_Image_Button" class="button" type="button" value="Upload Image" />
							<p><?php _e("An image that will be displayed in association with this Profuse, if that option is selected in the 'Options' tab. Current Image:", 'UPC_MC') ?><br/><img class="PreviewImage" height="100" width="100" src="<?php echo $Profuse->Profuse_Image;?>" /></p>
							<div class='clear'></div>
						</div>

						<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes', 'UPC_MC') ?>"  /></p>
						</form>
				</div>
				</div>
				</div>
		</div>