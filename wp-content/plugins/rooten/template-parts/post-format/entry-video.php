<article id="post-<?php the_ID() ?>" <?php post_class('bdt-article post-format-video bdt-text-'.get_theme_mod('rooten_blog_align', 'center')) ?> data-permalink="<?php the_permalink() ?>" typeof="Article">

    <?php get_template_part( 'template-parts/post-format/schema-meta' ); ?>

    <?php 
    $video = get_post_meta( get_the_ID(), 'rooten_blog_video', true );
    if (!empty($video)) : ?>
    <?php $video_src = get_post_meta( get_the_ID(), 'rooten_blog_videosrc', true ); 
    if (!empty($video_src) and $video_src = 'embedcode' ) : ?>
        <div class="post-video<?php echo (is_single()) ? ' bdt-margin-large-bottom' : ' bdt-margin-bottom'; ?>">
            <?php echo wp_kses(get_post_meta( get_the_ID(), 'rooten_blog_video', true ), rooten_allowed_tags()); ?>
        </div>
    <?php else : ?>

        <div class="post-video<?php echo (is_single()) ? ' bdt-margin-large-bottom' : ' bdt-margin-bottom'; ?>">
            <?php echo wp_oembed_get(esc_url($video)); ?>
        </div>

    <?php endif; ?>


    <?php endif ?>
    

    <div class="bdt-margin-medium-bottom bdt-container bdt-container-small">
        <?php get_template_part( 'template-parts/post-format/title' ); ?>

        <?php if(get_theme_mod('rooten_blog_meta', 1)) :?>
        <?php get_template_part( 'template-parts/post-format/meta' ); ?>
        <?php endif; ?>
    </div>
    
    <div class="bdt-container bdt-container-small">
        <?php get_template_part( 'template-parts/post-format/content' ); ?>

        <?php get_template_part( 'template-parts/post-format/read-more' ); ?>
    </div>

</article>