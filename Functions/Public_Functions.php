<?php
if (!class_exists('UPCP_Product')){
    class UPCP_Product {
    	private $Item;
				
		function __construct($params = array()) {
			global $wpdb, $items_table_name;

			if (isset($params['ID'])) {
				$this->Item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $items_table_name WHERE Item_ID=%d", $params['ID']));
			}
			elseif (isset($params['Name'])) {
				$this->Item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $items_table_name WHERE Item_Name=%s", $params['Name']));
			}
			elseif (get_query_var('single_product') != "" or $_GET['SingleProduct'] != "") {	
				if (get_query_var('single_product') != "") {$Item_ID = $wpdb->get_var($wpdb->prepare("SELECT Item_ID FROM $items_table_name WHERE Item_Slug=%s", trim(get_query_var('single_product'), "/? ")));}
				else {$Item_ID = $_GET['SingleProduct'];}
				$this->Item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $items_table_name WHERE Item_ID=%d", $Item_ID));
			}
    	}
		
		function Get_Product_Name_For_ID($id = null) {
			global $wpdb, $items_table_name;

			if(!$id) {
				return null;
			}

			return $wpdb->get_var($wpdb->prepare("SELECT Item_Name FROM $items_table_name WHERE Item_ID=%d", $id));
		}

		function Get_Field_Value_For_ID($Field, $id) {
			global $wpdb, $items_table_name;

			if(!$Field || !$id) {
				return null;
			}
			$Values = $wpdb->get_row($wpdb->prepare("SELECT * FROM $items_table_name WHERE Item_ID=%d", $id));
			
			return $Values->$Field;
		}
				
		function Get_Item_ID() {
			return $this->Item->Item_ID;
		}
				
		function Get_Product_Name() {
			return $this->Item->Item_Name;
		}
				
		function Get_Field_Value($Field) {
			return $this->Item->$Field;
		}

    	function Get_Custom_Fields() {
    		global $wpdb, $fields_table_name, $fields_meta_table_name;
			
			$Fields = $wpdb->get_results("SELECT Field_Name, Field_ID FROM $fields_table_name");
			foreach ($Fields  as $Field) {
				$Values[$Field->Field_ID] = $wpdb->get_var($wpdb->prepare("SELECT Meta_Value FROM $fields_meta_table_name WHERE Field_ID=%d AND Item_ID=%d", $Field->Field_ID, $this->Item->Item_ID));
			}
			return $Values;
    	}

    	function Get_Custom_Field_By_ID($Field_ID) {
    		global $wpdb, $fields_meta_table_name;
			
			return $wpdb->get_var($wpdb->prepare("SELECT Meta_Value FROM $fields_meta_table_name WHERE Field_ID=%d AND Item_ID=%d", $Field_ID, $this->Item->Item_ID));
    	}
		

    	function Get_Product_Tag_String() {
    		global $wpdb, $tags_table_name, $tagged_items_table_name;

    		$Tags = $wpdb->get_results("SELECT Tag_ID FROM $tagged_items_table_name WHERE Item_ID=" . $this->Item->Item_ID);
			if (is_array($Tags)) {
				foreach ($Tags as $Tag) {
					$TagInfo = $wpdb->get_row("SELECT Tag_Name FROM $tags_table_name WHERE Tag_ID=" . $Tag->Tag_ID);
					$TagsString .= $TagInfo->Tag_Name . ", ";
				}
			}
			$TagsString = trim($TagsString, " ,");

			return $TagsString;
    	}

		function Get_ProductMaker() {
    		global $wpdb, $makers_table_name, $makers_meta_table_name;
			$MakerString = "";
			
    		$Makers = $wpdb->get_results("SELECT Maker_ID FROM $makers_meta_table_name WHERE Item_ID=" . $this->Item->Item_ID);
			if (is_array($Makers)) {
				foreach ($Makers as $Maker) {
					$MakerInfo = $wpdb->get_row("SELECT Maker_Name FROM $makers_table_name WHERE Maker_ID=" . $Maker->Maker_ID);
					$MakerString .= $MakerInfo->Maker_Name . ", ";
				}
			}
			$MakerString = trim($MakerString, " ,");

			return $MakerString;
    	}

		function Get_ProductProfuse() {
    		global $wpdb, $profuses_table_name, $profuses_meta_table_name;
			$ProfuseString = "";
			
    		$Profuses = $wpdb->get_results("SELECT Profuse_ID FROM $profuses_meta_table_name WHERE Item_ID=" . $this->Item->Item_ID);
			if (is_array($Profuses)) {
				foreach ($Profuses as $Profuse) {
					$ProfuseInfo = $wpdb->get_row("SELECT Profuse_Name FROM $profuses_table_name WHERE Profuse_ID=" . $Profuse->Profuse_ID);
					$ProfuseString .= $ProfuseInfo->Profuse_Name . ", ";
				}
			}
			$ProfuseString = trim($ProfuseString, " ,");

			return $ProfuseString;
    	}

    	function Get_Permalink($Link_Base) {
    		global $wpdb, $items_table_name;

    		$Pretty_Links = get_option("UPCP_Pretty_Links");
    		$Permalink_Base = get_option("UPCP_Permalink_Base");
			if ($Permalink_Base == "") {$Permalink_Base = "product";}

    		$Item_Link = $this->Item->Item_Link;
    		$Item_Slug = $this->Item->Item_Slug;

    		if ($Product->Item_Link != "") {$Return_Link = $Item_Link;}
			elseif ($Pretty_Links == "Yes") {$Return_Link = $Link_Base . $Permalink_Base . "/" . $Item_Slug . "/?" . $uri_parts[1];}
			elseif (strpos($Link_Base, "?") !== false) {$Return_Link = $Link_Base . "&SingleProduct=" . $this->Item->Item_ID;}
			else {$Return_Link = $Link_Base . "?SingleProduct=" . $this->Item->Item_ID;}

			return $Return_Link;
    	}

    	function Get_Product_Price($Return_Type = "Int", $Sale = "Implied") {
    		global $wpdb, $items_table_name;

    		$Sale_Mode = get_option("UPCP_Sale_Mode");

    		if ($Sale == "Implied") {$Item_Sale = $this->Item->Item_Sale_Mode;}

    		if ($Sale == "Sale" or ($Sale == "Implied" and ($Sale_Mode == "All" or ($Item_Sale == "Yes" and $Sale_Mode == "Individual")))) {
    			$Price = $this->Item->Item_Sale_Price;
    			if ($Price == "") {$Price = $this->Item->Item_Price;}
    		}
    		else {
    			$Price = $Item_Link = $this->Item->Item_Price;
    		}

    		if ($Return_Type == "Int") {return $Price;}

    		$Price_Int = $Price;

    		if ($Return_Type != "Currency") {$Price = "<span itemprop='price' content='" . $Price . "'>" . $Price . "</span>";}

    		$Currency_Symbol = get_option("UPCP_Currency_Symbol");
    		$Currency_Code = get_option("UPCP_Currency_Code");
			$Currency_Symbol_Location = get_option("UPCP_Currency_Symbol_Location");
			if ($Return_Type != "Currency") {$Currency_Symbol = "<span itemprop='priceCurrency' content='" . $Currency_Code . "'>" . $Currency_Symbol . "</span>";}
			if ($Currency_Symbol_Location == "Before") {$Price = $Currency_Symbol . $Price;}
			else {$Price .= $Currency_Symbol;}

			if ($Return_Type == "Currency") {return $Price;}

			$Item_Full_Price_Int = $this->Get_Product_Price("Int", "Regular");
			
			if ($Price_Int != $Item_Full_Price_Int) {
				$Item_Display_Price = "<span class='price'>";
				$Item_Display_Price .= "<del><span class='amount'>" . $this->Get_Product_Price("Currency", "Regular") . "</span></del>";
				$Item_Display_Price .= "<ins><span class='amount' itemprop='offers' itemscope itemtype='http://schema.org/Offer'>" . $Price . "</span></ins>";
				$Item_Display_Price .= "</span>"; 
			}
			else {$Item_Display_Price = "<span class='full-price' itemprop='offers' itemscope itemtype='http://schema.org/Offer'>" . $Price . "</span>";}

			return $Item_Display_Price;
    	}
	}
}

