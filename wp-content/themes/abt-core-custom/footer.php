<?php
/**
 * Footer Template
 *
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */
?>
						<div class="footer-container">
							<footer class="group">
								<p class="copyright"><small>Copyright &copy; <?php echo date("Y") ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved.</small></p>
								<?php if ( has_nav_menu('footer') ) : ?>
								    <nav class="footer">
										<h2 class="visuallyhidden">Footer Navigation</h2>
										<?php wp_nav_menu( array(
											'theme_location' => 'footer',
											'container' => false
										)); ?>
								    </nav>
							    <?php endif; ?>						    
							</footer>
						</div>
				</div><!-- /st-content-inner -->
			</div><!-- /st-content -->
		</div><!-- /st-pusher -->
	</div><!-- /st-container -->
<?php wp_footer(); ?>
<div id="outdated"></div>
<script type="text/javascript">
_linkedin_data_partner_id = "24737";
</script><script type="text/javascript">
(function(){var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})();
</script>
</body>
</html>