<?php

// Options
$logo            = get_theme_mod('rooten_logo_mobile');;
$mobile          = get_theme_mod('mobile', []);
$logo_align      = get_theme_mod('rooten_mobile_logo_align', 'center');
$menu_align      = get_theme_mod('rooten_mobile_menu_align', 'left');
$search_align    = get_theme_mod('rooten_mobile_search_align', 'right');
$offcanvas_style = get_theme_mod('rooten_mobile_offcanvas_style', 'offcanvas');
$offcanvas_mode  = get_theme_mod('rooten_mobile_offcanvas_mode', 'slide');
$menu_text       = get_theme_mod('rooten_mobile_menu_text');
$shadow          = get_theme_mod('rooten_header_shadow', 'special');
$break_point     = 'bdt-hidden@'.get_theme_mod('rooten_mobile_break_point', 'm');
$class           = ['tm-header-mobile', $break_point];
$class[]         = ($shadow) ? 'bdt-box-shadow-'.$shadow : '';


$offcanvas_color = get_theme_mod( 'rooten_offcanvas_color', 'dark' );
$offcanvas_color = ($offcanvas_color !== 'custom') ? 'bdt-'.$offcanvas_color : 'custom-color';


$search_align = false; // TODO

?>
<div<?php echo rooten_helper::attrs(['class' => $class]) ?>>
    <nav class="bdt-navbar-container" bdt-navbar>

        <?php if ($logo_align == 'left' || $menu_align == 'left' || $search_align == 'left') : ?>
        <div class="bdt-navbar-left">

            <?php if ($menu_align == 'left') : ?>
            <a class="bdt-navbar-toggle" href="#tm-mobile" bdt-toggle<?php echo ($offcanvas_style == 'dropdown') ? '="animation: true"' : '' ?>>
                <span bdt-navbar-toggle-icon></span>
                <?php if ($menu_text) : ?>
                <span class="bdt-margin-small-left"><?php esc_html_e('Menu', 'rooten') ?></span>
                <?php endif ?>
            </a>
            <?php endif ?>

            <?php if ($search_align == 'left') : ?>
            <a class="bdt-navbar-item"><?php esc_html_e('Search', 'rooten') ?></a>
            <?php endif ?>

            <?php if ($logo_align == 'left') : ?>
            <?php get_template_part( 'template-parts/logo-mobile' ); ?>
            <?php endif ?>

        </div>
        <?php endif ?>

        <?php if ($logo_align == 'center') : ?>
        <div class="bdt-navbar-center">
            <?php get_template_part( 'template-parts/logo-mobile' ); ?>
        </div>
        <?php endif ?>

        <?php if ($logo_align == 'right' || $menu_align == 'right' || $search_align == 'right') : ?>
        <div class="bdt-navbar-right">

            <?php if ($logo_align == 'right') : ?>
            <?php get_template_part( 'template-parts/logo-mobile' ); ?>
            <?php endif ?>

            <?php if ($search_align == 'right') : ?>
            <a class="bdt-navbar-item"><?php esc_html_e('Search', 'rooten') ?></a>
            <?php endif ?>

            <?php if ($menu_align == 'right') : ?>
            <a class="bdt-navbar-toggle" href="#tm-mobile" bdt-toggle<?php echo ($offcanvas_style) == 'dropdown' ? '="animation: true"' : '' ?>>
                <?php if ($menu_text) : ?>
                <span class="bdt-margin-small-right"><?php esc_html_e('Menu', 'rooten') ?></span>
                <?php endif ?>
                <span bdt-navbar-toggle-icon></span>
            </a>
            <?php endif ?>

        </div>
        <?php endif ?>

    </nav>

    <?php if ($shadow == 'special') : ?>
        <div class="tm-header-shadow">
            <div></div>
        </div>
    <?php endif; ?>

    <?php if (is_active_sidebar('offcanvas') or has_nav_menu('offcanvas')) :

        if ($offcanvas_style == 'offcanvas') : ?>
        <div id="tm-mobile" class="<?php echo esc_attr($offcanvas_color); ?>" bdt-offcanvas mode="<?php echo esc_html($offcanvas_mode); ?>" overlay>
            <div class="bdt-offcanvas-bar bdt-dark">
                <?php get_template_part( 'template-parts/offcanvas' ); ?>
            </div>
        </div>
        <?php endif ?>

        <?php if ($offcanvas_style == 'modal') : ?>
        <div id="tm-mobile" class="bdt-modal-full <?php echo esc_attr($offcanvas_color); ?>" bdt-modal>
            <div class="bdt-modal-dialog bdt-modal-body">
                <button class="bdt-modal-close-full" type="button" bdt-close></button>
                <div class="bdt-flex bdt-flex-center bdt-flex-middle" bdt-height-viewport>
                    <?php get_template_part( 'template-parts/offcanvas' ); ?>
                </div>
            </div>
        </div>
        <?php endif ?>

        <?php if ($offcanvas_style == 'dropdown') : ?>
        <div class="bdt-position-relative bdt-position-z-index">
            <div id="tm-mobile" class="bdt-box-shadow-medium<?php echo ($offcanvas_mode == 'slide') ? ' bdt-position-top' : '' ?> <?php echo esc_attr($offcanvas_color); ?>" hidden>
                <div class="bdt-background-default bdt-padding">
                    <?php get_template_part( 'template-parts/offcanvas' ); ?>
                </div>
            </div>
        </div>
        <?php endif ?>

    <?php else : ?>
        <div id="tm-mobile" class="<?php echo esc_attr($offcanvas_color); ?>" bdt-offcanvas mode="<?php echo esc_html($offcanvas_mode); ?>" overlay>
            <div class="bdt-offcanvas-bar">
                <?php esc_html_e( 'Ops! You don\'t have any menu or widget in Off-canvas. Please add some menu in Off-canvas menu position or add some widget in Off-canvas widget position for view them here.', 'rooten' ); ?>
            </div>
        </div>
    <?php endif; ?>
</div>