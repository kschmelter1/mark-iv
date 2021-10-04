<?php

get_header();

$catID = get_queried_object_id();

$kids = get_terms([
    'taxonomy' => get_queried_object()->taxonomy,
    'parent'   => $catID,
    'hide_empty' => true,
]);
//$cities = get_terms([
//    'taxonomy' => 'city'
//]);
$icon = get_field('icon');
$args = array (
  'posts_per_page' => -1,
  'post_type' => 'location',
  'orderby' => 'menu_order',
  'order' => 'asc',
  'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'terms' => $catID
        )
    )
);
$myposts = get_posts( $args );
?>
<div class="container-fluid page-title-container">
  <h1 class="page-title"><?php
  echo ($icon ? '<i class="fas '.$icon.'"></i>' : '');
  single_cat_title();
  ?></h1>
</div>
<?php if (get_field('google_map') && get_field('gmap_api', 'options')) {
  echo '<div class="container-fluid block block-google-map"><div id="g-map-wrap"></div></div>';
} ?>
<div class="container-fluid archive-page">
  <div class="location-search-wrapper">
    <?php if ($myposts) :
        // Only displays cities that are associated with current posts
        $cities = array();
        foreach( $myposts as $post ) :
        $locs = get_the_terms($post->ID, 'city');
        foreach ($locs as $loc) {
          if (!in_array($loc, $cities)) {array_push($cities, $loc);}
        }
        endforeach;
      ?>
    <div class="location-search-controls d-flex">
      <span>View</span>
        <div class="select-wrapper">
          <select class="select-types">
            <option value="all">All</option>
            <?php foreach ($kids as $kid) : ?>
              <option value="<?= $kid->slug; ?>"><?= $kid->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
       <span>in</span>
        <div class="select-wrapper">
          <select class="select-locations">
            <option value="all">All Locations</option>
            <?php foreach ($cities as $city) : ?>
              <option value="<?= $city->slug; ?>"><?= $city->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
    </div>
    <?php endif; ?>
    <?php get_template_part('templates/part','search'); ?>
  </div>

  <?php if ($myposts) : ?>
    <div class="row location-search-gallery">
    <?php foreach( $myposts as $post ) :
      $cats = get_the_terms($post->ID, 'category');
      $locs = get_the_terms($post->ID, 'city');
      $types = array(); $allLocs = array();
      foreach ($cats as $cat) {array_push($types, '"'.$cat->slug.'"');}
      foreach ($locs as $loc) {array_push($allLocs, '"'.$loc->slug.'"');}
      // Only posts in the "Work" category go to the post's page, others go to external links unless no link is set
      if (!in_array("work", $types) && get_field('external_link', $post->ID)) {
        $link = 'href="'.get_field('external_link', $post->ID).'" target="_blank"';
      } else {
        $link = 'href="'.get_the_permalink($post->ID).'"';
      }
    ?>
      <div
        class="col-sm-6 col-lg-4 col-xl-3 location-search-item active"
        data-type='[<?php echo implode(', ', $types);?>]'
        data-city='[<?php echo implode(', ', $allLocs);?>]'
      >
        <a class="wrapper" <?= $link; ?>>
          <?php if (get_the_post_thumbnail($post->ID)) {
            echo get_the_post_thumbnail($post->ID, 'thumbnail');
          } ?>
          <div class="text">
            <div class="title"><?= $post->post_title; ?></div>
            <div class="subtitle"><?= $locs[0]->name; ?></div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
    <div class="col-md-12 location-search-empty"><p>There are no matching properties.</p></div>
  </div>
  <?php endif; ?>
</div>

<?php

get_footer();

?>
