<?php
/*
Plugin Name: BdThemes Portfolio
Plugin URI: http://themeforest.net/user/bdthemes
Description: This plugin will create a portfolio custom post type for bdthemes wordpress theme.
Version: 1.0
Author: bdthemes
Author URI: http://bdthemes.com
License: Custom
License URI: http://themeforest.net/licenses 
*/

/* ----------------------------------------------------- */
/* Add Portfolio Custom Post Type
/* ----------------------------------------------------- */
function bdthemes_portfolio_register() {  

	$portfolio_slug = get_theme_mod('bdthemes_portfolio_slug');

	if(isset($portfolio_slug) && $portfolio_slug != ''){
		$portfolio_slug = $portfolio_slug;
	} else {
		$portfolio_slug = 'portfolio-item';
	}
	
	$labels = array(
		'name'               => esc_html__( 'Portfolio', 'bdthemes' ),
		'singular_name'      => esc_html__( 'Portfolio Item', 'bdthemes' ),
		'add_new'            => esc_html__( 'Add New Item', 'bdthemes' ),
		'add_new_item'       => esc_html__( 'Add New Portfolio Item', 'bdthemes' ),
		'edit_item'          => esc_html__( 'Edit Portfolio Item', 'bdthemes' ),
		'new_item'           => esc_html__( 'Add New Portfolio Item', 'bdthemes' ),
		'view_item'          => esc_html__( 'View Item', 'bdthemes' ),
		'search_items'       => esc_html__( 'Search Portfolio', 'bdthemes' ),
		'not_found'          => esc_html__( 'No portfolio items found', 'bdthemes' ),
		'not_found_in_trash' => esc_html__( 'No portfolio items found in trash', 'bdthemes' )
	);
	
    $args = array(  
		'labels'          => $labels,
		'public'          => true,  
		'show_ui'         => true,  
		'capability_type' => 'post',  
		'hierarchical'    => false,  
		'menu_icon'       => 'dashicons-portfolio',
		'rewrite'         => array('slug' => $portfolio_slug), // Permalinks format
		'supports'        => array('title', 'editor', 'thumbnail', 'comments', 'excerpt')  
       );  
  
    register_post_type( 'portfolio' , $args );  
}
add_action('init', 'bdthemes_portfolio_register', 1);   

/* ----------------------------------------------------- */
/* Register Taxonomy
/* ----------------------------------------------------- */
function bdthemes_portfolio_taxonomy() {
	
	register_taxonomy(
		"portfolio_filter", 
		array("portfolio"), 
		array(
			"hierarchical"   => true, 
			"label"          => "Portfolio Filter", 
			"singular_label" => "Project Filter", 
			"rewrite"        => true
		)
	);

	register_taxonomy( 
        'portfolio_tag', 
        'portfolio', 
        array( 
            'hierarchical'  => false, 
            'label'         => __( 'Tags', 'bdthemes' ), 
            'singular_name' => __( 'Tag', 'bdthemes' ), 
            'rewrite'       => true, 
            'query_var'     => true 
        )  
    );

}
add_action('init', 'bdthemes_portfolio_taxonomy', 1);   

/* ----------------------------------------------------- */
/* Add Columns to Portfolio Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
/* ----------------------------------------------------- */
function bdthemes_portfolio_edit_columns( $portfolio_columns ) {
	$portfolio_columns = array(
		"cb"               => "<input type=\"checkbox\" />",
		"title"            => esc_html__('Title', 'bdthemes'),
		"thumbnail"        => esc_html__('Thumbnail', 'bdthemes'),
		"portfolio_filter" => esc_html__('Filter', 'bdthemes'),
		"author"           => esc_html__('Author', 'bdthemes'),
		"comments"         => esc_html__('Comments', 'bdthemes'),
		"date"             => esc_html__('Date', 'bdthemes'),
	);
	$portfolio_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
	return $portfolio_columns;

}
add_filter( 'manage_portfolio_posts_columns', 'bdthemes_portfolio_edit_columns' );


/* ----------------------------------------------------- */

function bdthemes_portfolio_column_display( $portfolio_columns, $post_id ) {
	
	switch ( $portfolio_columns ) {

		// Display the thumbnail in the column view
		case "thumbnail":
			$width = (int) 80;
			$height = (int) 80;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			
			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset( $thumb ) ) {
				echo $thumb; // No need to escape
			} else {
				echo esc_html__('None', 'bdthemes');
			}
			break;	
			
		// Display the portfolio tags in the column view
		case "portfolio_filter":
		
		if ( $category_list = get_the_term_list( $post_id, 'portfolio_filter', '', ', ', '' ) ) {
			echo $category_list; // No need to escape
		} else {
			echo esc_html__('None', 'bdthemes');
		}
		break;			
	}
}
add_action( 'manage_portfolio_posts_custom_column', 'bdthemes_portfolio_column_display', 10, 2 );


// function set_book_columns($columns) {
//     return array(
// 		'cb'          => '<input type="checkbox" />',
// 		'title'       => __('Title'),
// 		'comments'    => '<span class="vers comment-grey-bubble" title="' . esc_attr__( 'Comments' ) . '"><span class="screen-reader-text">' . __( 'Comments' ) . '</span></span>',
// 		'date'        => __('Date'),
// 		'publisher'   => __('Publisher'),
// 		'book_author' =>__( 'Book Author')
//     );
// }
// add_filter('manage_book_posts_columns' , 'set_book_columns');