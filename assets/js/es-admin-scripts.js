var selector;
function upload_media_image(selector){
    jQuery('body').on( 'click', selector , function( event ){
    event.preventDefault();

    var imgContainer = jQuery(this).closest('.attachment-media-view').find( '.thumbnail-image'),
    placeholder = jQuery(this).closest('.attachment-media-view').find( '.placeholder'),
    imgIdInput = jQuery(this).siblings('.upload-id');

    frame = wp.media({
        title: 'Select or Upload Image',
        button: {
        text: 'Use Image'
        },
        multiple: false  // Set to true to allow multiple files to be selected
    });

    frame.on( 'select', function() {

    var attachment = frame.state().get('selection').first().toJSON();

    imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
    placeholder.addClass('hidden');
    imgIdInput.val( attachment.url ).trigger('change');
    });

    frame.open();
    
    });
}

function delete_media_image(selector){
    jQuery('body').on( 'click', selector, function( event ){

    event.preventDefault();
    var imgContainer = jQuery(this).closest('.attachment-media-view').find( '.thumbnail-image'),
    placeholder = jQuery(this).closest('.attachment-media-view').find( '.placeholder'),
    imgIdInput = jQuery(this).siblings('.upload-id');

    imgContainer.find('img').remove();
    placeholder.removeClass('hidden');

    imgIdInput.val( '' ).trigger('change');

    });
}

jQuery(document).ready(function($) {
    
    "use strict";

    $('body').on('click','.selector-labels label', function(){
        var $this = $(this);
        var value = $this.data('val');
        $this.siblings().removeClass('selector-selected');
        $this.addClass('selector-selected');
        $this.closest('.selector-labels').next('input').val(value).change();
    });

    upload_media_image('.mt-upload-button');
    delete_media_image('.mt-delete-button');

    $( '.es-meta-options-wrap .buttonset' ).buttonset();

});