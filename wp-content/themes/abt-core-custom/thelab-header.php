<?php
  $theme_dir           = get_stylesheet_directory_uri();
  $thelab_twitter    = ot_get_option( 'thelab_twitter_profile' );
  $thelab_facebook   = ot_get_option( 'thelab_facebook_profile' );
  $thelab_instagram  = ot_get_option( 'thelab_instagram_profile' );
  $thelab_google     = ot_get_option( 'thelab_google_plus_profile' );
?>
<div class="thelab-header">
  <nav id="thelab-menu" class="thelab-menu">
    <h2>Browse TheLab <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_expand.svg" /></h2>
    <?php
    wp_nav_menu(array(
      'menu' => 'TheLab',
      'container'      => false,
      'walker'         => $walker
    ));
    ?>
  </nav>
  <?php if ( $thelab_twitter || $thelab_facebook || $thelab_instagram || $thelab_google ): ?>
    <ul class="follow">
      <?php if ($thelab_twitter) : ?>
        <li class="twitter"><a href="<?php echo $thelab_twitter; ?>" target="_blank" class="tooltip" title="Follow TheLab on Twitter"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" /><span>Twitter</span></a></li>
      <?php endif; ?>         
      <?php if ($thelab_facebook) : ?>
        <li class="facebook"><a href="<?php echo $thelab_facebook; ?>" target="_blank" class="tooltip" title="Follow TheLab on Facebook"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_facebook.svg" /><span>Facebook</span></a></li>
      <?php endif; ?>
      <?php if ($thelab_instagram) : ?>
        <li class="instagram"><a href="<?php echo $thelab_instagram; ?>" target="_blank" class="tooltip" title="Follow TheLab on Instagram"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_instagram.svg" /><span>Instagram</span></a></li>
      <?php endif; ?>
      <?php if ($thelab_google) : ?>
        <li class="google"><a href="<?php echo $thelab_google; ?>" target="_blank" class="tooltip" title="Follow TheLab on Google+"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_google.svg" /><span>Google+</span></a></li>
      <?php endif; ?>
    </ul>
  <?php endif; ?>
</div>