<?php
if (!defined('ABSPATH')) {
    exit;
}

wp_nonce_field('download_meta_box_nonce', 'download_meta_box_nonce');
$file_url = get_post_meta($post->ID, '_download_file_url', true);
$button_text = get_post_meta($post->ID, '_download_button_text', true);
if (empty($button_text)) {
    $button_text = get_option('download_button_text', 'Download');
}
?>
<div style="margin: 15px 0;">
    <label style="display: block; margin-bottom: 5px;"><strong>Arquivo para Download:</strong></label>
    <input type="text" id="download_file_url" name="download_file_url" value="<?php echo esc_attr($file_url); ?>" style="width: 80%;">
    <input type="button" class="button" value="Upload Arquivo" id="upload_file_button">
</div>

<div style="margin: 15px 0;">
    <label style="display: block; margin-bottom: 5px;"><strong>Texto do Botão:</strong></label>
    <input type="text" name="download_button_text" value="<?php echo esc_attr($button_text); ?>" style="width: 50%;">
</div>