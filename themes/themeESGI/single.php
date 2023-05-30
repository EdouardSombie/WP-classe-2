<?php // Template par défaut d'un article seul ?>

<?php get_header(); ?>

<main id="site-content">
		
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-3">
				<h1><?php the_title(); ?></h1>
				<?= get_the_post_thumbnail() ?>
				<?php the_content(); ?>
			</div>
		</div>
	</div>

</main>

<?php get_footer(); ?>