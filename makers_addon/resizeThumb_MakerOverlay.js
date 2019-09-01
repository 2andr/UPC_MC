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
		function(){jQuery(this).addClass('upcp-hover-visible');}, 
		function(){jQuery(this).removeClass('upcp-hover-visible');});

	jQuery('.upcp-thumb-item').hover(
		function(){jQuery(this).find('.upcp-thumb-title').addClass('upcp-hover-visible');}, 
		function(){jQuery(this).find('.upcp-thumb-title').removeClass('upcp-hover-visible');});

	jQuery(window).resize(function() { resizeThumbOverlay(); });
};

function makerOverlay () {

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
		function(){jQuery(this).addClass('upcp-hover-visible');}, 
		function(){jQuery(this).removeClass('upcp-hover-visible');});

	jQuery('.upcp-thumb-item').hover(
		function(){jQuery(this).find('.upcp-thumb-title').addClass('upcp-hover-visible');}, 
		function(){jQuery(this).find('.upcp-thumb-title').removeClass('upcp-hover-visible');});

	jQuery(window).resize(function() { resizeThumbOverlay(); });
};
