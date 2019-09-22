<?php if ($Full_Version == "Yes") { ?>
<div id="col-right">
<div class="col-wrap">

<!-- Display a list of the products which have already been created -->
<?php wp_nonce_field(); ?>
<?php wp_referer_field(); ?>

<?php
			if (isset($_GET['Page']) and $_GET['DisplayPage'] == "CustomFields") {$Page = $_GET['Page'];}
			else {$Page = 1;}

			$Sql = "SELECT * FROM $fields_table_name ";
				if (isset($_GET['OrderBy']) and $_GET['DisplayPage'] == "CustomFields") {$Sql .= "ORDER BY " . $_GET['OrderBy'] . " " . $_GET['Order'] . " ";}
				else {$Sql .= "ORDER BY Field_Sidebar_Order ";}
				$Sql .= "LIMIT " . ($Page - 1)*200 . ",200";
				$myrows = $wpdb->get_results($Sql);
				$TotalFields = $wpdb->get_results("SELECT Field_ID FROM $fields_table_name");
				$num_rows = $wpdb->num_rows;
				$Number_of_Pages = ceil($num_rows/200);
				$Current_Page_With_Order_By = "admin.php?page=UPCP-options&DisplayPage=CustomFields";
				if (isset($_GET['OrderBy'])) {$Current_Page_With_Order_By .= "&OrderBy=" .$_GET['OrderBy'] . "&Order=" . $_GET['Order'];}?>

<form action="admin.php?page=UPCP-options&Action=UPCP_MassDeleteCustomFields&DisplayPage=CustomFields" method="post">
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
										<?php if ($_GET['OrderBy'] == "Field_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Name&Order=ASC'>";} ?>
											  <span><?php _e("Field Name", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Field_Slug" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Slug&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Slug&Order=ASC'>";} ?>
											  <span><?php _e("Field Slug", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='type' class='manage-column column-type sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Field_Type" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Type&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Type&Order=ASC'>";} ?>
											  <span><?php _e("Type", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Field_Description" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Description&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Description&Order=ASC'>";} ?>
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
										<?php if ($_GET['OrderBy'] == "Field_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Name&Order=ASC'>";} ?>
											  <span><?php _e("Field Name", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Field_Slug" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Slug&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Slug&Order=ASC'>";} ?>
											  <span><?php _e("Field Slug", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='type' class='manage-column column-type sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Field_Type" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Type&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Type&Order=ASC'>";} ?>
											  <span><?php _e("Type", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Field_Description" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Description&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=CustomFields&OrderBy=Field_Description&Order=ASC'>";} ?>
											  <span><?php _e("Description", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
				</tr>
		</tfoot>

	<tbody id="the-list" class='list:tag'>

		 <?php
				if ($myrows) {
	  			  foreach ($myrows as $Field) {
								echo "<tr id='field-item-" . $Field->Field_ID ."' class='custom-field-list-item'>";
								echo "<th scope='row' class='check-column'>";
								echo "<input type='checkbox' name='Fields_Bulk[]' value='" . $Field->Field_ID ."' />";
								echo "</th>";
								echo "<td class='name column-name'>";
								echo "<strong>";
								echo "<a class='row-title' href='admin.php?page=UPCP-options&Action=UPCP_Field_Details&Selected=CustomField&Field_ID=" . $Field->Field_ID ."' title='Edit " . $Field->Field_Name . "'>" . $Field->Field_Name . "</a></strong>";
								echo "<br />";
								echo "<div class='row-actions'>";
								echo "<span class='delete'>";
								echo "<a class='delete-tag' href='admin.php?page=UPCP-options&Action=UPCP_DeleteCustomField&DisplayPage=CustomFields&Field_ID=" . $Field->Field_ID ."'>" . __("Delete", 'UPC_MC') . "</a>";
		 						echo "</span>";
								echo "</div>";
								echo "<div class='hidden' id='inline_" . $Field->Field_ID ."'>";
								echo "<div class='name'>" . $Field->Field_Name . "</div>";
								echo "</div>";
								echo "</td>";
								echo "<td class='description column-slug'>" . $Field->Field_Slug . "</td>";
								echo "<td class='description column-type'>" . $Field->Field_Type . "</td>";
								echo "<td class='description column-description'>" . substr($Field->Field_Description, 0, 60);
								if (strlen($Field->Field_Description) > 60) {echo "...";}
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
<h2><?php _e("Add New Field", 'UPC_MC') ?></h2>
<!-- Form to create a new field -->
<form id="addtag" method="post" action="admin.php?page=UPCP-options&Action=UPCP_AddCustomField&DisplayPage=CustomFields" class="validate" enctype="multipart/form-data">
<input type="hidden" name="action" value="Add_Custom_Field" />
<?php wp_nonce_field('UPCP_Element_Nonce', 'UPCP_Element_Nonce'); ?>
<?php wp_referer_field(); ?>
<div class="form-field form-required">
	<label for="Field_Name"><?php _e("Name", 'UPC_MC') ?></label>
	<input name="Field_Name" id="Field_Name" type="text" value="" size="60" />
	<p><?php _e("The name of the field you will see.", 'UPC_MC') ?></p>
</div>
<div class="form-field form-required">
	<label for="Field_Slug"><?php _e("Slug", 'UPC_MC') ?></label>
	<input name="Field_Slug" id="Field_Slug" type="text" value="" size="60" />
	<p><?php _e("An all-lowercase name that will be used to insert the field.", 'UPC_MC') ?></p>
</div>
<div class="form-field">
	<label for="Field_Type"><?php _e("Type", 'UPC_MC') ?></label>
	<select name="Field_Type" id="Field_Type">
			<option value='text'><?php _e("Short Text", 'UPC_MC') ?></option>
			<option value='mediumint'><?php _e("Integer", 'UPC_MC') ?></option>
			<option value='link'><?php _e("Link", 'UPC_MC') ?></option>
			<option value='select'><?php _e("Select Box", 'UPC_MC') ?></option>
			<option value='radio'><?php _e("Radio Button", 'UPC_MC') ?></option>
			<option value='checkbox'><?php _e("Checkbox", 'UPC_MC') ?></option>
			<option value='textarea'><?php _e("Text Area", 'UPC_MC') ?></option>
			<option value='file'><?php _e("File", 'UPC_MC') ?></option>
			<option value='date'><?php _e("Date", 'UPC_MC') ?></option>
			<option value='datetime'><?php _e("Date/Time", 'UPC_MC') ?></option>
	</select>
	<p><?php _e("The input method for the field and type of data that the field will hold.", 'UPC_MC') ?></p>
</div>
<div class="form-field">
	<label for="Field_Description"><?php _e("Description", 'UPC_MC') ?></label>
	<textarea name="Field_Description" id="Field_Description" rows="2" cols="40"></textarea>
	<p><?php _e("The description of the field, which you will see as the instruction for the field.", 'UPC_MC') ?></p>
</div>
<div>
		<label for="Field_Values"><?php _e("Input Values", 'UPC_MC') ?></label>
		<input name="Field_Values" id="Field_Values" type="text" />
		<p><?php _e("A comma-separated list of acceptable input values for this field. These values will be the options for select, checkbox, and radio inputs. All values will be accepted if left blank.", 'UPC_MC') ?></p>
</div>
<div class="form-field">
	<label for="Field_Displays"><?php _e("Display?", 'UPC_MC') ?></label>
	<select name="Field_Displays" id="Field_Displays">
			<option value='none'><?php _e("None", 'UPC_MC') ?></option>
			<option value='thumbs'><?php _e("Thumbnail View", 'UPC_MC') ?></option>
			<option value='list'><?php _e("List View", 'UPC_MC') ?></option>
			<option value='details'><?php _e("Details View", 'UPC_MC') ?></option>
			<option value='both'><?php _e("All", 'UPC_MC') ?></option>
	</select>
	<p><?php _e("Should this field be displayed in any of the main catalog pages?", 'UPC_MC') ?></p>
</div>

<div class="form-field">
	<label for="Field_Searchable"><?php _e("Searchable?", 'UPC_MC') ?></label>
	<input type='radio' name='Field_Searchable' value='No' checked='checked' /><span><?php _e("No", 'UPC_MC')?></span><br />	
	<input type='radio' name='Field_Searchable' value='Yes' /><span><?php _e("Yes", 'UPC_MC')?></span><br />
	<p><?php _e("Should this field be searchable in your catalogs?", 'UPC_MC') ?></p>
</div>

<div class="form-field upcp-hidden" id="ewd-upcp-admin-cf-control-type">
	<label for="Field_Control_Type"><?php _e("Control Type", 'UPC_MC') ?></label>
	<select name="Field_Control_Type" id="Field_Control_Type">
			<option value='Checkbox'><?php _e("Checkbox", 'UPC_MC') ?></option>
			<option value='Radio'><?php _e("Radio", 'UPC_MC') ?></option>
			<option value='Dropdown'><?php _e("Dropdown", 'UPC_MC') ?></option>
			<option value='Slider'><?php _e("Slider (Only works for integer type fields)", 'UPC_MC') ?></option>
	</select>
	<p><?php _e("What type of control should this field use in the sidebar if it's searchable?", 'UPC_MC') ?></p>
</div>

<div class="form-field">
	<label for="Field_Display_Tabbed"><?php _e("Display in Tabbed Layout?", 'UPC_MC') ?></label>
	<input type='radio' name='Field_Display_Tabbed' value='No' checked='checked' /><span><?php _e("No", 'UPC_MC')?></span><br />	
	<input type='radio' name='Field_Display_Tabbed' value='Yes' /><span><?php _e("Yes", 'UPC_MC')?></span><br />
	<p><?php _e("Should this field be displayed in the 'Additional Information' area of the tabbed view?", 'UPC_MC') ?></p>
</div>

<div class="form-field">
	<label for="Field_Display_Comparison"><?php _e("Display in Product Comparison?", 'UPC_MC') ?></label>
	<input type='radio' name='Field_Display_Comparison' value='No' checked='checked' /><span><?php _e("No", 'UPC_MC')?></span><br />	
	<input type='radio' name='Field_Display_Comparison' value='Yes' /><span><?php _e("Yes", 'UPC_MC')?></span><br />
	<p><?php _e("Should this field be displayed when visitors do a product comparison (in product comparison is enabled)?", 'UPC_MC') ?></p>
</div>

<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Add New Field', 'UPC_MC') ?>"  /></p></form>

</div>

<br class="clear" />
</div>
</div><!-- /col-left -->


<?php } else { ?>
<div class="Info-Div">
		<h2><?php _e("Full Version Required!", 'UPC_MC') ?></h2>
		<div class="upcp-full-version-explanation">
				<?php _e("The full version of the Ultimate Product Catalog Plugin is required to use custom fields.", 'UPC_MC');?><a href="http://www.etoilewebdesign.com/UPC_MC-plugin/"><?php _e(" Please upgrade to unlock this page!", 'UPC_MC'); ?></a>
		</div>
</div>
<?php } ?>
