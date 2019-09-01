<?php

function CheckMakers($makers, $ProdMakers) {
	
	if (sizeOf($makers) == 0) {return "Yes";}
	if (sizeOf($ProdMakers) == 0)  {return "no";}
	foreach ($makers as $maker){
	
		if ( $maker == $ProdMakers[0]->Maker_ID) {return "Yes";}
	}
	return "No";
}

function CheckProfuses($profuses, $ProdProfuses) {
	//PC::debug($profuses, __FUNCTION__ . " @ profuses");
	//PC::debug($ProdProfuses, __FUNCTION__ . " @ ProdProfuses");
	
	if (sizeOf($profuses) == 0) {return "Yes";}
	if (sizeOf($ProdProfuses) == 0)  {return "no";}
	
	foreach ($profuses as $profuse){
		foreach ($ProdProfuses as $ProdProfuse){
			if ( $profuse == $ProdProfuse->Profuse_ID) {return "Yes";}
		}
	}
	return "No";
}
