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

			<?php if(get_theme_mod('has_sidebar', false)){ ?>
				<div class="col-md-2 offset-1">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>