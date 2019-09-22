<?PHP
/* Adds a single new custom field to the UPCP database */
function Add_UPCP_Maker($Maker_Name, $Maker_Slug, $Maker_Description, $Maker_Lat, $Maker_Lng, $Maker_Addr, $Maker_Site, $Maker_Phone, $Maker_Image, $WC_Update = "No", $Maker_WC_ID = 0) {
	global $wpdb;
	global $makers_table_name;
	global $Full_Version;

	$WooCommerce_Sync = get_option("UPCP_WooCommerce_Sync");

	$Date = date("Y-m-d H:i:s");

	if ($Full_Version != "Yes") {exit();}
	$wpdb->insert($makers_table_name,
		array(
			'Maker_Name' => $Maker_Name,
			'Maker_Slug' => $Maker_Slug,
			'Maker_Description' => $Maker_Description,
			'Maker_Lat' => $Maker_Lat,
			'Maker_Lng' => $Maker_Lng,
			'Maker_Addr' => $Maker_Addr,
			'Maker_Site' => $Maker_Site,
			'Maker_Phone' => $Maker_Phone,
			'Maker_Image' => $Maker_Image,
			'Maker_Date_Created' => $Date,
			'Maker_WC_ID' => $Maker_WC_ID
		)
	);
	$Maker_ID = $wpdb->insert_id;

	/* wooCommerce integration
	if ($WooCommerce_Sync == "Yes" and $WC_Update != "Yes") {UPCP_Add_Maker_To_WC($wpdb->get_row($wpdb->prepare("SELECT * FROM $makers_table_name WHERE Maker_ID=%d", $wpdb->insert_id)));}
	elseif ($WooCommerce_Sync == "Yes") {
		foreach ($Term_ID_For_Value as $Term_ID => $Value) {
			update_term_meta($Term_ID, 'upcp_term_value', $Value);
			update_term_meta($Term_ID, 'upcp_term_MK_ID', $Maker_ID);
		}
	}
	*/

	$update = __("Maker has been successfully created.", 'UPC_MC');
	return $update;
}

/* Edits a single custom field with a given ID in the UPCP database */
function  Edit_UPCP_Maker($Maker_ID, $Maker_Name, $Maker_Slug, $Maker_Description, $Maker_Lat, $Maker_Lng, $Maker_Addr, $Maker_Site, $Maker_Phone, $Maker_Image, $WC_Update = "No", $Maker_WC_ID = 0, $Replace_Values = array()) {
	global $wpdb;
	global $makers_table_name;
	global $makers_meta_table_name;
	global $Full_Version;

	$WooCommerce_Sync = get_option("UPCP_WooCommerce_Sync");
	//$Current_Values = $wpdb->get_var($wpdb->prepare("SELECT Maker_Values FROM $makers_table_name WHERE Maker_ID=%d", $Maker_ID));

	if ($Full_Version != "Yes") {exit();}
	$wpdb->update(
		$makers_table_name,
		array(
			'Maker_Name' => $Maker_Name,
			'Maker_Slug' => $Maker_Slug,
			'Maker_Description' => $Maker_Description,
			'Maker_Lat' => $Maker_Lat,
			'Maker_Lng' => $Maker_Lng,
			'Maker_Addr' => $Maker_Addr,
			'Maker_Site' => $Maker_Site,
			'Maker_Phone' => $Maker_Phone,
			'Maker_Image' => $Maker_Image,
			'Maker_WC_ID' => $Maker_WC_ID),
		array( 'Maker_ID' => $Maker_ID)
	);

	/* wooCommerce integration
	if ($WooCommerce_Sync == "Yes" and $WC_Update != "Yes") {UPCP_Edit_Maker_To_WC($wpdb->get_row($wpdb->prepare("SELECT * FROM $makers_table_name WHERE Maker_ID=%d", $Maker_ID)), $Current_Values);}
	elseif ($WooCommerce_Sync == "Yes" and !empty($Replace_Values)) {
		foreach ($Replace_Values as $Current => $Term_ID) {
			$Term_Value = $wpdb->query($wpdb->prepare("SELECT name FROM $wpdb->terms WHERE term_id=%d", $Term_ID));
			$wpdb->query($wpdb->prepare("UPDATE $makers_meta_table_name SET Meta_Value=(Meta_Value, %s, %s) WHERE (Meta_Value LIKE '%s' OR Meta_Value LIKE '%s,%' OR Meta_Value LIKE '%,%s,%' OR Meta_Value LIKE '%,%s')", $Current, $Term_Value, $Current, $Current, $Current, $Current));
		}
	}
	elseif ($WooCommerce_Sync == "Yes") {
		foreach ($Term_ID_For_Value as $Term_ID => $Value) {
			update_term_meta($Term_ID, 'upcp_term_value', $Value);
			update_term_meta($Term_ID, 'upcp_term_CF_ID', $Maker_ID);
		}
	}
	*/
	
	$update = __("Maker has been successfully edited.", 'UPC_MC');
	return $update;
}


