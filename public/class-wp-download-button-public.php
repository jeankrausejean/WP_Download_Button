<?php
class WP_Download_Button_Public {
    public function init() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_filter('the_content', array($this, 'add_download_button_to_content'));
    }

    public function enqueue_styles() {
        wp_enqueue_style(
            'download-button-style',
            WP_DOWNLOAD_BUTTON_URL . 'public/css/style.css',
            array(),
            WP_DOWNLOAD_BUTTON_VERSION
        );

        $custom_css = $this->get_custom_css();
        wp_add_inline_style('download-button-style', $custom_css);
    }

    private function get_custom_css() {
        $font_family = get_option('download_button_font_family', 'Arial, sans-serif');
        $font_weight = get_option('download_button_font_weight', '400');
        $font_size = get_option('download_button_font_size', '16px');
        $hover_color = get_option('download_button_hover_color', '#005177');

        return "
            .download-button {
                font-family: {$font_family};
                font-weight: {$font_weight};
                font-size: {$font_size};
            }
            .download-button:hover {
                background-color: {$hover_color} !important;
            }
        ";
    }

    public function add_download_button_to_content($content) {
        if (!is_single() || get_post_type() !== 'post') {
            return $content;
        }

        $file_url = get_post_meta(get_the_ID(), '_download_file_url', true);
        if (!$file_url) {
            return $content;
        }

        $button_html = $this->generate_button_html($file_url);
        $position = get_option('download_button_position', 'after');
        
        return $position === 'before' ? $button_html . $content : $content . $button_html;
    }

    private function generate_button_html($file_url) {
        $button_text = get_post_meta(get_the_ID(), '_download_button_text', true);
        if (empty($button_text)) {
            $button_text = get_option('download_button_text', 'Download');
        }

        $button_color = get_option('download_button_color', '#0073aa');
        $button_text_color = get_option('download_button_text_color', '#ffffff');
        $button_size = get_option('download_button_size', 'medium');
        $button_alignment = get_option('download_button_alignment', 'center');
        
        return sprintf(
            '<div class="download-button-container download-button-align-%s"><a href="%s" class="download-button download-button-%s" style="background-color: %s; color: %s;" target="_blank" rel="noopener noreferrer">%s</a></div>',
            esc_attr($button_alignment),
            esc_url($file_url),
            esc_attr($button_size),
            esc_attr($button_color),
            esc_attr($button_text_color),
            esc_html($button_text)
        );
    }
}