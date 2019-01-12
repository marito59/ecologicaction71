<?php
$class = bavotasan_article_class();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
		<?php
		if ( has_post_thumbnail() ) {
			$attr = array(
				'class' => "image image-anchor documents-thumb",
				'alt'   => "thumbnail"
			);
			the_post_thumbnail( 'document-thumb', $attr ); 
		} else { 
		?> 	&nbsp; <?php
		}?>
		<a class="title" href="<?php the_permalink(); ?>"><?php the_title( ); ?></a>
        <div class="dps-listing-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->