<?php
/*
Plugin Name: Flickrpress
Plugin URI: http://michael.tyson.id.au/wordpress/plugins/flickrpress
Description: Display Flickr items in the sidebar, or within pages and posts. Supports Flickr RSS, photostream, multiple photosets, favorites, filtering by tag and displaying random photos.
Version: 1.0.2
Author: Michael Tyson
Author URI: http://michael.tyson.id.au
*/
/*  Copyright 2008 Michael Tyson <mike@tyson.id.au>
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define("FLICKRPRESS_CACHE_MAX_AGE", 60 * 60); // Cache data for 1 hour
// =============================
// =        Controllers        =
// =============================
/**
 * Render widget
 *
 *  Allows multiple copies of widget to be used.  Derived from
 *  the built-in text widget, wp-includes/widgets.php:942
 *
 * @param args Widget arguments
 * @param params Multi-widget parameters
 * @since 0.1
 * @author Michael Tyson
 **/
function flickrpress_widget($args, $params = null)
{
    if (is_admin()) return; // Don't bother when admin
    // Load options specific to this widget instance
    if (is_numeric($params)) $params = array('number' => $params);
    $params = wp_parse_args($params, array('number' => -1));
    $id = $params['number'];
    $allOptions = get_option('flickrpress');
    if (!$allOptions) $allOptions = array();
    $options = &$allOptions[$id];
    $options = flickrpress_initialise_options($options);
    $oldCache = $cache = isset($options['cache']) ? $options['cache'] : '';
    require_once('includes/interface.php');
    $total = 0;
    $items = flickrpress_load_items($options, &$cache, 0, &$total);
    if ($oldCache != $cache) {
        // Cache has been updated; save it
        $options['cache'] = $cache;
        update_option('flickrpress', $allOptions);
    }
    echo $args['before_widget'];
    if ($options['title']) {
        global $apollo13;
        echo $args['before_title'] . htmlspecialchars($options['title']) . $args['after_title'];
    }
    flickrpress_render($items, $total, $options, 'widget', $id);
    echo $args['after_widget'];
}

/**
 * Shortcode function
 *
 *  Available parameters:
 *      type        One of: 'rss', 'photostream', 'sets', 'favorites'
 *      url         URL for RSS feed
 *      api_key     API Key for types other than RSS
 *      account     Account name, email or ID
 *      sets        Comma-separated list of photoset titles
 *      tags        Comma-separated list of tags to filter by (for photostream view)
 *      view        One of: 'squares' (view as squares), 'proportional' (proportional thumbnails) , 'large' (large thumbnails)
 *      count       Number of thumbnails to display
 *      paging      'true' to show page navigation, to move back and forward through pages of images (implemented using AJAX)
 *      random      'true' to display randomly
 *      lightbox    'true' to use Lightbox
 *      columns     Number of columns of images to display
 *
 * @param options Attributes from shortcode
 * @since 0.3
 * @author Michael Tyson
 **/
function flickrpress_shortcode($options)
{
    ob_start();
    $options = flickrpress_initialise_options(array_map('html_entity_decode', $options));
    $id = md5(@serialize($options));
    // Load cache, linked with post and hash of options
    global $post;
    if ($post && $post->ID) {
        $allCaches = (array)@unserialize(array_pop(get_post_meta($post->ID, 'flickrpress_cache')));
        $oldCache = $cache = $allCaches[$id];
    }
    require_once('includes/interface.php');
    $total = 0;
    $items = flickrpress_load_items($options, &$cache, 0, &$total);
    if ($oldCache != $cache && $post && $post->ID) {
        // Cache has been updated; save it
        $allCaches[$id] = $cache;
        update_post_meta($post->ID, 'flickrpress_cache', serialize($allCaches));
    }
    flickrpress_render($items, $total, $options, 'post', ($post ? $post->ID : 0) . ',' . $id);
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}

