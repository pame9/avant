<?php
function apollo13_shortcode_pr_boxes($atts, $content = null, $code)
{
    extract(shortcode_atts(array(
        'bt_color' => ''
    ), $atts));
    $html = '<div class="pr_boxes"><style type="text/css" media="screen">';
    switch ($code) {
        case 'pr_big_boxes':
            $html .= '.pr_big_box_hl div.pr_box_footer .pr_button { background-color: ' . $bt_color . '; }
                div.pr_big_box_hl { border: 7px solid ' . $bt_color . ';  }';
            $html .= '</style>';
            break;
        case 'pr_medium_boxes':
            $html .= '.pr_medium_box_hl div.pr_box_footer .pr_button { background-color: ' . $bt_color . '; }
                div.pr_medium_box_hl { border: 7px solid ' . $bt_color . ';  }';
            $html .= '</style>';
            break;
        case 'pr_small_boxes':
            $html .= '.pr_small_box_hl div.pr_box_footer .pr_button { background-color: ' . $bt_color . '; }
                div.pr_small_box_hl { border: 7px solid ' . $bt_color . ';  }';
            $html .= '</style>';
            break;
    }
    $html .= do_shortcode(($content));
    $html .= '<div style="clear: both;"></div></div><div style="clear: both;"></div>';
    return $html;
}

add_shortcode('pr_big_boxes', 'apollo13_shortcode_pr_boxes');
function apollo13_shortcode_box_nr($atts, $content = null, $code)
{
    extract(shortcode_atts(array(
        'bt_color' => '',
        'price' => '',
        'per' => '',
        'title' => '',
        'item1' => '',
        'item2' => '',
        'item3' => '',
        'item4' => '',
        'bt_url' => ''
    ), $atts));
    switch ($code) {
        case 'big_box_1':
            $html = '<div class="pr_big_box">';
            break;
        case 'big_box_2':
            $html = '<div class="pr_big_box_hl">';
            break;
        case 'big_box_3':
            $html = '<div class="pr_big_box" style="margin-right: 0px;">';
            break;
        case 'medium_box_1':
            $html = '<div class="pr_medium_box">';
            break;
        case 'medium_box_2':
            $html = '<div class="pr_medium_box">';
            break;
        case 'medium_box_3':
            $html = '<div class="pr_medium_box_hl">';
            break;
        case 'medium_box_4':
            $html = '<div class="pr_medium_box" style="margin-right: 0px;">';
            break;
        case 'small_box_1':
            $html = '<div class="pr_small_box">';
            break;
        case 'small_box_2':
            $html = '<div class="pr_small_box">';
            break;
        case 'small_box_3':
            $html = '<div class="pr_small_box_hl">';
            break;
        case 'small_box_4':
            $html = '<div class="pr_small_box">';
            break;
        case 'small_box_5':
            $html = '<div class="pr_small_box" style="margin-right: 0px;">';
            break;
    }
    $html .= '<div class="pr_box_head">';
    $html .= '<span class="pr_box_price no_content_font">' . $price . '</span>/' . $per;
    $html .= '</div>';
    $html .= '<div class="pr_box_content">';
    $html .= '<div class="pr_box_title no_content_font">' . $title . '</div>';
    $html .= '<div class="pr_box_item">' . $item1 . '</div>';
    $html .= '<div class="pr_box_item">' . $item2 . '</div>';
    $html .= '<div class="pr_box_item">' . $item3 . '</div>';
    $html .= '<div class="pr_box_item pr_box_item_last">' . $item4 . '</div>';
    $html .= '</div>';
    $html .= '<div class="pr_box_footer">';
    if ($code == 'big_box_2' || $code == 'medium_box_3' || $code == 'small_box_3') {
        $html .= '<a class="sc_button pr_button no_content_font" href="' . $bt_url . '">';
    } else {
        $html .= '<a class="sc_button no_content_font" href="' . $bt_url . '">';
    }
    $html .= __('Read more', TPL_SLUG);
    $html .= '</a>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}

add_shortcode('big_box_1', 'apollo13_shortcode_box_nr');
add_shortcode('big_box_3', 'apollo13_shortcode_box_nr');
add_shortcode('big_box_2', 'apollo13_shortcode_box_nr');
add_shortcode('pr_medium_boxes', 'apollo13_shortcode_pr_boxes');
add_shortcode('medium_box_1', 'apollo13_shortcode_box_nr');
add_shortcode('medium_box_2', 'apollo13_shortcode_box_nr');
add_shortcode('medium_box_3', 'apollo13_shortcode_box_nr');
add_shortcode('medium_box_4', 'apollo13_shortcode_box_nr');
add_shortcode('pr_small_boxes', 'apollo13_shortcode_pr_boxes');
add_shortcode('small_box_1', 'apollo13_shortcode_box_nr');
add_shortcode('small_box_2', 'apollo13_shortcode_box_nr');
add_shortcode('small_box_3', 'apollo13_shortcode_box_nr');
add_shortcode('small_box_4', 'apollo13_shortcode_box_nr');
add_shortcode('small_box_5', 'apollo13_shortcode_box_nr');
?>