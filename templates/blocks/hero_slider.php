<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.
$slides = get_field('slides');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block-hero-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ($slides) :
?>
<div class="<?= $className; ?>">
  <?php get_template_part('templates/part','navigation_hero'); ?>
  <div class="swiper-container">

      <div class="swiper-wrapper">
          <?php foreach ($slides as $slide) : ?>
            <div class="swiper-slide">
              <?= echo_image($slide); ?>
              <?php if ($slide['description']) : ?>
              <div class="embed-wrapper">
                <iframe frameborder="0" height="100%" width="100%"
                  src="https://youtube.com/embed/<?= $slide['description']; ?>?autoplay=1&controls=0&showinfo=0&autohide=1">
                </iframe>
              </div>
              <?php endif; ?>
              <?= ($slide['caption'] ? '<div class="swiper-slide-caption"><div>'.$slide['caption'].'</div></div>' : ''); ?>
            </div>
          <?php endforeach; ?>
      </div>

      <?php if (count($slides) > 1) : ?>
        <div class="swiper-pagination-wrapper">
          <div class="swiper-pagination"></div>
        </div>
      <?php endif; ?>
  </div>

</div>
<?php endif; ?>
