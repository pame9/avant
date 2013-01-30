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
<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
    <div id="post-0" class="post error404 not-found">
        <h2><?php _e('Apologies, but no results were found for the requested archive. ', TPL_SLUG); ?></h2>
    </div>
<?php endif; ?>
<?php /* Start the Loop.
 * ***************************
 */ ?>
<?php while (have_posts()) : the_post(); ?>
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
<?php endwhile; // End the loop. Whew.  ?>
<?php /* Display navigation to next/previous pages when applicable */ ?>
