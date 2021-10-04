<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.
$btns = get_field('buttons');
$api = get_field('gmap_api', 'options');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-google-map';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ($btns && $api) :
?>
<div class="<?= $className; ?>">
  <div class="row">
  <?php foreach ($btns as $btn) : ?>
    <div class="col-xxl-4">
      <?php $children = get_categories( array( 'parent' => $btn['category']->term_id ) );?>
      <?php if ($btn['link']) {
        $btnLink = 'href="'.$btn['link']['url'].'" target="'.$btn['link']['target'].'"';
      } else {
        $btnLink = 'href="/category/'.$btn['category']->slug.'"';
      } ?>
      <a class="map-btn" <?= $btnLink;?> id="map-btn-<?= $btn['category']->slug;?>" data-cat="<?= $btn['category']->slug;?>">
        <?= ($btn['image'] ? '<div class="img-wrap">'.echo_image($btn['image'], 'medium').'</div>' : ''); ?>
        <div class="content">
          <div class="content-title">
            <?= (get_field('icon', $btn['category']) ? '<i class="fas '.get_field('icon', $btn['category']).'"></i>' : ''); ?>
            <?= $btn['category']->name; ?>
          </div>
          <?php if ($btn['subtitles']) : ?><div class="content-subtitle">
            <?php foreach ($btn['subtitles'] as $child) {echo '<span>'.$child['text'].'</span>';} ?>
          </div><?php endif; ?>
        </div>
      </a>
    </div>
  <?php endforeach; ?>
  </div>

  <div id="g-map-wrap"></div>
</div>

<?php endif; ?>
