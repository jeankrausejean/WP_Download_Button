<?php
class WP_Download_Button_Settings {
    public static function get_font_families() {
        return array(
            'Arial' => 'Arial, sans-serif',
            'Helvetica' => 'Helvetica, Arial, sans-serif',
            'Georgia' => 'Georgia, serif',
            'Times New Roman' => 'Times New Roman, serif',
            'Verdana' => 'Verdana, sans-serif',
            'Roboto' => 'Roboto, sans-serif',
            'Open Sans' => 'Open Sans, sans-serif'
        );
    }

    public static function get_font_weights() {
        return array(
            'Normal' => '400',
            'Médio' => '500',
            'Semi-Bold' => '600',
            'Bold' => '700'
        );
    }

    public static function get_font_sizes() {
        return array(
            'Pequeno' => '14px',
            'Médio' => '16px',
            'Grande' => '18px',
            'Extra Grande' => '20px'
        );
    }

    public static function register_settings() {
        // Configurações existentes
        register_setting('download_button_options', 'download_button_text');
        register_setting('download_button_options', 'download_button_color');
        register_setting('download_button_options', 'download_button_text_color');
        register_setting('download_button_options', 'download_button_hover_color');
        register_setting('download_button_options', 'download_button_size');
        register_setting('download_button_options', 'download_button_position');
        register_setting('download_button_options', 'download_button_alignment');

        // Novas configurações de fonte
        register_setting('download_button_options', 'download_button_font_family');
        register_setting('download_button_options', 'download_button_font_weight');
        register_setting('download_button_options', 'download_button_font_size');
    }
}