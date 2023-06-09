<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
		<header id="site-header" class="col-md-6 offset-3">
			<div class="container">
				<?php if(has_nav_menu('main_menu')){
					wp_nav_menu([
						'menu' => 'main_menu',
						'container' => 'nav',
						'container_class' => 'main-nav'
					]);
				}
				?>
			</div>
		</header>