<?php
if (!defined('ABSPATH')) {
    exit;
}
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
                <th>Posição do Botão</th>
                <td>
                    <select name="download_button_position">
                        <option value="after" <?php selected(get_option('download_button_position', 'after'), 'after'); ?>>Abaixo do conteúdo</option>
                        <option value="before" <?php selected(get_option('download_button_position'), 'before'); ?>>Acima do conteúdo</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Alinhamento do Botão</th>
                <td>
                    <select name="download_button_alignment">
                        <option value="left" <?php selected(get_option('download_button_alignment'), 'left'); ?>>Esquerda</option>
                        <option value="center" <?php selected(get_option('download_button_alignment', 'center'), 'center'); ?>>Centro</option>
                        <option value="right" <?php selected(get_option('download_button_alignment'), 'right'); ?>>Direita</option>
                        <option value="justify" <?php selected(get_option('download_button_alignment'), 'justify'); ?>>Justificado</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Família da Fonte</th>
                <td>
                    <select name="download_button_font_family">
                        <option value="Arial, sans-serif" <?php selected(get_option('download_button_font_family'), 'Arial, sans-serif'); ?>>Arial</option>
                        <option value="Helvetica, Arial, sans-serif" <?php selected(get_option('download_button_font_family'), 'Helvetica, Arial, sans-serif'); ?>>Helvetica</option>
                        <option value="Georgia, serif" <?php selected(get_option('download_button_font_family'), 'Georgia, serif'); ?>>Georgia</option>
                        <option value="Times New Roman, serif" <?php selected(get_option('download_button_font_family'), 'Times New Roman, serif'); ?>>Times New Roman</option>
                        <option value="Verdana, sans-serif" <?php selected(get_option('download_button_font_family'), 'Verdana, sans-serif'); ?>>Verdana</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Peso da Fonte</th>
                <td>
                    <select name="download_button_font_weight">
                        <option value="400" <?php selected(get_option('download_button_font_weight'), '400'); ?>>Normal</option>
                        <option value="500" <?php selected(get_option('download_button_font_weight'), '500'); ?>>Médio</option>
                        <option value="600" <?php selected(get_option('download_button_font_weight'), '600'); ?>>Semi-Bold</option>
                        <option value="700" <?php selected(get_option('download_button_font_weight'), '700'); ?>>Bold</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Tamanho da Fonte</th>
                <td>
                    <select name="download_button_font_size">
                        <option value="14px" <?php selected(get_option('download_button_font_size'), '14px'); ?>>Pequeno</option>
                        <option value="16px" <?php selected(get_option('download_button_font_size'), '16px'); ?>>Médio</option>
                        <option value="18px" <?php selected(get_option('download_button_font_size'), '18px'); ?>>Grande</option>
                        <option value="20px" <?php selected(get_option('download_button_font_size'), '20px'); ?>>Extra Grande</option>
                    </select>
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