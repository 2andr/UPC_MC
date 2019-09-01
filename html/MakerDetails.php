<?php $Maker = $wpdb->get_row($wpdb->prepare("SELECT * FROM $makers_table_name WHERE Maker_ID ='%d'", $_GET['Maker_ID']));?>

<div class="OptionTab ActiveTab" id="EditMaker">
				
	<div id="col-right">
		<div class="col-wrap">
			<div id="add-page" class="postbox metabox-holder" >
				<div class="handlediv" title="Click to toggle"><br /></div>
				<h3 class='hndle'><span><?php _e("Products in Maker", 'ultimate-product-catalogue') ?></span></h3>
				<div class="inside">
					<div id="posttype-page" class="posttypediv">
						<div id="tabs-panel-posttype-page-most-recent" class="tabs-panel tabs-panel-active">
							<table class="wp-list-table striped widefat tags sorttable maker-products-list">
					    		<thead>
					    			<tr>
					        		    <th><?php _e("Product Name", 'ultimate-product-catalogue') ?></th>
					    			</tr>
					    		</thead>
					    		<tbody>
					    			<?php $Products = $wpdb->get_results($wpdb->prepare("SELECT Item_ID, Item_Name FROM $items_table_name WHERE Maker_ID='%d' ORDER BY Item_Maker_Product_Order", $_GET['Maker_ID']));
									if (empty($Products)) { echo "<div class='product-maker-row list-item'><p>No products currently in maker<p/></div>"; }
									else {
					    				foreach ($Products as $Product) {
					    					echo "<tr id='maker-product-item-" . $Product->Item_ID . "' class='maker-product-item'>";
					    				    echo "<td class='product-name'>";
					    				    echo "<a href='admin.php?page=UPCP-options&Action=UPCP_Item_Details&Selected=Product&Item_ID=" . $Product->Item_ID . "'>" . $Product->Item_Name . "</a>";
					    				    //echo $Product->Item_Name;
					    				    echo "</td>";
					    					echo "</tr>";
					    				}
									}?>
					    		</tbody>
					    		<tfoot>
					    		    <tr>
					    		        <th><?php _e("Product Name", 'ultimate-product-catalogue') ?></th>
					    		    </tr>
					    		</tfoot>
							</table>
						</div><!-- /.tabs-panel -->
					</div><!-- /.posttypediv -->
				</div>
			</div>
	
			<div class="upcp-catalogue-sort-options">
				<div class="upcp-catalogue-sort-option">
					<div class="upcp-catalogue-sort-az" data-table='maker-products-list' data-action='maker_products_update_order'>Sort Items Alphabetically (A-Z)</div>
					<div class="upcp-catalogue-sort-za" data-table='maker-products-list' data-action='maker_products_update_order'>Sort Items Reverse Alphabetically (Z-A)</div>
				</div>
			</div>
	
		</div>
	</div><!-- col-right -->
				
	<div id="col-left">
		<div class="col-wrap">
			<div class="form-wrap MakerDetail">
				<a href="admin.php?page=UPCP-options&DisplayPage=Makers" class="NoUnderline">&#171; <?php _e("Back", 'ultimate-product-catalogue') ?></a>
				<h3>Edit <?php echo $Maker->Maker_Name;echo" (ID:";echo $Maker->Maker_ID;echo " )";?></h3>
				<form id="addtag" method="post" action="admin.php?page=UPCP-options&Action=UPCP_EditMaker&DisplayPage=Makers" class="validate" enctype="multipart/form-data">
					<input type="hidden" name="action" value="Edit_Maker" />
					<input type="hidden" name="Maker_ID" value="<?php echo $Maker->Maker_ID; ?>" />
					<input type="hidden" name="WC_term_id" value="<?php echo $Maker->Maker_WC_ID; ?>" />
					<?php wp_nonce_field('UPCP_Element_Nonce', 'UPCP_Element_Nonce'); ?>
					<?php wp_referer_field(); ?>
					<div class="form-field">
						<label for="Maker_Name"><?php _e("Name", 'ultimate-product-catalogue') ?></label>
						<input name="Maker_Name" id="Maker_Name" type="text" value="<?php echo $Maker->Maker_Name;?>" size="60" />
						<p><?php _e("The name of the maker your users will see and search for.", 'ultimate-product-catalogue') ?></p>
					</div>
					<div class="form-field">
						<label for="Maker_Lat"><?php _e("Lattitude", 'ultimate-product-catalogue') ?></label>
						<input name="Maker_Lat" id="Maker_Lat" type="text" value="<?php echo $Maker->Maker_Lat;?>" size="60" />
						<p><?php _e("Latitude of maker address.", 'ultimate-product-catalogue') ?></p>
					</div>
					<div class="form-field">
						<label for="Maker_Lng"><?php _e("Longtitude", 'ultimate-product-catalogue') ?></label>
						<input name="Maker_Lng" id="Maker_Lng" type="text" value="<?php echo $Maker->Maker_Lng;?>" size="60" />
						<p><?php _e("TLongtitude of maker address.", 'ultimate-product-catalogue') ?></p>
					</div>
					<div class="form-field">
						<label for="Maker_Description"><?php _e("Description", 'ultimate-product-catalogue') ?></label>
						<textarea name="Maker_Description" id="Maker_Description" rows="5" cols="40"><?php echo $Maker->Maker_Description;?></textarea>
						<p><?php _e("The description of the maker. What products are included in this?", 'ultimate-product-catalogue') ?></p>
					</div>
					<div class="form-field">
						<label for="Maker_Image"><?php _e("Image", 'ultimate-product-catalogue') ?></label>
						<input id="Maker_Image" type="text" size="36" name="Maker_Image" value="<?php echo $Maker->Maker_Image;?>" /> 
						<input id="Maker_Image_Button" class="button" type="button" value="Upload Image" />
						<p><?php _e("An image that will be displayed in association with this maker, if that option is selected in the 'Options' tab. Current Image:", 'ultimate-product-catalogue') ?><br/><img class="PreviewImage" height="100" width="100" src="<?php echo $Maker->Maker_Image;?>" /></p>
						<div class='clear'></div>
					</div>
					<div class="form-field">
						<label for="Maker_Addr"><?php _e("Address", 'ultimate-product-catalogue') ?></label>
						<textarea name="Maker_Addr" id="Maker_Addr" rows="5" cols="40"><?php echo $Maker->Maker_Addr;?></textarea>
						<p><?php _e("The Address of the maker. What products are included in this?", 'ultimate-product-catalogue') ?></p>
					</div>
					<div class="form-field">
						<label for="Maker_Site"><?php _e("Site url", 'ultimate-product-catalogue') ?></label>
						<textarea name="Maker_Site" id="Maker_Site" rows="5" cols="40"><?php echo $Maker->Maker_Site;?></textarea>
						<p><?php _e("The Site url of the maker. What products are included in this?", 'ultimate-product-catalogue') ?></p>
					</div>
					<div class="form-field">
						<label for="Maker_Phone"><?php _e("Maker phone", 'ultimate-product-catalogue') ?></label>
						<textarea name="Maker_Phone" id="Maker_Phone" rows="5" cols="40"><?php echo $Maker->Maker_Phone;?></textarea>
						<p><?php _e("The phone of the maker. What products are included in this?", 'ultimate-product-catalogue') ?></p>
					</div>

					<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes', 'ultimate-product-catalogue') ?>" /></p>
				</form>
			</div>
		</div>
	</div>
			
</div>