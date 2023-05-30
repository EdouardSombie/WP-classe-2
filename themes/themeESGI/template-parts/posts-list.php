<?php 
$args = [
			'numberposts' => 6
		];
$posts = get_posts($args);

//var_dump($posts);

?>
<section class="posts-list">
	<ul>
		<?php 
		foreach ($posts as $p) { ?>
			<li><a href="<?= get_permalink($p->ID) ?>"><?= $p->post_title ?> <time><?= wp_date('j F Y', strtotime($p->post_date)) ?></time> </a></li>
		<?php } ?>
	</ul>
</section>