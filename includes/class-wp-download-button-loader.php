<?php
class WP_Download_Button_Loader {
    private $admin;
    private $public;
    private $metabox;

    public function __construct() {
        $this->load_dependencies();
        $this->init_components();
    }

    private function load_dependencies() {
        require_once WP_DOWNLOAD_BUTTON_PATH . 'admin/class-wp-download-button-admin.php';
        require_once WP_DOWNLOAD_BUTTON_PATH . 'public/class-wp-download-button-public.php';
        require_once WP_DOWNLOAD_BUTTON_PATH . 'includes/class-wp-download-button-metabox.php';
    }

    private function init_components() {
        $this->admin = new WP_Download_Button_Admin();
        $this->public = new WP_Download_Button_Public();
        $this->metabox = new WP_Download_Button_Metabox();
    }

    public function run() {
        $this->admin->init();
        $this->public->init();
        $this->metabox->init();
    }
}