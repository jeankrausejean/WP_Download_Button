<?php
if (!defined('ABSPATH')) {
    exit;
}

$font_families = WP_Download_Button_Settings::get_font_families();
$font_weights = WP_Download_Button_Settings::get_font_weights();
$font_sizes = WP_Download_Button_Settings::get_font_sizes();
?>

<tr>
    <th>Família da Fonte</th>
    <td>
        <select name="download_button_font_family">
            <?php foreach ($font_families as $name => $value) : ?>
                <option value="<?php echo esc_attr($value); ?>" 
                    <?php selected(get_option('download_button_font_family'), $value); ?>>
                    <?php echo esc_html($name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </td>
</tr>
<tr>
    <th>Peso da Fonte</th>
    <td>
        <select name="download_button_font_weight">
            <?php foreach ($font_weights as $name => $value) : ?>
                <option value="<?php echo esc_attr($value); ?>" 
                    <?php selected(get_option('download_button_font_weight'), $value); ?>>
                    <?php echo esc_html($name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </td>
</tr>
<tr>
    <th>Tamanho da Fonte</th>
    <td>
        <select name="download_button_font_size">
            <?php foreach ($font_sizes as $name => $value) : ?>
                <option value="<?php echo esc_attr($value); ?>" 
                    <?php selected(get_option('download_button_font_size'), $value); ?>>
                    <?php echo esc_html($name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </td>
</tr>