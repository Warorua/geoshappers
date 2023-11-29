<?php 

$attrs['class']        = get_theme_mod( 'rooten_toolbar_social_style' ) ? 'bdt-icon-button' : 'bdt-icon-link';
$attrs['target']       = get_theme_mod( 'rooten_toolbar_social_target' ) ? '_blank' : '';

// Grid
$attrs_grid            = [];
$attrs_grid['class'][] = 'bdt-grid-small bdt-flex-middle';
$attrs_grid['bdt-grid'] = true;

$links = (get_theme_mod( 'rooten_toolbar_social' )) ? explode(',', get_theme_mod( 'rooten_toolbar_social' )) : null;
if (count($links)) : ?>
	<div class="social-link">
		<ul<?php echo rooten_helper::attrs($attrs_grid) ?>>
		    <?php foreach ($links as $link) : ?>
		    <li>
		        <a<?php echo rooten_helper::attrs(['href' => $link], $attrs); ?> bdt-icon="icon: <?php echo rooten_helper::icon($link); ?>; ratio: 0.8" title="<?php echo ucfirst(rooten_helper::icon($link)); ?>" bdt-tooltip=""></a>
		    </li>
		    <?php endforeach ?>
		</ul>
	</div>
<?php endif; ?>
