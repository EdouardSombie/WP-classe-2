<?php get_header() ?>

<main id="site-content">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<?php get_template_part('template-parts/identity-card'); ?>
				<div id="post-list-wrapper">
					<?php
					if(!is_front_page()){
						get_template_part('template-parts/posts-list');
					}
					?>
				</div>
			</div>
		</div>
		

	</div>
</main>

<?php get_footer() ?>