<?php
	$theme_dir = get_stylesheet_directory_uri();
?>
<article class="component" data-content="components-general">
	<h2 class="title">Pagination</h2>
	<p class="description">Display pagination navigational links. Used to break a list into multiple sections.</p>
	<div class="preview">
		<div class="pagination">
			<span>Page 1 of 2</span>
			<span class="current">1</span>
			<a href="#" class="inactive">2</a>
		</div>
	</div>
	<pre><code class="language-markup">
&lt;div class=&quot;pagination&quot;&gt;
	&lt;span&gt;Page ... of ...&lt;/span&gt;
	&lt;span class=&quot;current&quot;&gt;...&lt;/span&gt;
	&lt;a href=&quot;#&quot; class=&quot;inactive&quot;&gt;...&lt;/a&gt;
&lt;/div&gt;
	</code></pre>
</article>