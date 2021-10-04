<?php
get_template_part('templates/part','contact');
$addr = get_field('address','options');
$phone = get_field('phone','options');
$seo = get_field('locality_footer_text','options');
?>
<footer class="container-fluid">
  <div class="row">

    <div class="col-md-6 col-xl-5 address-col">
      <?php get_template_part('templates/part','logo'); ?>
      <address>
        <strong><?= get_bloginfo('sitename'); ?></strong>
        <?= ($addr ? '<div>'.$addr['street'].'</div><div>'.$addr['city'].', '.$addr['state'].' '.$addr['zip'].'</div>' : ''); ?>
        <?= ($phone ? '<a href="'.clean_phone($phone).'">'.$phone.'</a>' : ''); ?>
      </address>
    </div>

    <div class="col-12 col-md-6 col-xl-12 nav-col">
      <nav class="navbar navbar-expand-xl footer-nav">
        <?php

          wp_nav_menu([
            'theme_location'    => 'footer',
            'depth'             => 2,
            'container'         => '',
            'container_class'   => '',
            'container_id'      => '',
            'menu_class'        => 'navbar-nav',
            'echo'				=> true,
            'walker'            => new bs4Navwalker()
          ]);

        ?>
      </nav>
    </div>

    <div class="col-md-5 social-col"><?php get_template_part('templates/part','social'); ?></div>

    <div class="col-12 col-xl-7 seo-col"><?= ($seo ? '<div class="seo">'.$seo.'</div>' : ''); ?></div>

    <div class="col-md-7 credit-col"><?php get_template_part('templates/part','compulse'); ?></div>

  </div>




</footer>

<?php wp_footer(); ?>
</body>

</html>
