<?php
function apollo13_shortcode_accordion($atts, $content = null, $code)
{
    if (!preg_match_all("/\[acc\b\s([^]]*)\](.*?)\[\/acc\]/s", $content, $matches)) {
        return do_shortcode($content);
    } else {
        for ($i = 0; $i < count($matches[0]); $i++) {
            $matches[1][$i] = shortcode_parse_atts($matches[1][$i]);
        }
        $html = '<div class="accordion">';
        for ($i = 0; $i < count($matches[0]); $i++) {
            if ($i != count($matches[0]) - 1) {
                $html .= '<div class="acc">';
            } else {
                $html .= '<div class="acc last_acc">';
            }
            $html .= '<div class="acc_title"><span>' . $matches[1][$i]['title'] . '</span></div>';
            $html .= '<div  class="acc_content">
			'; //space top open <p> by filter
            $html .= do_shortcode($matches[2][$i]);
            $html .= '</div>';
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }
}

add_shortcode('accordion', 'apollo13_shortcode_accordion');
