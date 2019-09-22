/*
// add string to end of file Admin.js
jQuery.getScript("/wp-content/plugins/UPC_MC/makers_addon/Admin_Makers.js")

*/

/*************************************************************************
CONDITIONAL MAKERS STUFF (e.g. CONTROL TYPE)
**************************************************************************/
jQuery(document).ready(function($){
	$('input[name="Maker_Searchable"]').click(function(){
		if($(this).attr('value') == 'Yes'){
			$('#ewd-upcp-admin-maker-control-type').show();
		}
		else{
			$('#ewd-upcp-admin-maker-control-type').hide();
		}
	});
});

/*************************************************************************
CONDITIONAL PROFUSES STUFF (e.g. CONTROL TYPE)
**************************************************************************/
jQuery(document).ready(function($){
	$('input[name="Profuse_Searchable"]').click(function(){
		if($(this).attr('value') == 'Yes'){
			$('#ewd-upcp-admin-profuse-control-type').show();
		}
		else{
			$('#ewd-upcp-admin-profuse-control-type').hide();
		}
	});
});