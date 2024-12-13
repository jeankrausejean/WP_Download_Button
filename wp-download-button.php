<?php
/*
Plugin Name: WP Download Button
Plugin URI: 
Description: Adiciona um botão de download personalizado aos posts
Version: 1.1
Author: Dev Jean Krause
Author URI: https://devjean.com.br
*/

if (!defined('ABSPATH')) {
    exit;
}

class WP_Download_Button {
    
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_download_meta_box'));
        add_action('save_post', array($this, 'save_download_meta'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_filter('the_content', array($this, 'add_download_button_to_content'));
        add_action('admin_enqueue_scripts', array($this, 'admin_styles'));
    }

    public function admin_styles() {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
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
        
        <script>
        jQuery(document).ready(function($) {
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
        </script>
        <?php
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

    public function add_admin_menu() {
        add_menu_page(
            'Configurações do Botão de Download',
            'Botão Download',
            'manage_options',
            'download-button-settings',
            array($this, 'settings_page'),
            'dashicons-download'
        );
    }

    public function register_settings() {
        register_setting('download_button_options', 'download_button_text');
        register_setting('download_button_options', 'download_button_color');
        register_setting('download_button_options', 'download_button_text_color');
        register_setting('download_button_options', 'download_button_hover_color');
        register_setting('download_button_options', 'download_button_size');
    }

    public function settings_page() {
        ?>
        <div class="wrap">
            <h2>Configurações do Botão de Download</h2>
            <form method="post" action="options.php">
                <?php
                settings_fields('download_button_options');
                do_settings_sections('download_button_options');
                ?>
                <table class="form-table">
                    <tr>
                        <th>Texto Padrão do Botão</th>
                        <td>
                            <input type="text" name="download_button_text" 
                                   value="<?php echo esc_attr(get_option('download_button_text', 'Download')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Cor do Botão</th>
                        <td>
                            <input type="text" class="color-picker" name="download_button_color" 
                                   value="<?php echo esc_attr(get_option('download_button_color', '#0073aa')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Cor do Texto</th>
                        <td>
                            <input type="text" class="color-picker" name="download_button_text_color" 
                                   value="<?php echo esc_attr(get_option('download_button_text_color', '#ffffff')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Cor do Botão (Hover)</th>
                        <td>
                            <input type="text" class="color-picker" name="download_button_hover_color" 
                                   value="<?php echo esc_attr(get_option('download_button_hover_color', '#005177')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Tamanho do Botão</th>
                        <td>
                            <select name="download_button_size">
                                <option value="small" <?php selected(get_option('download_button_size'), 'small'); ?>>Pequeno</option>
                                <option value="medium" <?php selected(get_option('download_button_size', 'medium'), 'medium'); ?>>Médio</option>
                                <option value="large" <?php selected(get_option('download_button_size'), 'large'); ?>>Grande</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <script>
        jQuery(document).ready(function($) {
            $('.color-picker').wpColorPicker();
        });
        </script>
        <?php
    }

    public function add_download_button_to_content($content) {
        if (is_single() && get_post_type() === 'post') {
            $file_url = get_post_meta(get_the_ID(), '_download_file_url', true);
            if ($file_url) {
                $button_text = get_post_meta(get_the_ID(), '_download_button_text', true);
                if (empty($button_text)) {
                    $button_text = get_option('download_button_text', 'Download');
                }
                $button_color = get_option('download_button_color', '#0073aa');
                $button_text_color = get_option('download_button_text_color', '#ffffff');
                $button_size = get_option('download_button_size', 'medium');
                
                $button = sprintf(
                    '<div class="download-button-container"><a href="%s" class="download-button download-button-%s" style="background-color: %s; color: %s;" target="_blank" rel="noopener noreferrer">%s</a></div>',
                    esc_url($file_url),
                    esc_attr($button_size),
                    esc_attr($button_color),
                    esc_attr($button_text_color),
                    esc_html($button_text)
                );
                
                $content .= $button;
            }
        }
        return $content;
    }

    public function enqueue_styles() {
        wp_enqueue_style(
            'download-button-style',
            plugins_url('css/style.css', __FILE__)
        );

        $custom_css = sprintf(
            '.download-button:hover { background-color: %s !important; }',
            esc_html(get_option('download_button_hover_color', '#005177'))
        );
        wp_add_inline_style('download-button-style', $custom_css);
    }
}

new WP_Download_Button();
