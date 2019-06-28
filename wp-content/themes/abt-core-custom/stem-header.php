<?php
  $theme_dir           = get_stylesheet_directory_uri();
  $stem_rtp_twitter    = ot_get_option( 'stem_rtp_twitter' );
  $stem_rtp_facebook   = ot_get_option( 'stem_rtp_facebook' );
  $stem_rtp_instagram  = ot_get_option( 'stem_rtp_instagram' );
  $stem_rtp_linkedin     = ot_get_option( 'stem_rtp_linkedin' );
?>
<div class="stem-header">
  <nav id="stem-menu" class="stem-menu">
    <h2>Browse STEM in the Park <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_expand.svg" /></h2>
    <?php
    wp_nav_menu(array(
      'menu' => 'STEM RTP',
      'container'      => false,
      'walker'         => $walker
    ));
    ?>
  </nav>

  <a href="https://squareup.com/store/research-triangle-park-charitable-fund" target="_blank" class="button">Donate Now</a>

  <?php if ( $stem_rtp_twitter || $stem_rtp_facebook || $stem_rtp_instagram || $stem_rtp_google ): ?>
    <ul class="follow">
      <?php if ($stem_rtp_twitter) : ?>
        <li class="twitter"><a href="<?php echo $stem_rtp_twitter; ?>" target="_blank" class="tooltip" title="Follow STEM in the Park on Twitter"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" /><span>Twitter</span></a></li>
      <?php endif; ?>
      <?php if ($stem_rtp_facebook) : ?>
        <li class="facebook"><a href="<?php echo $stem_rtp_facebook; ?>" target="_blank" class="tooltip" title="Follow STEM in the Park on Facebook"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_facebook.svg" /><span>Facebook</span></a></li>
      <?php endif; ?>
      <?php if ($stem_rtp_instagram) : ?>
        <li class="instagram"><a href="<?php echo $stem_rtp_instagram; ?>" target="_blank" class="tooltip" title="Follow STEM in the Park on Instagram"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_instagram.svg" /><span>Instagram</span></a></li>
      <?php endif; ?>
      <?php if ($stem_rtp_linkedin) : ?>
        <li class="linkedin"><a href="<?php echo $stem_rtp_linkedin; ?>" target="_blank" class="tooltip" title="Follow STEM in the Park on LinkedIn"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_linkedin.svg" /><span>LinkedIn</span></a></li>
      <?php endif; ?>
    </ul>
  <?php endif; ?>
</div>
