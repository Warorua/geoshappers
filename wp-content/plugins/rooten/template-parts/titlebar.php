<?php

$id             = 'tm-titlebar';
$titlebar_show  = rwmb_meta('rooten_titlebar');
$class          = '';
$section_media  = [];
$section_image  = '';
$layout         = get_post_meta( get_the_ID(), 'rooten_titlebar_layout', true );
$metabox_layout = (!empty($layout) and $layout != 'default') ? true : false;
$position       = (get_post_meta( get_the_ID(), 'rooten_page_layout', true )) ? get_post_meta( get_the_ID(), 'rooten_page_layout', true ) : get_theme_mod( 'rooten_page_layout', 'sidebar-right' );

if ($metabox_layout) {
    $bg_style = get_post_meta( get_the_ID(), 'rooten_titlebar_bg_style', true );
    $bg_style = ( !empty($bg_style) ) ? $bg_style : get_theme_mod( 'rooten_titlebar_bg_style' );
    $width    = get_post_meta( get_the_ID(), 'rooten_titlebar_width', true );
    $padding  = get_post_meta( get_the_ID(), 'rooten_titlebar_padding', true );
    $text     = get_post_meta( get_the_ID(), 'rooten_titlebar_txt_style', true );
} else {
    $bg_style = get_theme_mod( 'rooten_titlebar_bg_style', 'muted' );
    $width    = get_theme_mod( 'rooten_titlebar_width', 'default' );
    $padding  = get_theme_mod( 'rooten_titlebar_padding', 'medium' );
    $text     = get_theme_mod( 'rooten_titlebar_txt_style' );
}

if (is_array($class)) {
	$class = implode(' ', array_filter($class));
}     

if ($metabox_layout) {
    $section_images = rwmb_meta( 'rooten_titlebar_bg_img', "type=image_advanced&size=standard" );
    foreach ( $section_images as $image ) { 
        $section_image = esc_url($image["url"]);
    }
} else {
    $section_image         = get_theme_mod( 'rooten_titlebar_bg_img' );
}

// Image
if ($section_image &&  $bg_style == 'media') {
    $section_media['style'][] = "background-image: url('{$section_image}');";
    $section_media['class'][] = 'bdt-background-norepeat';
}


$class   = ['tm-titlebar', 'bdt-section', $class];

$class[] = ($bg_style) ? 'bdt-section-'.$bg_style : '';
$class[] = ($text) ? 'bdt-'.$text : '';
if ($padding != 'none') {
    $class[]       = ($padding) ? 'bdt-section-'.$padding : '';
} elseif ($padding == 'none') {
    $class[]       = ($padding) ? 'bdt-padding-remove-vertical' : '';
}



