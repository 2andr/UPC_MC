function resizeThumbItem() {
	var thumbImageDiv = jQuery('.upcp-thumb-image-div'),
	thumbItem = jQuery('.upcp-thumb-item');

	var heights = jQuery(thumbItem).map(function ()
	{
	    return jQuery(this).height();
	}).get(),
	maxHeight = Math.max.apply(null, heights);

	jQuery(thumbItem).each(function (index, value) { 
	jQuery(this).height(maxHeight);
	// jQuery(this).css("margin-bottom", maxHeight - jQuery(this).height());
	});
}

function customFieldOverlay () {

	 jQuery('.upcp-thumb-item').each(function (index, value) { 
	jQuery(this).find('.upcp-custom-field-thumbs').appendTo(jQuery(this).find('.upcp-thumb-image-div'));
	jQuery(this).find('.upcp-thumb-price').appendTo(jQuery(this).find('.upcp-custom-field-thumbs'));
	});

	jQuery('.upcp-detail-item').each(function (index, value) { 
	jQuery(this).find('.upcp-custom-field-details').appendTo(jQuery(this).find('.upcp-detail-image-div'));
	jQuery(this).find('.upcp-detail-price').appendTo(jQuery(this).find('.upcp-custom-field-details'));
	jQuery(this).find('.prod-cat-end-detail-div').remove();
	});
	jQuery('.upcp-list-item').each(function (index, value) { 
	jQuery(this).find('.upcp-custom-field-list').appendTo(jQuery(this).find('.upcp-list-image-div'));
	});

	jQuery('.upcp-prod-desc-custom-fields').hover(
		function(){
			if(jQuery(this).text().length != 0) {
				jQuery(this).addClass('upcp-hover-visible');
			}
		}, 
		function(){jQuery(this).removeClass('upcp-hover-visible');}

		);

	jQuery('.upcp-thumb-item').hover(
		function(){jQuery(this).find('.upcp-thumb-title').addClass('upcp-hover-visible');}, 
		function(){jQuery(this).find('.upcp-thumb-title').removeClass('upcp-hover-visible');});

};

function makerOverlay () {

	 jQuery('.upcp-thumb-item').each(function (index, value) { 
	jQuery(this).find('.upcp-maker-thumbs').appendTo(jQuery(this).find('.upcp-thumb-image-div'));
	jQuery(this).find('.upcp-thumb-price').appendTo(jQuery(this).find('.upcp-maker-thumbs'));
	});

	jQuery('.upcp-detail-item').each(function (index, value) { 
	jQuery(this).find('.upcp-maker-details').appendTo(jQuery(this).find('.upcp-detail-image-div'));
	jQuery(this).find('.upcp-detail-price').appendTo(jQuery(this).find('.upcp-maker-details'));
	jQuery(this).find('.prod-cat-end-detail-div').remove();
	});
	jQuery('.upcp-list-item').each(function (index, value) { 
	jQuery(this).find('.upcp-maker-list').appendTo(jQuery(this).find('.upcp-list-image-div'));
	});

	jQuery('.upcp-prod-desc-makers').hover(
		function(){
			if(jQuery(this).text().length != 0) {
				jQuery(this).addClass('upcp-hover-visible');
			}
		}, 
		function(){jQuery(this).removeClass('upcp-hover-visible');}

		);

	jQuery('.upcp-thumb-item').hover(
		function(){jQuery(this).find('.upcp-thumb-title').addClass('upcp-hover-visible');}, 
		function(){jQuery(this).find('.upcp-thumb-title').removeClass('upcp-hover-visible');});

};


function profuseOverlay () {

	 jQuery('.upcp-thumb-item').each(function (index, value) { 
	jQuery(this).find('.upcp-profuse-thumbs').appendTo(jQuery(this).find('.upcp-thumb-image-div'));
	jQuery(this).find('.upcp-thumb-price').appendTo(jQuery(this).find('.upcp-profuse-thumbs'));
	});

	jQuery('.upcp-detail-item').each(function (index, value) { 
	jQuery(this).find('.upcp-profuse-details').appendTo(jQuery(this).find('.upcp-detail-image-div'));
	jQuery(this).find('.upcp-detail-price').appendTo(jQuery(this).find('.upcp-profuse-details'));
	jQuery(this).find('.prod-cat-end-detail-div').remove();
	});
	jQuery('.upcp-list-item').each(function (index, value) { 
	jQuery(this).find('.upcp-profuse-list').appendTo(jQuery(this).find('.upcp-list-image-div'));
	});

	jQuery('.upcp-prod-desc-profuses').hover(
		function(){
			if(jQuery(this).text().length != 0) {
				jQuery(this).addClass('upcp-hover-visible');
			}
		}, 
		function(){jQuery(this).removeClass('upcp-hover-visible');}

		);

	jQuery('.upcp-thumb-item').hover(
		function(){jQuery(this).find('.upcp-thumb-title').addClass('upcp-hover-visible');}, 
		function(){jQuery(this).find('.upcp-thumb-title').removeClass('upcp-hover-visible');});

};
  
function upcp_style_hover () { 
	resizeThumbItem();
	jQuery(window).resize(function() { resizeThumbItem(); });
	makerOverlay();
	profuseOverlay();
	customFieldOverlay();
};

//jQuery.getScript("/wp-content/plugins/UPC_MC/makers_addon/catalogue-style-hover_Makers.js")