/* Deletes a single tag with a given ID in the UPCP database, and then eliminates
*  all of the occurrences of that tag from the tagged items table.  */
function Delete_UPCP_Maker($Maker_ID) {
	global $wpdb;
	global $makers_table_name;
	global $Full_Version;

	if ($Full_Version != "Yes") {exit();}
	$wpdb->delete(
		$makers_table_name,
		array('Maker_ID' => $Maker_ID)
	);

	$update = __("Maker has been successfully deleted.", 'UPC_MC');
	return $update;
}

// Вызвать из функции Update_UPCP_Options в Update_Admin_Databases
function Update_UPCP_Options_Makers() {
	global $Full_Version;


	if ($Full_Version == "Yes" and isset($_POST['makers_show_hide'])) {update_option("UPCP_Makers_Show_Hide", $_POST['makers_show_hide']);}
	if ($Full_Version == "Yes" and isset($_POST['makers_blank'])) {update_option("UPCP_Makers_Blank", $_POST['makers_blank']);}
	if ($Full_Version == "Yes" and isset($_POST['makers_label'])) {update_option("UPCP_Makers_Label", $_POST['makers_label']);}
	if ($Full_Version == "Yes" and isset($_POST['makerscard_label'])) {update_option("UPCP_MakersCard_Label", $_POST['makerscard_label']);}
	if (isset($_POST['display_makers_in_thumbnails'])) {update_option("UPCP_Display_makers_In_Thumbnails", $_POST['display_makers_in_thumbnails']);}

	if (isset($_POST['Sidebar_Items_Order_Product_Sort'])) {
		$Sidebar_Items_Order[$_POST['Sidebar_Items_Order_Makers']] = "Makers";

	}

	if ($Full_Version == "Yes" and isset($_POST['profuses_show_hide'])) {update_option("UPCP_Profuses_Show_Hide", $_POST['profuses_show_hide']);}
	if ($Full_Version == "Yes" and isset($_POST['profuses_blank'])) {update_option("UPCP_Profuses_Blank", $_POST['profuses_blank']);}
	if ($Full_Version == "Yes" and isset($_POST['profuses_label'])) {update_option("UPCP_Profuses_Label", $_POST['profuses_label']);}
	if ($Full_Version == "Yes" and isset($_POST['profusescard_label'])) {update_option("UPCP_ProfusesCard_Label", $_POST['profusescard_label']);}
	if (isset($_POST['display_profuses_in_thumbnails'])) {update_option("UPCP_Display_profuses_In_Thumbnails", $_POST['display_profuses_in_thumbnails']);}

	if (isset($_POST['Sidebar_Items_Order_Product_Sort'])) {
		$Sidebar_Items_Order[$_POST['Sidebar_Items_Order_Profuses']] = "Profuses";

	}

	return $Sidebar_Items_Order;
}

/// profUses section

