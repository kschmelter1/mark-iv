<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.
$blurbs = get_field('blurbs');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-blurbs';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ($blurbs) :
?>
<div class="<?= $className; ?>">
  <div class="row">
    <?php foreach ($blurbs as $blurb) : ?>
      <div class="col-lg-4 single-blurb">
        <?= ($blurb['image'] ? '<div class="img-wrap">'.echo_image($blurb['image'], 'medium_large').'</div>' : ''); ?>
        <div class="single-blurb-content">
        <?= ($blurb['title'] ? '<div class="h3">'.$blurb['title'].'</div>' : ''); ?>
        <?= ($blurb['text'] ? '<div class="text">'.$blurb['text'].'</div>' : ''); ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
