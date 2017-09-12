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
		<footer class="wrapper group">
			<?php if ( has_nav_menu('footer') ) : ?>
			    <nav class="footer">
					<h2 class="visuallyhidden">Footer Navigation</h2>
					<?php wp_nav_menu( array(
						'theme_location' => 'footer',
						'container' => false
					)); ?>
			    </nav>
		    <?php endif; ?>

		    <p id="copyright"><small>Copyright &copy; <?php the_date('Y'); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved.</small></p>
			<p id="abt-brand"><small><a href="http://www.atlanticbt.com/services/web-design.php" target="_blank" title="Professional Web Design">Website Design</a> and <a href="http://www.atlanticbt.com/services/web-programming.php" target="_blank" title="Custom Web Programming">Web Development</a> by <a href="http://www.atlanticbt.com/" target="_blank" title="Website Design">Atlantic BT</a></small></p>
		</footer>
	</div>

<?php wp_footer(); ?>
</body>
</html>
