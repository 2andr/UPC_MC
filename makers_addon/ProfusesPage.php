<?php 
/* add to MainScreen.php
		<div class="OptionTab <?php if ($Display_Page == 'Profuses' or $Display_Page == 'Profuses') {echo 'ActiveTab';} else {echo 'HiddenTab';} ?>" id="Profuses">
				<?php include UPCP_CD_PLUGIN_PATH . '/makers_addon/ProfusesPage.php';?>
		</div>
*/

?>
<div id="col-right">
<div class="col-wrap">

<!-- Display a list of the products which have already been created -->
<?php wp_nonce_field(); ?>
<?php wp_referer_field(); ?>

<?php
			if (isset($_GET['Page']) and $_GET['DisplayPage'] == "Profuses") {$Page = $_GET['Page'];}
			else {$Page = 1;}

			$Sql = "SELECT * FROM $profuses_table_name ";
				if (isset($_GET['OrderBy']) and $_GET['DisplayPage'] == "Profuses") {$Sql .= "ORDER BY " . $_GET['OrderBy'] . " " . $_GET['Order'] . " ";}
				else {$Sql .= "ORDER BY Profuse_Sidebar_Order ";}
				$Sql .= "LIMIT " . ($Page - 1)*200 . ",200";
				$myrows = $wpdb->get_results($Sql);
				$TotalProfuses = $wpdb->get_results("SELECT Profuse_ID FROM $profuses_table_name");
				$num_rows = $wpdb->num_rows;
				$Number_of_Pages = ceil($num_rows/200);
				$Current_Page_With_Order_By = "admin.php?page=UPCP-options&DisplayPage=Profuses";
				if (isset($_GET['OrderBy'])) {$Current_Page_With_Order_By .= "&OrderBy=" .$_GET['OrderBy'] . "&Order=" . $_GET['Order'];}?>

