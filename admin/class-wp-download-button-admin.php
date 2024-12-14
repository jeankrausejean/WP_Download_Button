<?php
class WP_Download_Button_Admin {
    public function init() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }

    public function enqueue_admin_assets() {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script(
            'wp-download-button-admin',
            WP_DOWNLOAD_BUTTON_URL . 'admin/js/admin.js',
            array('jquery', 'wp-color-picker'),
            WP_DOWNLOAD_BUTTON_VERSION,
            true
        );
    }

    public function add_admin_menu() {
        add_menu_page(
            'Configurações do Botão de Download',
            'Botão Download',
            'manage_options',
            'download-button-settings',
            array($this, 'render_settings_page'),
            'dashicons-download'
        );
    }

    public function register_settings() {
        register_setting('download_button_options', 'download_button_text');
        register_setting('download_button_options', 'download_button_color');
        register_setting('download_button_options', 'download_button_text_color');
        register_setting('download_button_options', 'download_button_hover_color');
        register_setting('download_button_options', 'download_button_size');
        // Novas opções
        register_setting('download_button_options', 'download_button_position');
        register_setting('download_button_options', 'download_button_alignment');
        register_setting('download_button_options', 'download_button_font_family');
        register_setting('download_button_options', 'download_button_font_weight');
        register_setting('download_button_options', 'download_button_font_size');
    }

    public function render_settings_page() {
        require_once WP_DOWNLOAD_BUTTON_PATH . 'admin/views/settings-page.php';
    }
}