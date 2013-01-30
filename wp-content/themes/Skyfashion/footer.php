<?php
global $apollo13;
?>
<div class="cleared"></div>
<div id="footer">
    <?php if (is_active_sidebar('frontpage-widget-area')) : ?>
    <div class="primary widget-area menu_line_top" role="complementary">
        <?php if (!function_exists('dynamic_sidebar')
        || !dynamic_sidebar('frontpage-widget-area')
    ) : ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div style="clear: both;"></div>
    <div id="footer_nav" class="menu_line_top border_bottom no_content_font">
        <?php
        if (has_nav_menu('header-menu')
        ):
            /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */
            wp_nav_menu(array(
                    'container' => false,
                    'link_before' => '<span>',
                    'link_after' => '</span>',
                    'theme_location' => 'footer-menu',
                    'before' => '',
                    'depth' => 1)
            ); else:
            wp_nav_menu(array(
                    'container' => false,
                    'link_before' => '<span>',
                    'link_after' => '</span>',
                    'before' => '',
                    'depth' => 1)
            );
        endif;
        ?>
        <div class="cleared"></div>
    </div>
    <div id="footer-pad">
        <div id="footer_text"><?php echo $apollo13->get_option('footer_options', 'footer_copyright') ?></div>
        <div id="social_icons">
            <?php
            foreach ((array)$apollo13->get_option('social_options', 'social_services') as $id => $value) {
                if (!empty($value)) {
                    echo '<a target="_blank" href="' . $value . '" title="' . __('Follow us on ', TPL_SLUG) . $apollo13->all_theme_options['social_options']['social_services'][$id] . '"><img src="' . TPL_URI . '/common/images/social_icons/' . $id . '.png" alt="" /></a>';
                }
            }
            ?>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    jQuery(window).load(function () {
        jQuery('.flexslider').flexslider({
            animation:"<?php echo $apollo13->get_option('slider_options', 'animation_type') ?>",
            controlsContainer:".flex-nav-container",
            controlNav: <?php echo $apollo13->get_option('slider_options', 'cotrol_nav') ?>,
            slideshow: <?php echo $apollo13->get_option('slider_options', 'slideshow') ?>,
            slideDirection:"<?php echo $apollo13->get_option('slider_options', 'slide_direction') ?>",
            slideshowSpeed: <?php echo $apollo13->get_option('slider_options', 'slide_show_speed') ?>,
            animationDuration: <?php echo $apollo13->get_option('slider_options', 'animation_duration') ?>,
            directionNav:false
        });
    });
    jQuery(document).ready(function () {
        jQuery('div#header #nav li').hover(
            function () {
                jQuery(this).children('ul').slideDown(100);
            },
            function () {
                jQuery('ul', this).slideUp(100);
            }
        );
    });
    jQuery(document).ready(function () {
        jQuery('div#responsive_menu ul#responsive_nav > li').each(function (index) {
            var children = jQuery(this).children('ul');
            if (children.length == 0) {
                jQuery(this).css("background-image", "none");
            }
        });
        jQuery('div#responsive_menu ul#responsive_nav a').click(function (event) {
            var submenu = jQuery(this).parent().children('ul.sub-menu');
            if (submenu.length != 0) {
                if (submenu.is(':hidden')) {
                    submenu.slideDown(100);
                    var parent = jQuery(this).parent();
                    jQuery(parent).addClass('open_responsive_menu');
                    event.preventDefault();
                }
                /*  }else{
                    submenu.slideUp(100);
                    var parent = jQuery(this).parent();
                    jQuery(parent).removeClass('open_responsive_menu');
                }*/
            }
        });
        jQuery('div#responsive_menu a#responsive_menu_cross').click(function (event) {
            jQuery(this).parent().slideUp(400);
            jQuery('div#responsive_menu_overlay').fadeOut();
        });
        jQuery('div#responsive_menu_button').click(function (event) {
            jQuery('div#responsive_menu').slideDown(400);
            jQuery('div#responsive_menu_overlay').fadeIn();
        });
    });
    jQuery('input.search_input').focus(function () {
        if (jQuery(this).val() == '<?php echo __('Search ...', TPL_SLUG) ?>') {
            jQuery(this).val("");
        }
    });
    jQuery('input.search_input').focusout(function () {
        if (jQuery(this).val() == "") {
            jQuery(this).val("<?php echo __('Search ...', TPL_SLUG) ?>");
        }
    });
    //jQuery(".item-video").fitVids();
    //jQuery(".post-video").fitVids();
    jQuery("div.vert-item").fitVids();
</script>

<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */
wp_footer();
?>
</body>
</html>
