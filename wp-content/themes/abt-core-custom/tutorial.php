<?php
	$theme_dir = get_stylesheet_directory_uri();
?>
<section class="site-tutorial">
	<ul class="pagination">
		<li><a href="#tutorial-intro">Intro</a></li>
		<li><a href="#tutorial-discover">Discover</a></li>
		<li><a href="#tutorial-explore">Explore</a></li>
		<li><a href="#tutorial-enjoy">Enjoy</a></li>
	</ul>
	<section id="tutorial-intro" class="tutorial-intro">
		<div><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_rtp.svg" /></div>
		<h1>Welcome to <strong>The Research Triangle Park</strong></h1>
		<button class="primary" data-tutorial-action="close">Explore RTP Now</button>
		<button class="secondary" data-tutorial-action="next">Take the Quick Tour</button>
	</section>
	<section id="tutorial-discover" class="tutorial-discover">
		<div><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_eye.svg" /></div>
		<h1><strong>Discover</strong> the Topics Trending at RTP</h1>		
		<button class="secondary" data-tutorial-action="previous">Wait, Go Back</button>
		<button class="secondary" data-tutorial-action="next">Got It, Continue</button>
	</section>
	<section id="tutorial-explore" class="tutorial-explore">
		<div><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_home.svg" /></div>
		<h1>The Top RTP Posts are Curated Here<br/> for You to <strong>Explore</strong></h1>
		<button class="secondary" data-tutorial-action="previous">Wait, Go Back</button>
		<button class="secondary" data-tutorial-action="next">Got It, Continue</button>
	</section>
	<section id="tutorial-enjoy" class="tutorial-enjoy">
		<div><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_rtp.svg" /></div>
		<h1>Welcome, and <strong>Enjoy</strong>.</h1>
		<button class="secondary" data-tutorial-action="previous">Wait, Go Back</button>
		<button class="primary" data-tutorial-action="close">Explore RTP Now</button>
	</section>
</section>