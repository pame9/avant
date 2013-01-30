<?php
function apollo13_shortcode_button($atts, $content = null, $code)
{
    extract(shortcode_atts(array(
        'url' => '',
        'text_color' => '',
        'background_color' => ''
    ), $atts));
    if (empty($url))
        return;
    $style = 'style="';
    $style .= 'color: ' . $text_color . '; ';
    $style .= 'background-color:' . $background_color . ';';
    $style .= '" ';
    $html = '<p class="sc_button_p no_content_font"><a class="sc_button" ' . $style . ' href="' . $url . '">';
    $html .= do_shortcode(($content));
    $html .= '</a></p>';
    return $html;
}

add_shortcode('button', 'apollo13_shortcode_button');
?>