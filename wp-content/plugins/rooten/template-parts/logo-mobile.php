<?php
$logo                   = get_theme_mod('rooten_logo_mobile');
$logo_width             = get_theme_mod('rooten_logo_width_mobile');
$width                  = ($logo_width) ? $logo_width : '';
$img_atts               = [];
$img_atts['class'][]    = 'bdt-responsive-height';
$img_atts['style'][]    = 'width:'.esc_attr($width);
$img_atts['src'][]      = esc_url($logo);
$img_atts['itemprop'][] = 'logo';
$img_atts['alt'][]      = get_bloginfo( 'name' );

?>

<a href="<?php echo esc_url(home_url('/')); ?>"<?php echo rooten_helper::attrs(['class' => 'bdt-logo bdt-navbar-item']) ?> itemprop="url">
    <?php if ($logo) : ?>
        <img<?php echo rooten_helper::attrs($img_atts) ?>>
    <?php else : ?>
        <?php bloginfo( 'name' );?>
    <?php endif; ?>
</a>