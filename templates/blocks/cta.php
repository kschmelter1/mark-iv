<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.
$title = get_field('title');
$text = get_field('text');
$btn = get_field('button');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block block-cta';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ($title || $text || $btn) :
?>
<div class="<?= $className; ?>">
  <?php get_template_part('templates/house','svg'); ?>
  <div class="container-fluid text-center">
    <?= ($title ? '<h2>'.$title.'</h2>' :''); ?>
    <?= ($text ? '<div>'.$text.'</div>' :''); ?>
    <?= ($btn ? echo_link($btn, 'btn btn-lg btn-secondary') : ''); ?>
  </div>
</div>
<?php endif; ?>
