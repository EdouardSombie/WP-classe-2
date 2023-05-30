<?php // Template par défaut d'une page seule ?>

<?php get_header(); ?>

<main id="site-content">
		
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-3">
				<?php if(is_front_page()){ 
					get_template_part('template-parts/identity-card');
				}else{ ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php } ?>
			</div>
		</div>
	</div>

</main>

<?php get_footer(); ?>