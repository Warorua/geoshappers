<?php
$layout_c    = get_theme_mod('rooten_header_layout', 'horizontal-left');
$layout_m    = get_post_meta( get_the_ID(), 'rooten_header_layout', true );
$layout      = (!empty($layout_m) and $layout_m != 'default') ? $layout_m : $layout_c;
$logo        = get_theme_mod('rooten_logo_default');
$logo_width  = get_theme_mod('rooten_logo_width_default');
$custom_logo = rwmb_meta( 'rooten_custom_logo', "type=image_advanced&size=standard" );


$logo_mode              = ($logo) ? 'tm-logo-img' : 'tm-logo-text';
$class                  = ['bdt-logo'];
$class[]                = (!in_array($layout, ['stacked-left-a', 'stacked-left-b', 'stacked-center-b', 'stacked-center-a', 'side-left', 'side-right']))  ? 'bdt-navbar-item' : '';
$class[]                = $logo_mode;
$width                  = ($logo_width) ? $logo_width : '';
$img_atts               = [];
$img_atts['class'][]    = 'bdt-responsive-height';
$img_atts['itemprop'][] = 'logo';
$img_atts['alt'][]      = get_bloginfo( 'name' );

if (!empty($custom_logo)) {
	foreach ( $custom_logo as $image ) { 
	    $custom_logo = esc_url($image["url"]);
	}
	$img_atts['src'][] = esc_url($custom_logo);
} else {
	$img_atts['src'][] = esc_url($logo);	
	$img_atts['style'][]    = 'width:'.esc_attr($width);
}

?>

<a href="<?php echo esc_url(home_url('/')); ?>"<?php echo rooten_helper::attrs(['class' => $class]) ?> itemprop="url">
    <?php if ($logo or !empty($custom_logo)) : ?>
        <img<?php echo rooten_helper::attrs($img_atts) ?>>
    <?php else : ?>
        <?php bloginfo( 'name' );?>
    <?php endif; ?>
</a>