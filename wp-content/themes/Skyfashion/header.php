<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <?php global $page, $paged, $apollo13; ?>
    <head>
        <meta name="viewport" content="width=device-width"/>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <title><?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    wp_title('|', true, 'right');
// Add the blog name.
    bloginfo('name');
// Add the blog description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page()))
        echo " | $site_description";
// Add a page number if necessary:
    if ($paged >= 2 || $page >= 2)
        echo ' | ' . sprintf(__('Page %s', TPL_SLUG), max($paged, $page));
    ?></title>
        <meta name="author" content="Apollo13 Team"/>
        <?php echo $apollo13->get_option('settings', 'ga_code') ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="bgimage"></div>
        <div id="main">
            <div id="responsive_menu_overlay"></div>
            <div id="responsive_menu_button" class="no_content_font">
                <span><?php echo __('Menu', TPL_SLUG); ?></span>
            </div>
            <div id="responsive_menu" class="no_content_font">
                <div id="responsive_menu_header">
                    <?php echo __('Menu', TPL_SLUG); ?>
                </div>
                <?php
                if (has_nav_menu('header-menu')
                ):
                    /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */
                    wp_nav_menu(array(
                        'container' => false,
                        'link_before' => '',
                        'link_after' => '',
                        'menu_id' => 'responsive_nav',
                        'theme_location' => 'header-menu')
                    );
                else:
                    wp_nav_menu(array(
                        'container' => false,
                        'link_before' => '<span>',
                        'link_after' => '</span>')
                    );
                endif;
                ?>
                <a id="responsive_menu_cross"></a>
            </div>
            <div id="header">
                <div id="logo" class="border_bottom">
                    <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
                       rel="home">
                           <?php if ($apollo13->get_option('settings', 'theme_styles') == "style-light"): ?>
                            <img src="<?php echo $apollo13->get_option('settings', 'logo_image_light'); ?>"/>
                        <?php else: ?>
                            <img src="<?php echo $apollo13->get_option('settings', 'logo_image_dark'); ?>"/>
                        <?php endif; ?>
                    </a>
                </div>
                <div id="menu" class="menu_line_bottom no_content_font">
                    <div id="menu_container">
                        <?php
                        if (has_nav_menu('header-menu')
                        ):
                            /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */
                            wp_nav_menu(array(
                                'container' => false,
                                'link_before' => '',
                                'link_after' => '',
                                'menu_id' => 'nav',
                                'theme_location' => 'header-menu')
                            );
                        else:
                            wp_nav_menu(array(
                                'container' => false,
                                'link_before' => '<span>',
                                'link_after' => '</span>')
                            );
                        endif;
                        ?>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>