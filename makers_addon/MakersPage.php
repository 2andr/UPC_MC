<?php 
/* add to MainScreen.php
		<div class="OptionTab <?php if ($Display_Page == 'Makers' or $Display_Page == 'Makers') {echo 'ActiveTab';} else {echo 'HiddenTab';} ?>" id="Makers">
				<?php include UPCP_CD_PLUGIN_PATH . '/makers_addon/MakersPage.php';?>
		</div>
*/

?>
<div id="col-right">
<div class="col-wrap">

<!-- Display a list of the products which have already been created -->
<?php wp_nonce_field(); ?>
<?php wp_referer_field(); ?>

<?php
			if (isset($_GET['Page']) and $_GET['DisplayPage'] == "Makers") {$Page = $_GET['Page'];}
			else {$Page = 1;}

			$Sql = "SELECT * FROM $makers_table_name ";
				if (isset($_GET['OrderBy']) and $_GET['DisplayPage'] == "Makers") {$Sql .= "ORDER BY " . $_GET['OrderBy'] . " " . $_GET['Order'] . " ";}
				else {$Sql .= "ORDER BY Maker_Sidebar_Order ";}
				$Sql .= "LIMIT " . ($Page - 1)*200 . ",200";
				$myrows = $wpdb->get_results($Sql);
				$TotalMakers = $wpdb->get_results("SELECT Maker_ID FROM $makers_table_name");
				$num_rows = $wpdb->num_rows;
				$Number_of_Pages = ceil($num_rows/200);
				$Current_Page_With_Order_By = "admin.php?page=UPCP-options&DisplayPage=Makers";
				if (isset($_GET['OrderBy'])) {$Current_Page_With_Order_By .= "&OrderBy=" .$_GET['OrderBy'] . "&Order=" . $_GET['Order'];}?>

<form action="admin.php?page=UPCP-options&Action=UPCP_MassDeleteMakers&DisplayPage=Makers" method="post">
<div class="tablenav top">
		<div class="alignleft actions">
				<select name='action'>
  					<option value='-1' selected='selected'><?php _e("Bulk Actions", 'UPC_MC') ?></option>
						<option value='delete'><?php _e("Delete", 'UPC_MC') ?></option>
				</select>
				<input type="submit" name="" id="doaction" class="button-secondary action" value="<?php _e('Apply', 'UPC_MC') ?>"  />
		</div>
		<div class='tablenav-pages <?php if ($Number_of_Pages == 1) {echo "one-page";} ?>'>
				<span class="displaying-num"><?php echo $wpdb->num_rows; ?> <?php _e("items", 'UPC_MC') ?></span>
				<span class='pagination-links'>
						<a class='first-page <?php if ($Page == 1) {echo "disabled";} ?>' title='Go to the first page' href='<?php echo $Current_Page_With_Order_By; ?>&Page=1'>&laquo;</a>
						<a class='prev-page <?php if ($Page <= 1) {echo "disabled";} ?>' title='Go to the previous page' href='<?php echo $Current_Page_With_Order_By; ?>&Page=<?php echo $Page-1;?>'>&lsaquo;</a>
						<span class="paging-input"><?php echo $Page; ?> <?php _e("of", 'UPC_MC') ?> <span class='total-pages'><?php echo $Number_of_Pages; ?></span></span>
						<a class='next-page <?php if ($Page >= $Number_of_Pages) {echo "disabled";} ?>' title='Go to the next page' href='<?php echo $Current_Page_With_Order_By; ?>&Page=<?php echo $Page+1;?>'>&rsaquo;</a>
						<a class='last-page <?php if ($Page == $Number_of_Pages) {echo "disabled";} ?>' title='Go to the last page' href='<?php echo $Current_Page_With_Order_By . "&Page=" . $Number_of_Pages; ?>'>&raquo;</a>
				</span>
		</div>
</div>

