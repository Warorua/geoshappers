<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rooten
 */

if(get_theme_mod('rooten_footer_widgets', 1) && get_post_meta( get_the_ID(), 'rooten_footer_widgets', true ) != 'hide') {

	$id                  = 'tm-bottom';
	$class               = ['tm-bottom', 'bdt-section'];
	$section             = '';
	$section_media       = [];
	$section_image       = '';
	$container_class     = [];
	$grid_class          = ['bdt-grid', 'bdt-margin'];
	$bottom_width        = get_theme_mod( 'rooten_bottom_width', 'default');
	$breakpoint          = get_theme_mod( 'rooten_bottom_breakpoint', 'm' );
	$vertical_align      = get_theme_mod( 'rooten_bottom_vertical_align' );
	$match_height        = get_theme_mod( 'rooten_bottom_match_height' );
	$column_divider      = get_theme_mod( 'rooten_bottom_column_divider' );
	$gutter              = get_theme_mod( 'rooten_bottom_gutter' );
	$columns             = get_theme_mod( 'rooten_footer_columns', 4);
	$first_column_expand = get_theme_mod( 'rooten_footer_fce');
	
	
	$layout         = get_post_meta( get_the_ID(), 'rooten_bottom_layout', true );
	$metabox_layout = (!empty($layout) and $layout != 'default') ? true : false;
	$position       = (get_post_meta( get_the_ID(), 'rooten_page_layout', true )) ? get_post_meta( get_the_ID(), 'rooten_page_layout', true ) : get_theme_mod( 'rooten_page_layout', 'sidebar-right' );

	if ($metabox_layout) {
	    $bg_style = get_post_meta( get_the_ID(), 'rooten_bottom_bg_style', true );
	    $bg_style = ( !empty($bg_style) ) ? $bg_style : get_theme_mod( 'rooten_bottom_bg_style' );
	    $padding  = get_post_meta( get_the_ID(), 'rooten_bottom_padding', true );
	    $text     = get_post_meta( get_the_ID(), 'rooten_bottom_txt_style', true );
	} else {
	    $bg_style = get_theme_mod( 'rooten_bottom_bg_style', 'secondary' );
	    $padding  = get_theme_mod( 'rooten_bottom_padding', 'medium' );
	    $text     = get_theme_mod( 'rooten_bottom_txt_style' );
	}

     
	    
    if ($metabox_layout) {
        $section_images = rwmb_meta( 'rooten_bottom_bg_img', "type=image_advanced&size=standard" );
        foreach ( $section_images as $image ) { 
            $section_image = esc_url($image["url"]);
        }
        $section_bg_img_pos    = get_post_meta( get_the_ID(), 'rooten_bottom_bg_img_position', true );
        $section_bg_img_attach = get_post_meta( get_the_ID(), 'rooten_bottom_bg_img_fixed', true );
        $section_bg_img_vis    = get_post_meta( get_the_ID(), 'rooten_bottom_bg_img_visibility', true );
    } else {
        $section_image         = get_theme_mod( 'rooten_bottom_bg_img' );
        $section_bg_img_pos    = get_theme_mod( 'rooten_bottom_bg_img_position' );
        $section_bg_img_attach = get_theme_mod( 'rooten_bottom_bg_img_fixed' );
        $section_bg_img_vis    = get_theme_mod( 'rooten_bottom_bg_img_visibility' );
    }

    // Image
    if ($section_image &&  $bg_style == 'media') {
        $section_media['style'][] = "background-image: url('{$section_image}');";
        // Settings
        $section_media['class'][] = 'bdt-background-norepeat';
        $section_media['class'][] = $section_bg_img_pos ? "bdt-background-{$section_bg_img_pos}" : '';
        $section_media['class'][] = $section_bg_img_attach ? "bdt-background-fixed" : '';
        $section_media['class'][] = $section_bg_img_vis ? "bdt-background-image@{$section_bg_img_vis}" : '';
    }

	$class[] = ($position == 'full' and $name == 'tm-main') ? 'bdt-padding-remove-vertical' : ''; // section spacific override

	$class[] = ($bg_style) ? 'bdt-section-'.$bg_style : '';

	$class[] = ($text) ? 'bdt-'.$text : '';
	if ($padding != 'none') {
	    $class[]       = ($padding) ? 'bdt-section-'.$padding : '';
	} elseif ($padding == 'none') {
	    $class[]       = ($padding) ? 'bdt-padding-remove-vertical' : '';
	}



	$container_class[] = ($bottom_width) ? 'bdt-container bdt-container-'.$bottom_width : '';
	
	$grid_class[]      = ($gutter) ? 'bdt-grid-'.$gutter : '';
	$grid_class[]      = ($column_divider && $gutter != 'collapse') ? 'bdt-grid-divider' : '';
	$grid_class[]      = ($breakpoint) ? 'bdt-child-width-expand@'.$breakpoint : '';
	$grid_class[]      = ($vertical_align) ? 'bdt-flex-middle' : '';
	$match_height = (!$vertical_align && $match_height) ? ' bdt-height-match="target: > div > div > .bdt-card"' : '';
	
	$expand_columns    = intval($columns)+1;
	$column_class      = ($first_column_expand) ? ' bdt-width-1-'.$expand_columns.'@l' : '';

	if (is_active_sidebar('footer-widgets') || is_active_sidebar('footer-widgets-2') || is_active_sidebar('footer-widgets-3') || is_active_sidebar('footer-widgets-4')) : ?>
		<div<?php echo rooten_helper::attrs(['id' => $id, 'class' => $class], $section_media); ?>>
			<div<?php echo rooten_helper::attrs(['class' => $container_class]) ?>>
				
				<?php if (is_active_sidebar('bottom-widgets')) : ?>
					<div class="bottom-widgets bdt-child-width-expand@s" bdt-grid><?php if (dynamic_sidebar('bottom-widgets')); ?></div>
					<hr class="bdt-margin-medium">
				<?php endif; ?>
				
				<div<?php echo rooten_helper::attrs(['class' => $grid_class]) ?> bdt-grid<?php echo esc_attr($match_height); ?>>

					<?php if (is_active_sidebar('footer-widgets') && $columns) : ?>
						<div class="bottom-columns bdt-width-1-3@m"><?php if (dynamic_sidebar('Footer Widgets 1')); ?></div>
					<?php endif; ?>
					<?php if (is_active_sidebar('footer-widgets-2') && $columns > 1) : ?>
						<div class="bottom-columns<?php echo esc_attr($column_class); ?>"><?php if (dynamic_sidebar('Footer Widgets 2')); ?></div>
					<?php endif; ?>
					<?php if (is_active_sidebar('footer-widgets-3') && $columns > 2) : ?>
						<div class="bottom-columns<?php echo esc_attr($column_class); ?>"><?php if (dynamic_sidebar('Footer Widgets 3')); ?></div>
					<?php endif; ?>
					<?php if (is_active_sidebar('footer-widgets-4') && $columns > 3) : ?>
						<div class="bottom-columns<?php echo esc_attr($column_class); ?>"><?php if (dynamic_sidebar('Footer Widgets 4')); ?></div>	
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif;
}