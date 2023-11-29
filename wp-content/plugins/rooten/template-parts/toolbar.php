<?php 
$classes            = ['bdt-container', 'bdt-flex bdt-flex-middle'];
$mb_toolbar         = (get_post_meta( get_the_ID(), 'rooten_toolbar', true ) != null) ? get_post_meta( get_the_ID(), 'rooten_toolbar', true ) : false;
$tm_toolbar         = (get_theme_mod( 'rooten_toolbar', 0)) ? 1 : 0;
$toolbar_left       = get_theme_mod( 'rooten_toolbar_left', 'tagline' );
$toolbar_right      = get_theme_mod( 'rooten_toolbar_right', 'social' );
$toolbar_cart       = get_theme_mod( 'rooten_woocommerce_cart' );
$classes[]          = (get_theme_mod( 'rooten_toolbar_fullwidth' )) ? 'bdt-container-expand' : '';
$toolbar_left_hide  = (get_theme_mod( 'rooten_toolbar_left_hide_mobile' )) ? ' bdt-visible@s' : '';
$toolbar_right_hide = (get_theme_mod( 'rooten_toolbar_right_hide_mobile' )) ? ' bdt-visible@s' : '';
$toolbar_full_hide  = ( $toolbar_left_hide and $toolbar_right_hide ) ? ' bdt-visible@s' : '';

?>

<?php if ($tm_toolbar and $mb_toolbar != true) : ?>
	<div class="tm-toolbar<?php echo esc_attr($toolbar_full_hide); ?>">
		<div<?php echo rooten_helper::attrs(['class' => $classes]) ?>>

			<?php if (!empty($toolbar_left)) : ?>
			<div class="tm-toolbar-l<?php echo esc_attr($toolbar_left_hide); ?>"><?php get_template_part( 'template-parts/toolbars/'.$toolbar_left ); ?></div>
			<?php endif; ?>

			<?php if (!empty($toolbar_right) or $toolbar_cart == 'toolbar') : ?>
			<div class="tm-toolbar-r bdt-margin-auto-left bdt-flex<?php echo esc_attr($toolbar_right_hide); ?>">
				<?php if ($toolbar_cart == 'toolbar') : ?>
					<div class="bdt-display-inline-block">
						<?php get_template_part( 'template-parts/toolbars/'.$toolbar_right ); ?>
					</div>
					<div class="bdt-display-inline-block bdt-margin-small-left">
						<?php get_template_part('template-parts/woocommerce-cart'); ?>
					</div>
				<?php else: ?>
					<?php get_template_part( 'template-parts/toolbars/'.$toolbar_right ); ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>

		</div>
	</div>
<?php endif; ?>