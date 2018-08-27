<?php
global $mb_content_area;
$class = ''; // bavotasan_article_class();
$bavotasan_theme_options = bavotasan_theme_options();
?>
	<li class="listing-item">
	<div id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>

		    <?php
		   
		    	$image_name = ( 'main' == $mb_content_area ) ? 'thumbnail' : '1_column';

				if( has_post_thumbnail() ) {
					echo '<a href="' . get_permalink() . '">';
					the_post_thumbnail( $image_name, array( 'class' => 'alignleft' ) );
					echo '</a>';
				}
				echo '<a href="' . get_permalink() . '">';
				echo the_title() . "<br/>";
				echo '</a>';

				$date = get_field("evenement_date", false, false);
				$date = new DateTime($date);

				echo $date->format('d/m/Y') . " de " . get_field("evenement_debut") . " &agrave; " . get_field("evenement_fin") . "<br />";
				echo "Lieu : " . get_field("evenement_lieu");
			?>

	</div><!-- #post-<?php the_ID(); ?> -->
	</li>