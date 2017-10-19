<?php
  $theme_dir           = get_stylesheet_directory_uri();
  $stem_in_the_park_twitter    = ot_get_option( 'stem_in_the_park_twitter' );
  $stem_in_the_park_facebook   = ot_get_option( 'stem_in_the_park_facebook' );
  $stem_in_the_park_instagram  = ot_get_option( 'stem_in_the_park_instagram' );
  $stem_in_the_park_linkedin     = ot_get_option( 'stem_in_the_park_linkedin' );
?>
<div class="stem-header">
  <nav id="stem-menu" class="stem-menu">
    <h2>Browse STEM in the Park <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_expand.svg" /></h2>
    <?php
    wp_nav_menu(array(
      'menu' => 'STEM in the Park',
      'container'      => false,
      'walker'         => $walker
    ));
    ?>
  </nav>

  <?php if ( $stem_in_the_park_twitter || $stem_in_the_park_facebook || $stem_in_the_park_instagram || $stem_in_the_park_google ): ?>
    <ul class="follow">
      <?php if ($stem_in_the_park_twitter) : ?>
        <li class="twitter"><a href="<?php echo $stem_in_the_park_twitter; ?>" target="_blank" class="tooltip" title="Follow STEM in the Park on Twitter"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" /><span>Twitter</span></a></li>
      <?php endif; ?>
      <?php if ($stem_in_the_park_facebook) : ?>
        <li class="facebook"><a href="<?php echo $stem_in_the_park_facebook; ?>" target="_blank" class="tooltip" title="Follow STEM in the Park on Facebook"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_facebook.svg" /><span>Facebook</span></a></li>
      <?php endif; ?>
      <?php if ($stem_in_the_park_instagram) : ?>
        <li class="instagram"><a href="<?php echo $stem_in_the_park_instagram; ?>" target="_blank" class="tooltip" title="Follow STEM in the Park on Instagram"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_instagram.svg" /><span>Instagram</span></a></li>
      <?php endif; ?>
      <?php if ($stem_in_the_park_linkedin) : ?>
        <li class="linkedin"><a href="<?php echo $stem_in_the_park_linkedin; ?>" target="_blank" class="tooltip" title="Follow STEM in the Park on LinkedIn"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_linkedin.svg" /><span>LinkedIn</span></a></li>
      <?php endif; ?>
    </ul>
  <?php endif; ?>
</div>
