/*FileUpload Init*/
$(document).ready(function() {
	"use strict";
	
	/* Basic Init*/
	$('.dropify').dropify();

	/* Translated Init*/
	$('.dropify-fr').dropify({
		messages: {
			default: 'Glissez-déposez un fichier ici ou cliquez',
			replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
			remove:  'Supprimer',
			error:   'Désolé, le fichier trop volumineux'
		}
	});

	/* Used events */
	// 
	var drEvent = $('#input-file-events').dropify();

	drEvent.on('dropify.beforeClear', function(event, element){
		return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
	});

	drEvent.on('dropify.afterClear', function(event, element){
		alert('File deleted');
	});

	drEvent.on('dropify.errors', function(event, element){
		console.log('Has Errors');
	});

	var drDestroy = $('#input-file-to-destroy').dropify();
	drDestroy = drDestroy.data('dropify')
	$('#toggleDropify').on('click', function(e){
		e.preventDefault();
		if (drDestroy.isDropified()) {
			drDestroy.destroy();
		} else {
			drDestroy.init();
		}
	});

});
/* DottScale: ensure every image file input uses Dropify */
$(document).ready(function () {
  $('input[type="file"]').each(function () {
    var $el = $(this);
    var accept = ($el.attr('accept') || '').toLowerCase();
    if ($el.hasClass('dropify') || $el.hasClass('dz-hidden-input')) return;
    if (accept.indexOf('image') === -1 && accept.indexOf('svg') === -1 && accept.indexOf('.pdf') === -1 && accept.indexOf('.doc') === -1) return;
    $el.addClass('dropify');
    try { $el.dropify(); } catch (e) {}
  });
});
