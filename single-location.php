<?php get_header();
  $addr = get_field('address');
  $phone = get_field('phone');
  $link = get_field('external_link');
  $myID = get_the_ID();
  $cats = get_the_terms($myID, 'category');
  $locs = get_the_terms($myID, 'city');
  $gallery = get_field('gallery');
?>
<div class="single-location-hero">
  <?= the_post_thumbnail(); ?>
  <?php get_template_part('templates/part','navigation_hero'); ?>
  <div class="container-fluid single-location-hero-content">
    <div class="row align-items-end">
      <div class="col-md-6 col-lg-8">
        <div class="subtitle"><?php
          if ($cats) {
            $displayCats = array();
            foreach ($cats as $cat) {
              if ($cat->parent > 0) {
                array_push($displayCats, $cat);
              }
            }
            for ($i = 0; $i < count($displayCats); $i++) {
                if ($i > 0 && $i < count($displayCats) - 1) {
                  echo ', ';
                } elseif (count($displayCats) === 2 && $i === 1) {
                  echo ' and ';
                } elseif ($i > 0 && $i === count($displayCats) - 1) {
                  echo ', and ';
                }
                echo $cats[$i]->name;
            }
          }
          if ($displayCats && $locs) {echo ' in ';}
          echo $locs[0]->name;
          ?></div>
        <h1 class="single-location-hero-content-title"><?= get_the_title(); ?></h1>
      </div>
      <div class="col-md">
        <address>
          <?= echo_addr($addr); ?>
          <?= clean_phone($phone, true); ?>
        </address>
        <?= ($link ? '<a href="'.$link.'" class="btn btn-lg btn-secondary" target="_blank">Visit Website</a>' : ''); ?>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid single-location-content">
  <div class="row tabbed-content active" id="tab-1">
    <div class="col-lg single-location-content-text">
      <?php the_content(); ?>
      <?= ($link ? '<a href="'.$link.'" class="btn btn-lg btn-secondary" target="_blank">Visit Website</a>' : ''); ?>
    </div>
    <?php if ($gallery) : ?>
      <div class="col-lg-4 gallery-sidebar">
        <div class="img-wrap item" data-src="<?php echo $gallery[0]['sizes']['large'];?>">
          <div class="overlay"><i class="fal fa-search-plus"></i></div>
          <?= echo_image($gallery[0], 'medium_large'); ?>
        </div>
        <?php if (count($gallery) > 1) {
          echo '<a href="#tab-2" class="btn btn-lg btn-secondary gallery-toggle">View More Images</a>';
        } ?>
      </div>
    <?php endif; ?>
  </div>
  <?php if (count($gallery) > 1) : ?>
    <div class="row gallery-sidebar tabbed-content" id="tab-2">
      <?php for ($i = 1; $i < count($gallery); $i++) : ?>
        <div class="col-lg-4">
          <div class="img-wrap item" data-src="<?php echo $gallery[$i]['sizes']['large'];?>">
            <div class="overlay"><i class="fal fa-search-plus"></i></div>
            <?= echo_image($gallery[$i], 'medium_large'); ?>
          </div>
        </div>
      <?php endfor; ?>
      <div class="col-12"><a href="#tab-1" class="btn btn-lg btn-secondary gallery-toggle">Return to Listing</a></div>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
