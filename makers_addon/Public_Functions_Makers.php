<?PHP

// manualy add functions to class UPCP_Product

		function Get_Makers() {
			global $wpdb, $makers_table_name, $makers_meta_table_name;
			
			$Makers = $wpdb->get_results("SELECT Maker_Name, Maker_ID FROM $makers_table_name");
			foreach ($Makers  as $Maker) {
				$Values[$Maker->Maker_ID] = $wpdb->get_var($wpdb->prepare("SELECT Meta_Value FROM $makers_meta_table_name WHERE Maker_ID=%d AND Item_ID=%d", $Maker->Maker_ID, $this->Item->Item_ID));
			}
			return $Values;
		}		

		function Get_Makrers_By_ID ($Maker_ID) {
    		global $wpdb, $makers_meta_table_name;
			
			return $wpdb->get_var($wpdb->prepare("SELECT Meta_Value FROM $makers_meta_table_name WHERE Maker_ID=%d AND Item_ID=%d", $Maker_ID, $this->Item->Item_ID));
		}
		
		function Get_Profuses() {
			global $wpdb, $profuses_table_name, $profuses_meta_table_name;
			
			$Profuses = $wpdb->get_results("SELECT Profuse_Name, Profuse_ID FROM $profuses_table_name");
			foreach ($Profuses  as $Profuse) {
				$Values[$Profuse->Profuse_ID] = $wpdb->get_var($wpdb->prepare("SELECT Meta_Value FROM $profuses_meta_table_name WHERE Profuse_ID=%d AND Item_ID=%d", $Profuse->Profuse_ID, $this->Item->Item_ID));
			}
			return $Values;
		}		

		function Get_Profuses_By_ID ($Profuse_ID) {
    		global $wpdb, $profuses_meta_table_name;
			
			return $wpdb->get_var($wpdb->prepare("SELECT Meta_Value FROM $profuses_meta_table_name WHERE Profuse_ID=%d AND Item_ID=%d", $Profuse_ID, $this->Item->Item_ID));
		}
		
		
		/*
				function Get_Makers() {
			global $wpdb, $makers_table_name, $makers_meta_table_name;
			
    		$Makers = $wpdb->get_results("SELECT Maker_ID FROM $makers_meta_table_name WHERE Item_ID=" . $this->Item->Item_ID);
			if (is_array($Makers)) {
				foreach ($Makers as $Maker) {
					$MakerInfo = $wpdb->get_row("SELECT Maker_Name FROM $makers_table_name WHERE Maker_ID=" . $Maker->Maker_ID);
					$MakersString .= $MakerInfo->Maker_Name . ", ";
				}
			}
			$MakersString = trim($MakersString, " ,");
			return $MakersString;
		}		

		function Get_Makers_By_ID ($Maker_ID) {
    		global $wpdb, $makers_meta_table_name;
			
			return $wpdb->get_var($wpdb->prepare("SELECT Meta_Value FROM $makers_meta_table_name WHERE Maker_ID=%d AND Item_ID=%d", $Maker_ID, $this->Item->Item_ID));
		}

		function Get_Profuses() {
			global $wpdb, $profuses_table_name, $profuses_meta_table_name;
			
			$Profuses = $wpdb->get_results("SELECT Profuse_Name, Profuse_ID FROM $profuses_table_name");
			foreach ($Profuses  as $Profuse) {
				$Values[$Profuse->Profuse_ID] = $wpdb->get_var($wpdb->prepare("SELECT Meta_Value FROM $profuses_meta_table_name WHERE Profuse_ID=%d AND Item_ID=%d", $Profuse->Profuse_ID, $this->Item->Item_ID));
			}
			return $Values;
		}		

		function Get_Profuses_By_ID ($Profuse_ID) {
    		global $wpdb, $profuses_meta_table_name;
			
			return $wpdb->get_var($wpdb->prepare("SELECT Meta_Value FROM $profuses_meta_table_name WHERE Profuse_ID=%d AND Item_ID=%d", $Profuse_ID, $this->Item->Item_ID));
		}
		*/

?>