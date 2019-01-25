<?php

	function my_theme_enqueue_styles() {

		$parent_style = 'magazine-basic-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( $parent_style ),
			wp_get_theme()->get('Version')
		);
	}
	add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

	add_action('init', 'my_init_function');
	
    function my_init_function() {
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'document-thumb', 120, 120, true ); // Hard Crop Mode
   }	

   	add_filter( 'image_size_names_choose', 'my_custom_sizes' );
   
  	function my_custom_sizes( $sizes ) {
	  	return array_merge( $sizes, array(
			'document-thumb' => __( 'Image 120x120' ),
	  	) );
	}	

	// utilisation d'une template part dans Display Post Shortcode pour afficher les évènements
	function cma_ecolo_dps_template_part( $output, $original_atts ) {

		// Return early if our "layout" attribute is not specified
		if( empty( $original_atts['layout'] ) )
			return $output;
		ob_start();
		get_template_part( 'template-parts/dps', $original_atts['layout'] );
		$new_output = ob_get_clean();
		if( !empty( $new_output ) )
			$output = $new_output;
		return $output;
	}

	add_action( 'display_posts_shortcode_output', 'cma_ecolo_dps_template_part', 10, 2 );
	
	// redirige les pages documents (qui ont un document attaché) vers le document attaché
	function cma_ecolo_attachment_redirect() {
		$document_attache = get_field('media_attache');
		if( $document_attache ){
			wp_safe_redirect($document_attache['url'], 301);
			exit;
		}
	}
	add_action( 'template_redirect', 'cma_ecolo_attachment_redirect' );
?>