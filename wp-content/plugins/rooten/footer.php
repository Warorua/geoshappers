<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rooten
 */

	$layout        = get_theme_mod('rooten_global_layout', 'full');
	$cookie_bar    = get_theme_mod( 'rooten_cookie');
	$totop_show    = get_theme_mod('rooten_totop_show', 1);
	$totop_align   = get_theme_mod('rooten_totop_align', 'left');
	$totop_radius  = get_theme_mod('rooten_totop_radius', 'circle');
	$totop_bg      = get_theme_mod('rooten_totop_bg_style', 'secondary'); // TODO
	$totop_class   = ['tm-totop-scroller', 'bdt-totop', 'bdt-position-medium', 'bdt-position-fixed'];
	$totop_class[] = ($totop_align) ? 'bdt-position-bottom-'.$totop_align : 'bdt-position-bottom-left';
	$totop_class[] = ($totop_radius) ? 'bdt-border-'.$totop_radius : '';
	$totop_class[] = ($totop_bg) ? 'bdt-background-'.$totop_bg : 'bdt-background-secondary';
	$totop_class[] = ($totop_bg == 'default' or $totop_bg == 'muted') ? 'bdt-dark' : 'bdt-light';

	?>
	
	<?php if (!is_page_template( 'page-blank.php' ) and !is_404()) : ?>
		<?php get_template_part( 'template-parts/bottom' ); ?>
		<?php get_template_part( 'template-parts/copyright' ); ?>
	<?php endif; ?>
	

	<?php if ($layout == 'boxed') : ?>
		</div><!-- #margin -->
	</div><!-- #tm-page -->
	<?php endif; ?>

	<?php get_template_part( 'template-parts/fixed-left' ); ?>	
	<?php get_template_part( 'template-parts/fixed-right' ); ?>


	<?php if($totop_show and !is_page_template( 'page-blank.php' )): ?>
		<a <?php echo rooten_helper::attrs(['class' => $totop_class]); ?> href="#"  bdt-totop bdt-scroll></a>
	<?php endif; ?>

    <?php if ($cookie_bar) : ?>
		<?php get_template_part('template-parts/cookie-bar'); ?>
	<?php endif ?>

	<?php wp_footer(); ?>

</body>
</html>
