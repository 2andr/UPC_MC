/*
// add string to end of jQuery(document).ready(function() in file upcp-jquery-functions.js
jQuery.getScript("/wp-content/plugins/ultimate-product-catalogue/makers_addon/update-catalogue-order_Makers.js")
*/


jQuery('.makers-list').sortable({
	items: '.maker-list-item',
	opacity: 0.6,
	cursor: 'move',
	axis: 'y',
	update: function() {
		var order = jQuery(this).sortable('serialize') + '&action=makers_update_order';
		jQuery.post(ajaxurl, order, function(response) {});
	}
});
jQuery('.profuses-list').sortable({
	items: '.profuse-list-item',
	opacity: 0.6,
	cursor: 'move',
	axis: 'y',
	update: function() {
		var order = jQuery(this).sortable('serialize') + '&action=profuses_update_order';
		jQuery.post(ajaxurl, order, function(response) {});
	}
});
