<?php
	$theme_dir = get_stylesheet_directory_uri();
?>
<article class="component" data-content="components-general">
	<h2 class="title">Person Tile</h2>
	<p class="description">Display a person, typically in a list.</p>
	<div class="preview">
		<ul class="people">
			<li class="vcard has-profile">
				<a href="#">
					<div class="photo placeholder" style="background-image: url(<?php echo $theme_dir; ?>/img/icons/i_about-us.svg);"></div>
					<h3 class="fn">John Doe</h3>
					<p class="role">Hidden Ninja</p>
					<p class="org">ABC Company</p>
				</a>
			</li>
		</ul>
	</div>
	<pre><code class="language-markup">
&lt;ul class=&quot;people&quot;&gt;
&lt;li class=&quot;vcard has-profile&quot;&gt;
&lt;a href=&quot;#&quot;&gt;
	&lt;div class=&quot;photo placeholder&quot; style=&quot;background-image: url(...);&quot;&gt;&lt;/div&gt;
	&lt;h3 class=&quot;fn&quot;&gt;...&lt;/h3&gt;
	&lt;p class=&quot;role&quot;&gt;...&lt;/p&gt;
	&lt;p class=&quot;org&quot;&gt;...&lt;/p&gt;
&lt;/a&gt;
&lt;/li&gt;
&lt;/ul&gt;
	</code></pre>
</article>