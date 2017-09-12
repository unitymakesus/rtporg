<?php
    $theme_dir = get_stylesheet_directory_uri();
?>
<article class="component" data-content="components-social-media">
    <h2 class="title">Social Media - Share</h2>
    <p class="description">Display a list of linked social media icons. Used to share a entry of content.</p>
    <div class="preview">
        <ul class="share" style="position: static;">
            <li class="facebook">
                <a href="#" title="Share on Facebook"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_facebook.svg" /></a>
            </li>
            <li class="twitter">
                <a href="#" title="Share on Twitter"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" /></a>
            </li>
            <li class="google">
                <a href="#" title="Share on Google"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_google.svg" /></a>
            </li>
        </ul>
    </div>
    <pre><code class="language-markup">
&lt;ul class=&quot;share&quot;&gt;
    &lt;li class=&quot;facebook&quot;&gt;
        &lt;a href=&quot;#&quot; title=&quot;Share on Facebook&quot;&gt;&lt;img class=&quot;svg&quot; src=&quot;...&quot; /&gt;&lt;/a&gt;
        &lt;span class=&quot;shares&quot;&gt;...&lt;/span&gt;
    &lt;/li&gt;
    &lt;li class=&quot;twitter&quot;&gt;
        &lt;a href=&quot;#&quot; title=&quot;Share on Twitter&quot;&gt;&lt;img class=&quot;svg&quot; src=&quot;...&quot; /&gt;&lt;/a&gt;
        &lt;span class=&quot;shares&quot;&gt;...&lt;/span&gt;
    &lt;/li&gt;
    &lt;li class=&quot;google&quot;&gt;
        &lt;a href=&quot;#&quot; title=&quot;Share on Google&quot;&gt;&lt;img class=&quot;svg&quot; src=&quot;...&quot; /&gt;&lt;/a&gt;
        &lt;span class=&quot;shares&quot;&gt;...&lt;/span&gt;
    &lt;/li&gt;
&lt;/ul&gt;
    </code></pre>
</article>