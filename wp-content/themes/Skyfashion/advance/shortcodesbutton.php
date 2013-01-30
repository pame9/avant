<?php
$absolute_path = __FILE__;
$path_to_file = explode('wp-content', $absolute_path);
$path_to_wp = $path_to_file[0];
//Access WordPress
require_once($path_to_wp . '/wp-load.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>
<div id="main-shortcodes">
<div id="shortcode-generator">
<select id="shortcode-categories" name="shortcode-categories">
    <option value="">Select category</option>
    <option value="typography">Typography</option>
    <option value="pricing_boxes">Pricing Boxes</option>
    <option value="toggles">Tabs</option>
    <option value="button">Button</option>
    <option value="accordions">Accordion</option>
    <option value="columns">Columns</option>
    <option value="video">Video</option>
</select>
<select id="apollo13-typography-codes" name="apollo13-typography-codes" class="shortcodes-codes">
    <option value="blockquote">Blockquote</option>
    <option value="hightlighting">Hightlighting</option>
    <option value="dropcaps">Dropcaps</option>
    <option value="image">Image with lightbox</option>
</select>

<div id="apollo13-blockquote-fields" class="shortcodes-fields apollo13-settings">
    <div class="select-input attr"><label><span class="label-name">Align</span><select id="apollo13-blockquote-align" class="attr" name="apollo13-blockquote-align">
        <option value="left" selected="selected">left</option>
        <option value="center">center</option>
        <option value="right">right</option>
    </select></label></div>
    <div class="textarea-input content"><label><span class="label-name">Content</span><textarea id="apollo13-blockquote-content" class="content" name="apollo13-blockquote-content"></textarea></label></div>
</div>
<div id="apollo13-hightlighting-fields" class="shortcodes-fields apollo13-settings">
    <div class="color-input attr"><label><span class="label-name">Text color</span><input id="apollo13-hightlighting-text_color" type="text" class="with-color attr" name="apollo13-hightlighting-text_color" value=""/></label></div>
    <div class="color-input attr"><label><span class="label-name">Hightlighting color</span><input id="apollo13-hightlighting-hightlighting_color" type="text" class="with-color attr" name="apollo13-hightlighting-hightlighting_color" value=""/></label></div>
    <div class="textarea-input content"><label><span class="label-name">Text</span><textarea id="apollo13-hightlighting-text" class="content" name="apollo13-hightlighting-text"></textarea></label></div>
</div>
<div id="apollo13-dropcaps-fields" class="shortcodes-fields apollo13-settings">
    <div class="color-input attr"><label><span class="label-name">Text color</span><input id="apollo13-dropcaps-text_color" type="text" class="with-color attr" name="apollo13-dropcaps-text_color" value=""/></label></div>
    <div class="color-input attr"><label><span class="label-name">Background color</span><input id="apollo13-dropcaps-hightlighting_color" type="text" class="with-color attr" name="apollo13-dropcaps-hightlighting_color" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Font size</span><input id="apollo13-dropcaps-font_size" class="attr" type="text" size="36" name="apollo13-dropcaps-font_size" value=""/></label></div>
    <div class="text-input content"><label><span class="label-name">Text</span><input id="apollo13-dropcaps-text" class="content" type="text" size="36" name="apollo13-dropcaps-text" value=""/></label></div>
</div>
<div id="apollo13-image-fields" class="shortcodes-fields apollo13-settings">
    <div class="select-input attr"><label><span class="label-name">Align</span><select id="apollo13-image-align" class="attr" name="apollo13-image-align">
        <option value="none" selected="selected">none</option>
        <option value="left">left</option>
        <option value="right">right</option>
    </select></label></div>
    <div class="upload-input attr"><label><span class="label-name">Image</span><input id="apollo13-image-img" class="attr" type="text" size="36" name="apollo13-image-img" value=""/></label><input id="upload_apollo13-image-img" class="upload-image-button attr" type="button" value="Upload Image"/></div>
    <div class="upload-input attr"><label><span class="label-name">url</span><input id="apollo13-image-url" class="attr" type="text" size="36" name="apollo13-image-url" value=""/></label><input id="upload_apollo13-image-url" class="upload-image-button attr" type="button" value="Upload Image"/></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-image-alt" class="attr" type="text" size="36" name="apollo13-image-alt" value=""/></label></div>
    <div class="radio-input attr"><span class="label-like">Border</span><label><input type="radio" name="apollo13-image-border" class="attr" value="on" checked="checked"/>Yes</label><label><input type="radio" name="apollo13-image-border" class="attr" value="off"/>No</label></div>
</div>
<select id="apollo13-pricing_boxes-codes" name="apollo13-pricing_boxes-codes" class="shortcodes-codes">
    <option value="pr_big_boxes">Big</option>
    <option value="pr__medium_boxes">Medium</option>
    <option value="pr_small_boxes">Small</option>
</select>

<div id="apollo13-pr_big_boxes-fields" class="shortcodes-fields apollo13-settings">
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr_big_boxes-price-big_box_1" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-price-big_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr_big_boxes-per-big_box_1" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-per-big_box_1" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr_big_boxes-title-big_box_1" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-title-big_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr_big_boxes-item1-big_box_1" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item1-big_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr_big_boxes-item2-big_box_1" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item2-big_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr_big_boxes-item3-big_box_1" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item3-big_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr_big_boxes-item4-big_box_1" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item4-big_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr_big_boxes-bt_url-big_box_1" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-bt_url-big_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr_big_boxes-price-big_box_2" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-price-big_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr_big_boxes-per-big_box_2" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-per-big_box_2" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr_big_boxes-title-big_box_2" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-title-big_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr_big_boxes-item1-big_box_2" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item1-big_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr_big_boxes-item2-big_box_2" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item2-big_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr_big_boxes-item3-big_box_2" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item3-big_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr_big_boxes-item4-big_box_2" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item4-big_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr_big_boxes-bt_url-big_box_2" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-bt_url-big_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr_big_boxes-price-big_box_3" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-price-big_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr_big_boxes-per-big_box_3" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-per-big_box_3" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr_big_boxes-title-big_box_3" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-title-big_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr_big_boxes-item1-big_box_3" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item1-big_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr_big_boxes-item2-big_box_3" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item2-big_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr_big_boxes-item3-big_box_3" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item3-big_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr_big_boxes-item4-big_box_3" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-item4-big_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr_big_boxes-bt_url-big_box_3" class="attr" type="text" size="36" name="apollo13-pr_big_boxes-bt_url-big_box_3" value=""/></label></div>
    <div class="color-input attr"><label><span class="label-name">Button color</span><input id="apollo13-pr_big_boxes-bt_color" type="text" class="with-color attr" name="apollo13-pr_big_boxes-bt_color" value=""/></label></div>
</div>
<div id="apollo13-pr__medium_boxes-fields" class="shortcodes-fields apollo13-settings">
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr__medium_boxes-price-medium_box_1" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-price-medium_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr__medium_boxes-per-medium_box_1" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-per-medium_box_1" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr__medium_boxes-title-medium_box_1" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-title-medium_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr__medium_boxes-item1-medium_box_1" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item1-medium_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr__medium_boxes-item2-medium_box_1" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item2-medium_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr__medium_boxes-item3-medium_box_1" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item3-medium_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr__medium_boxes-item4-medium_box_1" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item4-medium_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr__medium_boxes-bt_url-medium_box_1" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-bt_url-medium_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr__medium_boxes-price-medium_box_2" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-price-medium_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr__medium_boxes-per-medium_box_2" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-per-medium_box_2" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr__medium_boxes-title-medium_box_2" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-title-medium_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr__medium_boxes-item1-medium_box_2" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item1-medium_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr__medium_boxes-item2-medium_box_2" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item2-medium_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr__medium_boxes-item3-medium_box_2" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item3-medium_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr__medium_boxes-item4-medium_box_2" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item4-medium_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr__medium_boxes-bt_url-medium_box_2" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-bt_url-medium_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr__medium_boxes-price-medium_box_3" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-price-medium_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr__medium_boxes-per-medium_box_3" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-per-medium_box_3" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr__medium_boxes-title-medium_box_3" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-title-medium_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr__medium_boxes-item1-medium_box_3" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item1-medium_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr__medium_boxes-item2-medium_box_3" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item2-medium_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr__medium_boxes-item3-medium_box_3" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item3-medium_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr__medium_boxes-item4-medium_box_3" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item4-medium_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr__medium_boxes-bt_url-medium_box_3" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-bt_url-medium_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr__medium_boxes-price-medium_box_4" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-price-medium_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr__medium_boxes-per-medium_box_4" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-per-medium_box_4" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr__medium_boxes-title-medium_box_4" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-title-medium_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr__medium_boxes-item1-medium_box_4" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item1-medium_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr__medium_boxes-item2-medium_box_4" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item2-medium_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr__medium_boxes-item3-medium_box_4" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item3-medium_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr__medium_boxes-item4-medium_box_4" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-item4-medium_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr__medium_boxes-bt_url-medium_box_4" class="attr" type="text" size="36" name="apollo13-pr__medium_boxes-bt_url-medium_box_4" value=""/></label></div>
    <div class="color-input attr"><label><span class="label-name">Button color</span><input id="apollo13-pr__medium_boxes-bt_color" type="text" class="with-color attr" name="apollo13-pr__medium_boxes-bt_color" value=""/></label></div>
</div>
<div id="apollo13-pr_small_boxes-fields" class="shortcodes-fields apollo13-settings">
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr_small_boxes-price-small_box_1" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-price-small_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr_small_boxes-per-small_box_1" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-per-small_box_1" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr_small_boxes-title-small_box_1" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-title-small_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr_small_boxes-item1-small_box_1" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item1-small_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr_small_boxes-item2-small_box_1" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item2-small_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr_small_boxes-item3-small_box_1" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item3-small_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr_small_boxes-item4-small_box_1" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item4-small_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr_small_boxes-bt_url-small_box_1" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-bt_url-small_box_1" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr_small_boxes-price-small_box_2" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-price-small_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr_small_boxes-per-small_box_2" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-per-small_box_2" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr_small_boxes-title-small_box_2" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-title-small_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr_small_boxes-item1-small_box_2" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item1-small_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr_small_boxes-item2-small_box_2" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item2-small_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr_small_boxes-item3-small_box_2" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item3-small_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr_small_boxes-item4-small_box_2" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item4-small_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr_small_boxes-bt_url-small_box_2" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-bt_url-small_box_2" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr_small_boxes-price-small_box_3" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-price-small_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr_small_boxes-per-small_box_3" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-per-small_box_3" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr_small_boxes-title-small_box_3" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-title-small_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr_small_boxes-item1-small_box_3" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item1-small_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr_small_boxes-item2-small_box_3" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item2-small_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr_small_boxes-item3-small_box_3" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item3-small_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr_small_boxes-item4-small_box_3" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item4-small_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr_small_boxes-bt_url-small_box_3" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-bt_url-small_box_3" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr_small_boxes-price-small_box_4" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-price-small_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr_small_boxes-per-small_box_4" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-per-small_box_4" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr_small_boxes-title-small_box_4" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-title-small_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr_small_boxes-item1-small_box_4" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item1-small_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr_small_boxes-item2-small_box_4" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item2-small_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr_small_boxes-item3-small_box_4" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item3-small_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr_small_boxes-item4-small_box_4" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item4-small_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr_small_boxes-bt_url-small_box_4" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-bt_url-small_box_4" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Price</span><input id="apollo13-pr_small_boxes-price-small_box_5" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-price-small_box_5" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Per</span><input id="apollo13-pr_small_boxes-per-small_box_5" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-per-small_box_5" value="MONTH"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Title</span><input id="apollo13-pr_small_boxes-title-small_box_5" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-title-small_box_5" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 1</span><input id="apollo13-pr_small_boxes-item1-small_box_5" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item1-small_box_5" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 2</span><input id="apollo13-pr_small_boxes-item2-small_box_5" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item2-small_box_5" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 3</span><input id="apollo13-pr_small_boxes-item3-small_box_5" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item3-small_box_5" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Item 4</span><input id="apollo13-pr_small_boxes-item4-small_box_5" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-item4-small_box_5" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Button url</span><input id="apollo13-pr_small_boxes-bt_url-small_box_5" class="attr" type="text" size="36" name="apollo13-pr_small_boxes-bt_url-small_box_5" value=""/></label></div>
    <div class="color-input attr"><label><span class="label-name">Button color</span><input id="apollo13-pr_small_boxes-bt_color" type="text" class="with-color attr" name="apollo13-pr_small_boxes-bt_color" value=""/></label></div>
</div>
<select id="apollo13-toggles-codes" name="apollo13-toggles-codes" class="shortcodes-codes">
    <option value="tabs">Tabs</option>
</select>

<div id="apollo13-tabs-fields" class="shortcodes-fields apollo13-settings">
    <div class="text-input attr additive"><label><span class="label-name">Title</span><input id="apollo13-tabs-title-tab-1" class="attr additive" type="text" size="36" name="apollo13-tabs-title-tab-1" value=""/></label></div>
    <div class="textarea-input content additive"><label><span class="label-name">Content</span><textarea id="apollo13-tabs-content-tab-1" class="content additive" name="apollo13-tabs-content-tab-1"></textarea></label></div>
    <div class="add-more-parent"><span class="button add-more-fields"><span>+</span>Add more fields</span></div>
</div>
<select id="apollo13-button-codes" name="apollo13-button-codes" class="shortcodes-codes">
    <option value="button">Button</option>
</select>

<div id="apollo13-button-fields" class="shortcodes-fields apollo13-settings">
    <div class="color-input attr"><label><span class="label-name">Text color</span><input id="apollo13-button-text_color" type="text" class="with-color attr" name="apollo13-button-text_color" value=""/></label></div>
    <div class="color-input attr"><label><span class="label-name">Background color</span><input id="apollo13-button-background_color" type="text" class="with-color attr" name="apollo13-button-background_color" value=""/></label></div>
    <div class="text-input content"><label><span class="label-name">Label</span><input id="apollo13-button-text" class="content" type="text" size="36" name="apollo13-button-text" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">URL</span><input id="apollo13-button-url" class="attr" type="text" size="36" name="apollo13-button-url" value=""/></label></div>
</div>
<select id="apollo13-accordions-codes" name="apollo13-accordions-codes" class="shortcodes-codes">
    <option value="accordion">Accordion</option>
</select>

<div id="apollo13-accordion-fields" class="shortcodes-fields apollo13-settings">
    <div class="text-input attr additive"><label><span class="label-name">Title</span><input id="apollo13-accordion-title-acc-1" class="attr additive" type="text" size="36" name="apollo13-accordion-title-acc-1" value=""/></label></div>
    <div class="textarea-input content additive"><label><span class="label-name">Content</span><textarea id="apollo13-accordion-content-acc-1" class="content additive" name="apollo13-accordion-content-acc-1"></textarea></label></div>
    <div class="add-more-parent"><span class="button add-more-fields"><span>+</span>Add more fields</span></div>
</div>
<select id="apollo13-columns-codes" name="apollo13-columns-codes" class="shortcodes-codes">
    <option value="nocodecols50">Column 50%</option>
    <option value="nocodecols33">Column 33%</option>
    <option value="nocodecols25">Column 25%</option>
    <option value="nocodecols20">Column 20%</option>
    <option value="nocodecols65l">Left 65%</option>
    <option value="nocodecols65r">Right 65%</option>
    <option value="line">Line</option>
    <option value="clear">Clear</option>
</select>

<div id="apollo13-nocodecols50-fields" class="shortcodes-fields apollo13-settings">
    <div class="textarea-input content"><label><span class="label-name">Left 50%</span><textarea id="apollo13-nocodecols50-content-left50" class="content" name="apollo13-nocodecols50-content-left50"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Right 50%</span><textarea id="apollo13-nocodecols50-content-right50" class="content" name="apollo13-nocodecols50-content-right50"></textarea></label></div>
    <div class="radio-input addclear"><span class="label-like">Add clear</span><label><input type="radio" name="apollo13-nocodecols50-addclear-clear" class="addclear" value="on" checked="checked"/>Yes</label><label><input type="radio" name="apollo13-nocodecols50-addclear-clear" class="addclear" value="off"/>No</label>
    </div>
</div>
<div id="apollo13-nocodecols33-fields" class="shortcodes-fields apollo13-settings">
    <div class="textarea-input content"><label><span class="label-name">Left 33%</span><textarea id="apollo13-nocodecols33-content-left33" class="content" name="apollo13-nocodecols33-content-left33"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Center 33%</span><textarea id="apollo13-nocodecols33-content-center33" class="content" name="apollo13-nocodecols33-content-center33"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Right 33%</span><textarea id="apollo13-nocodecols33-content-right33" class="content" name="apollo13-nocodecols33-content-right33"></textarea></label></div>
    <div class="radio-input addclear"><span class="label-like">Add clear</span><label><input type="radio" name="apollo13-nocodecols33-addclear-clear" class="addclear" value="on" checked="checked"/>Yes</label><label><input type="radio" name="apollo13-nocodecols33-addclear-clear" class="addclear" value="off"/>No</label>
    </div>
</div>
<div id="apollo13-nocodecols25-fields" class="shortcodes-fields apollo13-settings">
    <div class="textarea-input content"><label><span class="label-name">Left 25%</span><textarea id="apollo13-nocodecols25-content-left25" class="content" name="apollo13-nocodecols25-content-left25"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Center 25%</span><textarea id="apollo13-nocodecols25-content-center25-1" class="content" name="apollo13-nocodecols25-content-center25-1"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Center 25%</span><textarea id="apollo13-nocodecols25-content-center25-2" class="content" name="apollo13-nocodecols25-content-center25-2"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Right 25%</span><textarea id="apollo13-nocodecols25-content-right25" class="content" name="apollo13-nocodecols25-content-right25"></textarea></label></div>
    <div class="radio-input addclear"><span class="label-like">Add clear</span><label><input type="radio" name="apollo13-nocodecols25-addclear-clear" class="addclear" value="on" checked="checked"/>Yes</label><label><input type="radio" name="apollo13-nocodecols25-addclear-clear" class="addclear" value="off"/>No</label>
    </div>
</div>
<div id="apollo13-nocodecols20-fields" class="shortcodes-fields apollo13-settings">
    <div class="textarea-input content"><label><span class="label-name">Left 20%</span><textarea id="apollo13-nocodecols20-content-left20" class="content" name="apollo13-nocodecols20-content-left20"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Center 20%</span><textarea id="apollo13-nocodecols20-content-center20-1" class="content" name="apollo13-nocodecols20-content-center20-1"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Center 20%</span><textarea id="apollo13-nocodecols20-content-center20-2" class="content" name="apollo13-nocodecols20-content-center20-2"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Center 20%</span><textarea id="apollo13-nocodecols20-content-center20-3" class="content" name="apollo13-nocodecols20-content-center20-3"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Right 20%</span><textarea id="apollo13-nocodecols20-content-right20" class="content" name="apollo13-nocodecols20-content-right20"></textarea></label></div>
    <div class="radio-input addclear"><span class="label-like">Add clear</span><label><input type="radio" name="apollo13-nocodecols20-addclear-clear" class="addclear" value="on" checked="checked"/>Yes</label><label><input type="radio" name="apollo13-nocodecols20-addclear-clear" class="addclear" value="off"/>No</label>
    </div>
</div>
<div id="apollo13-nocodecols65l-fields" class="shortcodes-fields apollo13-settings">
    <div class="textarea-input content"><label><span class="label-name">Left 65%</span><textarea id="apollo13-nocodecols65l-content-left65" class="content" name="apollo13-nocodecols65l-content-left65"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Right 25%</span><textarea id="apollo13-nocodecols65l-content-right25" class="content" name="apollo13-nocodecols65l-content-right25"></textarea></label></div>
    <div class="radio-input addclear"><span class="label-like">Add clear</span><label><input type="radio" name="apollo13-nocodecols65l-addclear-clear" class="addclear" value="on" checked="checked"/>Yes</label><label><input type="radio" name="apollo13-nocodecols65l-addclear-clear" class="addclear"
                                                                                                                                                                                                                               value="off"/>No</label>
    </div>
</div>
<div id="apollo13-nocodecols65r-fields" class="shortcodes-fields apollo13-settings">
    <div class="textarea-input content"><label><span class="label-name">Right 65%</span><textarea id="apollo13-nocodecols65r-content-right65" class="content" name="apollo13-nocodecols65r-content-right65"></textarea></label></div>
    <div class="textarea-input content"><label><span class="label-name">Left 25%</span><textarea id="apollo13-nocodecols65r-content-left25" class="content" name="apollo13-nocodecols65r-content-left25"></textarea></label></div>
    <div class="radio-input addclear"><span class="label-like">Add clear</span><label><input type="radio" name="apollo13-nocodecols65r-addclear-clear" class="addclear" value="on" checked="checked"/>Yes</label><label><input type="radio" name="apollo13-nocodecols65r-addclear-clear" class="addclear"
                                                                                                                                                                                                                               value="off"/>No</label>
    </div>
</div>
<div id="apollo13-line-fields" class="shortcodes-fields apollo13-settings"></div>
<div id="apollo13-clear-fields" class="shortcodes-fields apollo13-settings"></div>
<select id="apollo13-video-codes" name="apollo13-video-codes" class="shortcodes-codes">
    <option value="video">Video</option>
</select>

<div id="apollo13-video-fields" class="shortcodes-fields apollo13-settings">
    <div class="select-input attr"><label><span class="label-name">Type</span><select id="apollo13-video-type" class="attr" name="apollo13-video-type">
        <option value="youtube" selected="selected">youtube</option>
        <option value="vimeo">vimeo</option>
    </select></label></div>
    <div class="text-input attr"><label><span class="label-name">Movie id, or movie link</span><input id="apollo13-video-src" class="attr" type="text" size="36" name="apollo13-video-src" value=""/></label></div>
    <div class="text-input attr"><label><span class="label-name">Height</span><input id="apollo13-video-height" class="attr" type="text" size="36" name="apollo13-video-height" value="335"/></label></div>
    <div class="text-input attr"><label><span class="label-name">Width</span><input id="apollo13-video-width" class="attr" type="text" size="36" name="apollo13-video-width" value="595"/></label></div>
    <div class="radio-input attr"><span class="label-like">Autoplay</span><label><input type="radio" name="apollo13-video-autoplay" class="attr" value="on"/>On</label><label><input type="radio" name="apollo13-video-autoplay" class="attr" value="off" checked="checked"/>Off</label></div>
</div>
<span class="button" id="send-to-editor">Insert code in editor</span></div>
</div>
</div>
<!-- end #main -->
<script lang="javascript">
    jQuery(document).ready(function ($) {
        if ($('#shortcode-generator').length) {
            //hide generated html
            $('.shortcodes-codes, .shortcodes-fields').hide();
            $('select#shortcode-categories').val('').change(function () {
                $('.shortcodes-codes, .shortcodes-fields').hide();
                $('#apollo13-' + $(this).val() + '-codes').show().change();
            });
            $('select.shortcodes-codes').change(function () {
                $('.shortcodes-fields').hide();
                $('#apollo13-' + $(this).val() + '-fields').show()
            });
            $('#main-shortcodes .add-more-fields').click(function () {
                mark = $(this).parent();
                insert = $('<fieldset class="added"></fieldset>').insertBefore(mark);
                mark.siblings('.additive').clone().appendTo(insert);
                //stored data about number of new elements
                new_number = mark.parent().data('number');
                if (!new_number) {
                    new_number = 1;
                    mark.parent().data('number', new_number);
                }
                else {
                    new_number = parseInt(new_number) + 1;
                    mark.parent().data('number', new_number);
                }
                //make uniq id of cloned elments
                insert.find('.additive').not('div').each(function () {
                    id = $(this).attr('id');
                    $(this).attr('id', id + new_number).attr('name', id + new_number);
                });
                //add remove button
                $('<span class="button">Remove fields</span>').appendTo(insert).click(function () {
                    $(this).parent().remove();
                });
                //add upload bind to new buttons
                insert.find('.upload-image-button').click(air_upload_image);
            });
            $('#send-to-editor').click(function () {
                tag = $('#shortcode-generator .shortcodes-codes:visible').eq(0).val();
                if (!tag) {
                    return;
                }
                attr = '';
                content = '';
                code = '';
                subtags = {};
                addclear = false;
                div = $('#shortcode-generator .shortcodes-fields:visible');
                fields = div.find('input[type="text"], input[type="radio"]:checked, select, textarea');
                //parse info from id, class of each field
                fields.each(function () {
                    //get info form field
                    if ($(this).attr('id'))
                        data = $(this).attr('id').split("-");
                    else
                        data = $(this).attr('name').split("-");
                    //if subtag is present
                    if (data[3]) {
                        if ($(this).hasClass('addclear')) {
                            if ($(this).val() == 'on')
                                addclear = true;
                            // skip other operations for this tag
                            return;
                        }
                        //making key name
                        key = data[3];
                        if (data[4]) {
                            key += '-' + data[4];
                        }
                        if (!subtags[key])//if not exists we create key position
                            subtags[key] = {'attr':'', 'content':''};
                        if ($(this).hasClass('attr')) {
                            value = $(this).val();
                            if (value == 'default' || value == '')
                                ;
                            else {
                                subtags[key]['attr'] += ' ' + data[2] + '="' + value + '"';
                            }
                        }
                        else if ($(this).hasClass('content')) {
                            subtags[key]['content'] += $(this).val();
                        }
                    }
                    //no subtag
                    else {
                        if ($(this).hasClass('attr')) {
                            value = $(this).val();
                            if (value == 'default' || value == '');
                            else {
                                attr += ' ' + data[2] + '="' + value + '"';
                            }
                        }
                        else if ($(this).hasClass('content')) {
                            content += $(this).val();
                        }
                    }
                });
                //ufff
                //now we parse subtags if they exist
                subtags_code = ''
                $.each(subtags, function (key, value) {
                    key = key.split("-")[0];//no numbers part(-1,-2, etc.)
                    subtags_code += ' [' + key + value['attr'] + '] ' + value['content'] + ' [/' + key + '] ';
                });
                //and return code
                //one tag shortcode
                if (subtags_code == '' && attr == '' && content == '') {
                    code = code = ' [' + tag + '] ';
                }
                //no content - selfclose one tag shortcode ([image atribs /])
                else if (subtags_code == '' && content == '') {
                    code = code = ' [' + tag + attr + ' /] ';
                }
                //subtags but no main tag
                else if (tag.substring(0, 6) == 'nocode') {
                    code = subtags_code;
                }
                //normal shortocode or sortcode with subtags
                else {
                    if (content != '')
                        content = ' ' + content + ' ';
                    code = ' [' + tag + attr + ']' + content + subtags_code + '[/' + tag + '] ';
                }
                // clear for columns
                if (addclear)
                    code += '[clear] ';
                window.send_to_editor(code);
//			alert(code);
            });
        }
    });
</script>
<script>jQuery('.option').hide();</script>
</body>
</html>