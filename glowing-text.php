<?php
/*
Plugin Name: WP Glowing Text Effect 
Description: Add a glowing text effect to your WordPress site. [custom_text font_size="2.0rem" text_color="#ffff" text_align="center"]We work towards ensuring a life fr.....[/custom_text]

Version: 1.0
Author: Hassan Naqvi
*/

function add_glowing_text_effect() {
 
    
    // Enqueue custom script
    wp_enqueue_script('glowing-text-script', plugin_dir_url(__FILE__) . 'script.js', array('jquery'), '1.0', true);

    // Enqueue custom styles
    wp_enqueue_style('glowing-text-style', plugin_dir_url(__FILE__) . 'style.css', array(), '1.0');
}

add_action('wp_enqueue_scripts', 'add_glowing_text_effect');
function custom_text_shortcode($atts, $content = null) {
    // Extract shortcode attributes
    $atts = shortcode_atts(
        array(
            'font_size' => '1rem', // Default responsive font size
            'text_color' => '#000000', // Default text color
            'text_align' => 'left', // Default text alignment
        ),
        $atts,
        'custom_text'
    );

    // Sanitize font size, text color, and text alignment attributes
    $font_size = sanitize_text_field($atts['font_size']);
    $text_color = sanitize_text_field($atts['text_color']); // Change this line
    $text_align = sanitize_text_field($atts['text_align']);

    // Output the HTML with custom content, responsive font size, text color, and text alignment
    $output = '<header class="mast__header">';
    $output .= '<h3 class="mast__text js-spanize" style="font-size: ' . esc_attr($font_size) . '; color: ' . esc_attr($text_color) . '; text-align: ' . esc_attr($text_align) . '; word-wrap: break-word;">' . wp_kses_post($content) . '</h3>';
    $output .= '</header>';

    return $output;
}

// Register the shortcode
add_shortcode('custom_text', 'custom_text_shortcode');