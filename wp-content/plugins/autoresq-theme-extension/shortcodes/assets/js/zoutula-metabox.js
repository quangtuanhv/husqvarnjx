(function ($) {
    'use strict';
    $(document).ready(function () {

        // Set all variables to be used in scope
        var frame,
            metaBox = $('#autoresq_header_image_id.postbox'),
            addImgLink = metaBox.find('.upload-autoresq-img'),
            delImgLink = metaBox.find('.delete-autoresq-img'),
            imgContainer = metaBox.find('.autoresq-img-container'),
            imgIdInput = metaBox.find('.autoresq-header-image-id');

        // ADD IMAGE LINK
        addImgLink.on('click', function (event) {

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if (frame) {
                frame.open();
                return;
            }

            // Create a new media frame
            frame = wp.media({
                title: 'Select or Upload Media',
                button: {
                    text: 'Set header image'
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });


            // When an image is selected in the media frame...
            frame.on('select', function () {

                // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').first().toJSON();

                // Send the attachment URL to our custom image input field.
                imgContainer.append('<img src="' + attachment.url + '" alt="" style="max-width:100%;"/>');

                // Send the attachment id to our hidden input
                imgIdInput.val(attachment.id);

                // Hide the add image link
                addImgLink.addClass('hidden');

                // Un-hide the remove image link
                delImgLink.removeClass('hidden');
            });

            // Finally, open the modal on click
            frame.open();
        });


        // DELETE IMAGE LINK
        delImgLink.on('click', function (event) {

            event.preventDefault();

            // Clear out the preview image
            imgContainer.html('');

            // Un-hide the add image link
            addImgLink.removeClass('hidden');

            // Hide the delete image link
            delImgLink.addClass('hidden');

            // Delete the image id from the hidden input
            imgIdInput.val('');
        });

    })
}(jQuery));