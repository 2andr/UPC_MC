<div class="ewd-upcp-admin-products-table-full">
<div class="col-wrap">

<div class="ewd-upcp-admin-new-product-page-top-part">
	<div class="ewd-upcp-admin-new-product-page-top-part-left">
		<h3 class="ewd-upcp-admin-new-tab-headings"><?php _e('Add New Product', 'UPC_MC'); ?></h3>	
		<div class="ewd-upcp-admin-add-new-product-buttons-area">
			<a href="admin.php?page=UPCP-options&Action=UPCP_Add_Product_Screen" class="button-primary ewd-upcp-admin-add-new-product-button" id="ewd-upcp-admin-manually-add-product-button"><?php _e('Manually', 'UPC_MC'); ?></a>
			<div class="button-primary ewd-upcp-admin-add-new-product-button" id="ewd-upcp-admin-add-by-spreadsheet-button"><?php _e('From Spreadsheet', 'UPC_MC'); ?></div>
		</div>
	</div>
	<div class="ewd-upcp-admin-new-product-page-top-part-right">
		<h3 class="ewd-upcp-admin-new-tab-headings"><?php _e('Export Products to Spreasheet', 'UPC_MC'); ?></h3>	
		<div class="ewd-upcp-admin-export-buttons-area">
			<?php if($Full_Version == 'Yes'){ ?>
				<form method="post" action="admin.php?page=UPCP-options&Action=UPCP_ExportToExcel&FileType=CSV">
					<input type="submit" name="Export_Submit" class="button button-secondary ewd-upcp-admin-export-button" value="<?php _e('Export to CSV', 'UPC_MC'); ?>"  />
				</form>
				<form method="post" action="admin.php?page=UPCP-options&Action=UPCP_ExportToExcel">
					<input type="submit" name="Export_Submit" class="button button-secondary ewd-upcp-admin-export-button" value="<?php _e('Export to Excel', 'UPC_MC'); ?>"  />
				</form>
			<?php } else{
				_e("The full version of the Ultimate Product Catalog Plugin is required to export products.", 'UPC_MC'); ?><br /><a href="https://www.etoilewebdesign.com/plugins/ultimate-product-catalog/#buy" target="_blank"><?php _e("Please upgrade to unlock this feature!", 'UPC_MC'); ?></a>
			<?php } ?>
		</div>
	</div>
</div>

<!-- Display a list of the products which have already been created -->
<?php wp_nonce_field(); ?>
<?php wp_referer_field(); ?>

<?php
	$user = get_current_user_id();
	$screen = get_current_screen();
	$screen_option = $screen->get_option('per_page', 'option');
	$per_page = get_user_meta($user, $screen_option, true);

	if (empty($per_page) or is_array($per_page) or $per_page < 1 ) {
		$per_page = $screen->get_option('per_page', 'default');
	}

			$Categories = $wpdb->get_results("SELECT * FROM $categories_table_name ORDER BY Category_Sidebar_Order, Category_Name");
			$SubCategories = $wpdb->get_results("SELECT * FROM $subcategories_table_name ORDER BY SubCategory_Sidebar_Order,SubCategory_Name");

			if (isset($_GET['Page']) and $_GET['DisplayPage'] == "Products") {$Page = $_GET['Page'];}
			else {$Page = 1;}
			if ($Page < 1 or !is_numeric($Page)) {$Page = 1;}
			$wpdb->show_errors();
			$Sql = "SELECT * FROM $items_table_name WHERE 1=1 ";
				if (isset($_REQUEST['ItemName'])) {$Sql .= "AND Item_Name LIKE '%" . sanitize_text_field($_REQUEST['ItemName']) . "%' ";}
				if (isset($_REQUEST['UPCP_Category_Filter']) and $_REQUEST['UPCP_Category_Filter'] != "All") {$Sql .= "AND Category_ID='" . sanitize_text_field($_REQUEST['UPCP_Category_Filter']) . "' ";}
				if (isset($_REQUEST['UPCP_SubCategory_Filter']) and $_REQUEST['UPCP_SubCategory_Filter'] != "All") {$Sql .= "AND SubCategory_ID='" . sanitize_text_field($_REQUEST['UPCP_SubCategory_Filter']) . "' ";}
				if (isset($_GET['OrderBy']) and $_GET['DisplayPage'] == "Products") {$Sql .= "ORDER BY " . sanitize_text_field($_GET['OrderBy']) . " ";}
				else {$Sql .= "ORDER BY Item_Date_Created ";}
				if (isset($_GET['OrderBy']) and $_GET['DisplayPage'] == "Products" and $_GET['OrderBy'] == "Item_Price") {$Sql .= "* 1 ";}
				if (isset($_GET['Order'])) {$Sql .= sanitize_text_field($_GET['Order']) . " ";}
				$Product_Count_Sql = $Sql;
				$Sql .= "LIMIT " . (($Page - 1) * $per_page) . "," . $per_page;
				$myrows = $wpdb->get_results($Sql);
				$TotalProducts = $wpdb->get_results($Product_Count_Sql);
				$num_rows = $wpdb->num_rows;
				$Number_of_Pages = ceil($num_rows/$per_page);
				$Current_Page = "admin.php?page=UPCP-options&DisplayPage=Products";
				if (isset($_REQUEST['ItemName'])) {$Current_Page_With_Name_Search = $Current_Page . "&ItemName=" . sanitize_text_field($_REQUEST['ItemName']);}
				else {$Current_Page_With_Name_Search = $Current_Page;}
				if (isset($_REQUEST['UPCP_Category_Filter']) and $_REQUEST['UPCP_Category_Filter'] != "All") {$Current_Page_With_Cats = $Current_Page_With_Name_Search . "&UPCP_Category_Filter=" . sanitize_text_field($_REQUEST['UPCP_Category_Filter']);}
				else {$Current_Page_With_Cats = $Current_Page_With_Name_Search;}
				if (isset($_REQUEST['UPCP_SubCategory_Filter']) and $_REQUEST['UPCP_SubCategory_Filter'] != "All") {$Current_Page_With_SubCats = $Current_Page_With_Cats . "&UPCP_SubCategory_Filter=" . sanitize_text_field($_REQUEST['UPCP_SubCategory_Filter']);}
				else {$Current_Page_With_SubCats = $Current_Page_With_Cats;}
				if (isset($_GET['OrderBy'])) {$Current_Page_With_Order_By .= $Current_Page_With_SubCats . "&OrderBy=" .$_GET['OrderBy'] . "&Order=" . sanitize_text_field($_GET['Order']);}
				else {$Current_Page_With_Order_By = $Current_Page_With_SubCats;}
