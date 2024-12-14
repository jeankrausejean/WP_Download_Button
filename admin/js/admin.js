jQuery(document).ready(function($) {
    // Initialize color pickers
    $('.color-picker').wpColorPicker();

    // Handle file upload
    $('#upload_file_button').click(function() {
        var upload = wp.media({
            title: 'Selecione o arquivo',
            multiple: false
        })
        .on('select', function() {
            var attachment = upload.state().get('selection').first().toJSON();
            $('#download_file_url').val(attachment.url);
        })
        .open();
    });
});