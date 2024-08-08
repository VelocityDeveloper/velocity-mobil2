<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package velocity
 */

?>

<article <?php post_class('col-md-4 mb-3 px-2 container'); ?> id="post-<?php the_ID(); ?>">
    <div class="card p-3">

    	<a href="<?php echo get_permalink();?>">
    	    <img src="<?php echo aq_resize( get_the_post_thumbnail_url(), 300, 180, true, true, true ); ?>" alt="<?php echo get_the_title(); ?>"/>
    	</a>

    	<?php the_title( sprintf( '<h2 class="entry-title h6 text-center"><a class="text-colortheme" href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
    		'</a></h2>' ); ?>
        <?php
        $harga = get_post_meta($post->ID, 'opsiharga', true);
        echo '<span class="position-absolute badge text-bg-info text-light">Tersedia '.count($harga).' tipe</span>';
        if($harga){
            echo '<div class="text-center">';
                echo '<small>Mulai dari</small><br>';
                echo 'Rp '.number_format(preg_replace("/[^0-9]/", "", explode('=', $harga[0])[1]),'2',',','.').'-' ;
            echo '</div>';
        }
        ?>
    </div>
</article><!-- #post-## -->
