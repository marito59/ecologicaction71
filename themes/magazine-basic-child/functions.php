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
		add_image_size( 'sidebar-thumb', 120, 120, true ); // Hard Crop Mode
   }	

   	add_filter( 'image_size_names_choose', 'my_custom_sizes' );
   
  	function my_custom_sizes( $sizes ) {
	  	return array_merge( $sizes, array(
			'sidebar-thumb' => __( 'Image 120x120' ),
	  	) );
	}
	
	function ecologic_docs($cat_id) {
		$second_query = new WP_Query(array('category__in'=>$cat_id, 'post_type'=>'post', 'posts_per_page'=>-1, 'order'=>'ASC', 'orderby'=>'menu_order'));
		echo '<ul>';
		// The Loop
		while( $second_query->have_posts() ) : $second_query->the_post();
			echo '<li><b>';
			the_title();
			echo ("</b><br />");
			//echo (get_post_meta(get_the_ID(), 'producteur_info', true));
			$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => get_the_ID()
				   , 'post_mime_type'=>array('application/pdf', 'application/msword', 'image/jpeg'), 'order'=>'ASC', 'orderby'=>'ID' ); 
			$attachments = get_posts($args);
			if ($attachments) {
			   echo('<ul>');
				   foreach ( $attachments as $attachment ) {
						echo ('<li>');
						//echo apply_filters( 'the_title' , $attachment->post_title );
						//the_attachment_link( $attachment->ID , false );
						//<a rel="alternate" href="http://www.goutdubio.fr/wp-content/uploads/2013/02/CHAMPVENT-certificat-2013.jpg" target="_blank">EARL Champvent � Certificat de conformit�&nbsp; de production biologique des produits commercialis�s</a>
						
						echo ('<a rel="alternate" href="');
						echo wp_get_attachment_url($attachment->ID);
						echo ('" target="blank">');
						echo $attachment->post_title;
						echo ('</a>');
						echo ('</li>');
				   }
			   echo('</ul><br />');
			}
	 
			echo '</li>';
		endwhile;
		echo '</ul>';
		//wp_reset_postdata() ;
		wp_reset_query();
	}
	

?>