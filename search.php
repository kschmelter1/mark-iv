<?php

get_header();


?>
<div class="container-fluid archive-page">
  <h1 class="page-title"><i class="fas fa-search"></i> Search Results</h1>

  <div class="location-search-wrapper">
    <div class="search-message">Viewing Search Results for "<?= $s; ?>"</div>
    <?php get_template_part('templates/part','search'); ?>
  </div>

  <?php if ( have_posts() ) : ?>
    <div class="row location-search-gallery">
    <?php  while ( have_posts() ) : the_post();
      $myID = get_the_ID();
      $cats = get_the_terms($myID, 'category');
      $locs = get_the_terms($myID, 'city');
      $types = array(); $allLocs = array();
      foreach ($cats as $cat) {array_push($types, '"'.$cat->slug.'"');}
      foreach ($locs as $loc) {array_push($allLocs, '"'.$loc->slug.'"');}
      // Only posts in the "Work" category go to the post's page, others go to external links unless no link is set
      if (!in_array("work", $types) && get_field('external_link')) {
        $link = 'href="'.get_field('external_link').'" target="_blank"';
      } else {
        $link = 'href="'.get_the_permalink().'"';
      }
    ?>
      <div
        class="col-md-3 location-search-item active"
        data-type='[<?php echo implode(', ', $types);?>]'
        data-city='[<?php echo implode(', ', $allLocs);?>]'
      >
        <a class="wrapper" <?= $link; ?>>
          <?php if (get_the_post_thumbnail($myID)) {
            echo get_the_post_thumbnail($myID, 'thumbnail');
          } ?>
          <div class="text">
            <div class="title"><?= get_the_title(); ?></div>
            <div class="subtitle"><?= $locs[0]->name; ?></div>
          </div>
        </a>
      </div>
    <?php endwhile; ?>
  </div>
  <?php endif; ?>
</div>

<?php

get_footer();

?>
