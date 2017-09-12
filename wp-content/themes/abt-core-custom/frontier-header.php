<?php
  $theme_dir           = get_stylesheet_directory_uri();
  $frontier_twitter    = ot_get_option( 'frontier_twitter_profile' );
  $frontier_facebook   = ot_get_option( 'frontier_facebook_profile' );
  $frontier_instagram  = ot_get_option( 'frontier_instagram_profile' );
  $frontier_google     = ot_get_option( 'frontier_google_plus_profile' );
?>
<div class="frontier-header">
  <nav id="frontier-menu" class="frontier-menu">
    <h2>Browse The Frontier <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_expand.svg" /></h2>
    <?php
    wp_nav_menu(array(
      'menu' => 'The Frontier',
      'container'      => false,
      'walker'         => $walker
    ));
    ?>
  </nav>
  <?php if ( $frontier_twitter || $frontier_facebook || $frontier_instagram || $frontier_google ): ?>
    <ul class="follow">
      <?php if ($frontier_twitter) : ?>
        <li class="twitter"><a href="<?php echo $frontier_twitter; ?>" target="_blank" class="tooltip" title="Follow The Frontier on Twitter"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" /><span>Twitter</span></a></li>
      <?php endif; ?>         
      <?php if ($frontier_facebook) : ?>
        <li class="facebook"><a href="<?php echo $frontier_facebook; ?>" target="_blank" class="tooltip" title="Follow The Frontier on Facebook"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_facebook.svg" /><span>Facebook</span></a></li>
      <?php endif; ?>
      <?php if ($frontier_instagram) : ?>
        <li class="instagram"><a href="<?php echo $frontier_instagram; ?>" target="_blank" class="tooltip" title="Follow The Frontier on Instagram"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_instagram.svg" /><span>Instagram</span></a></li>
      <?php endif; ?>
      <?php if ($frontier_google) : ?>
        <li class="google"><a href="<?php echo $frontier_google; ?>" target="_blank" class="tooltip" title="Follow The Frontier on Google+"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_google.svg" /><span>Google+</span></a></li>
      <?php endif; ?>
    </ul>
  <?php endif; ?>
</div>