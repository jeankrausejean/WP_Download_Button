<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
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