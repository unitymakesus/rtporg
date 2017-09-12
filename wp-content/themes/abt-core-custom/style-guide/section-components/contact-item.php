<?php
	$theme_dir = get_stylesheet_directory_uri();
?>
<article class="component" data-content="components-general">
	<h2 class="title">Contact Item</h2>
	<p class="description">Display a contact that can link to an email address, page, etc.</p>
	<div class="preview">
		<section class="contact-list">
			<ul>
				<li>
					<a href="#">
						<h4>Contact Name</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
						<div><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_contact-us.svg" /> sample@rtp.org</div>
					</a>
				</li>
			</ul>
		</section>
	</div>
	<pre><code class="language-markup">
&lt;section class=&quot;contact-list&quot;&gt;
&lt;ul&gt;
&lt;li&gt;
	&lt;a href=&quot;#&quot;&gt;
		&lt;h4&gt;...&lt;/h4&gt;
		&lt;p&gt;...&lt;/p&gt;
		&lt;div&gt;&lt;img class=&quot;svg&quot; src=&quot;...&quot; /&gt; ...&lt;/div&gt;
	&lt;/a&gt;
&lt;/li&gt;
&lt;/ul&gt;
&lt;/section&gt;
	</code></pre>
</article>