/**
 * Straight PHP function
 *
 *  Available parameters:
 *      type        One of: 'rss', 'photostream', 'sets', 'favorites'
 *      url         URL for RSS feed
 *      api_key     API Key for types other than RSS
 *      account     Account name, email or ID
 *      sets        Comma-separated list of photoset titles
 *      tags        Comma-separated list of tags to filter by (for photostream view)
 *      view        One of: 'squares' (view as squares), 'proportional' (proportional thumbnails) , 'large' (large thumbnails)
 *      count       Number of thumbnails to display
 *      paging      'true' to show page navigation, to move back and forward through pages of images (implemented using AJAX)
 *      random      'true' to display randomly
 *      lightbox    'true' to use Lightbox
 *      columns     Number of columns of images to display
 *
 * @param options Attributes from shortcode
 * @since 0.3
 * @author Michael Tyson
 **/
function flickrpress($options)
{
    if (!is_array($options)) $options = wp_parse_args($options);
    $options = flickrpress_initialise_options($options);
    // Load cache, linked with hash of arguments
    $id = md5(@serialize($options));
    $oldCache = $cache = get_option("flickrpress_cache_$id");
    require_once('includes/interface.php');
    $total = 0;
    $items = flickrpress_load_items($options, &$cache, 0, &$total);
    if ($oldCache != $cache) {
        // Cache has been updated; save it
        update_option("flickrpress_cache_$id", $cache);
    }
    flickrpress_render($items, $total, $options, 'php', $id);
}

/**
 * Handle AJAX paging queries
 *
 * @since 1.0
 * @author Michael Tyson
 **/
function flickrpress_run_ajax()
{
    $action = $_REQUEST['flickrpress_action'];
    if (!$action) return;
    list($type, $id) = explode(':', $_REQUEST['flickrpress_id']);
    switch ($type) {
        case 'widget':
            // Load widget options
            $allOptions = get_option('flickrpress');
            if (!$allOptions) $allOptions = array();
            $options = &$allOptions[$id];
            $cache = $options['cache'];
            break;
        case 'post':
            // Load cache from post metadata, and options from request
            $options = @unserialize(@base64_decode($_REQUEST['flickrpress_options']));
            list($postID, $id) = explode(',', $id);
            $allCaches = @unserialize(array_pop(get_post_meta($postID, 'flickrpress_cache')));
            $cache = $allCaches[$id];
            break;
        case 'php':
            // Load cache from option storage, and options from request
            $options = @unserialize(@base64_decode($_REQUEST['flickrpress_options']));
            $cache = get_option("flickrpress_cache_$id");
    }
    $options = flickrpress_initialise_options($options);
    $oldCache = $cache;
    $start = $_REQUEST['flickrpress_start'];
    if (!is_numeric($start)) $start = 0;
    if ($action == 'lastpage') {
        $start -= $options['count'];
        if ($start < 0) $start = 0;
    } else {
        $start += $options['count'];
    }
    require_once('includes/interface.php');
    $total = 0;
    $items = flickrpress_load_items($options, &$cache, $start, &$total);
    if ($oldCache != $cache) {
        // Cache has been updated; save it
        switch ($type) {
            case 'widget':
                $options['cache'] = $cache;
                update_option('flickrpress', $allOptions);
                break;
            case 'post':
                $allCaches[$id] = $cache;
                update_post_meta($postID, 'flickrpress_cache', serialize($allCaches));
                break;
            case 'php':
                update_option("flickrpress_cache_$id", $cache);
                break;
        }
    }
    if ($items) {
        ob_start();
        flickrpress_render_items($items, $options);
        $html = ob_get_contents();
        ob_end_clean();
    }
    header("Content-type: text/json");
    ?>{
"start": "<?php echo $start ?>",
"total": "<?php echo $total ?>",
"count": "<?php echo count($items) ?>",
"html": "<?php echo str_replace(array('"', "\n"), array('\"', '\n'), $html) ?>"
}<?php
    exit;
}

