<?php
/**
 * The template used for displaying post content with attachements
 *
 * @since 3.0.0
 */
$class = bavotasan_article_class();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
		<div class="document-thumb">
		<?php
		if ( has_post_thumbnail() ) {
			$attr = array(
				'class' => "documents-thumb",
				'alt'   => "thumbnail"
			);
			the_post_thumbnail( 'document-thumb' ); 
		} else { 
		?> 	&nbsp; <?php
		}?></div>
		<div class="document-content"><?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	    	<div class="entry-content">
		  	  <?php the_content(); ?>
			
		
<?php
		$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => get_the_ID()
			, 'post_mime_type'=>array('application/pdf', 'application/msword', 'image/jpeg'), 'order'=>'ASC', 'orderby'=>'ID' ); 
		$attachments = get_posts($args);
		if ($attachments) {
			echo('<ul>');
				foreach ( $attachments as $attachment ) {
					echo ('<li>');
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

?>
			</div><!-- .entry-content -->
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->