?>

<form action="<?php echo $Current_Page; ?>" method="post">
<p class="search-box">
	<label class="screen-reader-text" for="post-search-input">Search Products:</label>
	<input type="search" id="post-search-input" name="ItemName" value="">
	<input type="submit" name="" id="search-submit" class="button" value="Search Products">
</p>
</form>

<div class="alignleft actions">
			<form action="<?php echo $Current_Page_With_Name_Search; ?>" method="post">
				<select name='UPCP_Category_Filter'>
					<option value='All'><?php _e("All Categories", 'UPC_MC'); ?></option>
					<?php
						if (!isset($_REQUEST['UPCP_Category_Filter'])){$_REQUEST['UPCP_Category_Filter'] = "";}
						foreach ($Categories as $Category) {
							echo "<option value='" . $Category->Category_ID . "' ";
							if ($_REQUEST['UPCP_Category_Filter'] == $Category->Category_ID) {echo "selected=selected";}
							echo ">" . $Category->Category_Name . "</option>";
						}
					?>
				</select>
				<select name='UPCP_SubCategory_Filter'>
					<option value='All'><?php _e("All Sub-Categories", 'UPC_MC'); ?></option>
					<?php
						if (!isset($_REQUEST['UPCP_SubCategory_Filter'])){$_REQUEST['UPCP_SubCategory_Filter'] = "";}
						foreach ($SubCategories as $SubCategory) {
							echo "<option value='" . $SubCategory->SubCategory_ID . "' ";
							if ($_REQUEST['UPCP_SubCategory_Filter'] == $SubCategory->SubCategory_ID) {echo "selected=selected";}
							echo ">" . $SubCategory->SubCategory_Name . "</option>";
						}
					?>
				</select>
				<input type="submit" name="" id="search-submit" class="button-secondary action" value="<?php _e('Filter', 'UPC_MC'); ?>">
			</form>
		</div>

<form action="admin.php?page=UPCP-options&Action=UPCP_MassDeleteProducts&DisplayPage=Products" method="post">
<div class="tablenav top">
		<div class="alignleft actions">
				<select name='action'>
  					<option value='-1' selected='selected'><?php _e("Bulk Actions", 'UPC_MC') ?></option>
						<option value='delete'><?php _e("Delete", 'UPC_MC') ?></option>
				</select>
				<input type="submit" name="" id="doaction" class="button-secondary action" value="<?php _e('Apply', 'UPC_MC') ?>"  />
				<a class='confirm button-secondary action ewd-upcp-admin-delete-all-products-button' href='admin.php?page=UPCP-options&Action=UPCP_DeleteAllProducts&DisplayPage=Products'>Delete All Products</a>
		</div>
		<div class='tablenav-pages <?php if ($Number_of_Pages <= 1) {echo "one-page";} ?>'>
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