// =============================
// =         Defaults          =
// =============================
/**
 * Load default widget preferences
 *
 * @return Associative array of defaults
 * @since 0.1
 * @author Michael Tyson
 **/
function flickrpress_defaults()
{
    return array(
        'title' => __('Flickr'),
        'type' => 'rss',
        'url' => '',
        'api_key' => '',
        'account' => '',
        'sets' => '',
        'tags' => '',
        'view' => 'squares',
        'count' => 4,
        'paging' => false,
        'random' => false,
        'lightbox' => false
    );
}

/**
 * Initialise options
 *
 * @param options
 * @return Options with default values where appropriate
 * @since 1.0
 * @author Michael Tyson
 */
function flickrpress_initialise_options($options)
{
    if ($options['paging']) $options['random'] = false;
    if (!$options['count']) $options['count'] = 4;
    if (!$options['type']) $options['type'] = 'rss';
    return $options;
}

// =============================
// =        Renderers          =
// =============================
/**
 * Render entire view
 *
 * @param items Array of flickr items
 * @param total Total number of items
 * @param options Options array
 * @param type Type of caller: widget, post, or php
 * @param id ID of caller - id of post, widget number, or hash of php options
 * @since 1.0
 * @author Michael Tyson
 */
function flickrpress_render($items, $total, $options, $type, $id)
{
    ?>
<div class="flickrpress-container">
    <div class="flickrpress-items"><?php
        if ($items) {
            flickrpress_render_items($items, $options);
        } else {
            ?>
            <span class="flickrpress-container-error">Flickr is currently unavailable.</span>
            <?php
        }
        ?></div><?php
    if ($options['paging']) {
        ?>
        <div class="flickrpress-navigation">
            <div class="flickrpress-navigation-previous" style="display:none;">&laquo; Previous</div>
            <div class="flickrpress-navigation-next" <?php if ($total <= $options['count']) echo 'style="display:none"'; ?>>Next &raquo;</div>
        </div>
        <?php if ($type != 'widget') : ?>
            <input type="hidden" name="flickrpress-options" value="<?php echo base64_encode(serialize($options)); ?>"/>
            <?php endif; ?>
        <input type="hidden" name="flickrpress-id" value="<?php echo "$type:$id" ?>"/>
        <?php
    }
    ?></div><?php
}

/**
 * Render items
 *
 * @param items Array of flickr items
 * @param options Options array
 * @since 1.0
 * @author Michael Tyson
 */
function flickrpress_render_items($items, $options)
{
    $count = 0;
    foreach ((array)$items as $item) {
        ?>
    <div class="flickr_item flickr_item_view_<?php echo ($options['view'] ? $options['view'] : 'squares') ?>">
        <?php if ($options['lightbox']) : ?>
                <a href="<?php echo $item->image ?>" class="thickbox" rel="lightbox[flickr]"
                   title="<?php echo htmlspecialchars(($item->title ? $item->title . ($item->description ? ": " : "") : "") .
                       strip_tags($item->description) . ($item->title || $item->description ? " | " : "") . ($item->page ? "<a href=\"$item->page\">View at Flickr</a>" : "")) ?>">
            <?php else : ?>
                <a href="<?php echo $item->page ?>">
            <?php endif; ?>
        <span></span>
        <img src="<?php echo $item->thumbnail ?>" title="<?php echo $item->title ?>" alt="<?php echo $item->title ?>"/>
    </a>
    </div>
    <?php
        $count++;
        if (isset($options['columns']) && ($count % $options['columns']) == 0) echo '<br />';
    }
}

// =============================
// =      Administration       =
// =============================
/**
 * Update widget options
 *
 *  Allows multiple copies of widget to be used.  Derived from
 *  the built-in text widget, wp-includes/widgets.php:970
 *
 * @since 0.1
 * @author Michael Tyson
 **/
