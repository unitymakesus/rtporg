<?php
    $theme_dir = get_stylesheet_directory_uri();
?>
<article class="component" data-content="components-social-media">
    <h2 class="title">Social Media - Follow</h2>
    <p class="description">Display a list of linked social media icons. Used for follow links.</p>
    <div class="preview">
        <ul class="follow" style="position: static;">
            <li class="twitter"><a href="#" target="_blank"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" /><span>Twitter</span></a></li>
            <li class="google"><a href="#" target="_blank"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_google.svg" /><span>Google+</span></a></li>
            <li class="linkedin"><a href="#" target="_blank"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_linkedin.svg" /><span>LinkedIn</span></a></li>
            <li class="youtube"><a href="#" target="_blank"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_youtube.svg" /><span>YouTube</span></a></li>
        </ul>
    </div>
    <pre><code class="language-markup">
&lt;ul class=&quot;follow&quot;&gt;
    &lt;li class=&quot;twitter&quot;&gt;
        &lt;a href=&quot;#&quot;&gt;&lt;img src=&quot;...&quot; /&gt;&lt;span&gt;Twitter&lt;/span&gt;&lt;/a&gt;
    &lt;/li&gt;
    &lt;li class=&quot;google&quot;&gt;
        &lt;a href=&quot;#&quot;&gt;&lt;img src=&quot;...&quot; /&gt;&lt;span&gt;Google+&lt;/span&gt;&lt;/a&gt;
    &lt;/li&gt;
    &lt;li class=&quot;linkedin&quot;&gt;
        &lt;a href=&quot;#&quot;&gt;&lt;img src=&quot;...&quot; /&gt;&lt;span&gt;LinkedIn&lt;/span&gt;&lt;/a&gt;
    &lt;/li&gt;
    &lt;li class=&quot;youtube&quot;&gt;
        &lt;a href=&quot;#&quot;&gt;&lt;img src=&quot;...&quot; /&gt;&lt;span&gt;YouTube&lt;/span&gt;&lt;/a&gt;
    &lt;/li&gt;
&lt;/ul&gt;
    </code></pre>
</article>