if ( $titlebar_show !== 'hide') : ?>

	<?php 
		global $post;
		$blog_title        = get_theme_mod('rooten_blog_title', esc_html__('Blog', 'rooten'));
		$woocommerce_title = get_theme_mod('rooten_woocommerce_title', esc_html__('Shop', 'rooten'));
		$titlebar_global   = get_theme_mod('rooten_titlebar_layout', 'left');
		$titlebar_metabox  = get_post_meta( get_the_ID(), 'rooten_titlebar_layout', true);
		$title             = get_the_title();

	?>

	<?php if( is_object($post) && !is_archive() &&!is_search() && !is_404() && !is_author() && !is_home() && !is_page() ) { ?>

		<?php if($titlebar_metabox != 'default' && !empty($titlebar_metabox)) { ?>

			<?php  if ($titlebar_metabox == 'left' or $titlebar_metabox == 'center' or $titlebar_metabox == 'right') { ?>
				<div<?php echo rooten_helper::attrs(['id' => $id, 'class' => $class], $section_media); ?>>
					<div<?php echo rooten_helper::container(); ?>>
						<div<?php echo rooten_helper::grid(); ?>>
							<div id="title" class="bdt-width-expand<?php echo ($titlebar_metabox == 'center')?' bdt-text-center':''; ?>">
								<h1 class="bdt-margin-small-bottom"><?php echo esc_html($title); ?></h1>
								<?php echo rooten_breadcrumbs($titlebar_global); ?>
							</div>
							<?php if ($titlebar_metabox != 'center') : ?>
							<div class="bdt-margin-auto-left bdt-position-relative bdt-width-small bdt-visible@s">
								<div class="bdt-position-center-right">
									<a class="bdt-button-text bdt-link-reset" onclick="history.back()"><span class="bdt-margin-small-right" bdt-icon="icon: arrow-left"></span> <?php esc_html_e('Back', 'rooten'); ?></a>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } elseif (rwmb_meta('rooten_titlebar') == 'notitle') { ?>
				<div id="notitlebar" class="titlebar-no"></div>
			<?php } ?>

		<?php } else { ?>
				<?php
					// Define the Title for different Pages
					if ( is_home() ) { $title = $blog_title; }
					elseif( is_search() ) { 	
						$allsearch = new WP_Query("s=$s&showposts=-1"); 
						$count = $allsearch->post_count; 
						wp_reset_postdata();
						$title = $count . ' '; 
						$title .= esc_html__('Search results for:', 'rooten');
						$title .= ' ' . get_search_query();
					}
					elseif( class_exists('Woocommerce') && is_woocommerce() ) { $title = $woocommerce_title; }
					elseif( is_archive() ) { 
						if (is_category()) { 	$title = single_cat_title('',false); }
						elseif( is_tag() ) { 	$title = esc_html__('Posts Tagged:', 'rooten') . ' ' . single_tag_title('',false); }
						elseif (is_day()) { 	$title = esc_html__('Archive for', 'rooten') . ' ' . get_the_time('F jS, Y'); }
						elseif (is_month()) { 	$title = esc_html__('Archive for', 'rooten') . ' ' . get_the_time('F Y'); }
						elseif (is_year()) { 	$title = esc_html__('Archive for', 'rooten') . ' ' . get_the_time('Y'); }
						elseif (is_author()) { 	$title = esc_html__('Author Archive for', 'rooten') . ' ' . get_the_author(); }
						elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { $title = esc_html__('Blog Archives', 'rooten'); }
						else{
							$title = single_term_title( "", false );
							if ( $title == '' ) { // Fix for templates that are archives
								$post_id = $post->ID;
								$title = get_the_title($post_id);
							} 
						}
					}
					elseif( is_404() ) { $title = esc_html__('Oops, this Page could not be found.', 'rooten'); }
					elseif( get_post_type() == 'post' ) { $title = $blog_title; }
					else { $title = get_the_title(); }
				?>

				<div<?php echo rooten_helper::attrs(['id' => $id, 'class' => $class], $section_media); ?>>
					<div<?php echo rooten_helper::container(); ?>>
						<div<?php echo rooten_helper::grid(); ?>>
							<div id="title" class="<?php echo ($titlebar_metabox == 'center')?'bdt-text-center':''; ?>">
								<h1 class="bdt-margin-small-bottom"><?php echo esc_html($title); ?></h1>
								<?php echo rooten_breadcrumbs($titlebar_global); ?>
							</div>
							<?php if ($titlebar_metabox != 'center') :?>
							<div class="bdt-margin-auto-left bdt-position-relative bdt-width-small bdt-visible@s">
								<div class="bdt-position-center-right">
									<a class="bdt-button-text bdt-link-reset" onclick="history.back()"><span class="bdt-margin-small-right" bdt-icon="icon: arrow-left"></span> <?php esc_html_e('Back', 'rooten'); ?></a>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

		<?php } // End Else ?>

	<?php } else { // If no post page ?>
		
		<?php if($titlebar_metabox != 'default' && !empty($titlebar_metabox)) { ?>

			<?php  if ($titlebar_metabox == 'left' or $titlebar_metabox == 'center' or $titlebar_metabox == 'right') { ?>
				<div<?php echo rooten_helper::attrs(['id' => $id, 'class' => $class], $section_media); ?>>
					<div<?php echo rooten_helper::container(); ?>>
						<div<?php echo rooten_helper::grid(); ?>>
							<div id="title" class="bdt-width-expand<?php echo ($titlebar_metabox == 'center')?' bdt-text-center':''; ?>">
								<h1 class="bdt-margin-small-bottom"><?php echo esc_html($title); ?></h1>
								<?php echo rooten_breadcrumbs($titlebar_global); ?>
							</div>
							<?php if ($titlebar_metabox != 'center') : ?>
							<div class="bdt-margin-auto-left bdt-position-relative bdt-width-small bdt-visible@s">
								<div class="bdt-position-center-right">
									<a class="bdt-button-text bdt-link-reset" onclick="history.back()"><span class="bdt-margin-small-right" bdt-icon="icon: arrow-left"></span> <?php esc_html_e('Back', 'rooten'); ?></a>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } elseif (rwmb_meta('rooten_titlebar') == 'notitle') { ?>
				<div id="notitlebar" class="titlebar-no"></div>
			<?php } ?>

		<?php } else { ?>

			<?php
				// Define the Title for different Pages
				if ( is_home() ) { $title = $blog_title; }
				elseif( is_search() ) { 	
					$allsearch = new WP_Query("s=$s&showposts=-1"); 
					$count = $allsearch->post_count; 
					wp_reset_postdata();
					$title = $count . ' '; 
					$title .= esc_html__('Search results for:', 'rooten');
					$title .= ' ' . get_search_query();
				}
				elseif( class_exists('Woocommerce') && is_woocommerce() ) { $title = $woocommerce_title; }
				elseif( is_archive() ) { 
					if (is_category()) { 	$title = single_cat_title('',false); }
					elseif( is_tag() ) { 	$title = esc_html__('Posts Tagged:', 'rooten') . ' ' . single_tag_title('',false); }
					elseif (is_day()) { 	$title = esc_html__('Archive for', 'rooten') . ' ' . get_the_time('F jS, Y'); }
					elseif (is_month()) { 	$title = esc_html__('Archive for', 'rooten') . ' ' . get_the_time('F Y'); }
					elseif (is_year()) { 	$title = esc_html__('Archive for', 'rooten') . ' ' . get_the_time('Y'); }
					elseif (is_author()) { 	$title = esc_html__('Author Archive for', 'rooten') . ' ' . get_the_author(); }
					elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { $title = esc_html__('Blog Archives', 'rooten'); }
					else{
						$title = single_term_title( "", false );
						if ( $title == '' ) { // Fix for templates that are archives
							$post_id = $post->ID;
							$title = get_the_title($post_id);
						} 
					}
				}
				elseif( is_404() ) { $title = esc_html__('Oops, this Page could not be found.', 'rooten'); }
				elseif( get_post_type() == 'post' ) { $title = $blog_title; }
				else { $title = get_the_title(); }
			?>
			
			<?php if($titlebar_global == 'left' or $titlebar_global == 'center' or $titlebar_global == 'right') { ?>
				<div<?php echo rooten_helper::attrs(['id' => $id, 'class' => $class], $section_media); ?>>
					<div<?php echo rooten_helper::container(); ?>>
						<div<?php echo rooten_helper::grid(); ?>>
							<div id="title" class="bdt-width-expand<?php echo ($titlebar_global == 'center')?' bdt-text-center':''; ?>">
								<h1 class="bdt-margin-small-bottom"><?php echo esc_html($title); ?></h1>
								<?php echo rooten_breadcrumbs($titlebar_global); ?>
							</div>
							<?php if ($titlebar_global != 'center') : ?>
							<div class="bdt-margin-auto-left bdt-position-relative bdt-width-small bdt-visible@s">
								<div class="bdt-position-center-right">
									<a class="bdt-button-text bdt-link-reset" onclick="history.back()"><span class="bdt-margin-small-right" bdt-icon="icon: arrow-left"></span> <?php esc_html_e('Back', 'rooten'); ?></a>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } elseif($titlebar_global == 'notitle') { ?>
				<div id="notitlebar" class="titlebar-no"></div>
			<?php } ?>	
		<?php } ?>

	<?php } // End Else ?>

<?php endif;