/* Adds a single new custom field to the UPCP database */
function Add_UPCP_Profuse($Profuse_Name, $Profuse_Slug, $Profuse_Description, $Profuse_Image, $WC_Update = "No", $Profuse_WC_ID = 0) {
	global $wpdb;
	global $profuses_table_name;
	global $Full_Version;

	$WooCommerce_Sync = get_option("UPCP_WooCommerce_Sync");

	$Date = date("Y-m-d H:i:s");

	if ($Full_Version != "Yes") {exit();}
	$wpdb->insert($profuses_table_name,
		array(
			'Profuse_Name' => $Profuse_Name,
			'Profuse_Slug' => $Profuse_Slug,
			'Profuse_Description' => $Profuse_Description,
			'Profuse_Image' => $Profuse_Image,
			'Profuse_Date_Created' => $Date,
			'Profuse_WC_ID' => $Profuse_WC_ID
		)
	);
	$Profuse_ID = $wpdb->insert_id;

	/* wooCommerce integration
	if ($WooCommerce_Sync == "Yes" and $WC_Update != "Yes") {UPCP_Add_Profuse_To_WC($wpdb->get_row($wpdb->prepare("SELECT * FROM $profuses_table_name WHERE Profuse_ID=%d", $wpdb->insert_id)));}
	elseif ($WooCommerce_Sync == "Yes") {
		foreach ($Term_ID_For_Value as $Term_ID => $Value) {
			update_term_meta($Term_ID, 'upcp_term_value', $Value);
			update_term_meta($Term_ID, 'upcp_term_MK_ID', $Profuse_ID);
		}
	}
	*/

	$update = __("Profuse has been successfully created.", 'UPC_MC');
	return $update;
}

/* Edits a single custom field with a given ID in the UPCP database */
function  Edit_UPCP_Profuse($Profuse_ID, $Profuse_Name, $Profuse_Slug, $Profuse_Description, $Profuse_Image, $WC_Update = "No", $Profuse_WC_ID = 0, $Replace_Values = array()) {
	global $wpdb;
	global $profuses_table_name;
	global $profuses_meta_table_name;
	global $Full_Version;

	$WooCommerce_Sync = get_option("UPCP_WooCommerce_Sync");
	//$Current_Values = $wpdb->get_var($wpdb->prepare("SELECT Profuse_Values FROM $profuses_table_name WHERE Profuse_ID=%d", $Profuse_ID));

	if ($Full_Version != "Yes") {exit();}
	$wpdb->update(
		$profuses_table_name,
		array(
			'Profuse_Name' => $Profuse_Name,
			'Profuse_Slug' => $Profuse_Slug,
			'Profuse_Description' => $Profuse_Description,
			'Profuse_Image' => $Profuse_Image,
			'Profuse_WC_ID' => $Profuse_WC_ID),
		array( 'Profuse_ID' => $Profuse_ID)
	);

	$update = __("Profuse has been successfully edited.", 'UPC_MC');
	return $update;
}


/* Deletes a single tag with a given ID in the UPCP database, and then eliminates
*  all of the occurrences of that tag from the tagged items table.  */
function Delete_UPCP_Profuse($Profuse_ID) {
	global $wpdb;
	global $profuses_table_name;
	global $Full_Version;

	if ($Full_Version != "Yes") {exit();}
	$wpdb->delete(
		$profuses_table_name,
		array('Profuse_ID' => $Profuse_ID)
	);

	$update = __("Profuse has been successfully deleted.", 'UPC_MC');
	return $update;
}

// Вызвать из функции Update_UPCP_Options в Update_Admin_Databases
function Update_UPCP_Options_Profuses($Sidebar_Items_Order) {
	global $Full_Version;


	if ($Full_Version == "Yes" and isset($_POST['profuses_show_hide'])) {update_option("UPCP_Profuses_Show_Hide", $_POST['profuses_show_hide']);}
	if ($Full_Version == "Yes" and isset($_POST['profuses_blank'])) {update_option("UPCP_Profuses_Blank", $_POST['profuses_blank']);}
	if ($Full_Version == "Yes" and isset($_POST['profuses_label'])) {update_option("UPCP_Profuses_Label", $_POST['profuses_label']);}
	if ($Full_Version == "Yes" and isset($_POST['profusescard_label'])) {update_option("UPCP_ProfusesCard_Label", $_POST['profusescard_label']);}
	if (isset($_POST['display_profuses_in_thumbnails'])) {update_option("UPCP_Display_profuses_In_Thumbnails", $_POST['display_profuses_in_thumbnails']);}

	if (isset($_POST['Sidebar_Items_Order_Product_Sort'])) {
		$Sidebar_Items_Order[$_POST['Sidebar_Items_Order_Profuses']] = "Profuses";

	}

	return $Sidebar_Items_Order;
}





?>