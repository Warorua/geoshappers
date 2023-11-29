<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rooten
 */

if(get_post_meta( get_the_ID(), 'rooten_copyright', true ) != 'hide') {

	$class             = ['tm-copyright', 'bdt-section'];
	$container_class   = [];
	$grid_class        = ['bdt-grid', 'bdt-flex', 'bdt-flex-middle'];
	$background_style  = get_theme_mod( 'rooten_copyright_bg_style', 'secondary' );
	$width             = get_theme_mod( 'rooten_copyright_width', 'default');
	$padding           = get_theme_mod( 'rooten_copyright_padding', 'small' );
	$text              = get_theme_mod( 'rooten_copyright_txt_style' );
	$breakpoint        = get_theme_mod( 'rooten_bottom_breakpoint', 'm' );
	
	$class[]           = ($background_style) ? 'bdt-section-'.$background_style : '';
	$class[]           = ($text) ? 'bdt-'.$text : '';
	if ($padding != 'none') {
		$class[]       = ($padding) ? 'bdt-section-'.$padding : '';
	} elseif ($padding == 'none') {
		$class[]       = ($padding) ? 'bdt-padding-remove-vertical' : '';
	}
	
	$container_class[] = ($width) ? 'bdt-container bdt-container-'.$width : '';
	
	$grid_class[]      = ($breakpoint) ? 'bdt-child-width-expand@'.$breakpoint : '';

	?>

	<div id="tmCopyright"<?php echo rooten_helper::attrs(['class' => $class]) ?>>
		<div<?php echo rooten_helper::attrs(['class' => $container_class]) ?>>
			<div<?php echo rooten_helper::attrs(['class' => $grid_class]) ?> bdt-grid>
				<div class="bdt-width-expand@m">	
					<?php									 
					if (has_nav_menu('copyright')) { echo wp_nav_menu( array( 'theme_location' => 'copyright', 'container_class' => 'tm-copyright-menu bdt-display-inline-block', 'menu_class' => 'bdt-subnav bdt-subnav-line bdt-subnav-divider bdt-margin-small-bottom', 'depth' => 1 ) ); }
					
					if(get_theme_mod('rooten_copyright_text_custom_show')) : ?>
						<div class="copyright-txt"><?php echo wp_kses_post(get_theme_mod('rooten_copyright_text_custom')); ?></div>
					<?php else : ?>								
						<div class="copyright-txt">&copy; <?php esc_html_e('Copyright', 'rooten') ?> <?php echo esc_html(date("Y ")); ?> <?php esc_html_e('All Rights Reserved by', 'rooten') ?> <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo( 'name' );?>"> <?php echo esc_html(bloginfo('name')); ?> </a></div>
					<?php endif; ?>
				</div>
				<div class="bdt-width-auto@m">
					<?php get_template_part( 'template-parts/copyright-social'); ?>
				</div>
			</div>
		</div>
	</div>

	<?php 
}