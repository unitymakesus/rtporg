<?php
	$theme_dir = get_stylesheet_directory_uri();
?>
<article class="component" data-content="components-general">
	<h2 class="title">Loading</h2>
	<p class="description">Display a spinner for loading content.</p>
	<div class="preview">
		<div class="loading">
			<img src="<?php echo $theme_dir; ?>/img/g_preloader.gif" />
		</div>
	</div>
	<pre><code class="language-markup">
&lt;div class=&quot;loading&quot;&gt;
    &lt;img src=&quot;...&quot; /&gt;
&lt;/div&gt;
	</code></pre>
</article>
<article class="component" data-content="components-general">
	<h2 class="title">Search</h2>
	<p class="description">Display the global search bar.</p>
	<div class="preview">
		<div class="site-search" style="position: relative; top: auto;">
			<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" >
				<div class="field">
					<label for="s"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_search.svg" /> <span class="visuallyhidden">Search</span></label>
					<input type="search" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search" />
					<input id="searchsubmit" type="submit" value="Search" />
				</div>
			</form>
		</div>
	</div>
	<pre><code class="language-markup">
&lt;div class=&quot;site-search&quot;&gt;...&lt;/div&gt;
	</code></pre>
</article>