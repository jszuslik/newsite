/**
 * Created by JoshuaSzuslik on 6/13/16.
 */
/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){

    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;

    // Runs when the image button is clicked.
    $('.nrw_button').on('click', function(e){
        var input = $(this);
        var sib = input.siblings("input");
        console.log(sib);
        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            // library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            sib.val(media_attachment.url);
        });

        // Opens the media library frame.
        meta_image_frame.open();
    });

    $('.nrw_remove_image_button').on('click', function(e){
        var input = $(this);
        var in_sib = input.siblings("input");
        input.siblings("img").hide();
        input.siblings("span").hide();
        input.siblings("br").hide();
        input.hide();
        in_sib.val('');
        in_sib.attr('type', 'text');
        var up_btn = $('<input>');
        up_btn.attr('type', 'button');
        up_btn.attr('id', 'upload_image_button');
        up_btn.val('Choose or Upload an Image');
        up_btn.addClass('button nrw_button');
        input.parent().append(up_btn);
        nrwAutoSave(in_sib.attr('name'));
        up_btn.on('click', function(e){
            var input = $(this);
            var sib = input.siblings("input");
            console.log(sib);
            // Prevents the default action from occuring.
            e.preventDefault();

            // If the frame already exists, re-open it.
            if ( meta_image_frame ) {
                meta_image_frame.open();
                return;
            }

            // Sets up the media library frame
            meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                title: meta_image.title,
                button: { text:  meta_image.button },
                // library: { type: 'image' }
            });

            // Runs when an image is selected.
            meta_image_frame.on('select', function(){

                // Grabs the attachment selection and creates a JSON representation of the model.
                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

                // Sends the attachment URL to our custom image input field.
                sib.val(media_attachment.url);
            });

            // Opens the media library frame.
            meta_image_frame.open();
        });
        e.preventDefault();
    });

    $('.nrw_remove_file_button').on('click', function(e){
        var input = $(this);
        var in_sib = input.siblings("input");
        input.siblings("img").hide();
        input.siblings("span").hide();
        input.siblings("br").hide();
        input.hide();
        in_sib.val('');
        in_sib.attr('type', 'text');
        var up_btn = $('<input>');
        up_btn.attr('type', 'button');
        up_btn.attr('id', 'upload_image_button');
        up_btn.val('Choose or Upload a File');
        up_btn.addClass('button nrw_button');
        input.parent().append(up_btn);
        nrwAutoSave(in_sib.attr('name'));
        up_btn.on('click', function(e){
            var input = $(this);
            var sib = input.siblings("input");
            console.log(sib);
            // Prevents the default action from occuring.
            e.preventDefault();

            // If the frame already exists, re-open it.
            if ( meta_image_frame ) {
                meta_image_frame.open();
                return;
            }

            // Sets up the media library frame
            meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                title: meta_image.title,
                button: { text:  meta_image.button },
                // library: { type: 'image' }
            });

            // Runs when an image is selected.
            meta_image_frame.on('select', function(){

                // Grabs the attachment selection and creates a JSON representation of the model.
                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

                // Sends the attachment URL to our custom image input field.
                sib.val(media_attachment.url);
            });

            // Opens the media library frame.
            meta_image_frame.open();
        });
        e.preventDefault();
    });

});

var autoSaveOn = false;
function nrwAutoSave(meta_id) {
    if(!autoSaveOn) {
        autoSaveOn = true;
        var post_id = getQueryStringParams('post');
        console.log(post_id);
        jQuery.ajax({
            url: nrw_admin_ajax.ajax_url,
            type: 'post',
            data: {
                action: 'omni_wp_theme_remove_image',
                post_id: post_id,
                meta_id: meta_id
            },
            success: function(msg) {
                console.log(msg);
                // location.reload();
            }
        });
    }
}

function getQueryStringParams(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}