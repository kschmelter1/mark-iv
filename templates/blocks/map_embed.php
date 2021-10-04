<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.
$map = get_field('iframe');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block block-map-embed';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ($map) :
?>
<div class="<?= $className; ?>">
    <?= $map; ?>
</div>
<?php endif; ?>