function flickrpress_control_update()
{
    // Only perform this function once when saving, not for each instance
    static $updated = false;
    if ($updated) return;
    $updated = true;
    global $wp_registered_widgets;
    $options = get_option('flickrpress');
    if (!is_array($options)) $options = array();
    // Get name of this sidebar
    $sidebar = $_POST['sidebar'];
    // Get array of widgets in sidebar
    $widgets = wp_get_sidebars_widgets();
    if (is_array($widgets[$sidebar]))
        $this_sidebar = &$widgets[$sidebar];
    else
        $this_sidebar = array();
    // Check for removals, delete corresponding options
    foreach ($this_sidebar as $widget_id) {
        $number = $wp_registered_widgets[$widget_id]['params'][0]['number'];
        // If this is one of our widgets (callback is ours and number specified)
        if ($wp_registered_widgets[$widget_id]['callback'] == 'flickrpress' && is_numeric($number)) {
            if (!in_array("flickrpress-$number", $_POST['widget-id'])) {
                // the widget has been removed.
                unset($options[$number]);
            }
        }
    }
    foreach ($_POST['flickrpress'] as $number => $widget) {
        if (!isset($widget['title']) && isset($options[$number])) {
            // User clicked cancel
            continue;
        }
        if ($widget['paging']) $widget['random'] = false;
        $fields = array_keys(flickrpress_defaults());
        unset($options[$number]);
        foreach ($fields as $field) {
            $options[$number][$field] = stripslashes($widget[$field]);
        }
    }
    update_option('flickrpress', $options);
}

/**
 * Display and process widget options
 *
 *  Allows multiple copies of widget to be used.  Derived from
 *  the built-in text widget, wp-includes/widgets.php:970
 *
 * @param params Multi-widget parameters
 * @since 0.1
 * @author Michael Tyson
 **/
