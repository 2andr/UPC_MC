<?php 
/* Add to ItemDetails.php before "<?php } ?>"  at end of file
<?php } elseif ($_GET['Selected'] == "Maker" or $selected == "Maker") { ?>
	<?php include UPCP_CD_PLUGIN_PATH . 'makers_addon/MakerDetails.php'; ?>
*/

$Maker = $wpdb->get_row($wpdb->prepare("SELECT * FROM $makers_table_name WHERE Maker_ID ='%d'", $_GET['Maker_ID'])); ?>
		
		<div class="OptionTab ActiveTab" id="EditMaker">
				
				<div id="col-left">
				<div class="col-wrap">
				<div class="form-wrap TagDetail">
						<a href="admin.php?page=UPCP-options&DisplayPage=Makers" class="NoUnderline">&#171; <?php _e("Back", 'UPC_MC') ?></a>
						<h3>Edit <?php echo $Maker->Maker_Name; echo "( ID: "; echo $Maker->Maker_ID; echo" )"; ?></h3>
						<form id="addtag" method="post" action="admin.php?page=UPCP-options&Action=UPCP_EditMaker&DisplayPage=Makers" class="validate" enctype="multipart/form-data">
						<input type="hidden" name="action" value="Edit_Maker" />
						<input type="hidden" name="Maker_ID" value="<?php echo $Maker->Maker_ID; ?>" />
						<?php wp_nonce_field('UPCP_Element_Nonce', 'UPCP_Element_Nonce'); ?>
						<?php wp_referer_field(); ?>
						<div class="form-field form-required">
								<label for="Maker_Name"><?php _e("Name", 'UPC_MC') ?></label>
								<input name="Maker_Name" id="Maker_Name" type="text" value="<?php echo $Maker->Maker_Name;?>" size="60" />
								<p><?php _e("The name of the field you will see.", 'UPC_MC') ?></p>
						</div>
						<div class="form-field form-required">
								<label for="Maker_Slug"><?php _e("Slug", 'UPC_MC') ?></label>
								<input name="Maker_Slug" id="Maker_Slug" type="text" value="<?php echo $Maker->Maker_Slug;?>" size="60" />
								<p><?php _e("An all-lowercase name that will be used to insert the field.", 'UPC_MC') ?></p>
						</div>
						<div class="form-field">
								<label for="Maker_Description"><?php _e("Description", 'UPC_MC') ?></label>
								<textarea name="Maker_Description" id="Maker_Description" rows="2" cols="40"><?php echo $Maker->Maker_Description;?></textarea>
								<p><?php _e("The description of the field, which you will see as the instruction for the field.", 'UPC_MC') ?></p>
						</div>
						<div class="form-field">
								<label for="Maker_Lat"><?php _e("Latitude", 'UPC_MC') ?></label>
								<input name="Maker_Lat" id="Maker_Lat" type="text" value="<?php echo $Maker->Maker_Lat;?>" size="60" />
								<p><?php _e("The Latitude of the Maker Office.", 'UPC_MC') ?></p>
						</div>
						<div class="form-field">
								<label for="Maker_Lng"><?php _e("Longtitude", 'UPC_MC') ?></label>
								<input name="Maker_Lng" id="Maker_Lng" type="text" value="<?php echo $Maker->Maker_Lng;?>" size="60" />
								<p><?php _e("The Longtitude of the Maker Office.", 'UPC_MC') ?></p>
						</div>
						<div class="form-field">
								<label for="Maker_Addr"><?php _e("Address", 'UPC_MC') ?></label>
								<input name="Maker_Addr" id="Maker_Addr" type="text" value="<?php echo $Maker->Maker_Addr;?>" size="60" />
								<p><?php _e("The Address of the Maker Office.", 'UPC_MC') ?></p>
						</div>
						<div class="form-field">
								<label for="Maker_Site"><?php _e("Site", 'UPC_MC') ?></label>
								<input name="Maker_Site" id="Maker_Site" type="text" value="<?php echo $Maker->Maker_Site;?>" size="60" />
								<p><?php _e("The Site url of the Maker.", 'UPC_MC') ?></p>
						</div>

						<div class="form-field">
								<label for="Maker_Phone"><?php _e("Phone", 'UPC_MC') ?></label>
								<input name="Maker_Phone" id="Maker_Phone" type="text" value="<?php echo $Maker->Maker_Phone;?>" size="60" />
								<p><?php _e("The Phone number of the Maker office.", 'UPC_MC') ?></p>
						</div>
						<div class="form-field">
							<label for="Maker_Image"><?php _e("Image", 'UPC_MC') ?></label>
							<input id="Maker_Image" type="text" size="36" name="Maker_Image" value="<?php echo $Maker->Maker_Image;?>" /> 
							<input id="Maker_Image_Button" class="button" type="button" value="Upload Image" />
							<p><?php _e("An image that will be displayed in association with this Maker, if that option is selected in the 'Options' tab. Current Image:", 'UPC_MC') ?><br/><img class="PreviewImage" height="100" width="100" src="<?php echo $Maker->Maker_Image;?>" /></p>
							<div class='clear'></div>
						</div>

						<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes', 'UPC_MC') ?>"  /></p>
						</form>
				</div>
				</div>
				</div>
		</div>