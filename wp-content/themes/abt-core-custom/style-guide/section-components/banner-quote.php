<?php
    $theme_dir = get_stylesheet_directory_uri();
?>
<article class="component" data-content="components-banners">
    <h2 class="title">Featured Banner - Quote</h2>
    <p class="description">Display a banner, specifically for a quote. Inherits properties from default banner.</p>
    <div class="preview">
        <div class="featured-banner type-quote theme-ocean" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <q>With a generous spirit, anything can happen. Anything can be.</q>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-quote theme-forest" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <q>With a generous spirit, anything can happen. Anything can be.</q>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-quote theme-dark-forest" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <q>With a generous spirit, anything can happen. Anything can be.</q>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-quote theme-creamsicle" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <q>With a generous spirit, anything can happen. Anything can be.</q>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-quote theme-midnight" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <q>With a generous spirit, anything can happen. Anything can be.</q>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-quote theme-arctic" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <q>With a generous spirit, anything can happen. Anything can be.</q>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-quote no-theme" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <q>With a generous spirit, anything can happen. Anything can be.</q>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-quote no-theme no-graphic">
            <q>With a generous spirit, anything can happen. Anything can be.</q>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
    </div>
    <pre><code class="language-markup">
&lt;? /*
    * Theme Options (class="theme-##name##")
    * --------------------------------------
    * Ocean
    * Forest
    * Dark Forest
    * Creamsicle
    * Midnight
    * Arctic
    * No Theme
    * No Theme, No Graphic
*/ ?&gt;
&lt;div class=&quot;featured-banner type-quote theme-ocean&quot; style=&quot;background-image: url(...);&quot;&gt;
    &lt;q&gt;...&lt;/q&gt;
    &lt;div class=&quot;site-info&quot;&gt;
        &lt;small class=&quot;site-name&quot;&gt;...&lt;/small&gt;
        &lt;small class=&quot;site-tagline&quot;&gt;...&lt;/small&gt;
    &lt;/div&gt;
&lt;/div&gt;
    </code></pre>
</article>