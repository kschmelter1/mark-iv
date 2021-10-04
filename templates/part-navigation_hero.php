<div class="main-navigation main-navigation-hero">
  <div class="container-fluid">
    <div class="row justify-content-between align-items-center">

      <div class="logo-col col-7 col-lg-4">
          <?php get_template_part('templates/part','logo'); ?>
      </div>

      <div class="navigation-col col-sm">
        <nav class="navbar navbar-expand-xl">
      	  <div class="collapse navbar-collapse primary-navbar">
            <i class="navbar-close far fa-times"></i>
      		<?php

      			wp_nav_menu([
      				'theme_location'    => 'primary',
      				'depth'             => 2,
      				'container'         => '',
      				'container_class'   => '',
      				'container_id'      => '',
      				'menu_class'        => 'navbar-nav',
      				'echo'				=> true,
      				'walker'            => new bs4Navwalker()
      			]);

      		?>
          <div class="nav-social">
          <?php $phone = get_field('phone','options'); echo ($phone ? '<a href="'.clean_phone($phone).'" title="Call Now"><i class="fas fa-phone"></i></a>' : ''); ?>
          <?php get_template_part('templates/part','social'); ?>
          </div>
      	  </div>
        	</nav>
      </div>

        <div class="nav-button-col d-xl-none col-5 col-lg-8">
          <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>
        </div>

    </div>
  </div>
</div>