<table class="wp-list-table striped widefat fixed tags sorttable custom-fields-list" cellspacing="0">
		<thead>
				<tr>
						<th scope='col' id='cb' class='manage-column column-cb check-column'  style="">
								<input type="checkbox" /></th><th scope='col' id='field-name' class='manage-column column-name sortable desc'  style="">
										<?php if ($_GET['OrderBy'] == "Maker_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Name&Order=ASC'>";} ?>
											  <span><?php _e("Maker Name", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Maker_Slug" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Slug&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Slug&Order=ASC'>";} ?>
											  <span><?php _e("Maker Slug", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Maker_Description" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Description&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Description&Order=ASC'>";} ?>
											  <span><?php _e("Description", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
				</tr>
		</thead>

		<tfoot>
				<tr>
						<th scope='col' id='cb' class='manage-column column-cb check-column'  style="">
								<input type="checkbox" /></th><th scope='col' id='field-name' class='manage-column column-name sortable desc'  style="">
										<?php if ($_GET['OrderBy'] == "Maker_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Name&Order=ASC'>";} ?>
											  <span><?php _e("Maker Name", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Maker_Slug" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Slug&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Slug&Order=ASC'>";} ?>
											  <span><?php _e("Maker Slug", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Maker_Description" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Description&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Makers&OrderBy=Maker_Description&Order=ASC'>";} ?>
											  <span><?php _e("Description", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
				</tr>
		</tfoot>

	<tbody id="the-list" class='list:tag'>

		 <?php
				if ($myrows) {
	  			  foreach ($myrows as $Maker) {
								echo "<tr id='field-item-" . $Maker->Maker_ID ."' class='custom-field-list-item'>";
								echo "<th scope='row' class='check-column'>";
								echo "<input type='checkbox' name='Makers_Bulk[]' value='" . $Maker->Maker_ID ."' />";
								echo "</th>";
								echo "<td class='name column-name'>";
								echo "<strong>";
								echo "<a class='row-title' href='admin.php?page=UPCP-options&Action=UPCP_Maker_Details&Selected=Maker&Maker_ID=" . $Maker->Maker_ID ."' title='Edit " . $Maker->Maker_Name . "'>" . $Maker->Maker_Name . "</a></strong>";
								echo "<br />";
								echo "<div class='row-actions'>";
								echo "<span class='delete'>";
								echo "<a class='delete-tag' href='admin.php?page=UPCP-options&Action=UPCP_DeleteMaker&DisplayPage=Makers&Maker_ID=" . $Maker->Maker_ID ."'>" . __("Delete", 'UPC_MC') . "</a>";
		 						echo "</span>";
								echo "</div>";
								echo "<div class='hidden' id='inline_" . $Maker->Maker_ID ."'>";
								echo "<div class='name'>" . $Maker->Maker_Name . "</div>";
								echo "</div>";
								echo "</td>";
								echo "<td class='description column-slug'>" . $Maker->Maker_Slug . "</td>";
								echo "<td class='description column-description'>" . substr($Maker->Maker_Description, 0, 60);
								if (strlen($Maker->Maker_Description) > 60) {echo "...";}
								echo "</td>";
								echo "</tr>";
						}
				}
		?>

	</tbody>
</table>

<div class="tablenav bottom">
		<div class="alignleft actions">
				<select name='action'>
  					<option value='-1' selected='selected'><?php _e("Bulk Actions", 'UPC_MC') ?></option>
						<option value='delete'><?php _e("Delete", 'UPC_MC') ?></option>
				</select>
				<input type="submit" name="" id="doaction" class="button-secondary action" value="<?php _e('Apply', 'UPC_MC') ?>"  />
		</div>
		<div class='tablenav-pages <?php if ($Number_of_Pages == 1) {echo "one-page";} ?>'>
				<span class="displaying-num"><?php echo $wpdb->num_rows; ?> <?php _e("items", 'UPC_MC') ?></span>
				<span class='pagination-links'>
						<a class='first-page <?php if ($Page == 1) {echo "disabled";} ?>' title='Go to the first page' href='<?php echo $Current_Page_With_Order_By; ?>&Page=1'>&laquo;</a>
						<a class='prev-page <?php if ($Page <= 1) {echo "disabled";} ?>' title='Go to the previous page' href='<?php echo $Current_Page_With_Order_By; ?>&Page=<?php echo $Page-1;?>'>&lsaquo;</a>
						<span class="paging-input"><?php echo $Page; ?> <?php _e("of", 'UPC_MC') ?> <span class='total-pages'><?php echo $Number_of_Pages; ?></span></span>
						<a class='next-page <?php if ($Page >= $Number_of_Pages) {echo "disabled";} ?>' title='Go to the next page' href='<?php echo $Current_Page_With_Order_By; ?>&Page=<?php echo $Page+1;?>'>&rsaquo;</a>
						<a class='last-page <?php if ($Page == $Number_of_Pages) {echo "disabled";} ?>' title='Go to the last page' href='<?php echo $Current_Page_With_Order_By . "&Page=" . $Number_of_Pages; ?>'>&raquo;</a>
				</span>
		</div>
		<br class="clear" />
</div>
</form>

<br class="clear" />
</div>
</div> <!-- /col-right -->


<!-- Form to upload a list of new products from a spreadsheet -->
<div id="col-left">
<div class="col-wrap">

<div class="form-wrap">
<h2><?php _e("Add New Maker", 'UPC_MC') ?></h2>
<!-- Form to create a new field -->
<form id="addtag" method="post" action="admin.php?page=UPCP-options&Action=UPCP_AddMaker&DisplayPage=Makers" class="validate" enctype="multipart/form-data">
<input type="hidden" name="action" value="Add_Maker" />
<?php wp_nonce_field('UPCP_Element_Nonce', 'UPCP_Element_Nonce'); ?>
<?php wp_referer_field(); ?>
<div class="form-field form-required">
	<label for="Maker_Name"><?php _e("Name", 'UPC_MC') ?></label>
	<input name="Maker_Name" id="Maker_Name" type="text" value="" size="60" />
	<p><?php _e("The name of the field you will see.", 'UPC_MC') ?></p>
</div>
<div class="form-field form-required">
	<label for="Maker_Slug"><?php _e("Slug", 'UPC_MC') ?></label>
	<input name="Maker_Slug" id="Maker_Slug" type="text" value="" size="60" />
	<p><?php _e("An all-lowercase name that will be used to insert the field.", 'UPC_MC') ?></p>
</div>
<div class="form-field">
	<label for="Maker_Description"><?php _e("Description", 'UPC_MC') ?></label>
	<textarea name="Maker_Description" id="Maker_Description" rows="2" cols="40"></textarea>
	<p><?php _e("The description of the field, which you will see as the instruction for the field.", 'UPC_MC') ?></p>
</div>
<div class="form-field">
		<label for="Maker_Lat"><?php _e("Latitude", 'UPC_MC') ?></label>
		<input name="Maker_Lat" id="Maker_Lat" type="text" value="" size="60" />
		<p><?php _e("The Latitude of the Maker Office.", 'UPC_MC') ?></p>
</div>
<div class="form-field">
		<label for="Maker_Lng"><?php _e("Longtitude", 'UPC_MC') ?></label>
		<input name="Maker_Lng" id="Maker_Lng" type="text" value="" size="60" />
		<p><?php _e("The Longtitude of the Maker Office.", 'UPC_MC') ?></p>
</div>
<div class="form-field">
		<label for="Maker_Addr"><?php _e("Address", 'UPC_MC') ?></label>
		<input name="Maker_Addr" id="Maker_Addr" type="text" value="" size="60" />
		<p><?php _e("The Address of the Maker Office.", 'UPC_MC') ?></p>
</div>
<div class="form-field">
		<label for="Maker_Site"><?php _e("Site", 'UPC_MC') ?></label>
		<input name="Maker_Site" id="Maker_Site" type="text" value="" size="60" />
		<p><?php _e("The Site url of the Maker.", 'UPC_MC') ?></p>
</div>

<div class="form-field">
		<label for="Maker_Phone"><?php _e("Phone", 'UPC_MC') ?></label>
		<input name="Maker_Phone" id="Maker_Phone" type="text" value="" size="15" />
		<p><?php _e("The Phone number of the Maker office.", 'UPC_MC') ?></p>
</div>
<div class="form-field">
	<label for="Maker_Image"><?php _e("Image", 'UPC_MC') ?></label>
	<input id="Maker_Image" type="text" size="36" name="Maker_Image" value="<?php echo $Maker->Maker_Image;?>" /> 
	<input id="Maker_Image_Button" class="button" type="button" value="Upload Image" />
	<p><?php _e("An image that will be displayed in association with this Maker, if that option is selected in the 'Options' tab. Current Image:", 'UPC_MC') ?><br/><img class="PreviewImage" height="100" width="100" src="<?php echo $Maker->Maker_Image;?>" /></p>
	<div class='clear'></div>
</div>

<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Add New Field', 'UPC_MC') ?>"  /></p></form>

</div>

<br class="clear" />
</div>
</div><!-- /col-left -->


<?php 
/*
$items = $wpdb->get_results("SELECT Item_ID, Maker_Name FROM cms_wp_UPCP_Items ");
foreach ($items as $item){
	if ($item->Maker_Name !=""){
		$Maker = $wpdb->get_results("SELECT Maker_ID, Maker_Name FROM $makers_table_name WHERE Maker_Name = '". $item->Maker_Name ."' ");
		$Maker = array_shift ($Maker);
		$wpdb->insert('cms_wp_UPCP_Makers_Meta',
				array( 'Maker_ID' => $Maker->Maker_ID,
						'Item_ID' => $item->Item_ID,
						'Meta_Value' => $Maker->Maker_Name)
		);
	}
	echo "<br>Item_ID: ". $item->Item_ID ." Maker_Name: ". $item->Maker_Name." Maker_NameNew: ". $Maker->Maker_Name;
}
*/

 ?>
