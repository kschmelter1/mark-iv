<?php
$social = get_field('social_media','options');
if ($social) :
$social_list = '<ul class="list-inline social-media">';
foreach ($social as $link) {
  switch ($link["platform"]["value"]) {
    case "facebook":
      $class = 'fab fa-facebook-f';
      break;
    case "pinterest":
      $class = 'fab fa-pinterest-p';
      break;
    case "google-plus":
      $class = 'fab fa-google-plus-g';
      break;
    case "angies":
      $class = 'far fa-comment-alt';
      break;
    case "linkedin":
      $class = 'fab fa-linkedin-in';
      break;
    default:
      $class = 'fab fa-'.$link["platform"]["value"];
  }
  if (count($social) == 1) {
    $social_list .= '<li class="list-inline-item"><a href="'.$link['url'].'" target="_blank"><i class="'.$class.'" aria-hidden="true"></i><span>'.$link["platform"]["label"].'</span></a>';
  } else {
    $social_list .= '<li class="list-inline-item"><a href="'.$link['url'].'" target="_blank"><i class="'.$class.'" aria-hidden="true"></i><span class="sr-only">'.$link["platform"]["label"].'</span></a>';
  }
}
$social_list .= '</ul>';
echo $social_list;
endif;
?>
