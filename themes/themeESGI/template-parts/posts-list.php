<?php 

// Récupérer le paramètre $paged s'il existe

if(!isset($paged)){
	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
}
if(!isset($base)){
	$big = 999999999; // need an unlikely integer
	$base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
}

$args = array(
	'posts_per_page' => get_option( 'posts_per_page' ),
	'paged' => $paged,
	'post_status' => 'publish'
);

// Créer une WP_Query
$the_query = new WP_Query( $args );


?>
<section class="posts-list">
	<ul>
		<?php 

		// loop sur la query
		if($the_query->have_posts()){
			while($the_query->have_posts()){
				$the_query->the_post(); // Crée automatiquement une variable $post
				$p = get_post();
				?>

				<li><a href="<?= get_permalink($p->ID) ?>"><?= $p->post_title ?> <time><?= wp_date('j F Y', strtotime($p->post_date)) ?></time> </a></li>

			<?php }
		}
		?>
	</ul>
	<nav class="post-list-pagination">
	<?php

		// Affichage de la pagination
		

		echo paginate_links( array(
			'base' => $base,
			'format' => '?paged=%#%',
			'current' => max( 1, $paged ),
			'total' => $the_query->max_num_pages
		) );
	 ?>
	</nav>
</section>