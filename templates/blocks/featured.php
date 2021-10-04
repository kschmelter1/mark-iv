<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.
$props = get_field('featured_locations');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-featured';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ($props) :
?>
<div class="<?= $className; ?>">
  <?= (get_field('title') ? '<h2>'.get_field('title').'</h2>' : ''); ?>
  <div class="row swiper-container">
    <div class="swiper-wrapper">
    <?php foreach ($props as $propArray) :
      //if (!$propArray['coming_soon']) :
      $prop = $propArray['location'];
      $title = $propArray['title'];
      $cats = get_the_terms($prop->ID, 'category');
      $locs = get_the_terms($prop->ID, 'city');
      $types = array(); $allLocs = array();
      foreach ($cats as $cat) {array_push($types, '"'.$cat->slug.'"');}
      foreach ($locs as $loc) {array_push($allLocs, '"'.$loc->slug.'"');}
      // Only posts in the "Work" category go to the post's page, others go to external links unless no link is set
      if (!in_array("work", $types) && get_field('external_link', $prop->ID)) {
        $link = 'href="'.get_field('external_link', $prop->ID).'" target="_blank"';
      } else {
        $link = 'href="'.get_the_permalink($prop->ID).'"';
      }
      ?>
      <div class="col-md-6 col-lg-4 col-xl-3 single-featured swiper-slide <?= ($propArray['coming_soon'] ? 'coming-soon' : '');?>">
        <a class="wrapper" <?= $link; ?>>
          <?php
          if ($propArray['image']) {
            echo echo_image($propArray['image'],'thumbnail');
          } elseif (get_the_post_thumbnail($prop->ID)) {
            echo get_the_post_thumbnail($prop->ID, 'thumbnail');
          } ?>
          <?php if ($propArray['coming_soon']) : ?><div class="coming-soon-title">Coming Soon</div><?php endif; ?>
          <div class="text">
            <div class="type"><?php
            if ($cats[0]->parent < 1 && isset($cats[1])) {
              echo $cats[1]->name;
            } else {echo $cats[0]->name;}?></div>
            <div class="title"><?= ($title && $propArray['coming_soon'] ? $title : $prop->post_title); ?></div>
            <div class="subtitle"><?= $locs[0]->name; ?></div>
          </div>
        </a>
      </div>
      <?php /*else : ?>
        <div class="col-md-3 single-featured swiper-slide coming-soon">
          <div class="wrapper">
            <?= echo_image($propArray['image'],'thumbnail'); ?>
            <div class="text">
              <div class="title">Coming Soon!</div>
            </div>
          </div>
        </div>
      <?php  endif; */?>
    <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>
