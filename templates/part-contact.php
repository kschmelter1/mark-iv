<?php if (get_field('display_contact_form')) : $title = get_field('contact_form_title') ?: 'Contact us for more information.';?>
    <div class="container-fluid main-contact-form">
      <h2 class="main-contact-form-title">
        <?= $title; ?>
      </h2>
      <?php echo do_shortcode('[formidable id=1]'); ?>
      <small>This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy" target="_blank">Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.</small>
    </div>
<?php endif; ?>