function flickrpress_control($params = null)
{
    if (!empty($_POST['flickrpress'])) {
        // Update options
        flickrpress_control_update();
    }
    // Load options specific to this instance
    if (is_numeric($params)) $params = array('number' => $params);
    $params = wp_parse_args($params, array('number' => -1));
    $id = $params['number'];
    $options = get_option('flickrpress');
    if ($id == -1) {
        $options = flickrpress_defaults();
        $id = '%i%';
    } else {
        $options = $options[$id];
    }
    $title = htmlspecialchars($options['title']);
    $type = $options['type'];
    $url = htmlspecialchars($options['url']);
    $account = htmlspecialchars($options['account']);
    $sets = htmlspecialchars($options['sets']);
    $tags = htmlspecialchars($options['tags']);
    $view = $options['view'];
    $count = (int)$options['count'];
    $paging = $options['paging'];
    $random = $options['random'];
    $lightbox = $options['lightbox'];
    $apiKey = htmlspecialchars($options['api_key']);
    $allTypes = array(
        'rss' => 'Photos from Flickr RSS',
        'photostream' => 'Photostream',
        'sets' => 'Photos from Photosets',
        'favorites' => 'Favorite Photos');
    $types = array(
        "rss" => array('url'),
        "photostream" => array('api_key', 'account', 'tags'),
        "sets" => array('api_key', 'account', 'sets'),
        "favorites" => array('api_key', 'account')
    );
    if (!$types[$type]) $type = "rss";
    ?>
<p>
    <label for="flickrpress_<?php echo $id ?>_title"><?php _e('Title:') ?></label>
    <input type="text" id="flickrpress_<?php echo $id ?>_title" name="flickrpress[<?php echo $id ?>][title]" value="<?php echo $title ?>"/>
</p>
<p>
    <label for="flickrpress_<?php echo $id ?>_type"><?php _e('Display:') ?></label>
    <select id="flickrpress_<?php echo $id ?>_type" name="flickrpress[<?php echo $id ?>][type]" size="1" onchange="selectType(this.value, '<?php echo $id ?>')">
        <?php foreach ($allTypes as $t => $label) : ?>
        <option value="<?php echo $t ?>" <?php echo ($type == $t ? "selected" : "")?>><?php echo $label ?></option>
        <?php endforeach; ?>
    </select>
</p>
<p id="flickrpress_<?php echo $id ?>_container_url" <?php echo (in_array('url', $types[$type]) ? '' : 'style="display: none;"') ?>>
    <label for="flickrpress_<?php echo $id ?>_url"><?php _e('Flickr RSS URL:') ?></label>
    <a href="javascript:alert('The RSS URL is linked at the bottom of Flickr pages, beside \'Subscribe to...\'. It should begin with \'http://api.flickr.com\'')">?</a>
    <br/><input type="text" id="flickrpress_<?php echo $id ?>_url" name="flickrpress[<?php echo $id ?>][url]" value="<?php echo $url ?>"
                placeholder="http://api.flickr.com/services/feeds/photos_public.gne?id=#########@N00&amp;lang=en-us&amp;format=rss_200" style="width:100%;"/>
</p>
<p id="flickrpress_<?php echo $id ?>_container_api_key" <?php echo (in_array('api_key', $types[$type]) ? '' : 'style="display: none;"') ?>>
    <label for="flickrpress_<?php echo $id ?>_api_key"><?php _e('Flickr API Key:') ?></label>
    <a href="javascript:alert('Get a free Flickr API key from http://flickr.com/services/api/keys/apply')">?</a>
    <br/><input type="text" id="flickrpress_<?php echo $id ?>_api_key" name="flickrpress[<?php echo $id ?>][api_key]" value="<?php echo $apiKey ?>"
                placeholder="123456789abcdef123456789abcdef"/>
</p>
<p id="flickrpress_<?php echo $id ?>_container_account" <?php echo (in_array('account', $types[$type]) ? '' : 'style="display: none;"') ?>>
    <label for="flickrpress_<?php echo $id ?>_account"><?php _e('Account name, email or ID:') ?></label><br/>
    <input type="text" id="flickrpress_<?php echo $id ?>_account" name="flickrpress[<?php echo $id ?>][account]" value="<?php echo $account ?>"/>
</p>
<p id="flickrpress_<?php echo $id ?>_container_sets" <?php echo (in_array('sets', $types[$type]) ? '' : 'style="display: none;"') ?>>
    <label for="flickrpress_<?php echo $id ?>_sets"><?php _e('Photosets:') ?></label><br/>
    <input type="text" id="flickrpress_<?php echo $id ?>_sets" name="flickrpress[<?php echo $id ?>][sets]" value="<?php echo $sets ?>"/>
    <br/>
    <small>Comma-separated list of photoset titles</small>
</p>
<p id="flickrpress_<?php echo $id ?>_container_tags" <?php echo (in_array('tags', $types[$type]) ? '' : 'style="display: none;"') ?>>
    <label for="flickrpress_<?php echo $id ?>_tags"><?php _e('Filter by tags:') ?></label><br/>
    <input type="text" id="flickrpress_<?php echo $id ?>_tags" name="flickrpress[<?php echo $id ?>][tags]" value="<?php echo $tags ?>"/>
    <br/>
    <small>Comma-separated list of tags to filter by</small>
</p>
<p>
    <label for="flickrpress_<?php echo $id ?>_count"><?php _e('Number of thumbnails:') ?></label>
    <input type="text" id="flickrpress_<?php echo $id ?>_count" name="flickrpress[<?php echo $id ?>][count]" size="4" value="<?php echo $count ?>"/>
</p>
<p>
    <input type="checkbox" id="flickrpress_<?php echo $id ?>_paging" name="flickrpress[<?php echo $id ?>][paging]" <?php echo ($paging ? 'checked="checked"' : '') ?> /> <label for="flickrpress_<?php echo $id ?>_paging">Display page navigation</label>
</p>
<p>
    <input type="checkbox" id="flickrpress_<?php echo $id ?>_random" name="flickrpress[<?php echo $id ?>][random]" <?php echo ($random ? 'checked' : '') ?> />
    <label for="flickrpress_<?php echo $id ?>_random"><?php _e('Display random') ?></label>
</p>
<p>
    <small>Using random mode or page navigation will introduce delays on first load for all but RSS mode.
        <a href="javascript:alert('The Flickr API does not provide for random selection of images, so all images must be loaded and selected at random. '+
                            'This takes more time then selecting a few recent images.  For page navigation, all items are loaded at once for performance reasons. '+
                            'This data will be cached, however, so load times will be minimised.')">Why?</a></small>
