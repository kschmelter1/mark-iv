<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	$id = get_the_id();
	$blocks = parse_blocks(get_the_content(null, false, $id));
	if (!$blocks || $blocks[0]['blockName'] != 'acf/hero-slider' && !is_singular('location')) {
	  echo '<div class="top-nav">';
	  get_template_part('templates/part','navigation');
	  echo '</div>'; ?>
		<?php if (!is_archive() && !is_search()) : ?>
		<div class="container-fluid page-title-container">
			<h1 class="page-title"><?php
			$icon = get_field('icon');
			if ($icon === 'logo') {
				echo '<svg class="page-title-logo-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 685 314"><g data-name="Layer 2"><g data-name="Layer 1"><polygon class="cls-1" points="0 314 89 0 162 0 214 182 266 0 338 0 426 314 347 314 302 143 255 314 175 314 127 139 80 314 0 314"/><polygon class="cls-2" points="433 314 348 0 421 0 510 314 433 314"/><polygon class="cls-2" points="435 0 521 314 600 314 685 0 612 0 560 182 510 0 435 0"/></g></g></svg>';
			} else {
				echo ($icon ? '<i class="fas '.$icon.'"></i>' : '');
			}
		  echo '<span>'.get_the_title().'</span>';
		  ?></h1>
			<?php $link = get_field('top_link'); echo ($link ? echo_link($link, 'top-link btn btn-secondary') : ''); ?>
		</div>
		<?php endif; ?>
	<?php } ?>