<table class="wp-list-table striped widefat fixed tags sorttable" cellspacing="0">
		<thead>
				<tr>
						<th scope='col' id='cb' class='manage-column column-cb check-column'  style="">
								<input type="checkbox" /></th><th scope='col' id='name' class='manage-column column-name sortable desc'  style="">
										<?php if ($_GET['OrderBy'] == "Item_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Name&Order=ASC'>";} ?>
											  <span><?php _e("Name", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Item_Description" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Description&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Description&Order=ASC'>";} ?>
											  <span><?php _e("Description", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='requirements' class='manage-column column-requirements sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Item_Price" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Price&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Price&Order=ASC'>";} ?>
											  <span><?php _e("Price", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='users' class='manage-column column-users sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Category_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Category_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Category_Name&Order=ASC'>";} ?>
											  <span><?php _e("Category", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='enabled' class='manage-column column-users sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "SubCategory_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=SubCategory_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=SubCategory_Name&Order=ASC'>";} ?>
											  <span><?php _e("Sub-Category", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='enabled' class='manage-column column-users sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Item_Views" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Views&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Views&Order=ASC'>";} ?>
											  <span><?php _e("# of Views", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th>
						</th>
				</tr>
		</thead>

		<tfoot>
				<tr>
						<th scope='col' id='cb' class='manage-column column-cb check-column'  style="">
								<input type="checkbox" /></th><th scope='col' id='name' class='manage-column column-name sortable desc'  style="">
										<?php if ($_GET['OrderBy'] == "Item_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Name&Order=ASC'>";} ?>
											  <span><?php _e("Name", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='description' class='manage-column column-description sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Item_Description" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Description&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Description&Order=ASC'>";} ?>
											  <span><?php _e("Description", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='requirements' class='manage-column column-requirements sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Item_Price" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Price&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Price&Order=ASC'>";} ?>
											  <span><?php _e("Price", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='users' class='manage-column column-users sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Category_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Category_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Category_Name&Order=ASC'>";} ?>
											  <span><?php _e("Category", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='enabled' class='manage-column column-users sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "SubCategory_Name" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=SubCategory_Name&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=SubCategory_Name&Order=ASC'>";} ?>
											  <span><?php _e("Sub-Category", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th scope='col' id='enabled' class='manage-column column-users sortable desc'  style="">
									  <?php if ($_GET['OrderBy'] == "Item_Views" and $_GET['Order'] == "ASC") { echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Views&Order=DESC'>";}
										 			else {echo "<a href='admin.php?page=UPCP-options&DisplayPage=Products&OrderBy=Item_Views&Order=ASC'>";} ?>
											  <span><?php _e("# of Views", 'UPC_MC') ?></span>
												<span class="sorting-indicator"></span>
										</a>
						</th>
						<th>
						</th>
				</tr>
		</tfoot>

	<tbody id="the-list" class='list:tag'>

		 <?php
				if ($myrows) {
	  			  foreach ($myrows as $Item) {
								echo "<tr id='Item" . $Item->Item_ID ."'>";
								echo "<th scope='row' class='check-column'>";
								echo "<input type='checkbox' name='Products_Bulk[]' value='" . $Item->Item_ID ."' />";
								echo "</th>";
								echo "<td class='name column-name'>";
								echo "<strong>";
								echo "<a class='row-title' href='admin.php?page=UPCP-options&Action=UPCP_Item_Details&Selected=Product&Item_ID=" . $Item->Item_ID ."' title='Edit " . $Item->Item_Name . "'>" . $Item->Item_Name . "</a></strong>";
								echo "<br />";
								echo "<div class='row-actions'>";
								/*echo "<span class='edit'>";
								echo "<a href='admin.php?page=UPCP-options&Action=UPCP_Item_Details&Selected=Product&Item_ID=" . $Item->Item_ID ."'>Edit</a>";
		 						echo " | </span>";*/
								echo "<span class='delete'>";
								echo "<a class='delete-tag' href='admin.php?page=UPCP-options&Action=UPCP_DeleteProduct&DisplayPage=Products&Item_ID=" . $Item->Item_ID ."'>" . __("Delete", 'UPC_MC') . "</a>";
		 						echo "</span>";
								echo "</div>";
								echo "<div class='hidden' id='inline_" . $Item->Item_ID ."'>";
								echo "<div class='name'>" . strip_tags($Item->Item_Name) . "</div>";
								echo "</div>";
								echo "</td>";
								echo "<td class='description column-description'>" . strip_tags(substr($Item->Item_Description, 0, 60));
								if (strlen($Item->Item_Description) > 60) {echo "...";}
								echo "</td>";
								echo "<td class='description column-price'>" . $Item->Item_Price . "</td>";
								echo "<td class='users column-category'>" . strip_tags($Item->Category_Name) . "</td>";
								echo "<td class='users column-subcategory'>" . strip_tags($Item->SubCategory_Name) . "</td>";
								echo "<td class='users column-item-views'>" . $Item->Item_Views . "</td>";
								echo "<td class='column-duplicate-product'><a href='admin.php?page=UPCP-options&Action=UPCP_Duplicate_Product&Selected=Product&Item_ID=" . $Item->Item_ID ."'>" . __('Duplicate Product', 'UPC_MC') . "</a></td>"; 
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
		<div class='tablenav-pages <?php if ($Number_of_Pages <= 1) {echo "one-page";} ?>'>
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