<form action="admin.php?page=UPCP-options&Action=UPCP_MassDeleteProfuses&DisplayPage=Profuses" method="post">
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
										<?php if ($_GET['OrderBy'] == "Profuse_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Name&Order=ASC'>";} ?>
											  <span><?php _e("Profuse Name", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Profuse_Slug" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Slug&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Slug&Order=ASC'>";} ?>
											  <span><?php _e("Profuse Slug", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Profuse_Description" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Description&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Description&Order=ASC'>";} ?>
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
										<?php if ($_GET['OrderBy'] == "Profuse_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Name&Order=ASC'>";} ?>
											  <span><?php _e("Profuse Name", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Profuse_Slug" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Slug&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Slug&Order=ASC'>";} ?>
											  <span><?php _e("Profuse Slug", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Profuse_Description" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Description&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Profuses&OrderBy=Profuse_Description&Order=ASC'>";} ?>
											  <span><?php _e("Description", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
				</tr>
		</tfoot>

	<tbody id="the-list" class='list:tag'>

		 <?php
				if ($myrows) {
	  			  foreach ($myrows as $Profuse) {
								echo "<tr id='field-item-" . $Profuse->Profuse_ID ."' class='custom-field-list-item'>";
								echo "<th scope='row' class='check-column'>";
								echo "<input type='checkbox' name='Profuses_Bulk[]' value='" . $Profuse->Profuse_ID ."' />";
								echo "</th>";
								echo "<td class='name column-name'>";
								echo "<strong>";
								echo "<a class='row-title' href='admin.php?page=UPCP-options&Action=UPCP_Profuse_Details&Selected=Profuse&Profuse_ID=" . $Profuse->Profuse_ID ."' title='Edit " . $Profuse->Profuse_Name . "'>" . $Profuse->Profuse_Name . "</a></strong>";
								echo "<br />";
								echo "<div class='row-actions'>";
								echo "<span class='delete'>";
								echo "<a class='delete-tag' href='admin.php?page=UPCP-options&Action=UPCP_DeleteProfuse&DisplayPage=Profuses&Profuse_ID=" . $Profuse->Profuse_ID ."'>" . __("Delete", 'UPC_MC') . "</a>";
		 						echo "</span>";
								echo "</div>";
								echo "<div class='hidden' id='inline_" . $Profuse->Profuse_ID ."'>";
								echo "<div class='name'>" . $Profuse->Profuse_Name . "</div>";
								echo "</div>";
								echo "</td>";
								echo "<td class='description column-slug'>" . $Profuse->Profuse_Slug . "</td>";
								echo "<td class='description column-description'>" . substr($Profuse->Profuse_Description, 0, 60);
								if (strlen($Profuse->Profuse_Description) > 60) {echo "...";}
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
<h2><?php _e("Add New Profuse", 'UPC_MC') ?></h2>
<!-- Form to create a new field -->
<form id="addtag" method="post" action="admin.php?page=UPCP-options&Action=UPCP_AddProfuse&DisplayPage=Profuses" class="validate" enctype="multipart/form-data">
<input type="hidden" name="action" value="Add_Profuse" />
<?php wp_nonce_field('UPCP_Element_Nonce', 'UPCP_Element_Nonce'); ?>
<?php wp_referer_field(); ?>
<div class="form-field form-required">
	<label for="Profuse_Name"><?php _e("Name", 'UPC_MC') ?></label>
	<input name="Profuse_Name" id="Profuse_Name" type="text" value="" size="60" />
	<p><?php _e("The name of the field you will see.", 'UPC_MC') ?></p>
</div>
<div class="form-field form-required">
	<label for="Profuse_Slug"><?php _e("Slug", 'UPC_MC') ?></label>
	<input name="Profuse_Slug" id="Profuse_Slug" type="text" value="" size="60" />
	<p><?php _e("An all-lowercase name that will be used to insert the field.", 'UPC_MC') ?></p>
</div>
<div class="form-field">
	<label for="Profuse_Description"><?php _e("Description", 'UPC_MC') ?></label>
	<textarea name="Profuse_Description" id="Profuse_Description" rows="2" cols="40"></textarea>
	<p><?php _e("The description of the field, which you will see as the instruction for the field.", 'UPC_MC') ?></p>
</div>
<div class="form-field">
	<label for="Profuse_Image"><?php _e("Image", 'UPC_MC') ?></label>
	<input id="Profuse_Image" type="text" size="36" name="Profuse_Image" value="<?php echo $Profuse->Profuse_Image;?>" /> 
	<input id="Profuse_Image_Button" class="button" type="button" value="Upload Image" />
	<p><?php _e("An image that will be displayed in association with this Profuse, if that option is selected in the 'Options' tab. Current Image:", 'UPC_MC') ?><br/><img class="PreviewImage" height="100" width="100" src="<?php echo $Profuse->Profuse_Image;?>" /></p>
	<div class='clear'></div>
</div>

<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Add New Field', 'UPC_MC') ?>"  /></p></form>

</div>

<br class="clear" />
</div>
</div><!-- /col-left -->


<?php 
/*
$items = $wpdb->get_results("SELECT Item_ID, Profuse_Name FROM cms_wp_UPCP_Items ");
foreach ($items as $item){
	if ($item->Profuse_Name !=""){
		$Profuse = $wpdb->get_results("SELECT Profuse_ID, Profuse_Name FROM $profuses_table_name WHERE Profuse_Name = '". $item->Profuse_Name ."' ");
		$Profuse = array_shift ($Profuse);
		$wpdb->insert('cms_wp_UPCP_Profuses_Meta',
				array( 'Profuse_ID' => $Profuse->Profuse_ID,
						'Item_ID' => $item->Item_ID,
						'Meta_Value' => $Profuse->Profuse_Name)
		);
	}
	echo "<br>Item_ID: ". $item->Item_ID ." Profuse_Name: ". $item->Profuse_Name." Profuse_NameNew: ". $Profuse->Profuse_Name;
}
*/

 ?>
