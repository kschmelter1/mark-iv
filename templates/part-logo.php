<a href="/" class="logo">
<?php
  $logo = get_field('logo','options');
  //get_template_part('templates/svg','logo');
  echo ($logo ? echo_image($logo, 'medium') : '<svg class="logo-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 685 314"><g data-name="Layer 2"><g data-name="Layer 1"><polygon class="cls-1" points="0 314 89 0 162 0 214 182 266 0 338 0 426 314 347 314 302 143 255 314 175 314 127 139 80 314 0 314"/><polygon class="cls-2" points="433 314 348 0 421 0 510 314 433 314"/><polygon class="cls-2" points="435 0 521 314 600 314 685 0 612 0 560 182 510 0 435 0"/></g></g></svg>');
  echo '<div class="logo-text">'.get_bloginfo('sitename').'</div>';
?>
</a>
