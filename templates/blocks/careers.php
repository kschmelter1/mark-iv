<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.
$careers = get_field('careers');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-careers';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

if ($careers) :
?>
<?= ($block['anchor'] ? '<a class="anchor" id="'.$block['anchor'].'"></a>' : ''); ?>
<div class="<?= $className; ?>">
    <?php foreach ($careers as $job) : if ($job['url']) : ?>
      <a class="single-career" href="<?= $job['url']; ?>" target="_blank">
        <div>
          <div class="h3 single-career-title"><?= $job['title']; ?></div>
          <?= ($job['location'] ? '<div class="single-career-location">'.$job['location']->name.'</div>' : ''); ?>
        </div>
        <div>
          <div class="btn btn-lg btn-secondary">View Position</div>
        </div>
      </a>
    <?php endif; endforeach; ?>
</div>
<?php endif; ?>
