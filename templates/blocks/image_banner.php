<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.
$image = get_field('image');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-image-banner';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ($image) :
?>
<div class="<?= $className; ?>">
  <div class="img-wrap">
    <?= echo_image($image, 'large'); ?>
  </div>
</div>
<?php endif; ?>
