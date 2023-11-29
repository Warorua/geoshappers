<?php

$style             = get_theme_mod( 'rooten_search_style', 'default');
$search            = [];
$toggle            = ['class' => 'bdt-search-icon bdt-padding-remove-horizontal'];
$layout_c          = get_theme_mod('rooten_header_layout', 'horizontal-left');
$layout_m          = get_post_meta( get_the_ID(), 'rooten_header_layout', true );
$layout            = (!empty($layout_m) and $layout_m != 'default') ? $layout_m : $layout_c;
$position          = get_theme_mod( 'rooten_search_position', 'header');
$id                = esc_attr( uniqid( 'search-form-' ) );
$attrs['class']    = array_merge(['bdt-search'], isset($attrs['class']) ? (array) $attrs['class'] : []);
$search            = [];
$search['class']   = [];
$search['class'][] = 'bdt-search-input';

if (($layout == 'side-left' or $layout == 'side-right') and $position == 'menu') {
    $style = 'default';
}
// TODO
$navbar = [
    'dropdown_align'    => get_theme_mod( 'rooten_dropdown_align', 'left' ),
    'dropdown_click'    => get_theme_mod( 'rooten_dropdown_click' ),
    'dropdown_boundary' => get_theme_mod( 'rooten_dropdown_boundary' ),
    'dropbar'           => get_theme_mod( 'rooten_dropbar' ),
];

if ($style) {
    $search['autofocus'] = true;
}

if ($style == 'modal') {
    $search['class'][] = 'bdt-text-center';
    $attrs['class'][] = 'bdt-search-large';
} else {
    $attrs['class'][] = 'bdt-search-default';
}

if (in_array($style, ['dropdown', 'justify'])) {
    $attrs['class'][] = 'bdt-search-navbar';
    $attrs['class'][] = 'bdt-width-1-1';
}

?>

<?php if ($style == 'default') : // TODO renders the default style only ?>

    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search" <?php echo rooten_helper::attrs($attrs) ?>>
        <span bdt-search-icon></span>
        <input id="<?php echo esc_attr($id); ?>" name="s" placeholder="<?php esc_html_e('Search...', 'rooten'); ?>" type="search" class="bdt-search-input">
    </form>

<?php elseif ($style == 'drop') : ?>

    <a<?php echo rooten_helper::attrs($toggle) ?> href="#" bdt-search-icon></a>
    <div bdt-drop="mode: click; pos: left-center; offset: 0">
        <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search" <?php echo rooten_helper::attrs($attrs) ?>>
            <span bdt-search-icon></span>
            <input id="<?php echo esc_attr($id); ?>" name="s" placeholder="<?php esc_html_e('Search...', 'rooten'); ?>" type="search" class="bdt-search-input">
        </form>
    </div>

<?php elseif (in_array($style, ['dropdown', 'justify'])) :

    $drop = [
        'mode'           => 'click',
        'cls-drop'       => 'bdt-navbar-dropdown',
        'boundary'       => $navbar['dropdown_align'] ? '!nav' : false,
        'boundary-align' => $navbar['dropdown_boundary'],
        'pos'            => $style == 'justify' ? 'bottom-justify' : 'bottom-right',
        'flip'           => 'x',
        'offset'         => !$navbar['dropbar'] ? 28 : 0
    ];

    ?>

    <a<?php echo rooten_helper::attrs($toggle) ?> href="#" bdt-search-icon></a>
    <div class="bdt-navbar-dropdown bdt-width-medium" <?php echo rooten_helper::attrs(['bdt-drop' => json_encode(array_filter($drop))]) ?>>
        <div class="bdt-grid bdt-grid-small bdt-flex-middle">
            <div class="bdt-width-expand">
               <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search" <?php echo rooten_helper::attrs($attrs) ?>>
                   <span bdt-search-icon></span>
                   <input id="<?php echo esc_attr($id); ?>" name="s" placeholder="<?php esc_html_e('Search...', 'rooten'); ?>" type="search" class="bdt-search-input">
               </form>
            </div>
            <div class="bdt-width-auto">
                <a class="bdt-navbar-dropdown-close" href="#" bdt-close></a>
            </div>
        </div>

    </div>

<?php elseif ($style == 'modal') : ?>

    <a<?php echo rooten_helper::attrs($toggle) ?> href="#<?php echo esc_attr($id).'-modal' ?>" bdt-search-icon bdt-toggle></a>

    <div id="<?php echo esc_attr($id).'-modal' ?>" class="bdt-modal-full" bdt-modal>
        <div class="bdt-modal-dialog bdt-modal-body bdt-flex bdt-flex-center bdt-flex-middle" bdt-height-viewport>
            <button class="bdt-modal-close-full" type="button" bdt-close></button>
            <div class="bdt-search bdt-search-large">
               <form id="search-230" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search" <?php echo rooten_helper::attrs($attrs) ?>>
                    <input id="<?php echo esc_attr($id); ?>" name="s" placeholder="<?php esc_html_e('Type Word and Hit Enter', 'rooten'); ?>" type="search" class="bdt-search-input bdt-text-center" autofocus="">
               </form>
            </div>
        </div>
    </div>

<?php endif ?>