</p>
<p>
    <input type="radio" id="flickrpress_<?php echo $id ?>_view_squares" name="flickrpress[<?php echo $id ?>][view]" value="squares" <?php echo ($view == 'squares' ? 'checked' : '') ?> />
    <label for="flickrpress_<?php echo $id ?>_view_squares"><?php _e('View as square thumbnails') ?></label><br/>
    <input type="radio" id="flickrpress_<?php echo $id ?>_view_proportional" name="flickrpress[<?php echo $id ?>][view]" value="proportional" <?php echo ($view == 'proportional' ? 'checked' : '') ?> />
    <label for="flickrpress_<?php echo $id ?>_view_proportional"><?php _e('View as proportional thumbnails') ?></label><br/>
    <input type="radio" id="flickrpress_<?php echo $id ?>_view_large" name="flickrpress[<?php echo $id ?>][view]" value="large" <?php echo ($view == 'large' ? 'checked' : '') ?> />
    <label for="flickrpress_<?php echo $id ?>_view_large"><?php _e('View as large thumbnails') ?></label><br/>
</p>
<p>
    <input type="checkbox" id="flickrpress_<?php echo $id ?>_lightbox" name="flickrpress[<?php echo $id ?>][lightbox]" <?php echo ($lightbox ? 'checked' : '') ?> />
    <label for="flickrpress_<?php echo $id ?>_lightbox"><?php _e('Use Lightbox, etc.') ?></label>
</p>
<?php
}

/**
 * Register widget on startup
 *
 *  Allows multiple copies of widget to be used.  Derived from
 *  the built-in text widget, wp-includes/widgets.php:1037
 *
 * @since 0.1
 * @author Michael Tyson
 */
function flickrpress_init()
{
    // Add stylesheet
    wp_register_style('flickrpress_css', TPL_PLUGINS . '/flickrpress/style.css');
    wp_enqueue_style('flickrpress_css');
    // Add javascript
    wp_enqueue_script('flickrpress', TPL_PLUGINS . '/flickrpress/flickr.js', array('jquery'));
    if (is_admin()) {
        // Add javascript for controls
        wp_enqueue_script('flickrpress-admin', TPL_PLUGINS . '/flickrpress/flickr-admin.js', array('jquery'));
    }
    $options = get_option('flickrpress');
    if (!$options) $options = array();
    $widget_opts = array('classname' => 'flickrpress', 'description' => __('Display entries from Flickr'));
    $control_opts = array('id_base' => 'flickrpress');
    $name = __('Flickrpress');
    if (count($options) == 0) {
        // No widget copies - Register using a generic template
        $identifier = "flickrpress-1";
        wp_register_sidebar_widget($identifier, $name, 'flickrpress_widget', $widget_opts, array('number' => -1));
        wp_register_widget_control($identifier, $name, 'flickrpress_control', $control_opts, array('number' => -1));
        return;
    }
    // Iterate through all widget copies
    foreach ($options as $id => $values) {
        // "Old widgets can have null values for some reason" - wp-includes/widgets.php:1046
        if (!$values) continue;
        // Register widget and control
        $identifier = "flickrpress-$id";
        wp_register_sidebar_widget($identifier, $name, 'flickrpress_widget', $widget_opts, array('number' => $id));
        wp_register_widget_control($identifier, $name, 'flickrpress_control', $control_opts, array('number' => $id));
    }
}

add_action('init', 'flickrpress_init');
add_action('plugins_loaded', 'flickrpress_run_ajax');
add_shortcode('flickrpress', 'flickrpress_shortcode');
