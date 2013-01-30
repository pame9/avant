<?php
/*
  Template Name: Blog
 */
?>
<?php
define('BLOG_PAGE', true);
get_header();
?>
<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 */
global $apollo13;
?>
<div id="content">
    <div id="blog_posts" <?php if (!is_active_sidebar('blog-widget-area')) : ?>
             style="max-width: 940px;" 
         <?php endif; ?>>
             <?php
             $bg_color = get_post_meta(get_the_ID(), '_background_color', true);
             $bg_image = get_post_meta(get_the_ID(), '_background_image', true);
             ?>
        <style type="text/css" media="screen">
<?php if ($bg_color != "") : ?>
                body { background-color: <?php echo $bg_color; ?> !important;}
<?php endif;
if ($bg_image != "") : ?>
                div.bgimage { background-image: url('<?php echo $bg_image ?>')!important; }
<?php endif; ?>
        </style>
        <div id="page_title" class="border_bottom">
            <h1>Blog</h1>
            <?php if (strlen(trim(get_post_meta(get_the_ID(), '_page_extra_description', true))) > 0): ?>
                <span>|</span> <p><?php echo trim(get_post_meta(get_the_ID(), '_page_extra_description', true)); ?></p>
            <?php endif; ?>
            <div style="clear: both;"></div>
        </div>
        <?php /* If there are no posts to display, such as an empty archive page */ ?>
        <?php if (!have_posts()) : ?>
            <div id="post-0" class="post border_bottom error404 not-found">
                <h2><?php _e('Apologies, but no results were found for the requested archive. ', TPL_SLUG); ?></h2>
            </div>
        <?php endif; ?>
        <?php /* Start the Loop.
         * ***************************
         */ ?>
        <?php
        $temp = $wp_query;
        $wp_query = null;
        $wp_query = new WP_Query();
        $wp_query->query(get_option('posts_per_page') . '&paged=' . $paged);
        while ($wp_query->have_posts()) : $wp_query->the_post();
            $date_position = get_post_meta(get_the_ID(), '_date_pos', true);
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
                <div class="post-info no_content_font">
                    <?php if ($date_position == 'in_left'): ?>
                        <div class="post_date post_info_box">
                            <span class="day"><?php $apollo13->posted_on('d'); ?></span>
                            <span class="date"><?php $apollo13->posted_on('F'); ?></span>
                            <span class="date"><?php $apollo13->posted_on('Y'); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="post_tags post_info_box">
                        <span><?php echo __('Tags', TPL_SLUG); ?>:</span> <?php $apollo13->posted_in(); ?>
                    </div>
                    <a class="comments_count <?php if (get_comments_number() != 0)
                        echo 'comments_count_border' ?>"  <?php if (get_comments_number() == 0)
                echo 'style="color: #9B9B9B;"' ?>
                       href="<?php echo get_comments_link() ?>" title="">
                           <?php if (get_comments_number() == 0) { ?>
                               <?php echo __('No comments', TPL_SLUG); ?>
                               <?php
                           } else {
                               printf(_n('%1$s comment', '%1$s comments', get_comments_number(), TPL_SLUG), number_format_i18n(get_comments_number()));
                           }
                           ?>
                    </a>           
                </div>
                <div class="item-content" <?php if (!is_active_sidebar('blog-widget-area')) : ?>
                         style="max-width: 820px;" 
                     <?php endif; ?>>
                         <?php if ($date_position != 'in_left'): ?>
                        <div class="top_post_date no_content_font"><?php $apollo13->posted_on('d F Y'); ?></div>
                    <?php endif; ?>
                    <h2 class="post_title no_content_font"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                    <?php
                    $featured_position = get_post_meta(get_the_ID(), '_top_or_incontent', true);
                    if ($featured_position == "next_to_title" && !$apollo13->is_top_video(get_the_ID())) {
                        if (has_post_thumbnail()):
                            ?>
                            <div id="post_title_thumb"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('post_title_thumb'); ?></a></div>
                            <?php
                        endif;
                    }
                    ?>
                    <?php
                    if ($featured_position == "in_content" || $apollo13->is_top_video(get_the_ID())) {
                        if (has_post_thumbnail()) {
                            ?>
                            <a href="<?php the_permalink() ?>">
                                <?php
                                the_post_thumbnail();
                                ?>
                            </a>
                            <?php
                        }
                    }
                    $apollo13->top_image_video(get_the_ID());
                    ?>
                    <div class="post-text">
                        <?php
                        global $more;
                        $more = 0;
                        the_content("");
                        ?>
                        <div class="clear"></div>
                    </div>
                    <a href="<?php the_permalink() ?>" class="read_more_button"><?php echo __('Continue reading', TPL_SLUG); ?> ...</a>
                </div>
                <div style="clear: both;"></div>
            </div><!-- #post-## -->
        <?php endwhile; // End the loop. Whew.   ?>
        <?php $apollo13->pagination(); ?>
    </div>
    <?php if (is_active_sidebar('blog-widget-area')) : ?>
        <div id="primary" class="widget-area" role="complementary">
            <?php if (!function_exists('dynamic_sidebar')
                    || !dynamic_sidebar('blog-widget-area')) : ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div style="clear: both"></div>
</div>
<?php get_footer(); ?>