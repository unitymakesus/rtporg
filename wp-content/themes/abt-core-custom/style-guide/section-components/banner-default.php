<?php
    $theme_dir = get_stylesheet_directory_uri();
?>
<article class="component" data-content="components-banners">
    <h2 class="title">Featured Banner - Default</h2>
    <p class="description">Display a banner. Optionally display a graphic, theme overlay, and branding tagline.</p>
    <div class="preview">
        <div class="featured-banner type-default theme-ocean" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <h1>Banner Title <small>With Banner Sub Title</small></h1>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-default theme-forest" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <h1>Banner Title <small>With Banner Sub Title</small></h1>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-default theme-dark-forest" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <h1>Banner Title <small>With Banner Sub Title</small></h1>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-default theme-creamsicle" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <h1>Banner Title <small>With Banner Sub Title</small></h1>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-default theme-midnight" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <h1>Banner Title <small>With Banner Sub Title</small></h1>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-default theme-arctic" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <h1>Banner Title <small>With Banner Sub Title</small></h1>
            <div class="site-info">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>
        <div class="featured-banner type-default no-theme" style="background-image: url(http://upload.wikimedia.org/wikipedia/commons/e/ef/2008-07-25_Research_Triangle_Park_Headquarters.jpg);">
            <h1 style="opacity:0;">Banner Title <small>With Banner Sub Title</small></h1>
            <div class="site-info" style="opacity:0;">
                <small class="site-name"><?php bloginfo('name'); ?></small>
                <small class="site-tagline"><?php bloginfo('description'); ?></small>
            </div>
        </div>

        <div class="featured-banner type-default no-theme no-graphic">
            <h1>Banner Title <small>With Banner Sub Title</small></h1>
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
&lt;div class=&quot;featured-banner type-default theme-ocean&quot; style=&quot;background-image: url(...);&quot;&gt;
    &lt;h1&gt;... &lt;small&gt;...&lt;/small&gt;&lt;/h1&gt;
    &lt;div class=&quot;site-info&quot;&gt;
        &lt;small class=&quot;site-name&quot;&gt;...&lt;/small&gt;
        &lt;small class=&quot;site-tagline&quot;&gt;...&lt;/small&gt;
    &lt;/div&gt;
&lt;/div&gt;
    </code></pre>
</article>