if (!class_exists('UPCP_Options')){
	class UPCP_Options {
		private $Options;

		function __construct() {
			$this->Options = array();
		}

		function Get_Option($Option_Name) {
			if (!isset($Options[$Option_Name])) {
				$Options[$Option_Name] = get_option($Option_Name);
			}

			return $Options[$Option_Name];
		}
	}
}
$UPCP_Options = new UPCP_Options;

function UPCP_Get_All_Products() {
	global $wpdb, $items_table_name;

	$WP_Product_Objects = $wpdb->get_results("SELECT Item_ID FROM $items_table_name");

	foreach ($WP_Product_Objects as $Product_Object) {
		$Product_Array[] = new UPCP_Product(array('ID' => $Product_Object->Item_ID));
	}

	return $Product_Array;
}

function UPCP_Get_All_Categories() {
	global $wpdb, $categories_table_name;

	return $wpdb->get_results("SELECT * FROM $categories_table_name");
}

function UPCP_Get_Catalogues() {
	global $wpdb, $catalogues_table_name;

	return $wpdb->get_results("SELECT * FROM $catalogues_table_name");
}

function UPCP_Add_All_Items_To_Catalogue($catalogue_id) {
	global $wpdb, $catalogues_table_name, $catalogue_items_table_name, $categories_table_name, $items_table_name;

	$Categories = $wpdb->get_results("SELECT Category_ID FROM $categories_table_name");
	foreach ($Categories as $Category) {
		AJAX_Add_Categories_Catalogue($catalogue_id, $Category->Category_ID);
	}

	$Products = $wpdb->get_results("SELECT Item_ID FROM $items_table_name WHERE Category_ID=0");
	foreach ($Products as $Product) {
		AJAX_Add_Products_Catalogue($catalogue_id, $Product->Item_ID);
	}
}

//include UPCP_CD_PLUGIN_PATH . 'makers_addon/Public_Functions_Makers.php';
	
?>