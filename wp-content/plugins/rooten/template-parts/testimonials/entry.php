<?php 
    $address    = get_post_meta( get_the_ID(), 'jetpack_tm_address', true ); 
    $rating     = get_post_meta( get_the_ID(), 'jetpack_tm_rating', true ); 
    $background = get_post_meta( get_the_ID(), 'jetpack_tm_bg_style', true );
    $color      = get_post_meta( get_the_ID(), 'jetpack_tm_color_style', true );
 ?>


<div class="bdt-testimonial-item">

    <div class="bdt-box-shadow-medium">
        <div class="bdt-testimonial-text bdt-position-relative bdt-<?php echo  ($color != null) ? $color : 'dark';  ?> bdt-background-<?php echo  ($background != null) ? $background : 'default';  ?> bdt-padding">

            <?php get_template_part( 'template-parts/testimonials/content' ); ?>

        </div>
    </div>

    <div class="bdt-flex bdt-flex-middle bdt-margin-medium-top">

       <?php if (has_post_thumbnail()) : ?>
           <div class="bdt-testimonial-thumb bdt-margin-medium-right bdt-display-block bdt-overflow-hidden bdt-border-circle bdt-background-cover">

               <?php echo  the_post_thumbnail('thumbnail'); ?>

           </div>
       <?php endif; ?>

        <div>
            <?php get_template_part( 'template-parts/testimonials/title' ); ?>
            <?php if($address !='') : ?>
                <span class="bdt-text-small">, <?php echo esc_html($address); ?></span>
            <?php endif; ?>

            <?php if($rating !='') : ?>
                <ul class="tm-rating tm-rating-<?php echo esc_attr($rating); ?> bdt-text-muted bdt-grid-collapse" bdt-grid>
                    <li class="tm-rating-item"><span bdt-icon="star"></span></li>
                    <li class="tm-rating-item"><span bdt-icon="star"></span></li>
                    <li class="tm-rating-item"><span bdt-icon="star"></span></li>
                    <li class="tm-rating-item"><span bdt-icon="star"></span></li>
                    <li class="tm-rating-item"><span bdt-icon="star"></span></li>
                </ul>
            <?php endif; ?>
        </div>

   </div>
    
</div>

<?php if(is_single() and empty($author_desc)) : ?>
    <div class="bdt-margin-large-top"></div>
<?php endif ?>