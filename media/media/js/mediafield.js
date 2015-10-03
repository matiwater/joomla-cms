/**
 * @copyright	Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * initializeMedia behavior for media component
 *
 * @package		Joomla.Extensions
 * @subpackage	Media
 * @since		3.5
 */

/**
 * Helper script for the Form Field Media
 *
 * It will initialize the preview image button
 * and fill the input with the URL of the image
 *
 * @param path           The base URL of the site
 * @param empty          The string for the empty selection
 * @param previewWidth   The width of the image preview
 * @param previewHeight  The height of the image preview
 * @param source         The URL for the image
 * @param fieldId        The field id
 */
function initializeMedia(path, empty, previewWidth, previewHeight, source, fieldId) {

	var $selector = jQuery("#" + fieldId);

	if (source == $empty) {
		imagePreview = $empty;
	} else {
		var imagePreview = new Image(previewWidth, previewHeight);
		imagePreview.src = source;
	}
	jQuery("#media_preview_" + fieldId).popover({
		trigger  : "hover",
		placement: "right",
		content  : imagePreview,
		html     : true
	});

	// Initialize the tooltip
	var imgValue = $selector.val();
	$selector.tooltip('destroy').tooltip({'placement': 'top', 'title': imgValue});
}

function updateField(fieldId) {
	var $selector = jQuery("#" + fieldId);
	$selector.val(jQuery("#imageModal_" + fieldId + " iframe").contents().find("#f_url").val()).trigger("change");

	// Close the modal
	parent.jQuery('#imageModal_' + fieldId, parent.document).modal('hide');

	// Reset tooltip and preview
	var imgValue = $selector.val();
	var popover = jQuery("#media_preview_" + fieldId).data("popover");
	var imgPreview = new Image(previewWidth, previewHeight);

	if (imgValue == "") {
		popover.options.content = empty;
		jQuery("#" + fieldId).tooltip("destroy");
	} else {
		imgPreview.src = path + imgValue;
		popover.options.content = imgPreview;
		jQuery("#" + fieldId).tooltip("destroy").tooltip({"placement": "top", "title": imgValue});
	}
}

// Clear button
function clearMediaInput(fieldId){
	jQuery("#" + fieldId).val("").tooltip("destroy");
	jQuery("#media_preview_" + fieldId).data("popover").options.content = window.$empty;
	return false;
}

// Initialize the fields on DOM ready
jQuery(document).ready( function($) {
	var fieldTmp = $(document.body).find('a[data-target^="#imageModal_"]').first();
	window.$empty = fieldTmp.attr('data-emptystring');
	window.$path = $(this).attr('data-basepath');

	$(document.body).find('a[data-target^="#imageModal_"]').each(function() {
		path = $(this).attr('data-basepath');
		empty = $(this).attr('data-emptystring');
		source = $(this).attr('data-source');
		fieldId = $(this).attr('data-fieldId');
		previewWidth = $(this).attr('data-previewWidth');
		previewHeight = $(this).attr('data-previewHeight');

		initializeMedia(path, empty, previewWidth, previewHeight, source, fieldId);
	});
});
