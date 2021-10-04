<?php
$id = get_the_id();
$blocks = parse_blocks(get_the_content(null, false, $id));

if ($blocks) {
  for ($i = 0; $i < count($blocks); $i++) {
    if (substr($blocks[$i]['blockName'], 0, 3) === 'acf') {
      if ($i == 0 && $blocks[$i]['blockName'] === 'acf/hero-slider') {
        echo render_block( $blocks[$i] );
        echo '<div class="mid-nav">';
        get_template_part('templates/part','navigation');
        echo '</div>';
      } else {
        echo render_block( $blocks[$i] );
      }
    } else {
      if ($blocks[$i]['blockName']) { //Stops null blocks from outputting
      echo '<div class="container-fluid guten-block">';
      echo apply_filters( 'the_content', render_block( $blocks[$i] ) );
      echo '</div>';
      }
    }
  }
} else {
  the_content(null, false, $id);
}
?>
