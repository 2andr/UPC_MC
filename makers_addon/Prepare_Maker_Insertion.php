<?php

function Add_Edit_Maker() {
		if ( ! isset( $_POST['UPCP_Element_Nonce'] ) ) {return;}

    	if ( ! wp_verify_nonce( $_POST['UPCP_Element_Nonce'], 'UPCP_Element_Nonce' ) ) {return;}

		if (!isset($_POST['Maker_ID'])) { $_POST['Maker_ID'] = ""; }
		/* Process the $_POST data where neccessary before storage */
		$Maker_Name = stripslashes_deep($_POST['Maker_Name']);
		$Maker_Slug = stripslashes_deep($_POST['Maker_Slug']);
		$Maker_Description = stripslashes_deep($_POST['Maker_Description']);
		$Maker_Lat = stripslashes_deep($_POST['Maker_Lat']);
		$Maker_Lng = stripslashes_deep($_POST['Maker_Lng']);
		$Maker_Addr = stripslashes_deep($_POST['Maker_Addr']);
		$Maker_Site = stripslashes_deep($_POST['Maker_Site']);
		$Maker_Phone = stripslashes_deep($_POST['Maker_Phone']);
		$Maker_Image = stripslashes_deep($_POST['Maker_Image']);

		$Maker_ID = (isset($_POST['Maker_ID']) ? $_POST['Maker_ID'] : '');

		if (!isset($error)) {
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to create the  Maker */
				if ($_POST['action'] == "Add_Maker") {
					  $user_update = Add_UPCP_Maker($Maker_Name, $Maker_Slug, $Maker_Description, $Maker_Lat, $Maker_Lng, $Maker_Addr, $Maker_Site, $Maker_Phone, $Maker_Image);
				}
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to edit the Maker */
				else {
						$user_update = Edit_UPCP_Maker($Maker_ID, $Maker_Name, $Maker_Slug, $Maker_Description, $Maker_Lat, $Maker_Lng, $Maker_Addr, $Maker_Site, $Maker_Phone, $Maker_Image);
				}
				$user_update = array("Message_Type" => "Update", "Message" => $user_update);
				return $user_update;
		}
		else {
				$output_error = array("Message_Type" => "Error", "Message" => $error);
				return $output_error;
		}
}

function Mass_Delete_UPCP_Maker() {
		$Makers = $_POST['Makers_Bulk'];

		if (is_array($Makers)) {
				foreach ($Makers as $Maker) {
						if ($Maker != "") {
								Delete_UPCP_Maker($Maker);
						}
				}
		}

		$update = __("Maker(s) have been successfully deleted.", 'UPC_MC');
		$user_update = array("Message_Type" => "Update", "Message" => $update);
		return $user_update;
}


function Add_Edit_Profuse() {
		if ( ! isset( $_POST['UPCP_Element_Nonce'] ) ) {return;}

    	if ( ! wp_verify_nonce( $_POST['UPCP_Element_Nonce'], 'UPCP_Element_Nonce' ) ) {return;}

		if (!isset($_POST['Profuse_ID'])) { $_POST['Profuse_ID'] = ""; }
		/* Process the $_POST data where neccessary before storage */
		$Profuse_Name = stripslashes_deep($_POST['Profuse_Name']);
		$Profuse_Slug = stripslashes_deep($_POST['Profuse_Slug']);
		$Profuse_Description = stripslashes_deep($_POST['Profuse_Description']);
		$Profuse_Image = stripslashes_deep($_POST['Profuse_Image']);

		$Profuse_ID = (isset($_POST['Profuse_ID']) ? $_POST['Profuse_ID'] : '');

		if (!isset($error)) {
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to create the  Profuse */
				if ($_POST['action'] == "Add_Profuse") {
					  $user_update = Add_UPCP_Profuse($Profuse_Name, $Profuse_Slug, $Profuse_Description, $Profuse_Image);
				}
				/* Pass the data to the appropriate function in Update_Admin_Databases.php to edit the Profuse */
				else {
						$user_update = Edit_UPCP_Profuse($Profuse_ID, $Profuse_Name, $Profuse_Slug, $Profuse_Description, $Profuse_Image);
				}
				$user_update = array("Message_Type" => "Update", "Message" => $user_update);
				return $user_update;
		}
		else {
				$output_error = array("Message_Type" => "Error", "Message" => $error);
				return $output_error;
		}
}

function Mass_Delete_UPCP_Profuse() {
		$Profuses = $_POST['Profuses_Bulk'];

		if (is_array($Profuses)) {
				foreach ($Profuses as $Profuse) {
						if ($Profuse != "") {
								Delete_UPCP_Profuse($Profuse);
						}
				}
		}

		$update = __("Profuse(s) have been successfully deleted.", 'UPC_MC');
		$user_update = array("Message_Type" => "Update", "Message" => $update);
		return $user_update;
}

?>