<?php
class WP_Download_Button_Metabox {
    public function init() {
        add_action('add_meta_boxes', array($this, 'add_download_meta_box'));
        add_action('save_post', array($this, 'save_download_meta'));
    }

    public function add_download_meta_box() {
        add_meta_box(
            'download_file_meta_box',
            'Arquivo para Download',
            array($this, 'display_download_meta_box'),
            'post',
            'normal',
            'high'
        );
    }

    public function display_download_meta_box($post) {
        require_once WP_DOWNLOAD_BUTTON_PATH . 'admin/views/metabox-download.php';
    }

    public function save_download_meta($post_id) {
        if (!isset($_POST['download_meta_box_nonce']) || 
            !wp_verify_nonce($_POST['download_meta_box_nonce'], 'download_meta_box_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (isset($_POST['download_file_url'])) {
            update_post_meta($post_id, '_download_file_url', sanitize_text_field($_POST['download_file_url']));
        }

        if (isset($_POST['download_button_text'])) {
            update_post_meta($post_id, '_download_button_text', sanitize_text_field($_POST['download_button_text']));
        }
    }
}